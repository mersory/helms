<?php
namespace app\frontend\controller;

use think\Controller;
use think\Request;
use think\Session;
use app\common\model\Store_product;
use app\common\model\Store_shoppingcart;
use app\common\model\Store_order;
use app\common\model\Store_user_address;
use app\common\model\Store_area;
use app\common\model\Store_area_fee;
use phpDocumentor\Reflection\Types\This;
use app\common\model\Store_order_line;
use app\common\model\User_point;
use app\common\model\Point_transform_record;
use app\extra\controller\Basecontroller;

class Store extends Basecontroller
{
    // 商城主页
    public function index()
    {
        $_product = new Store_product();
        
        // 获取所有类别
        $_category_info = $_product->CategorytInfoAllQuery();
        
        $_product_info = $_product->ProductInfoValidQuery();
        // 向V层传数据
        $this->assign('pass_data', $_product_info);
        
        $this->assign('category_info', $_category_info);
        
        // 取回打包后的数据
        $htmls = $this->fetch();
        return $htmls;
    }
    
    // 商城详情
    public function detail($productId)
    {
        $_product = new Store_product();
        $_product_info = $_product->ProductInfoByIdQuery($productId);
        // 向V层传数据
        $this->assign('pass_data', $_product_info);
        
        // 取回打包后的数据
        $htmls = $this->fetch();
        return $htmls;
    }
    
    // 结算页
    public function checkout()
    {
        $_session_user = Session::get(USER_SEESION);
        $user_id = $_session_user["userId"];
        $_resdata = array();
        $_resdata["result"] = true;
        
        // 未登录用户不予许进入结算页
        if (empty($user_id)) {
            return $this->redirect("/login/login/index");
        }
        
        // 查询当前用户的送货地址列表
        $_address = new Store_user_address();
        $_address_data = $_address->AddressQueryByUserId($user_id);
        
        // 查询省列表
        $_province = new Store_area();
        $_province_data = $_province->StorePorvinceAllQuery();
        
        // 查询购物车数据,
        $_shoppingcart = new Store_shoppingcart();
        $_shoppingcart_data = $_shoppingcart->ShoppingcartInfoAllQuery($user_id);
        
        // 查询用户积分情况
        $userPoint = new User_point();
        $userPointInfo = $userPoint->PointQuery($user_id);
        
        // 为空时，返回到购物车页面
        if (count($_shoppingcart_data) < 1) {
            return $this->redirect("/frontend/store/shoppingcart");
        }
        
        $this->assign('address_data', $_address_data);
        $this->assign('province_data', $_province_data);
        $this->assign('shoppingcart_data', $_shoppingcart_data);
        $this->assign('points_data', $userPointInfo);
        
        $htmls = $this->fetch();
        return $htmls;
    }
    
    // 提交订单
    public function goToPay()
    {
        $_session_user = Session::get(USER_SEESION);
        $user_id = $_session_user["userId"];
        $_resdata = array();
        $_resdata["result"] = true;
        
        // 未登录用户不予许进入结算页
        if (empty($user_id)) {
            $_resdata['result'] = false;
            $_resdata['message'] = "请登录后在下单";
            return json_encode($_resdata);
        }
        
        $_post = Request::instance()->post();
        $addressId = $_post["addressId"];
        $pointType = $_post["pointType"];
        $province = null;
        $city = null;
        $area = null;
        $receiver = null;
        $mobile = null;
        $address = null;
        $saveAddress = false;
        
        if ("new" == $addressId) {
            $receiver = $_post["receiver"]; //
            $mobile = $_post["mobile"]; //
            $address = $_post["address"]; //
            $province = $_post["province"]; //
            $city = $_post["city"]; //
            $area = $_post["area"]; //
            $saveAddress = true;
        } else {
            $address = new Store_user_address();
            $addressInfo = $address->AddressQueryById($user_id, $addressId);
            if (count($addressInfo) >= 1) {
                $receiver = $addressInfo[0]["receiver"];
                $mobile = $addressInfo[0]["mobile"];
                $address = $addressInfo[0]["address"];
                $province = $addressInfo[0]["province"];
                $city = $addressInfo[0]["city"];
                $area = $addressInfo[0]["area"];
            }
        }
        
        // 校验购物车
        $_shoppingcart = new Store_shoppingcart();
        $_shoppingcart_data = $_shoppingcart->ShoppingcartInfoAllQuery($user_id);
        $total = null;
        if (count($_shoppingcart_data) > 0) {
            for ($i = 0; $i < count($_shoppingcart_data); ++ $i) {
                $productNum = $_shoppingcart_data[$i]["product_num"];
                $productId = $_shoppingcart_data[$i]["product_id"];
                $productPrice = $_shoppingcart_data[$i]["cur_price"];
                
                $product = new Store_product();
                $productInfo = $product->ProductInfoValidQuery($productId);
                if (count($productInfo) < 1 || $productInfo[0]["lifecycle"] != 1) {
                    $_resdata['result'] = false;
                    $_resdata['message'] = "商品已下架或不存在";
                    return json_encode($_resdata);
                    break;
                }
                
                if ($productInfo[0]["invetory"] < $productNum) {
                    $_resdata['result'] = false;
                    $_resdata['message'] = "商品库存不足";
                    return json_encode($_resdata);
                    break;
                }
                
                $total = $total + $productNum * $productPrice;
            }
            
            // 计算运费
            $shippingFee = 25;
            $areaFee = new Store_area_fee();
            $shippingFeeInfo = $areaFee->StoreAreaFeeByAreaQuery($province, $city, $area);
            if (count($shippingFeeInfo) == 1) {
                $shippingFee = $shippingFeeInfo[0]["shipping_fee"];
            }
            
            // 创建订单
            // 生成订单编码
            $orderCode = $this->generateOrderCode();
            
            $order = new Store_order();
            $order->StoreOrderInsert($orderCode, $user_id, $total, $shippingFee, $receiver, $mobile, $address, $province, $city, $area);
            
            // 扣减库存以及创建订单行
            for ($i = 0; $i < count($_shoppingcart_data); ++ $i) {
                $productNum = $_shoppingcart_data[$i]["product_num"];
                $productId = $_shoppingcart_data[$i]["product_id"];
                $productPrice = $_shoppingcart_data[$i]["cur_price"];
                
                $product = new Store_product();
                $state = $product->StoreReduceInvetory($productId, $productNum);
                if ($state < 1) {
                    $_resdata['result'] = false;
                    $_resdata['message'] = "商品库存不足";
                    return json_encode($_resdata);
                    break;
                }
                
                $orderLine = new Store_order_line();
                $orderLine->StoreOrderLineInsert($orderCode, $productId, $productNum, $productPrice * $productNum, $user_id);
            }
            
            // 扣减积分
            // 查询用户积分情况
            $userPoint = new User_point();
            $userPointInfo = $userPoint->PointQuery($user_id);
            $bonusPoint = $userPointInfo[0]['bonus_point'];
            $registPoint = $userPointInfo[0]['regist_point'];
            $consumePoint = $userPointInfo[0]['re_consume'];
            $universalPoint = $userPointInfo[0]['universal_point'];
            
            $point_type = 1;
            if (count($userPointInfo) > 0) {
                if ("bonus" == $pointType) {
                    $point_type = 1;
                    if ($bonusPoint < $total + $shippingFee) {
                        $_resdata['result'] = false;
                        $_resdata['message'] = "积分不足";
                        return json_encode($_resdata);
                    }
                    $bonusPoint = $bonusPoint - ($total + $shippingFee);
                }
                
                if ("regist" == $pointType) {
                    $point_type = 2;
                    if ($registPoint < $total + $shippingFee) {
                        $_resdata['result'] = false;
                        $_resdata['message'] = "积分不足";
                        return json_encode($_resdata);
                    }
                    $registPoint = $registPoint - ($total + $shippingFee);
                }
                
                if ("consume" == $pointType) {
                    $point_type = 3;
                    if ($consumePoint < $total + $shippingFee) {
                        $_resdata['result'] = false;
                        $_resdata['message'] = "积分不足";
                        return json_encode($_resdata);
                    }
                    $consumePoint = $consumePoint - ($total + $shippingFee);
                }
                
                if ("universal" == $pointType) {
                    $point_type = 4;
                    if ($universalPoint < $total + $shippingFee) {
                        $_resdata['result'] = false;
                        $_resdata['message'] = "积分不足";
                        return json_encode($_resdata);
                    }
                    $universalPoint = $universalPoint - ($total + $shippingFee);
                }
            }
            $point_change_type = "0";
            $point_change_sum = $total + $shippingFee;
            $pointRecord = new Point_transform_record();
            $pointRecord->PointTransformInsert($user_id, $point_type, $point_change_type, $point_change_sum);
            
            $userPoint = new User_point();
            $state = $userPoint->PointUpdate($user_id, - 1, $bonusPoint, $registPoint, $consumePoint, $universalPoint, - 1, - 1, - 1, - 1, - 1);
            if ($state) {
                $userPoint->commit();
            } else {
                $userPoint->rollback();
            }
            
            // 清空购物车
            $_shoppingcart->StoreShoppingcartEmpty($user_id);
            
            // 保存用户地址
            if ($saveAddress) {
                $addressUser = new Store_user_address();
                $addressUser->AddressInsert($receiver, $mobile, "", $province, $city, $area, $address, $user_id);
            }
        } else {
            $_resdata['result'] = false;
            $_resdata['message'] = "购物车为空";
            return json_encode($_resdata);
        }
        return json_encode($_resdata);
    }
    
    // 获取运费
    public function getShippingFee()
    {
        $_session_user = Session::get(USER_SEESION);
        $user_id = $_session_user["userId"];
        $_resdata = array();
        $_resdata["result"] = true;
        
        $shippingFee = 25;
        
        // 未登录用户不予许进入结算页
        if (empty($user_id)) {
            $_resdata['shippingFee'] = $shippingFee;
            return json_encode($_resdata);
        }
        
        $_post = Request::instance()->post();
        $addressId = $_post["addressId"];
        $province = null;
        $city = null;
        $area = null;
        
        if ("new" == $addressId) {
            $receiver = $_post["receiver"]; //
            $mobile = $_post["mobile"]; //
            $address = $_post["address"]; //
            $province = $_post["province"]; //
            $city = $_post["city"]; //
            $area = $_post["area"]; //
            $saveAddress = true;
        } else {
            $address = new Store_user_address();
            $addressInfo = $address->AddressQueryById($user_id, $addressId);
            if (count($addressInfo) >= 1) {
                $receiver = $addressInfo[0]["receiver"];
                $mobile = $addressInfo[0]["mobile"];
                $address = $addressInfo[0]["address"];
                $province = $addressInfo[0]["province"];
                $city = $addressInfo[0]["city"];
                $area = $addressInfo[0]["area"];
            }
        }
        
        $areaFee = new Store_area_fee();
        $shippingFeeInfo = $areaFee->StoreAreaFeeByAreaQuery($province, $city, $area);
        if (count($shippingFeeInfo) == 1) {
            $shippingFee = $shippingFeeInfo[0]["shipping_fee"];
        }
        
        $_resdata['shippingFee'] = $shippingFee;
        return json_encode($_resdata);
    }
    
    // 我的订单
    public function orderlist()
    {
        $_session_user = Session::get(USER_SEESION);
        $user_id = $_session_user["userId"];
        if (empty($user_id)) {
            return $this->redirect("/login/login/index");
        }
        $_order = new Store_order();
        $_order_info = $_order->OrderInfoMemberQuery($user_id);
        // 向V层传数据
        $this->assign('pass_data', $_order_info);
        
        // 取回打包后的数据
        $htmls = $this->fetch();
        return $htmls;
    }
    
    // 购物车主页
    public function shoppingcart()
    {
        $_session_user = Session::get(USER_SEESION);
        $user_id = $_session_user["userId"];
        if (empty($user_id)) {
            return $this->redirect("/login/login/index");
        }
        $_shoppingcart = new Store_shoppingcart();
        $_order_info = $_shoppingcart->ShoppingcartInfoAllQuery($user_id);
        // 向V层传数据
        $this->assign('shoppingcart_data', $_order_info);
        
        // 取回打包后的数据
        $htmls = $this->fetch();
        return $htmls;
    }
    
    // 加入购物车
    public function addToShoppingcart()
    {
        $_session_user = Session::get(USER_SEESION);
        $user_id = $_session_user["userId"];
        $_resdata = array();
        $_resdata["result"] = true;
        
        // 未登录用户不予许加入购物车
        if (empty($user_id)) {
            $_resdata["result"] = false;
            $_resdata["message"] = "请先登录用户";
            return json_encode($_resdata);
        }
        
        $_post = Request::instance()->post();
        $product_id = $_post["product_id"];
        
        $_shoppingcart = new Store_shoppingcart();
        $_product = new Store_product();
        
        // 校验商品库存
        $product_res = $_product->ProductInfoByIdQuery($product_id);
        
        if (count($product_res) <= 0) {
            $_resdata["result"] = false;
            $_resdata["message"] = "商品不存在";
            return json_encode($_resdata);
        } else 
            if ($product_res[0]["lifecycle"] != 1) {
                $_resdata["result"] = false;
                $_resdata["message"] = "商品未上架";
                return json_encode($_resdata);
            } else 
                if ($product_res[0]["invetory"] <= 1) {
                    $_resdata["result"] = false;
                    $_resdata["message"] = "商品库存不足";
                    return json_encode($_resdata);
                }
        
        // 查询当前用户是否已添加该商品
        $shoppingcart_info = $_shoppingcart->ShoppingcartInfoByProductIdQuery($product_id, $user_id);
        
        if (count($shoppingcart_info) > 0) {
            $product_num = $shoppingcart_info[0]["product_num"];
            $product_numnew = $product_num + 1;
            
            $res = $_shoppingcart->StoreShoppingcartUpdateNum($shoppingcart_info[0]["id"], $product_id, $product_numnew, $user_id);
            
            if (count($res) <= 0) {
                $_shoppingcart->commit();
                $_resdata["result"] = false;
                $_resdata["message"] = "加入购物车失败";
                return json_encode($_resdata);
            }
        } else {
            $res = $_shoppingcart->StoreShoppingcartInsert($product_id, 1, $user_id);
            
            if (count($res) <= 0) {
                $_resdata["result"] = false;
                $_resdata["message"] = "加入购物车失败";
                return json_encode($_resdata);
            }
        }
        
        return json_encode($_resdata);
    }
    
    // 从购物车删除商品
    public function deleteFromShoppingcart()
    {
        $_session_user = Session::get(USER_SEESION);
        $user_id = $_session_user["userId"];
        $_resdata = array();
        $_resdata["result"] = true;
        
        // 未登录用户不予许加入购物车
        if (empty($user_id)) {
            $_resdata["result"] = false;
            $_resdata["message"] = "请先登录用户";
            return json_encode($_resdata);
        }
        
        $_post = Request::instance()->post();
        $shoppingcartId = $_post["shoppingcartId"];
        
        $_shoppingcart = new Store_shoppingcart();
        $_product = new Store_product();
        
        $res = $_shoppingcart->StoreShoppingcartDelete($shoppingcartId, $user_id);
        if (count($res) <= 0) {
            $_resdata["result"] = false;
            $_resdata["message"] = "删除购物车失败";
            return json_encode($_resdata);
        }
        return json_encode($_resdata);
    }
    
    // 更新购物车商品数量
    public function updateProductNumInShoppingcart()
    {
        $_session_user = Session::get(USER_SEESION);
        $user_id = $_session_user["userId"];
        $_resdata = array();
        $_resdata["result"] = true;
        
        // 未登录用户不予许加入购物车
        if (empty($user_id)) {
            $_resdata["result"] = false;
            $_resdata["message"] = "请先登录用户";
            return json_encode($_resdata);
        }
        
        $_post = Request::instance()->post();
        $shoppingcartId = $_post["shoppingcartId"];
        $productId = $_post["productId"];
        $productNum = $_post["productNum"];
        
        $_shoppingcart = new Store_shoppingcart();
        $_product = new Store_product();
        
        $res = $_shoppingcart->StoreShoppingcartUpdateNum($shoppingcartId, $productId, $productNum, $user_id);
        if (count($res) <= 0) {
            $_resdata["result"] = false;
            $_resdata["message"] = "删除购物车失败";
            return json_encode($_resdata);
        }
        return json_encode($_resdata);
    }

    /**
     * 查询市
     *
     * @return string
     */
    public function getCityByProvince()
    {
        $_post = Request::instance()->post();
        $provinceId = $_post["provinceId"];
        
        $_area = new Store_area();
        $_res = $_area->StoreCityByProvinceIdQuery($provinceId);
        
        return json_encode($_res);
    }

    /**
     * 查询区县
     *
     * @return string
     */
    public function getAreaByCity()
    {
        $_post = Request::instance()->post();
        $cityId = $_post["cityId"];
        
        $_area = new Store_area();
        $_res = $_area->StoreAreaByCityIdQuery($cityId);
        
        return json_encode($_res);
    }

    protected function generateOrderCode()
    {
        $t = time();
        $orderSuffix = date("YmdHis", $t);
        return "HERMES" . $orderSuffix;
    }
    
    // 用户确认收货
    public function confirmReceive()
    {
        $_session_user = Session::get(USER_SEESION);
        $user_id = $_session_user["userId"];
        $_resdata = array();
        $_resdata["result"] = true;
        
        // 未登录用户不予许加入购物车
        if (empty($user_id)) {
            $_resdata["result"] = false;
            $_resdata["message"] = "请先登录用户";
            return json_encode($_resdata);
        }
        
        $_post = Request::instance()->post();
        $orderId = $_post["orderId"];
        
        $orderInfo = new Store_order();
        $orderInfo->StoreOrderStatusUpdate($orderId, 3);
        
        return json_encode($_resdata);
    }

    public function getShoppingcartCount()
    {
        $_shoppingcart_info = new Store_shoppingcart();
        $_shoppingcart_info_count = $_shoppingcart_info->ShoppingcartInfoAllQueryCount($_res[0]["ID"]);
        $_session_user["shoppingcart_count"] = $_shoppingcart_info_count;
        $_resdata = array();
        $_resdata['result'] = true;
        $_resdata['count'] = $_shoppingcart_info;
        return json_encode($_resdata);
    }
}
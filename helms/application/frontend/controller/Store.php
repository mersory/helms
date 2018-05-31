<?php
namespace app\frontend\controller;

use think\Controller;
use think\Request;
use think\Session;
use app\common\model\Store_product;
use app\common\model\Store_shoppingcart;
use app\common\model\Store_order;

class Store extends Controller
{
    //商城主页
    public function index()
    {

        $_product = new Store_product();
        
        //获取所有类别
        $_category_info = $_product->CategorytInfoAllQuery();
        
        $_product_info = $_product->ProductInfoValidQuery();
        // 向V层传数据
        $this->assign('pass_data', $_product_info);
        
        $this->assign('category_info', $_category_info);
        
        // 取回打包后的数据
        $htmls = $this->fetch();
        return $htmls;
    }
    
    //商城详情
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

    //结算页
    public function checkout()
    {
            $_session_user = Session::get(USER_SEESION);
        $user_id = $_session_user["userId"];
        $_resdata = array();
        $_resdata["result"]=true;
        
        //未登录用户不予许进入结算页
        if(empty($user_id)){
            return $this->redirect("/login/login/index");
        }
        
        
        $htmls = $this->fetch();
        return $htmls;
    }
    
    public function goToPay()
    {
        $_session_user = Session::get(USER_SEESION);
        $user_id = $_session_user["userId"];
        $_resdata = array();
        $_post = Request::instance()->post();
        $_order_info = new Store_order();
        $product_id = $_post["product_id"];
        $receiver = $_post["receiver"];//
        $mobile = $_post["mobile"];//
        $address = $_post["address"];//
        
        $_product = new Store_product();
        $_product_info = $_product->ProductInfoByIdQuery($product_id);
        if(count($_product_info) !=1){
            $_resdata["result"]=false;
            return json_encode($_resdata);
        }
        $total=$_product_info[0]["price"];
        
        $_res = $_order_info->StoreOrderInsert($user_id, $product_id, $receiver, $mobile, $address, $total);
        if (count($_res) == 1){
            $_resdata["result"]=true;
            $_order_info->commit();
        }else{
            $_resdata["result"]=false;
            $_order_info->rollback();
        }
        return json_encode($_resdata);
    }
    
    //结算页
    public function orderlist()
    {
        $_session_user = Session::get(USER_SEESION);
        $user_id = $_session_user["userId"];
        $user_id = 2;
        if(empty($user_id)){
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
    
    //购物车主页
    public function shoppingcart()
    {
        $_session_user = Session::get(USER_SEESION);
        $user_id = $_session_user["userId"];
        if(empty($user_id)){
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
    
    //加入购物车
    public function addToShoppingcart(){
        $_session_user = Session::get(USER_SEESION);
        $user_id = $_session_user["userId"];
        $_resdata = array();
        $_resdata["result"]=true;
        
        //未登录用户不予许加入购物车
        if(empty($user_id)){
            $_resdata["result"]=false;
            $_resdata["message"]="请先登录用户";
            return json_encode($_resdata);
        }

        $_post = Request::instance()->post();
        $product_id = $_post["product_id"];
        
        $_shoppingcart = new Store_shoppingcart();
        $_product = new Store_product();
        
        //校验商品库存
        $product_res = $_product ->ProductInfoByIdQuery($product_id);
        
        if(count($product_res) <= 0){
            $_resdata["result"]=false;
            $_resdata["message"]="商品不存在";
            return json_encode($_resdata);
        }else if($product_res[0]["lifecycle"] != 1){
            $_resdata["result"]=false;
            $_resdata["message"]="商品未上架";
            return json_encode($_resdata);
        }else if($product_res[0]["invetory"] <= 1){
            $_resdata["result"]=false;
            $_resdata["message"]="商品库存不足";
            return json_encode($_resdata);
        }
        
        //查询当前用户是否已添加该商品
        $shoppingcart_info = $_shoppingcart -> ShoppingcartInfoByProductIdQuery($product_id, $user_id);
        
        if(count($shoppingcart_info) > 0){
            $product_num = $shoppingcart_info[0]["product_num"];
            $product_numnew = $product_num + 1;
        
            $res = $_shoppingcart -> StoreShoppingcartUpdateNum($shoppingcart_info[0]["id"], $product_id, $product_numnew, $user_id);
        
            if(count($res) <= 0){
                $_shoppingcart->commit();
                $_resdata["result"]=false;
                $_resdata["message"]="加入购物车失败";
                return json_encode($_resdata);
            }
        }else{
            $res = $_shoppingcart -> StoreShoppingcartInsert($product_id, 1, $user_id);
        
            if(count($res) <= 0){
                $_resdata["result"]=false;
                $_resdata["message"]="加入购物车失败";
                return json_encode($_resdata);
            }
        }
        
        return json_encode($_resdata);
    }
    
    //从购物车删除商品
    public function deleteFromShoppingcart(){
        $_session_user = Session::get(USER_SEESION);
        $user_id = $_session_user["userId"];
        $_resdata = array();
        $_resdata["result"]=true;
        
        //未登录用户不予许加入购物车
        if(empty($user_id)){
            $_resdata["result"]=false;
            $_resdata["message"]="请先登录用户";
            return json_encode($_resdata);
        }
        
        $_post = Request::instance()->post();
        $shoppingcartId = $_post["shoppingcartId"];
        
        $_shoppingcart = new Store_shoppingcart();
        $_product = new Store_product();
        
        $res = $_shoppingcart->StoreShoppingcartDelete($shoppingcartId, $user_id);
        if(count($res) <= 0){
            $_resdata["result"]=false;
            $_resdata["message"]="删除购物车失败";
            return json_encode($_resdata);
        }
        return json_encode($_resdata);
    }
    
    //更新购物车商品数量
    public function updateProductNumInShoppingcart(){
        $_session_user = Session::get(USER_SEESION);
        $user_id = $_session_user["userId"];
        $_resdata = array();
        $_resdata["result"]=true;
        
        //未登录用户不予许加入购物车
        if(empty($user_id)){
            $_resdata["result"]=false;
            $_resdata["message"]="请先登录用户";
            return json_encode($_resdata);
        }
        
        $_post = Request::instance()->post();
        $shoppingcartId = $_post["shoppingcartId"];
        $productId = $_post["productId"];
        $productNum = $_post["productNum"];
        
        $_shoppingcart = new Store_shoppingcart();
        $_product = new Store_product();
        
        $res = $_shoppingcart->StoreShoppingcartUpdateNum($shoppingcartId, $productId, $productNum, $user_id);
        if(count($res) <= 0){
            $_resdata["result"]=false;
            $_resdata["message"]="删除购物车失败";
            return json_encode($_resdata);
        }
        return json_encode($_resdata);
    }
    
}
<?php
namespace app\backend\controller;

use think\Controller;
use think\File;
use think\Request;
use think\Session;
use app\common\model\Store_product;
use app\common\model\Store_order;
use app\common\model\System_subscriber;
use app\extra\controller\Basecontroller;
use phpDocumentor\Reflection\Types\Array_;

class Store extends Basecontroller
{
    // 订单列表
    public function orderList()
    {
        $_session_user = Session::get(USER_SEESION);
        if (empty($_session_user)) {
            return $this->redirect("/login/login/index");
        } else {
            $_user_id = $_session_user["userId"];
            $subscriber = new System_subscriber();
            $res = $subscriber->SubscriberQueryMenu($_user_id);
            
            $this->assign('menu_data', $res);
            
            $_order = new Store_order();
            $_order_info = $_order->OrderInfoAllQueryPage();
            // 向V层传数据
            $this->assign('page',$_order_info->render());
            $this->assign('pass_data', $_order_info);
            
            // 取回打包后的数据
            $htmls = $this->fetch();
            return $htmls;
        }
    }
    
    // 商品列表
    public function productList()
    {
        $_session_user = Session::get(USER_SEESION);
        if (empty($_session_user)) {
            return $this->redirect("/login/login/index");
        } else {
            $_user_id = $_session_user["userId"];
            $subscriber = new System_subscriber();
            $res = $subscriber->SubscriberQueryMenu($_user_id);
            
            $this->assign('menu_data', $res);
            $_product = new Store_product();
            $_product_info = $_product->ProductInfoAllQueryPage();
            
            $this->assign('page',$_product_info->render());
            // 向V层传数据
            $this->assign('pass_data', $_product_info);
            
            // 取回打包后的数据
            $htmls = $this->fetch();
            return $htmls;
        }
    }
    
    // 添加商品
    public function addProduct()
    {
        $_resdata = array();
        $_post = Request::instance()->post();
        $_product_info = new Store_product();
        $name = $_post["product_name"];
        $description = $_post["product_description"]; //
        $image_url = $_post["product_url"]; //
        $description_url = $_post["product_description_url"]; //
        $inventory = $_post["product_inventory"]; //
        $price = $_post["product_price"]; //
        $curPrice = $_post["product_cur_price"]; //
        $category = $_post["product_category"]; //
        $categoryName = $_post["product_category_name"]; //
        $order = $_post["product_order"]; //
        $_res = $_product_info->StoreProductInsert($description_url, $name, $description, $image_url, "", $inventory, $price, $curPrice, $category, $categoryName, $order);
        if (count($_res) == 1) {
            $_resdata["result"] = true;
            $_product_info->commit();
        } else {
            $_resdata["result"] = false;
            $_product_info->rollback();
        }
        return json_encode($_resdata);
    }
    
    // 修改商品
    public function modifyProduct()
    {
        $_resdata = array();
        $_post = Request::instance()->post();
        $_product_info = new Store_product();
        $id = $_post["product_id"];
        $name = $_post["product_name"];
        $description = $_post["product_description"]; //
        $image_url = $_post["product_url"]; //
        $description_url = $_post["product_description_url"]; //
        $inventory = $_post["product_inventory"]; //
        $price = $_post["product_price"]; //
        $curPrice = $_post["product_cur_price"]; //
        $category = $_post["product_category"]; //
        $categoryName = $_post["product_category_name"]; //
        $order = $_post["product_order"]; //
        $_res = $_product_info->StoreProductUpdate($description_url, $id, $name, $description, $image_url, "", $inventory, $price, $curPrice, $category, $categoryName, $order);
        if (count($_res) == 1) {
            $_resdata["result"] = true;
            $_product_info->commit();
        } else {
            $_resdata["result"] = false;
            $_product_info->rollback();
        }
        return json_encode($_resdata);
    }
    
    // 查询商品信息
    public function findProduct($product_id)
    {
        $_product = new Store_product();
        $_product_info = $_product->ProductInfoByIdQuery($product_id);
        
        return json_encode($_product_info);
    }
    
    // 上架商品
    public function stockProduct($product_id)
    {
        $_product_info = new Store_product();
        $_res = $_product_info->ProductStockUpdate($product_id, "");
        if (count($_res) == 1) {
            $_resdata["result"] = true;
            $_product_info->commit();
        } else {
            $_resdata["result"] = false;
            $_product_info->rollback();
        }
        return json_encode($_resdata);
    }
    
    // 下架商品
    public function downStockProduct($product_id)
    {
        $_product_info = new Store_product();
        $_res = $_product_info->ProductDownStockUpdate($product_id, "");
        if (count($_res) == 1) {
            $_resdata["result"] = true;
            $_product_info->commit();
        } else {
            $_resdata["result"] = false;
            $_product_info->rollback();
        }
        return json_encode($_resdata);
    }
    
   // 商品图片上传
    public function setFile()
    {
        $file = request()->file('file');
        if ($_FILES['file']['error']) {
            $data['result'] = false;
        } else {
            
            // 上传的时候的原文件名
            $filename = $file->getInfo()['name'];
            $dir = config('upload_path');
            if (! is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
            
            $info = $file->move($dir);
            $data['result'] = true;
            $image_url = str_replace('\\', '/', $info->getPathname());
            $image_url = substr($image_url, strpos($image_url, '/resources') + 10);
            $data['pic_url'] = $image_url;
        }
      /*   $files = request()->file('image');

        $fileName = "";
        foreach($files as $file){
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'resources');
            if($info){
                // 成功上传后 获取上传信息
                // 输出 jpg
                echo $info->getExtension();
                // 输出 42a79759f284b767dfcb2a0197904287.jpg
                echo $info->getFilename();

                if("" == $fileName){
                    $fileName = $info->getFilename();
                }else{
                    $fileName = $fileName + "," + $info->getFilename();
                }
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
                $data['result'] = false;
                return;
            }
        }

        $data['result'] = true;
        $data['pic_url'] = $fileName; */

        return json_encode($data);
    }
    
    //  确认发货
    public function confirmSend()
    {
        $_session_user = Session::get(USER_SEESION);
        $user_id = $_session_user["userId"];
        $_resdata = array();
        $_resdata["result"] = true;
        
        if (empty($user_id)) {
            $_resdata["result"] = false;
            $_resdata["message"] = "请先登录用户";
            return json_encode($_resdata);
        }
        
        $_post = Request::instance()->post();
        $orderId = $_post["orderId"];
        $expressCode = $_post["expressCode"];
        
        $orderInfo = new Store_order();
        $orderInfo->StoreOrderStatusUpdate($orderId, 2,$expressCode);
        
        return json_encode($_resdata);
    }
   
}
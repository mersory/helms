<?php
namespace app\frontend\controller;

use think\Controller;
use think\Request;
use think\Session;
use app\common\model\Store_product;
use app\common\model\Store_order;

class Store extends Controller
{
    //商城主页
    public function index()
    {
        $_product = new Store_product();
        $_product_info = $_product->ProductInfoAllQuery();
        // 向V层传数据
        $this->assign('pass_data', $_product_info);
        
        // 取回打包后的数据
        $htmls = $this->fetch();
        return $htmls;
    }

    //结算页
    public function checkout()
    {
        $_get = Request::instance()->get();
        $productId = $_get["productId"];
        if($productId != -1){
            $this->assign('productId', $productId);
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
}
<?php
namespace app\backend\controller;

use think\Controller;
use think\File;
use think\Request;
use app\common\model\Store_product;
use app\common\model\Store_order;

class Store extends Controller
{
    //订单列表
    public function orderList()
    {
        $_order = new Store_order();
        $_order_info = $_order->OrderInfoAllQuery();
        // 向V层传数据
        $this->assign('pass_data', $_order_info);
        
        // 取回打包后的数据
        $htmls = $this->fetch();
        return $htmls;
    }

    //商品列表
    public function productList()
    {
        $_product = new Store_product();
        $_product_info = $_product->ProductInfoAllQuery();
        // 向V层传数据
        $this->assign('pass_data', $_product_info);
        
        // 取回打包后的数据
        $htmls = $this->fetch();
        return $htmls;
    }
    
    //添加商品
    public function addProduct()
    {

        $_resdata = array();
        $_post = Request::instance()->post();
        $_product_info = new Store_product();
        $name = $_post["product_name"];
        $description = $_post["product_description"];//
        $image_url = $_post["product_url"];//
        $inventory = $_post["product_inventory"];//
        $price = $_post["product_price"];//
        $_res = $_product_info->StoreProductInsert($name, $description, $image_url, "", $inventory,$price);
        if (count($_res) == 1){
            $_resdata["result"]=true;
            $_product_info->commit();
        }else{
            $_resdata["result"]=false;
            $_product_info->rollback();
        }
        return json_encode($_resdata);
    }
    
    //修改商品
    public function modifyProduct()
    {
        $_resdata = array();
        $_post = Request::instance()->post();
        $_product_info = new Store_product();
        $id = $_post["product_id"];
        $name = $_post["product_name"];
        $description = $_post["product_description"];//
        $image_url = $_post["product_url"];//
        $inventory = $_post["product_inventory"];//
        $price = $_post["product_price"];//
        $_res = $_product_info->StoreProductUpdate($id,$name, $description, $image_url, "", $inventory,$price);
        if (count($_res) == 1){
            $_resdata["result"]=true;
            $_product_info->commit();
        }else{
            $_resdata["result"]=false;
            $_product_info->rollback();
        }
        return json_encode($_resdata);
    }
    
    //查询商品信息
    public function findProduct($product_id)
    {
        $_product = new Store_product();
        $_product_info = $_product->ProductInfoByIdQuery($product_id);
        
        return json_encode($_product_info);
    }
    
    //上架商品
    public function stockProduct($product_id){
        $_product_info = new Store_product();
        $_res = $_product_info->ProductStockUpdate($product_id,"");
        if (count($_res) == 1){
            $_resdata["result"]=true;
            $_product_info->commit();
        }else{
            $_resdata["result"]=false;
            $_product_info->rollback();
        }
        return json_encode($_resdata);
    }
    
    //下架商品
    public function downStockProduct($product_id){
        $_product_info = new Store_product();
        $_res = $_product_info->ProductDownStockUpdateStockUpdate($product_id,"");
        if (count($_res) == 1){
            $_resdata["result"]=true;
            $_product_info->commit();
        }else{
            $_resdata["result"]=false;
            $_product_info->rollback();
        }
        return json_encode($_resdata);
    }
    
    //订单已发货
    public function sendOrder($product_id){
    
    }
    
    //商品图片上传
    public function setFile(){
        $file = request()->file('file');
        if($_FILES['file']['error']){
            $data['result'] = false;
        }else{
            
            //上传的时候的原文件名
            $filename = $file -> getInfo()['name'];
            $dir = config('upload_path');
            if(!is_dir($dir)) {
                mkdir($dir,0777,true);
            }
            
            $info = $file->move($dir);
            $data['result'] = true;
            $image_url = str_replace('\\', '/', $info->getPathname());
            $image_url = substr($image_url,strpos($image_url,'/resources')+10);
            $data['pic_url'] = $image_url;
           
        }
        
        return json_encode($data);
    }
    
}
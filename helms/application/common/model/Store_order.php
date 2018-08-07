<?php
namespace app\common\model;

use think\Model;
use app\common\model\Store_order_line;
use think\paginator\driver;

class Store_order extends Model
{
    //查询所有订单
    public function OrderInfoAllQuery()
    {
     
        $_orderinfo = $this->order('update_time desc')->select();
        if(count($_orderinfo) > 0){
            for($i=0;$i<count($_orderinfo);++$i){
                $orderLine = new Store_order_line();
                $_orderinfo[$i]["orderLines"] = $orderLine->getOrderLineByCode($_orderinfo[$i]["code"]);
            }
        }
        return $_orderinfo;
    }
    
    //查询所有订单
    public function OrderInfoAllQueryPage()
    {
//         $sql = "select * from helms_store_order order by update_time desc";
//changed by Gavin start model24
        $_orderinfo = $this->order('create_time desc')->paginate(10,false,['query' => request()->param()]);
//changed by Gavin end model24
        if(count($_orderinfo) > 0){
            for($i=0;$i<count($_orderinfo);++$i){
                $orderLine = new Store_order_line();
                $_orderinfo[$i]["orderLines"] = $orderLine->getOrderLineByCode($_orderinfo[$i]["code"]);
            }
        }
        return $_orderinfo;
    }
    
    //用户查询所有订单
    public function OrderInfoMemberQuery($userId)
    {
        $sql = "select * from helms_store_order where user_id = '$userId' order by update_time desc";
        $_orderinfo = $this->query($sql);
        if(count($_orderinfo) > 0){
            for($i=0;$i<count($_orderinfo);++$i){
                $orderLine = new Store_order_line();
                $_orderinfo[$i]["orderLines"] = $orderLine->getOrderLineByCode($_orderinfo[$i]["code"]);
            }
        }
        return $_orderinfo;
    }
    
    //changed by Gavin start model24
    public function StoreOrderInsert($code, $userId,$total,$shippingFee,$receiver,$mobile,$address,$province,$city,$area,$point_type='')
    {
        $_orderinfo = array();
        if ($code >=0)
        {
            $_orderinfo["code"] = $code;
        }
    
        if ($userId >=0)
        {
            $_orderinfo["user_id"] = $userId;
        }
        
        if ($total >=0)
        {
            $_orderinfo["total"] = $total;
        }

        if ($shippingFee >=0)
        {
            $_orderinfo["shipping_fee"] = $shippingFee;
        }

        if ($receiver >=0)
        {
            $_orderinfo["receiver"] = $receiver;
        }
        
        if ($mobile >=0)
        {
            $_orderinfo["mobile"] = $mobile;
        }
        
        if ($province >=0)
        {
            $_orderinfo["province"] = $province;
        }
        
        if ($city >=0)
        {
            $_orderinfo["city"] = $city;
        }
        
        if ($area >=0)
        {
            $_orderinfo["area"] = $area;
        }
        
        if ($address >=0)
        {
            $_orderinfo["address"] = $address;
        }
        
        if (strcmp($point_type,''))
        {
            $_orderinfo["point_type"] = $point_type;
        }
        
        $_orderinfo["lifecycle"] = "1";
        
        $t=time();
        $_orderinfo["create_time"] = date("Y-m-d H:i:s",$t);
        $_orderinfo["update_time"] = date("Y-m-d H:i:s",$t);
    
        $state = $this->save($_orderinfo);
        
        return $state;
    }
    
    public function StoreOrderStatusUpdate($id, $lifecycle,$expressCode)
    {
        $_orderinfo = array();
        if ($id >=0)
        {
            $_orderinfo["id"] = $id;
        }
    
        if ($lifecycle >=0)
        {
            $_orderinfo["lifecycle"] = $lifecycle;
        }
        
        if ($expressCode)
        {
            $_orderinfo["express_code"] = $expressCode;
        }
        
        $t=time();
        $_orderinfo["update_time"] = date("Y-m-d H:i:s",$t);
    
        $state = $this-> where("id=$id")
        ->setField($_orderinfo);
        
        return $state;
    }
    
}
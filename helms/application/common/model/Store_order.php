<?php
namespace app\common\model;

use think\Model;

class Store_order extends Model
{
    public function index()
    {
        var_dump("Storeproductinfo");
    }
    
    public function OrderInfoAllQuery()
    {
        $_where = '';
        $_orderinfo = $this->where($_where)
        ->select();
        $count = count($_orderinfo);
        if ($count < 1)
        {
            var_dump("OrderInfo not exsist");
            return ;
        }
        return $_orderinfo;
    }
    
    public function OrderInfoMemberQuery($userId)
    {
        $_where = '';
        if ($userId >=0){
            $_where = "user_id = $userId";
        }
        
        $_orderinfo = $this->where($_where)->select();
        $count = count($_orderinfo);
        if ($count < 1)
        {
            var_dump("OrderInfo not exsist");
            return ;
        }
        return $_orderinfo;
    }
    
    public function StoreOrderInsert($user_id, $product_id,$receiver,$mobile,$address,$total)
    {
        $_orderinfo = array();
        if ($user_id >=0)
        {
            $_orderinfo["code"] = $user_id;
        }
    
        if ($product_id >=0)
        {
            $_orderinfo["product_id"] = $product_id;
        }
        
        if ($receiver >=0)
        {
            $_orderinfo["receiver"] = $receiver;
        }

        if ($mobile >=0)
        {
            $_orderinfo["mobile"] = $mobile;
        }

        if ($address >=0)
        {
            $_orderinfo["address"] = $address;
        }
        
        if ($total >=0)
        {
            $_orderinfo["total"] = $total;
        }
        
        $_orderinfo["lifecycle"] = "1";
        $t=time();
        $_orderinfo["create_time"] = date("Y-m-d H:i:s",$t);
    
        $this->startTrans();
        $state = $this->save($_orderinfo);
        if ($state)
        {
            $this->commit();
        }
        else
        {
            $this->rollback();
        }
        return $state;
    }
    
    public function StoreOrderStatusUpdate($id, $lifecycle)
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
    
        $state = $this-> where("id=$id")
        ->setField($_orderinfo);
        return $state;
    }
    
}
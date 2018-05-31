<?php
namespace app\common\model;

use think\Model;

class Store_user_address extends Model
{    

    /**
     * 查询指定用户所有的地址
     */
    public function AddressQueryByUserId($userId)
    {
        $sql = "select * from helms_store_user_address where user_id = '$userId' order by update_time desc";
        $res = $this->query($sql);
        return $res;
    }
    
    /**
     * 查询指定用户所有的地址
     */
    public function AddressQueryById($userId,$id)
    {
        $sql = "select * from helms_store_user_address where user_id = '$userId' and id =$id order by update_time desc";
        $res = $this->query($sql);
        return $res;
    }

    //地址插入
    public function AddressInsert($receiver,$mobile,$email,$province,$city,$area,$address,$userId)
    {
        $_addressInfo = array();
        if ($receiver >=0)
        {
            $_addressInfo["receiver"] = $receiver;
        }
        if ($mobile >=0)
        {
            $_addressInfo["mobile"] = $mobile;
        }
        if ($email >=0)
        {
            $_addressInfo["email"] = $email;
        }
        if ($province >=0)
        {
            $_addressInfo["province"] = $province;
        }
        if ($city >=0)
        {
            $_addressInfo["city"] = $city;
        }
        if ($area >=0)
        {
            $_addressInfo["area"] = $area;
        }
        if ($address >=0)
        {
            $_addressInfo["address"] = $address;
        }
        $_addressInfo["user_id"] = $userId;
    
        $t=time();
        $_addressInfo["create_time"] = date("Y-m-d H:i:s",$t);
        $_addressInfo["update_time"] = date("Y-m-d H:i:s",$t);
    
        $this->startTrans();
        $state = $this->save($_addressInfo);
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

}
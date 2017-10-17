<?php
namespace app\common\model;

use think\Model;

class User_point extends Model
{
    public function index()
    {
        var_dump("Userpoint");
    }
    
    public function PointQuery($user_id)
    {
        $_where = '';
        if ($user_id != -1)
        {
            $_where = "ID = $user_id";
        }
        $_point_info = $this->where($_where)
        ->select();
        $count = count($_point_info);
        if ($count < 1)
        {
            var_dump("ID :$user_id not exsist");
            return ;
        }
        return $_point_info;
    }
    
    public function PointDel($user_id)
    {
        $_where = '';
        if ($user_id != -1)
        {
            $_where = "ID = $user_id";
        }
        echo $_where;
        $this->startTrans();
        $state = $this->where($_where)->delete();
        if ($state)
        {
            $this->commit();
            var_dump("commit");
        }
        else
        {
            $this->rollback();
            var_dump("rollback");
        }
        return $state;
    }
    
    public function PointInsert($user_id, $shares=0, $bonus_point=0, $regist_point=0, $re_consume=0, 
                                $universal_point=0, $re_cast=0, $remain_point=0, $blocked_point=0)
    {
        $_pointinfo = array();
        if ($user_id >=0)
        {
            $_pointinfo["ID"] = $user_id;
        }
            
        if ($shares >=0)
        {
            $_pointinfo["shares"] = $shares;
        }
            
        if ($bonus_point >=0)
        {
            $_pointinfo["bonus_point"] = $bonus_point;
        }
           
        if ($regist_point >=0)
        {
            $_pointinfo["regist_point"] = $regist_point;
        }
            
        if ($re_consume >=0)
        {
            $_pointinfo["re_consume"] = $re_consume;
        }
            
        if ($universal_point >=0)
        {
            $_pointinfo["universal_point"] = $universal_point;
        }
           
        if ($re_cast >=0)
        {
            $_pointinfo["re_cast"] = $re_cast;
        }
            
        if ($remain_point >=0)
        {
            $_pointinfo["remain_point"] = $remain_point;
        }
            
        if ($blocked_point >=0)
        {
            $_pointinfo["blocked_point"] = $blocked_point;
        }
            
        $this->startTrans();
        $state = $this->save($_pointinfo);
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
    
    public function PointUpdate($user_id, $shares=0, $bonus_point=0, $regist_point=0, $re_consume=0, 
                                $universal_point=0, $re_cast=0, $remain_point=0, $blocked_point=0)
    {
        $_pointinfo = array();
        if ($user_id >=0)
        {
            $_pointinfo["ID"] = $user_id;
        }
            
        if ($shares >=0)
        {
            $_pointinfo["shares"] = $shares;
        }
            
        if ($bonus_point >=0)
        {
            $_pointinfo["bonus_point"] = $bonus_point;
        }
           
        if ($regist_point >=0)
        {
            $_pointinfo["regist_point"] = $regist_point;
        }
            
        if ($re_consume >=0)
        {
            $_pointinfo["re_consume"] = $re_consume;
        }
            
        if ($universal_point >=0)
        {
            $_pointinfo["universal_point"] = $universal_point;
        }
           
        if ($re_cast >=0)
        {
            $_pointinfo["re_cast"] = $re_cast;
        }
            
        if ($remain_point >=0)
        {
            $_pointinfo["remain_point"] = $remain_point;
        }
            
        if ($blocked_point >=0)
        {
            $_pointinfo["blocked_point"] = $blocked_point;
        }
        $state = $this-> where("ID=$user_id")
        ->setField($_pointinfo);
        return $state;
    }
    
}

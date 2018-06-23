<?php
namespace app\common\model;

use think\Model;

class Subuser_info extends Model
{
    public function index()
    {
        var_dump("Userdetails");
    }
    
    public function SubuserinfoQuery($sub_user_id)//
    {
        $_where = '';
        if ($sub_user_id != -1)
        {
            $_where = "sub_user_id = $sub_user_id";
        }
        $_subuer_info = $this->where($_where)
        ->select();
        $count = count($_subuer_info);
        if ($count < 1)
        {
            var_dump("Subuser.php ID :$sub_user_id not exsist".__LINE__);
            return ;
        }
        return $_subuer_info;
    }
    
    public function SubuserinfoDel($sub_user_id)
    {
        $_where = '';
        if ($sub_user_id > -1)
        {
            $_where = "sub_user_id = $sub_user_id";
        }

        $state = $this->where($_where)->delete();
        
        return $state;
    }
    
    public function SubuserinfoInsert($sub_user_id, $user_id)
    {
        $_subuserinfo = array();
        if ($sub_user_id >=0)
        {
            $_subuserinfo["sub_user_id"] = $sub_user_id;
        }
    
        if ($user_id >=0)
        {
            $_subuserinfo["user_id"] = $user_id;
        }
         
        $state = $this->save($_subuserinfo);
        
        return $state;
    }
    
    public function SubuserinfoUpdate($sub_user_id, $user_id)
    {
        $_subuserinfo = array();
       
        if ($user_id >=0)
        {
            $_subuserinfo["user_id"] = $user_id;
        }
        $state = $this-> where("sub_user_id=$sub_user_id")
        ->setField($_subuserinfo);
        return $state;
    }
}
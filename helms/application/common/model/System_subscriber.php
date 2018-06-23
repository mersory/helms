<?php
namespace app\common\model;

use think\Model;

class System_subscriber extends Model
{
    // 根据用户ID查询所有的角色
    public function SubscriberLoginlQuery($username,$password)
    {
        $where = "";
        if ($password >=0)
        {
            $where = "password = '$password'";
        }
        
        if ($username >=0)
        {
            $where = "$where and username = '$username'";
        }
        
        $where = "$where and lifecycle = 1";
        
        $_subscriber_info = $this-> where($where)->select();
        
        return $_subscriber_info;
    }
    
    // 根据用户ID查询所有的角色
    public function SubscriberQueryMenu($id)
    {
        $sql = "select m.* from helms_system_menu m   where m.id in (select mr.menu_id from helms_system_role_menu_rlat mr where mr.role_id in (select urr.role_id from helms_system_user_role_rlat urr where urr.user_id = '$id'))";
        $_menu_info = $this->query($sql);
        return $_menu_info;
    }
    
    // 根据用户ID查询所有的角色
    public function SubscriberAllQuery()
    {
        $_subscriber_info = $this->select();
        $count = count($_subscriber_info);
        if ($count < 1) {
            var_dump("subscriber info not exsist");
            return;
        }
        return $_subscriber_info;
    }
    
    // 根据用户ID查询所有的角色
    public function SubscriberByRoleIdQuery($roleId)
    {
        $sql = "select m.*,exists(select * from helms_system_role_subscriber_rlat  r where r.subscriber_id = m.id and r.role_id = $roleId) as flag  from helms_system_subscriber m";
        $_subscriber_info = $this->query($sql);
        $count = count($_subscriber_info);
        if ($count < 1) {
            return;
        }
        return $_subscriber_info;
    }
    
    //管理员账号插入
    public function SubscriberInsert($username,$password)
    {
        $_subscriberInfo = array();
        $_subscriberInfo["username"] = $username;
        $_subscriberInfo["password"] = $password;
        $_subscriberInfo["lifecycle"] = 1;
    
        $t=time();
        $_subscriberInfo["create_time"] = date("Y-m-d H:i:s",$t);
    
        $state = $this->save($_subscriberInfo);
       
        return $state;
    }
    
    //修改用户
    public function SubscriberModify($id, $password,$lifecycle)
    {
        $_orderinfo = array();
        $_subscriberInfo["id"] = $id;
        
        if ($password >=0)
        {
            $_subscriberInfo["password"] = $password;
        }

        if ($lifecycle >=0)
        {
            $_subscriberInfo["lifecycle"] = $lifecycle;
        }
    
        $state = $this-> where("id=$id")
        ->setField($_subscriberInfo);
        return $state;
    }
    
}
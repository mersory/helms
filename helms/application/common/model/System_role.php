<?php
namespace app\common\model;

use think\Model;

class System_role extends Model
{
    // 根据用户ID查询所有的角色
    public function RoleAllQuery()
    {
        $_role_info = $this->select();
        $count = count($_role_info);
        if ($count < 1) {
            var_dump("role info not exsist");
            return;
        }
        return $_role_info;
    }
    
    //角色插入
    public function RoleInsert($roleName)
    {
        $_roleInfo = array();
        if ($roleName >=0)
        {
            $_roleInfo["name"] = $roleName;
        }
    
        $t=time();
        $_roleInfo["create_time"] = date("Y-m-d H:i:s",$t);
    
        $this->startTrans();
        $state = $this->save($_roleInfo);
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
    
    //修改角色名
    public function RoleModify($id, $roleName)
    {
        $_orderinfo = array();
        if ($id >=0)
        {
            $_orderinfo["id"] = $id;
        }
        
        if ($roleName >=0)
        {
            $_orderinfo["name"] = $roleName;
        }
    
        $state = $this-> where("id=$id")
        ->setField($_orderinfo);
        return $state;
    }
    
    public function RoleDelete($ID)
    {
        $_where = '';
        if ($ID > 0)
        {
            $_where = "ID = $ID";
        }
        $this->startTrans();
        $state = $this->where($_where)->delete();
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
    
    // 根据用户ID查询所有的角色
    public function RoleQueryByUserId($userId)
    {
        $_where = '';
        if ($userId > 0) {
            $_where = "ID = $userId";
        }
        $_role_info = $this->where($_where)->select();
        $count = count($_role_info);
        if ($count < 1) {
            var_dump("ID :$ID not exsist");
            return;
        }
        return $_role_info;
    }
}
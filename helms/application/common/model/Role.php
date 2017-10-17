<?php
namespace app\common\model;

use think\Model;

class Role extends Model
{
    public function index()
    {
        var_dump("Userdetails");
    }
    
    public function RoleQuery($ID)//还有其他的查找方式，此处只列出这一个
    {
        $_where = '';
        if ($ID > 0)
        {
            $_where = "ID = $ID";
        }
        $_role_info = $this->where($_where)
        ->select();
        $count = count($_role_info);
        if ($count < 1)
        {
            var_dump("ID :$ID not exsist");
            return ;
        }
        return $_role_info;
    }
    
    public function RoleDel($ID)
    {
        $_where = '';
        if ($ID > 0)
        {
            $_where = "ID = $ID";
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
    
    public function RoleInsert($ID, $role_type, $role_name)
    {
        $_role_info = array();
        if ($ID > 0)
        {
            $_role_info["ID"] = $ID;
        }
        if ($role_type > 0)
        {
            $_role_info["role_type"] = $role_type;
        }
        if (strcmp("$role_name", "") != 0)
        {
            $_role_info["role_name"] = $role_name;
        }
        $this->startTrans();
        $state = $this->save($_role_info);
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
    
    public function RoleUpdate($ID, $role_type, $role_name)
    {
        $_role_info = array();
        if ($role_type > 0)
        {
            $_role_info["role_type"] = $role_type;
        }
        if (strcmp("$role_name", "") != 0)
        {
            $_role_info["role_name"] = $role_name;
        }
        $state = $this-> where("ID=$ID")
        ->setField($_role_info);
        return $state;
    }
}
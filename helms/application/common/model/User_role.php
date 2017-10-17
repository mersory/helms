<?php
namespace app\common\model;

use think\Model;

class User_role extends Model
{
    public function index()
    {
        var_dump("Usertorole");
    }
    
    public function RoleQuery($user_id)
    {
        $_where = '';
        if ($user_id != -1)
        {
            $_where = "user_id = $user_id";
        }
        $_role_info = $this->where($_where)
        ->select();
        $count = count($_role_info);
        if ($count < 1)
        {
            var_dump("id :$user_id not exsist");
            return ;
        }
        return $_role_info;
    }
    
    public function RoleDel($user_id)
    {
        $_where = '';
        if ($user_id != -1)
        {
            $_where = "user_id = $user_id";
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
    
    public function RoleInsert($user_id, $role_id = 0)
    {
        $_userinfo = array('user_id'=>$user_id,'role_id' => $role_id);
        $this->startTrans();
        $state = $this->save($_userinfo);
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
    
    public function RoleUpdate($user_id, $role_id)
    {
        $data = array('role_id'=>"$role_id");
        $state = $this-> where("user_id=$user_id")
        ->setField($data);
        return $state;
    }
        
}

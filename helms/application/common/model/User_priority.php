<?php
namespace app\common\model;

use think\Model;

class User_priority extends Model
{
    public function index()
    {
        var_dump("Usertopriority");
    }
    
    public function PriorityQuery($user_id)
    {
        $_where = '';
        if ($user_id != -1)
        {
            $_where = "user_id = '$user_id'";
        }
        $_priority_info = $this->where($_where)
        ->select();
        $count = count($_priority_info);
        if ($count < 1)
        {
            var_dump("id :$user_id not exsist");
            return ;
        }
        return $_priority_info;
    }
    
    public function PriorityDel($user_id)
    {
        $_where = '';
        if ($user_id != -1)
        {
            $_where = "user_id = '$user_id'";
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
    
    public function PriorityInsert($user_id, $priority_id = 1)
    {
        $_userinfo = array('user_id'=>$user_id,'priority_id' => $priority_id);
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
    
    public function PriorityUpdate($user_id, $priority_id)
    {
        $data = array("priority_id"=>"$priority_id");
        $state = $this-> where("user_id=$user_id")
        ->setField($data);
        return $state;
    }
    
}

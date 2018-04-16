<?php
namespace app\common\model;

use think\Model;

class Priority extends Model
{
    public function index()
    {
        var_dump("Userdetails");
    }
    
    public function PriorityQuery($ID)//���������Ĳ��ҷ�ʽ���˴�ֻ�г���һ��
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
            var_dump("Priority.php ID :$ID not exsist".__LINE__);
            return ;
        }
        return $_role_info;
    }
    
    public function PriorityDel($ID)
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
    
    public function PriorityInsert($ID, $priority_link, $link_type, $to_intercept)
    {
        $_priority_info = array();
        if ($ID > 0)
        {
            $_priority_info["ID"] = $ID;
        }
        if ($link_type > 0)
        {
            $_priority_info["link_type"] = $link_type;
        }
        if (strcmp("$priority_link", "") != 0)
        {
            $_priority_info["priority_link"] = $priority_link;
        }
        if ($to_intercept > 0)
        {
            $_priority_info["to_intercept"] = $to_intercept;
        }
        $this->startTrans();
        $state = $this->save($_priority_info);
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
    
    public function PriorityUpdate($ID, $priority_link, $link_type, $to_intercept)
    {
        $_priority_info = array();
        if ($link_type > 0)
        {
            $_priority_info["link_type"] = $link_type;
        }
        if (strcmp("$priority_link", "") != 0)
        {
            $_priority_info["priority_link"] = $priority_link;
        }
        if ($to_intercept > 0)
        {
            $_priority_info["to_intercept"] = $to_intercept;
        }
        $state = $this-> where("ID=$ID")
        ->setField($_priority_info);
        return $state;
    }
}
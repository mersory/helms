<?php
namespace app\common\model;

use think\Model;

class Positionality extends Model
{
    public function index()
    {
        var_dump("Userdetails");
    }
    
    public function PositionQuery($ID)//查看当前用户的网络结构
    {
        $_where = '';
        if ($ID > 0)
        {
            $_where = "ID = $ID";
        }
        $_position_info = $this->where($_where)
        ->select();
        $count = count($_position_info);
        if ($count < 1)
        {
            return ;
        }
        return $_position_info;
    }
    
    public function PositionDel($ID)
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
    
    public function PositionInsert($ID, $json)
    {
        $_positioninfo = array();
        if ($ID > 0)
        {
            $_positioninfo["ID"] = $ID;
        }
    
        if ($json > 0)
        {
            $_positioninfo["json"] = $json;
        }
        $this->startTrans();
        $state = $this->save($_positioninfo);
        if ($state)
        {
            $this->commit();
            var_dump("Details insert commit");
        }
        else
        {
            $this->rollback();
            var_dump("Details insert rollback");
        }
        return $state;
    }
    
    public function PositionUpdate($ID, $json)
    {
        $_positioninfo = array();
        if ($json > 0)
        {
            $_positioninfo["json"] = $json;
        }
        $state = $this-> where("ID=$ID")
        ->setField($_positioninfo);
        return $state;
    }
}
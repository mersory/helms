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
    
    public function PositionChildByJson($str)//查看当前用户的网络结构
    {
        $_where = '';
        if (strcmp($str, ""))
        {
            // $_where = "locate('$str', json) > 0";
            $_where = "json like '%$str'";
        }
        $_position_info = $this->where($_where)
        ->select();
        $count = count($_position_info);
        if ($count < 1)
        {
            return ;
        }
        else 
        {
            while($count)
            {
                $_res[$count - 1] = $_position_info[$count-1]["json"];
                $count--;
            }
        }
         return $_res;
    }
    
    public function PositionQueryByJson($str)//查看当前用户的网络结构
    {
        $_where = '';
        if (strcmp($str, ""))
        {
           // $_where = "locate('$str', json) > 0";
            $_where = "json like '%$str'";
        }
        $_position_info = $this->where($_where)
        ->select();
        $count = count($_position_info);
        if ($count < 1)
        {
            return ;
        }
        return $_position_info[0]["json"];
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
    
    public function PositionInsertPrev($parent)
    {
        $_positioninfo = array();
        if ($parent > 0)
        {
            $_positioninfo["parent"] = $parent;
        }
        $_res = $this->PositionQuery($parent);
        if (count($_res) == 1)
        {
            $_json = $_res[0]["json"];
            $_curjson = $this->PositionQueryByJson($parent);
            $_left=0;
            if(!strcmp($_curjson, ""))
            {
                $_json = "$_json-$parent";//如果当前不存在，则通过字符串拼接形参新的路径
                $_left = 1;
            }
            else 
                $_json  = $_curjson;
        }
        return $this->PositionInsert(100048, $_json, $parent, $_left);
    }
    
    public function PositionInsert($user_id, $json, $parent, $leftchild)
    {
        $_positioninfo = array();
        if ($user_id > 0)
        {
            $_positioninfo["user_id"] = $user_id;
        }
        if ($json > 0)
        {
            $_positioninfo["json"] = $json;
        }
        if ($parent > 0)
        {
            $_positioninfo["parent"] = $parent;
        }
        if ($parent > 0)
        {
            $_positioninfo["leftchild"] = $leftchild;
        }
        $this->startTrans();
        $state = $this->save($_positioninfo);
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
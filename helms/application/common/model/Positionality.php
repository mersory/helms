<?php
namespace app\common\model;

use think\Model;
use phpDocumentor\Reflection\Types\String_;

class Positionality extends Model
{
    public function index()
    {
        var_dump("Userdetails");
    }
    
    public function PositionQuery($user_id)//查看当前用户的网络结构
    {
        $_where = '';
        if ($user_id > 0)
        {
            $_where = "user_id = $user_id";
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
    
    public function PositionChildByJson($str)//查看当前节点的直系孩子节点,返回用户ID号和在位置表中的对应的编号1，2，3，4，5
    {
        $_where = '';
        if (strcmp($str, ""))
        {
            // $_where = "locate('$str', json) > 0";
            $_where = "json like '%$str'";
        }
        else 
            return;
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
                $_res[$_position_info[$count-1]["user_id"]] = $_position_info[$count-1]["ID"];
                $count--;
            }
        }
         return $_res;
    }
    
    public function getUserIdByID($ID)
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
        return $_position_info[0]["user_id"];
    }
    
    public function getAllChildByJson($str)//查看当前节点的所有孩子节点，包括多次派生的孩子，返回用户id和json子串
    {
        $_where = '';
        if ($str > -1)
        {
            $_where = "json like '%$str%'";
        }
        else
            return;
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
                $_res[$_position_info[$count-1]["user_id"]]["json"] = $_position_info[$count-1]["json"];
                $parentID = $this->getUserIdByID($_position_info[$count-1]["parent"]);
                $_res[$_position_info[$count-1]["user_id"]]["parent"] = $parentID;
                $_res[$_position_info[$count-1]["user_id"]]["left"] = $_position_info[$count-1]["leftchild"];
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
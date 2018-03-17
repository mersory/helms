<?php
namespace app\common\model;

use think\Model;

class Gp_onsale extends Model
{
    public function index()
    {
        var_dump("gponsale");
    }
    
    public function GponsaleQuery($id)//
    {
        $_where = '';
        if (strcmp("$id", ""))
        {
            $_where = "ID = '$id'";
        }
        $_award_info = $this->where($_where)
        ->select();
        $count = count($_award_info);
        if ($count < 1)
        {
            var_dump("ID :$id not exsist");
            return ;
        }
        return $_award_info;
    }
    
    public function GponsaleQueryByStatus($status = 1)//
    {
        $_where = '';
        if ($status > 0)
        {
            $_where = "status = $status";
        }
        $_award_info = $this->where($_where)
        ->select();
        $count = count($_award_info);
        if ($count < 1)
        {
            var_dump("status :$status not exsist");
            return ;
        }
        return $_award_info[0];
    }
    
    public function GponsaleDel($id)
    {
        $_where = '';
        if (strcmp("$id", ""))
        {
            $_where = "ID = '$id'";
        }
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
    
    public function GponsaleInsert($sprice=0, $snums=0, $ok_nums=0, $get_money=0, $status=1, $sy_nums = -1)
    {
        $_record = array();
        
        $_record["sprice"] = $sprice;
   
        $_record["snums"] = $snums;

        $_record["ok_nums"] = $ok_nums;
        
        $_record["get_money"] = $get_money;
    
        $_record["ctime"] = date("Y-m-d H:i:s");
        
        $_record["status"] = $status;
        
        $_record["uptime"] = date("Y-m-d H:i:s");
        
        $_record["sy_nums"] = $sy_nums;
        
        $this->startTrans();
        $state = $this->save($_record);
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
    
    public function GponsaleUpdate($id=1, $sprice=-1, $snums=-1, $ok_nums=-1, $get_money=-1, $status=-1, $sy_nums=-1)
    {
        $_detailsinfo = array();
    
        if ($sprice >=0)
        {
            $_detailsinfo["sprice"] = $sprice;
        }
    
        if ($snums >=0)
        {
            $_detailsinfo["snums"] = $snums;
        }
         
        if ($ok_nums >=0)
        {
            $_detailsinfo["ok_nums"] = $ok_nums;
        }
    
        if ($get_money >=0)
        {
            $_detailsinfo["get_money"] = $get_money;
        }
        
        if ($status >=0)
        {
            $_detailsinfo["status"] = $status;
        }
        
        if ($sy_nums >=0)
        {
            $_detailsinfo["sy_nums"] = $sy_nums;
        }
         
        $state = $this-> where("AUTO_ID=$id")
        ->setField($_detailsinfo);
        return $state;
    }
    
    public function GponsaleChangeStatus($status=-1)
    {
        $_detailsinfo = array();
    
        if ($status >=0)
        {
            $_detailsinfo["status"] = $status;
        }
         
        $state = $this-> where("status=1")
        ->setField($_detailsinfo);
        return $state;
    }
    
}
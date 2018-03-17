<?php
namespace app\common\model;

use think\Model;

class Gp_set extends Model
{
    public function index()
    {
        var_dump("gpset");
    }
    
    public function GpSetQuery($id=1)
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
    
    public function GpSetUpdate($qishu=-1, $cur_price=-1, $gp_qfhl=-1, $s_isopen=-1)
    {
        $_detailsinfo = array();
    
        if ($qishu >=0)
        {
            $_detailsinfo["qishu"] = $qishu;
        }
    
        if ($cur_price >=0)
        {
            $_detailsinfo["now_price"] = $cur_price;
        }
         
        if ($gp_qfhl >=0)
        {
            $_detailsinfo["gp_qfhl"] = $gp_qfhl;
        }
    
        if ($s_isopen >=0)
        {
            $_detailsinfo["s_isopen"] = $s_isopen;
        }
       
        $state = $this-> where("ID=1")
        ->setField($_detailsinfo);
        return $state;
    }


    
}
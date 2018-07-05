<?php
namespace app\common\model;

use think\Model;
use think\Session;


class Recharge_record extends Model
{
    public function index()
    {
        var_dump("recharge");
    }

    public function RechargeQuery($userid = -1)//if userid=-1,it means query all records
    {
        $_where = '';
        if ($userid != -1)
        {
            $_where = "`user_id` = '$userid'";  //
        }
        else 
        {
            $_where = "`user_id` != -1";
        }

        $_recharge = $this->where($_where)
        ->select();
        $count = count($_recharge);
        if ($count < 1)
        {
            return ;
        }

        return $_recharge;
    }

    public function RechargeQueryWithLimit($userid,$_pagesize=25, $_pageindex=0)
    {
        $_session_user = Session::get(USER_SEESION);
        $_resdata = array();
        if(empty($_session_user)){
            return ;
        }
        else
        {
            if ($userid != -1)
            {
                $_where = "`user_id` = '$userid'";  //
            }
            else 
            {
                $_where = "`user_id` != -1";
            }
    
            $_recharge = $this->order("cz_time desc")
                        ->limit($_pagesize * $_pageindex, $_pagesize)->where($_where)
                        ->select();
            $count = count($_recharge);
            if ($count < 1)
            {
                var_dump("Realtime.php ID : not exsist".__LINE__);
                return ;
            }
    
            return $_recharge;
        }
    }
    
    public function RechargeInsert($user_id, $cz_money=-1, $cz_type=-1, $content=-1, $status=-1, $real_name=-1, $cz_instruction=-1, $czyt_type=-1)
    {
        //var_dump("updateJiangjin");
        $_session_user = Session::get(USER_SEESION);
        $_resdata = array();
        if(empty($_session_user)){
            return 0;
        }else{
            $_rechargeinfo = array();
            if ($user_id > -1)
            {
                $_rechargeinfo["user_id"] = $user_id;
            }
            
            if ($cz_money > -1)
            {
                $_rechargeinfo["cz_money"] = $cz_money;
            }
            if ($cz_money > -1)
            {
                $_rechargeinfo["hk_money"] = $cz_money;
            }
            
            if ($cz_type > -1)
            {
                $_rechargeinfo["cz_type"] = $cz_type;
            }
            
            if ($content > -1)
            {
                $_rechargeinfo["content"] = $content;
            }
            
            if ($status > -1)
            {
                $_rechargeinfo["status"] = $status;
            }
            
            if ($real_name > -1)
            {
                $_rechargeinfo["real_name"] = $real_name;
            }
            
            if ($cz_instruction > -1)
            {
                $_rechargeinfo["cz_instruction"] = $cz_instruction;
            }
            
            if ($czyt_type > -1)
            {
                $_rechargeinfo["czyt_type"] = $czyt_type;
            }
            
            $_rechargeinfo["cz_time"] = date("Y-m-d H:i:s");
            $_rechargeinfo["ok_time"] = date("Y-m-d H:i:s");
            $_rechargeinfo["ctime"] = date("Y-m-d H:i:s");
            
            $state = $this->save($_rechargeinfo);
            
            return $state;
        }
        
        
    }
    

}
<?php
namespace app\frontend\controller;

use think\Controller;
use app\common\model\User_info;
use app\common\model\User_role;
use app\common\model\User_bankinfo;
use app\common\model\User_details;
use app\common\model\User_point;
use app\common\model\User_priority;
use think\Request;
use app\common\model\Userupgrade_record;
use app\common\model\Withdrawal_record;
use app\common\model\Offline_deal;
use app\common\model\Realtime_price;
use app\common\model\Historical_price;
use app\common\model\Subuser_info;
use think\Session;
use app\common\model\Role;
use app\common\model\Positionality;
use app\frontend\controller\Basecontroller;

class Common extends Basecontroller
{
    public function index()
    {
        $_session_user = Session::get(USER_SEESION);
        if(empty($_session_user)){
            return $this->redirect("/login/login/index");
        }else{
            $_user_id = $_session_user["userId"];
            $_role_id = $_session_user["roleId"];
            
            $_user = new User_details();
            $_res = $_user->DetailsQuery($_user_id);
            if (count($_res) == 1)
            {
                $_session_user["userName"] = $_res[0]["user_name"];
                $_session_user["email"] = $_res[0]["email"];
                $_session_user["userLevel"] = $_res[0]["user_level"];
            }
            
            $_role = new Role();
            $_res = $_role->RoleQuery($_role_id);
            if (count($_res) == 1)
            {
                $_session_user["role_type"] = $_res[0]["role_type"];
            }
            
            //更新session
            Session::set(USER_SEESION,$_session_user);
            
            $_resdata = array();
            $_user = new User_bankinfo();
            $_res = $_user->BankinfoQuery($_user_id);
            if (count($_res) == 1)
            {
                $_resdata["bank_name"] = $_res[0]["bank_name"];
                $_resdata["bank_account_name"] = $_res[0]["bank_account_name"];
                $_resdata["bank_account_num"] = $_res[0]["bank_account_num"];
                $_resdata["reserve1"] = $_res[0]["reserve1"];
            }
            
            $_user = new User_point();
            $_res = $_user->PointQuery($_user_id);
            if (count($_res) == 1)
            {
                $_resdata["shares"] = $_res[0]["shares"];
                $_resdata["bonus_point"] = $_res[0]["bonus_point"];
                $_resdata["regist_point"] = $_res[0]["regist_point"];
				$_resdata["re_consume"] = $_res[0]["re_consume"];
                $_resdata["universal_point"] = $_res[0]["universal_point"];
                $_resdata["re_cast"] = $_res[0]["re_cast"];
            }
            
            $_user = new User_priority();
            $_res = $_user->PriorityQuery($_user_id);
            if (count($_res) == 1)
            {
                $_resdata["priority_id"] = $_res[0]["priority_id"];
            }
            
            $this->assign('pass_data', $_resdata);//真正传递的是前面那个变量，这也是html中可以使用的
            
            // 取回打包后的数据
            $htmls = $this->fetch();
            return $htmls;
            
        }
    }
    
    
    public function news()
    {
        $_session_user = Session::get(USER_SEESION);
        if(empty($_session_user)){
            return $this->redirect("/login/login/index");
        }else{
            $_user_id = $_session_user["userId"];
            $_role_id = $_session_user["roleId"];
    
            $_user = new User_details();
            $_res = $_user->DetailsQuery($_user_id);
            if (count($_res) == 1)
            {
                $_session_user["userName"] = $_res[0]["user_name"];
                $_session_user["email"] = $_res[0]["email"];
                $_session_user["userLevel"] = $_res[0]["user_level"];
            }
    
            $_role = new Role();
            $_res = $_role->RoleQuery($_role_id);
            if (count($_res) == 1)
            {
                $_session_user["role_type"] = $_res[0]["role_type"];
            }
    
            //更新session
            Session::set(USER_SEESION,$_session_user);
    
            $_resdata = array();
            $_user = new User_bankinfo();
            $_res = $_user->BankinfoQuery($_user_id);
            if (count($_res) == 1)
            {
                $_resdata["bank_name"] = $_res[0]["bank_name"];
                $_resdata["bank_account_name"] = $_res[0]["bank_account_name"];
                $_resdata["bank_account_num"] = $_res[0]["bank_account_num"];
                $_resdata["reserve1"] = $_res[0]["reserve1"];
            }
    
            $_user = new User_point();
            $_res = $_user->PointQuery($_user_id);
            if (count($_res) == 1)
            {
                $_resdata["shares"] = $_res[0]["shares"];
                $_resdata["bonus_point"] = $_res[0]["bonus_point"];
                $_resdata["regist_point"] = $_res[0]["regist_point"];
            }
    
            $_user = new User_priority();
            $_res = $_user->PriorityQuery($_user_id);
            if (count($_res) == 1)
            {
                $_resdata["priority_id"] = $_res[0]["priority_id"];
            }
    
            $this->assign('pass_data', $_resdata);//真正传递的是前面那个变量，这也是html中可以使用的
    
            // 取回打包后的数据
            $htmls = $this->fetch();
            return $htmls;
    
        }
    }
    
    public function network()
    {
        $_session_user = Session::get(USER_SEESION);
        if(empty($_session_user)){
            return $this->redirect("/login/login/index");
        }else{
            $_user_id = $_session_user["userId"];
            $_role_id = $_session_user["roleId"];
    
            $_user = new User_details();
            $_res = $_user->DetailsQuery($_user_id);
            if (count($_res) == 1)
            {
                $_session_user["userName"] = $_res[0]["user_name"];
                $_session_user["email"] = $_res[0]["email"];
                $_session_user["userLevel"] = $_res[0]["user_level"];
            }
    
            $_role = new Role();
            $_res = $_role->RoleQuery($_role_id);
            if (count($_res) == 1)
            {
                $_session_user["role_type"] = $_res[0]["role_type"];
            }
    
            //更新session
            Session::set(USER_SEESION,$_session_user);
    
            $_resdata = array();
            $_user = new User_bankinfo();
            $_res = $_user->BankinfoQuery($_user_id);
            if (count($_res) == 1)
            {
                $_resdata["bank_name"] = $_res[0]["bank_name"];
                $_resdata["bank_account_name"] = $_res[0]["bank_account_name"];
                $_resdata["bank_account_num"] = $_res[0]["bank_account_num"];
                $_resdata["reserve1"] = $_res[0]["reserve1"];
            }
    
            $_user = new User_point();
            $_res = $_user->PointQuery($_user_id);
            if (count($_res) == 1)
            {
                $_resdata["shares"] = $_res[0]["shares"];
                $_resdata["bonus_point"] = $_res[0]["bonus_point"];
                $_resdata["regist_point"] = $_res[0]["regist_point"];
            }
    
            $_user = new User_priority();
            $_res = $_user->PriorityQuery($_user_id);
            if (count($_res) == 1)
            {
                $_resdata["priority_id"] = $_res[0]["priority_id"];
            }
    
            $this->assign('pass_data', $_resdata);//真正传递的是前面那个变量，这也是html中可以使用的
    
            // 取回打包后的数据
            $htmls = $this->fetch();
            return $htmls;
        }
        }
        
	public function introduce()
    {
        $_session_user = Session::get(USER_SEESION);
        if(empty($_session_user)){
            return $this->redirect("/login/login/index");
        }else{
            $_user_id = $_session_user["userId"];
            $_role_id = $_session_user["roleId"];
    
            $_user = new User_details();
            $_res = $_user->DetailsQuery($_user_id);
            if (count($_res) == 1)
            {
                $_session_user["userName"] = $_res[0]["user_name"];
                $_session_user["email"] = $_res[0]["email"];
                $_session_user["userLevel"] = $_res[0]["user_level"];
            }
    
            $_role = new Role();
            $_res = $_role->RoleQuery($_role_id);
            if (count($_res) == 1)
            {
                $_session_user["role_type"] = $_res[0]["role_type"];
            }
    
            //更新session
            Session::set(USER_SEESION,$_session_user);
    
            $_resdata = array();
            $_user = new User_bankinfo();
            $_res = $_user->BankinfoQuery($_user_id);
            if (count($_res) == 1)
            {
                $_resdata["bank_name"] = $_res[0]["bank_name"];
                $_resdata["bank_account_name"] = $_res[0]["bank_account_name"];
                $_resdata["bank_account_num"] = $_res[0]["bank_account_num"];
                $_resdata["reserve1"] = $_res[0]["reserve1"];
            }
    
            $_user = new User_point();
            $_res = $_user->PointQuery($_user_id);
            if (count($_res) == 1)
            {
                $_resdata["shares"] = $_res[0]["shares"];
                $_resdata["bonus_point"] = $_res[0]["bonus_point"];
                $_resdata["regist_point"] = $_res[0]["regist_point"];
            }
    
            $_user = new User_priority();
            $_res = $_user->PriorityQuery($_user_id);
            if (count($_res) == 1)
            {
                $_resdata["priority_id"] = $_res[0]["priority_id"];
            }
    
            $this->assign('pass_data', $_resdata);//真正传递的是前面那个变量，这也是html中可以使用的
    
            // 取回打包后的数据
            $htmls = $this->fetch();
            return $htmls;
        }
    }
		
		
        public function points()
        {
            $_session_user = Session::get(USER_SEESION);
            if(empty($_session_user)){
                return $this->redirect("/login/login/index");
            }else{
                $_user_id = $_session_user["userId"];
                $_role_id = $_session_user["roleId"];
        
                $_user = new User_details();
                $_res = $_user->DetailsQuery($_user_id);
                if (count($_res) == 1)
                {
                    $_session_user["userName"] = $_res[0]["user_name"];
                    $_session_user["email"] = $_res[0]["email"];
                    $_session_user["userLevel"] = $_res[0]["user_level"];
                }
        
                $_role = new Role();
                $_res = $_role->RoleQuery($_role_id);
                if (count($_res) == 1)
                {
                    $_session_user["role_type"] = $_res[0]["role_type"];
                }
        
                //更新session
                Session::set(USER_SEESION,$_session_user);
        
                $_resdata = array();
                $_user = new User_bankinfo();
                $_res = $_user->BankinfoQuery($_user_id);
                if (count($_res) == 1)
                {
                    $_resdata["bank_name"] = $_res[0]["bank_name"];
                    $_resdata["bank_account_name"] = $_res[0]["bank_account_name"];
                    $_resdata["bank_account_num"] = $_res[0]["bank_account_num"];
                    $_resdata["reserve1"] = $_res[0]["reserve1"];
                }
        
                $_user = new User_point();
                $_res = $_user->PointQuery($_user_id);
                if (count($_res) == 1)
                {
                    $_resdata["shares"] = $_res[0]["shares"];
                    $_resdata["bonus_point"] = $_res[0]["bonus_point"];
                    $_resdata["regist_point"] = $_res[0]["regist_point"];
                }
        
                $_user = new User_priority();
                $_res = $_user->PriorityQuery($_user_id);
                if (count($_res) == 1)
                {
                    $_resdata["priority_id"] = $_res[0]["priority_id"];
                }
        
                $this->assign('pass_data', $_resdata);//真正传递的是前面那个变量，这也是html中可以使用的
        
                // 取回打包后的数据
                $htmls = $this->fetch();
                return $htmls;
         }
    }
    public function test_func($time)
    {
        $_user = new Historical_price();
        $_res = $_user->HistoricalpriceQuery($time);
        for($i= 0; $i<count($_res); $i++)
        {
            var_dump($_res[$i]["current_time"]);
            var_dump($_res[$i]["share_price"]);
        }
        return $_res;
    }
    
    public function get_history_price($from, $to)
    {
        $_resdata = array();
        $_resdata["info"] = "no";
        $is_date = parent::isDatetime($from);
        if(!$is_date)
            return json_encode($_resdata);
        $is_date = parent::isDatetime($to);
        if(!$is_date)
            return json_encode($_resdata);
        $_user = new Historical_price();
        $_res = $_user->HistoricalpriceQueryByTiem($from, $to);        
        $_tmp = array();
        if(count($_res) > 0)
        {
            $_resdata["info"] = "ok";
            for($i= 0; $i<count($_res); $i++)
            {
                $_res[$i]["current_time"] = substr($_res[$i]["current_time"], 0, 10);
                $_tmp[ $_res[$i]["current_time"] ] = $_res[$i]["share_price"];
            }
            $_resdata['res'] = $_tmp;
        }
        return json_encode($_resdata);
    }
    
    public function get_net_topology($userid)
    {
        $_resdata = array();
        $_resdata["info"] = "no";
        if( parent::include_special_characters($userid) )//包含特殊字符则返回true，不包含则返回false
        {
            return json_encode($_resdata);
        }
        $_user = new Positionality();
        $_res = $_user->PositionQuery($userid);
        if(count($_res) > 0)
        { 
            $tmp["parent"] = $_res[0]["parent"];
            $tmp["json"] = $_res[0]["json"];
            $_resdata["info"] = "ok";
            $_resdata['res'] = $tmp;
        }
        return json_encode($_resdata);
    }
    
    public function add_net_topology($parent)
    {
        if(parent::include_special_characters($parent))
            return false;
        $_user = new Positionality();
        //$_res = $_user->PositionInsertPrev($parent);   //这两行用于完成新建网络结构
        //return _res;
        $_res = $_user->PositionChildByJson($parent);    //这两行用于打开当前节点，展示所有孩子节点
        var_dump($_res) ;
    }
    
}
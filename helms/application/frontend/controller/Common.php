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
use app\common\model\Deal_info;

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
    
    //返回当前用户userid对应的json值，父节点的编号
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
    
    //根据提供的用户userid，查找用户userID的子孙节点的json，编号，parent的userid，左区性质，真实姓名
    public function get_all_children($userId)
    {
        $_resdata = array();
        $_resdata["info"] = "no";
        if(parent::include_special_characters($userId))
            return json_encode($_resdata) ;
        $_user = new Positionality();
        $_curid = $_user->PositionQuery($userId);
        $_userinfo =new User_details();
        if(count($_curid) < 1)
            return json_encode($_resdata) ;
        else 
        {
            $_resdata["info"] = "ok";
            $parent = $_curid[0]["ID"];//
            $_res = $_user->getAllChildByJson($parent);
            $_res[$_curid[0]["user_id"]]["currentId"] = $_curid[0]["user_id"];
            $_res[$_curid[0]["user_id"]]["childrenId"] = $_user->getDirectChildrenByJson($_curid[0]["ID"]);
            $_res[$_curid[0]["user_id"]]["ID"] = $_curid[0]["ID"];
            $_res[$_curid[0]["user_id"]]["json"] = $_curid[0]["json"];
            $_res[$_curid[0]["user_id"]]["parent"] = $_curid[0]["parent"];
            $_res[$_curid[0]["user_id"]]["left"] = $_curid[0]["leftchild"];
            $_user_realname = $_userinfo->DetailsQuery($_curid[0]["user_id"]);
            $_user_realname = $_user_realname[0]["user_name"];
            $_res[$_curid[0]["user_id"]]["realname"] = $_user_realname;
            $_keys = array_keys($_res);
            $_values = array_values($_res);
            for($i=0; $i<count($_res); $i++)
            {
                $_user_realname = $_userinfo->DetailsQuery($_keys[$i]);
                $_user_realname = $_user_realname[0]["user_name"];
                $_res[$_keys[$i]]["realname"] = $_user_realname;
            }
            $_resdata["res"] = $_res;
           return json_encode($_resdata) ;
        }
    }
    
    
    public function add_net_topology($parent)
    {
        if(parent::include_special_characters($parent))
            return false;
        $_user = new Positionality();
        //$_res = $_user->PositionInsertPrev($parent);   //这两行用于完成新建网络结构
        //return _res;
        $_res = $_user->PositionChildByJson($parent);    //这两行用于打开当前节点，展示所有孩子节点
        return json_encode($_res) ;
    }
    
    //获取当前用户$userId的推荐结构
    public function get_introducer_tree($userId)
    {
        $_resdata = array();
        $_resdata["info"] = "no";
        //即使是错误的返回也必须先转化为约定的json格式，否则会出错
        if(parent::include_special_characters($userId))
            return json_encode($_resdata) ;
        //此处必须要用不同的变量去获取不同类的对象
        $_user_info = new User_info();
        $_res1 = $_user_info->UserSearch($userId, "", "", "", "", "");
        if(!empty($_res1))
        {
            $_resdata["info"] = "ok";
            $tmp[$_res1[0]["ID"]]["user_id"] = $_res1[0]["username"];
            $tmp[$_res1[0]["ID"]]["username"] = $_res1[0]["username"];
            $tmp[$_res1[0]["ID"]]["user_name"] = $_res1[0]["user_name"];
            $_resdata["res"] = $tmp;
        }
        else 
            return json_encode($_resdata) ;
        //此处必须要用不同的变量去获取不同类的对象
        $_user = new User_details();
        $_res = $_user->RecommanderQuery($userId);
        if(count($_res) < 1)
        {
            $tmp[$_res1[0]["ID"]]["has_recommand"] = 0;
            return json_encode($_resdata) ;
        }
        else 
        {
            $_resdata["info"] = "ok";
            $tmp[$_res1[0]["ID"]]["has_recommand"] = 1;
            for($i=0; $i<count($_res); $i++)
            {
                $tmp[$_res[$i]["ID"]]["user_id"] = $_res[$i]["ID"];
                $tmp[$_res[$i]["ID"]]["user_name"] = $_res[$i]["user_name"];
                $tmp[$_res[$i]["ID"]]["has_recommand"] = $_user->HasRecommander($_res[$i]["ID"]);
                
                //相同类产生的对象可以用相同的变量去获取
                $_user_info = new User_info();
                $_res_tmp = $_user_info->UserSearch($_res[$i]["ID"], "", "", "", "", "");
                if(count($_res_tmp) == 1)
                {
                    $tmp[$_res[$i]["ID"]]["username"] = $_res_tmp[0]["username"];
                }
                else 
                {
                    $tmp[$_res[$i]["ID"]]["username"] = "not invalid";
                }
            }
             $_resdata["res"] = $tmp;
        }
        return json_encode($_resdata) ;
    }
    
    
    /*//本函数已经弃用
    public function get_fivelevel_topology($user_id)
    {
        $_resdata = array();
        $_resdata["info"] = "no";
        if(parent::include_special_characters($user_id))
            return $_resdata;
        $_user = new Positionality();
        $_curid = $_user->PositionQuery($user_id);
        if(count($_curid) < 1)
            var_dump($_resdata) ;
        else 
        {
            $_resdata["info"] = "no";
            $parent = $_curid[0]["ID"];
            $_res = $_user->PositionChildByJson($parent);    //这两行用于打开当前节点，展示所有孩子节点
            echo "first level:";
            var_dump($_res);
            echo "\n";
            for($i=0; $i<count($_res); $i++)
            {
                $_curid = array_values($_res);
                if(strcmp($_curid[$i], ""))
                    $_res_2[$i] = $_user->PositionChildByJson($_curid[$i]);
            }
            echo "second level:";
            var_dump($_res_2);
            echo "\n";
            for($i=0; $i<count($_res_2); $i++)
            {
                $_curid = array_values($_res_2);
                if(strcmp($_curid[$i], ""))
                    $_res_3[$i] = $_user->PositionChildByJson($_curid[$i]);
            }
            echo "third level:";
            var_dump($_res_3);
            echo "\n";
            for($i=0; $i<count($_res_3); $i++)
            {
                $_curid = array_values($_res_3);
                if(strcmp($_curid[$i], ""))
                    $_res_4[$i] = $_user->PositionChildByJson($_curid[$i]);
            }
            echo "fourth level:";
            var_dump($_res_4);
            echo "\n";
            for($i=0; $i<count($_res_4); $i++)
            {
                $_curid = array_values($_res_4);
                if(strcmp($_curid[$i], ""))
                    $_res_5[$i] = $_user->PositionChildByJson($_curid[$i]);
            }
            echo "fifth level:";
            var_dump($_res_5);
            echo "\n";
        }
    }
    */
}













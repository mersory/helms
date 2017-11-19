<?php
namespace app\backend\controller;

use think\Controller;
use app\common\model\User_info;
use app\common\model\User_role;
use app\common\model\User_bankinfo;
use app\common\model\User_details;
use app\common\model\User_point;
use app\common\model\User_priority;
use app\common\model\Point_transform_record;
use think\Request;
use app\common\model\Userupgrade_record;
use app\common\model\Withdrawal_record;
use app\common\model\Offline_deal;
use app\common\model\Realtime_price;
use app\common\model\Historical_price;
use app\common\model\Subuser_info;
use think\Session;
use app\common\model\Role;
use app\common\model\Income_expenditure;

class Common extends Controller
{
    public function check_special_characters($input)
    {
        if(preg_match("/[\'.,:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$input)){
            return true;      //echo "包含特殊字符";
        } else 
            return false;
    }
    
    public function check_numeric($input)
    {
        if(preg_match("/^[0-9]+$/",$input)){
            return true;      //echo "包含特殊字符";
        } else
            return false;
    }
    
    public function check_charactor($input)
    {
        if(preg_match("/^[a-zA-Z]+$/",$input)){
            return true;      //echo "包含特殊字符";
        } else
            return false;
    }
    
    public function check_normal($input)
    {
        if(preg_match("/^[0-9a-zA-Z\_]+$/",$input)){
            return true;      //echo "包含特殊字符";
        } else
            return false;
    }
    
    public function check_telphone($input)
    {
        $search = '/^0?1[3|4|5|6|7|8][0-9]\d{8}+$/';
        if ( preg_match( $search, $input ) ) {
            return true;
        } else {
            return false;
        }
    }
    
    public function check_email($input)
    {
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$input)) {
            return true;      //echo "包含特殊字符";
        } else
            return false;
    }
    
    //初始化UI
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
            
            $this->assign('pass_data', $_resdata);//真正传递的是前面那个变量，这也是html中可以使用的
            
            // 取回打包后的数据
            $htmls = $this->fetch();
            return $htmls;
            
        }
    }
    
    //初始化UI
    public function memberList()
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
    
    //根据具体参数查询
	public function SearchUserInfo($_userid, $_username, $_telphone, $_email, $_fromtime, $_totime)
    {
		$_session_user = Session::get(USER_SEESION);
		$_resdata = array();
        if(empty($_session_user) || $_session_user["roleId"] != 1111){
			$_resdata["info"] = "priority error";
        }else{          
				$tel = preg_match("/1[3458]{1}\d{9}$/",$_telphone)?true:false;
				if(filter_var($_email, FILTER_VALIDATE_EMAIL)== false && strcmp($_email,"")){
					$_resdata["info"] = "email error";
				}else if((strtotime($_fromtime)==false && strcmp($_fromtime,"")) || (strtotime($_totime)==false && strcmp($_totime,""))){
					$_resdata["info"] = "time error";
				}else if( strcmp($_telphone,"") && !$tel){
					$_resdata["info"] = "telphone error";
				}else{
					$_admin = new User_info();
					$_res = $_admin->UserSearch($_userid, $_username, $_telphone, $_email, $_fromtime, $_totime);
					$_resdata["info"] = "ok";
					$_resdata["res"] = $_res;
				}
		}
		return json_encode($_resdata);
    }
	
    
    public function memberApplication()
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
    
    public function memberApplicationQueryByTime($_start, $_end)
    {
        $_session_user = Session::get(USER_SEESION);
		$_resdata = array();
        if(empty($_session_user) || $_session_user["roleId"] != 1111){
            $_resdata["info"] = "priority error";
        }else{
				if((strtotime($_start)==false && strcmp($_start,"")) || (strtotime($_end)==false && strcmp($_end,""))){
					$_resdata["info"] = "error";
				}else {
					$_admin = new User_info();
					$_res = $_admin->UserApplication($_start, $_end);       
					$_resdata["info"] = "ok";
					$_resdata["res"] = $_res;
				}
		}
        return json_encode($_resdata);
    }
    
    public function pointsDetails()
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
    
    public function pointDetailsQuery($_user_id)
    {
		$_session_user = Session::get(USER_SEESION);
		$_resdata = array();
        if(empty($_session_user) || $_session_user["roleId"] != 1111){
            $_resdata["info"] = "priority error";
        }else{
			$_user_point = new User_point();
			$_res = $_user_point->PointQuery($_user_id);
			$_resdata["info"] = "ok";
			$_resdata["res"] = $_res;

		}
		return json_encode($_resdata);
    }
    
    public function pointsTransfer()
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
    
    public function pointTransformQuery($_user_id, $_start, $_end)
    {
		$_session_user = Session::get(USER_SEESION);
		$_resdata = array();
        if(empty($_session_user) || $_session_user["roleId"] != 1111){
             $_resdata["info"] = "priority error";
        }else{
			$_user_point = new Point_transform_record();
			$_res = $_user_point->PointTransformQueryBy($_user_id, $_start, $_end);
			$_resdata["info"] = "ok";
			$_resdata["res"] = $_res;
		}
		return json_encode($_resdata);
    }
    
    public function incomeAndExpense()
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
    
	public function incomeAndExpenseQuery($_start, $_end)
    {
		$_session_user = Session::get(USER_SEESION);
		$_resdata = array();
        if(empty($_session_user) || $_session_user["roleId"] != 1111){
            $_resdata["info"] = "priority error";
        }else{	
			$_income_expense = new Income_expenditure();
			$_res = $_income_expense->IncomeExpenditureQueryByTime($_start, $_end);
			$_resdata["info"] = "ok";
			$_resdata["res"] = $_res;
		}
		return json_encode($_resdata);
    }
	
    public function presentApplication()
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
    
    public function presentApplicationQuery($_user_id, $_start, $_end)
    {
		$_session_user = Session::get(USER_SEESION);
		$_resdata = array();
        if(empty($_session_user) || $_session_user["roleId"] != 1111){
            $_resdata["info"] = "priority error";
        }else{
			$_withdraw = new Withdrawal_record();
			$_res = $_withdraw->WithdrawalApplicationByTime($_user_id, $_start, $_end);
			$_resdata["info"] = "ok";
			$_resdata["res"] = $_res;
		}
		return json_encode($_resdata);
    }
    
    public function notice()
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
    
    public function option()
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
    
    public function log()
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
    

}
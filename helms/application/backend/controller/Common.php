<?php
namespace app\backend\controller;

use think\Controller;
use app\common\model\User_info;
use app\common\model\User_bankinfo;
use app\common\model\User_details;
use app\common\model\User_point;
use app\common\model\User_priority;
use app\common\model\Point_transform_record;
use app\common\model\Withdrawal_record;
use app\common\model\Realtime_price;
use think\Session;
use app\common\model\Income_expenditure;
use app\extra\controller\Basecontroller;
use app\common\model\Positionality;
use app\common\model\System_subscriber;
use app\common\model\Role;
use app\common\model\Gp_set;

class Common extends Basecontroller
{       
    //初始化UI
    public function index()
    {
//             $this->assign('menu_data', "xxx");
            $htmls = $this->fetch();
            return $htmls;
    }

    public function network()
    {
        $_session_user = Session::get(USER_SEESION);
        if(empty($_session_user)){
            return $this->redirect("/login/login/index");
        }else{
            $_user_id = $_session_user["userId"];
//             $_role_id = $_session_user["roleId"];
    
            $_user = new User_details();
            $_res = $_user->DetailsQuery($_user_id);
            if (count($_res) == 1)
            {
                $_session_user["userName"] = $_res[0]["user_name"];
                $_session_user["email"] = $_res[0]["email"];
                $_session_user["userLevel"] = $_res[0]["user_level"];
            }
    
/*             $_role = new Role();
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
    
            $this->assign('pass_data', $_resdata);//真正传递的是前面那个变量，这也是html中可以使用的 */
    
            // 取回打包后的数据
            $htmls = $this->fetch();
            return $htmls;
        }
    }
    
//     public function network()
//     {
//         $_session_user = Session::get(USER_SEESION);
//         if(empty($_session_user)){
//             return $this->redirect("/login/login/index");
//         }else{
//             $_user_id = $_session_user["userId"];
//             $_role_id = $_session_user["roleId"];
    
//             $_user = new User_details();
//             $_res = $_user->DetailsQuery($_user_id);
//             if (count($_res) == 1)
//             {
//                 $_session_user["userName"] = $_res[0]["user_name"];
//                 $_session_user["email"] = $_res[0]["email"];
//                 $_session_user["userLevel"] = $_res[0]["user_level"];
//             }
    
//             $_role = new Role();
//             $_res = $_role->RoleQuery($_role_id);
//             if (count($_res) == 1)
//             {
//                 $_session_user["role_type"] = $_res[0]["role_type"];
//             }
    
//             //更新session
//             Session::set(USER_SEESION,$_session_user);
    
//             $_resdata = array();
//             $_user = new User_bankinfo();
//             $_res = $_user->BankinfoQuery($_user_id);
//             if (count($_res) == 1)
//             {
//                 $_resdata["bank_name"] = $_res[0]["bank_name"];
//                 $_resdata["bank_account_name"] = $_res[0]["bank_account_name"];
//                 $_resdata["bank_account_num"] = $_res[0]["bank_account_num"];
//                 $_resdata["reserve1"] = $_res[0]["reserve1"];
//             }
    
//             $_user = new User_point();
//             $_res = $_user->PointQuery($_user_id);
//             if (count($_res) == 1)
//             {
//                 $_resdata["shares"] = $_res[0]["shares"];
//                 $_resdata["bonus_point"] = $_res[0]["bonus_point"];
//                 $_resdata["regist_point"] = $_res[0]["regist_point"];
//             }
    
//             $_user = new User_priority();
//             $_res = $_user->PriorityQuery($_user_id);
//             if (count($_res) == 1)
//             {
//                 $_resdata["priority_id"] = $_res[0]["priority_id"];
//             }
    
//             $this->assign('pass_data', $_resdata);//真正传递的是前面那个变量，这也是html中可以使用的
    
//             // 取回打包后的数据
//             $htmls = $this->fetch();
//             return $htmls;
//         }
//     }
    
    //初始化UI
    public function memberList()
    {
        $_session_user = Session::get(USER_SEESION);
        if(empty($_session_user)){
            return $this->redirect("/login/login/index");
        }else{
//             $_user_id = $_session_user["userId"];
            
//             $subscriber = new System_subscriber();
//             $res = $subscriber ->SubscriberQueryMenu($_user_id);
//             if(count($res)>0)
//             {
//                 $this->assign('menu_data', $res);
//                 $htmls = $this->fetch();
//                 return $htmls;
//             }
            
            
// //             $_role_id = $_session_user["roleId"];
    
//             $_user = new User_details();
//             $_res = $_user->DetailsQuery($_user_id);
//             if (count($_res) == 1)
//             {
//                 $_session_user["userName"] = $_res[0]["user_name"];
//                 $_session_user["email"] = $_res[0]["email"];
//                 $_session_user["userLevel"] = $_res[0]["user_level"];
//             }
    
// //             $_role = new Role();
// //             $_res = $_role->RoleQuery($_role_id);
// //             if (count($_res) == 1)
// //             {
// //                 $_session_user["role_type"] = $_res[0]["role_type"];
// //             }
    
//             //更新session
//             Session::set(USER_SEESION,$_session_user);
    
//             $_resdata = array();
//             $_user = new User_bankinfo();
//             $_res = $_user->BankinfoQuery($_user_id);
//             if (count($_res) == 1)
//             {
//                 $_resdata["bank_name"] = $_res[0]["bank_name"];
//                 $_resdata["bank_account_name"] = $_res[0]["bank_account_name"];
//                 $_resdata["bank_account_num"] = $_res[0]["bank_account_num"];
//                 $_resdata["reserve1"] = $_res[0]["reserve1"];
//             }
    
//             $_user = new User_point();
//             $_res = $_user->PointQuery($_user_id);
//             if (count($_res) == 1)
//             {
//                 $_resdata["shares"] = $_res[0]["shares"];
//                 $_resdata["bonus_point"] = $_res[0]["bonus_point"];
//                 $_resdata["regist_point"] = $_res[0]["regist_point"];
//             }
    
//             $_user = new User_priority();
//             $_res = $_user->PriorityQuery($_user_id);
//             if (count($_res) == 1)
//             {
//                 $_resdata["priority_id"] = $_res[0]["priority_id"];
//             }

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
        if(empty($_session_user)){
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
					$_res = $_admin->UserSearchWithOutAdmin($_userid, $_username, $_telphone, $_email, $_fromtime, $_totime);
					$_resdata["info"] = "ok";
					$_resdata["res"] = $_res;
				}
		}
		return json_encode($_resdata);
    }
	
    //根据具体参数查询
    public function SearchUserInfoByPage($_userid, $_username, $_telphone, $_email, $_fromtime, $_totime, $pagesize=25, $pageindex=0)
    {
        $_session_user = Session::get(USER_SEESION);
        $_resdata = array();
        if(empty($_session_user)){
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
                $_res = $_admin->UserSearchWithLimit($_userid, $_username, $_telphone, $_email, $_fromtime, $_totime,$pagesize,$pageindex);
                $_resdata["info"] = "ok";
                $_resdata["res"] = $_res;
            }
        }
        return json_encode($_resdata);
    }
    
    public function recharge()
    {
        // 取回打包后的数据
        $htmls = $this->fetch();
        return $htmls;
        
    }
    
    public function changegujia()
    {
        $gpset = new Gp_set();
        $gpsetres = $gpset->GpSetQuery();
        $_resdata["gujia"] = $gpsetres[0]["now_price"];
        $_resdata["qishu"] = $gpsetres[0]["qishu"];        
        $this->assign('gujia_data', $_resdata);
        // 取回打包后的数据
        $htmls = $this->fetch();
        return $htmls;
    
    }
    
    public function memberApplication()
    {
        $_session_user = Session::get(USER_SEESION);
        if(empty($_session_user)){
            return $this->redirect("/login/login/index");
        }else{
            $_user_id = $_session_user["userId"];
            
            $subscriber = new System_subscriber();
            $res = $subscriber ->SubscriberQueryMenu($_user_id);
            
            if(count($res)>0)
            {
                $this->assign('menu_data', $res);
                $htmls = $this->fetch();
                return $htmls;
            }
            
//             $_role_id = $_session_user["roleId"];
    
            $_user = new User_details();
            $_res = $_user->DetailsQuery($_user_id);
            if (count($_res) == 1)
            {
                $_session_user["userName"] = $_res[0]["user_name"];
                $_session_user["email"] = $_res[0]["email"];
                $_session_user["userLevel"] = $_res[0]["user_level"];
            }
    
//             $_role = new Role();
//             $_res = $_role->RoleQuery($_role_id);
//             if (count($_res) == 1)
//             {
//                 $_session_user["role_type"] = $_res[0]["role_type"];
//             }
    
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
        if(empty($_session_user)){
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
    
    public function memberApplicationQueryByTimeWithLimit($_start, $_end,$_pagesize=25, $_pageindex=0)
    {
        $_session_user = Session::get(USER_SEESION);
        $_resdata = array();
        if(empty($_session_user)){
            $_resdata["info"] = "priority error";
        }else{
            if((strtotime($_start)==false && strcmp($_start,"")) || (strtotime($_end)==false && strcmp($_end,""))){
                $_resdata["info"] = "error";
            }else {
                $_admin = new User_info();
                $_res = $_admin->UserApplicationWithLimit($_start, $_end, $_pagesize, $_pageindex);
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
            
            $subscriber = new System_subscriber();
            $res = $subscriber ->SubscriberQueryMenu($_user_id);
            
            if(count($res)>0)
            {
                $this->assign('menu_data', $res);
                $htmls = $this->fetch();
                return $htmls;
            }
//             $_role_id = $_session_user["roleId"];
    
            $_user = new User_details();
            $_res = $_user->DetailsQuery($_user_id);
            if (count($_res) == 1)
            {
                $_session_user["userName"] = $_res[0]["user_name"];
                $_session_user["email"] = $_res[0]["email"];
                $_session_user["userLevel"] = $_res[0]["user_level"];
            }
    
//             $_role = new Role();
//             $_res = $_role->RoleQuery($_role_id);
//             if (count($_res) == 1)
//             {
//                 $_session_user["role_type"] = $_res[0]["role_type"];
//             }
    
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
        if(empty($_session_user)){
            $_resdata["info"] = "priority error";
        }else{
			$_user_point = new User_point();
			$_res = $_user_point->PointQuery($_user_id);
			if(count($_res) < 1)
			{
			    $_resdata["info"] = "error";
			    return json_encode($_resdata);
			}
			$_position = new Positionality();
			$_res_pos = $_position->PositionQuery($_user_id);
			if(count($_res_pos) < 1)
			{
			    $_resdata["info"] = "error";
			    return json_encode($_resdata);
			}
			$_res_pos = $_res_pos[0];
			$_res[0]["gushu"]=$_res_pos["gushu"];
			$_res[0]["gue"]=$_res_pos["bz5"];
			$_details =new User_details();
			$_res_dt = $_details->DetailsQuery($_user_id);
			if(count($_res_dt) < 1)
			{
			    $_resdata["info"] = "error";
			    return json_encode($_resdata);
			}
			$_res_dt = $_res_dt[0];
			$_res[0]["pay_gujia"]=$_res_dt["pay_gujia"];
			$_resdata["info"] = "ok";
			$_resdata["res"] = $_res;

		}
		return json_encode($_resdata);
    }
    
    public function pointDetailsQueryWithLimit($_user_id,$_pagesize=25, $_pageindex=0)
    {
        $_session_user = Session::get(USER_SEESION);
        $_resdata = array();
        if(empty($_session_user)){
            $_resdata["info"] = "priority error";
        }else{
            $_user_point = new User_point();
            $_res = $_user_point->PointQuery($_user_id);
            if(count($_res) < 1)
            {
                $_resdata["info"] = "error";
                return json_encode($_resdata);
            }
            $_position = new Positionality();
            $_res_pos = $_position->PositionQueryWithLimit($_user_id,$_pagesize, $_pageindex);
            if(count($_res_pos) < 1)
            {
                $_resdata["info"] = "error";
                return json_encode($_resdata);
            }
            $_res_pos = $_res_pos[0];
            $_res[0]["gushu"]=$_res_pos["gushu"];
            $_res[0]["gue"]=$_res_pos["bz5"];
            $_details =new User_details();
            $_res_dt = $_details->DetailsQuery($_user_id);
            if(count($_res_dt) < 1)
            {
                $_resdata["info"] = "error";
                return json_encode($_resdata);
            }
            $_res_dt = $_res_dt[0];
            $_res[0]["pay_gujia"]=$_res_dt["pay_gujia"];
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
            $subscriber = new System_subscriber();
            $res = $subscriber ->SubscriberQueryMenu($_user_id);
            
            if(count($res)>0)
            {
                $this->assign('menu_data', $res);
                $htmls = $this->fetch();
                return $htmls;
            }
            
//             $_role_id = $_session_user["roleId"];
    
            $_user = new User_details();
            $_res = $_user->DetailsQuery($_user_id);
            if (count($_res) == 1)
            {
                $_session_user["userName"] = $_res[0]["user_name"];
                $_session_user["email"] = $_res[0]["email"];
                $_session_user["userLevel"] = $_res[0]["user_level"];
            }
    
//             $_role = new Role();
//             $_res = $_role->RoleQuery($_role_id);
//             if (count($_res) == 1)
//             {
//                 $_session_user["role_type"] = $_res[0]["role_type"];
//             }
    
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
        if(empty($_session_user)){
             $_resdata["info"] = "priority error";
        }else{
			$_user_point = new Point_transform_record();
			$_res = $_user_point->PointTransformQueryBy($_user_id, $_start, $_end);
			$_resdata["info"] = "ok";
			$_resdata["res"] = $_res;
		}
		return json_encode($_resdata);
    }
    
    public function pointTransformQueryWithLimit($_user_id, $_start, $_end, $_pagesize=25, $_pageindex=0)
    {
        $_session_user = Session::get(USER_SEESION);
        $_resdata = array();
        if(empty($_session_user)){
            $_resdata["info"] = "priority error";
        }else{
            $_user_point = new Point_transform_record();
            $_res = $_user_point->PointTransformQueryByWithLimit($_user_id, $_start, $_end, $_pagesize, $_pageindex);
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
            $subscriber = new System_subscriber();
            $res = $subscriber ->SubscriberQueryMenu($_user_id);
            
            if(count($res)>0)
            {
                $this->assign('menu_data', $res);
                $htmls = $this->fetch();
                return $htmls;
            }
            
//             $_role_id = $_session_user["roleId"];
    
            $_user = new User_details();
            $_res = $_user->DetailsQuery($_user_id);
            if (count($_res) == 1)
            {
                $_session_user["userName"] = $_res[0]["user_name"];
                $_session_user["email"] = $_res[0]["email"];
                $_session_user["userLevel"] = $_res[0]["user_level"];
            }
    
//             $_role = new Role();
//             $_res = $_role->RoleQuery($_role_id);
//             if (count($_res) == 1)
//             {
//                 $_session_user["role_type"] = $_res[0]["role_type"];
//             }
    
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
        if(empty($_session_user)){
            $_resdata["info"] = "priority error";
        }else{	
			$_income_expense = new Income_expenditure();
			$_res = $_income_expense->IncomeExpenditureQueryByTime($_start, $_end);
			$_resdata["info"] = "ok";
			$_resdata["res"] = $_res;
		}
		return json_encode($_resdata);
    }
    
    public function incomeAndExpenseQueryWithLimit($_start, $_end, $_pagesize=25, $_pageindex=0)
    {
        $_session_user = Session::get(USER_SEESION);
        $_resdata = array();
        if(empty($_session_user)){
            $_resdata["info"] = "priority error";
        }else{
            $_income_expense = new Income_expenditure();
            $_res = $_income_expense->IncomeExpenditureQueryByTimeWithLimit($_start, $_end, $_pagesize, $_pageindex);
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
            $subscriber = new System_subscriber();
            $res = $subscriber ->SubscriberQueryMenu($_user_id);
            
            if(count($res)>0)
            {
                $this->assign('menu_data', $res);
                $htmls = $this->fetch();
                return $htmls;
            }
    
            $_user = new User_details();
            $_res = $_user->DetailsQuery($_user_id);
            if (count($_res) == 1)
            {
                $_session_user["userName"] = $_res[0]["user_name"];
                $_session_user["email"] = $_res[0]["email"];
                $_session_user["userLevel"] = $_res[0]["user_level"];
            }
    
//             $_role = new Role();
//             $_res = $_role->RoleQuery($_role_id);
//             if (count($_res) == 1)
//             {
//                 $_session_user["role_type"] = $_res[0]["role_type"];
//             }
    
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
        if(empty($_session_user)){
            $_resdata["info"] = "priority error";
        }else{
			$_withdraw = new Withdrawal_record();
			$_res = $_withdraw->WithdrawalApplicationByTime($_user_id, $_start, $_end);
			$_resdata["info"] = "ok";
			$_resdata["res"] = $_res;
		}
		return json_encode($_resdata);
    }
    
    public function presentApplicationQueryWithLimit($_user_id, $_start, $_end, $_pagesize=25, $_pageindex=0)
    {
        $_session_user = Session::get(USER_SEESION);
        $_resdata = array();
        if(empty($_session_user)){
            $_resdata["info"] = "priority error";
        }else{
            $_withdraw = new Withdrawal_record();
            $_res = $_withdraw->WithdrawalApplicationByTimeWithLimit($_user_id, $_start, $_end, $_pagesize, $_pageindex);
            $_resdata["info"] = "ok";
            $_resdata["res"] = $_res;
        }
        return json_encode($_resdata);
    }
    
    public function setCurrentPrice($id, $price)
    {
        if(parent::include_special_characters($id))
            return false;
        if(!is_numeric($price))
            return false;
        $_session_user = Session::get(USER_SEESION);
        
        if(empty($_session_user)){
            return false;
        }else{
            $_user = new Realtime_price();
            $_user->RealtimepriceInsert($price);
        }
    }
    
    public function notice()
    {
        $_session_user = Session::get(USER_SEESION);
        if(empty($_session_user)){
            return $this->redirect("/login/login/index");
        }else{
            $_user_id = $_session_user["userId"];
            $subscriber = new System_subscriber();
            $res = $subscriber ->SubscriberQueryMenu($_user_id);
            
            if(count($res)>0)
            {
                $this->assign('menu_data', $res);
                $htmls = $this->fetch();
                return $htmls;
            }
    
            $_user = new User_details();
            $_res = $_user->DetailsQuery($_user_id);
            if (count($_res) == 1)
            {
                $_session_user["userName"] = $_res[0]["user_name"];
                $_session_user["email"] = $_res[0]["email"];
                $_session_user["userLevel"] = $_res[0]["user_level"];
            }
    
//             $_role = new Role();
//             $_res = $_role->RoleQuery($_role_id);
//             if (count($_res) == 1)
//             {
//                 $_session_user["role_type"] = $_res[0]["role_type"];
//             }
    
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
    
    //根据提供的用户userid，查找用户userID的子孙节点的json，编号，parent的userid，左区性质，真实姓名
    public function get_all_children($applyuserId)
    {
        $_resdata = array();
        $_resdata["info"] = "no";
        if(parent::include_special_characters($applyuserId))
            return json_encode($_resdata) ;
            $_user = new Positionality();
            $_curid = $_user->PositionQuery($applyuserId);
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
    
    public function option()
    {
        $_session_user = Session::get(USER_SEESION);
        if(empty($_session_user)){
            return $this->redirect("/login/login/index");
        }else{
            $_user_id = $_session_user["userId"];
            $subscriber = new System_subscriber();
            $res = $subscriber ->SubscriberQueryMenu($_user_id);
            
            if(count($res)>0)
            {
                $this->assign('menu_data', $res);
                $htmls = $this->fetch();
                return $htmls;
            }
    
            $_user = new User_details();
            $_res = $_user->DetailsQuery($_user_id);
            if (count($_res) == 1)
            {
                $_session_user["userName"] = $_res[0]["user_name"];
                $_session_user["email"] = $_res[0]["email"];
                $_session_user["userLevel"] = $_res[0]["user_level"];
            }
    
//             $_role = new Role();
//             $_res = $_role->RoleQuery($_role_id);
//             if (count($_res) == 1)
//             {
//                 $_session_user["role_type"] = $_res[0]["role_type"];
//             }
    
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
            $subscriber = new System_subscriber();
            $res = $subscriber ->SubscriberQueryMenu($_user_id);
            
            if(count($res)>0)
            {
                $this->assign('menu_data', $res);
                $htmls = $this->fetch();
                return $htmls;
            }
    
            $_user = new User_details();
            $_res = $_user->DetailsQuery($_user_id);
            if (count($_res) == 1)
            {
                $_session_user["userName"] = $_res[0]["user_name"];
                $_session_user["email"] = $_res[0]["email"];
                $_session_user["userLevel"] = $_res[0]["user_level"];
            }
    
//             $_role = new Role();
//             $_res = $_role->RoleQuery($_role_id);
//             if (count($_res) == 1)
//             {
//                 $_session_user["role_type"] = $_res[0]["role_type"];
//             }
    
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
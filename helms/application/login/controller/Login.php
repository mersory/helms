<?php
namespace app\login\controller;

use think\Controller;
use app\common\model\User_info;
use app\common\model\User_role;
use app\common\model\User_bankinfo;
use app\common\model\User_details;
use app\common\model\User_point;
use app\common\model\User_priority;
use think\Request;
use think\Session;

class Login extends Controller
{
    
    public function Index(){
        $_session_user = Session::get(USER_SEESION);
        if(empty($_session_user)){
            return $this->fetch();
        }else{
            //return $this->redirect("/frontend/common/index");
            return $this->fetch();
        }
    }
    
    //鐢ㄦ埛鐧诲綍鎿嶄綔
    public function Login($_username, $_password)
    {
        $_resdata = array();
        $_user = new User_info();
        $_res = $_user->UserinfoQuery($_username, $_password);
        if (count($_res) == 1)
        {
            $_resdata["success"] = true;
            $_session_user = array();
            $_session_user["userId"] = $_res[0]["ID"];
            
            //璁剧疆瑙掕壊ID
			$_priority = new User_priority();
			$_priority_info = $_priority->PriorityQuery($_res[0]["ID"]);
            if(empty($_priority_info)){
                var_dump("鏈煡璇㈠埌瑙掕壊");
                $_resdata["success"] = false;
            }else{           
				if (count($_priority_info) == 1)
				{
					$_resdata["priority_id"] = $_priority_info[0]["priority_id"];
				}
				$_session_user["roleId"] = $_priority_info[0]["priority_id"];
                Session::set(USER_SEESION,$_session_user);
                if(1111 == $_priority_info[0]["priority_id"]){
                    $_resdata["redirectUrl"] = "/public/index.php/backend/common/index";
                }else{
                    $_resdata["redirectUrl"] = "/public/index.php/frontend/common/index";
                }
            }
        }
        else
        {
            var_dump("鐧诲綍澶辫触锛岀敤鎴峰悕鎴栧瘑鐮侀敊璇�");
            $_resdata["success"] = false;
        }
        
        echo json_encode($_resdata);
    }
    

}
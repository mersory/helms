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
            return $this->redirect("/frontend/common/index");
        }
    }
    
    //用户登录操作
    public function Login()
    {
        $_resdata = array();
        $_post = Request::instance()->post();
        $_username = $_post["username"];
        $_password = $_post["password"];
        $_user = new User_info();
        $_res = $_user->UserinfoQuery($_username, $_password);
        if (count($_res) == 1)
        {
            $_resdata["success"] = true;
            
            $_session_user = array();
            $_session_user["userId"] = $_res[0]["ID"];
            
            //设置角色ID
            $_user_role = new User_role();
            $_role_info = $_user_role->RoleQuery($_res[0]["ID"]);
            if(empty($_role_info)){
                var_dump("未查询到角色");
                $_resdata["success"] = false;
            }else{
                $_session_user["roleId"] = $_role_info[0]["role_id"];
                Session::set(USER_SEESION,$_session_user);
                
                if(1 == $_role_info[0]["role_id"]){
                    $_resdata["redirectUrl"] = "/public/index.php/backend/common/index";
                }else{
                    $_resdata["redirectUrl"] = "/public/index.php/frontend/common/index";
                }
            }
        }
        else
        {
            var_dump("登录失败，用户名或密码错误");
            $_resdata["success"] = false;
        }
        
        echo json_encode($_resdata);
    }
    

}
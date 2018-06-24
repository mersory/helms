<?php
namespace app\login\controller;

use think\Controller;
use app\common\model\User_info;
use app\common\model\User_priority;
use think\Session;
use app\common\model\Subuser_info;
use app\common\model\System_subscriber;
use app\common\model\User_point;

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
    
    
    //鐢ㄦ埛鐧诲綍鎿嶄綔
    public function Login($_username, $_password,$isAdmin)
    {
        $_resdata = array();
        
        if($isAdmin == "true"){
            $_user = new System_subscriber();
            $_res = $_user->SubscriberLoginlQuery($_username, $_password);
            if(count($_res) == 0){
                $_resdata["success"] = false;
                $_resdata["error"] = 2;
            }else{
                $_resdata["success"] = true;
                $_resdata["redirectUrl"] = "/public/index.php/backend/common/index";
                $_session_user = array();
                $_session_user["userId"] = $_res[0]["id"];
                $_session_user["username"] = $_res[0]["username"];
                Session::set(USER_SEESION,$_session_user);
            }
        }else{
            if(false)
            {
                $_resdata["success"] = false;
            }else {
                //Session::destroy();
                $_user = new User_info();
                $_res = $_user->UserinfoQuery($_username, $_password);
                if (count($_res) == 1 && $_res[0]["user_status"] != 0)
                {
                    $_resdata["success"] = true;
                    $_session_user = array();
                    $_session_user["userId"] = $_res[0]["ID"];
            
                    $_priority = new User_priority();
                    $_priority_info = $_priority->PriorityQuery($_res[0]["ID"]);
                    
                    $_points  = new User_point();
                    $_point_info = $_points->PointQuery($_res[0]["ID"]);
                    
                    if(empty($_priority_info) || empty($_point_info)){
                        $_resdata["success"] = false;
                    }else{
                        if (count($_priority_info) == 1)
                        {
                            $_resdata["priority_id"] = $_priority_info[0]["priority_id"];
                            $_resdata["reststatic"] = $_point_info[0]["shengyu_jing"];
                            $_resdata["restdynamic"] = $_point_info[0]["shengyu_dong"];
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
                else if(count($_res) == 1 && $_res[0]["user_status"] == 0)
                {
                    $_resdata["error"] = 1;
                    $_resdata["success"] = false;
                }
                else
                {
                    $_resdata["error"] = 2;
                    $_resdata["success"] = false;
                }
            }
        }

        return json_encode($_resdata);
    }
    

}
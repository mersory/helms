<?php
namespace app\frontend\controller;

use think\Controller;
use think\Session;

class Basecontroller extends Controller
{
    public function include_special_characters($input)
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
    
    function isDatetime($param = '', $format = 'Y-m-d')
    {
        return date($format, strtotime($param)) === $param;
    }
    public function _initialize(){
        error_log("进入拦截器");
            $_session_user = Session::get(USER_SEESION);
            if (empty($_session_user) || empty($_session_user['userId'])){
                return $this->redirect("/login/login/index");
            }
    }
    
}
<?php
namespace app\backend\controller;

use think\Controller;

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
            return true;      //只含有数字
        } else
            return false;
    }
    
    public function check_charactor($input)
    {
        if(preg_match("/^[a-zA-Z]+$/",$input)){
            return true;      //只含有字母
        } else
            return false;
    }
    
    public function check_normal($input)
    {
        if(preg_match("/^[0-9a-zA-Z\_]+$/",$input)){
            return true;      //含有字母和数字
        } else
            return false;
    }
    
    public function check_telphone($input)
    {
        $search = '/^0?1[3|4|5|6|7|8][0-9]\d{8}+$/';
        if ( preg_match( $search, $input ) ) {
            return true;//是正确的电话
        } else {
            return false;
        }
    }
    
    public function check_email($input)
    {
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$input)) {
            return true;      //是正确的邮箱地址
        } else
            return false;
    }
    
}
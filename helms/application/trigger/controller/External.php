<?php
namespace app\trigger\controller;

use think\Controller;
use app\common\model\User_info;
use app\common\model\Preference;
use app\common\model\User_details;

class External extends Controller
{
    public function index()
    {
        echo "class External index";
    }
    
    public function getRecommendPercent($key) {
        echo "获取配置文件";
        $percent = array();
        $percent[$key] = 0.08;
        return $percent[$key];
    }
    
    //自动生成会员编号
    public function _auto_userid() {
        $userid = 'H'.rand(1000000000, 9999999999);
        $user = new User_info();
        $find = $user->isUserExist($userid);
        if ($find != 0) {
            return $this->_auto_userid();
        }
        return $userid;
    }
    
    public function getParam($code, $level=-1, $userid)
    {
        $param = new Preference();
        $strParam = $param->getPreferenceByCode($code);
        $strArr =  explode("|",$strParam);
        if($level >= 1)
        {
            if($level <= sizeof($strArr))
                return $strArr[$level-1];
            else 
                return $strArr[sizeof($strArr)-1];
        }
        else 
        {
            $userinfo = new User_details();
            $info = $userinfo->where("ID='$userid'")->field('user_level')->find();
            $info = intval($info["user_level"]);  
            //var_dump("id , get level:".$strArr[$info-1]);
            if($info <= sizeof($strArr))
                return $strArr[$info-1];
            else
                return $strArr[sizeof($strArr)-1];
        }
    }
    
    //简单对称加密算法之加密
    function cy_encode($string = '', $skey = '') {
        if ($skey == '') $skey = "Y014app";
        $skey = str_split(base64_encode($skey));
        $strArr = str_split(base64_encode($string));
        $strCount = count($strArr);
        foreach ($skey as $key => $value) {
            $key < $strCount && $strArr[$key].=$value;
        }
        return str_replace('=', 'O0O0O', join('', $strArr)); //O0O0O
    }
    
    //简单对称加密算法之解密
    function cy_decode($string = '', $skey = '') {
        if ($skey == '') $skey = "Y014app";
        $skey = str_split(base64_encode($skey));
        $strArr = str_split(str_replace('O0O0O', '=', $string), 2);
        $strCount = count($strArr);
        foreach ($skey as $key => $value) {
            $key < $strCount && $strArr[$key][1] === $value && $strArr[$key] = $strArr[$key][0];
        }
        return base64_decode(join('', $strArr));
    }
    

}
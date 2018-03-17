<?php
namespace app\trigger\controller;

use think\Controller;
use app\common\model\User_info;

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
        $userid = 'H'.rand(10000000, 99999999).'00';
        $user = new User_info();
        $find = $user->isUserExist($userid);
        if ($find != 0) {
            return $this->_auto_userid();
        }
        return $userid;
    }

}
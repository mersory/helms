<?php
namespace app\frontend\controller;

use think\Controller;
use app\common\model\Usertorole;
use app\common\model\Userbankinfo;
use app\common\model\Userdetails;
use app\common\model\Userinfo;
use app\common\model\Userpoint;
use app\common\model\Usertopriority;

class Roleopt extends Controller
{
    public function index()
    {
        $bankinfo = new Userbankinfo();
        $details = new Userdetails();
        $info = new Userinfo();
        $point = new Userpoint();
        $priority = new Usertopriority();
        //var_dump("Roleopt");
    }
    
    public function RoleQuery($user_id, $role_id)
    {
        $_role = new Usertorole();
        $_role->RoleQuery($user_id, $role_id);
    }
    
    
    
}

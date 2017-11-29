<?php
namespace app\backend\controller;

use think\Controller;
use app\common\model\User_info;
use app\common\model\User_role;
use app\common\model\User_bankinfo;
use app\common\model\User_details;
use app\common\model\User_point;
use app\common\model\User_priority;
use think\Request;
use app\common\model\Userupgrade_record;
use app\common\model\Withdrawal_record;
use app\common\model\Offline_deal;
use app\common\model\Realtime_price;
use app\common\model\Historical_price;
use app\common\model\Subuser_info;
use app\backend\controller\Basecontroller;

class Useropt extends Basecontroller
{
    public function index()
    {
        $_user = new User_info();
        $_user_info = $_user->select();
        
        // 向V层传数据
        $this->assign('pass_data', $_user_info);//真正传递的是前面那个变量，这也是html中可以使用的
        
        // 取回打包后的数据
        $htmls = $this->fetch();
        
        // 将数据返回给用户
        return $htmls;
    }
    
    public function LoginIndex()
    {
         $_user = new User_info();
        $_user_info = $_user->select();
        
        // 向V层传数据
        $this->assign('pass_data', $_user_info);//真正传递的是前面那个变量，这也是html中可以使用的
        
        // 取回打包后的数据
        $htmls = $this->fetch();
        return $htmls;
    }
    
    public function RegistIndex()
    {
        $htmls = $this->fetch();
        return $htmls;
    }
    
    //用户登录操作
    public function UserLogin()
    {
        $_resdata = array();
        $_post = Request::instance()->post();
        $_username = $_post["username"];
        $_password = $_post["password"];
        $_user = new User_info();
        $_res = $_user->UserinfoQuery($_username, $_password);
        if (count($_res) == 1)
        {
            $_resdata["ID"] = $_res[0]["ID"];
            $_resdata["username"] = $_res[0]["username"];
            $_resdata["password"] = $_res[0]["password"];
        }
        else 
        {
            var_dump("登录失败，用户名或密码错误");
            return;
        }
        $_id = $_resdata["ID"];
        
        $_user = new User_bankinfo();
        $_res = $_user->BankinfoQuery($_id);
        if (count($_res) == 1)
        {
            $_resdata["bank_name"] = $_res[0]["bank_name"];
            $_resdata["bank_account_name"] = $_res[0]["bank_account_name"];
            $_resdata["bank_account_num"] = $_res[0]["bank_account_num"];  
            $_resdata["reserve1"] = $_res[0]["reserve1"];
        }
        
        $_user = new User_details();
        $_res = $_user->DetailsQuery($_id);
        if (count($_res) == 1)
        {
            $_resdata["user_name"] = $_res[0]["user_name"];
            $_resdata["email"] = $_res[0]["email"];
            $_resdata["user_level"] = $_res[0]["user_level"];
        }
        
        $_user = new User_point();
        $_res = $_user->PointQuery($_id);
        if (count($_res) == 1)
        {
            $_resdata["shares"] = $_res[0]["shares"];
            $_resdata["bonus_point"] = $_res[0]["bonus_point"];
            $_resdata["regist_point"] = $_res[0]["regist_point"];
        }
        
        $_user = new User_priority();
        $_res = $_user->PriorityQuery($_id);
        if (count($_res) == 1)
        {
            $_resdata["priority_id"] = $_res[0]["priority_id"];
        }
        
        $_user = new User_role();
        $_res = $_user->RoleQuery($_id);
        if (count($_res) == 1)
        {
            $_resdata["role_id"] = $_res[0]["role_id"];
        }
        
        $this->assign('pass_data', $_resdata);//真正传递的是前面那个变量，这也是html中可以使用的
        
        // 取回打包后的数据
        $htmls = $this->fetch();
        return $htmls;
    }
    
    
    
    //用户注册操作
    public function UserRegist()
    {
        var_dump("用户注册");
        $_post = Request::instance()->post();
        $_user_info = new User_info(); 
        $name = $_post["fullname"];
        $pwd1 = $_post["primarypwd"];//
        $pwd2 = $_post["minorpwd"];//
        //此处插入用的是用户名和密码，必须这样做，因为此处插入之后才会有对应得ID生成，以便后续使用，此处不需要提供ID，因为主表的ID是自增的
        $_state = $_user_info->UserinfoInsert($name, $pwd1, $pwd2);
        if ($_state != 0)
        {
            $_res =$_user_info->UserinfoQuery($name, $pwd1);
            echo count($_res);
            if (count($_res) != 1)
            {
                echo "存在多个同名用户，或者改用户不存在";
                return ;
            }
            else
            {
                echo "1111fasfsaf";
                //var_dump($_res) ;
            }
                
        }

        //银行信息插入
        $_bank_info = new User_bankinfo();
        $user_id = $_res[0]["ID"];
        $bank_account_name = "白浅上仙";
        $bank_account_num = "622718219839182";
        $bank_name = "中国工商银行";
        $bank_city = $_post["telphone"];
        $sub_bank = "";
        
        //用户详情信息插入
        $user_name = $_post["fullname"];
        $email = $_post["email"];
        $portrait = -1;
        $user_level = -1; 
        $open_time = -1;
        $recommender = intval($_post["recommender"]); 
        $activator = intval($_post["activator"]);
        $registry = -1;
        $_details_info = new User_details();
               
        //用户绩点插入
        $shares=600;
        $bonus_point=40;
        $regist_point=30;
        $re_consume=0;
        $universal_point=0;
        $re_cast=0;
        $remain_point=0;
        $blocked_point=0;
        $_point_info = new User_point();
                
        //用户权限插入
        $_priority_info = new User_priority();
        
        //用户角色插入
        $_role_info = new User_role();
        
        $_user_info->startTrans();
        $_bank_insert = $_bank_info->BankinfoInsert($user_id, $bank_name, $bank_account_name, $bank_account_num, $bank_city, $sub_bank);
        $_details_insert = $_details_info->DetailsInsert($user_id, $user_name, $email, $portrait, $user_level, $open_time, $recommender, $activator, $registry);
        $_point_insert = $_point_info->PointInsert($user_id, $shares, $bonus_point, $regist_point);
        $_priority_insert = $_priority_info->PriorityInsert($user_id);//默认参数列表
        $_role_insert = $_role_info->RoleInsert($user_id);
        if ($_bank_insert && $_details_insert && $_point_insert && $_priority_insert &&$_role_insert)
        {
            echo "事务执行成功，提交";
            $_user_info->commit();
        }
        else
        {
            echo "事务执行失败，回滚";
            $_user_info->rollback();    
        }
        
        return $user_id . '成功增加至数据表中';
        
    }
    
    //删除会员，用于注销
    public function UserDelete()
    {
        $_post = Request::instance()->post();

        $_user_info = new User_info();
        $name = $_post["del_username"];
        $pwd = $_post["del_password"];
        $user_id = $_post["del_id"];
        
        $_details_info = new User_details();
        $_bank_info = new User_bankinfo();
        $_point_info = new User_point();
        $_priority_info = new User_priority();
        $_role_info = new User_role();
        
        $_user_info->startTrans();
        $_info_res =$_user_info->UserinfoDel($user_id, $name, $pwd);//如果这里删除成功，则说明具有相应权限
        $_bank_del = $_bank_info->BankinfoDel($user_id);
        $_details_del = $_details_info->DetailsDel($user_id);
        $_point_del = $_point_info->PointDel($user_id);
        $_priority_del = $_priority_info->PriorityDel($user_id);
        $_role_del = $_role_info->RoleDel($user_id);
        if ($_info_res && $_bank_del && $_details_del && $_point_del && $_priority_del &&$_role_del)
        {
            echo "事务执行成功，提交";
            $_user_info->commit();
        }
        else
        {
            echo "事务执行失败，回滚";
            $_user_info->rollback();
        }
      
    }
    
    public function memberModifyPwd()
    {
        $htmls = $this->fetch();
        return $htmls;
    }
    

    public function userinfo()
    {
        $htmls = $this->fetch();
        return $htmls;
    }
    
    //激活操作
    public function UserActivate($ID, $name, $pwd, $cost)
    {
        $_user_info = new User_info();
        $_user_info->UserActivate($ID, $name, $pwd, $cost);
    }
    
    //用户升级
    public function UserupgradeAct($user_id, $cost)
    {
        $_user_upgrade = new Userupgrade_record();
        $_user_upgrade->UserupgradeAct($user_id, $cost);
    }
    
    public function WithdrawalInsert($user_id, $withdraw_sum, $withdrawal_typ, $point_consume, $withdrawal_status)
    {
        $_user_withdraw = new Withdrawal_record();
        $_user_withdraw->WithdrawalInsert($user_id, $withdraw_sum, $withdrawal_typ, $point_consume, $withdrawal_status);
    }
    
    public function  ForgetPwd() //忘记密码，通过邮箱重新设置
    {
        $htmls = $this->fetch();   
        // 将数据返回给用户
        return $htmls;
    }
    
    public function UpdatePwd()//记得密码，想要重新设置密码
    {
        $htmls = $this->fetch();
        // 将数据返回给用户
        return $htmls;
    }
    
    public function PwdUpdateCommit()
    {
        $_post = Request::instance()->post();
    	$username = $_post["username"];
        $odl_pwd = $_post["old_pwd"];
        $pwd = $_post["password"];
        $comfirm = $_post["comfirm"];
        $_userinfo = new User_info();
        $_res = $_userinfo->UserinfoQuery($username, $odl_pwd);
        if (count($_res) == 1)
        {
            $_userinfo->UserinfoUpdate($username, $pwd); 
            var_dump("密码修改成功");
        }
        else 
        {
            var_dump("密码修改失败");
        }
    }
    
    public function ResetPwd()//忘记密码
    {
        $_post = Request::instance()->post();
        //var_dump($_post);
        $email = $_post["email"];
        echo $email;
    }
    
    public function PointsTansform($src_type, $des_type, $sum)//积分转换函数
    {
        echo "积分转换";
        switch ($src_type)
        {
            case 0:
                break;
        }
        
    }
    
//---------------------------------单个接口测试--------------------------------
//---------------------------------单个接口测试--------------------------------
//---------------------------------单个接口测试--------------------------------
//---------------------------------单个接口测试--------------------------------
    
    
    public function UserinfoQuery($name, $pwd)
    {
        $_user = new User_info();
        $_user->UserinfoQuery($name, $pwd);
    }
    
    public function UserinfoDel($id, $name, $pwd)//此处的user和pwd是操作人的信息，验证操作人是否为超级管理员
    {
        $_user = new User_info();
        $_user->UserinfoDel($id, $name, $pwd);
    }
    
    public function UserinfoInsert($name, $pwd1, $pwd2)
    {
        $_user = new User_info();
        $_user->UserinfoInsert($name, $pwd1, $pwd2);
    }
    
    public function UserinfoUpdate($name, $pwd)
    {
        $_user = new User_info();
        $_user->UserinfoUpdate($name, $pwd);
    }
    
    public function RoleQuery($user_id)
    {
        $_role = new User_role();
        $_role->RoleQuery($user_id);
    }
    
    public function RoleDel($user_id)
    {
        $_role = new User_role();
        $_role->RoleDel($user_id);
    }
    
    public function RoleInsert($user_id, $role_id)
    {
        $_role = new User_role();
        $_role->RoleInsert($user_id, $role_id);
    }
    
    public function RoleUpdate($user_id, $role_id)
    {
        $_role = new User_role();
        $_role->RoleUpdate($user_id, $role_id);
    }
    
    public function PriorityQuery($user_id)
    {
        $_prio = new User_priority();
        $_prio->PriorityQuery($user_id);
    }
    
    public function PriorityInsert($user_id, $priority_id)
    {
        $_prio = new User_priority();
        $_prio->PriorityInsert($user_id, $priority_id);
    }
    
    public function PriorityUpdate($user_id, $priority_id)
    {
        $_prio = new User_priority();
        $_prio->PriorityUpdate($user_id, $priority_id);
    }
    
    public function PriorityDel($user_id)
    {
        $_prio = new User_priority();
        $_prio->PriorityDel($user_id);
    }
    
    public function PointInsert($user_id, $shares=0, $bonus_point=0, $regist_point=0, $re_consume=0,
                                    $universal_point=0, $re_cast=0, $remain_point=0, $blocked_point=0)
    {
        $_point = new User_point();
        $_point->PointInsert($user_id, $shares, $bonus_point, $regist_point, $re_consume, 
                                $universal_point, $re_cast, $remain_point, $blocked_point);
    }
    
    public function PointQuery($user_id)
    {
        $_point = new User_point();
        $_point->PointQuery($user_id);
    }
    
    public function PointDel($user_id)
    {
        $_point = new User_point();
        $_point->PointDel($user_id);
    }
    
    public function PointUpdate($user_id, $shares=0, $bonus_point=0, $regist_point=0, $re_consume=0,
        $universal_point=0, $re_cast=0, $remain_point=0, $blocked_point=0)
    {
        $_point = new User_point();
        $_point->PointUpdate($user_id, $shares, $bonus_point, $regist_point, $re_consume,
                                $universal_point, $re_cast, $remain_point, $blocked_point);
    }
    
    public function DetailsQuery($user_id)
    {
        $_details = new User_details();
        $_details->DetailsQuery($user_id);
    }
    
    public function DetailsDel($user_id)
    {
        $_details = new User_details();
        $_details->DetailsDel($user_id);
    }
    
    public function DetailsUpdate($user_id, $user_name, $email, $portrait, $user_level,
        $open_time, $recommender, $activator, $registry)
    {
        $_details = new User_details();
        $_details->DetailsUpdate($user_id, $user_name, $email, $portrait, $user_level,
        $open_time, $recommender, $activator, $registry);
    }
    
    public function DetailsInsert($user_id, $user_name, $email, $portrait, $user_level,
        $open_time, $recommender, $activator, $registry)
    {
        $_details = new User_details();
        $_details->DetailsInsert($user_id, $user_name, $email, $portrait, $user_level,
            $open_time, $recommender, $activator, $registry);
    }

    public function BankinfoQuery($user_id)
    {
        $_bankinfo = new User_bankinfo();
        $_bankinfo->BankinfoQuery($user_id);
    }
    
    public function BankinfoDel($user_id)
    {
        $_bankinfo = new User_bankinfo();
        $_bankinfo->BankinfoDel($user_id);
    }
    
    public function BankinfoInsert($user_id, $bank_name, $bank_account_name, $bank_account_num, $bank_city, $sub_bank)
    {
        $_bankinfo = new User_bankinfo();
        $_bankinfo->BankinfoInsert($user_id, $bank_name, $bank_account_name, $bank_account_num, $bank_city, $sub_bank);
    }
    
    public function BankinfoUpdate($user_id, $bank_name, $bank_account_name, $bank_account_num, $bank_city, $sub_bank)
    {
        $_bankinfo = new User_bankinfo();
        $_bankinfo->BankinfoUpdate($user_id, $bank_name, $bank_account_name, $bank_account_num, $bank_city, $sub_bank);
    }
    
    public function UpgradeInsert($user_id, $current_level, $upgrade_level, $upgrade_time)
    {
        $_upgrade = new Userupgrade_record();
        $_upgrade->UpgradeInsert($user_id, $current_level, $upgrade_level, $upgrade_time);
    }
    
    public function UpgradeQuery($user_id)
    {
        $_upgrade = new Userupgrade_record();
        $_res= $_upgrade->UpgradeQuery($user_id);
        for($_index=0; $_index < count($_res); $_index++)
        {
            var_dump($_res[$_index]["ID"]);
            var_dump($_res[$_index]["user_id"]);
            var_dump($_res[$_index]["current_level"]);
            echo "<br/>";
        }
    }
    
    public function WithdrawalQuery($withdraw_id)//还有其他的查找方式，此处只列出这一个
    {
        $_withdraw = new Withdrawal_record();
        var_dump($_withdraw->WithdrawalQuery($withdraw_id));
    }
    
    public function WithdrawalUpdate($withdraw_id, $updatetype)//还有其他的查找方式，此处只列出这一个
    {
        $_withdraw = new Withdrawal_record();
        $_withdraw->WithdrawalUpdate($withdraw_id, $updatetype);
    }
    
    public function OfflineInsert($user_id, $transaction_amount, $transaction_details)
    {
        $_offline = new Offline_deal();
        $_offline->OfflineInsert($user_id, $transaction_amount, $transaction_details);
    }
    
    public function OfflineQuery($ID)
    {
        $_offline = new Offline_deal();
        var_dump($_offline->OfflineQuery($ID)[0]["user_id"]);
    }
    
    public function RealtimepriceInsert( $latest_prive)
    {
        $_realtime = new Realtime_price();
        $_realtime->RealtimepriceInsert($latest_prive);
    }
    
    public function RealtimepriceQuery($time)
    {
        $_realtime = new Realtime_price();
        $_res = $_realtime->RealtimepriceQuery($time);
        for ($index = 0; $index<count($_res); $index++)
        {
            echo $_res[$index]["current_time"];
            echo $_res[$index]["latest_price"];
        }
    }

    public function HistoricalpriceInsert( $share_price)
    {
        $_history = new Historical_price();
        $_history->HistoricalpriceInsert($share_price);
    }
    
    public function HistoricalpriceQuery($time)
    {
        $_realtime = new Historical_price();
        $_res = $_realtime->HistoricalpriceQuery($time);
        for ($index = 0; $index<count($_res); $index++)
        {
            echo $_res[$index]["current_time"];
            echo $_res[$index]["share_price"];
            echo "<br/>";
        }
    }
    
    public function SubuserinfoQuery($sub_user_id)
    {
        $_subuser = new Subuser_info();
        var_dump($_subuser->SubuserinfoQuery($sub_user_id));
    }
    

    public function SubuserinfoInsert($sub_user_id, $user_id)
    {
        $_subuser = new Subuser_info();
        $_subuser->SubuserinfoInsert($sub_user_id, $user_id);
    }
    
    public function SubuserinfoUpdate($sub_user_id, $user_id)
    {
        $_subuser = new Subuser_info();
        $_subuser->SubuserinfoUpdate($sub_user_id, $user_id);
    }
    
    public function SubuserinfoDel($sub_user_id)
    {
        $_subuser = new Subuser_info();
        $_subuser->SubuserinfoDel($sub_user_id);
    }
    
    
    
    
    
}
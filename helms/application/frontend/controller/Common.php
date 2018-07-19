<?php
namespace app\frontend\controller;

use think\Controller;
use app\common\model\User_info;
use app\common\model\User_bankinfo;
use app\common\model\User_details;
use app\common\model\User_point;
use app\common\model\User_priority;
use app\common\model\Historical_price;
use app\common\model\Withdrawal_record;
use app\common\model\Point_transform_record;
use think\Session;
use app\common\model\Role;
use app\common\model\Positionality;
use app\extra\controller\Basecontroller;
use app\common\model\Award_record;

class Common extends Basecontroller
{
    public function index()
    {
        $_session_user = Session::get(USER_SEESION);
        if(empty($_session_user)){
            return $this->redirect("/login/login/index");
        }else{
            $_user_id = $_session_user["userId"];
            $_role_id = $_session_user["roleId"];
            
            $_user = new User_details();
            $_res = $_user->DetailsQuery($_user_id);
            if (count($_res) == 1)
            {
                $_session_user["userName"] = $_res[0]["user_name"];
                $_session_user["email"] = $_res[0]["email"];
                $_session_user["userLevel"] = $_res[0]["user_level"];
            }
            
            $_role = new Role();
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
				$_resdata["re_consume"] = $_res[0]["re_consume"];
                $_resdata["universal_point"] = $_res[0]["universal_point"];
                $_resdata["re_cast"] = $_res[0]["re_cast"];
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
    
    public function news()
    {
        $_session_user = Session::get(USER_SEESION);
        if(empty($_session_user)){
            return $this->redirect("/login/login/index");
        }else{
            $_user_id = $_session_user["userId"];
            $_role_id = $_session_user["roleId"];
    
            $_user = new User_details();
            $_res = $_user->DetailsQuery($_user_id);
            if (count($_res) == 1)
            {
                $_session_user["userName"] = $_res[0]["user_name"];
                $_session_user["email"] = $_res[0]["email"];
                $_session_user["userLevel"] = $_res[0]["user_level"];
            }
    
            $_role = new Role();
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
    
            $this->assign('pass_data', $_resdata);//真正传递的是前面那个变量，这也是html中可以使用的
    
            // 取回打包后的数据
            $htmls = $this->fetch();
            return $htmls;
    
        }
    }
    
    public function network()
    {
        $_session_user = Session::get(USER_SEESION);
        if(empty($_session_user)){
            return $this->redirect("/login/login/index");
        }else{
            $_user_id = $_session_user["userId"];
            $_role_id = $_session_user["roleId"];
    
            $_user = new User_details();
            $_res = $_user->DetailsQuery($_user_id);
            if (count($_res) == 1)
            {
                $_session_user["userName"] = $_res[0]["user_name"];
                $_session_user["email"] = $_res[0]["email"];
                $_session_user["userLevel"] = $_res[0]["user_level"];
            }
    
            $_role = new Role();
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
    
            $this->assign('pass_data', $_resdata);//真正传递的是前面那个变量，这也是html中可以使用的
    
            // 取回打包后的数据
            $htmls = $this->fetch();
            return $htmls;
        }
        }
        
	public function introduce()
    {
        $_session_user = Session::get(USER_SEESION);
        if(empty($_session_user)){
            return $this->redirect("/login/login/index");
        }else{
            $_user_id = $_session_user["userId"];
            $_role_id = $_session_user["roleId"];
    
            $_user = new User_details();
            $_res = $_user->DetailsQuery($_user_id);
            if (count($_res) == 1)
            {
                $_session_user["userName"] = $_res[0]["user_name"];
                $_session_user["email"] = $_res[0]["email"];
                $_session_user["userLevel"] = $_res[0]["user_level"];
            }
    
            $_role = new Role();
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
    
            $this->assign('pass_data', $_resdata);//真正传递的是前面那个变量，这也是html中可以使用的
    
            // 取回打包后的数据
            $htmls = $this->fetch();
            return $htmls;
        }
    }
		
    public function bonusdetails()
    {
        $_session_user = Session::get(USER_SEESION);
        if(empty($_session_user)){
            return $this->redirect("/login/login/index");
        }else {
            //$_post = Request::instance()->get();
            $userId = $_session_user["userId"];
    
            $Award = new Award_record();
            $_res = $Award->AwardRecordQueryWithLimit($userId);
    
            $this->assign('userId', $userId);
            $this->assign('page', $_res->render());
            $this->assign('pass_data', $_res);
            // 取回打包后的数据
            $htmls = $this->fetch();
            return $htmls;
        }
    }
    
    public function presentApplication()
    {
        $_session_user = Session::get(USER_SEESION);
        if(empty($_session_user)){
            return $this->redirect("/login/login/index");
        }else{
    
            $_user_id = $_session_user["userId"];
    
            $_start="";
            $_end = "";
            $_withdraw = new Withdrawal_record();
            $_res = $_withdraw->WithdrawalApplicationByTimeWithLimit($_user_id, $_start, $_end);
    
            $this->assign('userId', $_user_id);
            $this->assign('page', $_res->render());
            $this->assign('pass_data', $_res);
    
            // 取回打包后的数据
            $htmls = $this->fetch();
            return $htmls;
    
        }
    }
    
    public function userWithdraw($points, $point_type)
    {
        $resdata = array();
        $resdata["success"] = 0;
        $_session_user = Session::get(USER_SEESION);
        if(empty($_session_user)){
            return $this->redirect("/login/login/index");
        }else{
            $_user_id = $_session_user["userId"];
            //检测是否填写完整信息
            $bankinfoOBJ = new User_bankinfo();
            $bankRES = $bankinfoOBJ->BankinfoQuery($_user_id);
            
            if(count($bankRES) < 1)
            {
                $resdata["success"] = -1;
                return json_encode($resdata);
            }
            else if($bankRES[0]["bank_account_name"]=="" || $bankRES[0]["bank_account_num"]=="")
            {
                $resdata["success"] = -1;
                return json_encode($resdata);
            }
            
            if( ($points % 100)!=0 )
                return json_encode($resdata);
            
            $pointsOBJ = new User_point();
            $pointsRES = $pointsOBJ->PointQuery($_user_id);
            $withdrawOBJ = new Withdrawal_record();
            if($points<=0 || count($pointsRES) < 1)
            {
                return json_encode($resdata);
            }
            else
            {
                switch ($point_type)
                {
                    case 1:
                        if($pointsRES[0]["bonus_point"] > $points)
                        {
                            $actRES = $pointsOBJ->PointUpdate($_user_id, -1, $pointsRES[0]["bonus_point"] - $points);
                            $actRES = $actRES && $withdrawOBJ->WithdrawalInsert($_user_id, $points*6*0.95, $point_type, $points, 0);
                            if($actRES > 0)
                                $resdata["success"] = 1;
                                break;
                        }
                        else
                            return json_encode($resdata);
                    case 2:
                        if($pointsRES[0]["regist_point"] > $points)
                        {
                            $actRES = $pointsOBJ->PointUpdate($_user_id, -1, -1, $pointsRES[0]["regist_point"] - $points);
                            $actRES = $actRES && $withdrawOBJ->WithdrawalInsert($_user_id, $points*6*0.95, $point_type, $points, 0);
                            if($actRES > 0)
                                $resdata["success"] = 1;
                                break;
                        }
                        else
                            return json_encode($resdata);
                    case 3:
                        if($pointsRES[0]["universal_point"] > $points)
                        {
                            $actRES = $pointsOBJ->PointUpdate($_user_id, -1, -1,-1, -1, $pointsRES[0]["universal_point"] - $points);
                            $actRES = $actRES && $withdrawOBJ->WithdrawalInsert($_user_id, $points*6*0.95, $point_type, $points, 0);
                            if($actRES > 0)
                                $resdata["success"] = 1;
                                break;
                        }
                        else
                            return json_encode($resdata);
                    default:
                        return json_encode($resdata);
                }
                return json_encode($resdata);
            }
        }
    }
    
    public function memberapplication($_start="", $_end="")
    {
            $_session_user = Session::get(USER_SEESION);
            $_resdata = array();
            if(empty($_session_user)){
                $_resdata["info"] = "priority error";
            }else{
                $_admin = new User_info();
                $_start = $_GET['fromTime'];
                $_end = $_GET['toTime'];
                $_res = $_admin->UserApplicationWithLimit($_start, $_end);
    
                $this->assign('page', $_res->render());
                $this->assign('pass_data', $_res);
                // 取回打包后的数据
                $htmls = $this->fetch();
                return $htmls;
            }
    }
    
    public function pointsTransfer()
    {
        $_session_user = Session::get(USER_SEESION);
        if(empty($_session_user)){
            return $this->redirect("/login/login/index");
        }else{
    
            $_user_id = $_session_user["userId"];
            $_start =$_GET["fromTime"];
            $_end = $_GET["toTime"];
            $_user_point = new Point_transform_record();
            $_res = $_user_point->PointTransformQueryByWithLimit($_user_id, $_start, $_end);
       
            $this->assign('userId', $_user_id);
            $this->assign('page', $_res->render());
            $this->assign('pass_data', $_res);
    
            // 取回打包后的数据
            $htmls = $this->fetch();
            return $htmls;
    
        }
    }
        public function points($type)
        {
            $_session_user = Session::get(USER_SEESION);
            if(empty($_session_user)){
                return $this->redirect("/login/login/index");
            }else{
                $_user_id = $_session_user["userId"];
                $_role_id = $_session_user["roleId"];
        
                $_user = new User_details();
                $_res = $_user->DetailsQuery($_user_id);
                if (count($_res) == 1)
                {
                    $_session_user["userName"] = $_res[0]["user_name"];
                    $_session_user["email"] = $_res[0]["email"];
                    $_session_user["userLevel"] = $_res[0]["user_level"];
                }
        
                $_role = new Role();
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
                    $_resdata["re_consume"] = $_res[0]["re_consume"];
                    $_resdata["universal_point"] = $_res[0]["universal_point"];
                }
                
                $_resdata["type"] = $type;
        
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
    public function test_func($time)
    {
        $_user = new Historical_price();
        $_res = $_user->HistoricalpriceQuery($time);
        for($i= 0; $i<count($_res); $i++)
        {
            //var_dump($_res[$i]["current_time"]);
            //var_dump($_res[$i]["share_price"]);
        }
        return $_res;
    }
    
    public function get_history_price($from, $to)
    {
        $_resdata = array();
        $_resdata["info"] = "no";

        
        $_user = new Historical_price();
        $_res = $_user->HistoricalpriceQueryByTiem($from, $to);        
        $_tmp = array();
        if(count($_res) > 0)
        {
            $_resdata["info"] = "ok";
            for($i= 0; $i<count($_res); $i++)
            {
                $_res[$i]["current_time"] = substr($_res[$i]["current_time"], 0, 10);
                $_tmp[ $_res[$i]["current_time"] ] = $_res[$i]["share_price"];
            }
            $_resdata['res'] = $_tmp;
        }
        return json_encode($_resdata);
    }
    
    //返回当前用户userid对应的json值，父节点的编号
    public function get_net_topology($userid)
    {
        $_resdata = array();
        $_resdata["info"] = "no";
        if( parent::include_special_characters($userid) )//包含特殊字符则返回true，不包含则返回false
        {
            return json_encode($_resdata);
        }
        $_user = new Positionality();
        $_res = $_user->PositionQuery($userid);
        if(count($_res) > 0)
        { 
            $tmp["parent"] = $_res[0]["parent"];
            $tmp["json"] = $_res[0]["json"];
            $_resdata["info"] = "ok";
            $_resdata['res'] = $tmp;
        }
        return json_encode($_resdata);
    }
    
    //根据提供的用户$applyuserId，查找用户userID的子孙节点的json，编号，parent的$applyuserId，左区性质，真实姓名
    public function get_all_children($applyuserId)
    {
        $_resdata = array();
        $_resdata["info"] = "no";
        if(parent::include_special_characters($applyuserId))
            return json_encode($_resdata) ;
        if($applyuserId < "1000")
        {
            $applyuserId = "admin";
        }
        $_session_user = Session::get(USER_SEESION);
        $_userid = $_session_user["userId"];
        $_user = new Positionality();
        /*
        if($_userid < "1000")
        {
            $_CURuserId = $_user->PositionRoot();
            if($applyuserId < "1000")
            {
                $applyuserId = $_CURuserId;
            }    
        }
        */
        $_curid = $_user->PositionQuery($applyuserId);
        //var_dump("ID:".$_curid[0]["ID"]);
        $_userinfo =new User_details();
        $_userOBJ = new User_info();
        
        if(count($_curid) < 1)
            return json_encode($_resdata) ;
        else 
        {
            $_resdata["info"] = "ok";
            $parent = $_curid[0]["ID"];//
            $curJson = $_curid[0]["json"].$parent.",";
            $_res = $_user->getAllChildByJson($curJson);
            $_res[$_curid[0]["user_id"]]["currentId"] = $_curid[0]["user_id"];
            $_res[$_curid[0]["user_id"]]["childrenId"] = $_user->getDirectChildrenByJson($_curid[0]["ID"]);
            $_res[$_curid[0]["user_id"]]["ID"] = $_curid[0]["ID"];
            $_res[$_curid[0]["user_id"]]["json"] = $_curid[0]["json"];
            $_res[$_curid[0]["user_id"]]["parent"] = $_curid[0]["parent"];
            $_res[$_curid[0]["user_id"]]["left"] = $_curid[0]["leftchild"];
            $_res[$_curid[0]["user_id"]]["lds"] = $_curid[0]["l_ds"];
            $_res[$_curid[0]["user_id"]]["rds"] = $_curid[0]["r_ds"];
            $_res[$_curid[0]["user_id"]]["sqlds"] = $_curid[0]["sq_lds"];
            $_res[$_curid[0]["user_id"]]["sqrds"] = $_curid[0]["sq_rds"];
            $_user_realname = $_userinfo->DetailsQuery($_curid[0]["user_id"]);
            $_res[$_curid[0]["user_id"]]["level"] = $_user_realname[0]["user_level"];
            $_user_realname = $_user_realname[0]["user_name"];
            $_res[$_curid[0]["user_id"]]["realname"] = $_user_realname;
            
            $isActive = $_userOBJ->getUserstate($_curid[0]["user_id"]);
            $_res[$_curid[0]["user_id"]]["status"] = $isActive;
            $_keys = array_keys($_res);
            $_values = array_values($_res);
            for($i=0; $i<count($_res); $i++)           
            {
                //changed by Gavin start
                $_user_danshu = $_user->PositionQuery($_keys[$i]);
               $l_ds = $_user_danshu[0]["l_ds"];
               $r_ds = $_user_danshu[0]["r_ds"];
               $sq_lds = $_user_danshu[0]["sq_lds"];
               $sq_rds = $_user_danshu[0]["sq_rds"];
                //changed by Gavin end
                //$_user_realname = $_userinfo->DetailsQuery($_keys[$i]);
                //$_user_realname = $_user_realname[0]["user_name"];
                //changed by Gavin start
                //$_res[$_keys[$i]]["realname"] = $_user_realname;
                //$_res[$_keys[$i]]["realname"] = $_user_realname."&nbsp&nbsp总：".$l_ds."&nbsp-&nbsp".$r_ds.";&nbsp剩：".$sq_lds."&nbsp-&nbsp".$sq_rds;
                //changed by Gavin end
            }
            $_resdata["res"] = $_res;
           return json_encode($_resdata) ;
        }
    }
    
    //根据提供的用户$applyuserId，先找到其父节点，然后其他操作与get_all_children函数一致
    public function get_all_children_by_parents($applyuserId)
    {
        $_resdata = array();
        $_resdata["info"] = "no";
        if(parent::include_special_characters($applyuserId))
            return json_encode($_resdata) ;
        if($applyuserId < "1000")  //此处的作用是将查询框输入的值是1或者其他小于1000的值时，转化成输入admin
        {
            $applyuserId = "admin";
        }
        $_session_user = Session::get(USER_SEESION);
        $_userid = $_session_user["userId"];
        $_user = new Positionality();
        if($_userid < "1000")  //此处是将登陆的用户是管理员，即缓存是小于1000时，需要找到跟节点
        {
            $_CURuserId = $_user->PositionRoot();  //这里的结果就是admin
            if($applyuserId < "1000")  //当申请的节点小于1000时，转化成admin
            {
                $applyuserId = $_CURuserId;
            }
        }
        $_curid = $_user->PositionQuery($applyuserId);
        if($_curid[0]["parent"] != 0)  //普通节点，非管理员节点
        {
            $_curid = $_user->PositionQueryByID($_curid[0]["parent"]);  //找到其节点的父节点
        }
        //var_dump("ID:".$_curid[0]["ID"]);
        $_userinfo =new User_details();
        if(count($_curid) < 1)
            return json_encode($_resdata) ;
        else
        {
            $_resdata["info"] = "ok";
            $parent = $_curid[0]["ID"];//
            $curJson = $_curid[0]["json"].$parent.",";
            $_res = $_user->getAllChildByJson($curJson);
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
                //changed by Gavin start
                $_user_danshu = $_user->PositionQuery($_keys[$i]);
                $l_ds = $_user_danshu[0]["l_ds"];
                $r_ds = $_user_danshu[0]["r_ds"];
                $sq_lds = $_user_danshu[0]["sq_lds"];
                $sq_rds = $_user_danshu[0]["sq_rds"];
                //changed by Gavin end
                $_user_realname = $_userinfo->DetailsQuery($_keys[$i]);
                $_user_realname = $_user_realname[0]["user_name"];
                //changed by Gavin start
                //$_res[$_keys[$i]]["realname"] = $_user_realname;
                $_res[$_keys[$i]]["realname"] = $_user_realname."&nbsp&nbsp总：".$l_ds."&nbsp-&nbsp".$r_ds.";&nbsp剩：".$sq_lds."&nbsp-&nbsp".$sq_rds;
                //changed by Gavin end
            }
            $_resdata["res"] = $_res;
            return json_encode($_resdata) ;
        }
    }
    
    public function add_net_topology($parent)
    {
        if(parent::include_special_characters($parent))
            return false;
        $_user = new Positionality();
        //$_res = $_user->PositionInsertPrev($parent);   //这两行用于完成新建网络结构
        //return _res;
        $_res = $_user->PositionChildByJson($parent);    //这两行用于打开当前节点，展示所有孩子节点
        return json_encode($_res) ;
    }
    
    //获取当前用户$userId的推荐结构
    public function get_introducer_tree_SRC($userId)
    {
        $_resdata = array();
        $_resdata["info"] = "no";
        $tmp = array();
        //即使是错误的返回也必须先转化为约定的json格式，否则会出错
        if(parent::include_special_characters($userId))
            return json_encode($_resdata) ;
        //此处必须要用不同的变量去获取不同类的对象
        $_user_info = new User_info();
        $_res1 = $_user_info->UserSearch($userId, "", "", "", "", "");
        if(!empty($_res1))
        {
            $_resdata["info"] = "ok";
            $tmp[$_res1[0]["ID"]]["userId"] = $_res1[0]["ID"];
            $tmp[$_res1[0]["ID"]]["realName"] = $_res1[0]["user_name"];
            $tmp[$_res1[0]["ID"]]["userName"] = $_res1[0]["username"];
            $_resdata["res"] = $tmp;
        }
        else 
            return json_encode($_resdata) ;
        //此处必须要用不同的变量去获取不同类的对象
        $_user = new User_details();
        $_res = $_user->RecommanderQuery($userId);
        if(count($_res) < 1)
        {
            $tmp[$_res1[0]["ID"]]["hasRecommand"] = 0;
            return json_encode($_resdata) ;
        }
        else 
        {
            $_resdata["info"] = "ok";
            $tmp[$_res1[0]["ID"]]["hasRecommand"] = 1;
            for($i=0; $i<count($_res); $i++)
            {
                $tmp[$_res[$i]["ID"]]["userId"] = $_res[$i]["ID"];
                $tmp[$_res[$i]["ID"]]["realName"] = $_res[$i]["user_name"];
                
                //相同类产生的对象可以用相同的变量去获取
                $_user_info = new User_info();
                $_res_tmp = $_user_info->UserSearch($_res[$i]["ID"], "", "", "", "", "");
                if(count($_res_tmp) == 1)
                {
                    $tmp[$_res[$i]["ID"]]["userName"] = $_res_tmp[0]["username"];
                }
                else 
                {
                    $tmp[$_res[$i]["ID"]]["userName"] = "not invalid";
                }
                $tmp[$_res[$i]["ID"]]["hasRecommand"] = $_user->HasRecommander($_res[$i]["ID"]);
            }
             $_resdata["res"] = $tmp;
        }
        return json_encode($_resdata) ;
    }
    
    //获取当前用户$userId的推荐结构
    public function get_introducer_tree($userId)
    {
        $_resdata = array();
        $_resdata["info"] = "no";
        $tmp = array();
        //即使是错误的返回也必须先转化为约定的json格式，否则会出错
        if(parent::include_special_characters($userId))//这里检查输入是否含有特殊字符串，通过浏览器上方输入的方式访问时，字符串不能添加引号
            return json_encode($_resdata) ;
        //此处必须要用不同的变量去获取不同类的对象
        $_user_info = new User_info();
        $_res1 = $_user_info->UserSearch($userId, "", "", "", "", "");
        $tmp_ID = array();
        if(!empty($_res1))//如果当前数据不为空,也就是empty函数为false
        {
            $_resdata["info"] = "ok";
            $tmp[$_res1[0]["ID"]]["userId"] = $_res1[0]["ID"];
            $tmp[$_res1[0]["ID"]]["user_name"] = $_res1[0]["user_name"];
            $tmp[$_res1[0]["ID"]]["user_level"] = $_res1[0]["user_level"];
            
            $_user = new User_details();
            $_recommand = $_user->RecommanderQuery($userId);
            $tmp[$_res1[0]["ID"]]["children"]=$_recommand;
            
            for($i=0; $i<count($_recommand); $i++)
            {
                $tmp_ID[$i]=$_recommand[$i]["ID"];
            }
            
            $index=0;
            while($index < count($tmp_ID))
            {
                $_res1 = $_user_info->UserSearch($tmp_ID[$index], "", "", "", "", "");
                if(!empty($_res1))
                {
                    //每次查询之后，只会有一条记录，所以下标一定是0
                    $tmp[$_res1[0]["ID"]]["userId"] = $_res1[0]["ID"];
                    $tmp[$_res1[0]["ID"]]["user_name"] = $_res1[0]["user_name"];
                    $tmp[$_res1[0]["ID"]]["user_level"] = $_res1[0]["user_level"];
                    
                    $_user = new User_details();
                    $_recommand = $_user->RecommanderQuery($_res1[0]["ID"]);
                    
                    if(count($_recommand)>=1)
                    {
                 
                        $tmp[$_res1[0]["ID"]]["children"]=$_recommand;
                        $tm_count = count($tmp_ID);
                        for($i=0; $i<count($_recommand); $i++)
                        {
                            $tmp_ID[$tm_count+$i]=$_recommand[$i]["ID"];
                        }
                    }
                }
                $index = $index+1;
                $tmp[$_res1[0]["ID"]]["children"]=$_recommand;
            }
            $_resdata["res"] = $tmp;
             //($_resdata);
        }
        return json_encode($_resdata);
    }
    
    //获取当前用户$userId的推荐结构,只返回当前层
    public function get_introducer_tree_single($userId)
    {
        $_resdata = array();
        $_resdata["info"] = "no";
        $tmp = array();
        //即使是错误的返回也必须先转化为约定的json格式，否则会出错
        if(parent::include_special_characters($userId))//这里检查输入是否含有特殊字符串，通过浏览器上方输入的方式访问时，字符串不能添加引号
            return json_encode($_resdata) ;
            //此处必须要用不同的变量去获取不同类的对象
            $_user_info = new User_info();
            $_res1 = $_user_info->UserSearch($userId, "", "", "", "", "");
            $tmp_ID = array();
            if(!empty($_res1))//如果当前数据不为空,也就是empty函数为false
            {
                $_resdata["info"] = "ok";
                $tmp[$_res1[0]["ID"]]["userId"] = $_res1[0]["ID"];
                $tmp[$_res1[0]["ID"]]["user_name"] = $_res1[0]["user_name"];
                $tmp[$_res1[0]["ID"]]["user_level"] = $_res1[0]["user_level"];
    
                $_user = new User_details();
                $_recommand = $_user->RecommanderQuery($userId);
                if(count($_recommand) > 0)
                    $tmp[$_res1[0]["ID"]]["haschildren"]=true;
                else 
                    $tmp[$_res1[0]["ID"]]["haschildren"]=false;
    
                for($i=0; $i<count($_recommand); $i++)
                {
                    $tmp_ID[$i]=$_recommand[$i]["ID"];
                }
    
                $index=0;
                while($index < count($tmp_ID))
                {
                    $_res1 = $_user_info->UserSearch($tmp_ID[$index], "", "", "", "", "");
                    if(!empty($_res1))
                    {
                        //每次查询之后，只会有一条记录，所以下标一定是0
                        $tmp["children"][$_res1[0]["ID"]]["userId"] = $_res1[0]["ID"];
                        $tmp["children"][$_res1[0]["ID"]]["user_name"] = $_res1[0]["user_name"];
                        $tmp["children"][$_res1[0]["ID"]]["user_level"] = $_res1[0]["user_level"];
                    }
                    $index = $index+1;
                    $_recommand = $_user->RecommanderQuery($tmp["children"][$_res1[0]["ID"]]["userId"]);
                    if(count($_recommand) > 0)
                        $tmp["children"][$_res1[0]["ID"]]["haschildren"]=true;
                    else 
                        $tmp["children"][$_res1[0]["ID"]]["haschildren"]=false;
                }
                $_resdata["res"] = $tmp;
            }
            return json_encode($_resdata);
    }
    
    //查看当前登录用户的节点是否具有权限查看当前的参数1的推荐结构；通过检查其的所有推荐的子孙节点中，是否包含参数1这个节点
    public function checkRecommondChild($id)
    {
        $_resdata = array();
        $_resdata["success"] = false;
        $_session_user = Session::get(USER_SEESION);
        $_userid = $_session_user["userId"];

        if($_userid < "1000")
        {
            $_resdata["success"] = true;
            return json_encode($_resdata);
        }
        
        if($_userid == $id)
        {
            $_resdata["success"] = true;
            return json_encode($_resdata);
        }
    
        $_details = new User_details();
        $_details_info = $_details->DetailsQuery($id);
        while(count($_details_info))
        {
            $_recomm = $_details_info[0]["recommender"];
            if(strcmp($_recomm, $_userid)==0)
            {
                $_resdata["success"] = true;
                break;
            }
            $_details_info = $_details->DetailsQuery($_recomm);
        }
        
        return json_encode($_resdata);
    }
    
}













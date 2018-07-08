<?php
namespace app\common\model;

use think\Model;
use app\trigger\controller\External;
use think\Session;
use think\commit;
use think\paginator\driver;

class User_info extends Model
{
    public function index()
    {
        //echo 'Userinfo';
    }
    
    public function UserinfoQuery($name, $pwd)
    {
        $_where = '';
        if (!strcmp("$name", "") || !strcmp("$pwd", ""))
        {
            return;
        }
        else 
        {
            $_where = "ID = '$name'";
            $_where = "$_where and password = '$pwd'";
        }
       
        // //var_dump(urlencode($_SERVER['REQUEST_URI']));
        $_user_info = $this->where($_where)
        ->limit(4)
        ->order('ID asc')
        ->select();
        $count = count($_user_info);
        if ($count != 1)
        {
            return ;
        }
        else 
            return $_user_info;
    }
    
    public function getUserstate($userid)
    {
        $_where = '';
        if (!strcmp("$userid", ""))
        {
             //var_dump("User_info.php :username and password could not be null,line:".__LINE__);
            return;
        }
        else
        {
            $_where = "ID = '$userid'";
        }
         
        // //var_dump(urlencode($_SERVER['REQUEST_URI']));
        $_user_info = $this->where($_where)
        ->select();
        $count = count($_user_info);
        if ($count != 1)
        {
            //var_dump("username or password is not correct");
            return ;
        }
        else
            return $_user_info[0]["user_status"];
    }
    
    public function UserinfoCheckMinor($name, $pwd)
    {
        $_where = '';
        $pwd = md5($pwd."hermes");
        if (!strcmp("$name", "") || !strcmp("$pwd", ""))
        {
            //var_dump("User_info.php :username and password could not be null,line:".__LINE__);
            return;
        }
        else
        {
            $_where = "ID = '$name'";
            $_where = "$_where and minor_pwd = '$pwd'";
        }
         
        // //var_dump(urlencode($_SERVER['REQUEST_URI']));
        $_user_info = $this->where($_where)
        ->limit(4)
        ->order('ID asc')
        ->select();
        $count = count($_user_info);
        if ($count != 1)
        {
            //var_dump("username or password is not correct");
            return ;
        }
        else
            return $_user_info;
    }
    
    public function isUserExist($id)
    {
        $_where = "ID = '$id'";
        $_user_info = $this->where($_where)->select();
        $count = count($_user_info);
        if ($count < 1)
        {
            return 0;
        }
        else
            return 1;
    }
    
    public function UserinfoDel($id, $name, $pwd)//�˴���user��pwd�ǲ����˵���Ϣ����֤�������Ƿ�Ϊ��������Ա
    {
        $_where = '';
        if (!strcmp("$name", "") || !strcmp("$pwd", ""))//
        {
            //var_dump("operater's username and password could not be null");
            return;
        }
        else 
        {
            $_where = "username = '$name'";
            $_where = "$_where and password = '$pwd'";
        }
        // //var_dump(urlencode($_SERVER['REQUEST_URI'])) ;
        $res = $this->table('userinfo info,usertorole role')
        ->where("$_where and info.ID=role.user_id")
        ->select();
        $state = 0;
        if (count($res) == 1)
        {
            $role = ($res[0]->getData("role_id"));
            if($role == 15)
            {
                $state = $this->where("ID = $id")->delete();
            }
            else 
            {
                //var_dump("no priority");
            }
        }
        return $state;
    }
    
    public function UserinfoDelByForce($id)//delete userinfo record by admin
    {
        $_resdata = array();
        $_resdata["success"] = false;
        $_session_user = Session::get(USER_SEESION);
        $_userid = $_session_user["userId"];
        $state = 0;
        if($_userid < "1000")
        {
            $state = $this->where("ID = $id")->delete();
        }
        
        return $state;
    }
    
    public function UserinfoInsert($name, $pwd1, $pwd2, $ID)
    {
        $_userinfo = array('username'=>$name,
                           'password' => $pwd1,
                           'minor_pwd' => $pwd2,
                           'ID' => $ID);

        $state = $this->save($_userinfo);
        
        return $state;
    }
    
    public function UserinfoUpdate($name, $pwd)
    {
        $data = array('password'=>"$pwd");
        $state = $this-> where("username='$name'")
                      ->setField($data);
        return $state;
    }
    
    public function UserActivate($ID, $name, $minor_pwd, $level, $cost)//用户开通，激活
    {
        $_res = $this->UserinfoCheckMinor($name, $minor_pwd);
        $_id = $_res[0]->getData("ID");
        //var_dump("_id".$_id);
        //var_dump($_id);
        $_res = $this->table('helms_user_info U, helms_user_point P')
        ->where("U.ID=P.ID and U.ID = '$_id' and P.regist_point > $cost")
        ->field('U.ID,U.username,U.user_status,P.regist_point')//
        ->select();
        $_gp = new Gp_set();
        $_gpres = $_gp->GpSetQuery();
        $now_gujia = $_gpres[0]["now_price"];
        $_point_down = false;
        $_activate = false;
        //var_dump("Position : User_info.cpp".__LINE__);
        //var_dump("count:".count($_res));
        if (count($_res) == 1)
        {
            $_point = $_res[0]->getData("regist_point") - $cost;
            $_point_data = array();
            $_point_data["regist_point"] = $_point;
    
            //var_dump("point:");
            //var_dump($_point);
            //var_dump("ID:");
            //var_dump($_id);
            //更新帮助注册用户的注册分，消耗，减少
            $_point_info = new User_point();
            $_point_down = $_point_info->where("ID='$_id'")
            ->setField($_point_data);
    
            //初始化新建用户的分数
            $paramOBJ= new External();
             
            $_point_data2 = array();
            //$_point_data2["regist_point"] = 5000;
            //$_point_data2["bonus_point"] = 5100;
            $_point_data2["re_consume"] = 0;//重消分是0，产生动态奖励才会有
            $_point_data2["universal_point"] = 0;//万能分，产生静态奖金时会产生
            $_point_data2["shengyu_jing"] = $paramOBJ->getParam("register_total", $level, "") * $paramOBJ->getParam("static_max", $level, "");//7倍，比例由参数配置
            $_point_data2["shengyu_dong"] = $paramOBJ->getParam("register_total", $level, "") * $paramOBJ->getParam("dynamic_max", $level, "");//10倍
            if(count($_point_info->PointQuery($ID)) < 1)
            {
                //var_dump("User_info.php ERROR ar line:".__LINE__);
                return false;
            }
            $_point_down2 = $_point_info->where("ID='$ID'")
            ->setField($_point_data2);
             
            $_detail_info = new User_details();
            $_details_parent = $_detail_info->DetailsQuery($ID);//get current user, for get recommender;
            $_details_parent = $_detail_info->DetailsQuery($_details_parent[0]["recommender"]);
            //帮助注册人的推荐人数和路径推荐人数加一
            $parent_re_nums = $_details_parent[0]["re_nums"] + 1;
            //$parent_repath_ds = $_details_parent[0]["repath_ds"] + 1;
            $_parent_detail = array();
            $_parent_detail["re_nums"] = $parent_re_nums;
            $recommender = $_details_parent[0]["ID"];
            //$_parent_detail["repath_ds"] = $parent_repath_ds;
            $_detail_info_res = $_detail_info->where("ID='$recommender'")
            ->setField($_parent_detail);
    
            //获取当前待激活人的推荐路径
            $_details_current = $_detail_info->DetailsQuery($ID);
            if(strcmp($_details_parent[0]["repath"],"")!=0)
                $_repath = $_details_parent[0]["repath"].','.$_details_parent[0]["AUTO_ID"];
                else
                    $_repath = $_details_parent[0]["AUTO_ID"];
    
                    //var_dump("repath:".$_repath);
                    //进行拆分，去除逗号
                    $strArr =  explode(",",$_repath);
                    $recommondLevel = count($strArr);//本来需要加一，但是去除根节点之后，正好不需要加一
                    //var_dump($strArr);
                    $_detail_info = new User_details();
    
                    //更新整条推荐路径上所有节点的repath_ds
                    //var_dump("更新推荐结构信息",$level."level");
                    //var_dump("更新推荐数组",$strArr);
                     
                    switch ($level)
                    {
                        case 1:
                            foreach ($strArr as $cur)
                            {
                                $_detail_info_res = $_detail_info->where("AUTO_ID = '$cur'")
                                ->setInc('repath_ds');
                            }
    
                            break;
                        case 2:
                            foreach ($strArr as $cur)
                            {
                                $_detail_info_res = $_detail_info->where("AUTO_ID = '$cur'")
                                ->setInc('repath_ds',2);
                            }
                            break;
                        case 3:
                            foreach ($strArr as $cur)
                            {
                                $_detail_info_res = $_detail_info->where("AUTO_ID = '$cur'")
                                ->setInc('repath_ds',6);
                            }
                            break;
                        case 4:
                            foreach ($strArr as $cur)
                            {
                                $_detail_info_res = $_detail_info->where("AUTO_ID = '$cur'")
                                ->setInc('repath_ds',6);
                            }
                            break;
                        case 5:
                            foreach ($strArr as $cur)
                            {
                                $_detail_info_res = $_detail_info->where("AUTO_ID = '$cur'")
                                ->setInc('repath_ds',6);
                            }
                            break;
                        case 6:
                            foreach ($strArr as $cur)
                            {
                                $_detail_info_res = $_detail_info->where("AUTO_ID = '$cur'")
                                ->setInc('repath_ds',6);
                            }
                            break;
                        case 7:
                            foreach ($strArr as $cur)
                            {
                                $_detail_info_res = $_detail_info->where("AUTO_ID = '$cur'")
                                ->setInc('repath_ds',6);
                            }
                            break;
                        case 8:
                            foreach ($strArr as $cur)
                            {
                                $_detail_info_res = $_detail_info->where("AUTO_ID = '$cur'")
                                ->setInc('repath_ds',6);
                            }
                            break;
                        case 9:
                            foreach ($strArr as $cur)
                            {
                                $_detail_info_res = $_detail_info->where("AUTO_ID = '$cur'")
                                ->setInc('repath_ds',6);
                            }
                            break;
                        case 10:
                            foreach ($strArr as $cur)
                            {
                                $_detail_info_res = $_detail_info->where("AUTO_ID = '$cur'")
                                ->setInc('repath_ds',6);
                            }
                            break;
                        default:
                            break;
                    }
                     
                    $_detail = array();
                    $_detail["kaitongID"] = $_id;
                    $_detail["open_time"] =  date("Y-m-d H:i:s");
                    $_detail["user_level"] = $level;
                    $_detail["pay_gujia"] = $now_gujia;
                    $_detail["recommandlevel"] = $recommondLevel;//1，2，3，5 1的推荐等级是1，5的推荐等级是4，由re_path确定
                    $_detail["re_nums"] = 0;//他推荐的人数是0，此时需要加一行，推荐他的这个人的re_nums需要加一
                    $_detail["repath"] = $_repath;//推荐结构图
                    $_detail["repath_ds"] = 0;//他自己是0，整个推荐关系表中所有上级人的repath加一
                    $_detail["open_time"] = date("Y-m-d H:i:s");
    
                    if(count($_detail_info->DetailsQuery($ID)) < 1)
                    {
                        //var_dump("User_info.php ERROR ar line:".__LINE__);
                        return false;
                    }
                    $_detail_info_res = $_detail_info->where("ID='$ID'")
                    ->setField($_detail);
                    //var_dump("details info");
                    //var_dump($_detail_info_res);
                    $_status_info = array();
                    $_status_info["user_status"] = 1;
                    $_activate = $this->where("ID='$ID'")
                    ->setField($_status_info);
                    //var_dump("action res");
                    //var_dump($_activate);
        }
    
        //var_dump($_status_info);
        return true;
    }
    
    public function UserUpdate($ID, $name, $minor_pwd, $level, $cost)//用户开通，激活
    {
        $_res = $this->UserinfoCheckMinor($name, $minor_pwd);
        $_id = $_res[0]->getData("ID");
        //var_dump("_id".$_id);
        //var_dump($_id);
        $_res = $this->table('helms_user_info U, helms_user_point P')
                    ->where("U.ID=P.ID and U.ID = '$_id' and P.regist_point > $cost")
                    ->field('U.ID,U.username,U.user_status,P.regist_point')//
                    ->select();
        $_gp = new Gp_set();
        $_gpres = $_gp->GpSetQuery();
        $now_gujia = $_gpres[0]["now_price"];
        $_point_down = false;
        $_activate = false;
        //var_dump("Position : User_info.cpp".__LINE__);
        //var_dump("count:".count($_res));
        if (count($_res) == 1)
        {
            $_point = $_res[0]->getData("regist_point") - $cost;
            $_point_data = array();
            $_point_data["regist_point"] = $_point;

            //var_dump("point:");
            //var_dump($_point);
            //var_dump("ID:");
            //var_dump($_id);
            //更新帮助注册用户的注册分，消耗，减少
            $_point_info = new User_point();
            $_point_down = $_point_info->where("ID='$_id'")
                           ->setField($_point_data);
            
           //初始化新建用户的分数
           $paramOBJ= new External();
           $pointRES = $_point_info->PointQuery($ID);
           if(count($pointRES) < 1)
           {
               //var_dump("User_info.php ERROR ar line:".__LINE__);
               return false;
           }
           $_point_data2 = array();
           //$_point_data2["regist_point"] = 5000;
           //$_point_data2["bonus_point"] = 5100;
           $base_syj = $pointRES[0]["shengyu_jing"];
           $base_syd = $pointRES[0]["shengyu_dong"];
           $_point_data2["shengyu_jing"] = $cost * $paramOBJ->getParam("static_max", $level, "") + $base_syj;//7倍，比例由参数配置
           $_point_data2["shengyu_dong"] = $cost * $paramOBJ->getParam("dynamic_max", $level, "") + $base_syd;//10倍
           
           $_point_down2 = $_point_info->where("ID='$ID'")
           ->setField($_point_data2);
                           
                           
            $_detail_info = new User_details();
            $_details_parent = $_detail_info->DetailsQuery($ID);//get current user, for get recommender;
            $_details_parent = $_detail_info->DetailsQuery($_details_parent[0]["recommender"]);
            
            if(strcmp($_details_parent[0]["repath"],"")!=0)
                $_repath = $_details_parent[0]["repath"].','.$_details_parent[0]["AUTO_ID"];
            else 
                $_repath = $_details_parent[0]["AUTO_ID"];
            
            //var_dump("repath:".$_repath);
            //进行拆分，去除逗号
            $strArr =  explode(",",$_repath);
            $recommondLevel = count($strArr);//本来需要加一，但是去除根节点之后，正好不需要加一
            //var_dump($strArr);
            $_detail_info = new User_details();

            //更新整条推荐路径上所有节点的repath_ds
            //var_dump("更新推荐结构信息",$level."level");
            //var_dump("更新推荐数组",$strArr);
            
            
            $addRecmNums = $cost / 500;
            
            foreach ($strArr as $cur)
            {
                $_detail_info_res = $_detail_info->where("AUTO_ID = '$cur'")
                                                 ->setInc('repath_ds', $addRecmNums);
            }
 
            $_detail = array();
            $_detail["user_level"] = $level;
            $_detail["pay_gujia"] = $now_gujia;

            if(count($_detail_info->DetailsQuery($ID)) < 1)
            {
                //var_dump("User_info.php ERROR ar line:".__LINE__);
                return false;
            }
            $_detail_info_res = $_detail_info->where("ID='$ID'")
                                       ->setField($_detail);
            //var_dump("details info");
            //var_dump($_detail_info_res);
            //var_dump("action res");
            //var_dump($_activate);
        }
        
        return true;
    }
    
    public function updateUserPwd($ID, $pwd)
    {
        $data = array('password'=>"$pwd");
        
        $state = $this-> where("ID='$ID'")
        ->setField($data);
    }

    public function updateUserMinorPwd($ID, $minor_pwd)
    {
        $data = array('minor_pwd'=>"$minor_pwd");
    
        $state = $this-> where("ID='$ID'")
        ->setField($data);
    }
    
    //根据提供信息，查询当前用户信息
    public function UserSearch($_userid, $_username, $_telphone, $_email, $_fromtime, $_totime)
    {
        $_where = '';
        if (strcmp("$_userid", "") )
        {
            $_where = "info.ID = '$_userid'";   //���ﲻҪ=���ţ���Ϊ�������ݿ��е�ID����int����
        }
        else 
        {
            $_where = "info.ID != -1";
        }
        if (strcmp("$_username", "") )
        {
            $_where = "$_where and info.username = '$_username'";//������Ҫ�������
        }
        if (strcmp("$_telphone", "") )
        {
            $_where = "$_where and details.telphone = '$_telphone'";//�������������������ݿ����
        }
        if (strcmp("$_email", "") )
        {
            $_where = "$_where and details.email = '$_email'";
        }
        if (strcmp("$_fromtime", "") )
        {
            $_where = "$_where and details.open_time > '$_fromtime'";
        }
        if (strcmp("$_totime", "") )
        {
            $_where = "$_where and details.open_time < '$_totime'";
        }
        if (strcmp("$_where", ""))
        {
            $res = $this->table('helms_user_info info, helms_user_details details')
            ->where("$_where and info.ID=details.ID and info.user_status != 0")
            ->select();
        }
        else 
        {
            $res = $this->table('helms_user_info info, helms_user_details details')//�˴������ݿ�ǰ׺����ʡ��
            ->where("info.ID=details.ID and info.user_status != 0")
            ->select();
        }
        if(count($res) > 0)
            return $res;
        else 
            return;
    }
    
    //根据提供信息，查询当前用户信息
    public function UserSearchWithOutAdmin($_userid, $_username, $_telphone, $_email, $_fromtime, $_totime)
    {
        $_where = '';
        if (strcmp("$_userid", "") )
        {
            $_where = "info.ID = '$_userid'";   //���ﲻҪ=���ţ���Ϊ�������ݿ��е�ID����int����
        }
        else
        {
            $_where = "info.ID != -1";
        }
        if (strcmp("$_username", "") )
        {
            $_where = "$_where and info.username = '$_username'";//������Ҫ�������
        }
        if (strcmp("$_telphone", "") )
        {
            $_where = "$_where and details.telphone = '$_telphone'";//�������������������ݿ����
        }
        if (strcmp("$_email", "") )
        {
            $_where = "$_where and details.email = '$_email'";
        }
        if (strcmp("$_fromtime", "") )
        {
            $_where = "$_where and details.open_time > '$_fromtime'";
        }
        if (strcmp("$_totime", "") )
        {
            $_where = "$_where and details.open_time < '$_totime'";
        }
        if (strcmp("$_where", ""))
        {
            //changed by Gavin start model7
            $res = $this->table('helms_user_info info, helms_user_details details, helms_user_point point, helms_positionality positionality')
            ->where("$_where and info.ID=details.ID and info.user_status != 0 and details.recommender != '0' and point.ID=info.ID and positionality.user_id=info.ID")
            ->select();
            //changed by Gavin end model7
        }
        else
        {
            //changed by Gavin start model7
            $res = $this->table('helms_user_info info, helms_user_details details, helms_user_point point, helms_positionality positionality')//�˴������ݿ�ǰ׺����ʡ��
            ->where("info.ID=details.ID and info.user_status != 0 and details.recommender != '0' and point.ID=info.ID and positionality.user_id=info.ID")
            ->select();
            //changed by Gavin end model7
        }
        if(count($res) > 0)
            return $res;
            else
                return;
    }
    
    //根据提供信息，查询当前用户信息,设置每页大小和查询的是第几页
    public function UserSearchWithLimit($_userid, $_username, $_telphone, $_email, $_fromtime, $_totime)
    {
        $_where = '';
        if (strcmp("$_userid", "") )
        {
            $_where = "info.ID = '$_userid'";   //
        }
        else
        {
            $_where = "info.ID != -1";
        }
        if (strcmp("$_username", "") )
        {
            $_where = "$_where and info.username = '$_username'";//������Ҫ�������
        }
        if (strcmp("$_telphone", "") )
        {
            $_where = "$_where and details.telphone = '$_telphone'";//�������������������ݿ����
        }
        if (strcmp("$_email", "") )
        {
            $_where = "$_where and details.email = '$_email'";
        }
        if (strcmp("$_fromtime", "") )
        {
            $_where = "$_where and details.open_time > '$_fromtime'";
        }
        if (strcmp("$_totime", "") )
        {
            $_where = "$_where and details.open_time < '$_totime'";
        }
        //var_dump("where:".$_where);
        if (strcmp("$_where", ""))
        {
            $res = $this->table('helms_user_info info, helms_user_details details, helms_user_point point, helms_positionality positionality')
            ->where("$_where and info.ID=details.ID and info.user_status != 0 and details.recommender != '0' and point.ID=info.ID and positionality.user_id=info.ID")
            ->order("details.open_time desc")
            ->paginate(25);
        }
        else
        {
            $res = $this->table('helms_user_info info, helms_user_details details, helms_user_point point, helms_positionality positionality')
            ->order("details.open_time desc")
            ->where("info.ID=details.ID and info.user_status != 0 and details.recommender != '0'")
            ->paginate(25);
        }

        return $res;
    }
    
    //获取申请注册的用户列表，仅仅列出申请了但是还未激活通过
    public function UserApplication($_start="", $_end="")
    {
        $_where = '';
        if (strcmp("$_start", "") )
        {
            $_where = "details.open_time > '$_start'";   //���ﲻҪ=���ţ���Ϊ�������ݿ��е�ID����int����
        }
        else 
        {
            $_where = "(details.open_time > '1970-01-01 00:00:00' or details.open_time = '0000-00-00 00:00:00')";
        }
        if (strcmp("$_end", "") )
        {
            $_where = "$_where and details.open_time < '$_end'";//������Ҫ�������
        }

        if (strcmp("$_where", ""))
        {
            
            $res = $this->table('helms_user_info info, helms_user_details details')
            ->where("$_where and info.ID=details.ID and info.user_status = 0")
            ->field( 'details.user_name, details.telphone, details.email, details.user_level, details.open_time, helms_user_info.ID')
            ->select();
        }
        else
        {
            $res = $this->table('helms_user_info info, helms_user_details details')//�˴������ݿ�ǰ׺����ʡ��
            ->where("info.ID=details.ID and info.user_status = 0")
            ->field( 'details.user_name, details.telphone, details.email, details.user_level, details.open_time, helms_user_info.ID')
            ->select();
            
        }
        return $res;
    }
    
    
    //获取申请注册的用户列表，仅仅列出申请了但是还未激活通过
    public function UserApplicationWithLimit($_start="", $_end="")
    {
         $_where = '';
        if (strcmp("$_start", "") )
        {
            $_where = "details.open_time > '$_start'";   //���ﲻҪ=���ţ���Ϊ�������ݿ��е�ID����int����
        }
        else 
        {
            $_where = "(details.open_time > '1970-01-01 00:00:00' or details.open_time = '0000-00-00 00:00:00')";
        }
        if (strcmp("$_end", "") )
        {
            $_where = "$_where and details.open_time < '$_end'";//������Ҫ�������
        }

        if (strcmp("$_where", ""))
        {
            
            $res = $this->table('helms_user_info info, helms_user_details details')
            ->order("details.open_time desc")
            ->where("$_where and info.ID=details.ID and info.user_status = 0")
            ->field( 'details.AUTO_ID, details.portrait, details.user_name, details.telphone, details.email, details.user_level, details.open_time, helms_user_info.ID')
            ->paginate(25);
        }
        else
        {
            $res = $this->table('helms_user_info info, helms_user_details details')//�˴������ݿ�ǰ׺����ʡ��
            ->order("details.open_time desc")
            ->where("info.ID=details.ID and info.user_status = 0")
           ->field( 'details.AUTO_ID, details.portrait, details.user_name, details.telphone, details.email, details.user_level, details.open_time, helms_user_info.ID')
            ->paginate(25);
            
        }
        return $res;
    }
    
    //锁定会员时，传递会员ID，status=-1表示锁定会员，status=-2表示关闭提现，status=1表示正常会员
    public function UserinfoLock($user_id, $status)
    {
        $_session_user = Session::get(USER_SEESION);
    
        if(empty($_session_user))
        {
            return 0;
        }
        else
        {
            $_userid = $_session_user["userId"];
            if($_userid < "1000")//当前用户是管理员
            {
                $data = array('user_status'=>$status);
    
                $state = $this-> where("ID='$user_id'")
                ->setField($data);
    
                return 1;
            }
            else
                return 0;
        }
    }
    

}
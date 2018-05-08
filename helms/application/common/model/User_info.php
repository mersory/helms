<?php
namespace app\common\model;

use think\Model;

class User_info extends Model
{
    public function index()
    {
        echo 'Userinfo';
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
       
        // var_dump(urlencode($_SERVER['REQUEST_URI']));
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
    
    public function UserinfoCheckMinor($name, $pwd)
    {
        $_where = '';
        if (!strcmp("$name", "") || !strcmp("$pwd", ""))
        {
            var_dump("username and password could not be null");
            return;
        }
        else
        {
            $_where = "ID = '$name'";
            $_where = "$_where and minor_pwd = '$pwd'";
        }
         
        // var_dump(urlencode($_SERVER['REQUEST_URI']));
        $_user_info = $this->where($_where)
        ->limit(4)
        ->order('ID asc')
        ->select();
        $count = count($_user_info);
        if ($count != 1)
        {
            var_dump("username or password is not correct");
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
            var_dump("operater's username and password could not be null");
            return;
        }
        else 
        {
            $_where = "username = '$name'";
            $_where = "$_where and password = '$pwd'";
        }
        // var_dump(urlencode($_SERVER['REQUEST_URI'])) ;
        $res = $this->table('userinfo info,usertorole role')
        ->where("$_where and info.ID=role.user_id")
        ->select();
        $state = 0;
        if (count($res) == 1)
        {
            $role = ($res[0]->getData("role_id"));
            if($role == 15)
            {
                $this->startTrans();
                $state = $this->where("ID = $id")->delete();
                if ($state)
                {
                    $this->commit();
                }
                else
                {
                    $this->rollback();
                }
            }
            else 
            {
                var_dump("no priority");
            }
        }
        return $state;
    }
    
    public function UserinfoInsert($name, $pwd1, $pwd2, $ID)
    {
        $_userinfo = array('username'=>$name,
                           'password' => $pwd1,
                           'minor_pwd' => $pwd2,
                           'ID' => $ID);
        $this->startTrans();
        //var_dump("userinfoInsertstate:");
        $state = $this->save($_userinfo);
        if ($state)
        {
            //var_dump($state);
            $this->commit();
        }
        else
        {
            $this->rollback();
            //var_dump($state);
        }
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
        var_dump($_id);
        $_res = $this->table('helms_user_info U, helms_user_point P')
                    ->where("U.ID=P.ID and U.ID = '$_id' and P.regist_point > $cost")
                    ->field('U.ID,U.username,U.user_status,P.regist_point')//
                    ->select();
        $_gp = new Gp_set();
        $_gpres = $_gp->GpSetQuery();
        $now_gujia = $_gpres[0]["now_price"];
        $_point_down = false;
        $_activate = false;
        if (count($_res) == 1)
        {
            $_point = $_res[0]->getData("regist_point") - $cost;
            $_point_data = array();
            $_point_data["regist_point"] = $_point;

            var_dump("point:");
            var_dump($_point);
            var_dump("ID:");
            var_dump($_id);
            //更新帮助注册用户的注册分，消耗，减少
            $_point_info = new User_point();
            $_point_down = $_point_info->where("ID='$_id'")
                           ->setField($_point_data);
            
           //初始化新建用户的分数--这段可以去掉
           $_point_data2 = array();
           //$_point_data2["regist_point"] = 5000;
           //$_point_data2["bonus_point"] = 5100;
           $_point_data2["re_consume"] = 0;//重消分是0，产生动态奖励才会有
           $_point_data2["universal_point"] = 0;//万能分，产生静态奖金时会产生
           $_point_data2["shengyu_jing"] = 3500;//7倍，比例由参数配置
           $_point_data2["shengyu_dong"] = 5000;//10倍
           if(count($_point_info->PointQuery($ID)) < 1)
           {
               var_dump("User_info.php ERROR ar line:".__LINE__);
               return false;
           }
           $_point_down2 = $_point_info->where("ID='$ID'")
           ->setField($_point_data2);
                           
                           
            $_detail = array();
            $_detail["kaitongID"] = $_id;
            $_detail["open_time"] =  date("Y-m-d H:i:s");
            $_detail["user_level"] = $level;
            $_detail["pay_gujia"] = $now_gujia;
            $_detail["recommandlevel"] = 1;//1，2，3，5 1的推荐等级是1，5的推荐等级是4，由re_path确定
            $_detail["re_nums"] = 0;//他推荐的人数是0，此时需要加一行，推荐他的这个人的re_nums需要加一
            $_detail["repath"] = 0;//推荐结构图
            $_detail["repath_ds"] = 2;//他自己是0，整个推荐关系表中所有上级人的repath加一
            $_detail_info = new User_details();
            if(count($_detail_info->DetailsQuery($ID)) < 1)
            {
                var_dump("User_info.php ERROR ar line:".__LINE__);
                return false;
            }
            $_detail_info_res = $_detail_info->where("ID='$ID'")
                                       ->setField($_detail);
            var_dump("details info");
            var_dump($_detail_info_res);
            $_status_info = array();
            $_status_info["user_status"] = 1; 
            $_activate = $this->where("ID='$ID'")
                              ->setField($_status_info);
            var_dump("action res");
            var_dump($_activate);
        }
        
        var_dump($_status_info);
        return true;
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
            ->where("$_where and info.ID=details.ID")
            ->select();
        }
        else 
        {
            $res = $this->table('helms_user_info info, helms_user_details details')//�˴������ݿ�ǰ׺����ʡ��
            ->where("info.ID=details.ID")
            ->select();
        }
        if(count($res) > 0)
            return $res;
        else 
            return;
    }
    
    //获取申请注册的用户列表，仅仅列出申请了但是还未激活通过
    public function UserApplication($_start, $_end)
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
            //var_dump("where:".$_where);
            $res = $this->table('helms_user_info info, helms_user_details details')
            ->where("$_where and info.ID=details.ID and info.user_status = 0")
            ->field( 'details.user_name, details.telphone, details.email, details.open_time, helms_user_info.ID')
            ->select();
        }
        else
        {
            //var_dump("not none");
            $res = $this->table('helms_user_info info, helms_user_details details')//�˴������ݿ�ǰ׺����ʡ��
            ->where("info.ID=details.ID and info.user_status = 0")
            ->field( 'details.user_name, details.telphone, details.email, details.open_time, helms_user_info.ID')
            ->select();
        }
        return $res;
    }
    
    
    
    
    
    
    
}
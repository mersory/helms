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
            var_dump("username and password could not be null");
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
            var_dump("username or password is not correct");
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
            var_dump($state);
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
    
    public function UserActivate($ID, $name, $pwd, $cost)//$ID�Ǳ�������ID������������Ϊ��������Ϣ
    {
        $_res = $this->UserinfoQuery($name, $pwd);
        //var_dump($_res);
        $_id = $_res[0]->getData("ID");
        echo "ID:";
        echo $_id;
        echo "<br/>";
        $_res = $this
        ->table('Userinfo U, Userpoint P')
        ->where("U.ID=P.ID and U.ID = $_id and P.regist_point > $cost")
        ->field('U.ID,U.username,U.user_status,P.regist_point')//�����fieldһ��Ҫ�������forѭ����getDataһ��
        ->select();
        var_dump($_res[0]);
        if (count($_res) == 1)
        {
            $_point = $_res[0]->getData("regist_point") - $cost;
            $_point_data = array();
            $_point_data["regist_point"] = $_point;
            var_dump($_point_data);
            echo "<br/>";
            echo $_id;
            $this->startTrans();
            $_point_info = new User_point();
            $_point_down = $_point_info->where("ID=$_id")
                           ->setField($_point_data);
            $_detail = array();
            $_detail["activator"] = $_id;
            $_detail_info = new User_details();
            $_detail_info = $_detail_info->where("ID=$ID")
                                       ->setField($_detail);
            $_status_info = array();
            $_status_info["user_status"] = 1; 
            $_activate = $this->where("ID=$ID")
                              ->setField($_status_info);
            if ($_point_down && $_activate)
            {
                $this->commit();
                var_dump("activate commit");
            }
            else 
            {
                $this->rollback();
                var_dump("activate roll back");
            }
        }
        return $_point_down && $_activate;
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
        if(count($res) == 1)
            return $res;
        else 
            return;
    }
    
    public function UserApplication($_start, $_end)
    {
        $_where = '';
        if (strcmp("$_start", "") )
        {
            $_where = "details.open_time > '$_start'";   //���ﲻҪ=���ţ���Ϊ�������ݿ��е�ID����int����
        }
        else 
        {
            $_where = "details.open_time > '1970-01-01 00:00:00'";
        }
        if (strcmp("$_end", "") )
        {
            $_where = "$_where and details.open_time < '$_end'";//������Ҫ�������
        }
        if (strcmp("$_where", ""))
        {
            $res = $this->table('helms_user_info info, helms_user_details details')
            ->where("$_where and info.ID=details.ID and info.user_status = 0")
            ->field( 'details.user_name, details.telphone, details.email, details.open_time, helms_user_info.ID')
            ->select();
        }
        else
        {
            $res = $this->table('helms_user_info info, helms_user_details details')//�˴������ݿ�ǰ׺����ʡ��
            ->where("info.ID=details.ID and info.user_status = 0")
            ->field( 'details.user_name, details.telphone, details.email, details.open_time, helms_user_info.ID')
            ->select();
        }
        return $res;
    }
    
    
    
    
    
    
    
}
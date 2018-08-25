<?php
namespace app\common\model;

use think\Model;

class User_log extends Model
{
    public function index()
    {
        var_dump("User Log");
    }
    
    public function UserLogQuery($time)//���������Ĳ��ҷ�ʽ���˴�ֻ�г���һ��
    {
        $_where = '';
        if ($time != -1)
        {
            $_where = "`current_time` > $time";  //ʱ���ֶβ�ѯʱ��Ҫ������Ͻǵķ���
        }
        ////echo $_where;
        $_price_info = $this->where($_where)
        ->select();
        $count = count($_price_info);
        if ($count < 1)
        {
            //var_dump("Historical.php ID :$time not exsist".__LINE__);
            return ;
        }
        return $_price_info;
    }
    
    public function UserLogQueryByTiem($from, $to)//查询期间段内历史股价
    {
        $_where = '';
        
        if (strcmp("$from", "") )
        {
            $_where = "current_time > '$from'";   //���ﲻҪ=���ţ���Ϊ�������ݿ��е�ID����int����
        }
        if (strcmp("$to", "") )
        {
            if($_where == "")
            {
                $_where = "current_time < '$to'";//������Ҫ�������
            }
            else 
            {
                $_where = "$_where and current_time < '$to'";//������Ҫ�������
            }
        }
        
        $_price_info = $this
        ->select();
        $count = count($_price_info);
        if ($count < 1)
        {
            return ;
        }
        return $_price_info;
    }
    
    
    public function UserLogInsert( $userid, $action)
    {
        $_UserLoginfo = array();
        $ip = $_SERVER["REMOTE_ADDR"];
        $url='http://ip.taobao.com/service/getIpInfo.php?ip='.$ip;
        $code_json=file_get_contents($url);
        $json = json_decode($code_json,true);
        $shengfen=$json['data']['region'];//获取省份
        $shi=$json['data']['city'];//获取市
        $location = $shengfen.$shi;
        if (strcmp($userid, "") )
        {
            $_UserLoginfo["userid"] = $userid;
        }
        
        if (strcmp($ip, "") )
        {
            $_UserLoginfo["ip"] = $ip;
        }
        
        if (strcmp($action, "") )
        {
            $_UserLoginfo["action"] = $action;
        }
        
        if (strcmp($location, "") )
        {
            $_UserLoginfo["city"] = $location;
        }
        
        $_UserLoginfo["time"] = date("Y-m-d H:i:s");
        
        $state = $this->save($_UserLoginfo);
        
        return $state;
    }
    
    public function UserLogQueryWithLimit($_id="", $_start="", $_end="")//
    {
        $_where = '';
        if (strcmp("$_id", ""))
        {
            $_where = "userid = '$_id'";
        }
        else
        {
            $_where = "userid != -1";
        }
        if (strcmp("$_start", ""))
        {
            $_where = "$_where and time >= '$_start'";
        }
        if (strcmp("$_end", "") )
        {
            $_where = "$_where and time <= '$_end'";
        }
        if (strcmp("$_where", ""))
        {
            $res = $this->order("time desc")
            ->where($_where)
            ->field( 'userid, time, ip, action')
            ->paginate(25,false,['query' => request()->param()]);
        }
        else
        {
            $res = $this->order("time desc")
            ->field( 'userid, time, ip, action' )
            ->select()
            ->paginate(25,false,['query' => request()->param()]);
        }
        return $res;
    }
    
}
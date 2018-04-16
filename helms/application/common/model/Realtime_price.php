<?php
namespace app\common\model;

use think\Model;

class Realtime_price extends Model
{
    public function index()
    {
        var_dump("Userdetails");
    }
    
    public function RealtimepriceQuery($time)//���������Ĳ��ҷ�ʽ���˴�ֻ�г���һ��
    {
        $_where = '';
        if ($time != -1)
        {
            $_where = "`current_time` > $time";  //ʱ���ֶβ�ѯʱ��Ҫ������Ͻǵķ���
        }
        echo $_where;
        $_offline_info = $this->where($_where)
        ->select();
        $count = count($_offline_info);
        if ($count < 1)
        {
            var_dump("Realtime.php ID :$time not exsist".__LINE__);
            return ;
        }
        return $_offline_info;
    }
    
    public function RealtimepriceInsert( $latest_price)
    {
        $_realtimepriceinfo = array();
        if ($latest_price >=0)
        {
            $_realtimepriceinfo["latest_price"] = $latest_price;
        }
        $_realtimepriceinfo["current_time"] = date("Y-m-d H:i:s");
        $this->startTrans();
        $state = $this->save($_realtimepriceinfo);
        if ($state)
        {
            $this->commit();
        }
        else
        {
            $this->rollback();
        }
        return $state;
    }
    
}
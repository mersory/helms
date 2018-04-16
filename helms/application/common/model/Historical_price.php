<?php
namespace app\common\model;

use think\Model;

class Historical_price extends Model
{
    public function index()
    {
        var_dump("Userdetails");
    }
    
    public function HistoricalpriceQuery($time)//���������Ĳ��ҷ�ʽ���˴�ֻ�г���һ��
    {
        $_where = '';
        if ($time != -1)
        {
            $_where = "`current_time` > $time";  //ʱ���ֶβ�ѯʱ��Ҫ������Ͻǵķ���
        }
        //echo $_where;
        $_price_info = $this->where($_where)
        ->select();
        $count = count($_price_info);
        if ($count < 1)
        {
            var_dump("Historical.php ID :$time not exsist".__LINE__);
            return ;
        }
        return $_price_info;
    }
    
    public function HistoricalpriceQueryByTiem($from, $to)//查询期间段内历史股价
    {
        $_where = '';
        if ($from != -1)
        {
            $_where = "`current_time` > '$from' and `current_time` < '$to'";  //
        }
        $_price_info = $this->where($_where)
        ->select();
        $count = count($_price_info);
        if ($count < 1)
        {
            return ;
        }
        return $_price_info;
    }
    
    
    public function HistoricalpriceInsert( $share_price)
    {
        $_historicalpriceinfo = array();
        if ($share_price >=0)
        {
            $_historicalpriceinfo["share_price"] = $share_price;
        }
        $_historicalpriceinfo["current_time"] = date("Y-m-d H:i:s");
        $this->startTrans();
        $state = $this->save($_historicalpriceinfo);
        if ($state)
        {
            $this->commit();
            var_dump("HistoricalpriceInsert commit");
        }
        else
        {
            $this->rollback();
            var_dump("HistoricalpriceInsert rollback");
        }
        return $state;
    }
    
}
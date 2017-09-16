<?php
namespace app\common\model;

use think\Model;

class Income_expenditure extends Model
{
    public function index()
    {
        var_dump("Userdetails");
    }
    
    public function IncomeExpenditureQuery($record_id)//还有其他的查找方式，此处只列出这一个
    {
        $_where = '';
        if ($record_id != -1)
        {
            $_where = "record_id = $record_id";
        }
        $_withdrawal_info = $this->where($_where)
        ->select();
        $count = count($_withdrawal_info);
        if ($count < 1)
        {
            var_dump("ID :$record_id not exsist");
            return ;
        }
        return $_withdrawal_info;
    }
    
    public function IncomeExpenditureQueryByTime($_start, $_end)
    {
        $_where = '';
        if (strcmp("$_start", "") )
        {
            $_where = "count_time > '$_start'";   //这里不要=引号，因为传入数据库中的ID就是int类型
        }
        else
        {
            $_where = "count_time > '1970-01-01 00:00:00'";
        }
        if (strcmp("$_end", "") )
        {
            $_where = "$_where and count_time < '$_end'";//这里需要添加引号
        }
        if (strcmp("$_where", ""))
        {
            $res = $this->where($_where)
                        ->field( 'user_id, deal_count, current_profit, count_time')
                        ->select();
        }
        else
        {
            $res = $this->field( 'user_id, deal_count, current_profit, count_time')
                        ->select();
        }
        return $res;
    }
    
    
    public function IncomeExpenditureDel($record_id)
    {
        $_where = '';
        if ($record_id > -1)
        {
            $_where = "record_id = $record_id";
        }
        echo $_where;
        $this->startTrans();
        $state = $this->where($_where)->delete();
        if ($state)
        {
            $this->commit();
            var_dump("commit");
        }
        else
        {
            $this->rollback();
            var_dump("rollback");
        }
        return $state;
    }
    
    public function IncomeExpenditureInsert($deal_count, $incomings, $outgoing, $current_profit, $out_contrast_in)
    {
        $_inandoutinfo = array();
        if ($deal_count >=0)
        {
            $_inandoutinfo["deal_count"] = $deal_count;
        }
    
        if ($incomings >=0)
        {
            $_inandoutinfo["incomings"] = $incomings;
        }
         
        if ($outgoing >=0)
        {
            $_inandoutinfo["outgoing"] = $outgoing;
        }
    
        if ($current_profit >=0)
        {
            $_inandoutinfo["current_profit"] = $current_profit;//一般这里只能为0，表示申请提交，还没审核
        }
        if ($out_contrast_in >=0)
        {
            $_inandoutinfo["out_contrast_in"] = $out_contrast_in;
        }
        $_inandoutinfo["count_time"] = date("Y-m-d H:i:s");
        $this->startTrans();
        $state = $this->save($_inandoutinfo);
        if ($state)
        {
            $this->commit();
            var_dump("Details insert commit");
        }
        else
        {
            $this->rollback();
            var_dump("Details insert rollback");
        }
        return $state;
    }
    
    public function IncomeExpenditureUpdate($record_id, $deal_count, $incomings, $outgoing, $current_profit, $out_contrast_in)
    {
        $_inandoutinfo = array();
        if ($deal_count >=0)
        {
            $_inandoutinfo["deal_count"] = $deal_count;
        }
    
        if ($incomings >=0)
        {
            $_inandoutinfo["incomings"] = $incomings;
        }
         
        if ($outgoing >=0)
        {
            $_inandoutinfo["outgoing"] = $outgoing;
        }
    
        if ($current_profit >=0)
        {
            $_inandoutinfo["current_profit"] = $current_profit;//一般这里只能为0，表示申请提交，还没审核
        }
        if ($out_contrast_in >=0)
        {
            $_inandoutinfo["out_contrast_in"] = $out_contrast_in;
        }
        $_inandoutinfo["count_time"] = date("Y-m-d H:i:s");
        $state = $this-> where("record_id=$record_id")
        ->setField($_inandoutinfo);
        return $state;
    }
}
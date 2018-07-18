<?php
namespace app\common\model;

use think\Model;

class Income_expenditure extends Model
{
    public function index()
    {
        //var_dump("Userdetails");
    }
    
    public function IncomeExpenditureQuery($record_id)//���������Ĳ��ҷ�ʽ���˴�ֻ�г���һ��
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
            //var_dump("Income_expence.php ID :$record_id not exsist".__LINE__);
            return ;
        }
        return $_withdrawal_info;
    }
    
    public function IncomeExpenditureQueryByTime($_start, $_end)
    {
        $_where = '';
        if (strcmp("$_start", "") )
        {
            $_where = "count_time >= '$_start'";   //���ﲻҪ=���ţ���Ϊ�������ݿ��е�ID����int����
        }
        else
        {
            $_where = "count_time >= '1970-01-01 00:00:00'";
        }
        if (strcmp("$_end", "") )
        {
            $_where = "$_where and count_time <= '$_end'";//������Ҫ�������
        }
        if (strcmp("$_where", ""))
        {
            $res = $this->where($_where)
                        ->field( 'record_id, user_id, outgoing, incomings, deal_count, current_profit, count_time, comment')
                        ->select();
        }
        else
        {
            $res = $this->field( 'record_id, user_id, outgoing, incomings, deal_count, current_profit, count_time, comment')
                        ->select();
        }
        return $res;
    }
    
    public function IncomeExpenditureQueryByTimeWithLimit($_start="", $_end="")
    {
        $_where = '';
        if (strcmp("$_start", "") )
        {
            $_where = "count_time > '$_start'";   //���ﲻҪ=���ţ���Ϊ�������ݿ��е�ID����int����
        }
        else
        {
            $_where = "count_time > '1970-01-01 00:00:00'";
        }
        if (strcmp("$_end", "") )
        {
            $_where = "$_where and count_time < '$_end'";//������Ҫ�������
        }
        
        if (strcmp("$_where", ""))
        {
            $res = $this->order("count_time desc")
            ->where($_where)
            ->field( 'record_id, incomings, outgoing, current_profit, count_time, out_contrast_in')
            ->paginate(25,false,['query' => request()->param()]);
        }
        else
        {
            $res = $this->order("count_time desc")
                        ->field( 'record_id, incomings, outgoing, current_profit, count_time, out_contrast_in')
                        ->paginate(25,false,['query' => request()->param()]);
        }
        return $res;
    }
    
    public function sumIncomeExpenditureQueryByTimeWithLimit($_start="", $_end="")
    {
        $_where = '';
        if (strcmp("$_start", "") )
        {
            $_where = "count_time > '$_start'";
        }
        else
        {
            $_where = "count_time > '1970-01-01 00:00:00'";
        }
        if (strcmp("$_end", "") )
        {
            $_where = "$_where and count_time < '$_end'";
        }
    
        if (strcmp("$_where", ""))
        {
            $res = $this->order("count_time desc")
            ->where($_where)
            ->field( 'sum(incomings) as incomingSum, sum(outgoing) as outgoingSum, sum(current_profit) profitSum, sum(outgoing)/sum(incomings) as precent')
            ->select();
        }
        else
        {
            $res = $this->order("count_time desc")
            ->field( 'sum(incomings) as incomingSum, sum(outgoing) as outgoingSum, sum(current_profit) profitSum, sum(outgoing)/sum(incomings) as precent')
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
        
        $state = $this->where($_where)->delete();
       
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
    
        if ($current_profit != -999999)
        {
            $_inandoutinfo["current_profit"] = $current_profit;//һ������ֻ��Ϊ0����ʾ�����ύ����û���
        }
        if ($out_contrast_in >=0)
        {
            $_inandoutinfo["out_contrast_in"] = $out_contrast_in;
        }
        $endtime=date("Y-m-d H:i:s",mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1);
        $_inandoutinfo["count_time"] = $endtime;
        
        $state = $this->save($_inandoutinfo);
        
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
    
        if ($current_profit != -999999)
        {
            $_inandoutinfo["current_profit"] = $current_profit;//һ������ֻ��Ϊ0����ʾ�����ύ����û���
        }
        if ($out_contrast_in >=0)
        {
            $_inandoutinfo["out_contrast_in"] = $out_contrast_in;
        }

        $state = $this-> where("record_id=$record_id")
        ->setField($_inandoutinfo);
        return $state;
    }
}
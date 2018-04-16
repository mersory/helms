<?php
namespace app\common\model;

use think\Model;

class Deal_info extends Model
{
    public function index()
    {
        var_dump("Userdetails");
    }
    
    public function DealinfoQuery($deal_id)//���������Ĳ��ҷ�ʽ���˴�ֻ�г���һ��
    {
        $_where = '';
        if ($deal_id != -1)
        {
            $_where = "deal_id = $deal_id";
        }
        $_deal_info = $this->where($_where)
        ->select();
        $count = count($_deal_info);
        if ($count < 1)
        {
            var_dump("Deal_info.php ID :$deal_id not exsist".__LINE__);
            return ;
        }
        return $_deal_info;
    }
    
    public function DealQueryByTime($_start, $_end)
    {
        $_where = '';
        if (strcmp("$_start", "") )
        {
            $_where = "deal_time > '$_start'";   //���ﲻҪ=���ţ���Ϊ�������ݿ��е�ID����int����
        }
        else
        {
            $_where = "deal_time > '1970-01-01 00:00:00'";
        }
        if (strcmp("$_end", "") )
        {
            $_where = "$_where and deal_time < '$_end'";//������Ҫ�������
        }
        if (strcmp("$_where", ""))
        {
            $res = $this->where($_where)
            ->field( 'user_id, deal_time, deal_type, deal_sum, details')
            ->select();
        }
        else
        {
            $res = $this->field( 'user_id, deal_time, deal_type, deal_sum, details')
            ->select();
        }
        return $res;
    }
    
    public function DealinfoDel($deal_id)
    {
        $_where = '';
        if ($deal_id > -1)
        {
            $_where = "deal_id = $deal_id";
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
    
    public function DealinfoInsert($user_id, $deal_type=1, $ok_money, $ok_nums, $cf_gp, $details, $status, $pay_gujia)
    {
        $_dealinfo = array();
    
        if ($user_id >=0)
        {
            $_dealinfo["user_id"] = $user_id;
        }
         
        if ($deal_type >=0)
        {
            $_dealinfo["deal_type"] = $deal_type;
        }
    
        if ($ok_money >=0)
        {
            $_dealinfo["ok_money"] = $ok_money;//һ������ֻ��Ϊ0����ʾ�����ύ����û���
        }
        
        if ($ok_nums >=0)
        {
            $_dealinfo["ok_nums"] = $ok_nums;
        }
        
        if ($cf_gp >=0)
        {
            $_dealinfo["cf_gp"] = $cf_gp;
        }
         
        if ($details >=0)
        {
            $_dealinfo["details"] = $details;
        }
        
        if ($status >=0)
        {
            $_dealinfo["status"] = $status;//һ������ֻ��Ϊ0����ʾ�����ύ����û���
        }
        
        if ($pay_gujia >=0)
        {
            $_dealinfo["pay_gujia"] = $pay_gujia;//һ������ֻ��Ϊ0����ʾ�����ύ����û���
        }
        
        $_dealinfo["deal_time"] = date("Y-m-d H:i:s");
        $this->startTrans();
        $state = $this->save($_dealinfo);
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
    
    public function DealinfoUpdate($deal_id, $user_id, $deal_type, $deal_sum)
    {
        $_dealinfo = array();
        if ($user_id >=0)
        {
            $_dealinfo["user_id"] = $user_id;
        }
         
        if ($deal_type >=0)
        {
            $_dealinfo["deal_type"] = $deal_type;
        }
    
        if ($deal_sum >=0)
        {
            $_dealinfo["deal_sum"] = $deal_sum;//һ������ֻ��Ϊ0����ʾ�����ύ����û���
        }
        $_dealinfo["deal_time"] = date("Y-m-d H:i:s");
        $state = $this-> where("deal_id=$deal_id")
        ->setField($_dealinfo);
        return $state;
    }
}
<?php
namespace app\common\model;

use think\Model;

class Deal_info extends Model
{
    public function index()
    {
        var_dump("Userdetails");
    }
    
    public function DealinfoQuery($deal_id)//还有其他的查找方式，此处只列出这一个
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
            var_dump("ID :$deal_id not exsist");
            return ;
        }
        return $_deal_info;
    }
    
    public function DealQueryByTime($_start, $_end)
    {
        $_where = '';
        if (strcmp("$_start", "") )
        {
            $_where = "deal_time > '$_start'";   //这里不要=引号，因为传入数据库中的ID就是int类型
        }
        else
        {
            $_where = "deal_time > '1970-01-01 00:00:00'";
        }
        if (strcmp("$_end", "") )
        {
            $_where = "$_where and deal_time < '$_end'";//这里需要添加引号
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
    
    public function DealinfoInsert($deal_id, $user_id, $deal_type, $deal_sum)
    {
        $_dealinfo = array();
        if ($deal_id >=0)
        {
            $_dealinfo["deal_id"] = $deal_id;
        }
    
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
            $_dealinfo["deal_sum"] = $deal_sum;//一般这里只能为0，表示申请提交，还没审核
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
            $_dealinfo["deal_sum"] = $deal_sum;//一般这里只能为0，表示申请提交，还没审核
        }
        $_dealinfo["deal_time"] = date("Y-m-d H:i:s");
        $state = $this-> where("deal_id=$deal_id")
        ->setField($_dealinfo);
        return $state;
    }
}
<?php
namespace app\common\model;

use think\Model;

class Point_transform_record extends Model
{
    public function index()
    {
        //var_dump("Userdetails");
    }

    public function PointTransformQuery($deal_id)//���������Ĳ��ҷ�ʽ���˴�ֻ�г���һ��
    {
        $_where = '';
        if ($deal_id != -1)
        {
            $_where = "user_id = $deal_id";
        }
        $_deal_info = $this->where($_where)
        ->select();
        $count = count($_deal_info);
        if ($count < 1)
        {
            //var_dump("Point_transform.php ID :$deal_id not exsist".__LINE__);
            return ;
        }
        return $_deal_info;
    }

    public function PointTransformQueryBy($_id, $_start, $_end)
    {
        $_where = '';
        if (strcmp("$_id", ""))
        {
            $_where = "user_id = '$_id'";
        }
        else 
        {
            $_where = "user_id != -1";
        }
        if (strcmp("$_start", ""))
        {
            $_where = "$_where and point_change_time >= '$_start'";//������Ҫ�������   //���ﲻҪ=���ţ���Ϊ�������ݿ��е�ID����int����
        }
        if (strcmp("$_end", "") )
        {
            $_where = "$_where and point_change_time <= '$_end'";//������Ҫ�������
        }
        if (strcmp("$_where", ""))
        {
            $res = $this->where($_where)
            ->field( 'user_id, 	point_change_type, 	point_change_sum, point_change_time')
            ->select();
        }
        else
        {
            $res = $this->field( 'user_id, 	point_change_type, 	point_change_sum, point_change_time')
            ->select();
        }
        return $res;
    }
    
    public function PointTransformQueryByWithLimit($_id, $_start, $_end, $_pagesize=25, $_pageindex=0)
    {
        $_where = '';
        if (strcmp("$_id", ""))
        {
            $_where = "user_id = '$_id'";
        }
        else
        {
            $_where = "user_id != -1";
        }
        if (strcmp("$_start", ""))
        {
            $_where = "$_where and point_change_time >= '$_start'";//������Ҫ�������   //���ﲻҪ=���ţ���Ϊ�������ݿ��е�ID����int����
        }
        if (strcmp("$_end", "") )
        {
            $_where = "$_where and point_change_time <= '$_end'";//������Ҫ�������
        }
        if (strcmp("$_where", ""))
        {
            $res = $this->limit($_pagesize * $_pageindex, $_pagesize)
            ->where($_where)
            ->field( 'user_id, 	point_change_type, 	point_change_sum, point_change_time')
            ->select();
        }
        else
        {
            $res = $this->limit($_pagesize * $_pageindex, $_pagesize)
            ->field( 'user_id, 	point_change_type, 	point_change_sum, point_change_time')
            ->select();
        }
        return $res;
    }

    public function PointTransformInsert($user_id, $point_type, $point_change_type, $point_change_sum)
    {
        $_pointtransform = array();

        if ($user_id >=0)
        {
            $_pointtransform["user_id"] = $user_id;
        }
         
        if ($point_type >=0)
        {
            $_pointtransform["point_type"] = $point_type;
        }
        
        if ($point_change_type >=0)
        {
            $_pointtransform["point_change_type"] = $point_change_type;
        }

        if ($point_change_sum >=0)
        {
            $_pointtransform["point_change_sum"] = $point_change_sum;//һ������ֻ��Ϊ0����ʾ�����ύ����û���
        }
        $_pointtransform["point_change_time"] = date("Y-m-d H:i:s");
        
        $state = $this->save($_pointtransform);
        
        return $state;
    }

    public function PointTransformUpdate($deal_id, $user_id, $deal_type, $deal_sum)
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
<?php
namespace app\common\model;

use think\Model;

class Point_transform_record extends Model
{
    public function index()
    {
        var_dump("Userdetails");
    }

    public function PointTransformQuery($deal_id)//还有其他的查找方式，此处只列出这一个
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
            var_dump("ID :$deal_id not exsist");
            return ;
        }
        return $_deal_info;
    }

    public function PointTransformQueryBy($_id, $_start, $_end)
    {
        $_where = '';
        if (strcmp("$_id", ""))
        {
            $_where = "user_id = $_id";
        }
        else 
        {
            $_where = "user_id != -1";
        }
        if (strcmp("$_start", ""))
        {
            $_where = "$_where and point_change_time >= '$_start'";//这里需要添加引号   //这里不要=引号，因为传入数据库中的ID就是int类型
        }
        if (strcmp("$_end", "") )
        {
            $_where = "$_where and point_change_time <= '$_end'";//这里需要添加引号
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

    public function PointTransformInsert($point_id, $user_id, $point_type, $point_change_sum, $point_change_type)
    {
        $_pointtransform = array();
        if ($point_id >=0)
        {
            $_pointtransform["POINT_ID"] = $point_id;
        }

        if ($user_id >=0)
        {
            $_pointtransform["user_id"] = $user_id;
        }
         
        if ($point_type >=0)
        {
            $_pointtransform["point_type"] = $point_type;
        }

        if ($point_change_sum >=0)
        {
            $_pointtransform["point_change_sum"] = $point_change_sum;//一般这里只能为0，表示申请提交，还没审核
        }
        $_pointtransform["point_change_time"] = date("Y-m-d H:i:s");
        $this->startTrans();
        $state = $this->save($_pointtransform);
        if ($state)
        {
            $this->commit();
            var_dump("pointtransform insert commit");
        }
        else
        {
            $this->rollback();
            var_dump("pointtransform insert rollback");
        }
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
            $_dealinfo["deal_sum"] = $deal_sum;//一般这里只能为0，表示申请提交，还没审核
        }
        $_dealinfo["deal_time"] = date("Y-m-d H:i:s");
        $state = $this-> where("deal_id=$deal_id")
        ->setField($_dealinfo);
        return $state;
    }
}
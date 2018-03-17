<?php
namespace app\common\model;

use think\Model;

class User_details extends Model
{
    public function index()
    {
        var_dump("Userdetails");
    }
    
    public function DetailsQuery($user_id)
    {
        $_where = '';
        if ($user_id != -1)
        {
            $_where = "ID = '$user_id'";
        }
        $_details_info = $this->where($_where)
        ->select();
        $count = count($_details_info);
        if ($count < 1)
        {
            return ;
        }
        return $_details_info;
    }
    
    public function DetailsQueryByAutoId($id)
    {
        $_where = '';
        if ($id != -1)
        {
            $_where = "AUTO_ID = $id";
        }
        $_details_info = $this->where($_where)
        ->select();
        $count = count($_details_info);
        if ($count < 1)
        {
            return ;
        }
        return $_details_info;
    }
    
    //查询由变量$recommend推荐的用户信息
    public function RecommanderQuery($recommend)
    {
        $_where = '';
        if ($recommend != -1)
        {
            $_where = "recommender = '$recommend'";
        }
        $_details_info = $this->where($_where)
        ->field('ID,user_name,user_level')
        ->select();
        $count = count($_details_info);
        if ($count < 1)
        {
            return ;
        }
        return $_details_info;
    }
    
    //修改当前用户的直接推荐人数
    public function increasReNum($user_id, $num)
    {
        $_where = '';
        if ($user_id != -1)
        {
            $_where = "AUTO_ID = $user_id";
        }
        echo $_where;
        $this->startTrans();
        $state = $this
                 ->where($_where)
                 ->setInc('re_nums',$num);
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
    
    
    public function increasRePathDS($user_id, $num)
    {
        $_where = '';
        if ($user_id != -1)
        {
            $_where = "AUTO_ID = $user_id";
        }
        echo $_where;
        $this->startTrans();
        $state = $this
        ->where($_where)
        ->setInc('repath_ds',$num);
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
    
    
    //查询由变量$recommend是否推荐过用户
    public function HasRecommander($recommend)
    {
        $_where = '';
        if ($recommend != -1)
        {
            $_where = "recommender = '$recommend'";
        }
        $_details_info = $this->where($_where)
        ->field('ID')
        ->select();
        $count = count($_details_info);
        if ($count < 1)
        {
            return 0;
        }
        else
        {
            return 1;
        }
    }
    
    public function DetailsDel($user_id)
    {
        $_where = '';
        if ($user_id != -1)
        {
            $_where = "ID = $user_id";
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
    
    public function DetailsInsert($user_id, $user_name, $email, $portrait, $user_level,
        $open_time, $recommender, $activator, $registry)
    {
            $_detailsinfo = array();
        if ($user_id >=0)
        {
            $_detailsinfo["ID"] = $user_id;
        }
    
        if ($user_name >=0)
        {
            $_detailsinfo["user_name"] = $user_name;
        }
    
        if ($email >=0)
        {
            $_detailsinfo["email"] = $email;
        }
         
        if ($portrait >=0)
        {
            $_detailsinfo["portrait"] = $portrait;
        }
    
        if ($user_level >=0)
        {
            $_detailsinfo["user_level"] = $user_level;
        }
    
        if ($open_time >=0)
        {
            $_detailsinfo["open_time"] = $open_time;
        }
         
        if ($recommender >=0)
        {
            $_detailsinfo["recommender"] = $recommender;
        }
    
        if ($activator >=0)
        {
            $_detailsinfo["activator"] = $activator;
        }
    
        if ($registry >=0)
        {
            $_detailsinfo["registry"] = $registry;
        }
        $_detailsinfo["open_time"] = date("Y-m-d H:i:s");
        $this->startTrans();
        $state = $this->save($_detailsinfo);
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
    
    public function DetailsUpdate($user_id, $user_name, $email, $portrait, $user_level,
        $open_time, $recommender, $activator, $registry)
    {
        $_detailsinfo = array();
    
        if ($user_name >=0)
        {
            $_detailsinfo["user_name"] = $user_name;
        }
    
        if ($email >=0)
        {
            $_detailsinfo["email"] = $email;
        }
         
        if ($portrait >=0)
        {
            $_detailsinfo["portrait"] = $portrait;
        }
    
        if ($user_level >=0)
        {
            $_detailsinfo["user_level"] = $user_level;
        }
    
        if ($open_time >=0)
        {
            $_detailsinfo["open_time"] = $open_time;
        }
         
        if ($recommender >=0)
        {
            $_detailsinfo["recommender"] = $recommender;
        }
    
        if ($activator >=0)
        {
            $_detailsinfo["activator"] = $activator;
        }
    
        if ($registry >=0)
        {
            $_detailsinfo["registry"] = $registry;
        }
        $state = $this-> where("ID='$user_id'")
                      ->setField($_detailsinfo);
        return $state;
    }
}
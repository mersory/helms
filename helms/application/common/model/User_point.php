<?php
namespace app\common\model;

use think\Model;

class User_point extends Model
{
    public function index()
    {
        //var_dump("Userpoint");
    }
    
    public function PointQuery($user_id)
    {
        $_where = '';
        if (strcmp($user_id,""))
        {
            $_where = "ID = '$user_id'";
        }
        else 
        {
            $_where = "ID is not NULL";
        }
            
        $_point_info = $this->where($_where)
        ->select();
        $count = count($_point_info);
        if ($count < 1)
        {
            //var_dump("User_point.php ID :$user_id not exsist".__LINE__);
            return ;
        }
        return $_point_info;
    }
    
    public function PointDel($user_id)
    {
        $_where = '';
        if ($user_id != -1)
        {
            $_where = "ID = '$user_id'";
        }
        //echo $_where;
        
        $state = $this->where($_where)->delete();
        
        return $state;
    }
    
    public function PointInsert($user_id, $shares=0, $bonus_point=0, $regist_point=0, $re_consume=0, 
                                $universal_point=0, $re_cast=0, $remain_point=0, $blocked_point=0, $shengyu_jing=0, $shengyu_dong=0)
    {
        $_pointinfo = array();
        if ($user_id >=0)
        {
            $_pointinfo["ID"] = $user_id;
        }
            
        if ($shares >=0)
        {
            $_pointinfo["shares"] = $shares;
        }
            
        if ($bonus_point >=0)
        {
            $_pointinfo["bonus_point"] = $bonus_point;
        }
           
        if ($regist_point >=0)
        {
            $_pointinfo["regist_point"] = $regist_point;
        }
            
        if ($re_consume >=0)
        {
            $_pointinfo["re_consume"] = $re_consume;
        }
            
        if ($universal_point >=0)
        {
            $_pointinfo["universal_point"] = $universal_point;
        }
           
        if ($re_cast >=0)
        {
            $_pointinfo["re_cast"] = $re_cast;
        }
            
        if ($remain_point >=0)
        {
            $_pointinfo["remain_point"] = $remain_point;
        }
            
        if ($blocked_point >=0)
        {
            $_pointinfo["blocked_point"] = $blocked_point;
        }
            
        if ($shengyu_jing>=0)
        {
            $_pointinfo["shengyu_jing"] = $shengyu_jing;
        }
        
        if ($shengyu_dong>=0)
        {
            $_pointinfo["shengyu_dong"] = $shengyu_dong;
        }

        $state = $this->save($_pointinfo);
        
        return $state;
    }
    
    public function pointTransfor($user_id, $point_type, $point_change_type, $point_change_sum)
    {
        $_res = $this->PointQuery($user_id);
        $_res = $_res[0];
        $_pointinfo = array();
        $pointtype = array();
        $pointtype[1] = 'regist_point';//"注册分";
        $pointtype[2] = 'bonus_point';//"奖励分";
        $pointtype[3] = 're_consume';//"重复消费分";
        $pointtype[4] = 'universal_point';//"万能分";
        if($point_type == $point_change_type)
            return false;
        else 
        {
            if($_res[$pointtype[$point_type]] < $point_change_sum)
                return false;
           else 
           {
               $_pointinfo[$pointtype[$point_type]] = $_res[$pointtype[$point_type]] - $point_change_sum;
               $_pointinfo[$pointtype[$point_change_type]] = $_res[$pointtype[$point_change_type]] + $point_change_sum;
               
               $state = $this-> where("ID='$user_id'")
               ->setField($_pointinfo);

               $point_transfor = new Point_transform_record();
               $point_transfor->PointTransformInsert($user_id, $pointtype[$point_type], $pointtype[$point_change_type], $point_change_sum);
           }
        }
        return true;
    }
    
    public function PointUpdate($user_id, $shares=-1, $bonus_point=-1, $regist_point=-1, $re_consume=-1, 
                                $universal_point=-1, $re_cast=-1, $remain_point=-1, $blocked_point=-1,
                                $shengyu_jing=-1, $shengyu_dong=-1, $dp_leiji = -1)
    {
        //判断数据是否一样，如果一样则不需要更新
        $_cureent = $this->PointQuery($user_id);
        if(count($_cureent) < 1)
            return -1;
        else 
            $_cureent = $_cureent[0];
        if($shares==$_cureent["shares"] && $bonus_point==$_cureent["bonus_point"] && $regist_point==$_cureent["regist_point"] && $re_consume== $_cureent["re_consume"] 
           && $universal_point==$_cureent["universal_point"] && $re_cast==$_cureent["re_cast"] && $remain_point==$_cureent["remain_point"] && $blocked_point==$_cureent["blocked_point"]
           && $shengyu_jing==$_cureent["shengyu_jing"] && $shengyu_dong==$_cureent["shengyu_dong"] && $dp_leiji==$_cureent["dp_leiji"])
        {
            //var_dump("User_point.php the data is complete same".__LINE__);
            return 1;
        }
        
        $_pointinfo = array();
        if ($user_id >=0)
        {
            $_pointinfo["ID"] = $user_id;
        }
            
        if ($shares >=0)
        {
            $_pointinfo["shares"] = $shares;
        }
            
        if ($bonus_point >=0)
        {
            $_pointinfo["bonus_point"] = $bonus_point;
        }
           
        if ($regist_point >=0)
        {
            $_pointinfo["regist_point"] = $regist_point;
        }
            
        if ($re_consume >=0)
        {
            $_pointinfo["re_consume"] = $re_consume;
        }
            
        if ($universal_point >=0)
        {
            $_pointinfo["universal_point"] = $universal_point;
        }
           
        if ($re_cast >=0)
        {
            $_pointinfo["re_cast"] = $re_cast;
        }
            
        if ($remain_point >=0)
        {
            $_pointinfo["remain_point"] = $remain_point;
        }
            
        if ($blocked_point >=0)
        {
            $_pointinfo["blocked_point"] = $blocked_point;
        }
        if ($shengyu_jing>=0)
        {
            $_pointinfo["shengyu_jing"] = $shengyu_jing;
        }
        
        if ($shengyu_dong>=0)
        {
            $_pointinfo["shengyu_dong"] = $shengyu_dong;
        }
        
        if ($dp_leiji>=0)
        {
            $_pointinfo["dp_leiji"] = $dp_leiji;
        }
        
        $state = $this-> where("ID='$user_id'")
        ->setField($_pointinfo);
        return $state;
    }
    
    public function remainPointUpdate($user_id, $jing=0, $dong=0)
    {
        $_cureent = $this->PointQuery($user_id);
        if(count($_cureent) < 1)
            return -1;
        else
            $_cureent = $_cureent[0];
        if($jing==$_cureent["shengyu_jing"] && $dong==$_cureent["shengyu_dong"])
        {
            //var_dump("User_point.php the data is complete same".__LINE__);
            return 1;
        }
        $_pointinfo = array();
        if ($jing >=0)
        {
            $_pointinfo["shengyu_jing"] = $jing;
        }
        
        if ($dong >=0)
        {
            $_pointinfo["shengyu_dong"] = $dong;
        }
        $state = $this-> where("ID='$user_id'")
        ->setField($_pointinfo);
        //var_dump($user_id);
        //var_dump($state);
        return $state;
    }
    
}

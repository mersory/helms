<?php
namespace app\common\model;

use think\Model;

class Award_daytime extends Model
{
    public function index()
    {
        //var_dump("Award_daytime");
    }
    
    public function AwarddailyQueryByPage($id,$_fromtime,$_totime)//
    {
        $member = new Positionality();//M('member');
        if(is_numeric($id))
        {
            $vo = $member->PositionQueryByID($id);
            $id = $vo[0]["user_id"];
        }
        
        $_where = "U.ID=P.ID";
        
        if (strcmp("$id", ""))
        {
            $_where = "$_where and P.ID = '$id'";
        }
        if (strcmp("$_fromtime", "") )
        {
            $_where = "$_where and P.date >= '$_fromtime'";
        }
        if (strcmp("$_totime", "") )
        {
            $_where = "$_where and P.date <= '$_totime'";
        }
        
        $_award_info = $this->table('helms_user_info U, helms_award_daytime P')
        ->order("P.date desc")
        ->where($_where)
        ->field('U.username,  P.ID, P.direct, P.balance, P.tutor, P.appreciation, P.staticbonus, P.sum, P.actualsalary, P.date, P.bz0')
        ->paginate(25);
 
        return $_award_info;
    }
    
    public function AwarddailyQuery($id)//
    {
        $member = new Positionality();//M('member');
        if(is_numeric($id))
        {
            $vo = $member->PositionQueryByID($id);
            $id = $vo[0]["user_id"];
        }
        $_where = '';
        $date = date("Y-m-d");
        if (strcmp("$id", ""))
        {
            $_where = "ID = '$id' and date = '$date'";
        }
        $_award_info = $this->where($_where)
        ->select();
        $count = count($_award_info);
        if ($count < 1)
        {
            //var_dump("Award_daytime.php ID :$id not exsist".__LINE__);
            return ;
        }
        return $_award_info;
    }
    
    public function isAwarddailyExist($id)//
    {
        $member = new Positionality();//M('member');
        if(is_numeric($id))
        {
            $vo = $member->PositionQueryByID($id);
            $id = $vo[0]["user_id"];
        }
        $_where = '';
        $date = date("Y-m-d");
        if (strcmp("$id", ""))
        {
            $_where = "ID = '$id' and date = '$date'";
        }
        $_award_info = $this->where($_where)
        ->select();
        $count = count($_award_info);
        if ($count < 1)
        {
            return 0;
        }
        return 1;
    }
    
    public function AwarddailyDel($id)
    {
        $member = new Positionality();//M('member');
        if(is_numeric($id))
        {
            $vo = $member->PositionQueryByID($id);
            $id = $vo[0]["user_id"];
        }
        $_where = '';
        if (strcmp("$id", ""))
        {
            $_where = "ID = '$id'";
        }
        $state = $this->where($_where)->delete();
        return $state;
    }
    
    public function AwarddailyInsert($id, $direct=0, $balance=0, $tutor=0, $appreciation=0, $staticbonus=0, $sum=0, $Sactualsalary=0, $income = 0)
    {
        $member = new Positionality();//M('member');
        if(is_numeric($id))
        {
            $vo = $member->PositionQueryByID($id);
            $id = $vo[0]["user_id"];
        }
        $_record = array();
        if (strcmp("$id", ""))
        {
            $_record["ID"] = $id;
        }
   
        $_record["direct"] = $direct;

        $_record["balance"] = $balance;
    
        $_record["tutor"] = $tutor;
        
        $_record["appreciation"] = $appreciation;
        
        $_record["staticbonus"] = $staticbonus;
        
        $_record["sum"] = $sum;
        
        $_record["actualsalary"] = $Sactualsalary;
        
        $_record["income"] = $income;
        
        $_record["date"] = date("Y-m-d");;

        $state = $this->save($_record);
       
        return $state;
    }
    
    public function AwarddailyUpdate($id, $direct=-1, $balance=-1, $tutor=-1, $appreciation=-1, $staticbonus=-1, $sum=-1, $actualsalary=-1, $bz0=-1, $bz6=-1, $bz7=-1, $bz8=-1, $income=-1)
    {
        $member = new Positionality();//M('member');
        if(is_numeric($id))
        {
            $vo = $member->PositionQueryByID($id);
            $id = $vo[0]["user_id"];
        }
        $_record = array();
        $date = date("Y-m-d");
        if($direct != -1)
            $_record["direct"] = $direct;
        
        if($balance != -1)
            $_record["balance"] = $balance;
        
        if($tutor != -1)
            $_record["tutor"] = $tutor;
    
        if($appreciation != -1)
            $_record["appreciation"] = $appreciation;
        
        if($staticbonus != -1)
            $_record["staticbonus"] = $staticbonus;
        
        if($sum != -1)
            $_record["sum"] = $sum;
        
        if($actualsalary != -1)
            $_record["actualsalary"] = $actualsalary;
        
        if($bz0 != -1)
            $_record["bz0"] = $bz0;
        
        if($bz6 != -1)
            $_record["bz6"] = $bz6;
        
        if($bz7 != -1)
            $_record["bz7"] = $bz7;
        
        if($bz8 != -1)
            $_record["bz8"] = $bz8;
        
        if($income != -1)
            $_record["income"] = $income;
    
        $state = $this-> where("ID='$id'  and date = '$date'")
        ->setField($_record);
       
        return $state;
    }
    
}
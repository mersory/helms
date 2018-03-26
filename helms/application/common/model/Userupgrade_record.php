<?php
namespace app\common\model;

use think\Model;

class Userupgrade_record extends Model
{
    public function index()
    {
        var_dump("Userdetails");
    }
    
    public function UpgradeQuery($user_id)
    {
        $_where = '';
        if ($user_id != -1)
        {
            $_where = "user_id = '$user_id'";
        }
        $_upgrade_info = $this->where($_where)
        ->select();
        $count = count($_upgrade_info);
        if ($count < 1)
        {
            var_dump("user_id :$user_id not exsist");
            return ;
        }
        return $_upgrade_info;
    }
    
    public function UpgradeInsert($user_id, $current_level, $upgrade_level)
    {
        $_upgradeinfo = array();
        if ($user_id >=0)
        {
            $_upgradeinfo["user_id"] = $user_id;
        }
    
        if ($_upgradeinfo >=0)
        {
            echo 'cece';
            $_upgradeinfo["current_level"] = $current_level;
        }
    
        if ($upgrade_level >=0)
        {
            echo 'vvvv';
            $_upgradeinfo["upgrade_level"] = $upgrade_level;
        } 
        $_upgradeinfo["upgrade_time"] = date("Y-m-d H:i:s");

        $this->startTrans();
        $state = $this->save($_upgradeinfo);
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
    
    public function UserupgradeAct($user_id, $cost)
    {
        $_pointinfo = new Userpoint();
        $_detailsinfo = new Userdetails();
        $_point = $_pointinfo->PointQuery($user_id);
        if (count($_point) == 1)
        {
            if ($_point[0]["regist_point"] >= $cost )
            {
                $details = $_detailsinfo->where("ID=$user_id")
                             ->select();
                if (count($details) == 1)
                {
                    $current_level = $details[0]["user_level"];
                }
                else 
                {
                    var_dump("user details eror: user has no level");
                    return ;
                }
                $_point_data = array();
                $_details_data = array();
                $_point_data["regist_point"] = $_point[0]["regist_point"] - $cost;
                $_details_data["user_level"] = 3;
                $this->startTrans();
                $point = $_pointinfo-> where("ID=$user_id")
                                    ->setField($_point_data);
                $details = $_detailsinfo-> where("ID=$user_id")
                                        ->setField($_details_data);
                $state = $this->UpgradeInsert($user_id, $current_level + 1, $current_level);
                if ($point && $details && $state)
                {
                    $this->commit();
                    var_dump("upgrade success");
                }
                else 
                {
                    $this->rollback();
                    var_dump("upgrade failed");
                }
            }
        }
    }
    
    

    
}
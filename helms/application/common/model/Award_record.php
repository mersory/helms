<?php
namespace app\common\model;

use think\Model;

class Award_record extends Model
{
    public function index()
    {
        var_dump("Award records");
    }
    
    public function AwardRecordQuery($id)//
    {
        $_where = '';
        if (strcmp("$id", ""))
        {
            $_where = "ID = '$id'";
        }
        $_award_info = $this->where($_where)
        ->select();
        $count = count($_award_info);
        if ($count < 1)
        {
            var_dump("Award_record.php ID :$id not exsist".__LINE__);
            return ;
        }
        return $_award_info;
    }
    
    public function AwardRecordDel($id)
    {
        $_where = '';
        if (strcmp("$id", ""))
        {
            $_where = "ID = '$id'";
        }
        $state = $this->where($_where)->delete();
       
        return $state;
    }
    
    public function AwardRecordInsert($id, $award="直推奖", $money, $f_userID, $comment="静态奖实际发放金额")
    {
        $_record = array();
        if (strcmp("$id", ""))
        {
            $_record["ID"] = $id;
        }
   
        $_record["award"] = $award;

        $_record["money"] = $money;
    
        $_record["time"] = date("Y-m-d H:i:s");
        
        $_record["f_userID"] = $f_userID ;
        
        if(strcmp($comment,"静态奖实际发放金额") == 0)
            $_record["comment"] = $comment.":".$money;
        else
            $_record["comment"] = $comment;
        
        $state = $this->save($_record);
        
        return $state;
    }
    
}
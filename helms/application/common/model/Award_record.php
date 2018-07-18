<?php
namespace app\common\model;

use think\Model;

class Award_record extends Model
{
    public function index()
    {
        //var_dump("Award records");
    }
    
    public function AwardRecordQuery($id)//
    {
        $_where = '';
        if (strcmp("$id", ""))
        {
            $_where = "ID = '$id'";
        }
        else
        {
            $_where = "ID != '0'";
        }
        $_award_info = $this->where($_where)
        ->select();
        $count = count($_award_info);
        if ($count < 1)
        {
            return ;
        }
        return $_award_info;
    }
    
    public function AwardRecordQueryWithLimit($id, $fromtime="", $totime="")//
    {
        $_where = '';
        if (strcmp("$id", ""))
        {
            $_where = "ID = '$id'";
        }
        else
        {
            $_where = "ID != '0'";
        }
        
        if(strcmp($fromtime, ""))
        {
            $_where = "$_where and time >= '$fromtime'";
        }
        
        if(strcmp($totime, ""))
        {
            $_where = "$_where and time <= '$totime'";
        }
        
        $_award_info = $this->order("time desc")
                            ->where($_where)
                            ->paginate(25,false,['query' => request()->param()]);
       
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
        
        //2018-07-19
        $income_expendit = new Income_expenditure();
        $begintime=date("Y-m-d H:i:s",mktime(0,0,0,date('m'),date('d'),date('Y')));
        $endtime=date("Y-m-d H:i:s",mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1);
        $in_out_RES = $income_expendit->IncomeExpenditureQueryByTime($begintime, $endtime);
        
        $out = $money;
        $out_vs_in = -1;
        
        if(count($in_out_RES) < 1)
        {
            $income_expendit->IncomeExpenditureInsert(-1, -1, $out, -$out, $out_vs_in);
        }
        else 
        {
            if($in_out_RES[0]["incomings"] != 0)
            {
                $out_vs_in = ($in_out_RES[0]["outgoing"] + $out)/$in_out_RES[0]["incomings"];
            }
            $income_expendit->IncomeExpenditureUpdate($in_out_RES[0]["record_id"], -1, -1, $in_out_RES[0]["outgoing"] + $out, $in_out_RES[0]["incomings"]-($in_out_RES[0]["outgoing"]+$out), $out_vs_in);
        }

        
        
//         $income_expendit = new Income_expenditure();
//         $begintime=date("Y-m-d H:i:s",mktime(0,0,0,date('m'),date('d'),date('Y')));
//         $endtime=date("Y-m-d H:i:s",mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1);
//         $in_out_RES = $income_expendit->IncomeExpenditureQueryByTime($begintime, $endtime);
         
//         $income = $money;
//         $out_vs_in = -1;
         
//         if(count($in_out_RES) < 1)
//         {
//             $income_expendit->IncomeExpenditureInsert(-1, $income, -1, $income, $out_vs_in);
//         }
//         else
//         {
//             $out_vs_in = ($in_out_RES[0]["outgoing"]) / ($in_out_RES[0]["incomings"] + $income);
//             $income_expendit->IncomeExpenditureUpdate($in_out_RES[0]["record_id"], -1, $in_out_RES[0]["incomings"] + $income, -1, $in_out_RES[0]["incomings"] + $income-$in_out_RES[0]["outgoing"], $out_vs_in);
//         }
         

        return $state;
    }
    
}
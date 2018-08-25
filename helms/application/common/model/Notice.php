<?php
namespace app\common\model;

use think\Model;

class Notice extends Model
{
    public function index()
    {
        var_dump("notice records");
    }
    
    public function NoticeQuery($id)//
    {
        $_where = '';
        if (strcmp("$id", ""))
        {
            $_where = "ID = $id";
        }
        else
        {
            $_where = "ID != 0";
        }
        $_award_info = $this->where($_where)
                            ->field("ID, time, subject, comment, status")
                            ->select();
        $count = count($_award_info);
        if ($count < 1)
        {
            return ;
        }
        
        return $_award_info[0];
    }
    
    public function PublishedNoticeQueryWithLimit($id="", $fromtime="", $totime="")//
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
        
        $_where = "$_where and status >= 1";
        
        //changed by Gavin start model19
        $_notice_info = $this->order("time desc, Id desc")
                             ->where($_where)
                             ->paginate(25,false,['query' => request()->param()]);
        
        return $_notice_info;
    }
    
    public function AllNoticeQueryWithLimit($id="", $fromtime="", $totime="")//
    {
        $_where = '';
        if (strcmp("$id", ""))
        {
            $_where = "ID = $id";
        }
        else
        {
            $_where = "ID != 0";
        }
        
        if(strcmp($fromtime, ""))
        {
            $_where = "$_where and time >= '$fromtime'";
        }
        
        if(strcmp($totime, ""))
        {
            $_where = "$_where and time <= '$totime'";
        }
        
        //changed by Gavin start model19
        $_notice_info = $this->order("time desc, Id desc")
                            ->where($_where)
                            ->paginate(25,false,['query' => request()->param()]);
        
        return $_notice_info;
    }
    
    public function NoticeDel($id)
    {
        $_where = '';
        if (strcmp("$id", ""))
        {
            $_where = "ID = '$id'";
        }
        $state = $this->where($_where)->delete();
       
        return $state;
    }
    
    public function NoticeUpdateStatus($id="", $status=0)
    {
        $_where = '';
        if (strcmp("$id", ""))
        {
            $_where = "ID = '$id'";
        }
        else 
            return -1;
        
        $_record = array();
        
        $_record["status"] = $status;
        
        $state = $this->where("ID='$id'")
                      ->setField($_record);
        return $state;
    }
    
    public function NoticeInsert($subject="Notice of HERMES", $comment = "limit in 4096 letters")
    {
        $_record = array();
    
        $_record["time"] = date("Y-m-d H:i:s");
        
        $_record["subject"] = $subject;

        $_record["comment"] = $comment;
        
        $_record["status"] = 1;
        
        $state = $this->save($_record);
        

        return $state;
    }
    
}
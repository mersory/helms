<?php
namespace app\common\model;

use think\Model;

class Offline_deal extends Model
{
    public function index()
    {
        var_dump("Userdetails");
    }
    
    public function OfflineQuery($ID)//���������Ĳ��ҷ�ʽ���˴�ֻ�г���һ��
    {
        $_where = '';
        if ($ID != -1)
        {
            $_where = "ID = $ID";
        }
        $_offline_info = $this->where($_where)
        ->select();
        $count = count($_offline_info);
        if ($count < 1)
        {
            var_dump("Offline_deal.php ID :$ID not exsist".__LINE__);
            return ;
        }
        return $_offline_info;
    }
    
    public function OfflinelDel($ID)
    {
        $_where = '';
        if ($ID != -1)
        {
            $_where = "ID = $ID";
        }
        echo $_where;
        
        $state = $this->where($_where)->delete();
        
        return $state;
    }
    
    public function OfflineInsert($user_id, $transaction_amount, $transaction_details)
    {
        $_offlineinfo = array();
        if ($user_id >=0)
        {
            $_offlineinfo["user_id"] = $user_id;
        }
    
        if ($transaction_amount >=0)
        {
            $_offlineinfo["transaction_amount"] = $transaction_amount;
        }
    
        if ($transaction_details >=0)
        {
            $_offlineinfo["transaction_details"] = $transaction_details;
        }
        $_offlineinfo["transaction_time"] = date("Y-m-d H:i:s");
        
        $state = $this->save($_offlineinfo);
        
        return $state;
    }
    
}
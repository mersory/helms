<?php
namespace app\common\model;

use think\Model;

class User_bankinfo extends Model
{
    public function index()
    {
        var_dump("Userbankinfo");
    }
    
    public function BankinfoQuery($user_id)
    {
        $_where = '';
        if ($user_id != -1)
        {
            $_where = "user_id = '$user_id'";
        }
        $_bank_info = $this->where($_where)
        ->select();
        $count = count($_bank_info);
        if ($count < 1)
        {
            var_dump("User_bank.php user_id :$user_id not exsist".__LINE__);
            return ;
        }
        return $_bank_info;
        /*for($_index = 0; $_index < $count; $_index++)
        {
            echo '<br/>';
            $ff = $_bank_info[$_index];
            var_dump($ff->getData('bank_info_id'));
            var_dump($ff->getData('user_id'));
            var_dump($ff->getData('bank_name'));
            var_dump($ff->getData('bank_account_name'));
            var_dump($ff->getData('bank_account_num'));
            var_dump($ff->getData('bank_city'));
            var_dump($ff->getData('sub_bank'));
        }*/
    }
    
    public function BankinfoDel($user_id)
    {
        $_where = '';
        if ($user_id != -1)
        {
            $_where = "user_id = $user_id";
        }
        
        $state = $this->where($_where)->delete();
        
        return $state;
    }
    
    public function BankinfoInsert($user_id, $bank_name, $bank_account_name, $bank_account_num, $bank_city, $sub_bank)
    {
        $_bankinfo = array();
        if ($user_id >=0)
        {
            $_bankinfo["user_id"] = $user_id;
        }
    
        if ($bank_name >=0)
        {
            $_bankinfo["bank_name"] = $bank_name;
        }
    
        if ($bank_account_name >=0)
        {
            $_bankinfo["bank_account_name"] = $bank_account_name;
        }
        
        if ($bank_account_num >=0)
        {
            $_bankinfo["bank_account_num"] = $bank_account_num;
        }
         
        if ($bank_city >=0)
        {
            $_bankinfo["bank_city"] = $bank_city;
        }
    
        if ($sub_bank >=0)
        {
            $_bankinfo["sub_bank"] = $sub_bank;
        }
    
        $state = $this->save($_bankinfo);
        
        return $state;
    }
    
    public function BankinfoUpdate($user_id, $bank_name, $bank_account_name, $bank_account_num, $bank_city, $sub_bank)
    {
        $_bankinfo = array();
        if ($user_id >=0)
        {
            $_bankinfo["user_id"] = $user_id;
        }
    
        if ($bank_name >=0)
        {
            $_bankinfo["bank_name"] = $bank_name;
        }
    
        if ($bank_account_name >=0)
        {
            $_bankinfo["bank_account_name"] = $bank_account_name;
        }
        
        if ($bank_account_num >=0)
        {
            $_bankinfo["bank_account_num"] = $bank_account_num;
        }
         
        if ($bank_city >=0)
        {
            $_bankinfo["bank_city"] = $bank_city;
        }
    
        if ($sub_bank >=0)
        {
            $_bankinfo["sub_bank"] = $sub_bank;
        }
        $state = $this-> where("user_id=$user_id")
        ->setField($_bankinfo);
        return $state;
    }
}
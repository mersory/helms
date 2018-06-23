<?php
namespace app\common\model;

use think\Model;

class Withdrawal_record extends Model
{
    public function index()
    {
        var_dump("Userdetails");
    }
    
    public function WithdrawalQuery($user_id)//���������Ĳ��ҷ�ʽ���˴�ֻ�г���һ��
    {
        $_where = '';
        if ($user_id != -1)
        {
            $_where = "user_id = '$user_id'";
        }
        $_withdrawal_info = $this->where($_where)
        ->select();
        $count = count($_withdrawal_info);
        if ($count < 1)
        {
            var_dump("Withdrawal_record.php ID :$user_id not exsist".__LINE__);
            return ;
        }
        return $_withdrawal_info;
    }
    
    public function WithdrawalApplicationByTime($user_id, $_start, $_end)
    {
        $_where = '';
        if (strcmp("$user_id", ""))
        {
            $_where = "user_id = '$user_id'";
        }
        else 
        {
            $_where = "user_id != -1";
        }
        if (strcmp("$_start", "") )
        {
            $_where = "apply_time > '$_start'";   //���ﲻҪ=���ţ���Ϊ�������ݿ��е�ID����int����
        }
        if (strcmp("$_end", "") )
        {
            $_where = "$_where and apply_time < '$_end'";//������Ҫ�������
        }
        if (strcmp("$_where", ""))
        {
            $res = $this->where($_where)
            ->field( 'user_id, withdrawal_type, withdraw_sum, apply_time, withdrawal_status, verifier_id, approve_time, to_account_time, point_consume')
            ->select();
        }
        else
        {
            $res = $this->field( 'user_id, withdrawal_type, withdraw_sum, apply_time, withdrawal_status, verifier_id, approve_time, to_account_time, point_consume')
            ->select();
        }
        return $res;
    }
    
    public function WithdrawalApplicationByTimeWithLimit($user_id, $_start, $_end, $_pagesize=25, $_pageindex=0)
    {
        $_where = '';
        if (strcmp("$user_id", ""))
        {
            $_where = "user_id = '$user_id'";
        }
        else
        {
            $_where = "user_id != -1";
        }
        if (strcmp("$_start", "") )
        {
            $_where = "apply_time > '$_start'";   //���ﲻҪ=���ţ���Ϊ�������ݿ��е�ID����int����
        }
        if (strcmp("$_end", "") )
        {
            $_where = "$_where and apply_time < '$_end'";//������Ҫ�������
        }
        if (strcmp("$_where", ""))
        {
            $res = $this->limit($_pagesize * $_pageindex, $_pagesize)
            ->where($_where)
            ->field( 'user_id, withdrawal_type, withdraw_sum, apply_time, withdrawal_status, verifier_id, approve_time, to_account_time, point_consume')
            ->select();
        }
        else
        {
            $res = $this->limit($_pagesize * $_pageindex, $_pagesize)
            ->field( 'user_id, withdrawal_type, withdraw_sum, apply_time, withdrawal_status, verifier_id, approve_time, to_account_time, point_consume')
            ->select();
        }
        return $res;
    }
    
    public function WithdrawalDel($user_id)
    {
        $_where = '';
        if ($user_id != -1)
        {
            $_where = "user_id = '$user_id'";
        }

        $state = $this->where($_where)->delete();
       
        return $state;
    }
    
    public function WithdrawalInsert($user_id, $withdraw_sum, $withdrawal_type, $point_consume, $withdrawal_status)
    {
        $_withdrawalinfo = array();
        if ($user_id >=0)
        {
            $_withdrawalinfo["user_id"] = $user_id;
        }
    
        if ($withdraw_sum >=0)
        {
            $_withdrawalinfo["withdraw_sum"] = $withdraw_sum;
        }
    
        if ($withdrawal_type >=0)
        {
            $_withdrawalinfo["withdrawal_type"] = $withdrawal_type;
        }
         
        if ($point_consume >=0)
        {
            $_withdrawalinfo["point_consume"] = $point_consume;
        }
    
        if ($withdrawal_status >=0)
        {
            $_withdrawalinfo["withdrawal_status"] = $withdrawal_status;//һ������ֻ��Ϊ0����ʾ�����ύ����û���
        }
        $_withdrawalinfo["apply_time"] = date("Y-m-d H:i:s");

        $state = $this->save($_withdrawalinfo);
        
        return $state;
    }
    
    public function WithdrawalUpdate($withdraw_id, $updatetype)
    {
        $_withdrawalinfo = array();
        $_res = $this->WithdrawalQuery($withdraw_id);
        if (count($_res) == 1)
        {
            echo "ffff";
            if ($updatetype - $_res[0]["withdrawal_status"] == 1)
            {
                echo "fasa";
                $_withdrawalinfo["withdrawal_status"] = $updatetype;
                if ($updatetype == 1)//���ͨ��
                {
                    $_withdrawalinfo["approve_time"] = date("Y-m-d H:i:s");
                }
                else
                {
                    $_withdrawalinfo["to_account_time"] = date("Y-m-d H:i:s");
                }
                $state = $this-> where("withdraw_id=$withdraw_id")
                ->setField($_withdrawalinfo);
                return $state;
            }
            else 
            {
                echo "state erro";
                return;
            }
        }
        else 
        {
            echo "not found";
            return;
        }
    }
}
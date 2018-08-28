<?php
namespace app\backend\controller;

use think\Controller;
use app\common\model\Income_expenditure;
use app\common\model\Positionality;
use app\common\model\Role;
use app\common\model\Priority;
use app\common\model\Deal_info;
use think\Request;
use app\common\model\User_info;
use app\common\model\User_point;
use app\common\model\Point_transform_record;
use app\common\model\Withdrawal_record;
use app\trigger\controller\Awardopt;
use app\common\model\Preference_option;
use app\common\model\User_details;
use app\common\model\Historical_price;
use app\common\model\Gp_onsale;
use app\common\model\Gp_set;
use app\common\model\Award_record;
use app\common\model\Award_daytime;
use think\Session;
use app\trigger\controller\External;
use phpDocumentor\Reflection\DocBlock\Tags\Param;
use app\extra\controller\Basecontroller;
use app\common\model\User_log;
use app\common\model\Notice;

class Adminopt extends Basecontroller
{
    public function index()
    {
        //echo "class Admin index";
        $use = new Award_record();
        $use->index();

        $dayuser = new Award_daytime();
        $dayuser->index();
        if($dayuser->isAwarddailyExist("H4463714500") == 1)
            $dayuser->AwarddailyUpdate("H4463714500",12.7,12);
        else 
            $dayuser->AwarddailyInsert("H4463714500",13.7,16);
        
    }
    
    public function UserList()
    {
        $htmls = $this->fetch();
        return $htmls;
    }
    
    public function SearchUserInfo()
    {
        $_post = Request::instance()->post();
        //var_dump($_post);
        $_userid = $_post["userid"];
        $_username = $_post["username"];
        $_telphone = $_post["telphone"];
        $_email = $_post["email"];
        $_fromtime = $_post["fromtime"];
        $_totime = $_post["totime"];
        $_admin = new User_info();
        $_res = $_admin->UserSearch($_userid, $_username, $_telphone, $_email, $_fromtime, $_totime);
        for ($index = 0; $index < count($_res); $index++)
        {
            //var_dump($_res[$index]);
        }
        
    }
    
    public function UserApplyList()
    {
        $htmls = $this->fetch();
        return $htmls;
    }
    
    public function UserApply()
    {
        $_post = Request::instance()->post();
        $_begintime = $_post["begin"];
        $_endtime = $_post["end"];
        $_user = new User_info();
        $_res = $_user->UserApplication($_begintime, $_endtime);
        for ($index = 0; $index < count($_res); $index++)
        {
            //var_dump($_res[$index]["ID"]);
            //var_dump($_res[$index]["user_name"]);
            //var_dump($_res[$index]["telphone"]);
            //var_dump($_res[$index]["email"]);
            //var_dump($_res[$index]["open_time"]);
        }
    }
    
    public function UserApproval()
    {
        //echo "tongguo";
    }
    
    public function RevenueExpenditure()
    {
        $htmls = $this->fetch();
        return $htmls;
    }
    
    public function RevenueExpenditureQuery()
    {
        $_post = Request::instance()->post();
        $_begintime = $_post["begin"];
        $_endtime = $_post["end"];
        //������֧��Ϣ��
        $_Re_Ex = new Income_expenditure();
        $_res = $_Re_Ex->IncomeExpenditureQueryByTime($_begintime, $_endtime);
        for ($index = 0; $index < count($_res); $index++)
        {
            //echo $index;
            //var_dump($_res[$index]["user_id"]);
            //var_dump($_res[$index]["deal_count"]);
            //var_dump($_res[$index]["current_profit"]);
            //var_dump($_res[$index]["count_time"]);
            //echo "<br/>";
        }
        //���ý��������
        //echo "----------------------------------------------------------------------";
        $_deal = new Deal_info();
        $_res = $_deal->DealQueryByTime($_begintime, $_endtime);
        for ($index = 0; $index < count($_res); $index++)
        {
            //echo $index;
            //var_dump($_res[$index]["user_id"]);
            //var_dump($_res[$index]["deal_time"]);
            //var_dump($_res[$index]["deal_type"]);
            //var_dump($_res[$index]["deal_sum"]);
            //var_dump($_res[$index]["details"]);
            //echo "<br/>";
        }
    }

    public function PointDetails()
    {
        $htmls = $this->fetch();
        return $htmls;
    }
    
    public function PointDetailsQueryByID()
    {
        $_post = Request::instance()->post();
        $_user_id = $_post["ID"];
        //echo $_user_id;
        $_user_point = new User_point();
        $_res = $_user_point->PointQuery($_user_id);
        for ($index = 0; $index < count($_res); $index++)
        {
            //echo $index;
            //var_dump($_res[$index]["ID"]);
            //var_dump($_res[$index]["shares"]);
            //var_dump($_res[$index]["bonus_point"]);
            //var_dump($_res[$index]["regist_point"]);
            //var_dump($_res[$index]["re_consume"]);
            //var_dump($_res[$index]["universal_point"]);
            //var_dump($_res[$index]["re_cast"]);
            //var_dump($_res[$index]["remain_point"]);
            //var_dump($_res[$index]["blocked_point"]);
            //echo "<br/>";
        }
    }
    
    public function PointTransform()
    {
        $htmls = $this->fetch();
        return $htmls;
    }
    
    public function PointTransformQuery()
    {
        $_post = Request::instance()->post();
        $_user_id = $_post["ID"];
        $_fromtime = $_post["fromtime"];
        $_totime = $_post["totime"];
        $_point_transform = new Point_transform_record();
        $_res = $_point_transform->PointTransformQueryBy($_user_id, $_fromtime, $_totime);
        for ($index = 0; $index < count($_res); $index++)
        {
            //echo $index;
            //var_dump($_res[$index]["user_id"]);
            //var_dump($_res[$index]["point_change_type"]);
            //var_dump($_res[$index]["point_change_sum"]);
            //var_dump($_res[$index]["point_change_time"]);
            //echo "<br/>";
        }
    }

    public function WithdrawalApplication()
    {
        $htmls = $this->fetch();
        return $htmls;
    }
    
    public function WithdrawalApplicationQueryById()
    {
        $_post = Request::instance()->post();
        $_user_id = $_post["userid"];
        $_withdraw = new Withdrawal_record();
        $_withdraw = new Withdrawal_record();
        $_res = $_withdraw->WithdrawalQuery($_user_id);
        for ($index = 0; $index < count($_res); $index++)
        {
            //echo $index;
            //var_dump($_res[$index]["user_id"]);
            //var_dump($_res[$index]["withdrawal_type"]);
            //var_dump($_res[$index]["withdraw_sum"]);
            //var_dump($_res[$index]["apply_time"]);
            //var_dump($_res[$index]["withdrawal_status"]);
            //var_dump($_res[$index]["verifier_id"]);
            //var_dump($_res[$index]["approve_time"]);
            //var_dump($_res[$index]["to_account_time"]);
            //var_dump($_res[$index]["point_consume"]);
            //echo "<br/>";
        }
    }
    
    public function WithdrawalApplicationQueryByTime()
    {
        $_post = Request::instance()->post();
        $_fromtime = $_post["fromtime"];
        $_totime = $_post["totime"];
        $_withdraw = new Withdrawal_record();
        $_res = $_withdraw->WithdrawalApplicationByTime($_fromtime, $_totime);
        for ($index = 0; $index < count($_res); $index++)
        {
            //echo $index;
            //var_dump($_res[$index]["user_id"]);
            //var_dump($_res[$index]["withdrawal_type"]);
            //var_dump($_res[$index]["withdraw_sum"]);
            //var_dump($_res[$index]["apply_time"]);
            //var_dump($_res[$index]["withdrawal_status"]);
            //var_dump($_res[$index]["verifier_id"]);
            //var_dump($_res[$index]["approve_time"]);
            //var_dump($_res[$index]["to_account_time"]);
            //var_dump($_res[$index]["point_consume"]);
            //echo "<br/>";
        }
    }
    
    //锁定账户，禁止提现  或者  解锁账户，开启提现；参数3为1表示锁定或者禁止提现，  参数3位0表示解锁，允许提现
    public function lockorForbidonUser($_userid_arr, $status, $is_punish)
    {
        $_session_user = Session::get(USER_SEESION);
        $_resdata = array();
        $_resdata["ok"] = 0;
        if(empty($_session_user))
        {
            return json_encode($_resdata);
        }
        else
        {
            $_userid = $_session_user["userId"];
    	    if($_userid < "1000")//当前用户是管理员
    	    {
    	        $_resdata["ok"] = 1;
    	        //var_dump(count($_userid_arr));
    	        for($i=0; $i<count($_userid_arr); $i++)
    	        {
    	            $user_id = $_userid_arr[$i];
    	            //var_dump("userid:".$user_id);
    	            $userinfoOBJ = new User_info();
    	            $positionOBJ = new Positionality();
    	            if($is_punish == 1)
    	            {
    	                $userinfoRES = $userinfoOBJ->UserinfoLock($user_id, $status);
    	                $positionRES = $positionOBJ->updateStatusSingle($user_id, $status);
    	            }
    	            else
    	            {
    	                $detailsOBJ = new User_details();
    	                $detialsRES = $detailsOBJ->DetailsQuery($user_id);
    	                if(count($detialsRES)<1)
    	                {
    	                    $_resdata["ok"] = 0;
    	                }
    	                else
    	                {
    	                    $pos_status = $detialsRES[0]["user_level"];
    	                    $userinfoRES = $userinfoOBJ->UserinfoLock($user_id, 1);
    	                    $positionRES = $positionOBJ->updateStatusSingle($user_id, $pos_status);
    	                }
    	            }
    	            return json_encode($_resdata);
    	        }
    	    }
            else 
                return json_encode($_resdata);
        }
    }
    
    public function awardRecordsQuery($userid, $pageindex, $pagesize)
    {
        $_session_user = Session::get(USER_SEESION);
        $_resdata = array();
        $_resdata["ok"] = 0;
        if(empty($_session_user))
        {
            return json_encode($_resdata);
        }
        else
        {
            $_userid = $_session_user["userId"];
            if($_userid < "1000")//当前用户是管理员
            {
                $awardOBJ = new Award_record();
                $awardRES = $awardOBJ->AwardRecordQueryWithLimit($userid);
                if(count($awardRES) > 0)
                {
                    $_resdata["ok"] = 1;
                    $_resdata["res"] = $_resdata;
                }
                return json_encode($_resdata);
            }
            else
                return json_encode($_resdata);
        }
    }
    
    public function notice($subject, $comment)
    {
        $_session_user = Session::get(USER_SEESION);
        $_resdata = array();
        $_resdata["ok"] = 0;
        if(empty($_session_user))
        {
            return json_encode($_resdata);
        }
        else
        {
            $_userid = $_session_user["userId"];
            if($_userid < "1000")//当前用户是管理员
            {
                $noticeOBJ = new Notice();
                $noticeRES = $noticeOBJ->NoticeInsert($subject, $comment);
                if(count($noticeRES) > 0)
                {
                    $_resdata["ok"] = 1;
                    $_resdata["res"] = $_resdata;
                }
                return json_encode($_resdata);
            }
            else
                return json_encode($_resdata);
        }
    }
    //--------------------------------------------------------
    //--------------------------------------------------------
    //--------------------------------------------------------
    //--------------------------------------------------------
    public function IncomeExpenditureInsert($deal_count, $incomings, $outgoing, $current_profit, $out_contrast_in)
    {
        $_inandout = new Income_expenditure();
        $_inandout->IncomeExpenditureInsert($deal_count, $incomings, $outgoing, $current_profit, $out_contrast_in);
    }
    
    public function IncomeExpenditureQuery($record_id)
    {
        $_inandout = new Income_expenditure();
        //var_dump($_inandout->IncomeExpenditureQuery($record_id));
    }
    
    public function IncomeExpenditureUpdate($record_id, $deal_count, $incomings, $outgoing, $current_profit, $out_contrast_in)
    {
        $_inandout = new Income_expenditure();
        $_inandout->IncomeExpenditureUpdate($record_id, $deal_count, $incomings, $outgoing, $current_profit, $out_contrast_in);
    }
    
    public function PositionInsert($ID, $json)
    {
        $_position = new Positionality();
        $_position->PositionInsert($ID, $json);
    }
    
    public function PositionQuery($ID)
    {
        $_position = new Positionality();
        //var_dump($_position->PositionQuery($ID));
    }
    
    public function PositionDel($ID)
    {
        $_position = new Positionality();
        $_position->PositionDel($ID);
    }
    
    public function PositionUpdate($ID, $json)
    {
        $_position = new Positionality();
        $_position->PositionUpdate($ID, $json);
    }
    
    public function RoleInsert($ID, $role_type, $role_name)
    {
        $_role = new Role();
        $_role->RoleInsert($ID, $role_type, $role_name);
    }
    
    public function RoleUpdate($ID, $role_type, $role_name)
    {
        $_role = new Role();
        $_role->RoleUpdate($ID, $role_type, $role_name);
    }
    
    public function RoleQuery($ID)//���������Ĳ��ҷ�ʽ���˴�ֻ�г���һ��
    {
        $_role = new Role();
        //var_dump($_role->RoleQuery($ID));
    }
    
    public function RoleDel($ID)
    {
        $_role = new Role();
        $_role->RoleDel($ID);
    }
    
    public function PriorityInsert($ID, $priority_link, $link_type, $to_intercept)
    {
        $_priority = new Priority();
        $_priority->PriorityInsert($ID, $priority_link, $link_type, $to_intercept);
    }
    
    public function PriorityQuery($ID)
    {
        $_priority = new Priority();
        //var_dump( $_priority->PriorityQuery($ID) );
    }
    
    public function PriorityDel($ID)
    {
        $_priority = new Priority();
        $_priority->PriorityDel($ID);
    }
    
    public function PriorityUpdate($ID, $priority_link, $link_type, $to_intercept)
    {
        $_priority = new Priority();
        $_priority->PriorityUpdate($ID, $priority_link, $link_type, $to_intercept);
    }
    
    public function DealinfoInsert($deal_id, $user_id, $deal_type, $deal_sum)
    {
        $_dealinfo = new Deal_info();
        $_dealinfo->DealinfoInsert($deal_id, $user_id, $deal_type, $deal_sum);
    }
    
    public function DealinfoQuery($deal_id)
    {
        $_dealinfo = new Deal_info();
        //var_dump($_dealinfo->DealinfoQuery($deal_id));
    }
    
    public function DealinfoUpdate($deal_id, $user_id, $deal_type, $deal_sum)
    {
        $_dealinfo = new Deal_info();
        $_dealinfo->DealinfoUpdate($deal_id, $user_id, $deal_type, $deal_sum);
    }
    
    public function DealinfoDel($deal_id)
    {
        $_dealinfo = new Deal_info();
        $_dealinfo->DealinfoDel($deal_id);
    }

    public function PointTransformQuerySrc()
    {
        $_point_transform = new Point_transform_record();
        $_res = $_point_transform->PointTransformQuery(100042);
        //var_dump($_res);
    }
    
    public function PointTransformInsert($point_id, $user_id, $point_type, $point_change_sum, $point_change_type)
    {
        $_point_transform = new Point_transform_record();
        $_res = $_point_transform->PointTransformInsert($point_id, $user_id, $point_type, $point_change_sum, $point_change_type);
        //var_dump($_res);
    }
    
    
    

}
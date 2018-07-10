<?php
namespace app\trigger\controller;

use think\Controller;
use app\common\model\User_point;
use app\common\model\User_details;
use app\trigger\controller\External;
use app\common\model\Positionality;
use app\common\model\Award_daytime;
use app\common\model\Award_record;
use app\common\model\User_info;
use app\common\model\User_priority;

class Awardopt extends Controller
{
    public function index()
    {
        //echo "class Trigger index";
    }
    
    public function zhitui_jj($inUserID, $re_id, $reg_money) 
    {
        //echo "推荐奖";
        //var_dump("user:".$inUserID."recom:".$re_id);
        $user = new User_point();
        $res = $user->PointQuery($re_id);
        $res = $res[0];
        $moneyOBJ  = new External();
        $resMoney = $moneyOBJ->getParam("zhitui_proportion", -1, $re_id);
        $get_money = $resMoney * $reg_money / 100;
        $userinfo = new User_info();
        $resInfo = $userinfo->getUserstate($re_id);
        if($resInfo > 0)//当前拿奖的人必须是开通的，必须要两个表
        {
            // get user level
            $user_details = new User_details();
            $res_details = $user_details->DetailsQuery($re_id);
            $user_level =$res_details[0]["user_level"];
            //echo $user_level;
            //get recommend-award percents
            $extern =new External();
            //var_dump("Awardopt.php line:".__LINE__);
            //calculate real money as awards
            $get_money = ($res["shengyu_dong"] - $get_money)<0 ? $res['shengyu_dong']:$get_money;
            //update relative data to database
            if ($get_money > 0) {
                //var_dump("re_id:".$re_id."|bonus:".$res["bonus_point"]."getmoney:".$get_money);
                //$this->_in_bonus($vo['id'], $inUserID, 1, $get_money);   //！！！！！！！奖金处理需要更改
                $state = $user->PointUpdate($re_id, -1, $res["bonus_point"]+$get_money, -1, $res["re_consume"]+ $get_money*0.1, 
                                -1, -1, -1, -1,-1,$res["shengyu_dong"] - $get_money);
                if($state)
                    //echo "update success";
                
                //更新人/每天表，此处是直推奖
                $positionOBJ=new Positionality();
                $positionRES = $positionOBJ->PositionQuery($re_id);
                $positionRES = $positionRES[0];
                $awardday = new Award_daytime();
                $_res_qibonus = $awardday->AwarddailyQuery($positionRES["ID"]);
                if(count($_res_qibonus) < 1)
                    $awardday->AwarddailyInsert($positionRES["ID"], $get_money);
                else
                {
                    $_res_qibonus = $_res_qibonus[0];
                    $awardday->AwarddailyUpdate($positionRES["ID"], $_res_qibonus["direct"] + $get_money);
                }
                
                //奖金明细，添加一天记录 
                $paramOBJ = new External();
                $shui_bl = $paramOBJ->getParam("tax_proportion", -1, $re_id);
                $jijin_bl = $paramOBJ->getParam("foundation_proportion", -1, $re_id);//cy_get_conf('bl_jijin');//1
                $shui = $this->_wei2($get_money * $shui_bl / 100);//保留两位小数，税
                $jijin = $this->_wei2($get_money * $jijin_bl / 100);//基金
                $produceCX = $this->_wei2($get_money*0.1); //重复消费分
                $ok_money = $this->_wei2($get_money - $shui-$jijin - $produceCX);//实际发放金额
                $minfo = '实发（'.$ok_money.'）重消分（'.$produceCX.'）税收（'.$shui.'）基金（'.$jijin.'）。';
                
                $award_record = new Award_record();
                $_res_award_record = $award_record->AwardRecordInsert($re_id, "直推奖", $get_money, $inUserID, $minfo);
            }
        }
    }
    
    //辅导奖
    public function tutorAward($inUserID, $re_path="", $re_level=1, $jj_money=0, $ft=0)
    {
        //echo "tutorAward";
        //var_dump("Awardopt.php line:".__LINE__."user id:".$inUserID);
        $_points =new User_point();
        $detailsOBJ = new User_details();
        $_dayly_point = new Award_daytime();
        $_res= $detailsOBJ->DetailsQuery($inUserID);
        //var_dump($_res[0]['repath']);
        if(count($_res) < 1)
        {
            //var_dump("Error None, Awardopt.php:line".__LINE__);
            return;
        }
        
        //var_dump("input repath:".$re_path);
        $strSRC=$_res[0]['repath'];
        //var_dump("calculate repath:".$strSRC);
        //changed by Gavin start model11
        $strSRC = substr($strSRC, 1, strlen($strSRC)-1);
        $strSRC = substr($strSRC, 0, strlen($strSRC)-1);
        //changed by Gavin end model11
        $pos = strrpos($strSRC,',');
        if( strlen($strSRC)!=0 && $pos == false )
            $pos = true;
        $strSRC = substr($strSRC,0, $pos);//这里是当前节点是谁的直推节点，谁就拿辅导奖
        //var_dump("Awardopt.php line:".__LINE__."string:".$strSRC);
        $daishuForaward = 1;
        while ( $pos != false ){
            $pos = strrpos($strSRC,',');
            if($pos == false)
                $tmp = $strSRC;
            else
                $tmp = substr($strSRC, $pos+1, strlen($strSRC));
           //var_dump("enter times");
           $strSRC = substr($strSRC,0, $pos);
           //var_dump("strSRC:".$strSRC);
           $ID = $tmp;
           //var_dump("ID:".$ID);

           //echo "tttttttttttttttt";
           $_currentDet = $detailsOBJ->DetailsQueryByAutoId($ID) ;
           $_currentDet = $_currentDet[0];
           $_userid = $_currentDet["ID"];
           
           $paramOBJ= new External();
           $jj = $paramOBJ->getParam("fudao_proportion", -1, $_userid );//cy_get_conf('s5'); //5|5|5|5|5|5 %
           $dai = $paramOBJ->getParam("fudao_daishu", -1, $_userid );//cy_get_conf('s6');	//1|2|2|3|4|5　代，a推荐b，b推荐c，c产生对碰奖，且代为2，则a和b都拿辅导奖，且基数为5%
           
           if($dai < $daishuForaward)
           {
               $daishuForaward = $daishuForaward + 1;
               //var_dump("Awardopt.php line:".__LINE__."超出推荐代数");
               continue;
           }
           else 
               $daishuForaward = $daishuForaward +1;
           //$i++;
           //var_dump($_userid);
           
           $_pointsRes = $_points->PointQuery($_userid);
           $_pointsRes = $_pointsRes[0];
           $get_money = $jj_money * $jj / 100;
           //$get_money = $this->_fengding($get_money, $ft, $_pointsRes['dp_leiji']); //
           $get_money = ($_pointsRes['shengyu_dong'] - $get_money)<0 ? $_pointsRes['shengyu_dong']:$get_money;
           //echo "money:";
           //var_dump($_pointsRes[0]['bonus_point']);
           //update the user points table
           $paramOBJ = new External();
           $shui_bl = $paramOBJ->getParam("tax_proportion", -1, $ID);
           $jijin_bl = $paramOBJ->getParam("foundation_proportion", -1, $ID);//cy_get_conf('bl_jijin');//1
           $shui = $this->_wei2($get_money * $shui_bl / 100);//保留两位小数，税
           $jijin = $this->_wei2($get_money * $jijin_bl / 100);//基金
           $produceCX = $this->_wei2($get_money*0.1); //重复消费分
           $ok_money = $this->_wei2($get_money - $shui-$jijin - $produceCX);//实际发放金额
           $_res_points_set = $_points->PointUpdate($_userid, $_pointsRes[0]['shares'], $_pointsRes[0]['bonus_point'] + $ok_money, $_pointsRes[0]['regist_point'], $_pointsRes[0]['re_consume'] + $produceCX, 
                                $_pointsRes[0]['universal_point'], $_pointsRes[0]['re_cast'], $_pointsRes[0]['remain_point'] - $get_money,-1,-1,$_pointsRes["shengyu_dong"] - $get_money);
           
           //var_dump("point update failed");
           //update the user daily points records table
           
               
           $positionOBJ = new Positionality();
           $positionRES = $positionOBJ->PositionQueryByID($ID);
           $ID = $positionRES[0]["user_id"];
           $_res_point_dayly = $_dayly_point->AwarddailyQuery($ID);
           if(sizeof($_res_point_dayly) > 0)
           {
              //var_dump("inbonus Awardopt.php line:".__LINE__);
              $_dayly_point->AwarddailyUpdate($ID, -1, -1, $_res_point_dayly[0]["balance"] +$get_money);
              $this->_in_bonus($_userid, $inUserID, 3, $get_money);
           }
           else
           {
               //var_dump("inbonus Awardopt.php line:".__LINE__);
               $res = $_dayly_point->AwarddailyInsert($ID, -1, -1, $get_money);
               $this->_in_bonus($_userid, $inUserID, 3, $get_money);
           }
        }
    }
    
    //感恩奖，参数1是左区感恩者，参数2右区感恩者，产生感恩奖的id，平衡奖金
    public function thanksAward($ganen_id,$ganen_r_id,$inUserID,$pingheng_money)
    {
        $_points =new User_point();
        $position = new Positionality();
        $_dayly_point = new Award_daytime();
        $_res= $position->PositionQuery($inUserID);
        //var_dump($_res[0]['json']);
        $paramOBJ= new External();
        $jj = $paramOBJ->getParam("ganen_proportion", -1, $ganen_id );
        $get_money = $pingheng_money * $jj / 100;
        if($ganen_id)
            $_pointsRes = $_points->PointQuery($ganen_id);
        else 
            $_pointsRes = $_points->PointQuery($ganen_r_id);
        $get_money = ($_pointsRes[0]['shengyu_dong'] - $get_money)<0 ? $_pointsRes[0]['shengyu_dong']:$get_money;
        //var_dump($get_money);
        $paramOBJ = new External();
        $shui_bl = $paramOBJ->getParam("tax_proportion", -1, $ganen_id);
        $jijin_bl = $paramOBJ->getParam("foundation_proportion", -1, $ganen_id);//cy_get_conf('bl_jijin');//1
        $shui = $this->_wei2($get_money * $shui_bl / 100);//保留两位小数，税
        $jijin = $this->_wei2($get_money * $jijin_bl / 100);//基金
        $produceCX = $this->_wei2($get_money*0.1); //重复消费分
        $ok_money = $this->_wei2($get_money - $shui-$jijin - $produceCX);//实际发放金额
        
        $ganen_id_pos = $position->PositionQuery($ganen_id);
        $ganen_id_pos = $ganen_id_pos[0];
        
        $ganen_r_id_pos = $position->PositionQuery($ganen_r_id);
        $ganen_r_id_pos = $ganen_r_id_pos[0];
        
        if($ganen_id){
            //echo "point search:";
            if($get_money > 0){
                $_res_points_set = $_points->PointUpdate($ganen_id, $_pointsRes[0]['shares'], $_pointsRes[0]['bonus_point'] + $ok_money, $_pointsRes[0]['regist_point'], $_pointsRes[0]['re_consume'] + $produceCX, 
                                $_pointsRes[0]['universal_point'], $_pointsRes[0]['re_cast'], -1,-1,-1, $_pointsRes[0]['shengyu_dong'] - $get_money);
                $_res_point_dayly = $_dayly_point->AwarddailyQuery($ganen_id_pos["ID"]);
                if(sizeof($_res_point_dayly) > 0)
                {
                   //var_dump("inbonus Awardopt.php line:".__LINE__);
                   $_dayly_point->AwarddailyUpdate($ganen_id_pos["ID"], -1, $_res_point_dayly[0]["balance"] +$get_money);
                   $this->_in_bonus($ganen_id, $inUserID, 4, $get_money);
                }
                else
                {
                   //var_dump("inbonus Awardopt.php line:".__LINE__);
                   $_dayly_point->AwarddailyInsert($ganen_id_pos["ID"], 0, $get_money);
                   $this->_in_bonus($ganen_id, $inUserID, 4, $get_money);
                }
            }
        }
        if($ganen_r_id){
            if($get_money > 0){
               $_res_points_set = $_points->PointUpdate($ganen_r_id, $_pointsRes[0]['shares'], $_pointsRes[0]['bonus_point'] + $ok_money, $_pointsRes[0]['regist_point'], $_pointsRes[0]['re_consume'] + $produceCX, 
                                $_pointsRes[0]['universal_point'], $_pointsRes[0]['re_cast'], -1,-1,-1, $_pointsRes[0]['shengyu_dong'] - $get_money);
                $_res_point_dayly = $_dayly_point->AwarddailyQuery($ganen_r_id_pos["ID"]);
                if(sizeof($_res_point_dayly) > 0)
                {
                    //var_dump("inbonus Awardopt.php line:".__LINE__);
                    $_dayly_point->AwarddailyUpdate($ganen_r_id_pos["ID"], -1, $_res_point_dayly[0]["balance"] +$get_money);
                    $this->_in_bonus($ganen_r_id, $inUserID, 4, $get_money);
                }
                else 
                {
                   //var_dump("inbonus Awardopt.php line:".__LINE__);
                   $_dayly_point->AwarddailyInsert($ganen_r_id_pos["ID"], 0, $get_money);
                   $this->_in_bonus($ganen_r_id, $inUserID, 4, $get_money);
                }
            }
        }
         
    }
    
    //平衡奖
    public function balanceAward()
    {
                    
    }
    
    //向上会员单数统计 --开通一个新人之后，向上统计,$p_path就是网络结构图，$tpl左区为0，右区1
	public function tree2ds_tongji($p_path, $tpl, $danshu = 1) //节点路径$p_path是节点路径，参数2是当前节点是父节点的左区还是右区
	{ 
	    //var_dump("Awardopt.php line:".__LINE__."|p_path:".$p_path."|tpl:".$tpl."|danshu:".$danshu);
	    $position = new Positionality();
	    //json 循环操作，获取每一个元素
	    $strSRC=$p_path;
	    $strSRC = substr($strSRC, 1, strlen($strSRC)-1);
	    $strSRC = substr($strSRC, 0, strlen($strSRC)-1);
	    $pos = strrpos($strSRC,',');
	    //$strSRC = substr($strSRC,0, $pos);
	    //var_dump("Awardopt.php line:".__LINE__."string:".$strSRC);
	    while ( $pos != false ){
	        $pos = strrpos($strSRC,',');
	        if($pos == false)
	            $tmp = $strSRC;
            else
                $tmp = substr($strSRC, $pos+1, strlen($strSRC));
            $strSRC = substr($strSRC,0, $pos);
            
            $ID = $tmp;
//             var_dump("ID:".$ID);
            $curNode = $position->PositionQueryByID($ID);
	        $data = array();
	        $data['sum_ds'] = $curNode[0]['sum_ds'] + $danshu;
	        if ($tpl == 0) {
	            $data['l_ds'] = $curNode[0]['l_ds'] + $danshu;
	            $data['bq_lds'] = $curNode[0]['bq_lds'] + $danshu;
	            $position->updateJiangjin($ID, -1,$data['l_ds'],$data['bq_lds'],-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,$data['sum_ds']);
	    
	            //平衡奖总额对碰，增加对碰额
	            /* $data['l_dse'] = array('exp','l_dse+'.$reg_money);
	             $data['bq_lds'] = array('exp', 'bq_ldse+'.$reg_money); */
	        } elseif ($tpl == 1) {
	            $data['r_ds'] = $curNode[0]['r_ds'] + $danshu;
	            $data['bq_rds'] = $curNode[0]['bq_rds'] + $danshu;
	            $position->updateJiangjin($ID, -1,-1,-1,-1,$data['r_ds'],$data['bq_rds'],-1,-1,-1,-1,-1,-1,-1, $data['sum_ds']);
	        }
	        $tpl = $curNode[0]['treeplace'];
	    }
	}
	
	public function tree2ds_tongji_update($p_path, $tpl, $danshu = 1) //节点路径$p_path是节点路径，参数2是当前节点是父节点的左区还是右区
	{
	    //var_dump("Awardopt.php line:".__LINE__."|p_path:".$p_path."|tpl:".$tpl."|danshu:".$danshu);
	    $position = new Positionality();
	    //json 循环操作，获取每一个元素
	    $strSRC=$p_path;
	    $strSRC = substr($strSRC, 1, strlen($strSRC)-1);
	    $strSRC = substr($strSRC, 0, strlen($strSRC)-1);
	    $pos = strrpos($strSRC,',');
	    //$strSRC = substr($strSRC,0, $pos);
	    //var_dump("Awardopt.php line:".__LINE__."string:".$strSRC);
	    while ( $pos != false ){
	        $pos = strrpos($strSRC,',');
	        if($pos == false)
	            $tmp = $strSRC;
	            else
	                $tmp = substr($strSRC, $pos+1, strlen($strSRC));
	                $strSRC = substr($strSRC,0, $pos);
	
	                $ID = $tmp;
	                //var_dump("ID:".$ID);
	                $curNode = $position->PositionQueryByID($ID);
	                $data = array();
	                $data['sum_ds'] = $curNode[0]['sum_ds'] + $danshu;
	                if ($tpl == 0) {
	                    $data['l_ds'] = $curNode[0]['l_ds'] + $danshu;
	                    $data['bq_lds'] = $curNode[0]['bq_lds'] + $danshu;
	                    $position->updateJiangjin($ID, -1,$data['l_ds'],$data['bq_lds'],-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,$data['sum_ds']);
	                     
	                    //平衡奖总额对碰，增加对碰额
	                    /* $data['l_dse'] = array('exp','l_dse+'.$reg_money);
	                     $data['bq_lds'] = array('exp', 'bq_ldse+'.$reg_money); */
	                } elseif ($tpl == 1) {
	                    $data['r_ds'] = $curNode[0]['r_ds'] + $danshu;
	                    $data['bq_rds'] = $curNode[0]['bq_rds'] + $danshu;
	                    $position->updateJiangjin($ID, -1,-1,-1,-1,$data['r_ds'],$data['bq_rds'],-1,-1,-1,-1,-1,-1,-1, $data['sum_ds']);
	                }
	                $tpl = $curNode[0]['treeplace'];
	    }
	}
	
	//虚的统计--修改之后      tree2ds_x_tongji
	public function tree2ds_x_tongji($p_path, $tpl, $danshu = 1) {
	    //var_dump("Awardopt.php line:".__LINE__."|p_path:".$p_path."|tpl:".$tpl."|danshu:".$danshu);
	    $position = new Positionality();
	    //json 循环操作，获取每一个元素
	    $strSRC=$p_path;
	    //changed by Gavin start model11
	    $strSRC = substr($strSRC, 1, strlen($strSRC)-1);
	    $strSRC = substr($strSRC, 0, strlen($strSRC)-1);
	    //changed by Gavin end model11
	    $pos = strrpos($strSRC,',');// 使得pos返回字符串末尾
	    /*
	    $pos = strrpos($strSRC,',');
	    $strSRC = substr($strSRC,0, $pos);*/
	    //var_dump("Awardopt.php line:".__LINE__."string:".$strSRC);
	    while ( $pos != false ){
	        $pos = strrpos($strSRC,',');
	        if($pos == false)
	            $tmp = $strSRC;
            else
                $tmp = substr($strSRC, $pos+1, strlen($strSRC));
            $strSRC = substr($strSRC,0, $pos);
            
            $ID = $tmp;
            //var_dump("ID:".$ID);
            $curNode = $position->PositionQueryByID($ID);

            $data = array();
            $tpl = $curNode[0]['treeplace'];
            if ($tpl == 0) {
                //var_dump("left vitual danshu");
                $data['l_x_ds'] = $curNode[0]['l_x_ds'] + $danshu;
                $data['bq_x_lds'] = $curNode[0]['bq_x_lds'] + $danshu;
                $position->updateJiangjin($ID, -1,-1,-1,-1,-1,-1,-1,$data['l_x_ds'],$data['bq_x_lds'],-1,-1,-1,-1);

            } elseif ($tpl == 1) {
                //var_dump("right vitual danshu");
                $data['r_x_ds'] = $curNode[0]['r_x_ds'] + $danshu;
                $data['bq_x_rds'] = $curNode[0]['bq_x_rds'] + $danshu;
                $position->updateJiangjin($ID, -1,-1,-1,-1,-1,-1,-1,-1,-1,-1,$data['r_x_ds'],$data['bq_x_rds'],-1);
            }
	    }  
	}
	
    //奖金统计 
	public function bonus_tongji($uid,  $is_agent = 0) {    //做修改,参数2等于0表示复投时奖金统计，参数2等于1表示正常的奖金统计
		set_time_limit(0);
		$position = new Positionality();
		$details = new User_details();
		$_res = $position->PositionQuery($uid);
		$_recommand = $details->DetailsQuery($uid);
		$moneyOBJ  = new External();
		$resMoney = $moneyOBJ->getParam("register_total", -1, $uid);
		//用户ID，用户名，用户等级，是否开通，开通排序，网络结构父ID，网络结构路径，网络结构等级，推荐人ID，推荐路径、推荐等级、投资金额，所属报单中心ID，开通的会员ID
		$vo = $_res[0];
		if ($vo["status"] > 0)
		{
		    if($is_agent == 0){//实际注册进入
		        $this->zhitui_jj($vo['user_id'], $_recommand[0]['recommender'], $resMoney);
		        $this->duipeng();
		    }else{//复投逻辑进入
		        $this->zhitui_jj($vo['user_id'], $_recommand[0]['recommender'], $resMoney);
		        $this->futou_duipeng();
		    }
		}
	}
	
	//奖金统计
	public function bonus_tongji_update($uid, $cost_money, $is_agent = 0) {    //做修改,参数2等于0表示复投时奖金统计，参数2等于1表示正常的奖金统计
	    set_time_limit(0);
	    $position = new Positionality();
	    $details = new User_details();
	    $_res = $position->PositionQuery($uid);
	    $_recommand = $details->DetailsQuery($uid);

	    $resMoney = $cost_money;
	    //用户ID，用户名，用户等级，是否开通，开通排序，网络结构父ID，网络结构路径，网络结构等级，推荐人ID，推荐路径、推荐等级、投资金额，所属报单中心ID，开通的会员ID
	    $vo = $_res[0];
	    if ($vo["status"] > 0)
	    {
	        if($is_agent == 0){//实际注册进入
	            $this->zhitui_jj($vo['user_id'], $_recommand[0]['recommender'], $resMoney);
	            $this->duipeng();
	        }else{//复投逻辑进入
	            $this->zhitui_jj($vo['user_id'], $_recommand[0]['recommender'], $resMoney);
	            $this->futou_duipeng();
	        }
	    }
	}
	
	//对碰奖 b2   平衡奖
	public function duipeng() {
	    $position = new Positionality();
        $position->updateDuipeng();//重置当天的对碰奖累积值
	    //$where = 'is_pay>0  AND ((bq_lds)>0 OR (bq_rds)>0)';     //上期左区单数+本期左区单数     上期右区单数+本期右区单数
	    //$fields = 'id,user_id,u_level,sq_lds,bq_lds,sq_rds,bq_rds,dp_leiji,re_path,re_level,shengyu_dong,bz3,ganen_next_id,ganen_next_r_id';
	    //会员ID，用户名，开通排序，推荐人ID，用户等级，上期左区单数，本期左区单数，上期右区单数，本期右区单数，对碰业绩累积，推荐路径，推荐人等级，
	    //$frs = $this->where($where)->field($fields)->select();
	    $_res = $position->getDuiPengInfo(1);
	    if(count($_res) < 1)
	        return;

	    foreach ($_res as $vo) {
	        if($vo['status'] < 1){
	            continue;
	        }
	        //var_dump("Awardopt.php user id:".$vo["user_id"]."line:".__LINE__);
	        $paramOBJ = new External();
	        $jj = $paramOBJ->getParam("pingheng_proportion", -1, $vo["user_id"]);
	        //$jj = 7;//cy_get_conf('s4'); 	//7|8|9|10|11  %
	        $ft = $paramOBJ->getParam("pingheng_max", -1, $vo["user_id"]);
	        //$ft = 500;//cy_get_conf('ft01');	//100|500|1000|3000|5000|10000  封顶额 美元
	        $bb_list = $paramOBJ->getParam("register_total", -1, $vo["user_id"]);//
	        //$bb_list = 500;//_get_conf('bb_list', 1);     //投资金额
	        $ds_list = $paramOBJ->getParam("register_order_num", -1, $vo["user_id"]);//_get_conf('ds_list', 1);//投资单数
	        $dsmoney = intval($bb_list / $ds_list);//$bb_list[1] / $ds_list[1]; //200    每一单价格
	        //var_dump("jj:".$jj."ft:".$ft."bblist:".$bb_list."dslist:".$ds_list);
	        
	        //暂时取消不计算管理员积分的功能
	        /*
	        if($vo["parent"] == 0)//当前节点是管理员账号，不进行积分计算
	            continue;*/
	        
	        $myids = $vo['user_id'];
	        $inUserID = $vo['user_id'];
	        $l = $r = 0;
	        $l = $vo['sq_lds'] + $vo['bq_lds'];     //左区单数
	        $r = $vo['sq_rds'] + $vo['bq_rds'];     //右区单数
	        $encash = array();
	        $nums = $money = $ls = $rs = 0;
	        //var_dump("Awardopt.php line:".__LINE__."l:".$l."r:".$r);
	        $this->touch1to1($encash, $l, $r, $nums);
	        $ls = $l - $encash[0];   //左区剩余单数
	        $rs = $r - $encash[1];   //右区剩余单数
	        //var_dump("Awardopt.php line:".__LINE__."l:".$ls."r:".$rs."encash0:".$encash[0]."encash1:".$encash[1]);
	        //var_dump("Awardopt.php line:".__LINE__."nbums:".$nums);
	        $get_money = $dsmoney * $jj / 100 * $nums;    //$nums为对碰单数
	        //var_dump("Awardopt.php line:".__LINE__);
	        //var_dump("vo:".$vo["dp_leiji"]."|getmoney:".$get_money);;
	        $user_point = new User_point();
	        $_point = $user_point->PointQuery($inUserID);
	        $_point = $_point[0];
	        if ($ft > 0) {
	            $get_money = $this->_fengding($get_money, $ft, $vo['dp_leiji']); //
	            $get_money = ($_point['shengyu_dong'] - $get_money)<0 ? $_point['shengyu_dong']:$get_money;
	            $data = array();
	            //$data['bz3'] = $_point['bz3']+round(0.1*$get_money,2);
	            $data['re_consume'] = $_point['re_consume']+round(0.1*$get_money,2);
	            $data['shengyu_dong'] = $_point['shengyu_dong'] - $get_money;
	            
	            //var_dump("money:".$get_money);
	            
	            $paramOBJ = new External();
	            $shui_bl = $paramOBJ->getParam("tax_proportion", -1, $myids);
	            $jijin_bl = $paramOBJ->getParam("foundation_proportion", -1, $myids);//cy_get_conf('bl_jijin');//1
	            $shui = $this->_wei2($get_money * $shui_bl / 100);//保留两位小数，税
	            $jijin = $this->_wei2($get_money * $jijin_bl / 100);//基金
	            $produceCX = $this->_wei2($get_money*0.1); //重复消费分
	            $ok_money = $this->_wei2($get_money - $shui-$jijin - $produceCX);//实际发放金额
	            $data['bonus_point'] = $_point['bonus_point'] + $ok_money;
	            $minfo = '实发（'.$ok_money.'）重消分（'.$produceCX.'）税收（'.$shui.'）基金（'.$jijin.'）。';
	            $award_record = new Award_record();
	            //$_res_award_record = $award_record->AwardRecordInsert($myids, "平衡奖", $get_money, $myids, $minfo);
	            
	            $user_point->PointUpdate($inUserID, -1, $data['bonus_point'], -1, $data['re_consume'], -1, -1, -1, -1, -1, $data['shengyu_dong']);
	        }
	        //$this->query("UPDATE __TABLE__ SET `sq_lds`={$ls},`sq_rds`={$rs},`bq_lds`=0,`bq_rds`=0 WHERE `id`=".$myids);//数据库更新左右区单数
	        $_res_jiangjin = $position->updateJiangjin($vo['ID'], -1, -1, 0, $ls, -1, 0, $rs, -1, -1, -1, -1, -1, -1, -1);
	        if ($get_money > 0) {
	            //var_dump("inbonus Awardopt.php line:".__LINE__);
	            $this->_in_bonus($myids, $inUserID, 2, $get_money);// 参数3等于2表示添加平衡奖，只有平衡对于积分的修改在in_bonus内部，其他的都在外面
	            
	            //辅导奖
	            //$this->guanli_jj($vo['user_id'], $vo['re_path'], $vo['re_level'], $get_money);
	            $detailsOBJ = new User_details();
	            $_resDetails = $detailsOBJ->DetailsQuery($vo["user_id"]);
	            $_resDetails = $_resDetails[0];
	            $this->tutorAward($vo['user_id'], $_resDetails['repath'], $_resDetails["recommandlevel"]/*$vo['re_level']*/, $get_money,$ft);
	            
	            //感恩奖
	            //var_dump("Awardopt line:".__LINE__."id:".$vo['user_id']);
	            $ganenForthanks = $position->getUserIdByID($vo['ganen_next_id']);
	            if(count($ganenForthanks) < 1)
	                $ganenForthanks = 0;
	            
	            $ganenRidForthanks = $position->getUserIdByID($vo['ganen_next_r_id']);
	            if(count($ganenRidForthanks) < 1)
	                $ganenRidForthanks = 0;
	            
                //var_dump("ganenid:".$ganenForthanks);
                //var_dump("ganen_r_id:".$ganenRidForthanks);
	            $this->thanksAward($ganenForthanks,$ganenRidForthanks,$vo['user_id'],$get_money);
	        }
	    }

	}
	
	//对碰奖 b2   平衡奖
	public function futou_duipeng() {
	    $position = new Positionality();
	    $position->updateDuipeng();//重置当天的对碰奖累积值
	    //$where = 'is_pay>0  AND ((bq_lds)>0 OR (bq_rds)>0)';     //上期左区单数+本期左区单数     上期右区单数+本期右区单数
	    //$fields = 'id,user_id,u_level,sq_lds,bq_lds,sq_rds,bq_rds,dp_leiji,re_path,re_level,shengyu_dong,bz3,ganen_next_id,ganen_next_r_id';
	    //会员ID，用户名，开通排序，推荐人ID，用户等级，上期左区单数，本期左区单数，上期右区单数，本期右区单数，对碰业绩累积，推荐路径，推荐人等级，
	    //$frs = $this->where($where)->field($fields)->select();
	    $_res = $position->getDuiPengInfo(0);
	    if(count($_res) > 0)
	    {
	        foreach ($_res as $vo) {
    	        /*if($vo['is_lock'] != 0){
    	         continue;
    	         }*/
    	        if($vo["parent"] == 0)//当前节点是管理员账号，不进行积分计算
    	            continue;
	            $paramOBJ = new External();
	            $jj = $paramOBJ->getParam("pingheng_proportion", -1, $vo["user_id"]);
	            $ft = $paramOBJ->getParam("pingheng_max", -1, $vo["user_id"]);
	            //$ft = 500;//cy_get_conf('ft01');	//100|500|1000|3000|5000|10000  封顶额 美元
	            $bb_list = $paramOBJ->getParam("register_total", -1, $vo["user_id"]);//
	            //$bb_list = 500;//_get_conf('bb_list', 1);     //投资金额
	            $ds_list = $paramOBJ->getParam("register_order_num", -1, $vo["user_id"]);//_get_conf('ds_list', 1);//投资单数
	            $dsmoney = intval($bb_list / $ds_list);//$bb_list[1] / $ds_list[1]; //200    每一单价格
	            //var_dump("jj:".$jj."ft:".$ft."bblist:".$bb_list."dslist:".$ds_list);
	            
    	        $myids = $vo['user_id'];
    	        $inUserID = $vo['user_id'];
                $l = $vo['sq_lds']+$vo['sq_x_lds'] + $vo['bq_x_lds'];     //左区虚单数
    			$r = $vo['sq_rds']+$vo['sq_x_rds'] + $vo['bq_x_rds'];     //右区虚单数
    	        $encash = array();
    	        $nums = $money = $ls = $rs = 0;
    	        $this->touch1to1($encash, $l, $r, $nums);
    	        $ls = $l - $encash[0]-$vo['sq_lds'];   //左区剩余单数
    	        $rs = $r - $encash[1]-$vo['sq_rds'];   //右区剩余单数
    	        $ss = $vo['status'];
    	
    	        $get_money = 500 * $jj / 100 * $nums;    //$nums为对碰单数
    	
    	        $user_point = new User_point();
    	        $_point = $user_point->PointQuery($inUserID);
    	        $_point = $_point[0];
    	        if ($ft > 0) {
    	            $get_money = $this->_fengding($get_money, $ft, $vo['dp_leiji']); //
    	            $get_money = ($_point['shengyu_dong'] - $get_money)<0 ? $_point['shengyu_dong']:$get_money;
    	            $data = array();
    	            //$data['bz3'] = $_point['bz3']+round(0.1*$get_money,2);
    	            $data['re_consume'] = $_point['re_consume']+round(0.1*$get_money,2);
    	            $data['shengyu_dong'] = $_point['shengyu_dong'] - $get_money;
    	            
    	            //var_dump("money:".$get_money);
    	            
    	            $paramOBJ = new External();
    	            $shui_bl = $paramOBJ->getParam("tax_proportion", -1, $myids);
    	            $jijin_bl = $paramOBJ->getParam("foundation_proportion", -1, $myids);//cy_get_conf('bl_jijin');//1
    	            $shui = $this->_wei2($get_money * $shui_bl / 100);//保留两位小数，税
    	            $jijin = $this->_wei2($get_money * $jijin_bl / 100);//基金
    	            $produceCX = $this->_wei2($get_money*0.1); //重复消费分
    	            $ok_money = $this->_wei2($get_money - $shui-$jijin - $produceCX);//实际发放金额
    	            $data['bonus_point'] = $_point['bonus_point'] + $ok_money;
    	            $minfo = '实发（'.$ok_money.'）重消分（'.$produceCX.'）税收（'.$shui.'）基金（'.$jijin.'）。';
    	            $award_record = new Award_record();
    	            //$_res_award_record = $award_record->AwardRecordInsert($myids, "平衡奖", $get_money, $myids, $minfo);
    	            
    	            $user_point->PointUpdate($inUserID, -1, $data['bonus_point'], -1, $data['re_consume'], -1, -1, -1, -1, -1, $data['shengyu_dong']);
    	        }
    	        //$this->query("UPDATE __TABLE__ SET `sq_lds`={$ls},`sq_rds`={$rs},`bq_lds`=0,`bq_rds`=0 WHERE `id`=".$myids);//数据库更新左右区单数
    	        $position->updateJiangjin($vo['ID'], -1, -1, -1, -1, -1, -1, -1, -1, -1, $ls, -1, -1, $rs, -1);
    	        if ($get_money > 0) {
    	            //var_dump("inbonus Awardopt.php line:".__LINE__);
    	            $this->_in_bonus($myids, $inUserID, 2, $get_money);// 参数3等于2表示添加平衡奖，只有平衡对于积分的修改在in_bonus内部，其他的都在外面
    	            
    	            //辅导奖
    	            //$this->guanli_jj($vo['user_id'], $vo['re_path'], $vo['re_level'], $get_money);
    	            $detailsOBJ = new User_details();
    	            $_resDetails = $detailsOBJ->DetailsQuery($vo["user_id"]);
    	            $_resDetails = $_resDetails[0];
    	            $this->tutorAward($vo['user_id'], $_resDetails['repath'], $_resDetails["recommandlevel"]/*$vo['re_level']*/, $get_money,$ft);
    	            
    	            //感恩奖
    	            //var_dump("Awardopt line:".__LINE__."id:".$vo['user_id']);
    	            $ganenForthanks = $position->getUserIdByID($vo['ganen_next_id']);
    	            if(count($ganenForthanks) < 1)
    	                $ganenForthanks = 0;
    	            
    	            $ganenRidForthanks = $position->getUserIdByID($vo['ganen_next_r_id']);
    	            if(count($ganenRidForthanks) < 1)
    	                $ganenRidForthanks = 0;
    	            
                    //var_dump("ganenid:".$ganenForthanks);
                    //var_dump("ganen_r_id:".$ganenRidForthanks);
    	            $this->thanksAward($ganenForthanks,$ganenRidForthanks,$vo['user_id'],$get_money);
    	        }
    	    }
	    }

	    
	}
	
	//处理奖金记录
	//参数1表示谁拿奖金，参数2表示谁注册之后产生了奖金，参数3表示是哪种奖，参数4是奖金数量，
	public function _in_bonus($myids, $fuserid, $bkey, $get_money, $btime = 0, $minfo = '') {
	    $qibonus = new Award_daytime();//M('qibonus');//人每天表
	    //$bid = $this->_get_bonus_id($myids);//获取id
	    //扣税处理
	    if($bkey == 5){ //静态奖金的处理，人每天表,只有万能分的人/每天表更新是在这里面
	        //$qibonus->query("update __TABLE__ set b0=b0+{$get_money},b{$bkey}=b{$bkey}+{$get_money},b6=b6,b7=b7,b8=b8 where id=".$bid);
	        //unset($qibonus);
	        $detailOBJ = new User_details();
	        $detailRES = $detailOBJ->DetailsQuery($myids);
	        $detailRES = $detailRES[0];
	        $dayID = $detailRES["AUTO_ID"];
	        $_res_qibonus = $qibonus->AwarddailyQuery($dayID);
	        
	        if(count($_res_qibonus) < 1)
	        {
	            $qibonus->AwarddailyInsert($dayID, 0, 0, 0, 0, $get_money);
	        }
            else
            {
                $_res_qibonus = $_res_qibonus[0];
    	        //var_dump("Qibonus".$_res_qibonus["direct"]);
    	        $qibonus->AwarddailyUpdate($dayID, -1, -1, -1, -1, -1, $_res_qibonus["sum"] + $get_money, -1, $_res_qibonus["bz0"]+$get_money);
            }

	        
	        //$data['sum_jj_jingtai'] = array('exp','sum_jj_jingtai+'.$get_money);
	        //$this->where('id='.$myids)->save($data);//静态奖的累积，一共拿了多少静态奖，不需要也可以
	         
	        //$minfo = '万能分（'.$get_money.'）。';
	        //$this->award_history($myids, $fuserid, $get_money, $bkey, $btime, $minfo);//奖金表，有一条奖金就插入一个，有一条就插入一个
	        //unset($data);
	         
	        //添加奖金纪录
	        $award_record = new Award_record();
	        $_res_award_record = $award_record->AwardRecordInsert($myids, "万能分", $get_money, $fuserid);
	        return ;
	    }else{
	        $shui_bl = 5;//cy_get_conf('bl_shui'); //5
	        $jijin_bl = 1;//cy_get_conf('bl_jijin');//1
	        $shui = $this->_wei2($get_money * $shui_bl / 100);//保留两位小数
	        $jijin = $this->_wei2($get_money * $jijin_bl / 100);
	        $produceCX = $this->_wei2($get_money*0.1);
	        $ok_money = $this->_wei2($get_money - $shui-$jijin - $produceCX);
	
	        //添加奖金表--人每天表--原先的代码也没有验证当前是否已经存在相应纪录，默认是已经存在了
	        /*
	         *   $bdata[1] = array('bz1', '奖励分');
	         $bdata[2] = array('bz2', '注册分');
	         $bdata[3] = array('bz3', '重复消费分');
	         $bdata[4] = array('bz4', '复投分');
	         $bdata[5] = array('bz5', '总股额');
	         $bdata[6] = array('bz6', '万能分');
	         */
	        //$qibonus->query("update __TABLE__ set b0=b0+{$ok_money},b{$bkey}=b{$bkey}+{$get_money},b6=b6+{$shui},b7=b7+{$jijin},b8=b8+{$produceCX} where id=".$myids);
	        //unset($qibonus);
	        
	        
		$_res_qibonus = $qibonus->AwarddailyQuery($myids);
	        /*//这里不需要这一步
		
	        
	        if(count($_res_qibonus) < 1) //如果当天记录不存在，则先插入一条记录，然后再在后面更新
	        {
	            $qibonus->AwarddailyInsert($myids);
	        }
	        */
	            
	        //$_res_qibonus = $_res_qibonus[0];
	        $awardType = array();
	        if($bkey == 1)
	        {
	            $_res_qibonus[0]["direct"] = $_res_qibonus[0]["direct"] + $get_money;
	            $awardType = "直推奖";
	        }
	        else 
	            $_res_qibonus[0]["direct"] = -1;
	        
            if($bkey == 2)
            {
                $_res_qibonus[0]["balance"] = $_res_qibonus[0]["balance"] + $get_money;
                $awardType = "平衡奖";
                //添加dp_leiji
                $pointOBJ = new User_point();
                $_resPoint = $pointOBJ->PointQuery($myids);
                $_resPoint = $_resPoint[0];
                $dp_leiji = $_resPoint["dp_leiji"] + $get_money;
                $pointOBJ->PointUpdate($myids, -1,-1,-1,-1,-1,-1,-1,-1,-1,-1,$dp_leiji);
            }
            else 
                $_res_qibonus[0]["balance"] = -1;
            
            if($bkey == 3)
            {
                $_res_qibonus[0]["tutor"] = $_res_qibonus[0]["tutor"] + $get_money;
                $awardType = "辅导奖";
            }
            else 
                $_res_qibonus[0]["tutor"] = -1;
            
            if($bkey == 4)
            {
                $_res_qibonus[0]["appreciation"] = $_res_qibonus[0]["appreciation"] + $get_money;
                $awardType = "感恩奖";
            }
            else 
                $_res_qibonus[0]["appreciation"] = -1;
            
            $qibonus->AwarddailyUpdate($myids, $_res_qibonus[0]["direct"], $_res_qibonus[0]["balance"], $_res_qibonus[0]["tutor"],
            $_res_qibonus[0]["appreciation"], $_res_qibonus[0]["staticbonus"], $_res_qibonus[0]["sum"] + $get_money, -1, $_res_qibonus[0]["bz0"]+$ok_money,
            $_res_qibonus[0]["bz6"]+$shui, $_res_qibonus[0]["bz7"]+$jijin, $_res_qibonus[0]["bz8"]+$produceCX);
             
            /*zly 这部分是针对对碰产生奖励的逻辑，这部分是更新整个产生对碰奖的一系列的用户
             $data = array();
             $data['bz1'] = array('exp', 'bz1+'.$ok_money);
             $data['sum_jj'] = array('exp', 'sum_jj+'.$ok_money);
             if ($bkey == 2) {
             $data['dp_leiji'] = array('exp', 'dp_leiji+'.$get_money);
             }
             $this->where('id='.$myids)->save($data);
             */
             
            //添加奖金记录
            $minfo = '实发（'.$ok_money.'）重消分（'.$produceCX.'）税收（'.$shui.'）基金（'.$jijin.'）。';
            $award_record = new Award_record();
            //var_dump("Awardopt.php line:".__LINE__."myids:".$myids);
	        $_res_award_record = $award_record->AwardRecordInsert($myids, $awardType, $get_money, $fuserid, $minfo);
	    }
	
	}
	
	//取小数点2位数
	public function _wei2($money = 0)
	{
	    return sprintf('%.2f', (float)$money);
	}
	
	//对碰1：1
	public function touch1to1(&$Encash,$xL=0,$xR=0,&$NumS=0){   //   ,左区单数，右区单数，之前对碰总额
	    //changed by Gavin start model11
	    $Encash['0'] = 0;
	    $Encash['1'] = 0;
	    //changed by Gavin end model11
	    if ($xL > 0 && $xR > 0){
	        if ($xL > $xR){
	            $NumS = $xR;
	            $xL = $xL - $NumS;
	            $xR = $xR - $NumS;
	            $Encash['0'] = $Encash['0'] + $NumS;
	            $Encash['1'] = $Encash['1'] + $NumS;
	        }
	        if ($xL < $xR){
	            $NumS = $xL;
	            $xL   = $xL - $NumS;
	            $xR   = $xR - $NumS;
	            $Encash['0'] = $Encash['0'] + $NumS;
	            $Encash['1'] = $Encash['1'] + $NumS;
	        }
	        if ($xL == $xR){
	            $NumS = $xL;
	            $xL   = 0;
	            $xR   = 0;
	            $Encash['0'] = $Encash['0'] + $NumS;
	            $Encash['1'] = $Encash['1'] + $NumS;
	        }
	        $Encash['2'] = $NumS;
	    }else{
	        $NumS = 0;
	        $Encash['0'] = 0;
	        $Encash['1'] = 0;
	    }
	    //var_dump($Encash);
	    //var_dump("nums:".$NumS);
	    //var_dump("xl:".$xL."xR:".$xR);
	}
	
	//封顶
	protected function _fengding($money, $ft_money, $sum_money) { //获得的钱，封顶奖金额度，之前的总和
	    if ($ft_money > 0) {
	        if (($sum_money + $money) > $ft_money) {
	            $money = $ft_money - $sum_money;
	        }
	    }
	    return ($money > 0)? $money : 0;
	}

}
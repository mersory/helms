<?php
namespace app\trigger\controller;

use think\Controller;
use app\common\model\User_point;
use app\common\model\User_details;
use app\trigger\controller\External;
use app\common\model\Positionality;
use app\common\model\Award_daytime;

class Awardopt extends Controller
{
    public function index()
    {
        echo "class Trigger index";
    }
    
    public function zhitui_jj($inUserID, $re_id, $reg_money) 
    {
        echo "推荐奖";
        $user = new User_point();
        $res = $user->PointQuery($re_id);
        $res = $res[0];
        if($res["regist_point"] > 0)//当前拿奖的人必须是开通的，必须要两个表
        {
            // get user level
            $user_details = new User_details();
            $res_details = $user_details->DetailsQuery($re_id);
            $user_level =$res_details[0]["user_level"];
            echo $user_level;
            //get recommend-award percents
            $extern =new External();
            $user_percent = $extern->getRecommendPercent($user_level);
            echo $user_percent;
            //calculate real money as awards
            $get_money = $reg_money * $user_percent / 100;
            $get_money = ($res["shengyu_dong"] - $get_money)<0 ? $res['shengyu_dong']:$get_money;
            //update relative data to database
            if ($get_money > 0) {
                //$this->_in_bonus($vo['id'], $inUserID, 1, $get_money);   //！！！！！！！奖金处理需要更改
                $state = $user->PointUpdate($re_id, $res["shares"], $res["bonus_point"]+$get_money, $res["regist_point"], $res["re_consume"], 
                                $res["universal_point"], $res["re_cast"], $res["remain_point"]-$get_money, $res["blocked_point"]);
                if($state)
                    echo "update success";
            }
        }
    }
    
    //辅导奖
    public function tutorAward($inUserID, $re_path="", $re_level=1, $jj_money=0, $ft=0)
    {
        echo "tutorAward";
        $jj = 0.05;//cy_get_conf('s5'); //5|5|5|5|5|5 %
        $dai = 2;//cy_get_conf('s6');	//1|2|2|3|4|5　代，a推荐b，b推荐c，c产生对碰奖，且代为2，则a和b都拿辅导奖，且基数为5%
        //$limit = max($dai);
        $_points =new User_point();
        $position = new Positionality();
        $_dayly_point = new Award_daytime();
        $_res= $position->PositionQuery($inUserID);
        var_dump($_res[0]['json']);
        for($i=0; $i<strlen($_res[0]['json'])/$_res[0]['json'][0]&&$i<9; $i++)
        {
           echo "tttttttttttttttt";
           $_userid= $position->getUserIdByID($_res[0]['json'][$i]) ;
           $i++;
           var_dump($_userid);
           $_pointsRes = $_points->PointQuery($_userid);
           $get_money = 10;
           $get_money = ($_pointsRes[0]['remain_point'] - $get_money)<0 ? $_pointsRes[0]['remain_point']:$get_money;
           echo "money:";
           var_dump($_pointsRes[0]['bonus_point']);
           //update the user points table
           $_res_points_set = $_points->PointUpdate($_userid, $_pointsRes[0]['shares'], $_pointsRes[0]['bonus_point'] + $get_money, $_pointsRes[0]['regist_point'], $_pointsRes[0]['re_consume'], 
                                $_pointsRes[0]['universal_point'], $_pointsRes[0]['re_cast'], $_pointsRes[0]['remain_point'] - $get_money);
           if($_res_points_set)
           {
               var_dump("point update success");
           }
           else 
               var_dump("point update failed");
           //update the user daily points records table
           $_res_point_dayly = $_dayly_point->AwarddailyQuery($_userid);
           if(sizeof($_res_point_dayly) > 0)
           {
               $res = $_dayly_point->AwarddailyUpdate($_userid, $_res_point_dayly[0]['direct'], $_res_point_dayly[0]['balance'], $_res_point_dayly[0]['tutor']+$get_money, $_res_point_dayly[0]['appreciation']
                   , $_res_point_dayly[0]['staticbonus'], $_res_point_dayly[0]['sum'], $_res_point_dayly[0]['actualsalary']);
               if($res)
               {
                   var_dump("Awarddaily update success");
               }
               else 
                   var_dump("Awarddaily update failed");
           }
           else 
           {
               var_dump("insert daily points");
               $res = $_dayly_point->AwarddailyInsert($_userid, -1, -1, $get_money);
               if($res)
               {
                   var_dump("Awarddaily insert success");
               }
               else
                   var_dump("Awarddaily insert failed");
           }
              
        }
        
        /*$map = array();
        $map['id'] = array('in', '0'.$re_path.'0');
        $map['is_pay'] = array('gt', 0);
        //$fields = 'id,user_id,u_level,re_level'; //会员ID，用户名，用户等级，推荐等级（推荐级数）
        $fields = 'id,user_id,u_level,re_level,dp_leiji,shengyu_dong,bz3'; //会员ID，用户名，用户等级，推荐等级（推荐级数）
        $frs = $this->where($map)->field($fields)->order('re_level DESC')->limit($limit)->select();  //只显示最多5个，即5代人
        foreach ($frs as $vo) {
            $get_money = 0;
            $myl = $re_level - $vo['re_level']; //相对推荐级数
            $ss = $vo['u_level'] - 1;
            if ($myl <= $dai[$ss]) {
                $get_money = $jj_money * $jj[$ss] / 100;
            }
            $get_money = ($vo['shengyu_dong'] - $get_money)<0 ? $vo['shengyu_dong']:$get_money;
            if ($get_money > 0) {
                $this->_in_bonus($vo['id'], $inUserID, 3, $get_money);
                $data = array();
                $data['bz3'] = $vo['bz3']+round(0.1*$get_money,2);
                $data['shengyu_dong'] = $vo['shengyu_dong'] - $get_money;
                $map = array();
                $map['id']=$vo['id'];
                $this->where($map)->save($data);
                unset($data);
                unset($map);
            }
        }*/
    }
    
    //感恩奖，参数1是左区感恩者，参数2右区感恩者，产生感恩奖的id，平衡奖金
    public function thanksAward($ganen_id,$ganen_r_id,$inUserID,$pingheng_money)
    {
        $_points =new User_point();
        $position = new Positionality();
        $_dayly_point = new Award_daytime();
        $_res= $position->PositionQuery($inUserID);
        var_dump($_res[0]['json']);
        if($ganen_id){
            $ganen_bili = 0.05;//cy_get_conf('s7');   //5%
            $map['id'] = $ganen_id;
            echo "point search:";
            $_pointsRes = $_points->PointQuery($ganen_id);
            $get_money = 15;
            $get_money = ($_pointsRes[0]['remain_point'] - $get_money)<0 ? $_pointsRes[0]['remain_point']:$get_money;
            var_dump($get_money);
            if($get_money > 0){
                $_res_points_set = $_points->PointUpdate($ganen_id, $_pointsRes[0]['shares'], $_pointsRes[0]['bonus_point'] + $get_money, $_pointsRes[0]['regist_point'], $_pointsRes[0]['re_consume'], 
                                $_pointsRes[0]['universal_point'], $_pointsRes[0]['re_cast'], $_pointsRes[0]['remain_point'] - $get_money);
                $_res_point_dayly = $_dayly_point->AwarddailyQuery($ganen_id);
                if(sizeof($_res_point_dayly) > 0)
                {
                   var_dump("ganen_id update daily points");
                   $_dayly_point->AwarddailyUpdate($ganen_id, $_res_point_dayly[0]['direct'], $_res_point_dayly[0]['balance']+$get_money,  $_res_point_dayly[0]['tutor'], $_res_point_dayly[0]['staticbonus'], $_res_point_dayly[0]['sum'], $_res_point_dayly[0]['actualsalary']);
                    
                }
                else 
                {
                   var_dump("ganen_id insert daily points");
                   $_dayly_point->AwarddailyInsert($ganen_id, 0, $get_money);
                }
            }
        }
        if($ganen_r_id){
            $ganen_bili = 0.05;//cy_get_conf('s7');   //5%

            $_pointsRes = $_points->PointQuery($ganen_r_id);
            $get_money = 15;
            $get_money = ($_pointsRes[0]['remain_point'] - $get_money)<0 ? $_pointsRes[0]['remain_point']:$get_money;
            var_dump($get_money);
            if($get_money > 0){
                $_res_points_set = $_points->PointUpdate($ganen_r_id, $_pointsRes[0]['shares'], $_pointsRes[0]['bonus_point'] + $get_money, $_pointsRes[0]['regist_point'], $_pointsRes[0]['re_consume'], 
                                $_pointsRes[0]['universal_point'], $_pointsRes[0]['re_cast'], $_pointsRes[0]['remain_point'] - $get_money);
                $_res_point_dayly = $_dayly_point->AwarddailyQuery($ganen_r_id);
                if(sizeof($_res_point_dayly) > 0)
                {
                   var_dump("ganen_r_id update daily points");
                   $_dayly_point->AwarddailyUpdate($ganen_r_id, $_res_point_dayly[0]['direct'], $_res_point_dayly[0]['balance'] + $get_money,  $_res_point_dayly[0]['tutor'], $_res_point_dayly[0]['staticbonus'], $_res_point_dayly[0]['sum'], $_res_point_dayly[0]['actualsalary']);
                    
                }
                else 
                {
                   var_dump("ganen_r_id insert daily points");
                   $_dayly_point->AwarddailyInsert($ganen_r_id, 0, $get_money);
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
	    $position = new Positionality();
	    for($i=strlen($p_path)-3; $i>-1; $i--)
	    {
	        $ID = $p_path[$i];
	        $curNode = $position->PositionQueryByID($ID);
	        $tpl = $curNode[0]['treeplace'];
	        $data = array();
	        $data['sum_ds'] = $curNode[0]['sum_ds'] + $danshu;
	        if ($tpl == 0) {
	            $data['l_ds'] = $curNode[0]['l_ds'] + $danshu;
	            $data['bq_lds'] = $curNode[0]['bq_lds'] + $danshu;
	            $position->updateJiangjin($ID, -1,$data['l_ds'],$data['bq_lds'],-1,-1,-1,-1,-1,-1,-1,-1,$data['sum_ds']);
	    
	            //平衡奖总额对碰，增加对碰额
	            /* $data['l_dse'] = array('exp','l_dse+'.$reg_money);
	             $data['bq_lds'] = array('exp', 'bq_ldse+'.$reg_money); */
	        } elseif ($tpl == 1) {
	            $data['r_ds'] = $curNode[0]['r_ds'] + $danshu;
	            $data['bq_rds'] = $curNode[0]['bq_rds'] + $danshu;
	            $position->updateJiangjin($ID, -1,-1,-1,$data['r_ds'],$data['bq_rds'],-1,-1,-1,-1,-1,-1, $data['sum_ds']);
	    
	            /* $data['r_dse'] = array('exp','r_dse+'.$reg_money);
	             $data['bq_rdse'] = array('exp','bq_rdse+'.$reg_money); */
	        }
	        //$this->where('id='.$curNode[0]['id'])->save($data);
	        //unset($data);
	        $i--;
	    }
		
	}
	
	//虚的统计--修改之后      tree2ds_x_tongji
	public function tree2ds_x_tongji($p_path, $tpl, $danshu = 1) {
	     
	    $position = new Positionality();
	    for($i=strlen($p_path)-3; $i>-1; $i--)
	    {
	        $ID = $p_path[$i];
	        $curNode = $position->PositionQueryByID($ID);
	        $data = array();
	        $tpl = $curNode[0]['treeplace'];
	        if ($tpl == 0) {
	            $data['l_x_ds'] = $curNode[0]['l_x_ds'] + $danshu;
	            $data['bq_x_lds'] = $curNode[0]['bq_x_lds'] + $danshu;
	            $position->updateJiangjin($ID, -1,-1,-1,-1,-1,$data['l_x_ds'],$data['bq_x_lds'],-1,-1,-1,-1);
	             
	            //平衡奖总额对碰，增加对碰额
	            /* $data['l_dse'] = array('exp','l_dse+'.$reg_money);
	             $data['bq_lds'] = array('exp', 'bq_ldse+'.$reg_money); */
	        } elseif ($tpl == 1) {
	            $data['r_x_ds'] = $curNode[0]['r_x_ds'] + $danshu;
	            $data['bq_x_rds'] = $curNode[0]['bq_x_rds'] + $danshu;
	            $position->updateJiangjin($ID, -1,-1,-1,-1,-1,-1,-1,-1,$data['r_x_ds'],$data['bq_x_rds'],-1);
	             
	            /* $data['r_dse'] = array('exp','r_dse+'.$reg_money);
	             $data['bq_rdse'] = array('exp','bq_rdse+'.$reg_money); */
	        }
	        //$this->where('id='.$curNode[0]['id'])->save($data);
	        //unset($data);
	        $i--;
	    }
	}
	
    //奖金统计 
	public function bonus_tongji($uid,  $is_agent = 0) {    //做修改
		set_time_limit(0);
		$position = new Positionality();
		$details = new User_details();
		$_res = $position->PositionQuery($uid);
		$_recommand = $details->DetailsQuery($uid);
		//用户ID，用户名，用户等级，是否开通，开通排序，网络结构父ID，网络结构路径，网络结构等级，推荐人ID，推荐路径、推荐等级、投资金额，所属报单中心ID，开通的会员ID
		$vo = $_res[0];
		if ($vo) 
		{
		    if($is_agent == 0){
		        $this->zhitui_jj($vo['user_id'], $_recommand[0]['activator'], $vo['status']*500);
		        $this->duipeng();
		    }else{
		        $this->zhitui_jj($vo['user_id'],$_recommand[0]['activator'],$vo['reg_money']);
		        $this->futou_duipeng();
		    }
		}
	}
	
	//对碰奖 b2   平衡奖
	public function duipeng() {
	    $position = new Positionality();
        $position->updateDuipeng();//重置当天的对碰奖累积值
	    $jj = 7;//cy_get_conf('s4'); 	//7|8|9|10|11  %
	    $ft = 500;//cy_get_conf('ft01');	//100|500|1000|3000|5000|10000  封顶额 美元
	
	    $bb_list = 500;//_get_conf('bb_list', 1);     //投资金额
	    $ds_list = 1;//_get_conf('ds_list', 1);     //投资单数
	    $dsmoney = 500;//$bb_list[1] / $ds_list[1]; //200    每一单价格
	
	    //$where = 'is_pay>0  AND ((bq_lds)>0 OR (bq_rds)>0)';     //上期左区单数+本期左区单数     上期右区单数+本期右区单数
	    //$fields = 'id,user_id,u_level,sq_lds,bq_lds,sq_rds,bq_rds,dp_leiji,re_path,re_level,shengyu_dong,bz3,ganen_next_id,ganen_next_r_id';
	    //会员ID，用户名，开通排序，推荐人ID，用户等级，上期左区单数，本期左区单数，上期右区单数，本期右区单数，对碰业绩累积，推荐路径，推荐人等级，
	    //$frs = $this->where($where)->field($fields)->select();
	    $_res = $position->getDuiPengInfo(1);
	    foreach ($_res as $vo) {
	        /*if($vo['is_lock'] != 0){
	            continue;
	        }*/
	        $myids = $vo['ID'];
	        $inUserID = $vo['user_id'];
	        $l = $r = 0;
	        $l = $vo['sq_lds'] + $vo['bq_lds'];     //左区单数
	        $r = $vo['sq_rds'] + $vo['bq_rds'];     //右区单数
	        $encash = array();
	        $nums = $money = $ls = $rs = 0;
	        $this->touch1to1($encash, $l, $r, $nums);
	        $ls = $l - $encash[0];   //左区剩余单数
	        $rs = $r - $encash[1];   //右区剩余单数
	        $ss = $vo['status'];
	
	        $get_money = $dsmoney * $jj[$ss] / 100 * $nums;    //$nums为对碰单数
	        	
	        $user_point = new User_point();
	        $_point = $user_point->PointQuery($inUserID);
	        $_point = $_point[0];
	        if ($ft*$ss > 0) {
	            $get_money = $this->_fengding($get_money, $ft*$ss, $vo['dp_leiji']); //!!!!!!需要修改，加入日期，如果到封顶，则不增加
	            $get_money = ($_point['shengyu_dong'] - $get_money)<0 ? $_point['shengyu_dong']:$get_money;
	            $data = array();
	            //$data['bz3'] = $_point['bz3']+round(0.1*$get_money,2);
	            $data['re_consume'] = $_point['re_consume']+round(0.1*$get_money,2);
	            $data['shengyu_dong'] = $_point['shengyu_dong'] - $get_money;
	            $map = array();
	            $map['ID']=$vo['ID'];
	            $user_point->PointUpdate($inUserID, -1, -1, -1, $data['re_consume'], -1, -1, -1, -1, -1, $data['shengyu_dong']);
	        }
	        //$this->query("UPDATE __TABLE__ SET `sq_lds`={$ls},`sq_rds`={$rs},`bq_lds`=0,`bq_rds`=0 WHERE `id`=".$myids);//数据库更新左右区单数
	        $position->updateJiangjin($vo['ID'], -1, -1, -1, $ls, -1, -1, $rs, -1, -1, -1, -1, -1, -1, -1);
	        if ($get_money > 0) {
	            $this->_in_bonus($myids, $inUserID, 2, $get_money);
	            //辅导奖
	            //$this->guanli_jj($vo['user_id'], $vo['re_path'], $vo['re_level'], $get_money);
	            $this->tutorAward($vo['user_id'], $vo['re_path'], $vo['re_level'], $get_money,$ft);
	            //感恩奖
	            $this->thanksAward($vo['ganen_next_id'],$vo['ganen_next_r_id'],$vo['user_id'],$get_money);
	        }
	    }

	}
	
	//对碰奖 b2   平衡奖
	public function futou_duipeng() {
	    $position = new Positionality();
	    $position->updateDuipeng();//重置当天的对碰奖累积值
	    $jj = 7;//cy_get_conf('s4'); 	//7|8|9|10|11  %
	    $ft = 500;//cy_get_conf('ft01');	//100|500|1000|3000|5000|10000  封顶额 美元
	
	    $bb_list = 500;//_get_conf('bb_list', 1);     //投资金额
	    $ds_list = 1;//_get_conf('ds_list', 1);     //投资单数
	    $dsmoney = 500;//$bb_list[1] / $ds_list[1]; //200    每一单价格
	
	    //$where = 'is_pay>0  AND ((bq_lds)>0 OR (bq_rds)>0)';     //上期左区单数+本期左区单数     上期右区单数+本期右区单数
	    //$fields = 'id,user_id,u_level,sq_lds,bq_lds,sq_rds,bq_rds,dp_leiji,re_path,re_level,shengyu_dong,bz3,ganen_next_id,ganen_next_r_id';
	    //会员ID，用户名，开通排序，推荐人ID，用户等级，上期左区单数，本期左区单数，上期右区单数，本期右区单数，对碰业绩累积，推荐路径，推荐人等级，
	    //$frs = $this->where($where)->field($fields)->select();
	    $_res = $position->getDuiPengInfo(0);
	    foreach ($_res as $vo) {
	        /*if($vo['is_lock'] != 0){
	         continue;
	         }*/
	        $myids = $vo['ID'];
	        $inUserID = $vo['user_id'];
            $l = $vo['sq_lds']+$vo['sq_x_lds'] + $vo['bq_x_lds'];     //左区虚单数
			$r = $vo['sq_rds']+$vo['sq_x_rds'] + $vo['bq_x_rds'];     //右区虚单数
	        $encash = array();
	        $nums = $money = $ls = $rs = 0;
	        $this->touch1to1($encash, $l, $r, $nums);
	        $ls = $l - $encash[0]-$vo['sq_lds'];   //左区剩余单数
	        $rs = $r - $encash[1]-$vo['sq_rds'];   //右区剩余单数
	        $ss = $vo['status'];
	
	        $get_money = $dsmoney * $jj[$ss] / 100 * $nums;    //$nums为对碰单数
	
	        $user_point = new User_point();
	        $_point = $user_point->PointQuery($inUserID);
	        $_point = $_point[0];
	        if ($ft*$ss > 0) {
	            $get_money = $this->_fengding($get_money, $ft*$ss, $vo['dp_leiji']); //!!!!!!需要修改，加入日期，如果到封顶，则不增加
	            $get_money = ($_point['shengyu_dong'] - $get_money)<0 ? $_point['shengyu_dong']:$get_money;
	            $data = array();
	            //$data['bz3'] = $_point['bz3']+round(0.1*$get_money,2);
	            $data['re_consume'] = $_point['re_consume']+round(0.1*$get_money,2);
	            $data['shengyu_dong'] = $_point['shengyu_dong'] - $get_money;
	            $map = array();
	            $map['ID']=$vo['ID'];
	            $user_point->PointUpdate($inUserID, -1, -1, -1, $data['re_consume'], -1, -1, -1, -1, -1, $data['shengyu_dong']);
	        }
	        //$this->query("UPDATE __TABLE__ SET `sq_lds`={$ls},`sq_rds`={$rs},`bq_lds`=0,`bq_rds`=0 WHERE `id`=".$myids);//数据库更新左右区单数
	        $position->updateJiangjin($vo['ID'], -1, -1, -1, -1, -1, -1, -1, -1, -1, $ls, -1, -1, $rs, -1);
	        if ($get_money > 0) {
	            $this->_in_bonus($myids, $inUserID, 2, $get_money);
	            //辅导奖
	            //$this->guanli_jj($vo['user_id'], $vo['re_path'], $vo['re_level'], $get_money);
	            $this->tutorAward($vo['user_id'], $vo['re_path'], $vo['re_level'], $get_money,$ft);
	            //感恩奖
	            $this->thanksAward($vo['ganen_next_id'],$vo['ganen_next_r_id'],$vo['user_id'],$get_money);
	        }
	    }
	    
	}
	
	//处理奖金记录
	//参数1表示谁拿奖金，参数2表示谁注册之后产生了奖金，参数3表示是哪种奖，参数4是奖金数量，
	public function _in_bonus($myids, $fuserid, $bkey, $get_money, $btime = 0, $minfo = '') {
	    $qibonus = new Award_daytime();//M('qibonus');//人每天表
	    //$bid = $this->_get_bonus_id($myids);//获取id
	    //扣税处理
	    if($bkey == 5){                                                             //静态奖金的处理，人每天表
	        //$qibonus->query("update __TABLE__ set b0=b0+{$get_money},b{$bkey}=b{$bkey}+{$get_money},b6=b6,b7=b7,b8=b8 where id=".$bid);
	        //unset($qibonus);
	        $_res_qibonus = $qibonus->AwarddailyQuery($myids);
	        $_res_qibonus = $_res_qibonus[0];
	        $qibonus->AwarddailyUpdate($myids, -1, -1, -1, -1, -1, $_res_qibonus["sum"] + $get_money, -1, $_res_qibonus["bz0"]+$get_money);
	        //$data['sum_jj_jingtai'] = array('exp','sum_jj_jingtai+'.$get_money);
	        //$this->where('id='.$myids)->save($data);//静态奖的累积，一共拿了多少静态奖，不需要也可以
	         
	        //$minfo = '万能分（'.$get_money.'）。';
	        //$this->award_history($myids, $fuserid, $get_money, $bkey, $btime, $minfo);//奖金表，有一条奖金就插入一个，有一条就插入一个
	        //unset($data);
	         
	        //添加奖金纪录
	        $_res_award_record = $this->AwardRecordInsert($myids, "万能奖", $get_money, $fuserid);
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
	        $_res_qibonus = $_res_qibonus[0];
	        if($bkey == 1)
	            $_res_qibonus[0]["direct"] = $_res_qibonus[0]["direct"] + $get_money;
            if($bkey == 2)
                $_res_qibonus[0]["balance"] = $_res_qibonus[0]["balance"] + $get_money;
            if($bkey == 3)
                $_res_qibonus[0]["tutor"] = $_res_qibonus[0]["tutor"] + $get_money;
            if($bkey == 4)
                $_res_qibonus[0]["appreciation"] = $_res_qibonus[0]["appreciation"] + $get_money;
            if($bkey == 6)
                $_res_qibonus[0]["staticbonus"] = $_res_qibonus[0]["staticbonus"] + $get_money;
                 
            $qibonus->AwarddailyUpdate($myids, $_res_qibonus[0]["direct"], $_res_qibonus[0]["balance"], $_res_qibonus[0]["tutor"],
                $_res_qibonus[0]["appreciation"], $_res_qibonus[0]["staticbonus"], $_res_qibonus["sum"] + $get_money, -1, $_res_qibonus["bz0"]+$ok_money,
                $_res_qibonus["bz6"]+$shui, $_res_qibonus["bz7"]+$jijin, $_res_qibonus["bz8"]+$produceCX);
             
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
            $this->AwardRecordInsert($myids, "重复消费分", $get_money, $fuserid, $minfo);
            //$this->award_history($myids, $fuserid, $get_money, $bkey, $btime, $minfo);//$fuserid，拿了谁的奖，对碰和静态都是自己的，辅导就是被辅导的那个人，
            //if ($shui > 0) {
            //	$this->award_history($myids, $fuserid, $shui, 6, $btime);
            //}
	    }
	
	}
	
	//取小数点2位数
	protected function _wei2($money = 0)
	{
	    return sprintf('%.2f', (float)$money);
	}
	
	//对碰1：1
	public function touch1to1(&$Encash,$xL=0,$xR=0,&$NumS=0){   //   ,左区单数，右区单数，之前对碰总额
	    /* $xL = floor($xL);
	     $xR = floor($xR);  */
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
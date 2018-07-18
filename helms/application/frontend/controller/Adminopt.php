<?php
namespace app\frontend\controller;

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
use app\common\model\Recharge_record;
use app\common\model\Userupgrade_record;

class Adminopt extends Basecontroller
{
    public function index()
    {
        $member = new Positionality();

        $ress = $member->updateGushuByArray(0,1);

        var_dump("ress:".$ress);
        /*
        $str = "hello";
        $str = substr($str, 0, strlen($str)-1);
        var_dump($str);
        var_dump(strlen($str));
        $positionobj = new Positionality();
        $str = ',1,';
        $level = 0;
        $_res = array();
        $positionobj->getAllChildByJsonWithInFiveLevel($str, $level, $_res);
        //$_res = $positionobj->getDirectChildrenByJson("2");
        var_dump($_res);
        
        $extern = new External();
        $pwd = "140416";
        $passwd = md5($pwd."hermes");   //这个才是最后使用的家吗函数
        var_dump("pass:".$passwd);
        
     
        $recharge = new Recharge_record();
        $recharge->index();
        $state = $recharge->RechargeInsert(H7414916900,1000.00,0,"后台充值", 1,"许丽娟","本部张海龙充值注册分,已确认",1);
        $recharge->RechargeQuery();
        var_dump($recharge);
        $extern = new External();
        $po = $extern->cy_decode("dd4d8b570a4169792a513792ae24ea56", "hermes");
        $pp = md5("dd4d8b570a4169792a513792ae24ea56", "hermes");
        echo($pp);
        
        $user = new User_details();
        $res= $user->RecommanderQuery("H6395385700");
        return json_encode($res);
        */
        //$userinfo = new User_info();
        ////var_dump("user state: ".$userinfo->getUserstate("H1400517071"));
        /*$awardOBJ = new Awardopt();
        $awardOBJ->tutorAward("H1168190890", $re_path="1", $re_level=1, 35, $ft=0);
        return;
        $awardOBJ->duipeng();
        
        $positionobj = new Positionality();
        $positionobj->updateGanenInfo(11);
        
        $extern = new External();
        $po = $extern->cy_encode("140416");
        
        $passwd = md5("140416hermes");
        //var_dump("encode pwd:".$passwd);
        //var_dump("end");
        
        $ec = new External();
        $res= $ec->getParam("dynamic_max", $level=4, "H1000050056");
        //var_dump("param now:".$res);
        
        $str = "1,2,3";
        $strArr =  explode(",",$str);  //获取推荐等级
        //var_dump($strArr);
        //var_dump("数组长度：".count($strArr));
        $_detail_info = new User_details();

            $_detail_info_res = $_detail_info->where('AUTO_ID ','in',$strArr)
            ->setInc('repath_ds',2);

        //echo "class Adminopt index";
        //$posi = new Positionality();
        //$posi->updateGushu(3, -1, 0, -1);
        $strSRC="121-421-5-12";
        $pos = strrpos($strSRC,'-');
        //var_dump("pos:".$pos);
        $strSRC = substr($strSRC,0, $pos);
        //var_dump("strSRC:".$strSRC);
        while ( $pos != false ){            
            $pos = strrpos($strSRC,'-');
            if($pos == false)
                $tmp = $strSRC;
            else
                $tmp = substr($strSRC, $pos+1, strlen($strSRC));
            $strSRC = substr($strSRC,0, $pos);
            //var_dump("  |  ");
            //echo $tmp;
        }*/
        
        //$position  = new Positionality();
        //$position->updateGanenInfo(21);
        //$position->PositionInsertPrev("H5579859714",5);
        /*$award = new Awardopt();
        $award->index();
        $userpoint = new User_point();
        $userpoint->pointTransfor("H2568023600", 1, 2, 100);*/
        //$award->tree2ds_tongji("1-2-3-4", 0);
        //$award->tree2ds_x_tongji("1-2-3-6-7", 0);
        //$userdetails = new User_details();
        //$ntime = date("Y-m-d H:i:s");
        //$state = $userdetails->DetailsUpdate(100042, -1, -1, -1, -1, $ntime, -1, -1, -1);
        //$point = new User_point();
        //$point->PointQuery(100042);
        //$award->thanksAward(100042, 100005, 100044, 50);
        //$award->tutorAward(100042);
        /*$user = new User_info();
        //echo $user->isUserExist("100045");
        $extern = new External();
        $extern->index();
        //echo $extern->_auto_userid();
        $award->tutorAward("100044");
        
        $position->updateGanenInfo(5);
        $detail=new User_details();
        $detail->increasReNum(100041, 1);
        $detail->increasRePathDS(100042, 2);
        $recommonder = 100050;
        while($recommonder != 0)
        {
            $detail->increasRePathDS($recommonder, 1);
            $detailinfo = $detail->DetailsQueryByAutoId($recommonder);
            $recommonder = $detailinfo[0]["recommender"];
        }
        $gp = new Gp_set();
        $gp->index();
        $gpset = $gp->GpSetQuery();
        $gp->GpSetUpdate(3, 3.232, -1, 1);
        $gpset = $gp->GpSetQuery();
        $gp = new Gp_onsale();
        $gp->index();
        $gp->GponsaleChangeStatus(2);
        $gp->GponsaleInsert(3.23, 200, 150, 3230, 2, 770);
        $gp->GponsaleUpdate(1,2.23, 100, 100, -1, 1, -1);
        $position = new Positionality();
        $res=$position->getAllLegUser();
        foreach ($res as $vo)
            //var_dump($vo["ID"]);
        $position = new Positionality();
        $res = $position->getDirectChildrenByJson(3);
        //var_dump($res);
        $gp = new Gp_onsale();
        $gp->GponsaleInsert(1, 40000, 500, 500, 1, -1);*/
        
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
    
    //开通会员过程处理2018-02-28
    //参数1是将要开通的userid，参数2是登录的那个人的userid，开通等级
    //本函数被audit_member_open函数调用，在开通过程中，需要本函数处理一些事情，然后会能够顺利完成audit_member_open函数的整个逻辑
    public function _member_open($uid, $openid = 0, $lv)  
    {
        $member = new Positionality();//M('member');
        //var_dump("_member_open");
        $today = strtotime(date('Y-m-d'));
        $next_time = $today + 86403;
        $ntime = date("Y-m-d H:i:s");
        $rm = 500;//_get_conf('bb_list', 1);//当前等级所需要的注册资金
        $ds = 1;//_get_conf('ds_list', 1);//这个等级对应的几单。
        $bb = 500;//$rm[$lv];
        $ds = 1;//$ds[$lv];
        $bz5_bl = 0.05;//_get_conf('s1', 1);//s1是指配股比例
        $bz3_al = 1;//_get_conf('s2', 1);//s2是指,5.9号讨论可删除
        
        ////////////////////////////////////////////////////////////////
        //标记感恩奖的ganen_id与ganen_next_id和ganen_next_r_id(新算法)
        ////////////////////////////////////////////////////////////////
        //id就是序号id，不是userid，parent_id是父节点的序号id，reg_money注册资金，treeplace如果是在父节点的左边就是0，反之为1，用户等级
        //var_dump($uid);
        $new_node = $member->PositionQuery($uid);//$member->where('id='.$uid)->field('id,parent_id,reg_money,treeplace,u_level')->find();
        //var_dump('debug : Adminopt.php on line:'.__LINE__);
        //var_dump($new_node[0]['user_id']);
        $state = 1;
        if($new_node[0]['treeplace'] == 1 && $new_node[0]['parent'] != 0)                 //如果增加的节点是右区，则处理
        {
            //var_dump('DEBUG : Adminopt.php on line:'.__LINE__);
            $state = $member->updateGanenInfo($new_node[0]["ID"]);
            if(!$state)
            {
                //var_dump('ERROR : Adminopt.php on line:'.__LINE__);
                //$this->error('ERROR : Adminopt.php on line:'.__LINE__);
                return false;
            }
        }
        
        		
		$data = array();

        $user_id = $new_node[0]['user_id'];
        $userdetails = new User_details();
        //var_dump($user_id);
        $state = $userdetails->DetailsUpdate($user_id, -1, -1, -1, -1, $ntime, -1, -1, -1);
		$status = 1;
		//$openid = $open_uid;//当前登录的用户id，与网络结构和推荐结构无关
		////var_dump("openid:");
		////var_dump($openid);
		$fenh_time =  date("Y-m-d H:i:s",strtotime("+1 day"));//
		////var_dump("fenh_time:");
		////var_dump($fenh_time);
		$state = $member->updateStatus($new_node[0]["ID"], $status, $openid, $fenh_time);
		if(!$state)
		{
		    //var_dump('ERROR : Adminopt.php on line:'.__LINE__);
		    //$this->error('ERROR : Adminopt.php on line:'.__LINE__);
		    return false;
		}
		////var_dump($state);
		/*if ($open_uid > 0) {//根据id获取userid
			$data['open_userid'] = cy_get_userid($open_uid);
		}*/

		//更新股价表
		//bz5是总股额，$bb是注册资金； 总股额是注册资金*配股比例
		//$data['bz5'] = $bb * $bz5_bl[$lv] / 100 ;
		$gujia = new Historical_price();
		$new_gujia = $gujia->HistoricalpriceQueryByTiem("2017-09-04 00:00:05", $ntime);
		$now_gujia = number_format($new_gujia[0]["share_price"], 2, '.', '') / 100;//获取当前股价
		$state = $gujia->HistoricalpriceInsert($now_gujia);
		if(!$state)
		{
		    //var_dump('ERROR : Adminopt.php on line:'.__LINE__);
		    //$this->error('ERROR : Adminopt.php on line:'.__LINE__);
		    return false;
		}
		//股额除于股价，取整
		//$data['gushu'] = floor($data['bz5'] / $now_gujia);
		//7和10要放在配置参数，最大静态和最大动态倍数，这个是通过参数列表获取的
		//更新用户的point表
		/*$user_point = new User_point();
		$shengyu_jing = 7 * $new_node[0]['status'] * 500;
		$shengyu_dong = 10 * $new_node[0]['status'] * 500;
		$state = $user_point->remainPointUpdate($user_id, $shengyu_jing, $shengyu_dong);
		if(!$state)
		{
		    //var_dump('ERROR : Adminopt.php on line:'.__LINE__);
		    //$this->error('ERROR : Adminopt.php on line:'.__LINE__);
		    return false;
		}*/
		return $state;
    }
    
    //开通会员-----后台开通，前台传入的勾选的所有的需要开通的ID号
    //被本文件的函数调用
    public function audit_member_open($id, $openid = 1) {
        //var_dump("Adminopt.php : audit_member_open".__LINE__);
        $today = date('Y-m-d H:i:s');
        $member = new Positionality();
        $award = new Awardopt();
        //var_dump("Adminopt.php : audit_member_open".__LINE__);
        $node = $member->PositionQueryByID($id);
        $vo = $node[0];
        //var_dump("Adminopt.php : audit_member_open".__LINE__);
        //var_dump("userid:".$vo['user_id']);
        //var_dump("openid:".$openid);
        //var_dump("status:".$vo['status']);
        //$is_open = $this->_member_open($vo['user_id'], $openid, $vo['status']);//2018-05-23本函数所做事物在其他地方已全部做了
       
        //var_dump("Adminopt.php : audit_member_open".__LINE__);
        
        if (count($node) >= 0) {
            //var_dump("Adminopt.php : audit_member_open".__LINE__);
            //判断是否拆分
            $judge = $this->judge_chaifen($vo['ID']);
            //return true;
            
            /*------------------------这部分功能已经在User_info.php中的UserActivate函数实现了---------------------
            //更新推荐人数
            //更新直推的那个人的推荐人数
            //$member->where('id='.$vo['re_id'])->setInc('re_nums');
            $userid = $vo["user_id"];
            $details = new User_details();
            $detailinfo = $details->DetailsQuery($userid);
            $recommonder = $detailinfo[0]["recommender"];
            //var_dump("Adminopt.php : audit_member_open".__LINE__."userid:".$recommonder);
            //$details->increasReNum($recommonder, 1);

            //更新整个re_path路径上所有人的推荐人数
            //$member->where('id IN(0'.$vo['re_path'].'0) AND is_pay>0')->setInc('repath_ds');//更新推荐路径上所有人的repath_ds值
            while(true)
            {
                //var_dump("fasda");
                //var_dump("Adminopt.php : audit_member_open".__LINE__."ID:".$recommonder);
                $details->increasRePathDS($recommonder, 1);
                $detailinfo = $details->DetailsQuery($recommonder);
                if(count($detailinfo)<1)
                    break;
                else if($detailinfo[0]["recommender"] == 0)
                    break;
                else 
                    $recommonder = $detailinfo[0]["recommender"];
               
            }
            */
            //更新左右区uid
            //$member->where('id='.$vo['parent_id'])->setField('t'.$vo['treeplace'].'_uid', $vo['id']);
            //单数和奖金统计
            //$member->where('id IN(0'.$vo['p_path'].'0) AND is_pay>0')->setInc('sum_yj', $vo['reg_money']);
            //var_dump("Adminopt.php : audit_member_open".__LINE__);
            $award->tree2ds_tongji($vo['json'], $vo['treeplace'], $vo['status']); //看函数内部

            //var_dump("Adminopt.php : audit_member_open".__LINE__);
            $award->bonus_tongji($vo['user_id']); //奖金统计 
            return true;

        } else {
            //var_dump("Adminopt.php : audit_member_open".__LINE__);
            //$this->error('开通失败！');
        }

    }
    
    //升级会员
    public function audit_member_update($id, $openid = 1, $cost_money) {
        //var_dump("Adminopt.php : audit_member_open".__LINE__);
        $today = date('Y-m-d H:i:s');
        $member = new Positionality();
        $award = new Awardopt();
        //var_dump("Adminopt.php : audit_member_open".__LINE__);
        $node = $member->PositionQueryByID($id);
        $vo = $node[0];
        //var_dump("Adminopt.php : audit_member_open".__LINE__);
        //var_dump("userid:".$vo['user_id']);
        //var_dump("openid:".$openid);
        //var_dump("status:".$vo['status']);
        //$is_open = $this->_member_open($vo['user_id'], $openid, $vo['status']);//2018-05-23本函数所做事物在其他地方已全部做了
         
        //var_dump("Adminopt.php : audit_member_open".__LINE__);
    
        if (count($node) >= 0) {
            //var_dump("Adminopt.php : audit_member_open".__LINE__);
            //判断是否拆分
            $judge = $this->judge_chaifen_update($vo['ID'], $cost_money);
            //return true;
    
             //单数和奖金统计
             //$member->where('id IN(0'.$vo['p_path'].'0) AND is_pay>0')->setInc('sum_yj', $vo['reg_money']);
             //var_dump("Adminopt.php : audit_member_open".__LINE__);
             $danshu = $cost_money / 500;
             $award->tree2ds_tongji_update($vo['json'], $vo['treeplace'], $danshu); //看函数内部
    
             //var_dump("Adminopt.php : audit_member_open".__LINE__);
             $award->bonus_tongji_update($vo['user_id'], $cost_money); //奖金统计
    
        } else {
            //var_dump("Adminopt.php : audit_member_open".__LINE__);
            //$this->error('开通失败！');
        }
    
    }
    
    //判断是否拆分，参数1是当前要开通的userid
    //本函数被audit_member_open调用，当新注册客户成功开通之后置is_open为1，调用本函数
	public function judge_chaifen($uid){   //**********注意这里传递的是：1，2，3，4而不是100042这种
	    $gptobuy = new Deal_info(); //M('gptobuy');//交易记录表
	    $gponsale = new Gp_onsale();//M('gponsale');//公司出售记录表
	    $member = new Positionality();//M('member');//网络结构图表对象
	    $gpset = new Gp_set(); //M('gpset');//当前的股价，出售的期数，当前出售价格时需要售卖的股数，只会有一条记录
	    
	    //$xinzeng_sale  = $member->where('id='.$uid)->field('id,gushu,bz5,reg_money,user_id')->find();
	    $xinzeng_sale  = $member->PositionQueryByID($uid);//id和user_id，gushu是股数，bz5是总股额，都有；reg_money通过state获取
	    $paramOBJ = new External();
	    $param = $paramOBJ->getParam("register_total", $xinzeng_sale[0]["status"], "");
	    $ok_money = $param;//
	    //$gp = $gpset->where('id=1')->find();//存放公司股票相关的，只会有一条
	    $gp = $gpset->GpSetQuery();
	   	//var_dump($xinzeng_sale[0]["user_id"]);
	    //$deal_gushu = intval($ok_money /  $gp[0]["now_price"]);
	    //更新产品交易记录，deal_info表
	    $deal = new Deal_info();
	    $okid = $deal->DealinfoInsert( $xinzeng_sale[0]["user_id"], 1, $ok_money,$xinzeng_sale[0]["gushu"], 
	                                   3.14, "details",1, $gp[0]["now_price"]);
	    //$okid = $this->gptobuy_add($xinzeng_sale,$gp['now_price']);
	    if($okid < 0){
	        //var_dump('ERROR : Adminopt.php on line:'.__LINE__);
	        //$this->error('更新静态数据错误1'.$xinzeng_sale[0]['user_id']);
	        return false;
	    }
	    
	    $salers = $gponsale->GponsaleQueryByStatus();//M('gponsale')->where('status = 1')->field('ok_nums')->find();
	    if(count($salers) > 0)
	       $buycount = $salers['ok_nums'];
	    else 
	       $buycount = 0;
	    //$salers = $gponsale->GponsaleQueryByStatus();//$gponsale->where('status=1')->field('snums,sy_nums,status,user_id')->find();
	    $update_buycount = $xinzeng_sale[0]["gushu"] + $buycount;//这个人新买的股数加上之前已经累计的股数
	
	    ///////更新总股额----这段代码有点问题，待定,这部分代码都是没有注销的，后面需要重新取消注释
	    /*$map4 = array();
	    $map4['is_pay']=1;
	    $now_price_temp = cy_get_gpset('now_price');
	    $map4['pay_gujia']=array('neq',$now_price_temp);
	    $frs2 = $member->where($map4)->field('id,user_id,bz5,gushu,pay_gujia')->order('id ASC')->select();
	    foreach($frs2 as $vo2){
	        $data3 = array();
	        $gue = $vo2['gushu']*$now_price_temp;
	        $data3['bz5'] = round($gue,2);
	        $member->where('id='.$vo2['id'])->save($data3);
	        unset($data3);
	    }
	    unset($map4);*/
	    ////////////
	    
	    //没有找到状态为1的记录，则直接插入
	    /*if(count($salers)<1){
	        $ok = $gponsale->GponsaleInsert($gp[0]["now_price"], $gp[0]["gp_qfhl"], $xinzeng_sale[0]["gushu"], $ok_money, 1, 0); //$this->gponsale_add($gp);//插入一条出售记录
	        if(!$ok){
	            //var_dump('ERROR : Adminopt.php on line:'.__LINE__);
	            return false;
	        }
	        $salers = $gponsale->GponsaleQueryByStatus();//$gponsale->where('status=1')->field('snums,sy_nums,status,user_id')->find();
  
	    }else*/
	        if($update_buycount){
    	        //var_dump("Adminopt.php line:".__LINE__."gushu:".$update_buycount);
    	        
    	        //若当前累计的股数<当前期数的股数，则更新当前累计的股数,这里应该修改为当前买入股数小于还差剩余股数
    	        if($salers['ok_nums'] < $salers['snums']){
    	            //var_dump("更新公司最新一期销售额度");
    	            $okid = $gponsale->GponsaleUpdate($salers["AUTO_ID"],-1, -1, $update_buycount, $ok_money);	            
    	            if(!$okid){
    	                //var_dump('ERROR : Adminopt.php on line:'.__LINE__);
    	                //$this->error('ERROR : Adminopt.php on line:'.__LINE__);
    	            }
    	            return true;
    	        }else {
        	            $pre_gujia = $gp[0]["now_price"];//cy_get_gpset('now_price');获取前面的最近一次的股价
        	            $now_gujia = $pre_gujia + 0.01;
        	            //var_dump("Adminopt.php , 涨价了：line".__LINE__);
        	
        	            //当股价大于1.99时，要进行拆分，把等于号去掉
        	            if($now_gujia > 1.99){//拆分
        	                $okid2 = $gponsale->GponsaleChangeStatus(2);//$gponsale->where('status=1')->save($data4);
        	                $okid2 = $okid2 && $gponsale->GponsaleInsert(1, 2*$gp[0]["gp_qfhl"], $xinzeng_sale[0]["gushu"], $ok_money, 1, 0);
        	                
        	                $this->chaifen_act($gp[0],$xinzeng_sale[0]['gushu']);//
        	            }else{        //不拆分
        	                $data1 = array();
        	                $data1['qishu'] = $gp[0]['qishu'] + 1;
        	                $data1['now_price'] = $now_gujia;
        	                $ok = $gpset->GpSetUpdate($data1['qishu'], $data1['now_price']);//$gpset->where('id=1')->save($data1);
        	                if(!$ok){
        	                    //var_dump('ERROR : Adminopt.php on line:'.__LINE__);
        	                    //$this->error('ERROR : Adminopt.php on line:'.__LINE__);
        	                }
        	                $gp = $gpset->GpSetQuery();
        	                $gp = $gp[0];
        	                //var_dump("line:".__LINE__."gp now price:".$gp["now_price"]);

        	                //var_dump("更新公司销售状态：1---2");
        	                $okid2 = $gponsale->GponsaleChangeStatus(2);//$gponsale->GponsaleUpdate($salers["AUTO_ID"], -1, -1, -1, -1, 2, -1);//$gponsale->where('status=1')->save($data4);
        	                $okid2 = $okid2 && $gponsale->GponsaleInsert($gp["now_price"], $gp["gp_qfhl"], $xinzeng_sale[0]["gushu"], $ok_money, 1, 0);
        	                if(!$okid2){
        	                    //var_dump('ERROR : Adminopt.php on line:'.__LINE__);
        	                    //$this->error('ERROR : Adminopt.php on line:'.__LINE__);
        	                }
        	                //unset($data4);
        	
        	
        	                //增加一条公司出售,新增记录每次都是在上面做，检查到没有状态值等于1的记录时，才插入新纪录
        	                /*
        	                $data = array();
        	                $data['stype'] = $gp['qishu'];
        	                //$data['uid'] = 0;
        	                //$data['user_id'] = 'system';
        	                $data['sprice'] = $gp['now_price'];
        	                //$data['sprice_m'] = $gp['now_price'] * $gp['up_price'];
        	                $data['snums'] = $gp['gp_qfhl'];//只有拆分了才会翻倍
        	                //$data['sy_nums'] = $gp['gp_qfhl'] * $gp['qishu'] - $gp['gp_zxsl'];
        	                $data['ok_nums'] = $xinzeng_sale[0]['gushu'];
        	                $data['get_money'] = 0;//此处值不重要，不更新
        	                $data['ctime'] = time();
        	                $data['status'] = $gp['s_isopen'];
        	                $data['uptime'] = 0;
        	                $ok = $gponsale->GponsaleInsert($gp['now_price'], $gp[0]["gp_qfhl"], $data['ok_nums'], $data['get_money'], 1);//$gponsale->add($data);
        	                //unset($data);
        	                //unset($data1);
        	                if(!$ok){
        	                    //var_dump('ERROR : Adminopt.php on line:'.__LINE__);
        	                    //$this->error('ERROR : Adminopt.php on line:'.__LINE__);
        	                }*/
        	                
        	                //更新所有会员的股额,获取所有有效用户，并剔除管理员，虚拟根节点
        	                $frs = $member->getAllLegUser();//$member->where($map5)->field('id,user_id,gushu,bz5')->order('id ASC')->select();
        	                if(is_array($frs) && !empty($frs)){
        	                    foreach($frs as $vo){
        	                        //var_dump($vo["ID"]);
        	                        $gue = $vo['gushu'] * $gp['now_price'];
        	                        $curID = $vo['ID'];
        	                        //var_dump("Adminopt.php , line:".__LINE__."update bz5".$gue);
        	                        $ok = $member->updateGushu($curID, $vo['gushu'],  $gue, 0);//$member->where($map6)->save($data5);
                                    $futouJine = $paramOBJ->getParam("register_total", $vo["status"], "") * $paramOBJ->getParam("share_proportion", $vo["status"], "") * 4 /100;
                                    
                                    if($gue >= $futouJine) //reg_money*配股比例*4
                                        $this->futou($curID, $futouJine); //reg_money*配股比例*4-reg_money
                                    
        	                        if(!$ok){
        	                            //var_dump('ERROR : Adminopt.php on line:'.__LINE__);
        	                            //$this->error('更新会员ID为'.$vo['ID'].'数据错误！');
        	                        }
        	                    }
        	                }
        	                return 2;
        	            }
    	        }
	    }else{
	        //var_dump("Adminopt.php : audit_member_open".__LINE__);
	        //$this->error('拆分错误.');
	    }
	}
    
	//升级时调用
	public function judge_chaifen_update($uid, $cost_money){   //**********注意这里传递的是：1，2，3，4而不是100042这种
	    $gptobuy = new Deal_info(); //M('gptobuy');//交易记录表
	    $gponsale = new Gp_onsale();//M('gponsale');//公司出售记录表
	    $member = new Positionality();//M('member');//网络结构图表对象
	    $gpset = new Gp_set(); //M('gpset');//当前的股价，出售的期数，当前出售价格时需要售卖的股数，只会有一条记录
	    $gp = $gpset->GpSetQuery();

	    //$xinzeng_sale  = $member->where('id='.$uid)->field('id,gushu,bz5,reg_money,user_id')->find();
	    $xinzeng_sale  = $member->PositionQueryByID($uid);//id和user_id，gushu是股数，bz5是总股额，都有；reg_money通过state获取
	    $paramOBJ = new External();
	    //$param = $paramOBJ->getParam("register_total", $xinzeng_sale[0]["status"], "");
	    $xinzeng_gushu = ($cost_money * $paramOBJ->getParam("share_proportion", -1, $xinzeng_sale[0]["user_id"]) / 100) / $gp[0]["now_price"];
	    $ok_money = $cost_money;//
	    //$gp = $gpset->where('id=1')->find();//存放公司股票相关的，只会有一条

	    //$deal_gushu = intval($ok_money /  $gp[0]["now_price"]);
	    //更新产品交易记录，deal_info表
	    $deal = new Deal_info();
	    $okid = $deal->DealinfoInsert( $xinzeng_sale[0]["user_id"], 1, $ok_money,$xinzeng_gushu, 3.14, "details",1, $gp[0]["now_price"]);
	    //$okid = $this->gptobuy_add($xinzeng_sale,$gp['now_price']);
	    if($okid < 0){
	        //var_dump('ERROR : Adminopt.php on line:'.__LINE__);
	        //$this->error('更新静态数据错误1'.$xinzeng_sale[0]['user_id']);
	        return false;
	    }
	     
	    $salers = $gponsale->GponsaleQueryByStatus();//M('gponsale')->where('status = 1')->field('ok_nums')->find();
	    if(count($salers) > 0)
	        $buycount = $salers['ok_nums'];
        else
            $buycount = 0;
        //$salers = $gponsale->GponsaleQueryByStatus();//$gponsale->where('status=1')->field('snums,sy_nums,status,user_id')->find();
        $update_buycount = $xinzeng_gushu + $buycount;//这个人新买的股数加上之前已经累计的股数

        ///////更新总股额----这段代码有点问题，待定,这部分代码都是没有注销的，后面需要重新取消注释
        /*$map4 = array();
         $map4['is_pay']=1;
         $now_price_temp = cy_get_gpset('now_price');
         $map4['pay_gujia']=array('neq',$now_price_temp);
         $frs2 = $member->where($map4)->field('id,user_id,bz5,gushu,pay_gujia')->order('id ASC')->select();
         foreach($frs2 as $vo2){
         $data3 = array();
         $gue = $vo2['gushu']*$now_price_temp;
         $data3['bz5'] = round($gue,2);
         $member->where('id='.$vo2['id'])->save($data3);
         unset($data3);
         }
         unset($map4);*/
        ////////////
         
        //没有找到状态为1的记录，则直接插入
        /*if(count($salers)<1){
         $ok = $gponsale->GponsaleInsert($gp[0]["now_price"], $gp[0]["gp_qfhl"], $xinzeng_sale[0]["gushu"], $ok_money, 1, 0); //$this->gponsale_add($gp);//插入一条出售记录
         if(!$ok){
         //var_dump('ERROR : Adminopt.php on line:'.__LINE__);
         return false;
         }
         $salers = $gponsale->GponsaleQueryByStatus();//$gponsale->where('status=1')->field('snums,sy_nums,status,user_id')->find();

         }else*/
            if($update_buycount){
                //var_dump("Adminopt.php line:".__LINE__."gushu:".$update_buycount);
                 
                //若当前累计的股数<当前期数的股数，则更新当前累计的股数,这里应该修改为当前买入股数小于还差剩余股数
                if($salers['ok_nums'] < $salers['snums']){
                    //var_dump("更新公司最新一期销售额度");
                    $okid = $gponsale->GponsaleUpdate($salers["AUTO_ID"],-1, -1, $update_buycount, $ok_money);
                    if(!$okid){
                        //var_dump('ERROR : Adminopt.php on line:'.__LINE__);
                        //$this->error('ERROR : Adminopt.php on line:'.__LINE__);
                    }
                    return true;
                }else {
                    $pre_gujia = $gp[0]["now_price"];//cy_get_gpset('now_price');获取前面的最近一次的股价
                    $now_gujia = $pre_gujia + 0.01;
                    //var_dump("Adminopt.php , 涨价了：line".__LINE__);
                     
                    //当股价大于1.99时，要进行拆分，把等于号去掉
                    if($now_gujia > 1.99){//拆分
                        $okid2 = $gponsale->GponsaleChangeStatus(2);//$gponsale->where('status=1')->save($data4);
                        $okid2 = $okid2 && $gponsale->GponsaleInsert(1, 2*$gp[0]["gp_qfhl"], $xinzeng_gushu, $ok_money, 1, 0);
                         
                        $this->chaifen_act($gp[0],$xinzeng_gushu);//
                    }else{        //不拆分
                        $data1 = array();
                        $data1['qishu'] = $gp[0]['qishu'] + 1;
                        $data1['now_price'] = $now_gujia;
                        $ok = $gpset->GpSetUpdate($data1['qishu'], $data1['now_price']);//$gpset->where('id=1')->save($data1);
                        if(!$ok){
                            //var_dump('ERROR : Adminopt.php on line:'.__LINE__);
                            //$this->error('ERROR : Adminopt.php on line:'.__LINE__);
                        }
                        $gp = $gpset->GpSetQuery();
                        $gp = $gp[0];
                        //var_dump("line:".__LINE__."gp now price:".$gp["now_price"]);

                        //var_dump("更新公司销售状态：1---2");
                        $okid2 = $gponsale->GponsaleChangeStatus(2);//$gponsale->GponsaleUpdate($salers["AUTO_ID"], -1, -1, -1, -1, 2, -1);//$gponsale->where('status=1')->save($data4);
                        $okid2 = $okid2 && $gponsale->GponsaleInsert($gp["now_price"], $gp["gp_qfhl"], $xinzeng_gushu, $ok_money, 1, 0);
                        if(!$okid2){
                            //var_dump('ERROR : Adminopt.php on line:'.__LINE__);
                            //$this->error('ERROR : Adminopt.php on line:'.__LINE__);
                        }
                        //unset($data4);
                         
                         
                        //增加一条公司出售,新增记录每次都是在上面做，检查到没有状态值等于1的记录时，才插入新纪录
                        /*
        	                $data = array();
        	                $data['stype'] = $gp['qishu'];
        	                //$data['uid'] = 0;
        	                //$data['user_id'] = 'system';
        	                $data['sprice'] = $gp['now_price'];
        	                //$data['sprice_m'] = $gp['now_price'] * $gp['up_price'];
        	                $data['snums'] = $gp['gp_qfhl'];//只有拆分了才会翻倍
        	                //$data['sy_nums'] = $gp['gp_qfhl'] * $gp['qishu'] - $gp['gp_zxsl'];
        	                $data['ok_nums'] = $xinzeng_sale[0]['gushu'];
        	                $data['get_money'] = 0;//此处值不重要，不更新
        	                $data['ctime'] = time();
        	                $data['status'] = $gp['s_isopen'];
        	                $data['uptime'] = 0;
        	                $ok = $gponsale->GponsaleInsert($gp['now_price'], $gp[0]["gp_qfhl"], $data['ok_nums'], $data['get_money'], 1);//$gponsale->add($data);
        	                //unset($data);
        	                //unset($data1);
        	                if(!$ok){
        	                //var_dump('ERROR : Adminopt.php on line:'.__LINE__);
        	                //$this->error('ERROR : Adminopt.php on line:'.__LINE__);
        	                }*/
                         
                        //更新所有会员的股额,获取所有有效用户，并剔除管理员，虚拟根节点
                        $frs = $member->getAllLegUser();//$member->where($map5)->field('id,user_id,gushu,bz5')->order('id ASC')->select();
                        if(is_array($frs) && !empty($frs)){
                            foreach($frs as $vo){
                                //var_dump($vo["ID"]);
                                $gue = $vo['gushu'] * $gp['now_price'];
                                $curID = $vo['ID'];
                                //var_dump("Adminopt.php , line:".__LINE__."update bz5".$gue);
                                $detailsOBJ = new User_details();
                                $detailsRES = $detailsOBJ->DetailsQuery($curID);
                                $userstatus = array();
                                $userstatus["status"] = $detailsRES[0]["user_level"];
                                $userstatus["gushu"] = $vo['gushu'];
                                $userstatus["bz5"] = $gue;
                                //2018--06-19为了同时修改网络结构图中的status，而改变此处逻辑
                                //$ok = $member->updateGushu($curID, $vo['gushu'],  $gue, 0);//$member->where($map6)->save($data5);
                                $ok = $member-> where("ID=$curID")
                                                ->setField($userstatus);
                                
                                $futouJine = $paramOBJ->getParam("register_total", $vo["status"], "") * $paramOBJ->getParam("share_proportion", $vo["status"], "") * 4 /100;

                                if($gue >= $futouJine) //reg_money*配股比例*4
                                    $this->futou($curID, $futouJine); //reg_money*配股比例*4-reg_money

                                    if(!$ok){
                                        //var_dump('ERROR : Adminopt.php on line:'.__LINE__);
                                        //$this->error('更新会员ID为'.$vo['ID'].'数据错误！');
                                    }
                            }
                        }
                        return 2;
                    }
                }
            }else{
                //var_dump("Adminopt.php : audit_member_open".__LINE__);
                //$this->error('拆分错误.');
            }
	}
	
	//这个函数被上面的judge_chaifen调用，股价满足超过 1.99时被调用
	public function chaifen_act($gp,$xinzeng_sale_gushu)
	{
	    $gptobuy = new Deal_info();//M('gptobuy');
	    $member =  new Positionality();//M('member');
	    $gponsale = new Gp_onsale();//M('gponsale');
	    $gpset = new Gp_set();//M('gpset');
	    $now_gujia = 1;
	    $cf_time = date("Y-m-d H:i:s");
	    $gp = $gpset->GpSetQuery();
	    $ok = $gpset->GpSetUpdate($gp[0]["qishu"]+1, $now_gujia, $gp[0]["gp_qfhl"]*2, -1);
	    //var_dump('Adminopt.php:  on line:'.__LINE__);
	    //$okid3 = $gponsale->GponsaleChangeStatus(2);
	    
	    /*
	    //此处的插入新的记录也被删除，这一步不需要在这里做
	    //增加一条公司出售信息
	    $gp_new = $gpset->GpSetQuery();
	    $gp_new = $gp_new[0];

	    //$ok = $gponsale->add($data);
	    //var_dump("now_price:");
	    //var_dump($gp_new['now_price']);
	    //var_dump("gp_qfhl:");
	    //var_dump( $gp_new['gp_qfhl']);
	    //var_dump("xinzeng_sale_gushu:");
	    //var_dump($xinzeng_sale_gushu);
	    //$ok = $gponsale->GponsaleInsert($gp_new['now_price'], $gp_new['gp_qfhl'], $xinzeng_sale_gushu, 0, 1, -1);
	    */
	    if(!$ok){
	        //var_dump('ERROR : Adminopt.php on line:'.__LINE__);
	        //$this->error('ERROR : Adminopt.php on line:'.__LINE__);
	    }
	    $paramOBJ = new External();
	    $ok = $member->updateGushuByArray(1, 0);
	    $frs = $member->getAllLegUser();
	    foreach($frs as $vo){
	        //$ok = $member->where('id='.$vo['id'])->save($data6);
	        //bz5是股额，总股额永远都是通过股数乘于股价得到的，
	        //var_dump("Adminopt.php line:".__LINE__);
	        $gushu = $vo["gushu"]*2;
	        $gue = $gushu * $now_gujia;
	        $curID = $vo['ID'];
	        //var_dump("Adminopt.php line:".__LINE__."ID:".$curID."gue:".$gue."gushu:".$gushu);
	        
	        $futouJine = $paramOBJ->getParam("register_total", $vo["status"], "") * $paramOBJ->getParam("share_proportion", $vo["status"], "") * 4 / 100;
	        //var_dump("curID:".$curID."gue:".$gue."futoujine:".$futouJine);
	        if($gue >= $futouJine)   //reg_money*配股比例*4
	            $this->futou($curID, $futouJine); //reg_money*配股比例*4-reg_money
	    }
	    return 3;
	}
	
	//参数1是谁拿静态奖，参数2是复投的资金，
	//1、更新会员自己的静态奖金需要计算
	//2、更新股价，重新买股票
	//3、复投相当于重新开买，就会触发感恩奖，平衡奖
	//4、公司交易记录
	//5、产品交易记录Deal_info
	//参数1是当前复投人的id，参数2是复投的钱
	public function futou($ID,$futou_money){
	    //更新member表
	    //var_dump("Adminopt.php line:".__LINE__."ID:".$ID);
	    $member = new Positionality();//M('member');
	    if(is_numeric($ID))
        {
            $vo = $member->PositionQueryByID($ID);
        }
        else {
            $vo = $member->PositionQuery($ID);
        }
        
	    
	    $vo = $vo[0];
	    $id = $vo["user_id"];
	    $paramOBJ  = new External();
	    $resDanshu = $paramOBJ->getParam("register_order_num", -1, $vo["user_id"]);
	    $award = new Award_record();//D('Award');//操作奖金
	    $deal_info = new Deal_info();
	    $gponsale_obj = new Gp_onsale();//这里一定可以得到，如果没有的话，就不会进入这里
	    $gponsale = $gponsale_obj->GponsaleQueryByStatus();
	    $gptobuy = new Deal_info();//M('gptobuy');
	    $gp = new Gp_set();//M('gpset')->where('id=1')->find();
	    $_res_pgset = $gp->GpSetQuery();
	    $now_gujia = $_res_pgset[0]["now_price"];//M('gpset')->where('id=1')->field('now_price')->find();
	    $details = new User_details();
	    $_detail = array();
        $_detail["pay_gujia"] = $now_gujia;
        
        if(count($details->DetailsQuery($id)) < 1)
        {
            //var_dump("User_info.php ERROR ar line:".__LINE__);
            return false;
        }
        $_detail_info_res = $details->where("ID='$id'")
        ->setField($_detail);

	    //$res_set = $gp->GpSetQuery();
	     
	    //更新member相关数据
	    $data = array();
	    
	    $bl_peigu = $paramOBJ->getParam("share_proportion", -1, $vo["user_id"]) / 100;
	    $ss = $vo['status'];
	    
	    $points = new User_point();
	    $_res_points = $points->PointQuery($vo["user_id"]);
	    $_res_points = $_res_points[0];
	    $wanneng_money = $futou_money - $paramOBJ->getParam("register_total", -1, $vo["user_id"]);//$vo['status'] * 500是注册资金，读参数
	    $data['bz6'] = $_res_points["universal_point"] + $wanneng_money; //更新万能分
	    $data['bz5'] = $paramOBJ->getParam("register_total", $vo["status"], "") * $bl_peigu;//此处只记录新增的股额
	    $data['shengyu_jing'] = $_res_points['shengyu_jing'] - $wanneng_money;                      //更新剩余静态奖金额度
	    $data['pay_gujia'] = $now_gujia;
	    $data['gushu'] = floor($data['bz5'] / $now_gujia);//只计算新加的股数；只有一开始和升级是通过股额计算股数，其他时候都是通过股数计算股额      //更新股数
	    $ok = $member->updateGushu($vo["ID"], $data['gushu'], $data['bz5']);//>where('id='.$id)->save($data);
	    //$ok = $ok && $details
	    $ok = $points->PointUpdate($id, -1, -1, -1, -1, $data['bz6'], -1,-1,-1, $data['shengyu_jing']);
	    $ok = $gponsale_obj->GponsaleUpdate($id, $now_gujia, -1, $data['gushu']+$gponsale["ok_nums"]);
	    if(!$ok){
	        //var_dump('ERROR : Adminopt.php on line:'.__LINE__);
	        //$this->error('复投数据第1部分更新失败id='.$id);
	        return false;
	    }

	    //************************
	    $awardopt = new Awardopt();
	    //更新奖金，5表示的就是什么奖，这里是静态奖
	    $awardopt->_in_bonus($vo['user_id'], $vo['user_id'], 5, $wanneng_money); //将静态奖金录入
	    
	    //-----------------------5.14--------------------
	    //var_dump("JSON:".$vo['json']."danshu:".$resDanshu);
	    $awardopt->tree2ds_x_tongji($vo['json'], $vo['treeplace'],$resDanshu);//计算平衡奖所需要做的准备
	    $awardopt->bonus_tongji($vo['user_id'],1);//复投所有奖金要重新计算
	    
	    //return 0;
	    //*************************
	    
	    $vo = $member->PositionQueryByID($ID);//>where('id='.$id)->field('id,user_id,reg_money,bz5,bz6,pay_gujia,shengyu_jing,gushu,u_level')->find();
	    $vo = $vo[0];
	    //更新出售股数
	    $now_gushu = $gponsale['ok_nums'] + $vo['gushu'];
	    if($now_gushu){
	        //若当前累计的股数<当前期数的股数，则更新当前累计的股数
	        if($gponsale['ok_nums'] < $gponsale['snums']){
	            //changed by Gavin start model11
	            $okid=$deal_info->DealinfoInsert($id, 1, $vo['gushu']*$now_gujia, $vo['gushu'], -1, -1, -1, $now_gujia);//$this->gptobuy_add($vo,$now_gujia);
	            //changed by Gavin end model11
	            if(!$okid){
	                //var_dump('ERROR : Adminopt.php on line:'.__LINE__);
	                //$this->error('ERROR : Adminopt.php on line:'.__LINE__);
	            }
	            $okid =  $okid = $gponsale_obj->GponsaleUpdate( $id,-1,$gponsale['snums'],$now_gushu,$vo['status']*500 );//$this->gponsale_update($gp,$gponsale['snums'],$vo['reg_money'],$new_gushu);
	            if(!$okid){
	                //var_dump('ERROR : Adminopt.php on line:'.__LINE__);
	                //$this->error('ERROR : Adminopt.php on line:'.__LINE__);
	            }
	            return 1;
	        }else{
	            $gp = new Gp_set();//M('gpset')->where('id=1')->find();
	            $_res_pgset = $gp->GpSetQuery();
	            $pre_gujia = $_res_pgset[0]["now_price"];
	            $now_gujia = $pre_gujia + 0.01;
	
	            //当股价大于1.99时，要进行拆分
	            if($now_gujia >= 1.99){        //拆分
	                $this->chaifen_act($_res_pgset[0],$vo['gushu']);
	            
	            }else{        //不拆分
	                $data1 = array();
	                $data1['qishu'] = $_res_pgset[0]['qishu'] + 1;
	                $data1['now_price'] = $now_gujia;
	                $ok = $gp->GpSetUpdate($data1['qishu'], $data1['now_price']);//M('gpset')->where('id=1')->save($data1);
	                if(!$ok){
	                    //var_dump('ERROR : Adminopt.php on line:'.__LINE__);
	                    //$this->error('ERROR : Adminopt.php on line:'.__LINE__);
	                }
	
	                $data1 = array();   //将出售完的股状态进行变更
	                $data1['status'] = 2;
	                $okid2 = $gponsale_obj->GponsaleChangeStatus(2);//M('gponsale')->where('status=1')->save($data1);
	                if(!$okid2){
	                    //var_dump('ERROR : Adminopt.php on line:'.__LINE__);
	                    //$this->error('ERROR : Adminopt.php on line:'.__LINE__);
	                }

	                //增加一条公司出售
	                /*
	                $data = array();
	                $data['stype'] = $gp['qishu'];
	                $data['uid'] = 0;
	                $data['user_id'] = 'system';
	                $data['sprice'] = $gp['now_price'];
	                $data['sprice_m'] = $gp['now_price'] * $gp['up_price'];
	                $data['snums'] = $gp['gp_qfhl'];
	                //$data['sy_nums'] = $gp['gp_qfhl'] * $gp['qishu'] - $gp['gp_zxsl'];
	                $data['ok_nums'] = $vo['gushu'];
	                $data['get_money'] = 0;
	                $data['ctime'] = time();
	                $data['status'] = $gp['s_isopen'];
	                $data['uptime'] = 0;
	                $ok = M('gponsale')->add($data);
	                unset($data);
	                if(!$ok){
	                    $this->error('添加复投数据错误5');
	                }
	                */
	                //增加一条公司出售信息
	                $data = array();
	                 
	                $gp_new = $gp->GpSetQuery();
	                $gp_new = $gp_new[0];
	                $data['stype'] = $gp_new['qishu'];
	                $data['uid'] = 0;
	                $data['user_id'] = 'system';
	                $data['sprice'] = $gp_new['now_price'];
	                $data['sprice_m'] = $gp_new['now_price'] * $gp_new['up_price'];
	                $data['snums'] = $gp_new['gp_qfhl'];
	                //$data['sy_nums'] = $gp['gp_qfhl'] * $gp['qishu'] - $gp['gp_zxsl'];
	                $data['ok_nums'] = $vo['gushu'];
	                $data['get_money'] = 0;
	                $data['ctime'] =cf_time;
	                $data['status'] = $gp_new['s_isopen'];
	                $data['uptime'] = 0;
	                //$ok = $gponsale->add($data);
	                $ok = $gponsale->GponsaleInsert($gp_new['now_price'], $gp_new['gp_qfhl'], $vo['gushu'], 0, 1, -1);
	                if(!$ok){
	                    //var_dump('ERROR : Adminopt.php on line:'.__LINE__);
	                    //$this->error('ERROR : Adminopt.php on line:'.__LINE__);
	                }
	                //更新所有会员的股额
	               /*
	                $map5 = array();
	                $map5['is_pay'] = array('gt',0);
	                $map5['pay_gujia'] = array('neq',$gp['now_price']);
	                $map5['id'] = array('gt',1);
	                $frs = $member->where($map5)->field('id,user_id,gushu,bz5')->order('id ASC')->select();
	                foreach($frs as $vo1){
	
	                    $data5 = array();
	                    $data5['bz5'] = $vo1['gushu'] * $gp['now_price'];
	                    $map6 = array();
	                    $map6['id'] = $vo1['id'];
	                    $ok = $member->where($map6)->save($data5);
	                    if(!$ok){
	                        $this->error('更新会员ID为'.$vo1['id'].'数据错误！'.$data5['bz5']);
	                    }
	                }*/
	                $frs = $member->getAllLegUser();
	                foreach($frs as $vo){
	                    //$ok = $member->where('id='.$vo['id'])->save($data6);
	                    //bz5是股额，总股额永远都是通过股数乘于股价得到的，
	                    $ok = $member->updateGushu($vo['id'], $vo['gushu']*2, 2*$vo['gushu']*$now_gujia, $vo['cf_count'] + 1);
	                    if(!$ok){
	                        //var_dump('ERROR : Adminopt.php on line:'.__LINE__);
	                        //$this->error('更新会员ID为'.$vo['id'].'数据错误！');
	                    }
	                }
	
	                return 2;
	            }
	        }
	    }else{
	        $this->error('拆分错误.');
	    }
	
	}
	
	//----------------------------------------本函数已经停止使用，在Awardopt中有相同的函数--------------------------------
	//参数1表示谁拿奖金，参数2表示谁注册之后产生了奖金，参数3表示是哪种奖，参数4是奖金数量，
	public function _in_bonus($myids, $fuserid, $bkey, $get_money, $btime = 0, $minfo = '') {
	    $qibonus = new Award_daytime();//M('qibonus');
	    if($bkey == 5){ //$bkey等于5表示万能分
	        //静态奖金的处理，人/每天表
	        $IsDayly = $qibonus->isAwarddailyExist($myids);
	        if ($IsDayly)
	        {
	            $_res_qibonus = $qibonus->AwarddailyQuery($myids);
	            $_res_qibonus = $_res_qibonus[0];
	            $qibonus->AwarddailyUpdate($myids, -1, -1, -1, -1, $_res_qibonus["staticbonus"] + $get_money, $_res_qibonus["sum"] + $get_money, $_res_qibonus["actualsalary"]+$get_money);
	        } 
	        else
	        {
	            $qibonus->AwarddailyInsert($myids, 0, 0, 0, 0, $get_money, $get_money, $get_money, $get_money);
	        }
	        //添加奖金纪录
	        $award_record = new Award_record();
	        $_res_award_record = $award_record->AwardRecordInsert($myids, "静态奖", $get_money, $fuserid);
	    }else{
	        //这部分处理动态奖金
	        $paramOBJ = new External();
	        $shui_bl = $paramOBJ->getParam("tax_proportion", -1, $myids);
	        $jijin_bl = $paramOBJ->getParam("foundation_proportion", -1, $myids);//cy_get_conf('bl_jijin');//1
	        $shui = $this->_wei2($get_money * $shui_bl / 100);//保留两位小数，税
	        $jijin = $this->_wei2($get_money * $jijin_bl / 100);//基金
	        $produceCX = $this->_wei2($get_money*0.1); //重复消费分
	        $ok_money = $this->_wei2($get_money - $shui-$jijin - $produceCX);//实际发放金额
	
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
	        $IsDayly = $qibonus->isAwarddailyExist($myids);
	        if (!$IsDayly)
	        {
	            $qibonus->AwarddailyInsert($myids);
	        }
	        
	        $_res_qibonus = $qibonus->AwarddailyQuery($myids);
	        $_res_qibonus = $_res_qibonus[0];
	        if($bkey == 1)//直推
	        {
	           $_res_qibonus[0]["direct"] = $_res_qibonus[0]["direct"] + $get_money;
	           //添加奖金记录
	           $minfo = '实发（'.$ok_money.'）重消分（'.$produceCX.'）税收（'.$shui.'）基金（'.$jijin.'）。';
	           $award_record->AwardRecordInsert($myids, "直推奖", $get_money, $fuserid, $minfo);
	        }
	        if($bkey == 2)//平衡
	        {
	           $_res_qibonus[0]["balance"] = $_res_qibonus[0]["balance"] + $get_money;
	           $minfo = '实发（'.$ok_money.'）重消分（'.$produceCX.'）税收（'.$shui.'）基金（'.$jijin.'）。';
	           $award_record->AwardRecordInsert($myids, "平衡奖", $get_money, $fuserid, $minfo);
	        }
	        if($bkey == 3)//辅导
	        {
	           $_res_qibonus[0]["tutor"] = $_res_qibonus[0]["tutor"] + $get_money;
	           $minfo = '实发（'.$ok_money.'）重消分（'.$produceCX.'）税收（'.$shui.'）基金（'.$jijin.'）。';
	           $award_record->AwardRecordInsert($myids, "辅导奖", $get_money, $fuserid, $minfo);
	        }
	        if($bkey == 4)//感恩
	        {
	           $_res_qibonus[0]["appreciation"] = $_res_qibonus[0]["appreciation"] + $get_money;
	           $minfo = '实发（'.$ok_money.'）重消分（'.$produceCX.'）税收（'.$shui.'）基金（'.$jijin.'）。';
	           $award_record->AwardRecordInsert($myids, "感恩奖", $get_money, $fuserid, $minfo);
	        }

	        /*--------------------这里不做积分处理，因为其他地方已经做了-------------------
	        $pointOBJ = new User_point();
	        $pointRes = $pointOBJ->PointQuery($myids);
	        $pointRes = $pointRes[0];
	        $pointOBJ->PointUpdate($myids, -1,$pointRes["bonus_point"] + $get_money, 0, 0, 0, 0, 0,0,0,$pointRes["shengyu_dong"] - $get_money);
	        ----------------------这里不做积分处理，因为其他地方已经做了------------------*/
	        $qibonus->AwarddailyUpdate($myids, $_res_qibonus[0]["direct"], $_res_qibonus[0]["balance"], $_res_qibonus[0]["tutor"],
	                                   $_res_qibonus[0]["appreciation"], -1, -1, -1, $_res_qibonus["bz0"]+$ok_money,
	                                   $_res_qibonus["bz6"]+$shui, $_res_qibonus["bz7"]+$jijin, $_res_qibonus["bz8"]+$produceCX);
	    }

	}
	
	//取小数点2位数
	protected function _wei2($money = 0) 
	{
	    return sprintf('%.2f', (float)$money);
	}
	
	protected function _auto_syssale() {
	    //$gp = cy_get_gpset('s_isopen,qishu,gp_qfhl,gp_zxsl,fh_price,now_price');
	    $gpset = new Gp_set();
	    $gp = $gpset->GpSetQuery();
	    $gp = $gp[0];
	    $wl = $gp[0]["up_price"];//cy_get_gpset('up_price'); //6
	    if ($gp['qishu'] > 0) {
	        $gponsale = new Gp_onsale();//M('gponsale');
	        $map = array();
	        $map['stype'] = $gp['qishu'];
	        $map['sprice'] = $gp['now_price'];
	        $fields = 'id';
	        $syssale = $gponsale->GponsaleQueryByStatus();//where($map)->field($fields)->find();
	        if (count($syssale)!=0) {
	            $gponsale->GponsaleChangeStatus(2);//>where('stype='.$gp['qishu'])->save($data);
	            $gponsale->GponsaleInsert($gp['now_price'], $gp['gp_qfhl'], 0, 0, 1,  $gp['gp_qfhl'] * $gp['qishu'] - $gp['gp_zxsl']);
	            
	            $gpset->GpSetUpdate( $gp['qishu']+1);
	           
	            //修改股价之后出局
	            /*$map2 = array();
	            $map2['is_pay'] = 1;
	            $map2['reg_money'] = array('NEQ',100);
	            $map2['id'] = array('gt',1);
	            $frs = M('member')->where($map2)->field('id,gushu,cf_count,bz5,reg_money')->order('id ASC')->select();*/
	            $position = new Positionality();
	            $frs = $position->getAllLegUser();
	            foreach($frs as $vo){
	                $data6 = array();
	                $data6['bz5'] = $vo['gushu']*$gp['now_price'];
	                $ok = $position->updateGushu($vo["ID"], -1,  $data6['bz5'], -1);//M('member')->where('id='.$vo['id'])->save($data6);
	                if(!$ok){
	                    //var_dump('ERROR : Adminopt.php on line:'.__LINE__);
	                    //$this->error('ID为'.$vo['id'].'复投数据错误！');
	                }
	                //当总股额到一定值时，进行复投操作
	                if($vo['status'] == 1 && $data6['bz5'] >= 800)
	                {
	                    $this->futou($vo['ID'],800);
	
	                }elseif($vo['status'] == 2 && $data6['bz5'] >= 1800)
	                {
	                    $this->futou($vo['ID'],1800);
	                }
	            }
	        } 
	    }
	}
	
	//更新设置
	public function gpset_act() {
	    //$this->_check_cody(3);//检测权限
	    //$this->_check_admin();//检测管理员权限
	    $model = new Gp_set();//D('Gpset');
	    $_res=$model->GpSetQuery();
	    if (count($_res)) {
	       /* $r = $model->save();
	        if ($r === false) {
	            $this->_box('更新失败！');
	        } else {
	            //cy_clear_gpset(); //清空缓存
	            $this->_auto_syssale();
	            //$this->_box('更新成功！', 1, 'Gpsystem/gpset');
	        }*/
	        $this->_auto_syssale();
	    } else {
	        //var_dump("Adminopt.php : audit_member_open".__LINE__);
	        //$this->error($model->getError());
	    }
	}
	
	public function get_introducer_tree($ID)
	{
	    $user_details=new User_details();
	    $data = array();
	    $index = 0;
	    while(true)
	    {
	        $_res = $user_details->RecommanderQuery($ID);
	        //var_dump($_res);
	    }
	   
	}
	
	//获取当前用户$userId的推荐结构
	public function pointTransforRes($point_type, $point_change_type, $point_change_sum, $minor_password)
    {
        $_session_user = Session::get(USER_SEESION);
        $_userid = $_session_user["userId"];
        $userinfo = new User_info();
        $_res = $userinfo->UserinfoCheckMinor($_userid, $minor_password);
        
	    $userpoint = new User_point();
    	//$res = $userpoint->pointTransfor("H2568023600", 1, 2, 100);
    	$res = $userpoint->pointTransfor($_userid, $point_type, $point_change_type, $point_change_sum);
    	$_resdata = array();
    	$_resdata["success"] = $res;

	    return json_encode($_resdata);
	
	}
	
	//帮助开通账号总函数
	public function activateUser($user_id, $minor_pwd)
	{
	    $_session_user = Session::get(USER_SEESION);
	    if(empty($_session_user))
	    {
	        //var_dump('ERROR : Adminopt.php on line:'.__LINE__);
	        //$this->error('ERROR : Adminopt.php on line:'.__LINE__);
	    }
	     
	    $_userid = $_session_user["userId"];
	    if(strlen($_userid)<5)
	    {
	        $_userid = "admin";
	        $minor_pwd ="140416";
	    }
	    $_resdata = array();
	    $_resdata["success"] = true;
	    
	    $pointOBJ = new User_point();
	    $pointRES = $pointOBJ->PointQuery($_userid);
	    if(count($pointRES) < 1)
	    {
	        $_resdata["success"] = false;
	        return json_encode($_resdata);
	    }
	    
	    $_details = new User_details();
	    $_res = $_details->DetailsQuery($user_id);
     
	    if(count($_res)<1)
	    {
	        $_resdata["success"] = false;
	        return json_encode($_resdata);
	    }
	    else 
	    {
	        $_res = $_res[0];
	    }
	    $level = $_res["user_level"];
	    $regist_money = 0;
	    $externOBJ = new External();
	    $regist_money = $externOBJ->getParam("register_total", $level, $user_id);
	    if($regist_money > $pointRES[0]["regist_point"]) //积分不够
	    {
	        $_resdata["success"] = false;
	        return json_encode($_resdata);
	    }
	    $_resact = $this->activeUserOpt($user_id, $level, $regist_money, $minor_pwd);
	    if($_resact)
	    {
	    	$_resdata["success"] = true;
	    }
	    
	    
	    return json_encode($_resdata);
	}
	
	//被上面总函数调用
	public function activeUserOpt($user_id, $level, $regist_money, $minor_pwd)
	{
	    $_session_user = Session::get(USER_SEESION);
	    if(empty($_session_user))
	    {
	        //var_dump('ERROR : Adminopt.php on line:'.__LINE__);
	         //$this->error('ERROR : Adminopt.php on line:'.__LINE__);
		return false;
	    }
	    
	    $_userid = $_session_user["userId"];
	    if(strlen($_userid)<5)
	    {
	        $_userid = "admin";
	        $minor_pwd ="140416";
	    }
	    
	    //var_dump($_userid);

	    $position = new Positionality();
	    $active = new User_info();
	    //更新新注册用户的details表数据，points表数据，消耗帮助开通用户的注册分
	    $res = $active->UserActivate($user_id, $_userid, $minor_pwd, $level, $regist_money);
	    
	    //var_dump("res:$res");
	    if($res)
	    {
	        $posinfo = $position->PositionQuery($user_id); //待开通的网络结构信息
	        $ID = $posinfo[0]["ID"];
	        $posinfo = $position->PositionQuery($_userid); //帮助开通的网络结构信息
	        $openid = $posinfo[0]["ID"];
	        //更新新注册用户的网络结构表positionality表数据，用户等级，开通人，开通时间
	        $res=$position->updateStatus($ID, $level, $openid, date("Y-m-d H:i:s"));
	        //开通时最先增加一条收入记录，在人每天表，用于计算收支比时的数据源
	        $paramOBJ = new External();
	        $param = $paramOBJ->getParam("register_total", $level, "");
	        //var_dump("income:".$param);
	        $awardday = new Award_daytime();
	        $_res_qibonus = $awardday->AwarddailyQuery($ID);
	        if(count($_res_qibonus) < 1)
	            $awardday->AwarddailyInsert($ID,0,0,0,0,0,0,0,0,0,0,0,$param);
	        else
	        {
	            $_res_qibonus = $_res_qibonus[0];
	            $awardday->AwarddailyUpdate($ID,0,0,0,0,0,0,0,0,0,0,0,$param);
	        }
	        
	        //2018-5-6 激活时才更新感恩信息
	        $positionOBJ = new Positionality();
	        $positionRes = $positionOBJ->PositionQuery($user_id);
	        $positionRes = $positionRes[0];
	        if($positionRes["treeplace"]==1)
	        {
	            $positionOBJ->updateGanenInfo($positionRes["ID"]);
	        }
            
	        //奖金处理等系列操作
	        $this->audit_member_open($ID, $openid);//the most import logic module
	        return true;
	    } 
	    return false;
	}
	
	//用户升级，页面直接调用
	public function UserUpdate()
	{
	    $_session_user = Session::get(USER_SEESION);
	    $_resdata = array();
	    $_user_id = $_session_user["userId"];
	    $_point = new User_point();
	    $_pointres = $_point->PointQuery($_user_id);
	    $_details = new User_details();
	    $_detailsres = $_details->DetailsQuery($_user_id);
	
	    $_resdata["userId"] = $_session_user["userId"];
	    $_resdata["user_level"] = $_detailsres[0]["user_level"];
	    $_resdata["registpoint"] = $_pointres[0]["regist_point"];
	
	
	    // 向V层传数据
	    $this->assign('pass_data', $_resdata);//真正传递的是前面那个变量，这也是html中可以使用的
	
	    // 取回打包后的数据
	    $htmls = $this->fetch();
	    return $htmls;
	}
	
	//用户升级,参数2是目标等级， 参数3是当前等级和目标等之间注册资金的差值
	public function updateUserOpt($user_id, $level, $cost_money, $minor_pwd)
	{
	    $resdata = array();
	    $resdata["success"] = false;
	    $_session_user = Session::get(USER_SEESION);
	    if(empty($_session_user))
	    {
	        return json_encode($resdata);
	    }
	    
	    $userdetails = new User_details();
	    $detailsRES = $userdetails->DetailsQuery($user_id);
	    //var_dump("current_level:".$detailsRES[0]);
	    if(count($detailsRES) > 0)
	        $currentLevel = $detailsRES[0]["user_level"];
	    else 
	        return json_encode($resdata);
	    
	    if($currentLevel == $level)
	        return json_encode($resdata);
	        
	    //var_dump("ll:".$currentLevel);
	    $extern = new External();
	    $beforemoney = $extern->getParam("register_total", $currentLevel, "");
	    $aftermoney = $extern->getParam("register_total", $level, "");
	    $cost_money = $aftermoney - $beforemoney;
	    $_userid = $_session_user["userId"];
	    if($_userid < "1000")
	    {
	        $_userid = "admin";
	    }
        //var_dump($_userid);
	
	    $position = new Positionality();
	    $active = new User_info();
	    //更新新注册用户的details表数据，points表数据，消耗帮助开通用户的注册分
	    $res = $active->UserUpdate($user_id, $_userid, $minor_pwd, $level, $cost_money);
	    
	    //var_dump("res:$res");
	    if($res)
	    {
	        $posinfo = $position->PositionQuery($user_id); //待开通的网络结构信息
	        $ID = $posinfo[0]["ID"];
	        $posinfo = $position->PositionQuery($_userid); //帮助开通的网络结构信息
	        $openid = $posinfo[0]["ID"];
	        $base_gushu = $posinfo[0]["gushu"];
	        //更新新注册用户的网络结构表positionality表数据，用户等级，开通人，开通时间
	        $res=$position->updateStatusBY($ID, $level, $cost_money, $base_gushu);
	        
	        //开通时最先增加一条收入记录，在人每天表，用于计算收支比时的数据源
	        $paramOBJ = new External();
	        $param = $paramOBJ->getParam("register_total", $level, "");
	        //var_dump("income:".$param);
	        $awardday = new Award_daytime();
	        $_res_qibonus = $awardday->AwarddailyQuery($ID);
	        if(count($_res_qibonus) < 1)
	            $awardday->AwarddailyInsert($ID,0,0,0,0,0,0,0,0,0,0,0,$cost_money);
            else
            {
                //$_res_qibonus = $_res_qibonus[0];
                //changed by Gavin start model11
                //$awardday->AwarddailyUpdate($ID,0,0,0,0,0,0,0,0,0,0,0,$param);
                $awardday->AwarddailyUpdate($ID,0,0,0,0,0,0,0,0,0,0,0,$cost_money);
                //changed by Gavin end model11
            }
            
            //奖金处理等系列操作----针对用户升级
            $this->audit_member_update($ID, $openid, $cost_money);//the most import logic module
	        
            $userupdate = new Userupgrade_record();
            
            $userupdateRES = $userupdate->UpgradeInsert($user_id, $currentLevel, $level);
            
            $resdata["success"] = true;
            return json_encode($resdata);
	    }
	    else 
	        return json_encode($resdata);
	    
	}
	
	//获取当前节点的孩子节点信息，如果已经有了两个子节点则返回false，已经有了左孩子，但是不存在任何直推节点，则返回-1
	public function getNodeChild($id)
	{
	    $_resdata = array();
	    $_resdata["success"] = 1;
	
	    //在用户网络结构图中插入数据,检测当前父节点是否已经存在两个子节点
	    $position = new Positionality();
	    $position_res = $position->PositionQuery($id);
	    if($position_res[0]["leftchild"] != 0 && $position_res[0]["rightchild"] != 0)
	    {
	        $_resdata["success"] = 0;
	        return json_encode($_resdata);
	    }
	    
	    //当前节点尚未开通
	    if($position_res[0]["status"] < 1 )
	    {
	        $_resdata["success"] = 2;
	        return json_encode($_resdata);
	    }
	    
	    //左右区都没有注册，则可以正常注册
	    if($position_res[0]["leftchild"] == 0 && $position_res[0]["rightchild"] == 0)
	    {
	        $_resdata["success"] = 1;
	        return json_encode($_resdata);
	    }
	    
	    //检查当前节点直接左区已经注册，且整个左区不存在直推的节点，则返回-1
	    if(!$this->getDirectLeft($id))
	    {
	        $_resdata["success"] = -1;
	        return json_encode($_resdata);
	    }
	    
	    return json_encode($_resdata);
	}
	
	//检测是否有左子孙，如果有，是否存在直接推荐的子孙，如果有，该子孙是否激活
	public function getDirectLeft($id)
	{
	    $detailsOBJ = new User_details();
	    $resDetails = $detailsOBJ->RecommanderQuery($id);
	    if(count($resDetails) < 1)
	        return 0;
	    ////var_dump("recmmand:".$resDetails[0]["ID"]."re:".$id);
	    $positionOBJ = new Positionality();
	    $currentID = $positionOBJ->PositionQuery($id);
	    if($currentID[0]["leftchild"] == 0)
	    {
	        return 0;
	    }
	    
	    $currentID = $currentID[0]["ID"];//获取auto_id
	    $currentID = (string)($currentID);
	    foreach ($resDetails as $position)
	    {
	        ////var_dump("position:".$position["ID"]);
	        $resPos = $positionOBJ->PositionQuery($position["ID"]);//
	        $status = $resPos[0]["status"];
	        $resPos = $resPos[0]["json"];
	        
	        if($status < 1) //如果该节点没激活，则直接看下一个
	            continue;
	        if(strpos($resPos, (string)($currentID)) != false || strcmp($resPos, $currentID) == 0)
	        {
	            return 1;
	        }
	    }
	    return 0;
	}
	
	//查看当前登录用户的节点是否具有权限查看当前的参数1的节点；通过检查其的所有子孙节点中，是否包含参数1这个节点
	public function checkNodeChild($id)
	{
	    $_resdata = array();
	    $_resdata["success"] = true;
	    $_session_user = Session::get(USER_SEESION);
	    $_userid = $_session_user["userId"];
	    $_userid = $_session_user["userId"];
	    if($_userid < "1000")
	    {
	        return json_encode($_resdata);
	    }
	
	    //在用户网络结构图中插入数据,检测当前父节点是否已经存在两个子节点
	    $position = new Positionality();
	    $position_res = $position->PositionQuery($id);
	    if(count($position_res) < 1)
	    {
	        $_resdata["success"] = false;
	        return json_encode($_resdata);
	    }
	    $nodejson = $position_res[0]["json"];
	    $_session_user = Session::get(USER_SEESION);
	    $_userid = $_session_user["userId"];
	    $position_res = $position->PositionQuery($_userid);
	    if(count($position_res) < 1)
	    {
	        $_resdata["success"] = false;
	        return json_encode($_resdata);
	    }
	    $loginjson = $position_res[0]["json"];
	    
	    if(strcmp($loginjson,"")==0 || strpos($nodejson,$loginjson) !== false)
	        $_resdata["success"] = true;
	    else 
	        $_resdata["success"] = false;
	
	        return json_encode($_resdata);
	}
	
	//查看当前登录用户的节点是否具有权限查看当前的参数1的节点；通过检查其的所有子孙节点中，是否包含参数1这个节点
	public function checkNodeParent($id)
	{
	    $_resdata = array();
	    $_resdata["success"] = true;
	    $_session_user = Session::get(USER_SEESION);
	    $_userid = $_session_user["userId"];
	    $_userid = $_session_user["userId"];
	    if($_userid < "1000" && ($id < "1000" || $id == "admin"))
	    {
	        $_resdata["success"] = true;
	        $_resdata["cur_id"] = "1";
	        return json_encode($_resdata);
	    }
	    if($_userid < "1000")
	    {
	        $position = new Positionality();
    	    $position_res = $position->PositionQuery($id);
    	    
    	    if(count($position_res) < 1)
    	    {
    	        $_resdata["success"] = false;
    	        return json_encode($_resdata);
    	    }
    	    
    	    $position_res = $position->PositionQueryByID($position_res[0]["parent"]);
    	    if(count($position_res) < 1)
    	    {
    	        $_resdata["success"] = false;
    	        return json_encode($_resdata);
    	    }
    	    $parentID = $position_res[0]["user_id"];
    	    $_resdata["success"] = true;
    	    $_resdata["cur_id"] = $parentID;
	        return json_encode($_resdata);
	    }

	    $position = new Positionality();
	    $position_res = $position->PositionQuery($id);
	    
	    if(count($position_res) < 1)
	    {
	        $_resdata["success"] = false;
	        return json_encode($_resdata);
	    }
	    
	    $position_res = $position->PositionQueryByID($position_res[0]["parent"]);
	    if(count($position_res) < 1)
	    {
	        $_resdata["success"] = false;
	        return json_encode($_resdata);
	    }
	    $parentID = $position_res[0]["user_id"];
	    $nodejson = $position_res[0]["json"];
	    $_session_user = Session::get(USER_SEESION);
	    $_userid = $_session_user["userId"];
	    $position_res = $position->PositionQuery($_userid);
	    if(count($position_res) < 1)
	    {
	        $_resdata["success"] = false;
	        return json_encode($_resdata);
	    }
	    $loginjson = $position_res[0]["json"];
	     
	    if(strcmp($loginjson,"")==0 || strpos($nodejson,$loginjson) !== false)
	    {
	        $_resdata["success"] = true;
	        $_resdata["cur_id"] = $parentID;
	    }
        else
            $_resdata["success"] = false;

        return json_encode($_resdata);
	}
	
	//修改股价
	public function change_gujia($use_gujia)
	{
	    $awardOBJ = new Awardopt();
	    $res = array();
	    $res["success"] = false;
	    $use_gujia = $awardOBJ->_wei2($use_gujia);
	    if($use_gujia > 1 && $use_gujia < 2)
	    {
	        $gpSetOBJ = new Gp_set();
	        $gpsetRES = $gpSetOBJ->GpSetQuery();
	        $gpsetRES = $gpsetRES[0];
	        $currentGujia = $gpsetRES["now_price"];
	        if($currentGujia >= $use_gujia)
	        {
	            return json_encode($res);
	        }
	                 
            $gpSetOBJ->GpSetUpdate(-1, $use_gujia);
             
            $gpOnsaleOBJ = new Gp_onsale();
            $okid2 = $gpOnsaleOBJ->GponsaleChangeStatus(2);//$gponsale->GponsaleUpdate($salers["AUTO_ID"], -1, -1, -1, -1, 2, -1);//$gponsale->where('status=1')->save($data4);
            $okid2 = $okid2 && $gpOnsaleOBJ->GponsaleInsert($use_gujia, $gpsetRES["gp_qfhl"], 0, 0, 1, 0);
            
            //更新所有会员的股额,获取所有有效用户，并剔除管理员，虚拟根节点
            $member = new Positionality();
            $paramOBJ = new External();
            
            $frs = $member->getAllLegUser();//$member->where($map5)->field('id,user_id,gushu,bz5')->order('id ASC')->select();
            if(is_array($frs) && !empty($frs)){
                $ok = $member->updateGushuByArray(0, 1);
                foreach($frs as $vo){
                    //var_dump($vo["ID"]);
                    $gue = $vo['gushu'] * $use_gujia;
                    $curID = $vo['ID'];
                    $futouJine = $paramOBJ->getParam("register_total", $vo["status"], "") * $paramOBJ->getParam("share_proportion", $vo["status"], "") * 4 /100;
                    //var_dump("futou 所需金额:".$futouJine);
                    if($gue >= $futouJine) //reg_money*配股比例*4
                        $this->futou($curID, $futouJine); //reg_money*配股比例*4-reg_money
            
                    if(!$ok){
                        //var_dump('ERROR : Adminopt.php on line:'.__LINE__);
                        //$this->error('更新会员ID为'.$vo['ID'].'数据错误！');
                    }
                }
                $res["success"] = true;
                return json_encode($res);
            }
	    }
	    elseif($use_gujia == 2)
	    {
	        $gpSetOBJ = new Gp_set();
	        $gpsetRES = $gpSetOBJ->GpSetQuery();
	        $gpsetRES = $gpsetRES[0];
	        
	        $gpOnsaleOBJ = new Gp_onsale();
	        $okid2 = $gpOnsaleOBJ->GponsaleChangeStatus(2);//$gponsale->where('status=1')->save($data4);
	        $okid2 = $okid2 && $gpOnsaleOBJ->GponsaleInsert(1, 2*$gpsetRES["gp_qfhl"], 0, 0, 1, 0);
	        
	        $this->chaifen_act($gpsetRES,0);//
	    }else 
	    {
	        return json_encode($res);
	    }
	    
        $res["success"] = true;
	    return json_encode($res);
	}
	
	
	
	////****************************************华丽分割线**************************************************
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
        //
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

    public function getTest()
    {
        //echo "function test";
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
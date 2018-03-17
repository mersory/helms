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
use app\trigger\controller\External;
use app\common\model\User_details;
use app\common\model\Historical_price;
use app\common\model\Gp_onsale;
use app\common\model\Gp_set;
use app\common\model\Award_record;
use app\common\model\Award_daytime;
use think\Session;

class Adminopt extends Controller
{
    public function index()
    {
        echo "class Adminopt index";
        $strSRC="121-421-5-12";
        $pos = strrpos($strSRC,'-');
        $strSRC = substr($strSRC,0, $pos);
        while ( $pos != false ){            
            $pos = strrpos($strSRC,'-');
            if($pos == false)
                $tmp = $strSRC;
            else
                $tmp = substr($strSRC, $pos+1, strlen($strSRC));
            $strSRC = substr($strSRC,0, $pos); 
            echo $tmp;
        }
        
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
        echo $user->isUserExist("100045");
        $extern = new External();
        $extern->index();
        echo $extern->_auto_userid();
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
            var_dump($vo["ID"]);
        $position = new Positionality();
        $res = $position->getDirectChildrenByJson(3);
        var_dump($res);
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
        var_dump($_post);
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
            var_dump($_res[$index]);
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
            var_dump($_res[$index]["ID"]);
            var_dump($_res[$index]["user_name"]);
            var_dump($_res[$index]["telphone"]);
            var_dump($_res[$index]["email"]);
            var_dump($_res[$index]["open_time"]);
        }
    }
    
    public function UserApproval()
    {
        echo "tongguo";
    }
    
    //开通会员过程处理2018-02-28
    //参数1是将要开通的userid，参数2是登录的那个人的userid，开通等级
    //本函数被audit_member_open函数调用，在开通过程中，需要本函数处理一些事情，然后会能够顺利完成audit_member_open函数的整个逻辑
    public function _member_open($uid, $open_uid = 0, $lv)  
    {
        $member = new Positionality();//M('member');
        var_dump("_member_open");
        $today = strtotime(date('Y-m-d'));
        $next_time = $today + 86403;
        $ntime = date("Y-m-d H:i:s");
        $rm = 500;//_get_conf('bb_list', 1);//当前等级所需要的注册资金
        $ds = 1;//_get_conf('ds_list', 1);//这个等级对应的几单。
        $bb = 500;//$rm[$lv];
        $ds = 1;//$ds[$lv];
        $bz5_bl = 0.05;//_get_conf('s1', 1);//s1是指配股比例
        $bz3_al = 1;//_get_conf('s2', 1);//s2是指
    
        ////////////////////////////////////////////////////////////////
        //标记感恩奖的ganen_id与ganen_next_id和ganen_next_r_id(新算法)
        ////////////////////////////////////////////////////////////////
        //id就是序号id，不是userid，parent_id是父节点的序号id，reg_money注册资金，treeplace如果是在父节点的左边就是0，反之为1，用户等级
        $new_node = $member->PositionQuery($uid);//$member->where('id='.$uid)->field('id,parent_id,reg_money,treeplace,u_level')->find();
        //var_dump($new_node[0]['user_id']);  
        $state = 1;
        if($new_node[0]['treeplace'] == 1 && $new_node[0]['parent'] != 0)                 //如果增加的节点是右区，则处理
        {
            $state = $member->updateGanenInfo($new_node[0]["ID"]);
            if(!$state)
            {
                $this->error('ERROR : Adminopt.php on line:'.__LINE__);
                return false;
            }
            //var_dump($state);
        }
        
        		
		$data = array();

        $user_id = $new_node[0]['user_id'];
        $userdetails = new User_details();
        var_dump($user_id);
        //var_dump($user_id);
        $state = $userdetails->DetailsUpdate($user_id, -1, -1, -1, -1, $ntime, -1, -1, -1);
        if(!$state)
            {
                $this->error('ERROR : Adminopt.php on line:'.__LINE__);
                return false;
            }
        //var_dump($state);
		$status = 1;
		$openid = $open_uid;//当前登录的用户id，与网络结构和推荐结构无关
		//var_dump("openid:");
		//var_dump($openid);
		$fenh_time =  date("Y-m-d H:i:s",strtotime("+1 day"));//
		//var_dump("fenh_time:");
		//var_dump($fenh_time);
		$state = $member->updateStatus($new_node[0]["ID"], $status, $openid, $fenh_time);
		if(!$state)
		{
		    $this->error('ERROR : Adminopt.php on line:'.__LINE__);
		    return false;
		}
		//var_dump($state);
		/*if ($open_uid > 0) {//根据id获取userid
			$data['open_userid'] = cy_get_userid($open_uid);
		}*/

		//更新股价表
		//bz5是总股额，$bb是注册资金； 总股额是注册资金*配股比例
		//$data['bz5'] = $bb * $bz5_bl[$lv] / 100 ;
		$gujia = new Historical_price();
		$data['bz5'] = 450 ;
		$new_gujia = $gujia->HistoricalpriceQueryByTiem("2017-09-04 00:00:05", $ntime);
		$now_gujia = number_format($new_gujia[0]["share_price"], 2, '.', '') / 100;//获取当前股价
		$state = $gujia->HistoricalpriceInsert($now_gujia);
		if(!$state)
		{
		    $this->error('ERROR : Adminopt.php on line:'.__LINE__);
		    return false;
		}
		//var_dump($state);
		//股额除于股价，取整
		//$data['gushu'] = floor($data['bz5'] / $now_gujia);
		//7和10要放在配置参数，最大静态和最大动态倍数，这个是通过参数列表获取的
		//更新用户的point表
		$user_point = new User_point();
		$shengyu_jing = 7 * $new_node[0]['status'] * 500;
		$shengyu_dong = 10 * $new_node[0]['status'] * 500;
		$state = $user_point->remainPointUpdate($user_id, $shengyu_jing, $shengyu_dong);
		if(!$state)
		{
		    $this->error('ERROR : Adminopt.php on line:'.__LINE__);
		    return false;
		}
		//var_dump("_member_open action success:");
		//var_dump($state);
		return $state;
	    
    }
    
    //开通会员-----后台开通，前台传入的勾选的所有的需要开通的ID号
    public function audit_member_open($id, $openid = 1) {
        $today = date('Y-m-d H:i:s');
        $member = new Positionality();
        $award = new Awardopt();
        $node = $member->PositionQueryByID($id);
        $vo = $node[0];
        $is_open = $this->_member_open($vo['ID'], $openid, $vo['u_level']);
        
        if ($is_open) {
            //判断是否拆分
            $judge = $this->judge_chaifen($vo['ID']);
            
            //更新推荐人数
            //更新直推的那个人的推荐人数
            //$member->where('id='.$vo['re_id'])->setInc('re_nums');
            $userid = $vo[0]["user_id"];
            $details = new User_details();
            $detailinfo = $details->DetailsQuery($userid);
            $recommonder = $detailinfo[0]["recommender"];
            $details->increasReNum($recommonder, 1);
            
            //更新整个re_path路径上所有人的推荐人数
            //$member->where('id IN(0'.$vo['re_path'].'0) AND is_pay>0')->setInc('repath_ds');//更新推荐路径上所有人的repath_ds值
            while($recommonder != 0)
            {
                $details->increasRePathDS($recommonder, 1);
                $detailinfo = $details->DetailsQueryByAutoId($recommonder);
                $recommonder = $detailinfo[0]["recommender"];
            }
            
            //更新左右区uid
            //$member->where('id='.$vo['parent_id'])->setField('t'.$vo['treeplace'].'_uid', $vo['id']);
            //单数和奖金统计
            //$member->where('id IN(0'.$vo['p_path'].'0) AND is_pay>0')->setInc('sum_yj', $vo['reg_money']);
            $award->tree2ds_tongji($vo['p_path'], $vo['treeplace'], $vo['danshu']); //看函数内部

            $award->bonus_tongji($vo['id']); //奖金统计 
             

        } else {
            $this->error('开通失败！');
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
	    $ok_money = ($xinzeng_sale[0]["status"] -4 )* 500;//status的值为5表示第1级别，为6表示第二级别，以此类推
	    //$gp = $gpset->where('id=1')->find();//存放公司股票相关的，只会有一条
	    $gp = $gpset->GpSetQuery();
	   	var_dump($xinzeng_sale[0]["user_id"]);
	    
	    //更新产品交易记录，deal_info表
	    $deal = new Deal_info();
	    $okid = $deal->DealinfoInsert( $xinzeng_sale[0]["user_id"], 1, $ok_money,$xinzeng_sale[0]["gushu"], 
	                                   3.14, "details",1, $gp[0]["now_price"]);
	    //$okid = $this->gptobuy_add($xinzeng_sale,$gp['now_price']);
	    if(!$okid){
	        $this->error('更新静态数据错误1'.$xinzeng_sale[0]['user_id']);
	        return false;
	    }
	    
	    
	    //gponsale这个表没有
	    $buycount2 = $gponsale->GponsaleQueryByStatus();//M('gponsale')->where('status = 1')->field('ok_nums')->find();
	    $buycount = $buycount2['ok_nums'];
	    $salers = $gponsale->GponsaleQueryByStatus();;//$gponsale->where('status=1')->field('snums,sy_nums,status,user_id')->find();
	    $update_buycount = $xinzeng_sale[0]['gushu']+$buycount;//这个人新买的股数加上之前已经累计的股数
	
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
	    if(count($salers)){
	        $ok = $gponsale->GponsaleInsert($gp[0]["now_price"], $xinzeng_sale[0]["gushu"], $buycount, $ok_money, 1, 0); //$this->gponsale_add($gp);//插入一条出售记录
	        if(!$ok){
	            $this->error('更新静态数据错误2'.$xinzeng_sale[0]['user_id']);
	            $this->error('ERROR : Adminopt.php on line:'.__LINE__);
	            return false;
	        }	
	        $salers = $gponsale->GponsaleQueryByStatus();;//$gponsale->where('status=1')->field('snums,sy_nums,status,user_id')->find();
	        $update_buycount = $xinzeng_sale[0]['gushu']+$buycount;	       
	    }
	    
	    //新买入了
	    if($update_buycount){      
	        //若当前累计的股数<当前期数的股数，则更新当前累计的股数
	        if($buycount < $salers['snums']){	            
	            $okid = $gponsale->GponsaleUpdate($salers["AUTO_ID"],-1, $update_buycount, $buycount, $ok_money);	            
	            if(!$okid){
	                $this->error('ERROR : Adminopt.php on line:'.__LINE__);
	            }
	            return 1;
	        }else{
	            $pre_gujia = 1.5;//cy_get_gpset('now_price');获取前面的最近一次的股价
	            $now_gujia = $pre_gujia + 0.01;
	
	            //当股价大于1.99时，要进行拆分，把等于号去掉
	            if($now_gujia > 1.99){        //拆分
	                $this->chaifen_act($gp[0],$xinzeng_sale[0]['gushu']);//后面再讨论
	                
	                
	            }else{        //不拆分
	                $data1 = array();
	                $data1['qishu'] = $gp[0]['qishu'] + 1;
	                $data1['now_price'] = $now_gujia;
	                $ok = $gpset->GpSetUpdate($data1['qishu'], $data1['now_price']);//$gpset->where('id=1')->save($data1);
	                if(!$ok){
	                    $this->error('ERROR : Adminopt.php on line:'.__LINE__);
	                }
	                $gp = $gpset->GpSetQuery();
	                $gp = $gp[0];
	
	                $data4 = array();   //将出售完的股状态进行变更
	                $data4['status'] = 2;
	                $okid2 = $gponsale->GponsaleUpdate($salers["AUTO_ID"], -1, -1, -1, -1, 2, -1);//$gponsale->where('status=1')->save($data4);
	                if(!$okid2){
	                    $this->error('ERROR : Adminopt.php on line:'.__LINE__);
	                }
	                //unset($data4);
	
	
	                //增加一条公司出售
	                $data = array();
	                $data['stype'] = $gp['qishu'];
	                //$data['uid'] = 0;
	                //$data['user_id'] = 'system';
	                $data['sprice'] = $gp['now_price'];
	                //$data['sprice_m'] = $gp['now_price'] * $gp['up_price'];
	                $data['snums'] = $gp['gp_qfhl'];//只有拆分了才会翻倍
	                //$data['sy_nums'] = $gp['gp_qfhl'] * $gp['qishu'] - $gp['gp_zxsl'];
	                $data['ok_nums'] = $xinzeng_sale[0]['gushu'];
	                $data['get_money'] = 0;
	                $data['ctime'] = time();
	                $data['status'] = $gp['s_isopen'];
	                $data['uptime'] = 0;
	                $ok = $gponsale->GponsaleUpdate($salers["AUTO_ID"], $gp['now_price'], $update_buycount, $buycount, $data['get_money'], $gp['s_isopen']);//$gponsale->add($data);
	                //unset($data);
	                //unset($data1);
	                if(!$ok){
	                    $this->error('ERROR : Adminopt.php on line:'.__LINE__);
	                }
	                
	                //更新所有会员的股额
	                $map5 = array();
	                $map5['is_pay'] = array('gt',0);
	                #$map5['pay_gujia'] = array('neq',$gp['now_price']);
	                $map5['id'] = array('gt',1);//需要保证管理员不参与，id=1表示管理员
	                $frs = $member->getAllLegUser();//$member->where($map5)->field('id,user_id,gushu,bz5')->order('id ASC')->select();
	                foreach($frs as $vo){
	                    $gue = $vo['gushu'] * $gp['now_price'];
	                    $curID = $vo['ID'];
	                    $ok = $member->updateGushu($curID, $gue);//$member->where($map6)->save($data5);
	                    if(!$ok){
	                        $this->error('更新会员ID为'.$vo['ID'].'数据错误！');
	                    }
	                }
	
	                return 2;
	            }
	        }
	    }else{
	        $this->error('拆分错误.');
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
	    $ok = $gpset->GpSetUpdate(-1, $now_gujia, -1, -1);
	
	    $okid3 = $gponsale->GponsaleChangeStatus(2);
	    if(!$okid3){
	        $this->error('ERROR : Adminopt.php on line:'.__LINE__);
	    }
	    
	    //增加一条公司出售信息
	    $gp_new = $gpset->GpSetQuery();
	    $gp_new = $gp_new[0];
	   
	    //$ok = $gponsale->add($data);
	    var_dump("now_price:");
	    var_dump($gp_new['now_price']);
	    var_dump("gp_qfhl:");
	    var_dump( $gp_new['gp_qfhl']);
	    var_dump("xinzeng_sale_gushu:");
	    var_dump($xinzeng_sale_gushu);
	    $ok = $gponsale->GponsaleInsert($gp_new['now_price'], $gp_new['gp_qfhl']*2, $xinzeng_sale_gushu, 500, 1, -1);
	    if(!$ok){
	        $this->error('ERROR : Adminopt.php on line:'.__LINE__);
	    }
	    
	    $frs = $member->getAllLegUser();
	    foreach($frs as $vo){
	        //$ok = $member->where('id='.$vo['id'])->save($data6);
	        //bz5是股额，总股额永远都是通过股数乘于股价得到的，
	        $ok = $member->updateGushu($vo['ID'], $vo['gushu']*2, 2*$vo['gushu']*$now_gujia, $vo['cf_count'] + 1);
	        if(!$ok){
	            $this->error('ERROR : Adminopt.php on line:'.__LINE__);
	        }
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
	public function futou($id,$futou_money){
	    //更新member表
	    $award = new Award_record();//D('Award');//操作奖金
	    $deal_info = new Deal_info();
	    $member = new Positionality();//M('member');
	    $gponsale_obj = new Gp_onsale();//M('gponsale')->where('status=1')->find();
	    $gponsale = $gponsale_obj->GponsaleQueryByStatus();
	    $gptobuy = new Deal_info();//M('gptobuy');
	    $gp = new Gp_set();//M('gpset')->where('id=1')->find();
	    $_res_pgset = $gp->GpSetQuery();
	    $res_set = $gp->GpSetQuery();
	     
	    //更新member相关数据
	    $data = array();
	    $vo = $member->PositionQueryByID($id); //>where('id='.$id)->field('id,user_id,reg_money,bz5,bz6,pay_gujia,shengyu_jing,gushu,u_level,p_path,treeplace,danshu')->find();
	    $vo = $vo[0];
	    $now_gujia = $_res_pgset[0]["now_price"];//M('gpset')->where('id=1')->field('now_price')->find();
	    $bl_peigu = 40;//cy_get_conf('s1');//1星是40， 2星是45，后面会除于100
	    $ss = $vo['status'];
	    
	    $points = new User_point();
	    $_res_points = $points->PointQuery($id);
	    $_res_points = $_res_points[0];
	    $wanneng_money = $futou_money - $vo['status'] * 500;
	    $data['bz6'] = $_res_points["universal_point"] + $wanneng_money;                                        //更新万能分
	    $data['bz5'] = $vo['status'] * 500 * $bl_peigu/100;                                //更新股额
	    $data['shengyu_jing'] = $_res_points['shengyu_jing'] - $wanneng_money;                      //更新剩余静态奖金额度
	    $data['pay_gujia'] = $now_gujia;
	    $data['gushu'] = floor($data['bz5'] / $now_gujia);//只有一开始和升级是通过股额计算股数，其他时候都是通过股数计算股额      //更新股数
	    $ok = $member->updateGushu($id, $data['gushu'], $data['bz5']);//>where('id='.$id)->save($data);
	    $ok = $ok && $points->PointUpdate($id, -1, -1, -1, -1, $data['bz6'], -1,-1,-1, $data['shengyu_jing']);
	    $ok = $ok && $gponsale_obj->GponsaleUpdate($id, $data['pay_gujia']);
	    if(!$ok){
	        $this->error('复投数据第1部分更新失败id='.$id);
	        return false;
	    }
	     
	    //************************
	    //这部分还没改写
	    //更新奖金，5表示的就是什么奖，这里是静态奖
	    $this->_in_bonus($vo['ID'], $vo['user_id'], 5, $wanneng_money);                    //将静态奖金录入
	    $awardopt = new Awardopt();
	    $awardopt->tree2ds_x_tongji($vo['json'], $vo['treeplace'],$vo['status'] * 500);
	    $awardopt->bonus_tongji($vo['ID'],1);                                                  //复投所有奖金要重新计算
	    
	    //*************************
	    
	    $vo = $member->PositionQueryByID($id);//>where('id='.$id)->field('id,user_id,reg_money,bz5,bz6,pay_gujia,shengyu_jing,gushu,u_level')->find();
	    $vo = $vo[0];
	    //更新出售股数
	    $new_gushu = $gponsale['ok_nums'] + $vo['gushu'];
	    if($new_gushu){
	        //若当前累计的股数<当前期数的股数，则更新当前累计的股数
	        if($gponsale['ok_nums'] < $gponsale['snums']){
	            $okid=$deal_info->DealinfoInsert($id, $vo['gushu']*$now_gujia, $vo['gushu'], -1, -1, -1, -1, $now_gujia);//$this->gptobuy_add($vo,$now_gujia);
	            if(!$okid){
	                $this->error('ERROR : Adminopt.php on line:'.__LINE__);
	            }
	            $okid =  $okid = $gponsale_obj->GponsaleUpdate( $id,-1,$gponsale['snums'],$new_gushu,$vo['status']*500 );//$this->gponsale_update($gp,$gponsale['snums'],$vo['reg_money'],$new_gushu);
	            if(!$okid){
	                $this->error('ERROR : Adminopt.php on line:'.__LINE__);
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
	                    $this->error('ERROR : Adminopt.php on line:'.__LINE__);
	                }
	
	                $data1 = array();   //将出售完的股状态进行变更
	                $data1['status'] = 2;
	                $okid2 = $gponsale_obj->GponsaleChangeStatus(2);//M('gponsale')->where('status=1')->save($data1);
	                if(!$okid2){
	                    $this->error('ERROR : Adminopt.php on line:'.__LINE__);
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
	                $ok = $gponsale->GponsaleInsert($gp_new['now_price'], $gp_new['gp_qfhl']*2, $vo['gushu'], 0, 1, -1);
	                if(!$ok){
	                    $this->error('ERROR : Adminopt.php on line:'.__LINE__);
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
	                        $this->error('更新会员ID为'.$vo['id'].'数据错误！');
	                    }
	                }
	
	                return 2;
	            }
	        }
	    }else{
	        $this->error('拆分错误.');
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
	        $award_record = new Award_record();
	        $_res_award_record = $award_record->AwardRecordInsert($myids, "万能奖", $get_money, $fuserid);
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
	        $award_record->AwardRecordInsert($myids, "重复消费分", $get_money, $fuserid, $minfo);
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
	                    $this->error('ID为'.$vo['id'].'复投数据错误！');
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
	        $this->error($model->getError());
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
	        var_dump($_res);
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
            echo $index;
            var_dump($_res[$index]["user_id"]);
            var_dump($_res[$index]["deal_count"]);
            var_dump($_res[$index]["current_profit"]);
            var_dump($_res[$index]["count_time"]);
            echo "<br/>";
        }
        //
        echo "----------------------------------------------------------------------";
        $_deal = new Deal_info();
        $_res = $_deal->DealQueryByTime($_begintime, $_endtime);
        for ($index = 0; $index < count($_res); $index++)
        {
            echo $index;
            var_dump($_res[$index]["user_id"]);
            var_dump($_res[$index]["deal_time"]);
            var_dump($_res[$index]["deal_type"]);
            var_dump($_res[$index]["deal_sum"]);
            var_dump($_res[$index]["details"]);
            echo "<br/>";
        }
    }

    public function getTest()
    {
        echo "function test";
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
        echo $_user_id;
        $_user_point = new User_point();
        $_res = $_user_point->PointQuery($_user_id);
        for ($index = 0; $index < count($_res); $index++)
        {
            echo $index;
            var_dump($_res[$index]["ID"]);
            var_dump($_res[$index]["shares"]);
            var_dump($_res[$index]["bonus_point"]);
            var_dump($_res[$index]["regist_point"]);
            var_dump($_res[$index]["re_consume"]);
            var_dump($_res[$index]["universal_point"]);
            var_dump($_res[$index]["re_cast"]);
            var_dump($_res[$index]["remain_point"]);
            var_dump($_res[$index]["blocked_point"]);
            echo "<br/>";
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
            echo $index;
            var_dump($_res[$index]["user_id"]);
            var_dump($_res[$index]["point_change_type"]);
            var_dump($_res[$index]["point_change_sum"]);
            var_dump($_res[$index]["point_change_time"]);
            echo "<br/>";
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
            echo $index;
            var_dump($_res[$index]["user_id"]);
            var_dump($_res[$index]["withdrawal_type"]);
            var_dump($_res[$index]["withdraw_sum"]);
            var_dump($_res[$index]["apply_time"]);
            var_dump($_res[$index]["withdrawal_status"]);
            var_dump($_res[$index]["verifier_id"]);
            var_dump($_res[$index]["approve_time"]);
            var_dump($_res[$index]["to_account_time"]);
            var_dump($_res[$index]["point_consume"]);
            echo "<br/>";
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
            echo $index;
            var_dump($_res[$index]["user_id"]);
            var_dump($_res[$index]["withdrawal_type"]);
            var_dump($_res[$index]["withdraw_sum"]);
            var_dump($_res[$index]["apply_time"]);
            var_dump($_res[$index]["withdrawal_status"]);
            var_dump($_res[$index]["verifier_id"]);
            var_dump($_res[$index]["approve_time"]);
            var_dump($_res[$index]["to_account_time"]);
            var_dump($_res[$index]["point_consume"]);
            echo "<br/>";
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
        var_dump($_inandout->IncomeExpenditureQuery($record_id));
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
        var_dump($_position->PositionQuery($ID));
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
        var_dump($_role->RoleQuery($ID));
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
        var_dump( $_priority->PriorityQuery($ID) );
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
        var_dump($_dealinfo->DealinfoQuery($deal_id));
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
        var_dump($_res);
    }
    
    public function PointTransformInsert($point_id, $user_id, $point_type, $point_change_sum, $point_change_type)
    {
        $_point_transform = new Point_transform_record();
        $_res = $_point_transform->PointTransformInsert($point_id, $user_id, $point_type, $point_change_sum, $point_change_type);
        var_dump($_res);
    }
    

}
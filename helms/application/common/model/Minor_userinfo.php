<?php
namespace app\common\model;

use think\Model;

class Minor_userinfo extends Model
{
    public function index()
    {
        echo 'minor Userinfo';
    }
    
    public function MinorUserinfoQuery($parent)
    {
        $_where = '';
        if (!strcmp("$parent", ""))
        {
            $_where = "parentID != '0'";
        }
        else
        {
            $_where = "parentID = '$parent'";
        }
        
        // var_dump(urlencode($_SERVER['REQUEST_URI']));
        $_user_info = $this->where($_where)
        ->order('parentID asc')
        ->select();
        $count = count($_user_info);
        if ($count < 1)
        {
            return ;
        }
        else
            return $_user_info;
    }
    
    public function MinorUserinfoInsert($parent, $level)
    {
        $_userinfo = $this->MinorUserinfoQuery($parent);
        $num = count($_userinfo);
        $num=str_pad($num,3,"0",STR_PAD_LEFT);   
        $gp_set = new Gp_set();
        $price = $gp_set->GpSetQuery();
        $price = $price[0]["now_price"];
        echo $num;
        echo $parent;
        $minorID = $parent;
        $minorID .=$num;
        echo "minorID:".$minorID;
        $buy_gujia = $price;
        $gue = $level * 500;
        $gushu = $gue / $buy_gujia;
        $opentime=date("Y-m-d H:i:s");
        $last_static_time = $opentime;
        $remain_static = $level * 500 *7;
        $_userinfo = array('ID'=>$minorID,
            'parentID' => $parent,
            'buy_gujia' => $buy_gujia,
            'gue' => $gue,
            'gushu' => $gushu,
            'opentime' => $opentime,
            'last_static_time' => $last_static_time,
            'remain_static' => $remain_static);

        $state = $this->save($_userinfo);
        
        return $state;
    }
    
    public function MinorUserinfoUpdate($minorID, $remain=-1)
    {
        $update_time = date("Y-m-d H:i:s");
        $data = array('remain_static'=>"$remain",
                      'last_static_time'=> $update_time
        );
        $state = $this-> where("ID='$minorID'")
        ->setField($data);
        return $state;
    }
    
    
}
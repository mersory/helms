<?php
namespace app\common\model;

use think\Model;
use phpDocumentor\Reflection\Types\String_;
use app\trigger\controller\External;
use think\session;

class Positionality extends Model
{
    public function index()
    {
        //var_dump("Userdetails");
    }
    
    public function PositionQuery($user_id)//查看当前用户的网络结构
    {
        $_where = '';
        if (strcmp($user_id, ""))
        {
            $_where = "user_id = '$user_id'";
        }
        $_position_info = $this->where($_where)
        ->select();
        $count = count($_position_info);
        if ($count < 1)
        {
            return ;
        }
        return $_position_info;
    }
    
    public function PositionQueryWithLimit($user_id)//查看当前用户的网络结构
    {
        $_where = '';
        if (strcmp($user_id, ""))
        {
            $_where = "user_id = '$user_id'";
        }
        $_position_info = $this->order("fenh_time desc")
                                ->where($_where)
                                ->paginate(25);
        
        return $_position_info;
    }
    
    //获取当前所有的合法的用户，状态必须大于0才是合法的
    public function getAllLegUser()
    {
        $_where = '';
        $_where = "ID != 1 and status > 0";
        $_position_info = $this->where($_where)
        //changed by Gavin start model11
        ->field('status,ID,gushu')
        //changed by Gavin end model11
        ->select();
        $count = count($_position_info);
        if ($count < 1)
        {
            return ;
        }
        return $_position_info;
    }
    
    public function PositionQueryByID($id)//查看当前用户的网络结构
    {
        $_where = '';
        if ($id > 0)
        {
            $_where = "ID = $id";
        }
        $_position_info = $this->where($_where)
        ->select();
        $count = count($_position_info);
        if ($count < 1)
        {
            return ;
        }
        
        return $_position_info;
    }
    
    //增加当前对应列的单数
    public function increasNum($user_id, $lds)
    {
        $_where = '';
        if ($user_id != -1)
        {
            $_where = "ID = '$user_id'";
        }
        
        $state = $this
        ->where($_where)
        ->setInc('lds',$lds);
        
        return $state;
    }
    
    public function updateGanenId($ID, $ganenid)
    {
        $_ganenid = array();
        $_ganenid["ganenid"] = $ganenid;
        $state = $this-> where("ID=$ID")
        ->setField($_ganenid);
        return $state;
    }
    
    public function updateGanenNextId($ID, $ganennextid)
    {
        $_ganen = array();
        $_ganen["ganen_next_id"] = $ganennextid;
        $state = $this-> where("ID=$ID")
        ->setField($_ganen);
        return $state;
    }

    public function updateGanenNextRId($ID, $ganennextrid)
    {
        $_ganen = array();
        $_ganen["ganen_next_r_id"] = $ganennextrid;
        $state = $this-> where("ID=$ID")
        ->setField($_ganen);
        return $state;
    }
    
    //只有新添加的节点是某一个节点的右孩子的时候，才会触发本函数，参数是当前新加的节点的ID号，不是userid号，
    //通过这个函数就可以完全更新新加节点的相应的感恩信息
    public function updateGanenInfo($ID)
    {
        $node = $this->PositionQueryByID($ID);//node是当前新加的子节点,1,2,3这种
        $directParent = $node[0]["parent"];
        $json= $node[0]["json"];
        $preNodeID = 0;
        //本轮for循环，查找节点的ganenid和ganennextid 或者 是 ganenid和ganennextrid
        $strSRC=$json;//1,4,7,9
        //changed by Gavin start model11
        $strSRC = substr($strSRC, 1, strlen($strSRC)-1);
        $strSRC = substr($strSRC, 0, strlen($strSRC)-1);
        //changed by Gavin end model11
        $pos = strrpos($strSRC,',');//返回的是下标，最后一个找到的字符的小标，此处是5
        $strSRC = substr($strSRC,0, $pos);//此处参数三表示的长度，传入$pos正好不需要减去一;结果是1,4,7
        //var_dump("strSRC:".$strSRC);
        while ( $pos != false )
        {
            if($pos == strrpos($json,',') )
            {
                //var_dump("enter".__LINE__."directParent:".$directParent);
                $preNodeID = $directParent;
            }
            
            $pos = strrpos($strSRC,',');
            if($pos == false)
                $tmp = $strSRC;
            else
                $tmp = substr($strSRC, $pos+1, strlen($strSRC));
                
            $strSRC = substr($strSRC,0, $pos);
            //var_dump("tmp:".$tmp."|");
            $curNode = $this->PositionQueryByID($tmp);
            if($curNode[0]["rightchild"] != 0 )
            {
                //var_dump("curNode".$curNode[0]["ID"]);
                //var_dump("preNodeID".$preNodeID);
                if($curNode[0]["leftchild"] == $preNodeID)
                {
                    $this->updateGanenNextId($curNode[0]["ID"], $directParent);
                    $this->updateGanenId($directParent, $curNode[0]["ID"]);
                }
                else if($curNode[0]["rightchild"] == $preNodeID)
                {
                    $this->updateGanenNextRId($curNode[0]["ID"], $directParent);
                    $this->updateGanenId($directParent, $curNode[0]["ID"]);
                }
                break;
            }
            else
            {
                $preNodeID = $curNode[0]["ID"];
                //var_dump("preNodeID".$preNodeID);
            }  
        }
        
        //下面的逻辑更新当前节点的所有后续子节点中第一个存在右孩子的节点
        $childid = $this->PositionQueryByID($directParent);
        $childid = $this->PositionQueryByID($childid[0]["leftchild"]);
       
        while($childid[0]["rightchild"] == 0 && $childid[0]["leftchild"]!=0)
        {
            //每一个词都只需检查左孩子，因为上一句while循环中，如果当前节点有右孩子，则不会进来了，就说明找到了或者结束了
            $childid = $this->PositionQueryByID($childid[0]["leftchild"]);
            if(count($childid) == 0)
            {
                return 0;
            }
        }
        //左右孩子都存在
        if($childid[0]["leftchild"]!=0 && $childid[0]["rightchild"] != 0)
        {        
            $res = $this->updateGanenId($childid[0]["ID"], $directParent);
            $res = $res && $this->updateGanenNextRId($directParent, $childid[0]["ID"]);
            if(!$res)
                return 0;
        }
        return 1;
    }
    
    public function PositionChildByJson($str)//查看当前节点的直系孩子节点,返回用户userid号和在位置表中的对应的编号，例如1，2，3，4，5
    {
        $_where = '';
        if (strcmp($str, ""))
        {
            // $_where = "locate('$str', json) > 0";
            $_where = "json like '%,$str,%'";
        }
        else 
            return;
        $_position_info = $this->where($_where)
        ->select();
        $count = count($_position_info);
        if ($count < 1)
        {
            return ;
        }
        else 
        {
            while($count)
            {
                $_res[$_position_info[$count-1]["user_id"]] = $_position_info[$count-1]["ID"];
                $count--;
            }
        }
         return $_res;
    }

    public function updateStatus($ID, $status, $openid, $fenh_time)
    {
        //var_dump("updateStatus");
        //var_dump($ID);
        //var_dump($openid);
        //var_dump($fenh_time);
        $paramOBJ= new External();
        $bz5 = $paramOBJ->getParam("register_total", $status, "") * $paramOBJ->getParam("share_proportion", $status, "") / 100;
        $gpsetOBJ = new Gp_set();
        $_resGPset = $gpsetOBJ->GpSetQuery();
        $_resGPset = $_resGPset[0];
        $gushu = intval($bz5 / $_resGPset["now_price"]);
        $userstatus = array();
        $userstatus["status"] = $status;
        $userstatus["openid"] = $openid;
        $userstatus["fenh_time"] = $fenh_time;
        $userstatus["gushu"] = $gushu;
        $userstatus["bz5"] = $bz5;
        $state = $this-> where("ID=$ID")
        ->setField($userstatus);
        return $state;
    }
    
    public function updateStatusBY($ID, $status, $cost_money, $base_gushu)
    {
        //var_dump("updateStatus");
        //var_dump($ID);
        $paramOBJ= new External();
        $gpsetOBJ = new Gp_set();
        $_resGPset = $gpsetOBJ->GpSetQuery();
        $_resGPset = $_resGPset[0];
       
        $gushu = $base_gushu + ($cost_money * $paramOBJ->getParam("share_proportion", $status, "") / 100) / $_resGPset["now_price"];
        $bz5 = $gushu * $_resGPset["now_price"];
       
        $userstatus = array();
        $userstatus["status"] = $status;
        $userstatus["gushu"] = $gushu;
        $userstatus["bz5"] = $bz5;
        $state = $this-> where("ID=$ID")
        ->setField($userstatus);
        return $state;
    }
    
    public function updateDuipeng()
    {
        $userstatus = array();
        $day = date("Y-m-d");
        $userstatus["dp_leiji"] = 0;
        $userstatus["fenh_time"] = $day;
        $state = $this-> where("dp_reset_time != '$day'")
        ->setField($userstatus);
        return $state;
    }

    public function getDuiPengInfo($flag)
    {
        $_where = '';
        if($flag)
            $_where = "status > 0 AND ((bq_lds)>0 OR (bq_rds)>0)";
        else 
            $_where = "status > 0 AND ((bq_x_lds)>0 OR (bq_x_rds)>0)";
        $_position_info = $this->where($_where)
        ->select();
        $count = count($_position_info);
        if ($count < 1)
        {
            return ;
        }
        return $_position_info;
    }
    
    //通过编号获取到对应的userid号
    public function getUserIdByID($ID)
    {
        $_where = '';
        if ($ID >= 0)
        {
            $_where = "ID = $ID";
        }
        $_position_info = $this->where($_where)
        ->select();
        $count = count($_position_info);
        if ($count < 1)
        {
            return ;
        }
        return $_position_info[0]["user_id"];
    }
    
    public function getDirectChildrenByJson($str)//查看当前节点的所有孩子节点，包括多次派生的孩子，返回用户id和json子串
    {
        $_where = '';
        if ($str > -1)
        {
            $_where = "json like '%,$str,'";
        }
        else
            return;
        $_position_info = $this->where($_where)
        ->select();
        $count = count($_position_info);
        if ($count < 1)
        {
            return ;
        }
        else
        {
            $_res = array();
            $i=0;
            while($i < $count)
            {
                $_res[$_position_info[$i]["user_id"]] = $_position_info[$i]["user_id"];
                $i++;
            }
            return $_res;
        }
    }
    
    public function getAllChildByJson($str)//查看当前节点的所有孩子节点，包括多次派生的孩子，返回用户id和json子串
    {
        $_res = array();
        $_current_level = 0;
        $_res = $this->getAllChildByJsonWithInFiveLevel($str, $_current_level, $_res);
        return $_res;
    }
    
    public function getAllChildByJsonWithInFiveLevel($str, $current_level, &$_res)//查看当前节点的所有孩子节点，包括多次派生的孩子，返回用户id和json子串
    {
        if($current_level >= 5)
            return;
        
        $_where = '';
        if($str == ',')
        {
            $_where = "json like ','";
            //var_dump($_where);
        }
        else if ($str > -1)
        {
            $_where = "json like '$str'";//此处不需要再去添加逗号“，”，因为调用的时候参数已经添加了
            //var_dump($_where);
        }
        else 
        {
            return;
        }
            
        $_position_info = $this->where($_where)
        ->select();
        $_userinfo = new User_details();
        $_userOBJ = new User_info();
        $count = count($_position_info);
        $current_count = $count;
        if ($count < 1)
        {
            return ;
        }
        else
        {
            while($count)
            {
                $_res[$_position_info[$count-1]["user_id"]]["currentId"] = $_position_info[$count-1]["user_id"];
                $_res[$_position_info[$count-1]["user_id"]]["childrenId"] = $this->getDirectChildrenByJson($_position_info[$count-1]["ID"]);
                $_res[$_position_info[$count-1]["user_id"]]["ID"] = $_position_info[$count-1]["ID"];
                $_res[$_position_info[$count-1]["user_id"]]["json"] = $_position_info[$count-1]["json"];
                $parentID = $this->getUserIdByID($_position_info[$count-1]["parent"]);
                $_res[$_position_info[$count-1]["user_id"]]["parent"] = $parentID;
                $_res[$_position_info[$count-1]["user_id"]]["left"] = $_position_info[$count-1]["leftchild"];
                
                $_res[$_position_info[$count-1]["user_id"]]["lds"] =$_position_info[$count-1]["l_ds"];
                $_res[$_position_info[$count-1]["user_id"]]["rds"] = $_position_info[$count-1]["r_ds"];
                $_res[$_position_info[$count-1]["user_id"]]["sqlds"] = $_position_info[$count-1]["sq_lds"];
                $_res[$_position_info[$count-1]["user_id"]]["sqrds"] = $_position_info[$count-1]["sq_rds"];
                $_user_realname = $_userinfo->DetailsQuery($_position_info[$count-1]["user_id"]);
                $_res[$_position_info[$count-1]["user_id"]]["level"] = $_user_realname[0]["user_level"];
                $_user_realname = $_user_realname[0]["user_name"];
                $_res[$_position_info[$count-1]["user_id"]]["realname"] = $_user_realname;
                
                $isActive = $_userOBJ->getUserstate($_position_info[$count-1]["user_id"]);
                $_res[$_position_info[$count-1]["user_id"]]["status"] = $isActive;

                $strTemp = $str.$_position_info[$count-1]["ID"].",";
                $t = $this->getAllChildByJsonWithInFiveLevel($strTemp, $current_level+1, $_res);
                $count--;
            }
        }
        return $_res;
    }
    
    //查看是否包含当前ID的json，即是否存在子节点，如果存在则返回相应的json，否则返回空
    public function PositionQueryByJson($str)//查看当前用户的网络结构
    {
        $_where = '';
        if (strcmp($str, ""))
        {
           // $_where = "locate('$str', json) > 0";
            $_where = "json like '%,$str,%'";
        }
        $_position_info = $this->where($_where)
        ->select();
        $count = count($_position_info);
        if ($count < 1)
        {
            return ;
        }
        return $_position_info[0]["json"];
    }
    
    public function PositionRoot()//查看当前用户的网络结构
    {
        $_where = '';
        $_where = "json like ','";
        $_position_info = $this->where($_where)
        ->select();
        $count = count($_position_info);
        if ($count < 1)
        {
            return ;
        }
        return $_position_info[0]["user_id"];
    }
    
    public function PositionDel($ID)
    {
        $_where = '';
        if ($ID > 0)
        {
            $_where = "ID = $ID";
        }
       
        $state = $this->where($_where)->delete();
        
        return $state;
    }
    
    public function PositionDelByUserID($user_id)
    {
        $_where = '';
        if (null != $user_id || "" == $user_id)
        {
            $_where = "user_id = '$user_id'";
        }
         
        $state = $this->where($_where)->delete();
    
        return $state;
    }
    
    public function PositionInsertPrev($user_id, $parent)
    {
        $_positioninfo = array();
        $res_return =false;
        if ($parent > 0)
        {
            $_positioninfo["parent"] = $parent;
        }
        $_res = $this->PositionQueryByID($parent);
        if (count($_res) == 1)
        {
            $_json = $_res[0]["json"];
            $_curjson = $this->PositionQueryByJson($parent);
            $_right=1;
            if(!strcmp($_curjson, ""))//当前parent不存在孩子节点
            {
                if(strcmp($_json,"")==0)
                    $_json = "$parent";
                else 
                    $_json = "$_json,$parent";//如果当前不存在，则通过字符串拼接形参新的路径
                $_right = 0;
            }
            else 
            {
                $_json  = $_curjson;
            }
            
            $res_return = $this->PositionInsert($user_id, $_json, $parent, $_right);
            if($res_return)
            {
                $data = array();
                $newID = $this->PositionQuery($user_id)[0]["ID"];
                if($_right == 0)
                {
                    $data["leftchild"] = $newID;
                }
                else 
                {
                    $data["rightchild"] = $newID;
                }
                
                $res_return = $this-> where("ID=$parent")
                                   ->setField($data);
            }
            else
            {
                return false;
            }
        }
        /*------------------2018-05-06此部分代码变更到activ函数中----------------
        if($_right == 1)
        {
            $ID = $this->PositionQuery($user_id);
            $ID = $ID[0]["ID"];
            $this->updateGanenInfo($ID);
        }
        ------------------2018-05-06此部分代码变更到activ函数中----------------*/
            
        return $res_return;
    }
    
    public function PositionInsert($user_id, $json, $parent, $leftchild)
    {
        $_positioninfo = array();
        $_positioninfo["user_id"] = $user_id;

        $_positioninfo["json"] = $json;

        $_positioninfo["parent"] = $parent;

        $_positioninfo["treeplace"] = $leftchild;
      
        $state = $this->save($_positioninfo);
        
        return $state;
    }
    
    
    public function PositionUpdate($ID, $json)
    {
        $_positioninfo = array();
        if ($json > 0)
        {
            $_positioninfo["json"] = $json;
        }
        $state = $this-> where("ID=$ID")
        ->setField($_positioninfo);
        return $state;
    }
    
    public function updateGushu($ID, $gushu=-1, $bz5=-1, $cf_count = 0)
    {
        $_cureent = $this->PositionQueryByID($ID);
        if(count($_cureent) < 1)
        {
            //var_dump("None data".__LINE__);
            return -1;
        }
        
        $_cureent = $_cureent[0];
        //var_dump("gushu:".$gushu);
        //var_dump("bz5:".$bz5);
        //var_dump("cf_count:".$cf_count);
        if($gushu==$_cureent["gushu"] && $bz5==$_cureent["bz5"] && $cf_count==$_cureent["cf_count"])
        {
            //var_dump("Positionality.php the data is complete same".__LINE__);
            return 1;
        }
        else 
            //var_dump("Positionality.php: not the same".__LINE__);
        $_positioninfo = array();
        if ($gushu > 0)
        {
            $_positioninfo["gushu"] = $gushu;
        }
        
        if ($bz5 > 0)
        {
            $_positioninfo["bz5"] = $bz5;
        }

        if ($cf_count > 0)
        {
            $_positioninfo["cf_count"] = $cf_count;
        }
        //var_dump($_positioninfo);
        
        $state = $this-> where("ID='$ID'")
                      ->setField($_positioninfo);
        return $state;
    }
    
    public function updateJiangjin($ID, $gushu=-1, $l_ds=-1, $bq_lds=-1, $sq_lds=-1, $r_ds=-1, $bq_rds=-1, $sq_rds=-1, $l_x_ds=-1, $bq_x_lds=-1, $sq_x_lds=-1, $r_x_ds=-1, $bq_x_rds=-1, $sq_x_rds=-1, $sum_ds=1)
    {
        //var_dump("updateJiangjin");
        $_positioninfo = array();
        if ($gushu >= 0)
        {
            $_positioninfo["gushu"] = $gushu;
        }
        
        if ($l_ds >= 0)
        {
            $_positioninfo["l_ds"] = $l_ds;
        }
        
        if ($bq_lds >= 0)
        {
            $_positioninfo["bq_lds"] = $bq_lds;
        }
        
        if ($sq_lds >= 0)
        {
            $_positioninfo["sq_lds"] = $sq_lds;
        }
        
        if ($r_ds >= 0)
        {
            $_positioninfo["r_ds"] = $r_ds;
        }
        
        if ($bq_rds >= 0)
        {
            $_positioninfo["bq_rds"] = $bq_rds;
        }
        
        if ($sq_rds >= 0)
        {
            $_positioninfo["sq_rds"] = $sq_rds;
        }
        
        if ($l_x_ds >= 0)
        {
            $_positioninfo["l_x_ds"] = $l_x_ds;
        }
        
        if ($bq_x_lds >= 0)
        {
            $_positioninfo["bq_x_lds"] = $bq_x_lds;
        }
        
        if ($sq_x_lds >= 0)
        {
            $_positioninfo["sq_x_lds"] = $sq_x_lds;
        }
        
        if ($r_x_ds >= 0)
        {
            $_positioninfo["r_x_ds"] = $r_x_ds;
        }
        
        if ($bq_x_rds >= 0)
        {
            $_positioninfo["bq_x_rds"] = $bq_x_rds;
        }

        if ($sq_x_rds >= 0)
        {
            $_positioninfo["sq_x_rds"] = $sq_x_rds;
        }
        
        if ($sum_ds >= 0)
        {
            $_positioninfo["sum_ds"] = $sum_ds;
        }
        
        $state = $this-> where("ID=$ID")
        ->setField($_positioninfo);
        return $state;
    }
    
    public function updateStatusSingle($user_id, $status)
    {
        $_session_user = Session::get(USER_SEESION);

        if(empty($_session_user))
        {
            return 0;
        }
        else
        {
            $_userid = $_session_user["userId"];
            if($_userid < "1000")//当前用户是管理员
            {
                $data = array('status'=>$status);
        
                $state = $this-> where("user_id='$user_id'")
                ->setField($data);
        
                return 1;
            }
            else
                return 0;
        }
    }
    
    
}
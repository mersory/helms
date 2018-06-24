<?php
namespace app\common\model;

use think\Model;

class Preference_option extends Model
{
    
    public function PreferenceInfoAllQuery()
    {
        $_where = '';
        $_preferenceinfo = $this->where($_where)->order("update_time desc")->select();
        $count = count($_preferenceinfo);
        if ($count < 1)
        {
            //var_dump("PreferenceInfo not exsist");
            return ;
        }
        return $_preferenceinfo;
    }
    
    public function PreferenceInsert($name, $code, $value, $operator)
    {
        $_preferenceinfo = array();
        if ($name >=0)
        {
            $_preferenceinfo["name"] = $name;
        }
    
        if ($code >=0)
        {
            $_preferenceinfo["code"] = $code;
        }
    
        if ($operator >=0)
        {
            $_preferenceinfo["operator"] = $operator;
        }
         
        if ($value >=0)
        {
            $_preferenceinfo["value"] = $value;
        }
    
        $_preferenceinfo["status"] = 1;
        $t=time();
        $_preferenceinfo["create_time"] = date("Y-m-d H:i:s",$t);
        
        $t=time();
        $_preferenceinfo["update_time"] = date("Y-m-d H:i:s",$t);
    
        $state = $this->save($_preferenceinfo);
       
        return $state;
    }
    
    public function PreferenceUpdate($id,$name, $code, $value, $operator)
    {
        $_preferenceinfo = array();
     if ($name >=0)
        {
            $_preferenceinfo["name"] = $name;
        }
    
        if ($code >=0)
        {
            $_preferenceinfo["code"] = $code;
        }
    
        if ($operator >=0)
        {
            $_preferenceinfo["operator"] = $operator;
        }
         
        if ($value >=0)
        {
            $_preferenceinfo["value"] = $value;
        }
        
        $t=time();
        $_preferenceinfo["update_time"] = date("Y-m-d H:i:s",$t);
    
        $state = $this-> where("id=$id")
        ->setField($_preferenceinfo);
        return $state;
    }
    
    public function PreferenceByIdQuery($id)
    {
        $_where = '';
        if ($id != -1)
        {
            $_where = "id =$id";
        }
        $_preferenceinfo = $this->where($_where)->select();
        $count = count($_preferenceinfo);
        if ($count < 1)
        {
            //var_dump("PreferenceInfo not exsist");
            return ;
        }
        return $_preferenceinfo;
    }
    
    public function PreferenceQueryByCode($code)
    {
        $_where = "code = '$code'";
        $_preference_info = $this->where($_where)->select();
        $count = count($_preference_info);
        if ($count < 1)
        {
            //var_dump("PreferenceQueryByCode CODE :$code not exsist".__LINE__);
            return ;
        }
        return $_preference_info;
    }

    //获取指定CODE的参数值，后续改为从缓存中获取
    public function getPreferenceByCode($code){
        $_res = $this->PreferenceQueryByCode($code);
        if(count($_res) >= 1){
            return $_res[0]['value'];
        }else{
            return "";
        }
    }
    
}
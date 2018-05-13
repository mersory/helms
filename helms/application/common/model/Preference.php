<?php
namespace app\common\model;

use think\Model;

class Preference extends Model
{
    public function PreferenceQueryByCode($code)
    {
        $_where = "code = $code";
        $_preference_info = $this->where($_where)->select();
        $count = count($_preference_info);
        if ($count < 1)
        {
            var_dump("PreferenceQueryByCode CODE :$code not exsist".__LINE__);
            return ;
        }
        return $_preference_info;
    }

    //获取指定CODE的参数值，后续改为从缓存中获取
    public function getPreferenceByCode($code){
        $_res = PreferenceQueryByCode($code);
        if(count($_res) >= 1){
            return $_res[0]['value'];
        }else{
            return "";
        }
    }
    
}
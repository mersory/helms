<?php
namespace app\common\model;

use think\Model;

class Store_area_fee extends Model
{
     /**
     * 根据所在区域运费
     */
    public function StoreAreaFeeByAreaQuery($province,$city,$area){
        $sql = "select * from helms_store_area_fee af left join helms_store_province sp on af.area_id = sp.province_id where province_id in('$province','$province$city','$province$city$area') or province in('$province','$province$city','$province$city$area') order by LENGTH(area_id) desc limit 1";
        
        $res = $this->query($sql);
        return $res;   
    }

    /**
     * 根据插入所在区域运费
     */
    public function StoreAreaFeeInsert($areaId,$type,$fee,$operator){
        $_storeFeeInfo = array();
        if ($areaId >=0)
        {
            $_storeFeeInfo["area_id"] = $areaId;
        }

        if ($type >=0)
        {
            $_storeFeeInfo["type"] = $type;
        }
    
        if ($fee >=0)
        {
            $_storeFeeInfo["fee"] = $fee;
        }
    
        if ($operator >=0)
        {
            $_storeFeeInfo["operator"] = $operator;
        }
        
        $t=time();
        $_storeFeeInfo["create_time"] = date("Y-m-d H:i:s",$t);

        $_storeFeeInfo["update_time"] = date("Y-m-d H:i:s",$t);
    
        $state = $this->save($_storeFeeInfo);
        
        return $state;
    }

    /**
     * 根据所在区域运费
     */
    public function StoreAreaFeeUpdate($areaId,$type,$fee,$operator){
        $_storeFeeInfo = array();

        if ($fee >=0)
        {
            $_storeFeeInfo["fee"] = $fee;
        }
    
        if ($operator >=0)
        {
            $_storeFeeInfo["operator"] = $operator;
        }
        
        $t=time();
        $_storeFeeInfo["update_time"] = date("Y-m-d H:i:s",$t);
    
        $state = $this-> where("area_id='$areaId'")-> where("type='$type'")->setField($_storeFeeInfo);

        return $state;
    }

    /**
     * 根据所在区域运费配置
     */
    public function StoreAreaFeeDelete($areaId,$type,$operator)
    {
       
        $sql = " delete from helms_store_area_fee where area_id='$areaId' and type='$type'";

        $state = $this-> query($sql);

        return $state;
    }
}
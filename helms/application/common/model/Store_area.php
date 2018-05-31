<?php
namespace app\common\model;

use think\Model;

class Store_area extends Model
{    

    /**
     * 查询所有省
     */
    public function StorePorvinceAllQuery()
    {
        $sql = "select * from helms_store_province order by province_id desc";
        $res = $this->query($sql);
        return $res;
    }

    /**
     * 根据省查询所有市
     */
    public function StoreCityByProvinceIdQuery($provinceId)
    {
        $sql = "select * from helms_store_city where parent_id = '$provinceId' order by city_id desc";
        $res = $this->query($sql);
        return $res;
    }

    /**
     * 根据省查询所有市
     */
    public function StoreAreaByCityIdQuery($cityId)
    {
        $sql = "select * from helms_store_area where parent_id = '$cityId' order by area_id desc";
        $res = $this->query($sql);
        return $res;
    }

}
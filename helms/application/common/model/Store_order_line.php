<?php
namespace app\common\model;

use think\Model;

class Store_order_line extends Model
{    

    /**
     * 根据订单行插入
     */
    public function StoreOrderLineInsert($orderCode,$productId,$productNum,$total,$userId){
        $_storeOrderLineInfo = array();
        if ($orderCode >=0)
        {
            $_storeOrderLineInfo["order_code"] = $orderCode;
        }
    
        if ($productId >=0)
        {
            $_storeOrderLineInfo["product_id"] = $productId;
        }
    
        if ($productNum >=0)
        {
            $_storeOrderLineInfo["product_num"] = $productNum;
        }
    
        if ($total >=0)
        {
            $_storeOrderLineInfo["total"] = $total;
        }
        
        if ($userId >=0)
        {
            $_storeOrderLineInfo["user_id"] = $userId;
        }
    
        $t=time();
        $_storeOrderLineInfo["create_time"] = date("Y-m-d H:i:s",$t);
        //changed by Gavin start model23
        
        $data1 = $_storeOrderLineInfo['create_time'];
        $sql = "insert into `helms_store_order_line` (`order_code`,`product_id`,`product_num`,`total`,`user_id`,`create_time`) value('$orderCode','$productId','$productNum','$total','$userId','$data1')";
        $state =  $this->execute($sql);
        
        return $state;
        //changed by Gavin end model23
        
        //$state = $this->save($_storeOrderLineInfo);
        
        return $state;
    }
    
    public function getOrderLineByCode($code){
        $sql = "select * from helms_store_order_line ol left join helms_store_product p on ol.product_id = p.id where ol.order_code = '$code'";
        return $this->query($sql);
    }
}
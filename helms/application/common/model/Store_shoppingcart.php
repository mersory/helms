<?php
namespace app\common\model;

use think\Model;

class Store_shoppingcart extends Model
{
    public function index()
    {
        var_dump("Storeshoppingcartinfo");
    }
    
    /**
     * 查询所有购物车
     * @param unknown $userId
     * @return unknown
     */
    public function ShoppingcartInfoAllQuery($userId)
    {
        $sql = "select p.id as productId,s.id as shoppingcartId,p.*,s.* from helms_store_product p left join helms_store_shoppingcart s on p.id = s.product_id where s.user_id = '$userId'";
        $_shoppingcartinfo = $this->query($sql);
        return $_shoppingcartinfo;
    }
    
    /**
     * 查询购物车是否存在某件商品
     * @param unknown $productId
     * @param unknown $userId
     */
    public function ShoppingcartInfoByProductIdQuery($productId,$userId)
    {
        
        $_shoppingcartinfo = $this->where("user_id='$userId'")->where("product_id='$productId'")->select();
        return $_shoppingcartinfo;
    }
    
    /**
     * 添加购物车
     * @param unknown $productId
     * @param unknown $productNum
     * @param unknown $userId
     */
    public function StoreShoppingcartInsert($productId, $productNum, $userId)
    {
        $_shoppingcartinfo = array();
        if ($productId >=0)
        {
            $_shoppingcartinfo["product_id"] = $productId;
        }
    
        if ($productNum >=0)
        {
            $_shoppingcartinfo["product_num"] = $productNum;
        }
    
        if ($userId >=0)
        {
            $_shoppingcartinfo["user_id"] = $userId;
        }
        
        $t=time();
        $_shoppingcartinfo["create_time"] = date("Y-m-d H:i:s",$t);
        $_shoppingcartinfo["update_time"] = date("Y-m-d H:i:s",$t);
    
        $state = $this->save($_shoppingcartinfo);
        
        return $state;
    }
    
    /**
     * 更新购物车数量
     * @param unknown $shoppingcartId
     * @param unknown $productId
     * @param unknown $productNum
     * @param unknown $userId
     */
    public function StoreShoppingcartUpdateNum($shoppingcartId,$productId, $productNum, $userId)
    {
        $_shoppingcartinfo = array();
    
        if ($productNum >=0)
        {
            $_shoppingcartinfo["product_num"] = $productNum;
        }
        
        $state = $this-> where("id=$shoppingcartId")->where("user_id='$userId'")->where("product_id='$productId'")->setField($_shoppingcartinfo);
        
        return $state;
    }
    
    /**
     * 删除购物车商品
     * @param unknown $shoppingcartId
     * @param unknown $productId
     * @param unknown $productNum
     * @param unknown $userId
     */
    public function StoreShoppingcartDelete($shoppingcartId,$userId)
    {
        $_where = "id = $shoppingcartId  and user_id = '$userId'";

        $state = $this->where($_where)->delete();
        
        return $state;
    }
    
    /**
     * 删除购物车商品
     * @param unknown $shoppingcartId
     * @param unknown $productId
     * @param unknown $productNum
     * @param unknown $userId
     */
    public function StoreShoppingcartEmpty($userId)
    {
        $_where = "user_id = '$userId'";

        $state = $this->where($_where)->delete();
    
        if ($state)
        {
            $this->commit();
        }
        else
        {
            $this->rollback();
        }
        return $state;
    }    
}
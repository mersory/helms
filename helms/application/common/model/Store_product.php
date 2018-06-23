<?php
namespace app\common\model;

use think\Model;

class Store_product extends Model
{
    public function index()
    {
        var_dump("Storeproductinfo");
    }
    
    public function CategorytInfoAllQuery(){
        
        $_productinfo = $this->field('category,category_name')->group('category')->select();
        $count = count($_productinfo);
        if ($count < 1)
        {
            var_dump("ProductInfo not exsist");
            return ;
        }
        return $_productinfo;
    }
    
    public function ProductInfoAllQuery()
    {
        $_where = '';
        $_productinfo = $this->where($_where)->order("id desc")->select();
        $count = count($_productinfo);
        if ($count < 1)
        {
            var_dump("ProductInfo not exsist");
            return ;
        }
        return $_productinfo;
    }
    
    public function ProductInfoValidQuery()
    {
        $_where = '';
        $_where = "lifecycle = 1";
        $_productinfo = $this->where($_where)
        ->select();
        $count = count($_productinfo);
        if ($count < 1)
        {
            var_dump("ProductInfo not exsist");
            return ;
        }
        return $_productinfo;
    }
    
    public function ProductInfoByIdQuery($ID)
    {
        $_where = "ID = $ID";
        $_productinfo = $this->where($_where)->select();
        return $_productinfo;
    }
    
    public function StoreProductInsert($descriptionUrl,$name, $description, $image_url, $operator, $invetory,$price,$curPrice,$category,$categoryName,$order)
    {
        $_productinfo = array();
        if ($descriptionUrl >=0)
        {
            $_productinfo["description_url"] = $descriptionUrl;
        }
        
        if ($name >=0)
        {
            $_productinfo["name"] = $name;
        }
    
        if ($description >=0)
        {
            $_productinfo["description"] = $description;
        }
    
        if ($image_url >=0)
        {
            $_productinfo["image_url"] = $image_url;
        }
        
        if ($operator >=0)
        {
            $_productinfo["operator"] = $operator;
        }
         
        if ($invetory >=0)
        {
            $_productinfo["invetory"] = $invetory;
        }
        
        if ($price >=0)
        {
            $_productinfo["price"] = $price;
        }
        
        if ($curPrice >=0)
        {
            $_productinfo["cur_price"] = $curPrice;
        }
        
        if ($category >=0)
        {
            $_productinfo["category"] = $category;
        }
        
        if ($categoryName >=0)
        {
            $_productinfo["category_name"] = $categoryName;
        }
        
        if ($order >=0)
        {
            $_productinfo["order"] = $order;
        }
        
        $t=time();
        $_productinfo["create_time"] = date("Y-m-d H:i:s",$t);
    
        $state = $this->save($_productinfo);
        
        return $state;
    }
    
    public function StoreProductUpdate($descriptionUrl,$id, $name, $description, $image_url, $operator, $invetory,$price,$curPrice,$category,$categoryName,$order)
    {
        $_productinfo = array();
        if (descriptionUrl >=0)
        {
            $_productinfo["description_url"] = descriptionUrl;
        }
        
        if ($name >=0)
        {
            $_productinfo["name"] = $name;
        }
    
        if ($description >=0)
        {
            $_productinfo["description"] = $description;
        }
    
        if ($image_url >=0)
        {
            $_productinfo["image_url"] = $image_url;
        }
        
        if ($operator >=0)
        {
            $_productinfo["operator"] = $operator;
        }
         
        if ($invetory >=0)
        {
            $_productinfo["invetory"] = $invetory;
        }
        
        if ($price >=0)
        {
            $_productinfo["price"] = $price;
        }
        
        if ($curPrice >=0)
        {
            $_productinfo["cur_price"] = $curPrice;
        }
        
        if ($category >=0)
        {
            $_productinfo["category"] = $category;
        }
        
        if ($categoryName >=0)
        {
            $_productinfo["category_name"] = $categoryName;
        }
        
        if ($order >=0)
        {
            $_productinfo["order"] = $order;
        }
    
        $state = $this-> where("id=$id")
        ->setField($_productinfo);
        return $state;
    }
    
    public function ProductStockUpdate($id, $operator)
    {
        $_productinfo = array();
        if ($id >=0)
        {
            $_productinfo["id"] = $id;
        }
    
        if ($operator >=0)
        {
            $_productinfo["operator"] = $operator;
        }
        
        $_productinfo["lifecycle"] = 1;
        $t=time();
        $_productinfo["stock_time"] = date("Y-m-d H:i:s",$t);
    
        $state = $this-> where("id=$id")->setField($_productinfo);
        
        return $state;
    }
    
    public function ProductDownStockUpdate($id, $operator)
    {
        $_productinfo = array();
        if ($id >=0)
        {
            $_productinfo["id"] = $id;
        }
    
        if ($operator >=0)
        {
            $_productinfo["operator"] = $operator;
        }
    
        $_productinfo["lifecycle"] = 3;
        
        $t=time();
        $_productinfo["stock_time"] = date("Y-m-d H:i:s",$t);
    
        $state = $this-> where("id=$id") ->setField($_productinfo);

        return $state;
    }
    
    /**
     * 扣减库存
     * @param unknown $productId
     * @param unknown $num
     */
    public function StoreReduceInvetory($productId,$num){
        $sql = "update helms_store_product set invetory=invetory-$num where id = $productId and invetory>=$num";
        $state =  $this->query($sql);
        
        return $state;
    }
    
    //返回原有数据  不自动进行时间转换
    public function getCreateTimeAttr($time)
    {
        return $time;
    }
    
    public function getStockTimeAttr($time)
    {
        return $time;
    }
}
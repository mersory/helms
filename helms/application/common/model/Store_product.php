<?php
namespace app\common\model;

use think\Model;

class Store_product extends Model
{
    public function index()
    {
        var_dump("Storeproductinfo");
    }
    
    public function ProductInfoAllQuery()
    {
        $_productinfo = $this->select();
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
    
    public function ProductInfoByIdQuery($id)
    {
        $_where = '';
        if ($id != -1)
        {
            $_where = "id =$id";
        }
        $_productinfo = $this->where($_where)->select();
        $count = count($_productinfo);
        if ($count < 1)
        {
            var_dump("ProductInfo not exsist");
            return ;
        }
        return $_productinfo;
    }
    
    public function StoreProductInsert($name, $description, $image_url, $operator, $invetory,$price)
    {
        $_productinfo = array();
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
    
        $t=time();
        $_productinfo["create_time"] = date("Y-m-d H:i:s",$t);
    
        $this->startTrans();
        $state = $this->save($_productinfo);
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
    
    public function StoreProductUpdate($id, $name, $description, $image_url, $operator, $invetory,$price)
    {
        $_productinfo = array();
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
    
        $state = $this-> where("id=$id")
        ->setField($_productinfo);
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
    
        $state = $this-> where("id=$id")
        ->setField($_productinfo);
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
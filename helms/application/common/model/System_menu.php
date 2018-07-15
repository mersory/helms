<?php
namespace app\common\model;

use think\Model;
use think\paginator\driver;

class System_menu extends Model
{
    // 根据用户ID查询所有的角色
    public function MenuAllQueryPage()
    {
        $_menu_info = $this->paginate(10,false,['query' => request()->param()]);
        $count = count($_menu_info);
        if ($count < 1) {
            //var_dump("menu info not exsist");
            return;
        }
        return $_menu_info;
    }
    
    // 根据用户ID查询所有的角色
    public function MenuAllQuery()
    {
        $_menu_info = $this->select();
        $count = count($_menu_info);
        if ($count < 1) {
            //var_dump("menu info not exsist");
            return;
        }
        return $_menu_info;
    }
    
    // 根据用户ID查询所有的角色
    public function MenuByRoleIdQuery($roleId)
    {
        $sql = "select m.*,exists(select * from helms_system_role_menu_rlat  r where r.menu_id = m.id and r.role_id = $roleId) as flag  from helms_system_menu m";
        $_menu_info = $this->query($sql);
        $count = count($_menu_info);
        if ($count < 1) {
            return;
        }
        return $_menu_info;
    }
    
    //角色插入
    public function MenuInsert($menuName,$menuUrl,$type,$parentName)
    {
        $_menuInfo = array();
        if ($menuName >=0)
        {
            $_menuInfo["name"] = $menuName;
        }
        $_menuInfo["url"] = $menuUrl;
        if ($type >=0)
        {
            $_menuInfo["type"] = $type;
        }
        if ($parentName >=0)
        {
            $_menuInfo["parent_name"] = $parentName;
        }
    
        $t=time();
        $_menuInfo["create_time"] = date("Y-m-d H:i:s",$t);
    
        $state = $this->save($_menuInfo);
        
        return $state;
    }
    
    //修改角色名
    public function MenuModify($id, $menuName,$menuUrl,$type,$parentName)
    {
        $_orderinfo = array();
        if ($id >=0)
        {
            $_menuInfo["id"] = $id;
        }
        
        if ($menuName >=0)
        {
            $_menuInfo["name"] = $menuName;
        }
        $_menuInfo["url"] = $menuUrl;
        if ($type >=0)
        {
            $_menuInfo["type"] = $type;
        }
        if ($parentName >=0)
        {
            $_menuInfo["parent_name"] = $parentName;
        }
    
        $state = $this-> where("id=$id")
        ->setField($_menuInfo);
        return $state;
    }
    
    public function MenuDelete($ID)
    {
        $_where = '';
        if ($ID > 0)
        {
            $_where = "ID = $ID";
        }

        $state = $this->where($_where)->delete();
        
        return $state;
    }
    
}
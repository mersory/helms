<?php
namespace app\common\model;

use think\Model;

class System_role_menu_rlat extends Model
{   
    // 角色绑定菜单
    public function RoleBindMenu($roleId, $menuId)
    {
        $_roleInfo = array();
        $_roleInfo["role_id"] = $roleId;
        $_roleInfo["menu_id"] = $menuId;
    
        $state = $this->save($_roleInfo);
        
        return $state;
    }
    
    // 角色解绑菜单
    public function RoleUnbindMenu($roleId, $menuId)
    {
        $_where = '';
        $_where = "role_id = $roleId and menu_id = $menuId";
        
        $state = $this->where($_where)->delete();
       
        return $state;
    }
    
}
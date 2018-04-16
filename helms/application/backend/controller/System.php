<?php
namespace app\backend\controller;

use think\Controller;
use think\Request;
use think\Session;
use app\backend\controller\Basecontroller;
use app\common\model\System_role;
use app\common\model\System_menu;
use app\common\model\System_subscriber;
use app\common\model\System_role_menu_rlat;

class System extends Basecontroller
{
    // 用户列表
    public function subscriberList()
    {
        $_session_user = Session::get(USER_SEESION);
        if (empty($_session_user)) {
            return $this->redirect("/login/login/index");
        } else {
            $_user_id = $_session_user["userId"];
            $subscriber = new System_subscriber();
            $res = $subscriber->SubscriberQueryMenu($_user_id);
            
            $this->assign('menu_data', $res);
            $_role = new System_subscriber();
            $_role_info = $_role->SubscriberAllQuery();
            // 向V层传数据
            $this->assign('pass_data', $_role_info);
            
            // 取回打包后的数据
            $htmls = $this->fetch();
            return $htmls;
        }
    }
    
    // 用户新建
    public function subscriberAdd($username, $password)
    {
        $_resdata = array();
        $_post = Request::instance()->post();
        $_role_info = new System_subscriber();
        $_res = $_role_info->SubscriberInsert($username, $password);
        if (count($_res) == 1) {
            $_resdata["result"] = true;
            $_role_info->commit();
        } else {
            $_resdata["result"] = false;
            $_role_info->rollback();
        }
        // 取回打包后的数据
        return json_encode($_resdata);
    }
    
    // 修改密码
    public function subscriberModifyPwd($id, $password)
    {
        $_resdata = array();
        $_post = Request::instance()->post();
        $_role_info = new System_subscriber();
        $_res = $_role_info->SubscriberModify($id, $password, - 1);
        if (count($_res) == 1) {
            $_resdata["result"] = true;
            $_role_info->commit();
        } else {
            $_resdata["result"] = false;
            $_role_info->rollback();
        }
        // 取回打包后的数据
        return json_encode($_resdata);
    }
    
    // 修改用户状态
    public function subscriberModifyStatus($id, $lifecycle)
    {
        $_resdata = array();
        $_post = Request::instance()->post();
        $_role_info = new System_subscriber();
        $_res = $_role_info->SubscriberModify($id, - 1, $lifecycle);
        if (count($_res) == 1) {
            $_resdata["result"] = true;
            $_role_info->commit();
        } else {
            $_resdata["result"] = false;
            $_role_info->rollback();
        }
        // 取回打包后的数据
        return json_encode($_resdata);
    }
    
    // 角色列表
    public function roleList()
    {
        $_session_user = Session::get(USER_SEESION);
        if (empty($_session_user)) {
            return $this->redirect("/login/login/index");
        } else {
            $_user_id = $_session_user["userId"];
            $subscriber = new System_subscriber();
            $res = $subscriber->SubscriberQueryMenu($_user_id);
            
            $this->assign('menu_data', $res);
            $_role = new System_role();
            $_role_info = $_role->RoleAllQuery();
            // 向V层传数据
            $this->assign('pass_data', $_role_info);
            
            // 取回打包后的数据
            $htmls = $this->fetch();
            return $htmls;
        }
    }
    
    // 角色添加
    public function roleAdd()
    {
        $_resdata = array();
        $_post = Request::instance()->post();
        $_role_info = new System_role();
        $name = $_post["role_name"];
        $_res = $_role_info->RoleInsert($name);
        if (count($_res) == 1) {
            $_resdata["result"] = true;
            $_role_info->commit();
        } else {
            $_resdata["result"] = false;
            $_role_info->rollback();
        }
        // 取回打包后的数据
        return json_encode($_resdata);
    }
    
    // 角色编辑
    public function roleModify()
    {
        $_resdata = array();
        $_post = Request::instance()->post();
        $_role_info = new System_role();
        $id = $_post["role_id"];
        $name = $_post["role_name"];
        $_res = $_role_info->RoleModify($id, $name);
        if (count($_res) == 1) {
            $_resdata["result"] = true;
            $_role_info->commit();
        } else {
            $_resdata["result"] = false;
            $_role_info->rollback();
        }
        // 取回打包后的数据
        return json_encode($_resdata);
    }
    
    // 角色删除
    public function roleDelete()
    {
        $_resdata = array();
        $_post = Request::instance()->post();
        $_role_info = new System_role();
        $id = $_post["role_id"];
        $_res = $_role_info->RoleDelete($id);
        if (count($_res) == 1) {
            $_resdata["result"] = true;
            $_role_info->commit();
        } else {
            $_resdata["result"] = false;
            $_role_info->rollback();
        }
        // 取回打包后的数据
        return json_encode($_resdata);
    }
    
    // 绑定菜单
    public function bindRoleMenu($menu_id, $role_id)
    {
        $_resdata = array();
        $_post = Request::instance()->post();
        $_role_info = new System_role_menu_rlat();
        $id = $_post["role_id"];
        $_res = $_role_info->RoleBindMenu($role_id, $menu_id);
        if (count($_res) == 1) {
            $_resdata["result"] = true;
            $_role_info->commit();
        } else {
            $_resdata["result"] = false;
            $_role_info->rollback();
        }
        // 取回打包后的数据
        return json_encode($_resdata);
    }
    
    // 解绑菜单
    public function unbindRoleMenu($menu_id, $role_id)
    {
        $_resdata = array();
        $_post = Request::instance()->post();
        $_role_info = new System_role_menu_rlat();
        $id = $_post["role_id"];
        $_res = $_role_info->RoleUnbindMenu($role_id, $menu_id);
        if (count($_res) == 1) {
            $_resdata["result"] = true;
            $_role_info->commit();
        } else {
            $_resdata["result"] = false;
            $_role_info->rollback();
        }
        // 取回打包后的数据
        return json_encode($_resdata);
    }
    
    // 菜单列表
    public function menuList()
    {
        $_session_user = Session::get(USER_SEESION);
        if (empty($_session_user)) {
            return $this->redirect("/login/login/index");
        } else {
            $_user_id = $_session_user["userId"];
            $subscriber = new System_subscriber();
            $res = $subscriber->SubscriberQueryMenu($_user_id);
            
            $this->assign('menu_data', $res);
            $_menu = new System_menu();
            $_menu_info = $_menu->MenuAllQuery();
            // 向V层传数据
            $this->assign('pass_data', $_menu_info);
            
            // 取回打包后的数据
            $htmls = $this->fetch();
            return $htmls;
        }
    }
    
    // 菜单添加
    public function menuAdd()
    {
        $_resdata = array();
        $_post = Request::instance()->post();
        $_menu_info = new System_menu();
        $menu_name = $_post["menu_name"];
        $menu_type = $_post["menu_type"];
        $menu_parent = $_post["menu_parent"];
        $menu_url = $_post["menu_url"];
        $_res = $_menu_info->MenuInsert($menu_name, $menu_url, $menu_type, $menu_parent);
        if (count($_res) == 1) {
            $_resdata["result"] = true;
            $_menu_info->commit();
        } else {
            $_resdata["result"] = false;
            $_menu_info->rollback();
        }
        // 取回打包后的数据
        return json_encode($_resdata);
    }
    
    // 菜单编辑
    public function menuModify()
    {
        $_resdata = array();
        $_post = Request::instance()->post();
        $_menu_info = new System_menu();
        $menu_id = $_post["menu_id"];
        $menu_name = $_post["menu_name"];
        $menu_type = $_post["menu_type"];
        $menu_parent = $_post["menu_parent"];
        $menu_url = $_post["menu_url"];
        $_res = $_menu_info->MenuModify($menu_id, $menu_name, $menu_url, $menu_type, $menu_parent);
        if (count($_res) == 1) {
            $_resdata["result"] = true;
            $_menu_info->commit();
        } else {
            $_resdata["result"] = false;
            $_menu_info->rollback();
        }
        // 取回打包后的数据
        return json_encode($_resdata);
    }

    public function menuQueryByRoleId($roleId)
    {
        $_menu = new System_menu();
        $_menu_info = $_menu->MenuByRoleIdQuery($roleId);
        // 取回打包后的数据
        return json_encode($_menu_info);
    }
    
    // 菜单删除
    public function menuDelete()
    {
        $_resdata = array();
        $_post = Request::instance()->post();
        $_menu_info = new System_menu();
        $id = $_post["menu_id"];
        $_res = $_menu_info->MenuDelete($id);
        if (count($_res) == 1) {
            $_resdata["result"] = true;
            $_menu_info->commit();
        } else {
            $_resdata["result"] = false;
            $_menu_info->rollback();
        }
        // 取回打包后的数据
        return json_encode($_resdata);
    }
    
    // 权限列表
    public function privillegeList()
    {
        // 取回打包后的数据
        $htmls = $this->fetch();
        return $htmls;
    }
    
    // 权限添加
    public function privillegeAdd()
    {
        // 取回打包后的数据
        $_resdata = "";
        return json_encode($_resdata);
    }
    
    // 权限编辑
    public function privillegeModify()
    {
        $_resdata = "";
        return json_encode($_resdata);
    }
    
    // 权限删除
    public function privillegeDelete()
    {
        $_resdata = "";
        return json_encode($_resdata);
    }
}
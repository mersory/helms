<?php
namespace app\backend\controller;

use think\Controller;
use think\Request;
use think\Session;
use app\common\model\Preference_option;
use app\common\model\System_subscriber;
use app\extra\controller\Basecontroller;

class Preference extends Basecontroller
{
    // 订单列表
    public function preferenceList()
    {
        $_session_user = Session::get(USER_SEESION);
        if (empty($_session_user)) {
            return $this->redirect("/login/login/index");
        } else {
            $_user_id = $_session_user["userId"];
            $subscriber = new System_subscriber();
            $res = $subscriber->SubscriberQueryMenu($_user_id);
            
            $this->assign('menu_data', $res);
            
            
            $preference = new Preference_option();
            $res = $preference->PreferenceInfoAllQuery();
            
            // 向V层传数据
            $this->assign('pass_data', $res);
            
            // 取回打包后的数据
            $htmls = $this->fetch();
            return $htmls;
        }
    }
    
    // 添加商品
    public function addPreference()
    {
        $_resdata = array();
        $_post = Request::instance()->post();
        $_product_info = new Preference_option();
        $name = $_post["preference_name"];
        $product_code = $_post["preference_code"]; //
        $product_value = $_post["preference_value"]; //
        $_res = $_product_info->PreferenceInsert($name, $product_code, $product_value, "");
        if (count($_res) == 1) {
            $_resdata["result"] = true;
            $_product_info->commit();
        } else {
            $_resdata["result"] = false;
            $_product_info->rollback();
        }
        return json_encode($_resdata);
    }
    
    // 修改商品
    public function modifyPreference()
    {
        $_resdata = array();
        $_post = Request::instance()->post();
        $_product_info = new Preference_option();
        $id = $_post["preference_id"];
        $name = $_post["preference_name"];
        $product_code = $_post["preference_code"]; //
        $product_value = $_post["preference_value"]; //
        $_res = $_product_info->PreferenceUpdate($id,$name, $product_code, $product_value, "");
        if (count($_res) == 1) {
            $_resdata["result"] = true;
            $_product_info->commit();
        } else {
            $_resdata["result"] = false;
            $_product_info->rollback();
        }
        return json_encode($_resdata);
    }
    
    // 查询商品信息
    public function findPreference($preference_id)
    {
        $_product = new Preference_option();
        $_product_info = $_product->PreferenceByIdQuery($preference_id);
        
        return json_encode($_product_info);
    }
    
}
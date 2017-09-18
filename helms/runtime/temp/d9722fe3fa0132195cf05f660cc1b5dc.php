<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"C:\xampp\htdocs\tp5\public/../application/framework\view\useropt\index.html";i:1504448024;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <title>查看所有用户基本信息</title>
</head>
<body>
<table>
        <tr>
            <th>序号</th>
            <th>姓名</th>
            <th>密码</th>
            <th>二级密码</th>
            <th>用户级别</th>
        </tr>
        <?php if(is_array($pass_data) || $pass_data instanceof \think\Collection || $pass_data instanceof \think\Paginator): $i = 0; $__LIST__ = $pass_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
        <tr>
            <td><?php echo $data->getData("ID"); ?></td>
            <td><?php echo $data->getData("username"); ?></td>
            <td><?php echo $data->getData("password"); ?></td>
            <td><?php echo $data->getData("minor_pwd"); ?></td>
            <td><?php if($data->getData("user_status") == '1'): ?>管理员<?php else: ?>普通用户<?php endif; ?></td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
    
</body>
</html>
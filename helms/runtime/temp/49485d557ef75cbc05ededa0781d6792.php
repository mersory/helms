<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"C:\xampp\htdocs\tp5\public/../application/framework\view\useropt\userlogin.html";i:1504714292;}*/ ?>
<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <title>登陆成功</title>
</head>
<body>
<table>
        <tr>
        	<th>序号</th>
            <td><?php echo $pass_data["ID"]; ?></td>    <!-- 上一个页面传递的是数组，因此这里直接用传递过的数组name就可以-->
        </tr>    
        <tr>   
            <th>姓名</th>
            <td><?php echo $pass_data["username"]; ?></td>
        </tr>    
        <tr>   
            <th>密码</th>
            <td><?php echo $pass_data["password"]; ?></td>
        </tr>    
        <tr>   
            <th>开户名</th>
            <td><?php echo $pass_data["user_name"]; ?></td>
        </tr>    
        <tr>   
            <th>注册邮箱</th>
            <td><?php echo $pass_data["email"]; ?></td>
        </tr>    
        <tr>   
            <th>共享分</th>
            <td><?php echo $pass_data["shares"]; ?></td>
        </tr>    
        <tr>   
            <th>奖励分</th>
            <td><?php echo $pass_data["bonus_point"]; ?></td>
        </tr>    
        <tr>   
            <th>注册分</th>
            <td><?php echo $pass_data["regist_point"]; ?></td>
        </tr>    
        <tr>   
            <th>用户权限</th>
            <td><?php echo $pass_data["priority_id"]; ?></td>
        </tr>    
        <tr>   
            <th>角色编号</th>
            <td><?php echo $pass_data["role_id"]; ?></td>
        </tr>    
        <tr>   
            <th>开户名</th>
            <td><?php echo $pass_data["bank_account_name"]; ?></td>
        </tr>    
        <tr>   
            <th>开户帐号</th>
            <td><?php echo $pass_data["bank_account_num"]; ?></td>
        </tr>    
        <tr>   
            <th>开户行</th>
            <td><?php echo $pass_data["bank_name"]; ?></td>
        </tr>    
        <tr>   
            <th>备注</th>
            <td><?php echo $pass_data["reserve1"]; ?></td>
        </tr>
    </table>
   
    <?php
    	$_SESSION["ID"] = $pass_data["ID"];
		$_SESSION["username"] = $pass_data["username"];
	?>
    <form action="UpdatePwd" method="post">
                <button type="submit">修改密码</button>
    </form>
</body>
</html>
<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:98:"E:\Software\php\workspace\helms\helms\public/../application/framework\view\useropt\loginindex.html";i:1505475423;}*/ ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Minimal 1.0 - Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8" />

    <link rel="icon" type="image/ico" href="http://tattek.com/minimal/assets/images/favicon.ico" />
    <!-- Bootstrap -->
    <link href="_CSS_/vendor/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="_CSS_/vendor/bootstrap-checkbox.css">

    <link href="_CSS_/minimal.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="bg-1">
 

    <!-- Wrap all page content here -->
    <div id="wrap">
      <!-- Make page fluid -->
      <div class="row">
        <!-- Page content -->
        <div id="content" class="col-md-12 full-page login">


          <div class="inside-block">
            <img src="_IMG_/logo-big.png" alt class="logo">
            <h1>HELMS</h1>
            <h5></h5>
			</tr>
            <form action="UserLogin" method="post">
              <section>
                <div class="input-group">
                  <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                  <div class="input-group-addon"><i class="fa fa-user"></i></div>
                </div>
                <div class="input-group">
                  <input type="password" class="form-control" name="password" placeholder="Password">
                  <div class="input-group-addon"><i class="fa fa-key"></i></div>
                </div>
              </section>
              <section class="controls">
                <div class="checkbox check-transparent">
                  <input type="checkbox" value="1" id="remember" checked>
                  <label for="remember">记住我</label>
                </div>
                <a href="ForgetPwd.html">忘记密码?</a>
              </section>
              <section class="log-in">
                <button class="btn btn-greensea" value="submitBtn" onclick="click">登录</button>
              </section>
            </form>
            <form action="RegistIndex" method="post">
                <button type="submit">注册</button>
            </form>
             <button type="submit" id="btn_submit"> submit </button>
          </div>


        </div>
        <!-- /Page content -->  
      </div>
    </div>
    <!-- Wrap all page content end -->
    <script type="text/javascript">
	   function validate() 
	   {
		   var obj = document.getElementsByName("username");
		   var user = obj[0].value
		   alert(user);
		   if( !(/[A-Z]/.test(user)) )
		   {
			   alert("输入序列必须包含大写字母");
			   return false;
		   }
		   if( !(/[a-z]/.test(user)) )
		   {
			   alert("输入序列必须包含小写字母");
			   return false;
		   }
		   if( !(/[0-9]/.test(user)) )
		   {
			   alert("输入序列必须包含数字");
			   return false;
		   }
		   alert("输入序列合法");
		   return true;
	   }  
 	</script>
 	
 		   $('#btn_submit').on('click', function(){
		   alert("click");
	   });
  </body>
</html>
      

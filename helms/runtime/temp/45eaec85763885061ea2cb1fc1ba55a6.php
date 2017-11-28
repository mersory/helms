<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:87:"E:\Software\php\workspace\helms\helms\public/../application/login\view\login\index.html";i:1511359924;}*/ ?>
<html>
  <head>
    <title>HELMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8" />

    <link rel="icon" type="image/ico" href="http://tattek.com/minimal/assets/images/favicon.ico" />
    <!-- Bootstrap -->
    <link href="_CSS_/vendor/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="_CSS_/vendor/bootstrap-checkbox.css">

    <link href="_CSS_/minimal.css" rel="stylesheet">
    <script src="_JS_/jquery.js"></script>
    <script src="_JS_/common/login/index.js"></script>
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

            <form id="form-signin" class="form-signin">
              <section>
                <div class="input-group">
                  <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                  <div class="input-group-addon"><i class="fa fa-user"></i></div>
                </div>
                <div class="input-group">
                  <input type="password" class="form-control" name="password"  id="password" placeholder="Password">
                  <div class="input-group-addon"><i class="fa fa-key"></i></div>
                </div>
              </section>
              <div class="error_div" style="text-align:left;color:red;"></div>
              <section class="controls">
                <div class="checkbox check-transparent">
                  <input type="checkbox" value="1" id="remember" checked>
                  <!-- <label for="remember">记住我</label> -->
                </div>
                <a href="#">忘记密码?</a>
              </section>
              <section class="log-in">
                <button type="button" class="btn btn-greensea" id="login">登录</button>
                <span>or</span>
                <button type="button" class="btn btn-slategray" id="create">创建账户</button>
              </section>
            </form>
          </div>


        </div>
        <!-- /Page content -->  
      </div>
    </div>
    <!-- Wrap all page content end -->
  </body>
</html>
      

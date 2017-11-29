<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:92:"C:\Users\Administrator\git\helms\helms\public/../application/frontend\view\common\index.html";i:1511877397;s:93:"C:\Users\Administrator\git\helms\helms\public/../application/frontend\view\base\frontend.html";i:1511877397;s:20:"base/common/css.html";i:1505921314;s:19:"base/common/js.html";i:1511877397;s:36:"base/common/frontend/leftAndTop.html";i:1511971111;}*/ ?>
<!DOCTYPE html>
<html>
  <head>
    <title>HELMS - <block name="title">标题</block></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8" />
	 	<link rel="icon" type="image/ico" href="http://tattek.com/minimal/assets/images/favicon.ico" />
    <!-- Bootstrap -->
    <link href="_CSS_/vendor/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="_CSS_/vendor/animate/animate.min.css">
    <link type="text/css" rel="stylesheet" media="all" href="_JS_/vendor/mmenu/css/jquery.mmenu.all.css" />
    <link rel="stylesheet" href="_JS_/vendor/videobackground/css/jquery.videobackground.css">
    <link rel="stylesheet" href="_CSS_/vendor/bootstrap-checkbox.css">

    <link rel="stylesheet" href="_JS_/vendor/rickshaw/css/rickshaw.min.css">
    <link rel="stylesheet" href="_JS_/vendor/morris/css/morris.css">
    <link rel="stylesheet" href="_JS_/vendor/tabdrop/css/tabdrop.css">
    <link rel="stylesheet" href="_JS_/vendor/summernote/css/summernote.css">
    <link rel="stylesheet" href="_JS_/vendor/summernote/css/summernote-bs3.css">
    <link rel="stylesheet" href="_JS_/vendor/chosen/css/chosen.min.css">
    <link rel="stylesheet" href="_JS_/vendor/chosen/css/chosen-bootstrap.css">

    <link href="_CSS_/minimal.css" rel="stylesheet">
    <link href="_CSS_/main.css" rel="stylesheet">
    
    
    
    

	
<script src="_JS_/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="_JS_/vendor/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript"
	src="_JS_/vendor/mmenu/js/jquery.mmenu.min.js"></script>
<script type="text/javascript"
	src="_JS_/vendor/sparkline/jquery.sparkline.min.js"></script>
<script type="text/javascript"
	src="_JS_/vendor/nicescroll/jquery.nicescroll.min.js"></script>
<script type="text/javascript"
	src="_JS_/vendor/animate-numbers/jquery.animateNumbers.js"></script>
<script type="text/javascript"
	src="_JS_/vendor/videobackground/jquery.videobackground.js"></script>
<script type="text/javascript"
	src="_JS_/vendor/blockui/jquery.blockUI.js"></script>

<script src="_JS_/vendor/flot/jquery.flot.min.js"></script>
<script src="_JS_/vendor/flot/jquery.flot.time.min.js"></script>
<script src="_JS_/vendor/flot/jquery.flot.selection.min.js"></script>
<script src="_JS_/vendor/flot/jquery.flot.animator.min.js"></script>
<script src="_JS_/vendor/flot/jquery.flot.orderBars.js"></script>
<script src="_JS_/vendor/easypiechart/jquery.easypiechart.min.js"></script>

<script src="_JS_/vendor/rickshaw/raphael-min.js"></script>
<script src="_JS_/vendor/rickshaw/d3.v2.js"></script>
<script src="_JS_/vendor/rickshaw/rickshaw.min.js"></script>

<script src="_JS_/vendor/morris/morris.min.js"></script>

<script src="_JS_/vendor/tabdrop/bootstrap-tabdrop.min.js"></script>

<script src="_JS_/vendor/summernote/summernote.min.js"></script>

<script src="_JS_/vendor/chosen/chosen.jquery.min.js"></script>
<script src="_JS_/vendor/parsley/parsley.min.js"></script>
<script src="_JS_/vendor/wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="_JS_/minimal.min.js"></script>
<script src="_JS_/common/main.js"></script>

<script type="text/javascript">
	root = "__ROOT__";
</script>
	
	<!-- custom css -->
	


	<!-- custom js -->
	
    <script type="text/javascript" src="_JS_/common/index.js"></script>


  </head>
  <body class="bg-1">
  	<div class="mask" style="display: none;"><div id="loader" style="display: none;"></div></div>

    <!-- Wrap all page content here -->
    <div id="wrap">
      <!-- Make page fluid -->
      <div class="row">
	
    	<!-- left and top -->	   
		<!-- Fixed navbar -->
        <div class="navbar navbar-default navbar-fixed-top navbar-transparent-black mm-fixed-top" role="navigation" id="navbar">        

          <!-- Branding -->
          <div class="navbar-header col-md-2">
            <a class="navbar-brand" href="index.html">
              <strong>HELMS</strong>
            </a>
            <div class="sidebar-collapse">
              <a href="#">
                <i class="fa fa-bars"></i>
              </a>
            </div>
          </div>
          <!-- Branding end -->

          <!-- .nav-collapse -->
          <div class="navbar-collapse">
                        
            <!-- Page refresh -->
            <ul class="nav navbar-nav refresh">
              <li class="divided">
                <a href="#" class="page-refresh"><i class="fa fa-refresh"></i></a>
              </li>
            </ul>
            <!-- /Page refresh -->

            <!-- Quick Actions -->
            <ul class="nav navbar-nav quick-actions">
              
              <li class="dropdown divided">
                <a class="dropdown-toggle button" data-toggle="dropdown" href="#"></a>
              </li>

              <li class="dropdown divided user" id="current-user">
                <div class="profile-photo">
                  <img src="_IMG_/profile-photo.jpg" alt />
                </div>
                <a class="dropdown-toggle options" data-toggle="dropdown" href="#">
                  <?php echo \think\Session::get('session_user')['userId']; ?> <i class="fa fa-caret-down"></i>
                </a>
                
                <ul class="dropdown-menu arrow settings">
                  <li>                    
                    <h3>背景颜色:</h3>
                    <ul id="color-schemes">
                      <li><a href="#" class="bg-1"></a></li>
                      <li><a href="#" class="bg-2"></a></li>
                      <li><a href="#" class="bg-3"></a></li>
                      <li><a href="#" class="bg-4"></a></li>
                      <li><a href="#" class="bg-5"></a></li>
                      <li><a href="#" class="bg-6"></a></li>
                    </ul>

                  </li>

                  <li class="divider"></li>

                  <li>
                    <a href="http://localhost/public/index.php/frontend/Useropt/userinfo"><i class="fa fa-user"></i> 个人信息</a>
                  </li>

                  <li>
                    <a href="http://localhost/public/index.php/frontend/Useropt/memberModifyPwd"><i class="fa fa-pencil"></i> 修改密码</a>
                  </li>

                  <li class="divider"></li>

                  <li>
                    <a href="http://localhost/public/index.php/login/login/index"><i class="fa fa-power-off"></i> 登出</a>
                  </li>
                </ul>
              </li>
            </ul>
            <!-- /Quick Actions -->

            <!-- Sidebar -->
            <ul class="nav navbar-nav side-nav" id="sidebar">
              
              <li class="collapsed-content"> 
                <ul>
                  <li class="search"><!-- Collapsed search pasting here at 768px --></li>
                </ul>
              </li>

              <li class="navigation" id="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="#navigation">导航 <i class="fa fa-angle-up"></i></a>
                <ul class="menu">
                  <li class="active">
                    <a href="index.html">
                      <i class="fa fa-tachometer"></i> 主页
                      <span class="badge badge-red">1</span>
                    </a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-list"></i>我的团队 <b class="fa fa-plus dropdown-plus"></b>
                    </a>
                    <ul class="dropdown-menu">
                      <li>
                        <a href="/public/index.php/frontend/common/network">
                          <i class="fa fa-caret-right"></i> 网络结构
                        </a>
                      </li>
                      <li>
                        <a href="/public/index.php/frontend/common/introduce">
                          <i class="fa fa-caret-right"></i> 推荐结构
                        </a>
                      </li>
                    </ul>
                  </li>
                  <!-- <li>
                    <a href="widgets.html">
                      <i class="fa fa-play-circle"></i> 我的积分
                    </a>
                  </li> -->
                </ul>
              </li>

              <li class="summary" id="order-summary">
                <a href="#" class="sidebar-toggle underline" data-toggle="#order-summary">当前股价<i class="fa fa-angle-up"></i></a>

                <div class="media">
                  <div class="media-body">
                    <br>
                    <h3 class="media-heading">1.50</h3>
                  </div>
                </div>
              </li>            
            </ul>
            <!-- Sidebar end -->
          </div>
          <!--/.nav-collapse -->
        </div>
        <!-- Fixed navbar end -->
        
        <!-- main content -->
        
       <!-- Page content -->
        <div id="content" class="col-md-12">
          <!-- page header -->
          <div class="pageheader">
            <h2><i class="fa fa-tachometer"></i> 个人主页<span></span></h2>
            <div class="breadcrumbs">
              <ol class="breadcrumb">
                <li><a href="index.html">HELMS</a></li>
                <li class="active">主页</li>
              </ol>
            </div>
          </div>
          <!-- /page header -->

          <!-- content main container -->
          <div class="main">
          	 <!-- cards -->
            <div class="row cards">
              
              <div class="card-container col-lg-3 col-sm-6 col-sm-12">
                <div class="card card-redbrown hover">
                  <div class="front"> 

                    <div class="media">
                      <span class="pull-left">
                        <i class="fa fa-usd media-object"></i>
                      </span>

                      <div class="media-body">
                        <small>万能分</small>
                        <h2 class="media-heading animate-number" data-value='<?php echo $pass_data["universal_point"]; ?>'  data-animation-duration="10">0</h2>
                      </div>
                    </div>

                  </div>
                  <div class="back">
                    <a href="points">
                      <!-- <i class="fa fa-bar-chart-o fa-4x"></i> -->
                      <span>积分介绍</span>
                    </a>  
                  </div>
                </div>
              </div>
              
              <div class="card-container col-lg-3 col-sm-6 col-sm-12">
                <div class="card card-blue hover">
                  <div class="front">        
                    
                     <div class="media">
                      <span class="pull-left">
                        <i class="fa fa-usd media-object"></i>
                      </span>

                      <div class="media-body">
                        <small>奖励分</small>
                        <h2 class="media-heading animate-number" data-value='<?php echo $pass_data["bonus_point"]; ?>'  data-animation-duration="10">0</h2>
                      </div>
                    </div>

                  </div>
                  <div class="back">
                    <a href="#">
                      <!-- <i class="fa fa-bar-chart-o fa-4x"></i> -->
                      <span>积分介绍</span>
                    </a>
                  </div>
                </div>
              </div>



              <div class="card-container col-lg-3 col-sm-6 col-sm-12">
                <div class="card card-greensea hover">
                  <div class="front">        
                    
                    <div class="media">
                      <span class="pull-left">
                        <i class="fa fa-usd media-object"></i>
                      </span>

                      <div class="media-body">
                        <small>注册分</small>
                        <h2 class="media-heading animate-number" data-value='<?php echo $pass_data["regist_point"]; ?>' data-animation-duration="10">0</h2>
                      </div>
                    </div>

                  </div>
                  <div class="back">
                    <a href="points">
                      <!-- <i class="fa fa-bar-chart-o fa-4x"></i> -->
                      <span>积分介绍</span>
                    </a>
                  </div>
                </div>
              </div>


              <div class="card-container col-lg-3 col-sm-6 col-xs-12">
                <div class="card card-slategray hover">
                  <div class="front"> 

                    <div class="media">
                      <span class="pull-left">
                        <i class="fa fa-usd media-object"></i>
                      </span>

                      <div class="media-body">
                        <small>重复消费分</small>
                        <h2 class="media-heading animate-number" data-value='<?php echo $pass_data["re_consume"]; ?>' data-animation-duration="10">0</h2>
                      </div>
                    </div>

                  </div>
                  <div class="back">
                    <a href="#">
                      <!-- <i class="fa fa-bar-chart-o fa-4x"></i> -->
                      <span>积分介绍</span>
                    </a>
                  </div>
                </div>
              </div>
              
<!--               <div class="card-container col-lg-3 col-sm-6 col-sm-12">
                <div class="card card-hotpink hover">
                  <div class="front"> 

                    <div class="media">
                      <span class="pull-left">
                        <i class="fa fa-usd media-object"></i>
                      </span>

                      <div class="media-body">
                        <small>复投分</small>
                        <h2 class="media-heading animate-number" data-value='<?php echo $pass_data["re_cast"]; ?>' data-animation-duration="10">0</h2>
                      </div>
                    </div>

                  </div>
                  <div class="back">
                    <a href="#">
                      <i class="fa fa-bar-chart-o fa-4x"></i>
                      <span>积分介绍</span>
                    </a>  
                  </div>
                </div>
              </div> -->
              
              <div class="card-container col-lg-3 col-sm-6 col-sm-12">
                <div class="card card-cyan hover">
                  <div class="front"> 

                    <div class="media">
                      <span class="pull-left">
                        <i class="fa fa-usd media-object"></i>
                      </span>

                      <div class="media-body">
                        <small>共享分</small>
                        <h2 class="media-heading animate-number" data-value='<?php echo $pass_data["shares"]; ?>' data-animation-duration="10">0</h2>
                      </div>
                    </div>

                  </div>
                  <div class="back">
                    <a href="#">
                      <!-- <i class="fa fa-bar-chart-o fa-4x"></i> -->
                      <span>积分介绍</span>
                    </a>  
                  </div>
                </div>
              </div>
            </div>

 			<!-- row -->
            <div class="row">


              <!-- col 8 -->
              <div class="col-lg-8 col-md-12">

                <!-- tile -->
                <section class="tile transparent">

                  <!-- tile header -->
                  <div class="tile-header color transparent-black textured rounded-top-corners stock-price">
                    <h1><strong>股价趋势</strong> </h1>
                    <div class="controls">
                      <a href="#" class="reload"  reloadType="1">近一周</a>
                      <a href="#" class="reload" reloadType="2">近一个月</a>
                      <a href="#" class="reload" reloadType="3">近半年</a>
                      <a href="#" class="remove"><i class="fa fa-times"></i></a>
                    </div>
                  </div>
                  <!-- /tile header -->


                  <!-- tile widget -->
                  <div class="tile-widget color transparent-black textured">
                    <div id="statistics-chart" class="chart statistics" style="height: 350px;"></div>
                  </div>
                  <!-- /tile widget -->


                </section>
                <!-- /tile -->

              </div>
              <!-- /col 8 -->

               <!-- col 4 -->
              <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
               
                <!-- tile -->
                <section class="tile color transparent-black">



                  <!-- tile header -->
                  <div class="tile-header">
                    <h1><strong>新闻公告</strong></h1>
                    <div class="controls">
                      <a href="#" class="refresh"><i class="fa fa-refresh"></i></a>
                      <a href="#" class="remove"><i class="fa fa-times"></i></a>
                    </div>
                  </div>
                  <!-- /tile header -->

                  <!-- tile body -->
				  <div class="tile-body">
				  	<ul class="news-title">
  					  <li><a class="text-muted">aaaaaaa.</a></li>
  					  <li><a class="text-muted">bbbbbbbbbbbb.</a></li>
  					  <li><a href="/public/index.php/frontend/common/news"  class="text-muted">HELMS系统开始上线.</a></li>
					</ul>

                  </div>
                  <!-- /tile body --> 

                </section>
                <!-- /tile -->

              </div>
              <!-- /col 4 -->

            </div>
            <!-- /row -->

          </div>
          <!-- /content container -->

        </div>
        <!-- Page content end -->


      </div>
      <!-- Make page fluid-->

    </div>
    <!-- Wrap all page content end -->

  </body>
</html>
      

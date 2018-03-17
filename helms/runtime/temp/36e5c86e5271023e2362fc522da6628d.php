<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:92:"C:\Users\Administrator\git\helms\helms\public/../application/backend\view\common\option.html";i:1505921316;s:91:"C:\Users\Administrator\git\helms\helms\public/../application/backend\view\base\backend.html";i:1505921315;s:20:"base/common/css.html";i:1505921314;s:19:"base/common/js.html";i:1511877397;s:35:"base/common/backend/leftAndTop.html";i:1511971323;}*/ ?>
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
	


  </head>
  <body class="bg-1">

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
                    <a href="index">
                      <i class="fa fa-tachometer"></i> 主页
                      <span class="badge badge-red">1</span>
                    </a>
                  </li>
<!--                   <li class="dropdown">
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
                  </li> -->
                  <li>
                    <a href="memberList">
                      <i class="fa fa-play-circle"></i> 会员列表
                    </a>
                  </li>
                                    <li>
                    <a href="memberApplication">
                      <i class="fa fa-play-circle"></i> 会员申请
                    </a>
                  </li> 
                                    <li>
                    <a href="pointsDetails">
                      <i class="fa fa-play-circle"></i> 积分明细
                    </a>
                  </li> 
                                    <li>
                    <a href="pointsTransfer">
                      <i class="fa fa-play-circle"></i> 积分互转
                    </a>
                  </li> 
                                    <li>
                    <a href="incomeAndExpense">
                      <i class="fa fa-play-circle"></i> 收支明细
                    </a>
                  </li> 
                                    <li>
                    <a href="presentApplication">
                      <i class="fa fa-play-circle"></i> 提现申请
                    </a>
                  </li> 
                                    <li>
                    <a href="notice">
                      <i class="fa fa-play-circle"></i> 公告管理
                    </a>
                  </li>
                                                      <li>
                    <a href="option">
                      <i class="fa fa-play-circle"></i> 参数设置
                    </a>
                  </li>    
                                                      <li>
                    <a href="log">
                      <i class="fa fa-play-circle"></i> 操作日志
                    </a>
                  </li>  
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
        


      </div>
      <!-- Make page fluid-->

    </div>
    <!-- Wrap all page content end -->

  </body>
</html>
      

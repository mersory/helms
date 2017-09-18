<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:81:"C:\xampp\htdocs\tp5\public/../application/framework\view\useropt\registindex.html";i:1505311701;}*/ ?>
<!DOCTYPE html>
<html>
  <head>
    <title>HELMS - 主页</title>
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

  </head>
  <body class="bg-1">
    <!-- Preloader -->
    <!-- <div class="mask"><div id="loader"></div></div> -->
    <!--/Preloader -->

    <!-- Wrap all page content here -->
    <div id="wrap">
      <!-- Make page fluid -->
      <div class="row">

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
                
                <a class="dropdown-toggle button" data-toggle="dropdown" href="#">
                  <i class="fa fa-envelope"></i>
                  <span class="label label-transparent-black">1</span>
                </a>

                <ul class="dropdown-menu wider arrow nopadding messages">
                  <li><h1>You have <strong>1</strong> new message</h1></li>
                  <li>
                    <a class="cyan" href="#">
                      <div class="profile-photo">
                        <img src="_IMG_/ici-avatar.jpg" alt />
                      </div>
                      <div class="message-info">
                        <span class="sender">Ing. Imrich Kamarel</span>
                        <span class="time">12 mins</span>
                        <div class="message-content">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum</div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a class="green" href="#">
                      <div class="profile-photo">
                        <img src="_IMG_/arnold-avatar.jpg" alt />
                      </div>
                      <div class="message-info">
                        <span class="sender">Arnold Karlsberg</span>
                        <span class="time">1 hour</span>
                        <div class="message-content">Lorem ipsum dolor sit amet, consectetur adipisicing elit</div>
                      </div>
                    </a>
                  </li>

                  <li>
                    <a href="#">
                      <div class="profile-photo">
                        <img src="_IMG_/profile-photo.jpg" alt />
                      </div>
                      <div class="message-info">
                        <span class="sender">John Douey</span>
                        <span class="time">3 hours</span>
                        <div class="message-content">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a class="red" href="#">
                      <div class="profile-photo">
                        <img src="_IMG_/peter-avatar.jpg" alt />
                      </div>
                      <div class="message-info">
                        <span class="sender">Peter Kay</span>
                        <span class="time">5 hours</span>
                        <div class="message-content">Ut enim ad minim veniam, quis nostrud exercitation</div>
                      </div>
                    </a>
                  </li>

                  <li>
                    <a class="orange" href="#">
                      <div class="profile-photo">
                        <img src="_IMG_/george-avatar.jpg" alt />
                      </div>
                      <div class="message-info">
                        <span class="sender">George McCain</span>
                        <span class="time">6 hours</span>
                        <div class="message-content">Lorem ipsum dolor sit amet, consectetur adipisicing elit</div>
                      </div>
                    </a>
                  </li>
                  <li class="topborder"><a href="#">Check all messages <i class="fa fa-angle-right"></i></a></li>
                </ul>

              </li>

              <!-- 个人信息 -->
              <li class="dropdown divided user" id="current-user">
                <div class="profile-photo">
                  <img src="_IMG_/profile-photo.jpg" alt />
                </div>
                <a class="dropdown-toggle options" data-toggle="dropdown" href="#">
                  John Douey <i class="fa fa-caret-down"></i>
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
                    <a href="#"><i class="fa fa-user"></i> 个人信息</a>
                  </li>

                  <li>
                    <a href="#"><i class="fa fa-pencil"></i> 修改密码</a>
                  </li>

                  <li class="divider"></li>

                  <li>
                    <a href="#"><i class="fa fa-power-off"></i> Logout</a>
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
                      <i class="fa fa-list"></i> 我的团队 <b class="fa fa-plus dropdown-plus"></b>
                    </a>
                    <ul class="dropdown-menu">
                      <li>
                        <a href="form-elements.html">
                          <i class="fa fa-caret-right"></i> 网络结构
                        </a>
                      </li>
                      <li>
                        <a href="validation-elements.html">
                          <i class="fa fa-caret-right"></i> 推荐结构
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <a href="widgets.html">
                      <i class="fa fa-play-circle"></i> 我的积分
                    </a>
                  </li>
                </ul>
              </li>

              <li class="summary" id="order-summary">
                <a href="#" class="sidebar-toggle underline" data-toggle="#order-summary">当前股价 <i class="fa fa-angle-up"></i></a>

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

        
        <!-- Page content -->
        <div id="content" class="col-md-12">
          <!-- page header -->
          <div class="pageheader">
            <h2><i class="fa fa-tachometer"></i> 注册会员<span></span></h2>
            <div class="breadcrumbs">
              <ol class="breadcrumb">
                <li><a href="index.html">HELMS</a></li>
                <li class="active">注册会员</li>
              </ol>
            </div>
          </div>
          <!-- /page header -->

          <!-- content main container -->
          <div class="main">
          	<div class="row">
                <div class="col-md-6">
                  <section class="tile color transparent-black">



                  <!-- tile header -->
                  <div class="tile-header">
                    <h1><strong>注册会员</strong></h1>
                    <div class="controls">
                      <a href="#" class="refresh"><i class="fa fa-refresh"></i></a>
                      <a href="#" class="remove"><i class="fa fa-times"></i></a>
                    </div>
                  </div>
                  <!-- /tile header -->

                  <!-- tile body -->
                  <div class="tile-body">
                    
                    <form class="form-horizontal" action="UserRegist" method="post" role="form" parsley-validate="" id="basicvalidations">
                      
                      <div class="form-group">
                        <label for="fullname" class="col-sm-4 control-label">会员名 *</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control parsley-validated" name="fullname" id="fullname" parsley-trigger="change" parsley-required="true" parsley-minlength="4" parsley-validation-minlength="1">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="email" class="col-sm-4 control-label">邮箱 *</label>
                        <div class="col-sm-8">
                          <input type="email" class="form-control parsley-validated" name="email" id="email" parsley-trigger="change" parsley-required="true" parsley-minlength="4" parsley-type="email" parsley-validation-minlength="1">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="telphone" class="col-sm-4 control-label">手机号 *</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control parsley-validated" name="telphone" id="telphone" parsley-trigger="change" parsley-required="true" parsley-minlength="6" parsley-type="alphanum" parsley-validation-minlength="1">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="recommender" class="col-sm-4 control-label">推荐人 *</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control parsley-validated" name="recommender" id="recommender" parsley-trigger="change" parsley-required="true" parsley-minlength="6" parsley-type="alphanum" parsley-validation-minlength="1" parsley-equalto="#password">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="activator" class="col-sm-4 control-label">节点人 *</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control parsley-validated" name="activator" id="activator" parsley-trigger="change" parsley-minlength="4" parsley-type="url" parsley-validation-minlength="1">
                        </div>
                      </div>
					  <div class="form-group">
                        <label for="primarypwd" class="col-sm-4 control-label">一级密码 *</label>
                        <div class="col-sm-8">
                          <input type="password" class="form-control parsley-validated" name="primarypwd" id="primarypwd" parsley-trigger="change" parsley-minlength="4" parsley-type="url" parsley-validation-minlength="1">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="minorpwd" class="col-sm-4 control-label">二级密码 *</label>
                        <div class="col-sm-8">
                          <input type="password" class="form-control parsley-validated" name="minorpwd" id="minorpwd" parsley-trigger="change" parsley-minlength="4" parsley-type="url" parsley-validation-minlength="1">
                        </div>
                      </div>
                      <div class="form-group form-footer">
                        <div class="col-sm-offset-4 col-sm-8">
                          <button type="submit" class="btn btn-primary">注册</button>
                        </div>
                      </div>

                    </form>

                  </div>
                  <!-- /tile body -->
                  
                


                </section>
                </div>
            </div>
          </div>
          <!-- /content container -->

        </div>
        <!-- Page content end -->

      </div>
      <!-- Make page fluid-->




    </div>
    <!-- Wrap all page content end -->



    <section class="videocontent" id="video"></section>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="_JS_/vendor/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="_JS_/vendor/mmenu/js/jquery.mmenu.min.js"></script>
    <script type="text/javascript" src="_JS_/vendor/sparkline/jquery.sparkline.min.js"></script>
    <script type="text/javascript" src="_JS_/vendor/nicescroll/jquery.nicescroll.min.js"></script>
    <script type="text/javascript" src="_JS_/vendor/animate-numbers/jquery.animateNumbers.js"></script>
    <script type="text/javascript" src="_JS_/vendor/videobackground/jquery.videobackground.js"></script>
    <script type="text/javascript" src="_JS_/vendor/blockui/jquery.blockUI.js"></script>

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

    <script src="_JS_/minimal.min.js"></script>

    <script>
    $(function(){

      // Initialize card flip
      $('.card.hover').hover(function(){
        $(this).addClass('flip');
      },function(){
        $(this).removeClass('flip');
      });

      // Initialize flot chart
      var d1 =[ [1, 1.0],
            [2, 1.1],
            [3, 1.3],
            [4, 2.0],
            [5, 1.2],
            [6, 1.4],
            [7, 1.5]
      ];

      var days = ["03.02", "03.03", "03.04", "03.05", "03.06", "03.07", "03.08"];

      // 股价趋势
      var plot = $.plotAnimator($("#statistics-chart"), 
        [
          {
            label: 'Sales', 
            data: d1,    
            lines: {lineWidth:3}, 
            shadowSize:0,
            color: '#ffffff'
          },
          {
            label: 'Sales',
            data: d1, 
            points: { show: true, fill: true, radius:6,fillColor:"rgba(0,0,0,.5)",lineWidth:2 }, 
            color: '#fff',        
            shadowSize:0
          }
        ],{ 
        
        xaxis: {

          tickLength: 0,
          tickDecimals: 0,
          min:1,
          ticks: [[1,"03.02"], [2, "03.03"], [3, "03.04"], [4, "03.05"], [5, "03.06"], [6, "03.07"], [7, "03.08"]],

          font :{
            lineHeight: 24,
            weight: "300",
            color: "#ffffff",
            size: 14
          }
        },
        
        yaxis: {
          ticks: 4,
          tickDecimals: 0,
          tickColor: "rgba(255,255,255,.3)",

          font :{
            lineHeight: 13,
            weight: "300",
            color: "#ffffff"
          }
        },
        
        grid: {
          borderWidth: {
            top: 0,
            right: 0,
            bottom: 1,
            left: 1
          },
          borderColor: 'rgba(255,255,255,.3)',
          margin:0,
          minBorderMargin:0,              
          labelMargin:20,
          hoverable: true,
          clickable: true,
          mouseActiveRadius:6
        },
        
        legend: { show: false}
      });

      $(window).resize(function() {
        // redraw the graph in the correctly sized div
        plot.resize();
        plot.setupGrid();
        plot.draw();
      });

      $('#mmenu').on(
        "opened.mm",
        function()
        {
          // redraw the graph in the correctly sized div
          plot.resize();
          plot.setupGrid();
          plot.draw();
        }
      );

      $('#mmenu').on(
        "closed.mm",
        function()
        {
          // redraw the graph in the correctly sized div
          plot.resize();
          plot.setupGrid();
          plot.draw();
        }
      );

      // tooltips showing
      $("#statistics-chart").bind("plothover", function (event, pos, item) {
        if (item) {
          var x = item.datapoint[0],
              y = item.datapoint[1];

          $("#tooltip").html('<h1 style="color: #418bca">' + days[x - 1] + '</h1>' + '<strong>' + y + '</strong>' + ' ' + item.series.label)
            .css({top: item.pageY-30, left: item.pageX+5})
            .fadeIn(200);
        } else {
          $("#tooltip").hide();
        }
      });

      
      //tooltips options
      $("<div id='tooltip'></div>").css({
        position: "absolute",
        //display: "none",
        padding: "10px 20px",
        "background-color": "#ffffff",
        "z-index":"99999"
      }).appendTo("body");

      //generate actual pie charts
      $('.pie-chart').easyPieChart();


      //server load rickshaw chart
      var graph;

      var seriesData = [ [], []];
      var random = new Rickshaw.Fixtures.RandomData(50);

      for (var i = 0; i < 50; i++) {
        random.addData(seriesData);
      }

      graph = new Rickshaw.Graph( {
        element: document.querySelector("#serverload-chart"),
        height: 150,
        renderer: 'area',
        series: [
          {
            data: seriesData[0],
            color: '#6e6e6e',
            name:'File Server'
          },{
            data: seriesData[1],
            color: '#fff',
            name:'Mail Server'
          }
        ]
      } );

      var hoverDetail = new Rickshaw.Graph.HoverDetail( {
        graph: graph,
      });

      setInterval( function() {
        random.removeData(seriesData);
        random.addData(seriesData);
        graph.update();

      },1000);

      // Morris donut chart
      Morris.Donut({
        element: 'browser-usage',
        data: [
          {label: "Chrome", value: 25},
          {label: "Safari", value: 20},
          {label: "Firefox", value: 15},
          {label: "Opera", value: 5},
          {label: "Internet Explorer", value: 10},
          {label: "Other", value: 25}
        ],
        colors: ['#00a3d8', '#2fbbe8', '#72cae7', '#d9544f', '#ffc100', '#1693A5']
      });

      $('#browser-usage').find("path[stroke='#ffffff']").attr('stroke', 'rgba(0,0,0,0)');

      //sparkline charts
      $('#projectbar1').sparkline('html', {type: 'bar', barColor: '#22beef', barWidth: 4, height: 20});
      $('#projectbar2').sparkline('html', {type: 'bar', barColor: '#cd97eb', barWidth: 4, height: 20});
      $('#projectbar3').sparkline('html', {type: 'bar', barColor: '#a2d200', barWidth: 4, height: 20});
      $('#projectbar4').sparkline('html', {type: 'bar', barColor: '#ffc100', barWidth: 4, height: 20});
      $('#projectbar5').sparkline('html', {type: 'bar', barColor: '#ff4a43', barWidth: 4, height: 20});
      $('#projectbar6').sparkline('html', {type: 'bar', barColor: '#a2d200', barWidth: 4, height: 20});

      // sortable table
      $('.table.table-sortable th.sortable').click(function() {
        var o = $(this).hasClass('sort-asc') ? 'sort-desc' : 'sort-asc';
        $('th.sortable').removeClass('sort-asc').removeClass('sort-desc');
        $(this).addClass(o);
      });

      //todo's
      $('#todolist li label').click(function() {
        $(this).toggleClass('done');
      });

      // Initialize tabDrop
      $('.tabdrop').tabdrop({text: '<i class="fa fa-th-list"></i>'});

      //load wysiwyg editor
      $('#quick-message-content').summernote({
        toolbar: [
          //['style', ['style']], // no style button
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['height', ['height']],
          //['insert', ['picture', 'link']], // no insert buttons
          //['table', ['table']], // no table button
          //['help', ['help']] //no help button
        ],
        height: 143   //set editable area's height
      });

      //multiselect input
      $(".chosen-select").chosen({disable_search_threshold: 10});
      
    })
      
    </script>
  </body>
</html>
      

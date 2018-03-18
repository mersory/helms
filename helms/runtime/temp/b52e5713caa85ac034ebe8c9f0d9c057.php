<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:103:"E:\Software\php\workspace\helms\helms\public/../application/backend\view\common\presentapplication.html";i:1521316965;s:90:"E:\Software\php\workspace\helms\helms\public/../application/backend\view\base\backend.html";i:1521316965;s:20:"base/common/css.html";i:1511359924;s:19:"base/common/js.html";i:1521323241;s:35:"base/common/backend/leftAndTop.html";i:1521323144;}*/ ?>
<!DOCTYPE html>
<html>
  <head>
    <title>HERMS - <block name="title">标题</block></title>
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
<script src="_JS_/vendor/datepicker/bootstrap-datetimepicker.min.js"></script>

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
	
<script type="text/javascript" src="_JS_/common/admin/withdrawapply.js"></script>


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
              <strong>HERMS</strong>
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
                    <a href="/public/index.php/frontend/Useropt/userinfo"><i class="fa fa-user"></i> 个人信息</a>
                  </li>

                  <li>
                    <a href="/public/index.php/frontend/Useropt/memberModifyPwd"><i class="fa fa-pencil"></i> 修改密码</a>
                  </li>

                  <li class="divider"></li>

                  <li>
                    <a href="/public/index.php/login/login/index"><i class="fa fa-power-off"></i> 登出</a>
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
        
  
        <!-- Page content -->
        <div id="content" class="col-md-12">
          <!-- page header -->
          <div class="pageheader">
            <h2><i class="fa fa-tachometer"></i> 提现申请<span></span></h2>
            <div class="breadcrumbs">
              <ol class="breadcrumb">
                <li><a href="index.html">HERMS</a></li>
                <li class="active">提现申请</li>
              </ol>
            </div>
          </div>
          <!-- /page header -->

          <!-- content main container -->
          <div class="main">
          	<div class="row">
                <div class="col-md-10">
                 <section class="tile color transparent-white">

                  <!-- tile widget -->
                  <div class="tile-widget bg-transparent-white-2">
                      
                      <div class="form-group">
                        <label for="input01" class="col-sm-2 control-label">会员ID</label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control" id="userid">
                        </div>
                        <label for="input01" class="col-sm-2 control-label">当前状态</label>
                        <div class="col-sm-2">
                          <div class="input-group-btn">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">所有 <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                              <li><a href="#">待审核</a></li>
                              <li><a href="#">已通过</a></li>
                              <li><a href="#">已完成</a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="input01" class="col-sm-2 control-label">提现申请时间</label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control" id="input01">
                        </div>
                        <div class="col-sm-2">
                          <input type="text" class="form-control" id="input01">
                        </div>
                      </div>
					  <div>
                          <input type="datetime-local" class="form-control" value="YYYY-MM-DDThh:mm:ss:s" id="withdraw_start">
                      </div>
                      <div>
                           <input type="datetime-local" class="form-control" value="YYYY-MM-DDThh:mm:ss:s" id="withdraw_end">
                      </div>
                      <div class="form-group form-footer">
                        <div class="col-sm-10 text-center">
                          <button type="submit" class="btn btn-primary" id="withdraw_application">搜索</button>
                        </div>
                      </div>
                  </div>
                  <!-- tile widget -->

                  <!-- tile header -->
                  <div class="tile-header">
                    <h1><strong>积分互转</strong></h1>
                    <div class="controls">
                      <a href="#" class="refresh"><i class="fa fa-refresh"></i></a>
                      <a href="#" class="remove"><i class="fa fa-times"></i></a>
                    </div>
                  </div>
                  <!-- /tile header -->

                  <!-- tile body -->
                  <div class="tile-body no-vpadding">
                    
                    <table class="table table-custom" id="withdraw_list_table">
                      <thead>
                        <tr>
                          <th class="sort-asc">序号</th>
                          <th class="sort-asc">会员ID</th>
                          <th class="sort-numeric">提现类型</th>
                          <th class="sort-amount">提现金额</th>
                          <th class="sort-amount">提现申请时间</th>
                          <th class="sort-amount">当前状态</th>
                          <th class="sort-amount">审核人</th>
                          <th class="sort-amount">审核时间</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>123141</td>
                          <td>万能分提现</td>
                          <td>500</td>
                          <td>2017-12-21 14:00:00</td>
                          <td>已审核通过</td>
                          <td>admin-1</td>
                          <td>2017-12-21 15:00:00</td>
                        </tr>
                      </tbody>
                    </table>

                  </div>
                  <!-- /tile body -->


                  <!-- tile footer -->
                  <div class="tile-footer bg-transparent-white-2 rounded-bottom-corners">
                    <div class="row">  
                      
                      <div class="col-sm-4">
                        <small class="inline table-options paging-info">showing 1-3 of 24 items</small>
                      </div>

                      <div class="col-sm-4 text-center sm-center">
                        <ul class="pagination pagination-xs nomargin pagination-custom">
                          <li class="disabled"><a href="#"><i class="fa fa-angle-double-left"></i></a></li>
                          <li class="active"><a href="#">1</a></li>
                          <li><a href="#">2</a></li>
                          <li><a href="#">3</a></li>
                          <li><a href="#">4</a></li>
                          <li><a href="#">5</a></li>
                          <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
                        </ul>
                      </div>

                    </div>
                  </div>

                </section>
              </div>
            </div>
          </div>
          <!-- /content container -->

        </div>
        <!-- Page content end -->
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


      </div>
      <!-- Make page fluid-->

    </div>
    <!-- Wrap all page content end -->

  </body>
</html>
      

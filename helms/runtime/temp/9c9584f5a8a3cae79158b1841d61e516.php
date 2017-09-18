<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"D:\helms\tp5\public/../application/framework\view\adminopt\userapplylist.html";i:1505042130;}*/ ?>
<!DOCTYPE html>
<html>
  <head>
    <title>HELMS - 主页</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8" />

    <link rel="icon" type="image/ico" href="http://tattek.com/minimal/assets/images/favicon.ico" />
    <!-- Bootstrap -->
    <link href="../assets/css/vendor/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/vendor/animate/animate.min.css">
    <link type="text/css" rel="stylesheet" media="all" href="../assets/js/vendor/mmenu/css/jquery.mmenu.all.css" />
    <link rel="stylesheet" href="../assets/js/vendor/videobackground/css/jquery.videobackground.css">
    <link rel="stylesheet" href="../assets/css/vendor/bootstrap-checkbox.css">

    <link rel="stylesheet" href="../assets/js/vendor/rickshaw/css/rickshaw.min.css">
    <link rel="stylesheet" href="../assets/js/vendor/morris/css/morris.css">
    <link rel="stylesheet" href="../assets/js/vendor/tabdrop/css/tabdrop.css">
    <link rel="stylesheet" href="../assets/js/vendor/summernote/css/summernote.css">
    <link rel="stylesheet" href="../assets/js/vendor/summernote/css/summernote-bs3.css">
    <link rel="stylesheet" href="../assets/js/vendor/chosen/css/chosen.min.css">
    <link rel="stylesheet" href="../assets/js/vendor/chosen/css/chosen-bootstrap.css">

    <link href="../assets/css/minimal.css" rel="stylesheet">
    <link href="../assets/css/main.css" rel="stylesheet">

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
                        <img src="../assets/images/ici-avatar.jpg" alt />
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
                        <img src="../assets/images/arnold-avatar.jpg" alt />
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
                        <img src="../assets/images/profile-photo.jpg" alt />
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
                        <img src="../assets/images/peter-avatar.jpg" alt />
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
                        <img src="../assets/images/george-avatar.jpg" alt />
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
                  <img src="../assets/images/profile-photo.jpg" alt />
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
            <h2><i class="fa fa-tachometer"></i> 会员申请<span></span></h2>
            <div class="breadcrumbs">
              <ol class="breadcrumb">
                <li><a href="index.html">HELMS</a></li>
                <li class="active">会员申请</li>
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
                      <form class="form-horizontal" role="form" action="UserApply" method="post" id="SubmitForm">
                      <div class="form-group">
                        <label for="input01" class="col-sm-2 control-label">申请时间</label>
                        <div class="col-sm-2">
                          <input type="datetime-local" class="form-control" name="begin" id="begin">
                        </div>
                        <div class="col-sm-2">
                          <input type="datetime-local" class="form-control" name="end" id="end">
                        </div>
                      </div>
                      <div class="form-group form-footer">
                        <div class="col-sm-10 text-center">
                          <button type="submit" class="btn btn-primary">搜索</button>
                        </div>
                      </div>
                      </form>
                  </div>
                  <!-- tile widget -->

                  <!-- tile header -->
                  <div class="tile-header">
                    <h1><strong>会员申请</strong></h1>
                    <div class="controls">
                      <a href="#" class="refresh"><i class="fa fa-refresh"></i></a>
                      <a href="#" class="remove"><i class="fa fa-times"></i></a>
                    </div>
                  </div>
                  <!-- /tile header -->

                  <!-- tile body -->
                  <div class="tile-body no-vpadding">
                    
                    <table class="table table-custom">
                      <thead>
                        <tr>
                          <th class="sort-numeric">序号</th>
                          <th class="sort-numeric">会员名</th>
                          <th class="sort-amount">手机号</th>
                          <th class="sort-amount">邮箱</th>
                          <th class="sort-amount">申请时间</th>
                          <th class="sort-amount">申请人会员ID</th>
                          <th style="width: 30px;"></th>
                        </tr>
                      </thead>
                       <form action="UserApproval" method="post" id="SubmitForm">
                        <tbody>
                         <tr> 
                          <td><input type="text" class="form-control" name="userid" id="userid"></td>
                          <td>Mark</td>
                          <td>13844144322</td>
                          <td>afasdfasdf@mdo.com</td>
                          <td>2017-12-12 10:00:00</td>
                          <td>1231231</td>
                          <td class="text-center"><button type="submit" class="btn btn-primary">通过</button></td>
                        </tr>
                      </tbody>
                     </form>
                     
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

      </div>
      <!-- Make page fluid-->




    </div>
    <!-- Wrap all page content end -->



    <section class="videocontent" id="video"></section>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../assets/js/vendor/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/vendor/mmenu/js/jquery.mmenu.min.js"></script>
    <script type="text/javascript" src="../assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>
    <script type="text/javascript" src="../assets/js/vendor/nicescroll/jquery.nicescroll.min.js"></script>
    <script type="text/javascript" src="../assets/js/vendor/animate-numbers/jquery.animateNumbers.js"></script>
    <script type="text/javascript" src="../assets/js/vendor/videobackground/jquery.videobackground.js"></script>
    <script type="text/javascript" src="../assets/js/vendor/blockui/jquery.blockUI.js"></script>

    <script src="../assets/js/vendor/flot/jquery.flot.min.js"></script>
    <script src="../assets/js/vendor/flot/jquery.flot.time.min.js"></script>
    <script src="../assets/js/vendor/flot/jquery.flot.selection.min.js"></script>
    <script src="../assets/js/vendor/flot/jquery.flot.animator.min.js"></script>
    <script src="../assets/js/vendor/flot/jquery.flot.orderBars.js"></script>
    <script src="../assets/js/vendor/easypiechart/jquery.easypiechart.min.js"></script>

    <script src="../assets/js/vendor/rickshaw/raphael-min.js"></script> 
    <script src="../assets/js/vendor/rickshaw/d3.v2.js"></script>
    <script src="../assets/js/vendor/rickshaw/rickshaw.min.js"></script>

    <script src="../assets/js/vendor/morris/morris.min.js"></script>

    <script src="../assets/js/vendor/tabdrop/bootstrap-tabdrop.min.js"></script>

    <script src="../assets/js/vendor/summernote/summernote.min.js"></script>

    <script src="../assets/js/vendor/chosen/chosen.jquery.min.js"></script>

    <script src="../assets/js/minimal.min.js"></script>

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
      

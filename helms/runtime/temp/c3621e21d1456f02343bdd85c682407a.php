<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:94:"C:\Users\Administrator\git\helms\helms\public/../application/frontend\view\common\network.html";i:1506529546;s:93:"C:\Users\Administrator\git\helms\helms\public/../application/frontend\view\base\frontend.html";i:1505921317;s:20:"base/common/css.html";i:1505921314;s:19:"base/common/js.html";i:1505921315;s:36:"base/common/frontend/leftAndTop.html";i:1506529931;}*/ ?>
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
    
    <section class="videocontent" id="video"></section>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="_JS_/vendor/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="_JS_/vendor/mmenu/js/jquery.mmenu.min.js"></script>
    <script type="text/javascript" src="_JS_/vendor/sparkline/jquery.sparkline.min.js"></script>
    <script type="text/javascript" src="_JS_/vendor/nicescroll/jquery.nicescroll.min.js"></script>
    <script type="text/javascript" src="_JS_/vendor/animate-numbers/jquery.animateNumbers.js"></script>
    <script type="text/javascript" src="_JS_/vendor/videobackground/jquery.videobackground.js"></script>
    <script type="text/javascript" src="_JS_/vendor/blockui/jquery.blockUI.js"></script>


	
	<!-- custom css -->
	 
	<!-- custom js -->
	
<script type="text/javascript" src="_JS_/common/index.js"></script>


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
                    <a href="#"><i class="fa fa-user"></i> 个人信息</a>
                  </li>

                  <li>
                    <a href="#"><i class="fa fa-pencil"></i> 修改密码</a>
                  </li>

                  <li class="divider"></li>

                  <li>
                    <a href="#"><i class="fa fa-power-off"></i> 登出</a>
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
		<h2>
			<i class="fa fa-tachometer"></i> 网络结构<span></span>
		</h2>
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="index.html">HELMS</a></li>
				<li class="active">网络结构</li>
			</ol>
		</div>
	</div>
	<!-- /page header -->
	    <script src="_JS_/fabric.min.js"></script>
	    <style>  
      body {  
        position:absolute;    
      }  
      pre { margin-left: 15px !important }   
      #pop{  
          position:absolute;  
          left:0px;  
          top :0px;  
          width:200px;  
          height:280px;  
   
          border-radius:10px;  
          border:solid 5px #333;  
          padding:10px;  
          font-size:10px;  
          background:#999;  
          overflow:hidden;  
          display:none;  
          z-index:100;  
      }  
      table{  
          width:100%;  
          height:100%;    
      }  
       table tr td:nth-child(1){  
          width:50%;  
             
      }  
      table tr td:nth-child(2){  
          font-weight:bold;  
          color:#F00;    
      }  
   
      b {  
          color:#F00  ;  
      }  
    </style> 

	<!-- content main container -->
	<div class="main">
		<div class="row">
			<div class="col-md-10">
				<section class="tile color transparent-white news-content">

					<div class="tile-widget bg-transparent-white-2">
						<form class="form-horizontal" role="form">
							<div class="form-group">
								<label for="input01" class="col-sm-2 control-label">会员ID</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="input01">
								</div>
							</div>
							<div class="form-group form-footer">
								<div class="col-sm-10 text-center">
									<button type="submit" class="btn btn-primary">搜索</button>
								</div>
							</div>
						</form>
					</div>

					<!-- tile body -->
					<div class="tile-body">

						<canvas id="c" width="2440" height="800"
							style="border: 1px solid #ccc"></canvas>

						<div id="pop">
							<table>
								<tr>
									<td>res_no:</td>
									<td><span id="p1"></span></td>
								</tr>
								<tr>
									<td>res_type:</td>
									<td><span id="p2"></span></td>
								</tr>
								<tr>
									<td>parent_element:</td>
									<td><span id="p3"></span></td>
								</tr>
								<tr>
									<td>left_p:</td>
									<td><span id="p4"></span></td>
								</tr>
								<tr>
									<td>rigth_p:</td>
									<td><span id="p5"></span></td>
								</tr>
								<tr>
									<td>left_s:</td>
									<td><span id="p6"></span></td>
								</tr>
								<tr>
									<td>right_s:</td>
									<td><span id="p7"></span></td>
								</tr>
								<tr>
									<td>child_s:</td>
									<td><span id="p8"></span></td>
								</tr>
								<tr>
									<td>bmlm_base:</td>
									<td><span id="p9"></span></td>
								</tr>
								<tr>
									<td>level:</td>
									<td><span id="p10"></span></td>
								</tr>
							</table>

						</div>
						<!-- /tile body -->
				</section>
			</div>
		</div>
	</div>
	<!-- /content container -->

</div>
<!-- Page content end -->
<script>
	$(function() {

		// Initialize card flip
		$('.card.hover').hover(function() {
			$(this).addClass('flip');
		}, function() {
			$(this).removeClass('flip');
		});

		// Initialize flot chart
		var d1 = [ [ 1, 1.0 ], [ 2, 1.1 ], [ 3, 1.3 ], [ 4, 2.0 ], [ 5, 1.2 ],
				[ 6, 1.4 ], [ 7, 1.5 ] ];

		var days = [ "03.02", "03.03", "03.04", "03.05", "03.06", "03.07",
				"03.08" ];

		// 股价趋势
		var plot = $.plotAnimator($("#statistics-chart"), [ {
			label : 'Sales',
			data : d1,
			lines : {
				lineWidth : 3
			},
			shadowSize : 0,
			color : '#ffffff'
		}, {
			label : 'Sales',
			data : d1,
			points : {
				show : true,
				fill : true,
				radius : 6,
				fillColor : "rgba(0,0,0,.5)",
				lineWidth : 2
			},
			color : '#fff',
			shadowSize : 0
		} ], {

			xaxis : {

				tickLength : 0,
				tickDecimals : 0,
				min : 1,
				ticks : [ [ 1, "03.02" ], [ 2, "03.03" ], [ 3, "03.04" ],
						[ 4, "03.05" ], [ 5, "03.06" ], [ 6, "03.07" ],
						[ 7, "03.08" ] ],

				font : {
					lineHeight : 24,
					weight : "300",
					color : "#ffffff",
					size : 14
				}
			},

			yaxis : {
				ticks : 4,
				tickDecimals : 0,
				tickColor : "rgba(255,255,255,.3)",

				font : {
					lineHeight : 13,
					weight : "300",
					color : "#ffffff"
				}
			},

			grid : {
				borderWidth : {
					top : 0,
					right : 0,
					bottom : 1,
					left : 1
				},
				borderColor : 'rgba(255,255,255,.3)',
				margin : 0,
				minBorderMargin : 0,
				labelMargin : 20,
				hoverable : true,
				clickable : true,
				mouseActiveRadius : 6
			},

			legend : {
				show : false
			}
		});

		$(window).resize(function() {
			// redraw the graph in the correctly sized div
			plot.resize();
			plot.setupGrid();
			plot.draw();
		});

		$('#mmenu').on("opened.mm", function() {
			// redraw the graph in the correctly sized div
			plot.resize();
			plot.setupGrid();
			plot.draw();
		});

		$('#mmenu').on("closed.mm", function() {
			// redraw the graph in the correctly sized div
			plot.resize();
			plot.setupGrid();
			plot.draw();
		});

		// tooltips showing
		$("#statistics-chart").bind(
				"plothover",
				function(event, pos, item) {
					if (item) {
						var x = item.datapoint[0], y = item.datapoint[1];

						$("#tooltip")
								.html(
										'<h1 style="color: #418bca">'
												+ days[x - 1] + '</h1>'
												+ '<strong>' + y + '</strong>'
												+ ' ' + item.series.label).css(
										{
											top : item.pageY - 30,
											left : item.pageX + 5
										}).fadeIn(200);
					} else {
						$("#tooltip").hide();
					}
				});

		//tooltips options
		$("<div id='tooltip'></div>").css({
			position : "absolute",
			//display: "none",
			padding : "10px 20px",
			"background-color" : "#ffffff",
			"z-index" : "99999"
		}).appendTo("body");

		//generate actual pie charts
		$('.pie-chart').easyPieChart();

		//server load rickshaw chart
		var graph;

		var seriesData = [ [], [] ];
		var random = new Rickshaw.Fixtures.RandomData(50);

		for (var i = 0; i < 50; i++) {
			random.addData(seriesData);
		}

		graph = new Rickshaw.Graph({
			element : document.querySelector("#serverload-chart"),
			height : 150,
			renderer : 'area',
			series : [ {
				data : seriesData[0],
				color : '#6e6e6e',
				name : 'File Server'
			}, {
				data : seriesData[1],
				color : '#fff',
				name : 'Mail Server'
			} ]
		});

		var hoverDetail = new Rickshaw.Graph.HoverDetail({
			graph : graph,
		});

		setInterval(function() {
			random.removeData(seriesData);
			random.addData(seriesData);
			graph.update();

		}, 1000);

		// Morris donut chart
		Morris.Donut({
			element : 'browser-usage',
			data : [ {
				label : "Chrome",
				value : 25
			}, {
				label : "Safari",
				value : 20
			}, {
				label : "Firefox",
				value : 15
			}, {
				label : "Opera",
				value : 5
			}, {
				label : "Internet Explorer",
				value : 10
			}, {
				label : "Other",
				value : 25
			} ],
			colors : [ '#00a3d8', '#2fbbe8', '#72cae7', '#d9544f', '#ffc100',
					'#1693A5' ]
		});

		$('#browser-usage').find("path[stroke='#ffffff']").attr('stroke',
				'rgba(0,0,0,0)');

		//sparkline charts
		$('#projectbar1').sparkline('html', {
			type : 'bar',
			barColor : '#22beef',
			barWidth : 4,
			height : 20
		});
		$('#projectbar2').sparkline('html', {
			type : 'bar',
			barColor : '#cd97eb',
			barWidth : 4,
			height : 20
		});
		$('#projectbar3').sparkline('html', {
			type : 'bar',
			barColor : '#a2d200',
			barWidth : 4,
			height : 20
		});
		$('#projectbar4').sparkline('html', {
			type : 'bar',
			barColor : '#ffc100',
			barWidth : 4,
			height : 20
		});
		$('#projectbar5').sparkline('html', {
			type : 'bar',
			barColor : '#ff4a43',
			barWidth : 4,
			height : 20
		});
		$('#projectbar6').sparkline('html', {
			type : 'bar',
			barColor : '#a2d200',
			barWidth : 4,
			height : 20
		});

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
		$('.tabdrop').tabdrop({
			text : '<i class="fa fa-th-list"></i>'
		});

		//load wysiwyg editor
		$('#quick-message-content').summernote(
				{
					toolbar : [
					//['style', ['style']], // no style button
					[ 'style', [ 'bold', 'italic', 'underline', 'clear' ] ],
							[ 'fontsize', [ 'fontsize' ] ],
							[ 'color', [ 'color' ] ],
							[ 'para', [ 'ul', 'ol', 'paragraph' ] ],
							[ 'height', [ 'height' ] ],
					//['insert', ['picture', 'link']], // no insert buttons
					//['table', ['table']], // no table button
					//['help', ['help']] //no help button
					],
					height : 143
				//set editable area's height
				});

		//multiselect input
		$(".chosen-select").chosen({
			disable_search_threshold : 10
		});

	})

	//绘制二叉树
	var canvas = this.__canvas = new fabric.canvas('c', {
		selection : false
	}), mouseX, mouseY; //鼠标位置  
	canvas.isDrawingMode = false;
	fabric.Object.prototype.originX = fabric.Object.prototype.originY = 'center';
	//fabric.Object.prototype.originX = 1920;  
	//fabric.Object.prototype.originY = 100;  

	var res_no = {};
	var nodeArr = [
	//第一层  
	{

		res_no : 1001, //资源号  
		res_type : 'S', //资源类型  
		parent_element : null,//父元素  
		left_p : 0, //左边积分数  
		rigth_p : 0, //右边积分数  
		left_s : 0, //左边点个数  
		right_s : 0, //右边点个数  
		child_s : 0, //子节点个数  
		bmlm_base : 0, //再增值产考基数  
		level : 1, //展现的层数  

		parentId : null,
		selfId : 1
	},
	//第二层  
	{

		res_no : 1002, //资源号  
		res_type : 'S', //资源类型  
		parent_element : res_no,//父元素  
		left_p : 0, //左边积分数  
		rigth_p : 0, //右边积分数  
		left_s : 0, //左边点个数  
		right_s : 0, //右边点个数  
		child_s : 0, //子节点个数  
		bmlm_base : 0, //再增值产考基数  
		level : 1, //展现的层数  

		parentId : 1,
		selfId : 2,

	},
	//第二层  
	{

		res_no : 1003, //资源号  
		res_type : 'S', //资源类型  
		parent_element : res_no,//父元素  
		left_p : 0, //左边积分数  
		rigth_p : 0, //右边积分数  
		left_s : 0, //左边点个数  
		right_s : 0, //右边点个数  
		child_s : 0, //子节点个数  
		bmlm_base : 0, //再增值产考基数  
		level : 1, //展现的层数   
		parentId : 1,
		selfId : 3
	},
	//第三层  
	{

		res_no : 1004, //资源号  
		res_type : 'S', //资源类型  
		parent_element : res_no,//父元素  
		left_p : 0, //左边积分数  
		rigth_p : 0, //右边积分数  
		left_s : 0, //左边点个数  
		right_s : 0, //右边点个数  
		child_s : 0, //子节点个数  
		bmlm_base : 0, //再增值产考基数  
		level : 1, //展现的层数   
		parentId : 2,
		selfId : 4
	},
	//第三层  
	{

		res_no : 1005, //资源号  
		res_type : 'S', //资源类型  
		parent_element : res_no,//父元素  
		left_p : 0, //左边积分数  
		rigth_p : 0, //右边积分数  
		left_s : 0, //左边点个数  
		right_s : 0, //右边点个数  
		child_s : 0, //子节点个数  
		bmlm_base : 0, //再增值产考基数  
		level : 1, //展现的层数   
		parentId : 2,
		selfId : 5
	},

	//第三层  
	{

		res_no : 1006, //资源号  
		res_type : 'S', //资源类型  
		parent_element : res_no,//父元素  
		left_p : 0, //左边积分数  
		rigth_p : 0, //右边积分数  
		left_s : 0, //左边点个数  
		right_s : 0, //右边点个数  
		child_s : 0, //子节点个数  
		bmlm_base : 0, //再增值产考基数  
		level : 1, //展现的层数   
		parentId : 3,
		selfId : 6
	},
	//第三层  
	{

		res_no : 1007, //资源号  
		res_type : 'S', //资源类型  
		parent_element : res_no,//父元素  
		left_p : 0, //左边积分数  
		rigth_p : 0, //右边积分数  
		left_s : 0, //左边点个数  
		right_s : 0, //右边点个数  
		child_s : 0, //子节点个数  
		bmlm_base : 0, //再增值产考基数  
		level : 1, //展现的层数   
		parentId : 3,
		selfId : 7
	},
	];

	//设置鼠标位置  
	function mousePosition(ev) {
		if (ev.pageX || ev.pageY) {
			return {
				x : ev.pageX,
				y : ev.pageY
			};
		}
		return {
			x : ev.clientX + document.body.scrollLeft
					- document.body.clientLeft,
			y : ev.clientY + document.body.scrollTop - document.body.clientTop
		};
	}
	document.onmousemove = function(ev) {
		var mousePos = mousePosition(ev);
		mouseX = mousePos.x;
		mouseY = mousePos.y;
		//console.log(mouseX +' | '+mouseY);   
	};

	var createNode = function(nodeObj) {
		//console.log(nodeObj.index)  
		var node = new fabric.Circle({
			left : nodeObj.x,
			top : nodeObj.y,
			strokeWidth : 0,
			radius : 10,
			fill : '#666',
			stroke : '#666'
		});
		node.hasControls = node.hasBorders = false;
		node.lockMovementY = node.lockMovementX = true;
		node.hoverCursor = "pointer";
		//节点信息  
		node.res_no = nodeObj.res_no; //资源号  
		node.res_type = nodeObj.res_type; //资源类型  
		node.parent_element = nodeObj.parent_element;//父元素  
		node.left_p = nodeObj.left_p; //左边积分数  
		node.rigth_p = nodeObj.rigth_p; //右边积分数  
		node.left_s = nodeObj.left_s; //左边点个数  
		node.right_s = nodeObj.right_s; //右边点个数  
		node.child_s = nodeObj.child_s; //子节点个数  
		node.bmlm_base = nodeObj.bmlm_base; //再增值产考基数  
		node.level = nodeObj.level; //展现的层数     
		node.parentId = nodeObj.parentId;
		node.selfId = nodeObj.selfId;
		node.leftId = nodeObj.leftId;
		node.rightId = nodeObj.rightId;
		node
				.on(
						'mouseover',
						function() {
							//判断弹出框是否超过浏览器最底端  
							var posX = this.left, posY = this.top;
							//console.log(   mouseY +'  -  '+ this.top);  
							(document.body.clientWidth - mouseX < 228)
									&& (posX = mouseX - 300);
							(document.body.clientHeight - mouseY < 320)
									&& (posY = this.top
											- (300 - document.body.clientHeight + mouseY));

							var x = posX, y = posY, div = document
									.getElementById('pop'), p1 = document
									.getElementById('p1'), p2 = document
									.getElementById('p2'), p3 = document
									.getElementById('p3'), p4 = document
									.getElementById('p4'), p5 = document
									.getElementById('p5'), p6 = document
									.getElementById('p6'), p7 = document
									.getElementById('p7');
							div.style.display = "block";
							div.style.top = y + 'px';
							div.style.left = (x + 20) + 'px';
							p1.innerHTML = this.res_no;
							p2.innerHTML = this.res_type;
							p3.innerHTML = '';
							p4.innerHTML = this.left_p;
							p5.innerHTML = this.rigth_p;
							p6.innerHTML = this.left_s;
							p7.innerHTML = this.right_s;
							p8.innerHTML = this.child_s;
							p9.innerHTML = this.bmlm_base;
							p10.innerHTML = this.level;

						});
		/* 
		node.on('mouseout',function(){ 
		    var div = document.getElementById('pop'); 
		        div.style.display = "none"; 
		}); 
		 */
		node.on('object:dblclick', function() {
			nodeArr.forEach(function(nodeObj) {
				nodeObj.leftId = null;
				nodeObj.rightId = null;
				nodeObj.currLevel = null;
			});

			//nodeArr[i].leftId = nodeArr[i].rightId = null ;  
			for (var i = 0; i < nodeArr.length; i++) {

				if (nodeArr[i].selfId == this.selfId) {
					//debugger  
					canvas.clear();

					nodeArr[i].x = 1720;
					nodeArr[i].y = 50;
					nodeArr[i].currLevel = 1;
					createNode(nodeArr[i]);
					drawNode(nodeArr[i]);
					break;
				}
			}
			//drawNode();  

		});

		//return node;    
		//console.log(node.selfId)  
		var text = new fabric.Text("" + node.selfId, {
			left : nodeObj.x,
			top : nodeObj.y + 2,
			fill : '#fff',
			fontSize : 10

		});
		text.hasControls = text.hasBorders = false;
		text.lockMovementY = text.lockMovementX = true;
		text.hoverCursor = "pointer";
		canvas.add(node);

	};

	function windowTocanvas(canvas, x, y) {
		var bbox = canvas.getBoundingClientRect();
		return {
			x : x - bbox.left * (canvas.width / bbox.width),
			y : y - bbox.top * (canvas.height / bbox.height)
		};
	}

	var posOffset = [
	//[640,150],  
	//[320,120],  
	//[160,100],  
	//[80 ,80 ],  
	//[40 ,50 ]  
	[ 0, 0 ], [ 832, 160 ], [ 416, 120 ], [ 208, 100 ], [ 104, 90 ],
			[ 52, 80 ], [ 26, 70 ], [ 13, 50 ] ];

	function drawNode(node) {

		var selfFn = arguments.callee;
		if (node) {

			var nodeLeft = null, nodeRight = null;
			//取当前对象的左，右子对象  
			for (var i = 0; i < nodeArr.length; i++) {

				if (nodeArr[i].parentId == node.selfId && node.leftId == null) {
					//设置此节点对应的左子对象Id  
					node.leftId = nodeArr[i].selfId;
					//设置节点当前层数  
					nodeArr[i].currLevel = node.currLevel + 1;
					//设置节点坐标  
					nodeArr[i].x = node.x - posOffset[node.currLevel][0];
					nodeArr[i].y = node.y + posOffset[node.currLevel][1];

					nodeLeft = nodeArr[i];
					//console.log('left:'+i);  

					//画节点间连线  
					var line = drawLine([ node.x, node.y, nodeLeft.x,
							nodeLeft.y ]);
					canvas.add(line);
					//创建节点  
					createNode(nodeLeft)

				} else if (nodeArr[i].parentId == node.selfId
						&& node.rightId == null) {
					//设置此节点对应的右子对象Id  
					node.rightId = nodeArr[i].selfId;
					//设置节点当前层数  
					nodeArr[i].currLevel = node.currLevel + 1;
					//设置节点坐标  
					nodeArr[i].x = node.x + posOffset[node.currLevel][0];
					nodeArr[i].y = node.y + posOffset[node.currLevel][1];

					nodeRight = nodeArr[i];
					//console.log('right:'+i);  

					//画节点间连线  
					var line = drawLine([ node.x, node.y, nodeRight.x,
							nodeRight.y ]);
					canvas.add(line);
					//创建节点  
					createNode(nodeRight)

				}
			}
			//判断当前对象是否有左，右子对象  
			if (nodeLeft) {
				drawNode(nodeLeft)
			}
			;

			if (nodeRight) {
				drawNode(nodeRight)
			}
			;

		} else {
			//第一层                      
			for (var i = 0; i < nodeArr.length; i++) {
				if (nodeArr[i].parentId == null) {
					//console.log('parentId:'+nodeArr[i].parentId)  
					//从原数据对象删除第一层对象  
					//var newNode = nodeArr.slice(i,i+1);  
					nodeArr[i].x = 1720;
					nodeArr[i].y = 50;
					nodeArr[i].currLevel = 1;
					//创建节点  
					createNode(nodeArr[i]);
					selfFn(nodeArr[i]);
					break;

				}
			}
		}
	}

	function drawLine(coords) {
		//console.log(coords)  
		//画节点之间的连线  
		var line = new fabric.Line(coords, {
			fill : 'red',
			stroke : 'red',
			strokeWidth : 3,
			selectable : false,
			globalCompositeOperation : 'destination-over'
		});
		return line;
	}

	canvas.on('mouse:down', function() {
		var div = document.getElementById('pop');
		div.style.display = 'none';

	});

	//绘制所有的节点   
	drawNode();
</script>


      </div>
      <!-- Make page fluid-->

    </div>
    <!-- Wrap all page content end -->

  </body>
</html>
      

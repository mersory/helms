var loadStockPriceUrl = "/public/index.php/frontend/common/get_history_price";

$(function() {

	// Initialize card flip
	$('.card.hover').hover(function() {
		$(this).addClass('flip');
	}, function() {
		$(this).removeClass('flip');
	});

	// 初始化股价趋势
	$(".stock-price .reload").on("click", function() {
		$(".stock-price .reload").removeClass("select");
		$(this).addClass("select");
		var type = $(this).attr("reloadType");
		// 刷新股价趋势
		reloadStockPriceData(type);
	})

	// 加载一周股价数据
	reloadStockPriceData('1');

	// // tooltips options
	// $("<div id='tooltip'></div>").css({
	// position : "absolute",
	// // display: "none",
	// padding : "10px 20px",
	// "background-color" : "#ffffff",
	// "z-index" : "99999"
	// }).appendTo("body");
	//
	// // generate actual pie charts
	// $('.pie-chart').easyPieChart();
	//
	// // server load rickshaw chart
	// var graph;
	//
	// var seriesData = [ [], [] ];
	// var random = new Rickshaw.Fixtures.RandomData(50);
	//
	// for (var i = 0; i < 50; i++) {
	// random.addData(seriesData);
	// }
	//
	// graph = new Rickshaw.Graph({
	// element : document.querySelector("#serverload-chart"),
	// height : 150,
	// renderer : 'area',
	// series : [ {
	// data : seriesData[0],
	// color : '#6e6e6e',
	// name : 'File Server'
	// }, {
	// data : seriesData[1],
	// color : '#fff',
	// name : 'Mail Server'
	// } ]
	// });
	//
	// var hoverDetail = new Rickshaw.Graph.HoverDetail({
	// graph : graph,
	// });
	//
	// setInterval(function() {
	// random.removeData(seriesData);
	// random.addData(seriesData);
	// graph.update();
	//
	// }, 1000);
	//
	// // Morris donut chart
	// Morris.Donut({
	// element : 'browser-usage',
	// data : [ {
	// label : "Chrome",
	// value : 25
	// }, {
	// label : "Safari",
	// value : 20
	// }, {
	// label : "Firefox",
	// value : 15
	// }, {
	// label : "Opera",
	// value : 5
	// }, {
	// label : "Internet Explorer",
	// value : 10
	// }, {
	// label : "Other",
	// value : 25
	// } ],
	// colors : [ '#00a3d8', '#2fbbe8', '#72cae7', '#d9544f', '#ffc100',
	// '#1693A5' ]
	// });
	//
	// $('#browser-usage').find("path[stroke='#ffffff']").attr('stroke',
	// 'rgba(0,0,0,0)');
	//
	// // sparkline charts
	// $('#projectbar1').sparkline('html', {
	// type : 'bar',
	// barColor : '#22beef',
	// barWidth : 4,
	// height : 20
	// });
	// $('#projectbar2').sparkline('html', {
	// type : 'bar',
	// barColor : '#cd97eb',
	// barWidth : 4,
	// height : 20
	// });
	// $('#projectbar3').sparkline('html', {
	// type : 'bar',
	// barColor : '#a2d200',
	// barWidth : 4,
	// height : 20
	// });
	// $('#projectbar4').sparkline('html', {
	// type : 'bar',
	// barColor : '#ffc100',
	// barWidth : 4,
	// height : 20
	// });
	// $('#projectbar5').sparkline('html', {
	// type : 'bar',
	// barColor : '#ff4a43',
	// barWidth : 4,
	// height : 20
	// });
	// $('#projectbar6').sparkline('html', {
	// type : 'bar',
	// barColor : '#a2d200',
	// barWidth : 4,
	// height : 20
	// });
	//
	// // sortable table
	// $('.table.table-sortable th.sortable').click(function() {
	// var o = $(this).hasClass('sort-asc') ? 'sort-desc' : 'sort-asc';
	// $('th.sortable').removeClass('sort-asc').removeClass('sort-desc');
	// $(this).addClass(o);
	// });
	//
	// // todo's
	// $('#todolist li label').click(function() {
	// $(this).toggleClass('done');
	// });
	//
	// // Initialize tabDrop
	// $('.tabdrop').tabdrop({
	// text : '<i class="fa fa-th-list"></i>'
	// });
	//
	// // load wysiwyg editor
	// $('#quick-message-content').summernote(
	// {
	// toolbar : [
	// // ['style', ['style']], // no style button
	// [ 'style', [ 'bold', 'italic', 'underline', 'clear' ] ],
	// [ 'fontsize', [ 'fontsize' ] ],
	// [ 'color', [ 'color' ] ],
	// [ 'para', [ 'ul', 'ol', 'paragraph' ] ],
	// [ 'height', [ 'height' ] ],
	// // ['insert', ['picture', 'link']], // no insert buttons
	// // ['table', ['table']], // no table button
	// // ['help', ['help']] //no help button
	// ],
	// height : 143
	// // set editable area's height
	// });
	//
	// // multiselect input
	// $(".chosen-select").chosen({
	// disable_search_threshold : 10
	// });

	//搜索按钮
	$("#apply-btn").on("click",function(){
		var points = $('#input03').val();
		if($.trim(points) != ""){
			alert("提示信息！");
			alert(points);
		}
	})
	
	//修改个人信息按钮
	$("#userinfo_btn").on("click",function(){
		var userid = $('#changeuserinfo_userid').val();
		var email = $('#changeuserinfo_email').val();
		var bank_name = $('#changeuserinfo_bankname').val();
		var bank_account_name = $('#changeuserinfo_bank_account_name').val();
		var bank_account_num = $('#changeuserinfo_bank_account_num').val();
		var province = $('#province').val();
		var city = $('#city').val();
		var changeuserinfo_sub_bank = $('#changeuserinfo_sub_bank').val();
		if($.trim(userid) != ""){
			var urlres =  "/public/index.php/frontend/Useropt/updateUserInfoDetails";
			$.post(urlres,{user_id:userid,
				email:email,
				bank_name:bank_name,
				province:province,
				city:city,
				sub_bank:changeuserinfo_sub_bank,
				bank_account_num:bank_account_num,
				bank_account_name:bank_account_name},function(result){
				result = JSON.parse(result);
				if(result.ok == 1){
					alert('ok');
				} else if(result.ok == 0){
					alert("修改失败");
				} 
			});
		}
		else
		{
			alert("请填写信息");
		}
	});
})

// 加载首页股价趋势
function reloadStockPriceData(type) {
	var from = new Date();
	var to = new Date();
	if (type == "1") { // 近一周
		from.add("d", -7);
	} else if (type == "2") {// 近一个月
		from.add("m", -1);
	} else if (type == "3") {// 近半年
		from.add("m", -6);
	} else if (type == "4") {// 一年
		from.add("m", -12);
	}

	$.post(loadStockPriceUrl, {
		from : from.Format("yyyy-MM-dd"),
		to : to.Format("yyyy-MM-dd")
	}, function(result) {
		result = JSON.parse(result);
		if (result.info == 'ok') {
			var data = result.res;
			console.log("股价趋势获取成功");
			var index = 1;
			var fromDateFormat = from.Format("yyyy-MM-dd");
			var toDateFormat = to.Format("yyyy-MM-dd");
			var dataArray = new Array();
			//处理x轴
			var xArray = new Array();
			var singeXArray = new Array();
			while (fromDateFormat != toDateFormat) {
				var array = new Array();
				array.push(index);
				if (data[fromDateFormat] != undefined
						&& data[fromDateFormat] != null) {
					array.push(data[fromDateFormat]);
				}else{
					array.push(1);
				}
				dataArray.push(array);
				
				
				if (type == "1") { // 近一周
					var xDataArray = new Array();
					xDataArray.push(index);
					xDataArray.push(fromDateFormat);
					singeXArray.push(fromDateFormat);
					xArray.push(xDataArray);
				} else if (type == "2") {// 近一个月
					if((index-1)%7 == 0){
						var xDataArray = new Array();
						xDataArray.push(index);
						xDataArray.push(fromDateFormat);
						singeXArray.push(fromDateFormat);
						xArray.push(xDataArray);	
					}
				} else if (type == "3") {// 近半年 
					if((index-1)%30 == 0){
						var xDataArray = new Array();
						xDataArray.push(index);
						xDataArray.push(fromDateFormat);
						singeXArray.push(fromDateFormat);
						xArray.push(xDataArray);	
					}
				} else if (type == "4") {// 一年
					if((index-1)%30 == 0){
						var xDataArray = new Array();
						xDataArray.push(index);
						xDataArray.push(fromDateFormat);
						singeXArray.push(fromDateFormat);
						xArray.push(xDataArray);	
					}
				}
				
				index++;
				from.add("d", 1);
				fromDateFormat = from.Format("yyyy-MM-dd");
			}
			
			var data = new Object();
			data.first = dataArray;
			data.x=xArray;
			data.singeX = singeXArray;

			refreshStockChart(data);
		} else {
			console.log("股价趋势获取失败");
		}
	});
}

// 刷新图表空间
function refreshStockChart(data) {
	$("#statistics-chart").empty();

	// var d1 = new Array();
	// var days = new Array();
	// $(data).each(function(index){
	// var arry = new Array();
	// arry.push(index);
	// arry.push(data[index].price);
	// days.push(data[index].time);
	// d1.push(arry);
	// })

	var d1 = data.first;

	var days = data.singeX;

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
			ticks :data.x,

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
			labelMargin : 0,
			hoverable : true,
			clickable : true,
			mouseActiveRadius : 6
		},

		legend : {
			show : false
		}
	});
	// tooltips showing
	$("#statistics-chart").bind(
			"plothover",
			function(event, pos, item) {
				if (item) {
					var x = item.datapoint[0], y = item.datapoint[1];

					$("#tooltip").html(
							'<h1 style="color: #418bca">' + days[x - 1]
									+ '</h1>' + '<strong>' + y + '</strong>'
									+ ' ' + item.series.label).css({
						top : item.pageY - 30,
						left : item.pageX + 5
					}).fadeIn(200);
				} else {
					$("#tooltip").hide();
				}
			});
	$(window).resize(function() {
		// redraw the graph in the correctly sized div
		plot.resize();
		plot.setupGrid();
		plot.draw();
	});

	$('#mmenu').off("opened.mm").on("opened.mm", function() {
		// redraw the graph in the correctly sized div
		plot.resize();
		plot.setupGrid();
		plot.draw();
	});

	$('#mmenu').off("opened.mm").on("closed.mm", function() {
		// redraw the graph in the correctly sized div
		plot.resize();
		plot.setupGrid();
		plot.draw();
	});

}
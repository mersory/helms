$(function(){
	$("#addSubscriberDialog").dialog({
	    autoOpen: false,
		resizable : false,
		height : "auto",
		width : 600,
		modal : true,
		buttons : {
			"确定" : function() {
				var subscriberId = $("#addSubscriberDialog #subscriber_id").val();
				if("" == subscriberId){
					//新增
					$.post("/public/index.php/backend/system/subscriberAdd", {
						username : $("#addSubscriberDialog #subscriber_name").val(),
						password : $("#addSubscriberDialog #subscriber_pwd").val()
					}, function(result) {
						result = JSON.parse(result);
						if(result.result){
							alert("新增管理员成功");
							window.location.reload();
						}else{
							alert("新增管理员失败");
						}
					});
				}else{
					//修改
					$.post("/public/index.php/backend/system/subscriberModifyPwd", {
						id : subscriberId,
						password : $("#addSubscriberDialog #subscriber_pwd").val()
					}, function(result) {
						result = JSON.parse(result);
						if(result.result){
							alert("修改管理员成功");
							window.location.reload();
						}else{
							alert("修改管理员失败");
						}
					});
				}
			},
			"取消" : function() {
				$(this).dialog("close");
			}
		}
	});
	
	$("#bindSubscriberDialog").dialog({
	    autoOpen: false,
		resizable : false,
		height : "auto",
		width : 600,
		modal : true,
		buttons : {
			"确定" : function() {
				var subscriberId = $("#addSubscriberDialog #subscriber_id").val();
				if("" == subscriberId){
					//新增
					$.post("/public/index.php/backend/system/subscriberAdd", {
						subscriber_name : $("#addSubscriberDialog #subscriber_name").val()
					}, function(result) {
						result = JSON.parse(result);
						if(result.result){
							alert("新增管理员成功");
							window.location.reload();
						}else{
							alert("新增管理员失败");
						}
					});
				}else{
					//修改
					$.post("/public/index.php/backend/system/subscriberModify", {
						subscriber_id : subscriberId,
						subscriber_name : $("#addSubscriberDialog #subscriber_name").val(),
					}, function(result) {
						result = JSON.parse(result);
						if(result.result){
							alert("修改管理员成功");
							window.location.reload();
						}else{
							alert("修改管理员失败");
						}
					});
				}
			},
			"取消" : function() {
				$(this).dialog("close");
			}
		}
	});
	
	//添加管理员
	$(".subscriber_bind").on("click",function(){
		var subscriberId = $(this).attr("subscriber_id");
		//加载menu列表
		$.post("/public/index.php/backend/system/roleQueryBySubscriberId", {
			subscriberId : subscriberId,
		}, function(result) {
			result = JSON.parse(result);
			if(result){
				$("#bind_subscriber_id").val(subscriberId);
				addToTableDialog(result);
				$("#bindSubscriberDialog").dialog( "open" );
			}else{
				alert("未查询到可用菜单");
			}
		});

	});
	
	function addToTableDialog(array){
		$("#bindSubscriberDialog table tbody").empty()
		for(var i in array){
			var checkTr = $("<tr><td><input type='checkbox' flag='"+array[i].flag+"' value='"+array[i].id+"'></td><td>"+array[i].name+"</td><td>"+array[i].url+"</td></tr>");
			$(checkTr).appendTo($("#bindSubscriberDialog table tbody"));
		}
		$("#bindSubscriberDialog input[type='checkbox'][flag='1']").prop("checked",true);
		
		$("#bindSubscriberDialog input[type='checkbox']").off("click").on("click",function(){
			var flag = $(this).prop("checked");
			var subscriberId = $("#bind_subscriber_id").val();
			var menuId = $(this).attr("value");
			if(flag){
				$.post("/public/index.php/backend/system/bindSubscriberMenu", {
					subscriber_id : subscriberId,
					menu_id : menuId
				}, function(result) {

				});
			}else{
				$.post("/public/index.php/backend/system/unbindSubscriberMenu", {
					subscriber_id : subscriberId,
					menu_id : menuId
				}, function(result) {

				});
			}
		});
	}
	
	//添加管理员
	$(".add_subscriber").on("click",function(){
		$("#addSubscriberDialog #subscriber_name").prop("readonly",false);
		$("#addSubscriberDialog").dialog( "open" );
		$("#addSubscriberDialog input").val("");
	});
	
	//修改管理员
	$(".subscriber_modify_pws").on("click",function(){
		$("#addSubscriberDialog").dialog( "open" );
		var subscriberId = $(this).attr("subscriber_id");
		var subscriberName = $(this).parents("tr").find("td").eq(2).html();
		var subscriberPwd = $(this).parents("tr").find("td").eq(3).html();
		$("#subscriber_id").val(subscriberId);
		$("#addSubscriberDialog #subscriber_name").val(subscriberName);
		$("#addSubscriberDialog #subscriber_pwd").val(subscriberPwd);
		
		$("#addSubscriberDialog #subscriber_name").prop("readonly",true);
	});
	
	//删除管理员
	$(".subscriber_disable,.subscriber_enable").on("click",function(){
		if(!confirm("确认禁用/启用该管理员吗")){
			return false;
		}
		
		var subscriberId = $(this).attr("subscriber_id");
		
		var status;
		if($(this).hasClass("subscriber_disable")){
			status = 0;
		}
		
		if($(this).hasClass("subscriber_enable")){
			status = 1;
		}
		
		//修改
		$.post("/public/index.php/backend/system/subscriberModifyStatus", {
			id : subscriberId,
			lifecycle : status
		}, function(result) {
			result = JSON.parse(result);
			if(result.result){
				alert("操作成功");
				window.location.reload();
			}else{
				alert("操作失败");
			}
		});
	});
	
})
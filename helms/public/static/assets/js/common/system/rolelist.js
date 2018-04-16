$(function(){
	$("#addRoleDialog").dialog({
	    autoOpen: false,
		resizable : false,
		height : "auto",
		width : 600,
		modal : true,
		buttons : {
			"确定" : function() {
				var roleId = $("#addRoleDialog #role_id").val();
				if("" == roleId){
					//新增
					$.post("/public/index.php/backend/system/roleAdd", {
						role_name : $("#addRoleDialog #role_name").val()
					}, function(result) {
						result = JSON.parse(result);
						if(result.result){
							alert("新增角色成功");
							window.location.reload();
						}else{
							alert("新增角色失败");
						}
					});
				}else{
					//修改
					$.post("/public/index.php/backend/system/roleModify", {
						role_id : roleId,
						role_name : $("#addRoleDialog #role_name").val(),
					}, function(result) {
						result = JSON.parse(result);
						if(result.result){
							alert("修改角色成功");
							window.location.reload();
						}else{
							alert("修改角色失败");
						}
					});
				}
			},
			"取消" : function() {
				$(this).dialog("close");
			}
		}
	});
	
	$("#bindRoleDialog").dialog({
	    autoOpen: false,
		resizable : false,
		height : "auto",
		width : 600,
		modal : true,
		buttons : {
			"取消" : function() {
				$(this).dialog("close");
			}
		}
	});
	
	//添加角色
	$(".role_bind").on("click",function(){
		var roleId = $(this).attr("role_id");
		//加载menu列表
		$.post("/public/index.php/backend/system/menuQueryByRoleId", {
			roleId : roleId,
		}, function(result) {
			result = JSON.parse(result);
			if(result){
				$("#bind_role_id").val(roleId);
				addToTableDialog(result);
				$("#bindRoleDialog").dialog( "open" );
			}else{
				alert("未查询到可用菜单");
			}
		});

	});
	
	function addToTableDialog(array){
		$("#bindRoleDialog table tbody").empty()
		for(var i in array){
			var checkTr = $("<tr><td><input type='checkbox' flag='"+array[i].flag+"' value='"+array[i].id+"'></td><td>"+array[i].name+"</td><td>"+array[i].url+"</td></tr>");
			$(checkTr).appendTo($("#bindRoleDialog table tbody"));
		}
		$("#bindRoleDialog input[type='checkbox'][flag='1']").prop("checked",true);
		
		$("#bindRoleDialog input[type='checkbox']").off("click").on("click",function(){
			var flag = $(this).prop("checked");
			var roleId = $("#bind_role_id").val();
			var menuId = $(this).attr("value");
			if(flag){
				$.post("/public/index.php/backend/system/bindRoleMenu", {
					role_id : roleId,
					menu_id : menuId
				}, function(result) {

				});
			}else{
				$.post("/public/index.php/backend/system/unbindRoleMenu", {
					role_id : roleId,
					menu_id : menuId
				}, function(result) {

				});
			}
		});
	}
	
	//添加角色
	$(".add_role").on("click",function(){
		$("#addRoleDialog").dialog( "open" );
		$("#addRoleDialog input").val("");
	});
	
	//修改角色
	$(".role_modify").on("click",function(){
		$("#addRoleDialog").dialog( "open" );
		var roleId = $(this).attr("role_id");
		var roleName = $(this).parents("tr").find("td").eq(2).html();
		$("#role_id").val(roleId);
		$("#addRoleDialog #role_name").val(roleName);
	});
	
	//删除角色
	$(".role_delete").on("click",function(){
		if(!confirm("确认删除该角色吗")){
			return false;
		}
		
		var roleId = $(this).attr("role_id");
		//修改
		$.post("/public/index.php/backend/system/roleDelete", {
			role_id : roleId,
		}, function(result) {
			result = JSON.parse(result);
			if(result.result){
				alert("删除角色成功");
				window.location.reload();
			}else{
				alert("删除角色失败");
			}
		});
	});
	
})
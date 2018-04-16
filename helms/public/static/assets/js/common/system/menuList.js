$(function(){
	$("#addMenuDialog").dialog({
	    autoOpen: false,
		resizable : false,
		height : "auto",
		width : 600,
		modal : true,
		buttons : {
			"确定" : function() {
				var menuId = $("#addMenuDialog #menu_id").val();
				if("" == menuId){
					//新增
					$.post("/public/index.php/backend/system/menuAdd", {
						menu_name : $("#addMenuDialog #menu_name").val(),
						menu_type : $("#addMenuDialog #menu_type option:selected").val(),
						menu_parent : $("#addMenuDialog #menu_parent").val(),
						menu_url : $("#addMenuDialog #menu_url").val()
					}, function(result) {
						result = JSON.parse(result);
						if(result.result){
							alert("新增菜单成功");
							window.location.reload();
						}else{
							alert("新增菜单失败");
						}
					});
				}else{
					//修改
					$.post("/public/index.php/backend/system/menuModify", {
						menu_id : menuId,
						menu_name : $("#addMenuDialog #menu_name").val(),
						menu_type : $("#addMenuDialog #menu_type option:selected").val(),
						menu_parent : $("#addMenuDialog #menu_parent").val(),
						menu_url : $("#addMenuDialog #menu_url").val()
					}, function(result) {
						result = JSON.parse(result);
						if(result.result){
							alert("修改菜单成功");
							window.location.reload();
						}else{
							alert("修改菜单失败");
						}
					});
				}
			},
			"取消" : function() {
				$(this).dialog("close");
			}
		}
	});
	
	//添加菜单
	$(".add_menu").on("click",function(){
		$("#addMenuDialog").dialog( "open" );
		$("#addMenuDialog input").val("");
	});
	
	//修改菜单
	$(".menu_modify").on("click",function(){
		$("#addMenuDialog").dialog( "open" );
		var menuId = $(this).attr("menu_id");
		var menuName = $(this).parents("tr").find("td").eq(2).html();
		var menuUrl = $(this).parents("tr").find("td").eq(3).html();
		var menuParent = $(this).parents("tr").find("td").eq(5).html();
		$("#menu_id").val(menuId);
		$("#menu_parent").val(menuParent);
		$("#menu_url").val(menuUrl);
		$("#addMenuDialog #menu_name").val(menuName);
	});
	
	//删除菜单
	$(".menu_delete").on("click",function(){
		if(!confirm("确认删除该菜单吗")){
			return false;
		}
		
		var menuId = $(this).attr("menu_id");
		//修改
		$.post("/public/index.php/backend/system/menuDelete", {
			menu_id : menuId,
		}, function(result) {
			result = JSON.parse(result);
			if(result.result){
				alert("删除菜单成功");
				window.location.reload();
			}else{
				alert("删除菜单失败");
			}
		});
	});
	
})
$(function(){
	$("#confirmApplicationDialog").dialog({
	    autoOpen: false,
		resizable : false,
		height : "auto",
		width : 600,
		modal : true,
		buttons : {
			"确定" : function() {
				showMask();
				var applicationId = $("#confirmApplicationDialog #application_id").val();
				var minorpwd = $("#confirmApplicationDialog #minorpwd").val();
				if(isEmpty(minorpwd)){
					hideMask();
					alert("请输入二级密码");
					return false;
				}else{
					activateAction(applicationId,minorpwd);
				}
			}
		}
	});
	
	//时间插件
	$('#applytime_start').datetimepicker({
		format:"yyyy-mm-dd",
		weekStart: 1,
		todayBtn: 1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
		showMeridian: 1
		});
	
	$('#applytime_end').datetimepicker({
		format:"yyyy-mm-dd",
		weekStart: 1,
		todayBtn: 1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
		showMeridian: 1
		});
	
	$('#btn_application_list').on("click",function(){
			clear_table()
			var fromtimeInput=$('#applytime_start').val();
	 	    var totimeInput=$('#applytime_end').val();
	 	    
	 	   var searchUrl = window.location.href.split("?")[0] + "?page=1";
	        if ($.trim(userId) != "") {
	            searchUrl = searchUrl + "&fromTime=" + fromtimeInput;
	        }
	        
	        if ($.trim(totimeInput) != "") {
	            searchUrl = searchUrl + "&toTime=" + totimeInput;
	        }
	        window.location.href = searchUrl;
	        
	 	 });
	
	//激活
	$(".menu_pass").on("click",function(){
		$("#confirmApplicationDialog").dialog( "open" );
		
		$("#confirmApplicationDialog #application_id").val($(this).attr("menu_id"));
		
//		var menuId = $(this).parents("tr").find("td").eq(6).html();
//		var minorpwd = $("#minorpwd").val();
//		activateAction(menuId, minorpwd);
	});
	
	//删除
	$(".menu_delete").on("click",function(){
		showMask();
		var url = "/public/index.php/backend/Useropt/inactiveUserDelete";
        $.post(url, {userid:$(this).attr("menu_id")}, function(msg){
        	hideMask();
	        msg=JSON.parse(msg);
	        if(msg.success == true)
	        {
	        	alert('删除成功');
	        	window.location.reload();
		  	} 
	        else 
	        {
		  		alert("删除失败，积分不够");
	        }
        })
	});
		
});


function activateAction(id, minorpwd)
{
		var url = "/public/index.php/frontend/Adminopt/activateUser";
	        $.post(url, {user_id:id, minor_pwd:minorpwd}, function(msg){
	        	hideMask();
		        msg=JSON.parse(msg);
		        if(msg.success == true)
		        {
		        	alert('激活成功');
		        	window.location.reload();
			  	} 
		        else 
		        {
			  		alert("激活失败，积分不够");
		        }
	        })

}
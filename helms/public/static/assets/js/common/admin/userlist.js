$(function(){
	var url = "public/index.php/backend/Useropt/lockorForbidonUser";
	
	//时间插件
	$('#fromtime').datetimepicker({
		format:"yyyy-mm-dd",
		weekStart: 1,
		todayBtn: 1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
		showMeridian: 1
		});
	
	$('#totime').datetimepicker({
		format:"yyyy-mm-dd",
		weekStart: 1,
		todayBtn: 1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
		showMeridian: 1
		});
	
	
	
	$('#btn_user_list').on("click",function(){
		//alert("调用方法");
		var userId=$('#userid').val();
		var username=$('#username').val();
		var telephone=$('#telphone').val();
		var email=$('#email').val();
		var fromTime=$('#fromtime').val();
		var toTime=$('#totime').val();
		
		var searchUrl = window.location.href.split("?")[0]+"?page=1";
		if($.trim(userId) != ""){
			searchUrl = searchUrl + "&userId="+userId;
		}
		if($.trim(username) != ""){
			searchUrl = searchUrl + "&username="+username;
		}
		if($.trim(telephone) != ""){
			searchUrl = searchUrl + "&telephone="+telephone;
		}		
		if($.trim(email) != ""){
			searchUrl = searchUrl + "&email="+email;
		}		
		if($.trim(fromTime) != ""){
			searchUrl = searchUrl + "&fromTime="+fromTime;
		}	
		if($.trim(toTime) != ""){
			searchUrl = searchUrl + "&toTime="+toTime;
		}
		
		window.location.href = searchUrl;
	 });
	
	$("#open_user_list").on("click",function(){
		if($("input[name='row-check']").filter("checked").size() == 0){
			alert("请先选择需要操作的账号");
		}else if(confirm("确定要解锁这些会员吗?")){
			   $.post(url, {}, function(msg){
				   
			   });
		}
	});
	
	$("#close_user_list").on("click",function(){
		if($("input[name='row-check']").filter("checked").size() == 0){
			alert("请先选择需要操作的账号");
		}else if(confirm("确定要锁定这些会员吗?")){
			
		}		
	});
	
	$("#open_apply_user_list").on("click",function(){
		if($("input[name='row-check']").filter("checked").size() == 0){
			alert("请先选择需要操作的账号");
		}else if(confirm("确定要为这些会员开启提现功能吗?")){
			
		}		
	});
	
	$("#close_apply_user_list").on("click",function(){
		if($("input[name='row-check']").filter("checked").size() == 0){
			alert("请先选择需要操作的账号");
		}else if(confirm("确定要为这些会员关闭提现功能吗?")){
			
		}		
	});
		
});
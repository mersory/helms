$(function(){
	//清空表单
	emptyForm();
	
	//登录
	$("#login").on("click",function(event){
		var username = $("#username").val();
		var password = $("#password").val();
		
		if("" == $.trim(username)){
			showError("用户名不能为空");
			return false;
		}
		
		if("" == $.trim(password)){
			showError("密码不能为空");
			return false;
		}
		
		var url =  "/public/index.php/login/login/login"
		 $.post(url,{username:username,password:password},function(result){
			 result = JSON.parse(result);
			 if(result.success){
				 window.location.href=result.redirectUrl;
			 }else{
				 showError("用户名和密码不正确，请重新登录");	 
				 return false;
			 }
		 });
		event.stopPropagation();
	});
	
	$("#username").on("blur",function(){
		hideError();
		var username = $("#username").val();
		if("" == $.trim(username)){
			showError("用户名不能为空");
		}
	});
	
	$("#password").on("blur",function(){
		hideError();
		var password = $("#password").val();
		if("" == $.trim(password)){
			showError("密码不能为空");
		}
	});
	
	
	//创建账号
	$("#create").on("click",function(){
		
		
	});
	
});

function emptyForm(){
	$("#username").val("");
	$("#password").val("");
	$(".error_div").empty().hide();
}

function showError(msg){
	$(".error_div").empty().html(msg).show();
}

function hideError(){
	$(".error_div").empty().hide();
}
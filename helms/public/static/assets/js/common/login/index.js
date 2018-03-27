//new_element=document.createElement("script");
//new_element.setAttribute("type","text/javascript");
//new_element.setAttribute("src","../admin/userlist.js");// 在这里引入了a.js
//document.body.appendChild(new_element);

//document.write("<script language=javascript src='_JS_/common/admin/pointtransform.js'></script>");

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
		
		if( !validate() ){
			showError("输入密码用户名或错误");
			return false;
		}
		
		var url =  "/public/index.php/login/login/login";
		 $.post(url,{_username:username,_password:password},function(result){
			 result = JSON.parse(result);
			 if(result.success){
				 window.location.href=result.redirectUrl;
			 }else{
				 if(result.error == 1)
					 showError("用户尚未激活，请及时激活！");	 
				 else if(result.error == 2)
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
		window.location.href="http://localhost/public/index.php/frontend/Useropt/RegistIndex";
	});
	
});

function validate() 
{
	var user = $('#username').val();
	var pwd = $('#password').val();
	if( !(/[A-Z]/.test(user)) )
    {
	    alert("用户名必须包含大写字母");
	    return false;
    }
    if( !(/[0-9]/.test(user)) || !(/[0-9]/.test(pwd)) )
    {
	    alert("用户名和密码必须包含数字");
	    return false;
    }
    return true;
}  


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
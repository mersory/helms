//new_element=document.createElement("script");
//new_element.setAttribute("type","text/javascript");
//new_element.setAttribute("src","../admin/userlist.js");// 在这里引入了a.js
//document.body.appendChild(new_element);

//document.write("<script language=javascript src='_JS_/common/admin/pointtransform.js'></script>");

$(function(){
	//清空表单
	emptyForm();
	b();
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


function b()  {
	alert("function b（） 输入序列合法");
	//pointtran();
}

function validate() 
{
	var user = $('#username').val();
	var pwd = $('#password').val();
	if( !(/[A-Z]/.test(user)) || !(/[A-Z]/.test(pwd)) )
    {
	    alert("输入序列必须包含大写字母");
	    return false;
    }
    if( !(/[a-z]/.test(user)) || !(/[A-Z]/.test(pwd)) )
    {
	    alert("输入序列必须包含小写字母");
	    return false;
    }
    if( !(/[0-9]/.test(user)) || !(/[A-Z]/.test(pwd)) )
    {
	    alert("输入序列必须包含数字");
	    return false;
    }
    alert("输入序列合法");
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
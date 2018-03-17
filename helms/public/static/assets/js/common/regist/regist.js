$(function(){
	$('#regist').on("click",function(){
		var username = $("#fullname").val();
		var email = $("#email").val();
		var telphone = $("#telphone").val();
		var recommender = $("#recommender").val();
		var activator = $("#activator").val();
		var primarypwd = $("#primarypwd").val();
		var minorpwd = $("#minorpwd").val();
		if("" == $.trim(username)){
			showError("用户名不能为空");
			return false;
		}
		
		if("" == $.trim(email)){
			showError("邮箱不能为空");
			return false;
		}
		if("" == $.trim(telphone)){
			showError("电话不能为空");
			return false;
		}
		
		if("" == $.trim(recommender)){
			showError("推荐人不能为空");
			return false;
		}
		if("" == $.trim(activator)){
			showError("节点人不能为空");
			return false;
		}
		
		if("" == $.trim(primarypwd)){
			showError("一级密码不能为空");
			return false;
		}
		if("" == $.trim(minorpwd)){
			showError("二级密码不能为空");
			return false;
		}
		var url =  "/public/index.php/frontend/Useropt/UserRegist";
		$.post(url,{name:username, email:email, telphone:telphone, recommender:recommender, activator:activator, pwd1:primarypwd, pwd2:minorpwd, $userlevel:1},function(result){
			result = JSON.parse(result);
			if(result.success){
				alert("regist success,goto login");
				window.location.href="/public/index.php/login/login/index";
			}else{
				showError("填写数据不规范，请重新注册");	 
				return false;
			}
		});
		event.stopPropagation();
	 	});
		
});




function countDown(secs,surl){        
	var jumpTo = document.getElementById('jumpTo');
	jumpTo.innerHTML=secs;  
	if(--secs>0){     
	    setTimeout("countDown("+secs+",'"+surl+"')",1000);     
	}     
	else{       
		window.location.href=surl;     
	}     
}     
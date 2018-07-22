$(function(){
	// 获取创建用户前页面传递的数据，赋值给对应的输入框
	//changed by Gavin start model19
	var info= GetQueryString("parentId");
	var recInput = document.getElementById("recommender");
	var actInput= document.getElementById("activator");
	var emailInput = document.getElementById('email');
	recInput.value = info;
	actInput.value = info;
	emailInput.value = "hermesplus_service@163.com";
	//changed by Gavin end model19
	//处理产品级别
	$("#product option").hide();
	$("#product option[value='"+$("#level option:selected").val()+"']").show();
	
	$("#level").on("change",function(){
		var i = $("#level option:selected").val();
		if(i == 1){
			$("#product option").hide();
			$("#product option[value='1']").show();
		}else if(i==2){
			$("#product option").hide();
			$("#product option[value='2']").show();
			$("#product option[value='3']").show();
			$("#product option[value='4']").show();
		}
	})
	
	$('#regist').on("click",function(){
		showMask();
		var id = $("#memberId").val();
		var username = $("#fullname").val();
		var email = $("#email").val();
		var telphone = $("#telphone").val();
		var recommender = $("#recommender").val();
		var activator = $("#activator").val();
		var primarypwd = $("#primarypwd").val();
		var minorpwd = $("#minorpwd").val();
		var level = $("#level option:selected").val();
		var product = $("#product option:selected").val();

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
		
		if("0" == $.trim(product)){
			showError("请选择产品");
			return false;
		}
		
/*		if("" == $.trim(recommender)){
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
		}*/
		var url =  "/public/index.php/backend/Useropt/UserRegist";
		$.post(url,{ID:id, name:username, email:email, portrait:product, telphone:telphone, recommender:recommender, activator:activator, pwd1:"111111", pwd2:"111111", userlevel:level},function(result){
			hideMask();
			result = JSON.parse(result);
			if(result.success){
				alert("注册成功，点击确定回到主页");
				window.location.href="/public/index.php/backend/common/network";
			}else{
				alert("注册失败，请重新注册");
				window.location.href="/public/index.php/backend/common/network";
			}
		});
//		event.stopPropagation();
	 	});
		
});

function GetQueryString(name)
{
     var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
     var r = window.location.search.substr(1).match(reg);
     if(r!=null)return  unescape(r[2]); return null;
}


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
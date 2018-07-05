$(function(){
	$('#btn_update').on("click",function(){
		var needupdateid = $("#memberId").val();
		var minorpassword = $("#minorpassword").val();
		var level = $("#level").val();
		var levaldetail = $("#levaldetail").val();
		
		if("" == $.trim(needupdateid)){
			showError("用户ID不能为空");
			return false;
		}
		
		if("" == $.trim(minorpassword)){
			showError("二级密码不能为空");
			return false;
		}
		
		if("" == $.trim(level)){
			showError("升级等级不能为空");
			return false;
		}
		
		if("" == $.trim(levaldetail)){
			showError("备注不能为空");
			return false;
		}
		
		var url =  "/public/index.php/frontend/Adminopt/updateUserOpt";
		$.post(url,{user_id:needupdateid, level:level, cost_money:0, minor_pwd:minorpassword},function(result){
			result = JSON.parse(result);
			if(result.success){
				alert("升级成功");
			}else{
				alert("升级失败，请重新升级");
			}
		});
	});
})
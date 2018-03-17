$(function(){
	$("#apply-btn").on("click",function(){
		
		var points_type = $("#points_type").val();
		var transfer_amount = $("#transfer_amount").val();
		var minor_password = $("#minor_password").val();
		
		if("" == $.trim(transfer_amount)){
			alert("转换金额不能为空");
			return false;
		}
		
		if("" == $.trim(minor_password)){
			alert("密码不能为空");
			return false;
		}
		
		var url =  "/public/index.php/frontend/Adminopt/pointTransforRes";
		 $.post(url,{point_type:points_type,point_change_type:1,point_change_sum:transfer_amount,minor_password:minor_password},function(result){
			 result = JSON.parse(result);
			 if(result.success){
				 window.location.refresh();
			 }else{
				 alert("积分转换失败");	 
				 return false;
			 }
		 });
	})
	
	
})
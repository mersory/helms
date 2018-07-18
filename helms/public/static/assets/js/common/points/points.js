$(function(){
	$("#apply-btn").on("click",function(){
		showMask();
		
		var points_type = $("#points_type").val();
		var transfer_amount = $("#transfer_amount").val();
		var minor_password = $("#minor_password").val();
		var point_change_type = 1;
		if(points_type == "universal")
		{
			points_type = 4;
			point_change_type = 2;
			
		}   
		else if(points_type == "bonus"){
			points_type = 2;
			point_change_type = 1;
		}
			
		
		if("" == $.trim(transfer_amount)){
			alert("转换金额不能为空");
			return false;
		}
		
		if("" == $.trim(minor_password)){
			alert("密码不能为空");
			return false;
		}
		
		var url =  "/public/index.php/frontend/Adminopt/pointTransforRes";
		 $.post(url,{point_type:points_type,point_change_type:point_change_type,point_change_sum:transfer_amount,minor_password:minor_password},function(result){
			 hideMask();
			 result = JSON.parse(result);
			 if(result.success){
				 alert("积分转换成功");
				 window.location.reload();
				 
			 }else{
				 alert("积分转换失败");	 
				 return false;
			 }
		 });
	})
	
	
})
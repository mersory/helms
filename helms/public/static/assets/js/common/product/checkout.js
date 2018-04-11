$(function(){
	$("#confirm_buy").on("click",function(){
		var productId = $("#productId").val();
		var receiver = $("#name").val();
		var mobile = $("#mobile").val();
		var address = $("#receive_address").val();
		var password = $("#comfirmMinorpwd").val();
		
		if(isEmpty(productId) || isEmpty(receiver) || isEmpty(mobile) || isEmpty(address) || isEmpty(password) ){
			alert("参数为空，请检查后重新提交");
			return false;
		}
		
		$.post("/public/index.php/frontend/store/goToPay", {
			product_id : productId,
			receiver:receiver,
			mobile:mobile,
			address:address,
			password:password
		}, function(result) {
			result = JSON.parse(result);
			if(result.result==1){
				alert("兑换成功");
				window.location.href = "/public/index.php/frontend/store/orderlist";
			}else{
				alert("兑换失败")
			}
		});
	});
});


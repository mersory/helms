$(function(){
	$(".confirm-receive").on("click",function(){
		showMask();
		var orderId = $(this).attr("order-id");
		$.post("/public/index.php/frontend/store/confirmReceive", {
			orderId : orderId
		}, function(result) {
			hideMask();
			result = JSON.parse(result);
			if(result.result){
				alert("确认收货成功");
				window.location.reload();
			}else{
				alert("确认收货失败")
			}
		});
	})
	
	$(".confirm-send").on("click",function(){
		showMask();
		var orderId = $(this).attr("order-id");
		$.post("/public/index.php/backend/store/confirmSend", {
			orderId : orderId
		}, function(result) {
			hideMask();
			result = JSON.parse(result);
			if(result.result){
				alert("确认发货成功");
				window.location.reload();
			}else{
				alert("确认发货失败")
			}
		});
	})
	
})
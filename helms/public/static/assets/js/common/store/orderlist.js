$(function(){
	$(".confirm-receive").on("click",function(){
		
		var orderId = $(this).attr("order-id");
		$.post("/public/index.php/frontend/store/confirmReceive", {
			orderId : orderId
		}, function(result) {
			
			result = JSON.parse(result);
			if(result.result){
				alert("确认收货成功");
				window.location.reload();
			}else{
				alert("确认收货失败")
			}
		});
	});
	
	
	$("#confirmSendDialog").dialog({
	    autoOpen: false,
		resizable : false,
		height : "auto",
		width : 600,
		modal : true,
		buttons : {
			"确定" : function() {
				var orderId = $("#confirmSendDialog #confirm_order_id").val();
				var expressCode = $("#confirmSendDialog #express_code").val();
				if(isEmpty(expressCode)){
					alert("请输入运单号");
					return false;
				}else{
					$.post("/public/index.php/backend/store/confirmSend", {
						orderId : orderId,
						expressCode:expressCode
					}, function(result) {
						
						result = JSON.parse(result);
						if(result.result){
							alert("确认发货成功");
							window.location.reload();
						}else{
							alert("确认发货失败")
						}
					});
				}
			}
		}
	});
	
	$(".confirm-send").on("click",function(){
		
/*		var orderId = $(this).attr("order-id");
		$.post("/public/index.php/backend/store/confirmSend", {
			orderId : orderId
		}, function(result) {
			
			result = JSON.parse(result);
			if(result.result){
				alert("确认发货成功");
				window.location.reload();
			}else{
				alert("确认发货失败")
			}
		});*/
		
		
		$("#confirmSendDialog").dialog("open");
		$("#confirm_order_id").val($(this).attr("order-id"));
	})
	
})
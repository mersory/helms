$(function(){
	
	//删除商品
	$(".alert-close").on("click",function(){
		var shoppingcartId = $(this).parents(".item").attr("shoppingcart_id");
		
		$.post("/public/index.php/frontend/store/deleteFromShoppingcart", {
			shoppingcartId : shoppingcartId
		}, function(result) {
			result = JSON.parse(result);
			if(result.result){
				window.location.reload();
			}else{
				alert(result.message);
			}
		});
		
	});
	
	$("input[name='quantity']").on("change",function(){
		var productId = $(this).parents(".item").attr("product_id");
		var shoppingcartId = $(this).parents(".item").attr("shoppingcart_id");
		var productNum = $(this).val();
		$.post("/public/index.php/frontend/store/updateProductNumInShoppingcart", {
			productId : productId,
			shoppingcartId : shoppingcartId,
			productNum : productNum
		}, function(result) {
			result = JSON.parse(result);
			if(result.result){
				
			}else{
				alert(result.message);
				window.location.reload();
			}
		});
	});
	
	$(".checkout-btn a").on("click",function(){
		window.location.href="/public/index.php/frontend/store/checkout";
	});
	
});
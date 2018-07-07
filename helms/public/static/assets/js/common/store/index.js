$(function(){
	$(".add_shoppingcart").on("click",function(){
		var productId = $(this).attr("product_id");
		$.post("/public/index.php/frontend/store/addToShoppingCart", {
			product_id : productId
		}, function(result) {
			result = JSON.parse(result);
			if(result.result){
				alert("已加入购物车");
				refreshShoppingCart();
			}else{
				alert(result.message);
			}
		});
	});
	
});
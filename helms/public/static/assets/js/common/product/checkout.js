$(function(){
	//提交订单
	$(".submit-order").on("click",function(){
		var addressId = $("input[name='radio_cds']").val();
		var receiver = $("input[name='receiver']").val();
		var mobile = $("input[name='receiver_mobile']").val();
		var address = $("textarea[name='receiver_address']").val();
		var province = $("select[name='receiver_province'] option:selected").text();
		var city = $("select[name='receiver_city'] option:selected").text();
		var area = $("select[name='receiver_area'] option:selected").text();
		var pointType = $("select.user-points option:selected").val();
		var point = $(".user-point").text();
		
		if(parseInt(point) <parseInt( $(".summary-total").text())){
			alert("积分余额不足");
			return false;
		}
		
//		if(isEmpty(productId) || isEmpty(receiver) || isEmpty(mobile) || isEmpty(address) || isEmpty(password) ){
//			alert("参数为空，请检查后重新提交");
//			return false;
//		}
		
		$.post("/public/index.php/frontend/store/goToPay", {
			addressId : addressId,
			receiver:receiver,
			mobile:mobile,
			address:address,
			province:province,
			city:city,
			area:area,
			pointType:pointType
		}, function(result) {
			result = JSON.parse(result);
			if(result.result==1){
				alert("订单提交成功");
				window.location.href = "/public/index.php/frontend/store/orderlist";
			}else{
				alert(result.message)
			}
		});
	});
	
	//省级联
	$("select[name='receiver_province']").on("change",function(){
		if(""!=$(this).find("option:selected").val()){
			var provinceId = $(this).find("option:selected").val();
			$.post("/public/index.php/frontend/store/getCityByProvince", {
				provinceId:provinceId
			}, function(result) {
				result = JSON.parse(result);
				if(result.length > 0){
					$("select[name='receiver_city']").empty();
					$("<option value=''>请选择</option>").appendTo($("select[name='receiver_city']"));
					
					$("select[name='receiver_area']").empty();
					$("<option value=''>请选择</option>").appendTo($("select[name='receiver_area']"));
					for(var i in result){
						$("select[name='receiver_city']").append("<option value='"+result[i].city_id+"'>"+result[i].city+"</option>");	
					}
				}
			});
		}
	})
	
		//市级联
	$("select[name='receiver_city']").on("change",function(){
		if(""!=$(this).find("option:selected").val()){
			var cityId = $(this).find("option:selected").val();
			$.post("/public/index.php/frontend/store/getAreaByCity", {
				cityId:cityId
			}, function(result) {
				result = JSON.parse(result);
				if(result.length > 0){
					$("select[name='receiver_area']").empty();
					$("<option value=''>请选择</option>").appendTo($("select[name='receiver_area']"));
					for(var i in result){
						$("select[name='receiver_area']").append("<option value='"+result[i].area_id+"'>"+result[i].area+"</option>");	
					}
				}
			});
		}
	})
	
	$("select[name='receiver_city'],input[name='radio_cds']").on("change",function(){
		var addressId = $("input[name='radio_cds']").val();
		var province = $("select[name='receiver_province'] option:selected").text();
		var city = $("select[name='receiver_city'] option:selected").text();
		var area = $("select[name='receiver_area'] option:selected").text();
		
		if(("new" == addressId &&"请选择" != province && "请选择" != city && "请选择" != area) || "new" != addressId){
			$.post("/public/index.php/frontend/store/getShippingFee", {
				addressId : addressId,
				province:province,
				city:city,
				area:area
			}, function(result) {
				result = JSON.parse(result);
				$(".shipping-fee").html(result.shippingFee);
				$(".summary-total").html(parseInt($(".product-total").text())+parseInt(result.shippingFee));
			});
		}
	});
	
	//积分选择
	$(".user-points").on("change",function(){
		if($(this).find("option:selected").val() != "none"){
			$(".user-point").html($(this).find("option:selected").attr("val"));
		}else{
			$(".user-point").html(0);
		}
	});
	
	//初始化小结信息
	initSummary();
});

function initSummary(){
	var productTotal = 0;
	$(".pro_shop_list .shop_porlist ").each(function(index,element){
		productTotal += parseInt($(element).find("td:nth-child(4)").text());
	});
	$(".product-total").html(productTotal);
	
	var addressId = $("input[name='radio_cds']").val();
	var province = $("select[name='receiver_province'] option:selected").text();
	var city = $("select[name='receiver_city'] option:selected").text();
	var area = $("select[name='receiver_area'] option:selected").text();
	
	$.post("/public/index.php/frontend/store/getShippingFee", {
		addressId : addressId,
		province:province,
		city:city,
		area:area
	}, function(result) {
		result = JSON.parse(result);
		$(".shipping-fee").html(result.shippingFee);
		$(".summary-total").html(parseInt(productTotal)+parseInt(result.shippingFee));
	});
}


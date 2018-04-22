$(function() {
	$("#addProductDialog").dialog({
	    autoOpen: false,
		resizable : false,
		height : "auto",
		width : 600,
		modal : true,
		buttons : {
			"确定" : function() {
				var productId = $("#addProductDialog #product_id").val();
				if("" == productId){
					//新增
					$.post("/public/index.php/backend/store/addProduct", {
						product_name : $("#addProductDialog #product_name").val(),
						product_description : $("#addProductDialog #product_description").val(),
						product_url : $("#addProductDialog #product_image").val(),
						product_inventory : $("#addProductDialog #product_inventory").val(),
						product_price : $("#addProductDialog #product_price").val(),
						product_cur_price : $("#addProductDialog #product_cur_price").val(),
						product_category : $("#addProductDialog #product_category").val(),
						product_category_name : $("#addProductDialog #product_category_name").val(),
						product_order : $("#addProductDialog #product_order").val()
					}, function(result) {
						result = JSON.parse(result);
						if(result.result){
							alert("新增商品成功");
							window.location.reload();
						}else{
							alert("新增商品失败");
						}
					});
				}else{
					//修改
					//新增
					$.post("/public/index.php/backend/store/modifyProduct", {
						product_id : productId,
						product_name : $("#addProductDialog #product_name").val(),
						product_description : $("#addProductDialog #product_description").val(),
						product_url : $("#addProductDialog #product_image").val(),
						product_inventory : $("#addProductDialog #product_inventory").val(),
						product_price : $("#addProductDialog #product_price").val(),
						product_cur_price : $("#addProductDialog #product_cur_price").val(),
						product_category : $("#addProductDialog #product_category").val(),
						product_category_name : $("#addProductDialog #product_category_name").val(),
						product_order : $("#addProductDialog #product_order").val()
					}, function(result) {
						result = JSON.parse(result);
						if(result.result){
							alert("修改商品成功");
							window.location.reload();
						}else{
							alert("修改商品失败");
						}
					});
				}
			},
			"取消" : function() {
				$(this).dialog("close");
			}
		}
	});
	
	$(".add_product").on("click",function(){
		$("#addProductDialog").dialog( "open" );
		$("#addProductDialog input").val("");
	});
	
	$(".stock_product").on("click",function(){
		var productId=$(this).attr("product_id");
		$.post("/public/index.php/backend/store/stockProduct", {
			product_id : productId
		}, function(result) {
			result = JSON.parse(result);
			if(result.result){
				alert("上架成功");
				window.location.reload();
			}else{
				alert("上架失败");
			}
		});
	});
	
	$(".down_stock_product").on("click",function(){
		var productId=$(this).attr("product_id");
		$.post("/public/index.php/backend/store/downStockProduct", {
			product_id : productId
		}, function(result) {
			result = JSON.parse(result);
			if(result.result){
				alert("下架成功");
				window.location.reload();
			}else{
				alert("下架失败");
			}
		});
	});
	
	
	
	$(".modify_product").on("click",function(){
		var productId=$(this).attr("product_id");

		$.post("/public/index.php/backend/store/findProduct", {
			product_id : productId
		}, function(result) {
			result = JSON.parse(result);
			if(result.length==1){
				$("#addProductDialog input").val("");
				$("#addProductDialog #product_name").val(result[0].name);
				$("#addProductDialog #product_description").val(result[0].description);
				$("#addProductDialog #product_image").val(result[0].image_url);
				$("#addProductDialog #product_inventory").val(result[0].invetory);
				$("#addProductDialog #product_price").val(result[0].price);
				$("#addProductDialog #product_cur_price").val(result[0].cur_pirce),
				$("#addProductDialog #product_category").val(result[0].category),
				$("#addProductDialog #product_category_name").val(result[0].category_name),
				$("#addProductDialog #product_order").val(result[0].order)
				$("#addProductDialog #product_id").val(productId);
				$("#addProductDialog").dialog( "open" );
			}
		});
	});
	
	$('#fileupload').fileupload({
        dataType: 'json',
        url: "setFile",//文件的后台接受地址
        //设置进度条
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100);
            $('#progress .bar').css(
                'width',
                progress + '%'
            );
        },
        //上传完成之后的操作，显示在img里面
        done: function (e, data){
        	var result = JSON.parse(data.result);
        	if(result.result){
        		$("#product_image").val(result.pic_url);	
        	}
        }
    });
})


$(function(){
//	//时间插件
//	$('#fromtime').datetimepicker({
//		format:"yyyy-mm-dd",
//		weekStart: 1,
//		todayBtn: 1,
//		autoclose: 1,
//		todayHighlight: 1,
//		startView: 2,
//		forceParse: 0,
//		showMeridian: 1
//		});
//	
//	$('#totime').datetimepicker({
//		format:"yyyy-mm-dd",
//		weekStart: 1,
//		todayBtn: 1,
//		autoclose: 1,
//		todayHighlight: 1,
//		startView: 2,
//		forceParse: 0,
//		showMeridian: 1
//		});
	
	$('#btn_recharge').on("click",function(){
		var useridInput=$('#recharge_userid').val();
		var typeInput=$("#recharge_type option:selected").val();
		var moneyInput=$('#recharge_money').val();
		var useInput=$('#czyt_type option:selected').val();
		var contentInput="后台充值";
		var detailInput=$('#recharge_deatil').val();
		if("" == $.trim(useridInput)){
				showError("充值ID不能为空");
				return false;
		}
		
		
		//alert("valid");
		var url = "/public/index.php/backend/useropt/userRecharge";
		$.post(url, {user_id:useridInput, money:moneyInput, cz_type:typeInput, content:contentInput, usefor:useInput, details:detailInput}, function(msg){
		msg=JSON.parse(msg);
		if(msg.success == true)
		{
			var userId=$('#recharge_search_userid').val();

	        var searchUrl = window.location.href.split("?")[0] + "?page=1";
	        if ($.trim(userId) != "") {
	            searchUrl = searchUrl + "&userId=" + userId;
	        }

	        window.location.href = searchUrl;
		} else {
		  alert("充值失败");
		  return false;
		}
		
	});
	
	$('#btn_recharge_search').on("click",function(){
		var userId=$('#recharge_search_userid').val();

        var searchUrl = window.location.href.split("?")[0] + "?page=1";
        if ($.trim(userId) != "") {
            searchUrl = searchUrl + "&userId=" + userId;
        }

        window.location.href = searchUrl;
	 });
		
});

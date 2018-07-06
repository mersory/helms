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
		clear_table()
		var useridInput=$('#recharge_userid').val();
		var typeInput=$("#recharge_type option:selected").val();
		var moneyInput=$('#recharge_money').val();
		var useInput=$('#czyt_type option:selected').val();
		var contentInput="后台充值";
		var detailInput=$('#recharge_deatil').val();
		if (validate() == true)
		{
			//alert("valid");
			var url = "/public/index.php/backend/useropt/userRecharge";
			$.post(url, {user_id:useridInput, money:moneyInput, cz_type:typeInput, content:contentInput, usefor:useInput, details:detailInput}, function(msg){
			msg=JSON.parse(msg);
			if(msg.success == true)
			{
			  //alert('登录成功，正在转向后台主页！');
			  for (var res_index=0; res_index<msg.result.length; res_index++)
			  {
				  //changed by Gavin start model7
				  addCol(res_index, msg.result[res_index].user_id, msg.result[res_index].real_name, msg.result[res_index].cz_type, 
						  msg.result[res_index].cz_time, msg.result[res_index].cz_money, msg.result[res_index].czyt_type, 
						  msg.result[res_index].cz_instruction, msg.result[res_index].status);//查询成功，增加行和列
				  //changed by Gavin end model7
			  }
			  //window.location.href = "UserLogin.html";
			} else {
			  alert("充值失败");
			  return false;
			}
			})
			alert("充值成功");
			return true;
		}
		else
		{
			//$("#username").focus();
			alert("not valid");
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

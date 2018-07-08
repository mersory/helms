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
	
	currentgujia();
	
	$('#btn_changegujia').on("click",function(){
		showMask();
		var gujiaInput=$('#change_gujia').val();
		if (validate() == true)
		{
			//alert("valid");
			var url = "/public/index.php/frontend/Adminopt/change_gujia";
			$.post(url, {use_gujia:gujiaInput}, function(res){
				hideMask();
			res=JSON.parse(res);
			if(res.success == true)
			{
			  //alert('修改股价成功，正在转向后台主页！');
			  alert("修改股价成功");
			  currentgujia();
			  //window.location.href = "UserLogin.html";
			} else {
			  alert("修改股价失败");
			  return false;
			}
			})
			return true;
		}
		else
		{
			//$("#username").focus();
			alert("not valid");
			return false;
		}
	});
		
});

//输入序列合法性检测
function validate() 
{
   return true;
}  

function currentgujia()
{
	var url = "/public/index.php/backend/useropt/gpsetgujia";
	$.post(url, {}, function(msg){
		msg=JSON.parse(msg);
		if(msg.success == true)
		{
			$('#current_gujia').val(msg.res.gujia);
		}
	});
}
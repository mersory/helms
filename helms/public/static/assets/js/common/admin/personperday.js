$(function(){
	
	//时间插件
	$('#income_expense_start').datetimepicker({
		format:"yyyy-mm-dd",
		weekStart: 1,
		todayBtn: 1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
		showMeridian: 1
		});
	
	$('#income_expense_end').datetimepicker({
		format:"yyyy-mm-dd",
		weekStart: 1,
		todayBtn: 1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
		showMeridian: 1
		});
		
	$('#btn_bonus').on("click", function() {
		// alert("调用方法");
		var userIdInput=$('#userid').val();
		var beginInput=$('#income_expense_start').val();
		var endInput=$('#income_expense_end').val();

		var searchUrl = window.location.href.split("?")[0] + "?page=1";
		if ($.trim(userId) != "") {
			searchUrl = searchUrl + "&userid=" + userIdInput + "&begintime=" + beginInput + "&endtime=" + endInput;
		}

		window.location.href = searchUrl;
	});
});

//输入序列合法性检测
function validate() 
{
   return true;
}  


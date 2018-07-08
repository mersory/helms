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
	
	$('#btn_income_expend').on("click",function(){
		var fromtimeInput=$('#income_expense_start').val();
		var totimeInput=$('#income_expense_end').val();
//	    var typeInput=$('#cur_status').val();

	    var searchUrl = window.location.href.split("?")[0] + "?page=1";

	    if ($.trim(fromtimeInput) != "") {
	        searchUrl = searchUrl + "&fromTime=" + fromtimeInput;
	    }

	    if ($.trim(totimeInput) != "") {
	        searchUrl = searchUrl + "&toTime=" + totimeInput;
	    }
	    
	    window.location.href = searchUrl;
		
	 });
		
});

//输入序列合法性检测
function validate() 
{
   return true;
}  

//插入行
function addCol(param1, param2, param3, param4, param5, param6) {
	$("table#income_expense_table tr:last").after('<tr><td>'+ param1 + '</td><td>'+ param2 + '</td><td> '+ param3 + ' </td><td>'+ param4 + ' </td><td>'+ param5 + ' </td><td>'+ param6 + ' </td>');
}


function clear_table() {
	var trs = $("#income_expense_table").find("tr");
	for(var i=1; i<trs.length; i++){
		trs[i].remove();
	}
}

function delCol() {
  //移除最后一列
  $("#tab1 tr :last-child").remove();
  //移除第一列
  //$("#tab1 tr :first-child").remove();
  //移除指定的列, 注:这种索引从1开始
  //$("#tab1 tr :nth-child(2)").remove();
  //移除第一列之外的列
  //$("#tab1 tr :not(:nth-child(1))").remove();
}
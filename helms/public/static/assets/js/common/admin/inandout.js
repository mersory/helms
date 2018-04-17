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
		clear_table()
		var fromtimeInput=$('#income_expense_start').val();
		var totimeInput=$('#income_expense_end').val();
		if (validate() == true)
		{
			var url = "/public/index.php/backend/common/incomeAndExpenseQuery";
			$.post(url, {_start:fromtimeInput, _end:totimeInput}, function(msg){
			msg=JSON.parse(msg);
			if(msg.info == 'ok')
			{
			  for (var res_index=0;res_index<msg.res.length;res_index++)
			  {
				  addCol(res_index, msg.res[res_index].user_id, msg.res[res_index].deal_count, msg.res[res_index].current_profit, msg.res[res_index].comment, msg.res[res_index].count_time);//查询成功，增加行和列
			  }
			  //window.location.href = "UserLogin.html";
			} else {
			  alert("登录失败");
			  return false;
			}
			})
			return true;
		}
		else
		{
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
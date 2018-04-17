$(function(){
	$('#withdraw_start').datetimepicker({
		format:"yyyy-mm-dd",
		weekStart: 1,
		todayBtn: 1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
		showMeridian: 1
		});
	
	$('#withdraw_end').datetimepicker({
		format:"yyyy-mm-dd",
		weekStart: 1,
		todayBtn: 1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
		showMeridian: 1
		});
	
	$('#withdraw_application').on("click",function(){
		clear_table();
		var useridInput=$('#userid').val();
		var fromtimeInput=$('#withdraw_start').val();
 	    var totimeInput=$('#withdraw_end').val();
		if (validate() == true)
		{
			var url = "/public/index.php/backend/common/presentApplicationQuery";
			$.post(url, {_user_id:useridInput, _start:fromtimeInput, _end:totimeInput}, function(msg){
			msg=JSON.parse(msg);
			if(msg.info == 'ok')
			{
			  for (var res_index=0;res_index<msg.res.length;res_index++)
			  {
				  addCol(res_index, msg.res[res_index].user_id, msg.res[res_index].withdrawal_type, msg.res[res_index].withdraw_sum, msg.res[res_index].apply_time, msg.res[res_index].withdrawal_status, msg.res[res_index].verifier_id, msg.res[res_index].approve_time);//查询成功，增加行和列
			  }
			} else {
			  alert("登录失败");
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

//插入行
function addCol(res_index, user_id, withdrawal_type, withdraw_sum, apply_time, withdrawal_status, verifier_id, approve_time) {
	$("table#withdraw_list_table tr:last").after('<tr><td>'+ res_index + '</td><td>'+ user_id + '</td><td>'+ withdrawal_type + '</td><td> '+ withdraw_sum + ' </td><td>'+ apply_time + '</td><td>'+ withdrawal_status + '</td><td> '+ verifier_id + ' </td><td>'+ approve_time + '</td>');
}


function clear_table() {
	var trs = $("#withdraw_list_table").find("tr");
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
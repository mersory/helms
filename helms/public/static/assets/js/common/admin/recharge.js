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
		clear_table()
		//alert("调用方法");
		var useridInput=$('#recharge_search_userid').val();
		if (validate() == true)
		{
			//alert("valid");
			var url = "/public/index.php/backend/useropt/userRechargeQuery";
			$.post(url, {user_id:useridInput}, function(msg){
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
			  alert("查询失败");
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
function addCol(_index, _id, _username, _cztype, _time, _money, _czyttype, _czinstruction, _statues) {
	$("table#userList_table tr:last").after('<tr><td>'+ _index + '</td><td>'+ _id + '</td><td> '+ _username + ' </td><td>'+ _time + ' </td><td>'+ _cztype + ' </td><td>'+ _money + ' </td><td>'+ _czyttype + ' </td><td>'+ _czinstruction + ' </td><td>'+ _statues + ' </td>');
  /*$th = $("<th>增加的列头</th>");
  $col = $("<td>增加的列</td>");
  $("#userlist>thead>tr").append($th);
  $("#userlist>tbody>tr").append($col);*/
}


function clear_table() {
	var trs = $("#userList_table").find("tr");
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
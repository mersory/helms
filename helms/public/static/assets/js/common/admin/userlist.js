$(function(){
	//时间插件
	$('#fromtime').datetimepicker({
		format:"yyyy-mm-dd",
		weekStart: 1,
		todayBtn: 1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
		showMeridian: 1
		});
	
	$('#totime').datetimepicker({
		format:"yyyy-mm-dd",
		weekStart: 1,
		todayBtn: 1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
		showMeridian: 1
		});
	
	
	
	$('#btn_user_list').on("click",function(){
		clear_table()
		//alert("调用方法");
		var useridInput=$('#userid').val();
		var usernameInput=$('#username').val();
		var telphoneInput=$('#telphone').val();
		var emailInput=$('#email').val();
		var fromtimeInput=$('#fromtime').val();
		var totimeInput=$('#totime').val();
		if (validate() == true)
		{
			//alert("valid");
			var url = "/public/index.php/backend/common/SearchUserInfo";
			$.post(url, {_userid:useridInput, _username:usernameInput, _telphone:telphoneInput, _email:emailInput, _fromtime:fromtimeInput, _totime:totimeInput}, function(msg){
			msg=JSON.parse(msg);
			if(msg.info == 'ok')
			{
			  //alert('登录成功，正在转向后台主页！');
			  for (var res_index=0; res_index<msg.res.length; res_index++)
			  {
				  addCol(res_index, msg.res[res_index].ID, msg.res[res_index].username, msg.res[res_index].telphone, msg.res[res_index].email, msg.res[res_index].user_level, msg.res[res_index].recommender, msg.res[res_index].kaitongID, msg.res[res_index].open_time);//查询成功，增加行和列
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
function addCol(_index, _id, _username, _telphone, _email, _level, _fromtime) {
	$("table#userList_table tr:last").after('<tr><td>'+ _index + '</td><td>'+ _id + '</td><td> '+ _username + ' </td><td>'+ _telphone + ' </td><td>'+ _email + ' </td><td>'+ _level + ' </td><td>'+ _fromtime + ' </td>');
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
$(function(){
	$('#btn_point_details').on("click",function(){
		clear_table()
		alert("调用方法");
		var useridInput=$('#userid').val();
		if (validate() == true)
		{
			alert("valid");
			var url = "/public/index.php/backend/common/pointDetailsQuery";
			$.post(url, {_user_id:useridInput}, function(msg){
			msg=JSON.parse(msg);
			if(msg.info == 'ok')
			{
			  alert('登录成功，正在转向后台主页！');
			  addCol(msg.res[0].ID, msg.res[0].shares, msg.res[0].bonus_point, msg.res[0].regist_point, msg.res[0].re_consume, msg.res[0].universal_point, msg.res[0].re_cast, msg.res[0].remain_point, msg.res[0].blocked_point);//查询成功，增加行和列
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
			//$("#username").focus();
			alert("not valid");
			return false;
		}
	 });
		
});

//输入序列合法性检测
function validate() 
{
   alert("输入序列合法");
   return true;
}  

//插入行
function addCol(ID, shares, bonus_point, regist_point, re_consume, universal_point, re_cast, remain_point, blocked_point) {
	alert(ID);
	$("table#pointlist tr:last").after('<tr><td>'+ ID + '</td><td>'+ shares + '</td><td>'+ bonus_point + '</td><td> '+ regist_point + ' </td><td>'+ re_consume + ' </td><td>'+ universal_point + ' </td><td>'+ re_cast + ' </td><td>'+ remain_point + ' </td><td>'+ blocked_point + ' </td>');
  /*$th = $("<th>增加的列头</th>");
  $col = $("<td>增加的列</td>");
  $("#userlist>thead>tr").append($th);
  $("#userlist>tbody>tr").append($col);*/
}


function clear_table() {
	var trs = $("#pointlist").find("tr");
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
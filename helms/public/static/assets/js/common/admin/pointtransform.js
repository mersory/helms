$(function(){
	$('#btn_point_transform').on("click",function(){
		clear_table();
		alert("调用方法");
		var useridInput=$('#userid').val();
		var fromtimeInput=$('#point_transform_start').val();
 	    var totimeInput=$('#point_transform_end').val();
		if (validate() == true)
		{//pointTransformQuery($_user_id, $_start, $_end)
			alert("valid");
			var url = "/public/index.php/backend/common/pointTransformQuery";
			$.post(url, {_user_id:useridInput, _start:fromtimeInput, _end:totimeInput}, function(msg){
			msg=JSON.parse(msg);
			if(msg.info == 'ok')
			{
			  alert('登录成功，正在转向后台主页！');
			  for (var res_index=0;res_index<msg.res.length;res_index++)
			  {
				  addCol(res_index, msg.res[res_index].user_id, msg.res[res_index].point_change_type, msg.res[res_index].point_change_sum, msg.res[res_index].point_change_time);//查询成功，增加行和列
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
   alert("输入序列合法");
   return true;
}  

function pointtran() 
{
   alert("pointtran");
   return true;
}  


//插入行
function addCol(res_index, user_id, point_change_type, point_change_sum, point_change_time) {
	alert(user_id);
	$("table#point_transform_list tr:last").after('<tr><td>'+ res_index + '</td><td>'+ user_id + '</td><td>'+ point_change_type + '</td><td> '+ point_change_sum + ' </td><td>'+ point_change_time + '</td>');
  /*$th = $("<th>增加的列头</th>");
  $col = $("<td>增加的列</td>");
  $("#userlist>thead>tr").append($th);
  $("#userlist>tbody>tr").append($col);*/
}


function clear_table() {
	var trs = $("#point_transform_list").find("tr");
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
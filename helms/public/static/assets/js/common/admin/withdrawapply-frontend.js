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
		var points = $('#withdraw').val();
        var pointtype=$('#pointtype').val();
        
        if("" == $.trim(points)){
			alert("提现分数不能为空");
			return false;
		}
        alert(parseInt(points));
        alert(parseInt(points) % 100)
        if( parseInt(points) % 100 == 0){
			alert("提现分数必须为100的整数");
			return false;
		}

        var url =  "/public/index.php/frontend/common/userWithdraw";
		$.post(url,{points:points, point_type:pointtype},function(resdata){
			resdata = JSON.parse(resdata);
			if(resdata.success){
				alert("提现成功");
				search_show();
			}else{
				alert("提现失败");
			}
		});
	 });
		
});

function search_show(){
	var userIdInput=$('#present-userid').val();

	var searchUrl = window.location.href.split("?")[0] + "?page=1";
	if ($.trim(userId) != "") {
		searchUrl = searchUrl + "&userid=" + userIdInput;
	}

	window.location.href = searchUrl;
}
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
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
		search_show();
	 });
		
	$('.menu_pass').on("click",function(){
		showMask();
		var withdrawId = $(this).parents("tr").find("td").eq(0).html();
		$.post("/public/index.php/backend/common/userWithdrawApprove", {
			appID : withdrawId
		}, function(res) {
			hideMask();
			res = JSON.parse(res);
			if(res.success==true){
				alert("通过");
				search_show();
			}else{
				alert("未通过");
			}
		});
	});
	$('.menu_delete').on("click",function(){
		showMask();
		var withdrawId = $(this).parents("tr").find("td").eq(0).html();
		var userId = $(this).parents("tr").find("td").eq(1).html();
		var points = $(this).parents("tr").find("td").eq(3).html();
		var pointType = $.trim($(this).parents("tr").find("td").eq(2).html());
		if(pointType == "奖励分提现"){
			pointType = 1;
		}
		else if(pointType == "注册分提现"){
			pointType = 2;
		}
		else if (pointType == "万能分提现"){
			pointType = 3;
		}
		else{
			pointType = -1;
		}
		$.post("/public/index.php/backend/common/userWithdrawDeny", {
			appID : withdrawId,
			userid : userId, 
			points : points, 
			point_type : pointType
		}, function(res) {
			hideMask();
			res = JSON.parse(res);
			if(res.success==true){
				search_show();
				alert("删除成功");
			}else{
				alert("删除失败");
			}
		});
	});
});

function search_show(){
	var userId=$('#search-userid').val();
    var fromtimeInput=$('#withdraw_start').val();
    var totimeInput=$('#withdraw_end').val();
//    var typeInput=$('#cur_status').val();

    var searchUrl = window.location.href.split("?")[0] + "?page=1";
    if ($.trim(userId) != "") {
        searchUrl = searchUrl + "&userId=" + userId;
    }

    if ($.trim(fromtimeInput) != "") {
        searchUrl = searchUrl + "&fromTime=" + fromtimeInput;
    }

    if ($.trim(totimeInput) != "") {
        searchUrl = searchUrl + "&toTime=" + totimeInput;
    }
    
//    if ($.trim(typeInput) != "") {
//        searchUrl = searchUrl + "&type=" + typeInput;
//    }

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
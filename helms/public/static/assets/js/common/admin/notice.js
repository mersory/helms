$(function(){
	$('#btn_bonus').on("click",function(){
		var subject=$('#notice_subject').val();
		var comment=$('#notice_content').val();
		
		var url = "/public/index.php/backend/Adminopt/notice";
		$.post(url, {subject:subject, comment:comment}, function(res){
		res=JSON.parse(res);
		if(res.ok == 1)
		{
		  alert("发布成功");
		  window.location.href = "notice.html";
		} else {
		  alert("发布失败");
		  return false;
		}
		})
		return true;


	 });
	$('.menu_delete').on("click",function(){
		var noticeId = $(this).attr("menu_id");
		$.post("/public/index.php/backend/common/NoticeDelete", {
			noticeID : noticeId
		}, function(res) {
			res = JSON.parse(res);
			if(res.success > 0){
				alert("删除成功");
				window.location.href = "notice.html";
			}else{
				alert("删除失败");
			}
		});
	});
});

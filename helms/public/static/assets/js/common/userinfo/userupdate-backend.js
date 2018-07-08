$(function(){
	$('#btn_update').on("click",function(){
		var userIdInput=$('#userid').val();

		var searchUrl = window.location.href.split("?")[0] + "?page=1";
		if ($.trim(userId) != "") {
			searchUrl = searchUrl + "&userid=" + userIdInput;
		}

		window.location.href = searchUrl;
	});
})
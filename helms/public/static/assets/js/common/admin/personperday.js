$(function(){
		
	$('#btn_bonus').on("click", function() {
		// alert("调用方法");
		var userIdInput=$('#userid').val();

		var searchUrl = window.location.href.split("?")[0] + "?page=1";
		if ($.trim(userId) != "") {
			searchUrl = searchUrl + "&userid=" + userIdInput;
		}

		window.location.href = searchUrl;
	});
});

//输入序列合法性检测
function validate() 
{
   return true;
}  


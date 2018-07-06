$(function(){
	//时间插件
	$('#point_transform_start').datetimepicker({
		format:"yyyy-mm-dd",
		weekStart: 1,
		todayBtn: 1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
		showMeridian: 1
		});
	
	$('#point_transform_end').datetimepicker({
		format:"yyyy-mm-dd",
		weekStart: 1,
		todayBtn: 1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
		showMeridian: 1
		});
	
	$('#btn_point_transform').on("click",function(){
		var userId=$('#search-userid').val();
		var fromtimeInput=$('#point_transform_start').val();
 	    var totimeInput=$('#point_transform_end').val();

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

        window.location.href = searchUrl;

	 });
		
});


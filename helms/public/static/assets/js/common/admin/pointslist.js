$(function(){

    $('#btn_point_details').on("click", function() {
        // alert("调用方法");
        var userId = $('#search-userid').val();

        var searchUrl = window.location.href.split("?")[0] + "?page=1";
        if ($.trim(userId) != "") {
            searchUrl = searchUrl + "&search-userid=" + userId;
        }

        window.location.href = searchUrl;
    });
		
});


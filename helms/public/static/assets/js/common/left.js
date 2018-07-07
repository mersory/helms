$(function(){
    var url =  "/public/index.php/backend/useropt/usergujiague";

    //定时刷新股价股额
    setInterval(function(){
        var userId = $("#userId").val();
        $.post(url,{user_id:userId},function(result){
            result = JSON.parse(result);
            if(result.success){
                if(undefined != $("#show-curgujia")){
                    $("#show-curgujia").empty().html(result.result.current_gujia);
                }

                if(undefined != $("#show-gushu")){
                    $("#show-gushu").empty().html(result.result.gushu);
                }

                if(undefined != $("#show-gue")){
                    $("#show-gue").empty().html(result.result.gue);
                }
            }
        });
    },5000);
    
    
    if(undefined != $(".menu")){
    	$(".menu li").removeClass("active");
    	$(".menu li").each(function(){
    		var link = $(this).find("a").attr("href");
    		var curLink = window.location.href;
    		
    		if(curLink.indexOf(link) != -1){
    			$(this).addClass("active");
    		}
    	});
    }

})
$(function(){
    var u = navigator.userAgent;
    var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
    var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
	if(isiOS){
		$("html").css("height","100%");
	}
	
	//登出
	$(".login-out").on("click",function(){
		var url =  "/public/index.php/login/login/loginout";
		 $.post(url,{},function(result){
			 result = JSON.parse(result);
			 if(result.result){
				 window.location.href="/public/index.php/login/login/index";
			 }
		 });
	});
});

/** 
*	js中更改日期  
* 	y年， m月， d日， h小时， n分钟，s秒  
*/  
Date.prototype.add = function (part, value) {
    value *= 1;  
    if (isNaN(value)) {  
        value = 0;  
    }  
    switch (part) {  
        case "y":  
        	this.setFullYear(this.getFullYear() + value);  
            break;  
        case "m":  
        	this.setMonth(this.getMonth() + value);  
            break;  
        case "d":  
        	this.setDate(this.getDate() + value);  
            break;  
        case "h":  
        	this.setHours(this.getHours() + value);  
            break;  
        case "n":  
        	this.setMinutes(this.getMinutes() + value);  
            break;  
        case "s":  
        	this.setSeconds(this.getSeconds() + value);  
            break;  
        default:  
    }  
}

//格式化
Date.prototype.Format = function(fmt) {
  var o = {   
    "M+" : this.getMonth()+1,                 //月份   
    "d+" : this.getDate(),                    //日   
    "h+" : this.getHours(),                   //小时   
    "m+" : this.getMinutes(),                 //分   
    "s+" : this.getSeconds(),                 //秒   
    "q+" : Math.floor((this.getMonth()+3)/3), //季度   
    "S"  : this.getMilliseconds()             //毫秒   
  };   
  if(/(y+)/.test(fmt))   
    fmt=fmt.replace(RegExp.$1, (this.getFullYear()+"").substr(4 - RegExp.$1.length));   
  for(var k in o)   
    if(new RegExp("("+ k +")").test(fmt))   
  fmt = fmt.replace(RegExp.$1, (RegExp.$1.length==1) ? (o[k]) : (("00"+ o[k]).substr((""+ o[k]).length)));   
  return fmt;   
}

function isEmpty(value){
	if(undefined == value || null == value || "" == value){
		return true;
	}else{
		return false;
	}
}

function refreshShoppingCart(){
	var urlres =  "/public/index.php/frontend/store/getShoppingcartCount";
	$.post(urlres,{},function(result){
		result = JSON.parse(result);
		if(result.result){
			$(".shoppingcart_count").empty().html(result.count);
		}
	});
}

function showMask(){
	$(".common-mask").show();
	$(".common-mask .common-loader").show();
}

function hideMask(){
	$(".common-mask").hide();
	$(".common-mask .common-loader").hide();
}
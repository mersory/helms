$(function(){
	// 获取创建用户前页面传递的数据，赋值给对应的输入框
	var info= GetQueryString("parentId");
	var recInput = document.getElementById("recommender");
	var actInput= document.getElementById("activator");
	recInput.value = info;
	actInput.value = info;
	
	//处理产品级别
	$("#product option").hide();
	$("#product option[value='"+$("#level option:selected").val()+"']").show();
	
	$("#level").on("change",function(){
		$("#product option").hide();
		$("#product option[value='"+$("#level option:selected").val()+"']").show();
	})
	
	$('#regist').on("click",function(){
		var id = $("#memberId").val();
		var username = $("#fullname").val();
		var email = $("#email").val();
		var telphone = $("#telphone").val();
		var recommender = $("#recommender").val();
		var activator = $("#activator").val();
		var primarypwd = $("#primarypwd").val();
		var minorpwd = $("#minorpwd").val();
		var level = $("#level option:selected").val();
		var product = $("#product option:selected").val();

		if("" == $.trim(username)){
			showError("用户名不能为空");
			return false;
		}
		
		if("" == $.trim(email)){
			showError("邮箱不能为空");
			return false;
		}
		if("" == $.trim(telphone)){
			showError("电话不能为空");
			return false;
		}
		
		if("0" == $.trim(product)){
			showError("请选择产品");
			return false;
		}
		
/*		if("" == $.trim(recommender)){
			showError("推荐人不能为空");
			return false;
		}
		if("" == $.trim(activator)){
			showError("节点人不能为空");
			return false;
		}
		
		if("" == $.trim(primarypwd)){
			showError("一级密码不能为空");
			return false;
		}
		if("" == $.trim(minorpwd)){
			showError("二级密码不能为空");
			return false;
		}*/
		var url =  "/public/index.php/frontend/Useropt/UserRegist";
		$.post(url,{ID:id, name:username, email:email, telphone:telphone, recommender:recommender, activator:activator, pwd1:"123", pwd2:"123", userlevel:level},function(result){
			result = JSON.parse(result);
			if(result.success){
				alert("注册成功，点击确定回到主页");
				window.location.href="/public/index.php/frontend/common/network";
			}else{
				alert("注册失败，请重新注册");
				window.location.href="/public/index.php/frontend/common/network";
			}
		});
//		event.stopPropagation();
	 	});
		
});

function GetQueryString(name)
{
     var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
     var r = window.location.search.substr(1).match(reg);
     if(r!=null)return  unescape(r[2]); return null;
}


function countDown(secs,surl){        
	var jumpTo = document.getElementById('jumpTo');
	jumpTo.innerHTML=secs;  
	if(--secs>0){     
	    setTimeout("countDown("+secs+",'"+surl+"')",1000);     
	}     
	else{       
		window.location.href=surl;     
	}     
}  

//changed by Gavin start
function Dsy() {
    this.Items = {}
}
Dsy.prototype.add = function(id, iArray) {
    this.Items[id] = iArray
}
Dsy.prototype.Exists = function(id) {
    if (typeof(this.Items[id]) == "undefined") return false;
    return true
}
function change(v) {
	
    var str = "0";
    for (i = 0; i < v; i++) {
        str += ("_" + (document.getElementById(s[i]).selectedIndex - 1))
    };
    var ss = document.getElementById(s[v]);
    with(ss) {
        length = 0;
        options[0] = new Option(opt0[v], opt0[v]);
        if (v && document.getElementById(s[v - 1]).selectedIndex > 0 || !v) {
            if (dsy.Exists(str)) {
                ar = dsy.Items[str];
                for (i = 0; i < ar.length; i++) options[length] = new Option(ar[i], ar[i]);
                if (v) options[1].selected = true
            }
        }
        if (++v < s.length) {
            change(v)
        }
    }
}
var dsy = new Dsy();
dsy.add("0", ["一星会员", "二星会员"]);
dsy.add("0_0", ["冰箱鲜生智能健康管家*1台"]);
dsy.add("0_1", ["迦尔纳微型太阳能发电站*1台", "卟叮纳米光波驱蚊宝*1台", "冰箱鲜生智能健康管家*2台"]);
//changed by Gavin end
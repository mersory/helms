$(function(){
	$("#confirmApplicationDialog").dialog({
	    autoOpen: false,
		resizable : false,
		height : "auto",
		width : 600,
		modal : true,
		buttons : {
			"确定" : function() {
				var applicationId = $("#confirmApplicationDialog #application_id").val();
				var minorpwd = $("#confirmApplicationDialog #minorpwd").val();
				if(isEmpty(minorpwd)){
					alert("请输入二级密码");
					return false;
				}else{
					activateAction(applicationId,minorpwd);
				}
			}
		}
	});
	
	//时间插件
	$('#applytime_start').datetimepicker({
		format:"yyyy-mm-dd",
		weekStart: 1,
		todayBtn: 1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
		showMeridian: 1
		});
	
	$('#applytime_end').datetimepicker({
		format:"yyyy-mm-dd",
		weekStart: 1,
		todayBtn: 1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
		showMeridian: 1
		});
	
	$('#btn_application_list').on("click",function(){
			clear_table()
			var fromtimeInput=$('#applytime_start').val();
	 	    var totimeInput=$('#applytime_end').val();
	 	    
	 	   var searchUrl = window.location.href.split("?")[0] + "?page=1";
	        if ($.trim(userId) != "") {
	            searchUrl = searchUrl + "&fromTime=" + fromtimeInput;
	        }
	        
	        if ($.trim(totimeInput) != "") {
	            searchUrl = searchUrl + "&toTime=" + totimeInput;
	        }
	        window.location.href = searchUrl;
	        
	 	 });
	
	//激活
	$(".menu_pass").on("click",function(){
		$("#confirmApplicationDialog").dialog( "open" );
		var menuId = $(this).parents("tr").find("td").eq(6).html();
		var minorpwd = $("#minorpwd").val();
		activateAction(menuId, minorpwd);
	});
	
	//删除
	$(".menu_delete").on("click",function(){
		$("#confirmApplicationDialog").dialog( "open" );
		var menuId = $(this).parents("tr").find("td").eq(6).html();
		var minorpwd = $("#minorpwd").val();
		activateAction(menuId, minorpwd);
	});
		
});

//输入序列合法性检测
function validate() 
{
   return true;
}  


//
function onClickBtn(o)  
{  
var user =[    
                { id:0, name:"成果"},   
                { id:1, name:"其它事情"},   
                { id:2, name:"成果编辑"},    
                { id:3, name:"审核编辑"}  
                ];    
                  
    var tr=o.parentNode.parentNode;  
    //alert (o.value);  
    //var tbody=tr.parentNode;    
    //tbody.removeChild(tr);  
    
    for(var index = 0; index < user.length; index++)  
    {  
       if(o.value == user[index].name)  
       {  
         break;  
       }  
    }     
}  
  
function show()
{
	 var myp=document.getElementById("applyList_table");
	 var input =document.createElement("input");
	 input.type="button";
	 input.value="动态按钮";
	 myp.appendChild(input);
}

var i = 0;
function addInput(){
var o = document.createElement('input');
o.type = 'button';
o.value = '按钮'+ i++;
if(o.attachEvent){
o.attachEvent('onclick',addInput)
}else{
o.addEventListener('click',addInput)
}
document.body.appendChild(o);
o = null;
}



//插入行
//changed by Gavin start model7
function addCol(_index, _username, _telphone, _email,_level, _fromtime, _id) {
	$("table#applyList_table tr:last").after('<tr><td>'+ _index + '</td><td> '+ _username + ' </td><td>'+ _telphone + ' </td><td>'+ _email + ' </td><td>'+ _level +' </td><td>'+ _fromtime + ' </td><td>'+ _id + '</td><td><button application_id="'+_id+'" type="button" class="btn btn-primary btn_application_list">激活</button></td>');
//changed by Gavin end model7
	$(".btn_application_list").off("click").on("click",function(){
		var id= $(this).attr("application_id");
		$("#confirmApplicationDialog").dialog( "open" );
		$("#confirmApplicationDialog #application_id").val(id);
	})
	
	
}

function activateAction(id, minorpwd)
{
		var url = "/public/index.php/frontend/Adminopt/activateUser";
	        $.post(url, {user_id:id, minor_pwd:minorpwd}, function(msg){
		        msg=JSON.parse(msg);
		        if(msg.success == true)
		        {
		        	alert('激活成功');
			  	} 
		        else 
		        {
			  		alert("激活失败，积分不够");
		        }
	        })

}

function clear_table() {
	var trs = $("#applyList_table").find("tr");
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
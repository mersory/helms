$(function(){
	
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
	 		alert("调用方法");
			var fromtimeInput=$('#applytime_start').val();
	 	    var totimeInput=$('#applytime_end').val();
	 	   	if (validate() == true)
 	   		{
 	   			alert("valid");
	 	   		var url = "/public/index.php/backend/common/memberApplicationQueryByTime";
	 	        $.post(url, {_start:fromtimeInput, _end:totimeInput}, function(msg){
				msg=JSON.parse(msg);
	 	        if(msg.info == 'ok')
	 	        {
	 	          alert('登录成功，正在转向后台主页！');
				  for (var res_index=0;res_index<msg.res.length;res_index++)
				  {
					  addCol(res_index, msg.res[res_index].user_name, msg.res[res_index].telphone, msg.res[res_index].email, msg.res[res_index].open_time, msg.res[res_index].ID);//查询成功，增加行和列
				  }
	 	          //window.location.href = "UserLogin.html";user_name,telphone,email,open_time,ID
	 	        } else {
	 	          alert("登录失败");
	 	          return false;
	 	        }
	 	        })
 	   			return true;
 	   		}
	 	   	else
 	   		{
		 	   	//$("#username").focus();
				alert("not valid");
		        return false;
 	   		}
	 	 });
		
});

//输入序列合法性检测
function validate() 
{
   alert("输入序列合法");
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
         alert ("干一些"+user[index].name+"相关的事情");  
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
function addCol(_index, _username, _telphone, _email,_fromtime, _id) {
	alert(_id);
	$("table#applyList_table tr:last").after('<tr><td>'+ _index + '</td><td> '+ _username + ' </td><td>'+ _telphone + ' </td><td>'+ _email + ' </td><td>'+ _fromtime + ' </td><td>'+ _id + '</td><td><button application_id="'+_id+'" type="button" class="btn btn-primary btn_application_list">激活</button></td>');
	$(".btn_application_list").off("click").on("click",function(){
		var id= $(this).attr("application_id");
		
		
	})
	
	
}

function activateACT(id, minorpwd)
{
		var url = "/public/index.php/frontend/Adminopt/activateUser";
	        $.post(url, {user_id:id, minor_pwd:minorpwd}, function(msg){
		        msg=JSON.parse(msg);
		        if(msg.info == 'ok')
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
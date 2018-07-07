var getChildrenNetworkUrl = "/public/index.php/frontend/common/get_all_children";
var getChildrenByParentsNetworkUrl = "/public/index.php/frontend/common/get_all_children";
$(function() {
	
	// 创建用户
	$('#btn-add-user')
			.on(
					'click',
					function() {
						// 节点人ID
						var parentId = $('#rd-node-user').val();
						if($.trim(parentId) != ""){
							var urlres =  "/public/index.php/frontend/Adminopt/getNodeChild";
							$.post(urlres,{id:parentId},function(result){
								result = JSON.parse(result);
							if(result.success == 1){
								var url = "/public/index.php/frontend/Useropt/RegistIndex?parentId=" + parentId+"&position=left";
								//window.open(url);
								//changed by Gavin start
								window.location.href=url;
								//changed by Gavin end
							} else if(result.success == 0){
								alert("当前点位已存在两个子点位，不可再产生子点位，请重新选择");
							} else if(result.success == -1){
								alert("当前点位左区不存在直推的用户，请重新选择");
							} else if(result.success == 2){
								alert("当前点位尚未激活不能注册子节点，请重新选择");
							}
							});
						}
						else{
							alert("请先选择父节点");
						}
					});
	
	//搜索按钮
	$("#network-search").on("click",function(){
		showMask();
		var parentId = $('#searchUserId').val();
		if($.trim(parentId) != ""){
			var urlres =  "/public/index.php/frontend/Adminopt/checkNodeChild";
			$.post(urlres,{id:parentId},function(result){
				hideMask();
				result = JSON.parse(result);
			if(result.success){
				refreshNetworkChart(parentId,getChildrenNetworkUrl);
			} else {
				alert("没有权限查看当前输入节点的网络结构");
			}
			});
			//refreshNetworkChart(parentId);
		}
	});
	
	//返回上一层按钮
	$("#network-uplevel").on("click",function(){
		var parentId = $('#searchUserId').val();
		if($.trim(parentId) != ""){
			var urlres =  "/public/index.php/frontend/Adminopt/checkNodeParent";
			$.post(urlres,{id:parentId},function(result){
				result = JSON.parse(result);
			if(result.success){
				parentId = result.cur_id
				refreshNetworkChart(parentId,getChildrenNetworkUrl);
				$('#rd-node-user').val(parentId);
				$('#searchUserId').val(parentId);
			} else {
				alert("没有权限查看当前输入节点的网络结构");
			}
			});
			//refreshNetworkChart(parentId);
		}
	});
	
	refreshNetworkChart( $('#searchUserId').val(),getChildrenNetworkUrl);
})

function refreshNetworkChart(_userId, loadNetworkUrl){
	//var userId = "100042";
	$.post(loadNetworkUrl, {
		applyuserId : _userId
	}, function(result) {
		result = JSON.parse(result);
		if (result.info == 'ok') {
			var dataSource = handleNetworkData(result.res,_userId);
			if(null == dataSource){
				$('#chart-container').empty();
			}else{
				$('#chart-container').empty();
				var oc = $('#chart-container').orgchart({
					'data' : dataSource,
					'nodeTitle' : 'userId',
					'nodeContent' : 'realname',
					'exportButton' : true,
					'exportFilename' : 'SportsChart',
					'parentNodeSymbol' : 'fa-th-large',
					'createNode' : function($node, data) {
						$node[0].id = getId();
						
						//非一星用户
						if(data.level != "1"){
							$node.find(".title").addClass("isLevel1");
							$node.find(".content").addClass("isLevel1");
						}
						
						//未激活状态
						if(data.status != "1"){
							$node.find(".title").empty().html("<i style='left:-7px;' class='glyphicon glyphicon-ban-circle'></i>"+data.userId);
						}else{
							$node.find(".title").empty().html(data.userId);
						}
							
						$node.find(".content").empty().html(data.realname+"<br/>总："+data.lds+"-"+data.rds+"<br/>剩："+data.sqlds+"-"+data.sqrds);
					}
				});

				oc.$chartContainer.on('click', '.node', function() {
					var $this = $(this);
					if ($('#searchUserId').val() != $this.find('.title').text()){
						$('#rd-node-user').val($this.find('.title').text());
						$('#rd-introduce-user').val($this.find('.title').text());
						$('#searchUserId').val($this.find('.title').text());
						refreshNetworkChart( $('#searchUserId').val(),getChildrenNetworkUrl);
					}
				});		
			}
		}else{
			alert("未查询该会员的网络结构");
		}
	});
}

function handleNetworkData(mapData,userId){
	var index = 1;
	return getUserInfo(mapData,userId,index);
}

//递归返回五层网络结构
function getUserInfo(mapData,userId,index){
	if(null != userId){
		var data = mapData[userId];
		var originObject = new Object();
		originObject.userId = data.currentId;
		originObject.realname = data.realname;
		originObject.level = data.level;
		originObject.status = data.status;
		originObject.lds = data.lds;
		originObject.rds = data.rds;
		originObject.sqlds = data.sqlds;
		originObject.sqrds = data.sqrds;
		
		if(null != data.childrenId || undefined != data.childrenId || "" != $.trim(data.childrenId)){
			var childrenSplitArray = data.childrenId;
			var childrenArray = new Array();
			for(var i in childrenSplitArray){
				if (index<5){
					childrenArray.push(getUserInfo(mapData,childrenSplitArray[i],index+1));
				}
				else
					break;
			}
			originObject.children  = childrenArray;
		}
		return originObject;		
	}else{
		return null;
	}
}

function getId() {
	return (new Date().getTime()) * 1000 + Math.floor(Math.random() * 1001);
};
var loadNetworkUrl = "/public/index.php/frontend/common/get_introducer_tree_single";
$(function() {

	//搜索按钮
	$("#network-search").on("click",function(){

		var CurrentId = $('#userId').val();
		if($.trim(CurrentId) != ""){			
			var urlres =  "/public/index.php/frontend/Common/checkRecommondChild";
			$.post(urlres,{id:CurrentId},function(result){
				result = JSON.parse(result);
			if(result.success){
				refreshIntroduceTree(CurrentId);
			} else {
				alert("没有权限查看当前输入节点的网络结构");
			}
			});
		}
	})
	
	refreshIntroduceTree( $('#userId').val());
})



function getTree() {
	//
	var tree = [ {
		'text' : "Parent1",
		'nodes' : [ {
			'text' : "Child1",
			'nodes' : [ {
				'text' : "Grandchild1"
			}, {
				'text' : "Grandchild2"
			} ]
		}, {
			'text' : "Child2"
		} ]
	}, {
		'text' : "Parent2"
	}, {
		'text' : "Parent3"
	}, {
		'text' : "Parent4"
	}, {
		'text' : "Parent5"
	} ];
	return tree;
}

function refreshIntroduceTree(userId) {
	$.post(loadNetworkUrl, {
		userId : userId
	}, function(result) {
		result = JSON.parse(result);
		if (result.info == 'ok') {
			var dataSource = getIntroduceTreeData(result.res, userId);
			if (null == dataSource) {
				$('#chart-container').empty();
			} else {
				$('#introduce-tree').treeview({
					data : dataSource,
					icon:"glyphicon glyphicon-plus",
					selectedIcon:"glyphicon glyphicon-stop",
					color:"#000000",
					backColor:"transparent",
					selectable:true,
					state:{
						checked:true,
						disabled:true,
						expanded:true,
						selected:true
					},
					onNodeSelected:function(event,node){
						$.post(loadNetworkUrl, {
							userId : node.userId
						}, function(result) {
							result = JSON.parse(result);
							if (result.info == 'ok') {
								var map = getIntroduceTreeData(result.res, node.userId);
								if (null == map) {
									$('#chart-container').empty();
								} else {
									for(var i in map[0].nodes){
										$("#introduce-tree").treeview("addNode", [node.nodeId, { node: { text:map[i].text, userId:map[i].userId,parentId:node.nodeId} }]);	
									}
								}
							}
						});
					}
				});
			}
		} else {
			alert("未查询该会员的推荐结构");
		}
	});
}

function getIntroduceTreeData(mapData,userId) {
	if(null != userId){
		var dataArray = new Array();
		var data = mapData[userId];
		var originObject = new Object();
		originObject.text = userId;
		originObject.userId = userId;
		
		var userArray = new Array();
		for(var i in mapData){
			if(i != userId){
				var object = new Object();
				object.text = mapData[i].user_name;
				object.userId = mapData[i].userId;
				userArray.push(object);
			}
		}
		originObject.nodes = userArray;

		dataArray.push(originObject);
		return userArray;		
	}else{
		return null;
	}
}


var loadNetworkUrl = "/public/index.php/frontend/common/get_introducer_tree";
$(function() {

	refreshIntroduceTree('100050');
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
					icon:"glyphicon glyphicon-stop",
					selectedIcon:"glyphicon glyphicon-stop",
					color:"#000000",
					backColor:"#FFFFFF",
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
		originObject.text = data.userName;
		originObject.userId = data.userId;
		
		var userArray = new Array();
		for(var i in mapData){
			if(i != userId){
				var object = new Object();
				object.text = mapData[i].userName;
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


var loadNetworkUrl = "/public/index.php/frontend/common/get_all_children";
$(function() {
	// 创建用户
	$('#btn-add-user')
			.on(
					'click',
					function() {
						// 节点人ID
						var parentId = $('#rd-node-user').val();
						if($.trim(parentId) != ""){
							var url = "/public/index.php/frontend/Useropt/RegistIndex?parentId="
								+ parentId;
							window.open(url);	
						}else{
							alert("请先选择父节点");
						}
					});
	
	//搜索按钮
	$("#network-search").on("click",function(){
		var parentId = $('#userId').val();
		if($.trim(parentId) != ""){
			refreshNetworkChart(parentId);
		}
	})
	
	refreshNetworkChart( $('#userId').val());
})

function refreshNetworkChart(userId){
	var userId = "100042";
	$.post(loadNetworkUrl, {
		userId : userId
	}, function(result) {
		result = JSON.parse(result);
		if (result.info == 'ok') {
//			var datascource = {
//					'userId' : '11111',
//					'realname' : 'Ball game',
//					'children' : [ {
//						'userId' : '11112',
//						'realname' : 'Ball game'
//					}, {
//						'userId' : '11113',
//						'realname' : 'Ball game'
//					}, {
//						'userId' : '11114',
//						'realname' : 'Ball game'
//					} ]
//				};
			var dataSource = handleNetworkData(result.res,userId);
			if(null == dataSource){
				$('#chart-container').empty();
			}else{
				var oc = $('#chart-container').orgchart({
					'data' : dataSource,
					'nodeTitle' : 'userId',
					'nodeContent' : 'realname',
					'exportButton' : true,
					'exportFilename' : 'SportsChart',
					'parentNodeSymbol' : 'fa-th-large',
					'createNode' : function($node, data) {
						$node[0].id = getId();
					}
				});

				oc.$chartContainer.on('click', '.node', function() {
					var $this = $(this);
					$('#rd-node-user').val($this.find('.title').text());
					$('#rd-introduce-user').val($this.find('.title').text());
				});		
			}
		}else{
			alert("未查询该会员的网络结构");
		}
	});
}

function handleNetworkData(mapData,userId){
	return getUserInfo(mapData,userId);
}

//递归返回五层网络结构
function getUserInfo(mapData,userId){
	if(null != userId){
		var data = mapData[userId];
		var originObject = new Object();
		originObject.userId = data.currentId;
		originObject.realname = data.realname;
		if(null != data.childrenId || undefined != data.childrenId || "" != $.trim(data.childrenId)){
			var childrenSplitArray = data.childrenId;
			var childrenArray = new Array();
			for(var i=0;i<childrenSplitArray.length;i++){
				childrenArray.push(getUserInfo(mapData,childrenSplitArray[i]));
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
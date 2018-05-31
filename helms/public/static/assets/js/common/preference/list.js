$(function() {
	$("#addPreferenceDialog").dialog({
	    autoOpen: false,
		resizable : false,
		height : "auto",
		width : 600,
		modal : true,
		buttons : {
			"确定" : function() {
				var preferenceId = $("#addPreferenceDialog #preference_id").val();
				if("" == preferenceId){
					//新增
					$.post("/public/index.php/backend/preference/addPreference", {
						preference_name : $("#addPreferenceDialog #preference_name").val(),
						preference_code : $("#addPreferenceDialog #preference_code").val(),
						preference_value : $("#addPreferenceDialog #preference_value").val()
					}, function(result) {
						result = JSON.parse(result);
						if(result.result){
							alert("新增参数成功");
							window.location.reload();
						}else{
							alert("新增参数失败");
						}
					});
				}else{
					//修改
					//新增
					$.post("/public/index.php/backend/preference/modifyPreference", {
						preference_id : preferenceId,
						preference_name : $("#addPreferenceDialog #preference_name").val(),
						preference_code : $("#addPreferenceDialog #preference_code").val(),
						preference_value : $("#addPreferenceDialog #preference_value").val()
					}, function(result) {
						result = JSON.parse(result);
						if(result.result){
							alert("修改参数成功");
							window.location.reload();
						}else{
							alert("修改参数失败");
						}
					});
				}
			},
			"取消" : function() {
				$(this).dialog("close");
			}
		}
	});
	
	$(".add_preference").on("click",function(){
		$("#addPreferenceDialog").dialog( "open" );
		$("#addPreferenceDialog input").val("");
	});
	
	$(".modify_preference").on("click",function(){
		var preferenceId=$(this).attr("preference_id");

		$.post("/public/index.php/backend/preference/findPreference", {
			preference_id : preferenceId
		}, function(result) {
			result = JSON.parse(result);
			if(result.length==1){
				$("#addPreferenceDialog input").val("");
				$("#addPreferenceDialog #preference_name").val(result[0].name);
				$("#addPreferenceDialog #preference_value").val(result[0].value);
				$("#addPreferenceDialog #preference_code").val(result[0].code);
				$("#addPreferenceDialog #preference_id").val(preferenceId);
				$("#addPreferenceDialog").dialog( "open" );
			}
		});
	});
	
})


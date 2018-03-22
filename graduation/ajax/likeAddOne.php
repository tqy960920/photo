<?php 

	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Method:POST,GET');
	header("content-type:application/json;charset=utf-8");


	require_once("graduation/service/listService.php");
	require_once("graduation/model/responseInfo.php");
	require_once("graduation/util/globalSetting.php");
	// print_r($_POST);

	$Id="";
	if(array_key_exists("Id", $_GET)){
		$Id=$_GET["Id"];
	}
	else{
		$Id="0c038511-2074-11e8-b106-14dda97c4e4d";
	}

	// print_r($graphy);

	// 向数据库保存

	$result = [
		"code" => 101,
		"message" => "更新失败",
		"data" => null
	];

	$response = ListService::updateGraphy($Id);

	if($response == 1){
		$result = [
			"code" => 100,
			"message" => "更新成功",
			"data" => $response
		];
	}

echo json_encode($result);
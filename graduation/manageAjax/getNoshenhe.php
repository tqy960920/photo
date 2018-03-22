<?php 

	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Method:POST,GET');
	header("content-type:application/json;charset=utf-8");


	require_once("graduation/service/listService.php");
	require_once("graduation/model/responseInfo.php");
	require_once("graduation/model/listInfo.php");
	require_once("graduation/util/globalSetting.php");
	// print_r($_POST);


	$result = [
		"code" => 101,
		"message" => "获取失败",
		"data" => null
	];



	$response = ListService::getNoPassGraphy();
	// print_r($response);

	if($response ){
		$result = [
			"code" => 100,
			"message" => "获取成功",
			"data" => $response
		];
	}

echo json_encode($result);
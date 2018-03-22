<?php 

	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Method:POST,GET');
	header("content-type:application/json;charset=utf-8");


	require_once("graduation/service/userService.php");
	require_once("graduation/model/responseInfo.php");
	require_once("graduation/util/globalSetting.php");
	// print_r($_POST);

	// print_r($graphy);


	$result = [
		"code" => 101,
		"message" => "请求失败",
		"data" => null
	];

	$response = UserService::getUsers();

	if($response ){
		$result = [
			"code" => 100,
			"message" => "请求成功",
			"data" => $response
		];
	}

echo json_encode($result);
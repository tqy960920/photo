<?php 

	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Method:POST,GET');
	header("content-type:application/json;charset=utf-8");


	require_once("graduation/service/userService.php");
	require_once("graduation/model/responseInfo.php");
	require_once("graduation/util/globalSetting.php");
	// print_r($_POST);

	// print_r($graphy);

	$Id="";
	if(array_key_exists("Id",$_GET)){
		$Id=$_GET["Id"];
	}
	else
		$Id='be58d1ff-1f65-11e8-8f27-14dda97c4e4d';


	$result = [
		"code" => 101,
		"message" => "请求失败",
		"data" => null
	];

	$response = UserService::getFensi($Id);

	if($response ){
		$result = [
			"code" => 100,
			"message" => "请求成功",
			"data" => $response
		];
	}

echo json_encode($result);
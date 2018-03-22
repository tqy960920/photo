<?php 

	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Method:POST,GET');
	header("content-type:application/json;charset=utf-8");


	require_once("graduation/service/labelService.php");
	require_once("graduation/model/responseInfo.php");
	require_once("graduation/model/labelInfo.php");
	require_once("graduation/util/globalSetting.php");
	// print_r($_POST);


	// $Name="";
	// if(array_key_exists("Name", $_POST)){
		$Id=$_GET["Id"];
	// }
	// else{
	// 	$Name="2";
	// }


	$result = [
		"code" => 101,
		"message" => "删除失败",
		"data" => null
	];



	$response = LabelService::deleteLabel($Id);

	if($response == 1){
		$result = [
			"code" => 100,
			"message" => "删除成功",
			"data" => $response
		];
	}

echo json_encode($result);
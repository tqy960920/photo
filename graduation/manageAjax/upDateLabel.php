<?php 

	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Method:POST,GET');
	header("content-type:application/json;charset=utf-8");


	require_once("graduation/service/labelService.php");
	require_once("graduation/model/responseInfo.php");
	require_once("graduation/model/noticeInfo.php");
	require_once("graduation/util/globalSetting.php");
	// print_r($_POST);

	// $Id="";
	// if(array_key_exists("Id", $_POST)){
		$Id=$_GET["Id"];
	// }
	// else{
	// 	$Id="fe74385a-1f5d-11e8-8f27-14dda97c4e4d";
	// }

	// $Name="";
	// if(array_key_exists("Name", $_POST)){
		$Name=$_GET["Name"];
	// }
	// else{
	// 	$Name="2";
	// }

	// 向数据库保存

	$result = [
		"code" => 101,
		"message" => "更新失败",
		"data" => null
	];

	$label=new LabelInfo();
	$label->Id = $Id;
	$label->Name=$Name;

	$response = LabelService::updateLabel($label);

	if($response == 1){
		$result = [
			"code" => 100,
			"message" => "更新成功",
			"data" => $response
		];
	}

echo json_encode($result);
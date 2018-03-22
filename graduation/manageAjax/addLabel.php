<?php 

	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Method:POST,GET');
	header("content-type:application/json;charset=utf-8");


	require_once("graduation/service/labelService.php");
	require_once("graduation/model/responseInfo.php");
	require_once("graduation/model/labelInfo.php");
	require_once("graduation/util/globalSetting.php");
	// print_r($_GET);


	// $Name="";
	// if(array_key_exists("Name", $_POST)){
		$Name=$_GET["Name"];
	// }
	// else{
	// 	$Name="2";
	// }

	// echo $Name;

	$result = [
		"code" => 101,
		"message" => "添加失败",
		"data" => null
	];

	// 向数据库保存

	$label = new LabelInfo();
	$label->Id = md5(uniqid(microtime(),mt_rand()));
	$label->Name = $Name;


	$response = LabelService::insertLabel($label);

	if($response == 1){
		$result = [
			"code" => 100,
			"message" => "添加成功",
			"data" => $response
		];
	}

echo json_encode($result);
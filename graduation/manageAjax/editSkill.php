<?php 

	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Method:POST,GET');
	header("content-type:application/json;charset=utf-8");


	require_once("graduation/service/skillService.php");
	require_once("graduation/model/responseInfo.php");
	require_once("graduation/model/skillInfo.php");
	require_once("graduation/util/globalSetting.php");
	
	// print_r($_POST);
	// print_r($_FILES);

	
	$Id=$_POST["Id"];
	$Title=$_POST["Title"];
	$Content=$_POST["Content"];

	$Current=$_FILES["Image"];
	$ext=pathinfo($Current["name"],PATHINFO_EXTENSION);
	$fileName=md5(uniqid(microtime(true) . mt_rand())) . "." . $ext;
	$flag=move_uploaded_file($Current["tmp_name"] ,$_SERVER["DOCUMENT_ROOT"] . "/graduation/images/" . $fileName);

	// echo $flag;
	$result = [
		"code" => 101,
		"message" => "更新失败",
		"data" => null
	];


	if($flag){
		$Image="/graduation/images/";

		$skill = new SkillInfo();
		$skill->Id = $Id;
		$skill->Title = $Title;
		$skill->Content = $Content;
		$skill->Image = $fileName;
		$skill->CreateTime = time();
		// print_r($skill);

		$response = SkillService::editSkill($skill);
		// echo $response;

		if($response == 1){
			$result = [
				"code" => 100,
				"message" => "更新成功",
				"data" => $response
			];
		}
	}


echo json_encode($result);
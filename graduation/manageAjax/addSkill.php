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

	// $Name="";
	// if(array_key_exists("Name", $_POST)){
		
	// }
	// else{
	// 	$Name="2";
	// }

	// echo $Name;

	$Title=$_POST["Title"];
	$Content=$_POST["Content"];

	$Current=$_FILES["Image"];
	$ext=pathinfo($Current["name"],PATHINFO_EXTENSION);
	$fileName=md5(uniqid(microtime(true) . mt_rand())) . "." . $ext;
	$flag=move_uploaded_file($Current["tmp_name"] ,$_SERVER["DOCUMENT_ROOT"] . "/graduation/images/" . $fileName);

	// echo $flag;
	$result = [
		"code" => 101,
		"message" => "添加失败",
		"data" => null
	];


	if($flag){
		$Image="/graduation/images/";

		$skill = new SkillInfo();
		$skill->Id = md5(uniqid(microtime(),mt_rand()));
		$skill->Title = $Title;
		$skill->Content = $Content;
		$skill->Image = $fileName;
		$skill->CreateTime = time();
		// print_r($skill);

		$response = SkillService::addSkill($skill);
		// echo $response;
		if($response == 1){
			$result = [
				"code" => 100,
				"message" => "添加成功",
				"data" => $response
			];
		}
	}


echo json_encode($result);
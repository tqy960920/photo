<?php 

	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Method:POST,GET');
	header("content-type:application/json;charset=utf-8");

	require_once("graduation/service/userService.php");
	require_once("graduation/service/listService.php");
	require_once("graduation/model/listInfo.php");
	require_once("graduation/model/responseInfo.php");
	require_once("graduation/util/globalSetting.php");
	// print_r($_POST);

	$Title="";
	if(array_key_exists("Title", $_POST)){
		$Title=$_POST["Title"];
	}
	else{
		$Title="你好";
	}
	$Content="";
	if(array_key_exists("Content", $_POST)){
		$Content=$_POST["Content"];
	}
	else{
		$Content="???";
	}
	$Image="";
	if(array_key_exists("Image", $_POST)){
		$Image=$_POST["Image"];
	}
	else{
		$Image="1ae47eb5f576dd7c546f035d15de929a.jpg,1ae47eb5f576dd7c546f035d15de929a.jpg";
	}
	$UserId="";
	if(array_key_exists("UserId", $_POST)){
		$UserId=$_POST["UserId"];
	}
	else{
		$UserId="be58d1ff-1f65-11e8-8f27-14dda97c4e4d";
	}
	$LabelId="";
	if(array_key_exists("LabelId", $_POST)){
		$LabelId=$_POST["LabelId"];
	}
	else{
		$LabelId="fdaad46a-1f5d-11e8-8f27-14dda97c4e4d";
	}


	$graphy = new ListInfo();
	$graphy->Id = GlobalSetting::getUUID();
	$graphy->Title = $Title;
	$graphy->Introduce = $Content;
	$graphy->Image = $Image;
	$graphy->UserId = $UserId;
	$graphy->Like = 0;
	$graphy->LabelId = $LabelId;
	$graphy->CreateTime = time();
	$graphy->State = 2;
	$graphy->Review = "";
	// print_r($graphy);

	// 向数据库保存
	$flag = ListService::insertGraphy($graphy);
	// echo $flag;

	$result = new ResponseInfo(101 , "请求失败" , null);
	
	if($flag){
		$graphy->Images = explode("," , $graphy->Image);

		$count = count($graphy->Images);
		for($i = 0 ; $i < $count; $i++){
			$graphy->Images[$i] = $graphy->Images[$i] ;
		}

		$result -> code = 100;
		$result -> message = "添加成功";
		$result -> data = $graphy;

	}
	// print_r($graphy);


echo json_encode($result);
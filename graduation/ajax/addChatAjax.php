<?php 

	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Method:POST,GET');
	header("content-type:application/json;charset=utf-8");

	require_once("graduation/model/chatInfo.php");
	require_once("graduation/service/chatService.php");
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
	$UserId="";
	if(array_key_exists("UserId", $_POST)){
		$UserId=$_POST["UserId"];
	}
	else{
		$UserId="be58d1ff-1f65-11e8-8f27-14dda97c4e4d";
	}

	$chat = new ChatInfo();
	$chat->Id = GlobalSetting::getUUID();
	$chat->Title = $Title;
	$chat->Content = $Content;
	$chat->ChaterId = $UserId;
	$chat->CreateTime = time();
	// print_r($graphy);

	// 向数据库保存
	$flag = chatService::insertOneChat($chat);
	// echo $flag;

	$result = new ResponseInfo(101 , "请求失败" , null);
	
	if($flag){

		$result -> code = 100;
		$result -> message = "添加成功";
		$result -> data = $chat;
	}


echo json_encode($result);
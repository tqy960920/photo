<?php 

	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Method:POST,GET');
	header("content-type:application/json;charset=utf-8");

	require_once("graduation/service/chatService.php");
	require_once("graduation/model/chatMsgInfo.php");
	require_once("graduation/model/responseInfo.php");
	require_once("graduation/util/globalSetting.php");

	session_start();


	$result = new ResponseInfo(101 , "添加失败" , null);


	$Content="";
	if(array_key_exists("Content" , $_POST)){
		$Content = $_POST["Content"];
	}else{
		$Content="789789789";
	}
	$FollowId="";
	if(array_key_exists("FollowId" , $_POST)){
		$FollowId = $_POST["FollowId"];
	}else{
		$FollowId="1866c77d-22a9-11e8-82ce-14dda97c4e4d";
	}
	$ChatId="";
	if(array_key_exists("ChatId" , $_POST)){
		$ChatId = $_POST["ChatId"];
	}else{
		$ChatId="173ca449-234e-11e8-b2bf-14dda97c4e4d";
	}

	$UserId="";
	if(array_key_exists("UserId" , $_POST)){
		$UserId = $_POST["UserId"];
	}else{
		$UserId="9585a7bc-1f69-11e8-8f27-14dda97c4e4d";
	}
	$Header="";
	if(array_key_exists("Header" , $_POST)){
		$Header = $_POST["Header"];
	}else{
		$Header="http://192.168.12.109:9091/graduation/images/5558fc55-2049-11e8-b106-14dda97c4e4d.jpg";
	}
	$NickName="";
	if(array_key_exists("ChatId" , $_POST)){
		$NickName = $_POST["NickName"];
	}else{
		$NickName="鑫鑫";
	}



	$chat = new ChatMsgInfo();

	$chat->Id = md5(uniqid(microtime(),mt_rand()));
	$chat->Content = $Content;
	$chat->FollowId=$FollowId;
	$chat->FollowTime = time();
	$chat->ChatId = $ChatId;

	$chat->UserId = $UserId;
	$chat->Header = $Header;
	$chat->NickName = $NickName;


	// $chat->Header = $Header;
	// $chat->NickName = $NickName;

	// 向数据库保存
	$flag = ChatService::insertChat($chat);
	// echo $flag;

	if($flag){

		$result -> code = 100;
		$result -> message = "添加成功";
		$result -> data = $chat;

	}


 echo json_encode($result);

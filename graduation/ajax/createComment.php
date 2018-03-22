<?php 

	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Method:POST,GET');
	header("content-type:application/json;charset=utf-8");

	require_once("graduation/service/listService.php");
	require_once("graduation/model/commentInfo.php");
	require_once("graduation/model/responseInfo.php");
	require_once("graduation/util/globalSetting.php");

	session_start();


	$result = new ResponseInfo(101 , "添加失败" , null);

	// $UserId = $_POST["UserId"];
	// $NickName = $_POST["NickName"];
	// $Content = $_POST["Content"];
	// $GraphyId = $_POST["GraphyId"];
	// $Header = $_POST["Header"];

	$UserId="";
	if(array_key_exists("UserId" , $_POST)){
		$UserId = $_POST["UserId"];
	}else{
		$phone="be79d385-1f65-11e8-8f27-14dda97c4e4d";
	}

	$NickName="";
	if(array_key_exists("NickName" , $_POST)){
		$NickName = $_POST["NickName"];
	}else{
		$NickName="锡梅";
	}

	$Content="";
	if(array_key_exists("Content" , $_POST)){
		$Content = $_POST["Content"];
	}else{
		$Content="789789789";
	}

	$GraphyId="";
	if(array_key_exists("GraphyId" , $_POST)){
		$GraphyId = $_POST["GraphyId"];
	}else{
		$GraphyId="7cb905a6-2051-11e8-b106-14dda97c4e4d";
	}

	$Header="";
	if(array_key_exists("Header" , $_POST)){
		$Header = $_POST["Header"];
	}else{
		$Header="http://192.168.12.109:9091/graduation/images/6767b210-2049-11e8-b106-14dda97c4e4d.jpg";
	}

	// echo $Content . "--" . $NickName . "--" . $Header;

	$comment = new CommentInfo();

	$comment->Id = md5(uniqid(microtime(),mt_rand()));
	$comment->Content = $Content;

	$comment->UserId=$UserId;
	$comment->NickName = $NickName;
	$comment->GraphyId = $GraphyId;
	$comment->CommentTime = time();

	$comment->Header = $Header;
	
	// 向数据库保存
	$flag = ListService::insertComment($comment);
	// echo $flag;

	if($flag){

		$result -> code = 100;
		$result -> message = "添加成功";
		$result -> data = $comment;

	}


 echo json_encode($result);
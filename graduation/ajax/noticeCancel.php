<?php 

	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Method:POST,GET');
	header("content-type:application/json;charset=utf-8");


	require_once("graduation/service/UserService.php");
	require_once("graduation/model/responseInfo.php");
	require_once("graduation/model/noticeInfo.php");
	require_once("graduation/util/globalSetting.php");
	// print_r($_POST);

	$ConcernId="";
	if(array_key_exists("ConcernId", $_POST)){
		$ConcernId=$_POST["ConcernId"];
	}
	else{
		$ConcernId="be79d385-1f65-11e8-8f27-14dda97c4e4d";
	}

	$NoticerId="";
	if(array_key_exists("NoticerId", $_POST)){
		$NoticerId=$_POST["NoticerId"];
	}
	else{
		$NoticerId="be699fb4-1f65-11e8-8f27-14dda97c4e4d";
	}

	// 向数据库保存

	$result = [
		"code" => 101,
		"message" => "取消关注失败",
		"data" => null
	];

	$notice=new NoticeInfo();
	$notice->Id = md5(uniqid(microtime(),mt_rand()));
	$notice->ConcernId=$ConcernId;
	$notice->NoticerId=$NoticerId;

	$response = UserService::deleteNotice($notice);

	if($response == 1){
		$result = [
			"code" => 100,
			"message" => "取消成功",
			"data" => $response
		];
	}

echo json_encode($result);
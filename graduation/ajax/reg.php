<?php 
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Method:POST,GET');
	header("content-type:application/json;charset=utf-8");

	require_once("graduation/model/userInfo.php");
	require_once("graduation/util/verifyCode.class.php");
	require_once("graduation/service/userService.php");
	require_once("graduation/util/globalSetting.php");
	require_once("graduation/model/responseInfo.php");

	$result = new ResponseInfo(101 , "请求失败" , null);


	// print_r($_POST);
	$Phone="";
	if(array_key_exists("phone" , $_POST)){
		$Phone = $_POST["phone"];
	}else{
		$Phone="18795801740";
	}
	$Password="";
	if(array_key_exists("password" , $_POST)){
		$Password = $_POST["password"];
	}else{
		$Password="1740";
	}
	$NickName="";
	if(array_key_exists("nick" , $_POST)){
		$NickName = $_POST["nick"];
	}else{
		$NickName="嗨";
	}

	// $Code=$_POST["Code"];
	// echo $Password;
	// echo "1";

	// $userReg=VerifyCodeService::validate($Phone , $Code);


	// if($userReg==1){
		
		$user = new UserInfo();

		$user->Id = md5(uniqid(microtime(),mt_rand()));
		$user->Phone = $Phone;
		$user->Password = $Password;
		$user->Header = 'dbbab4d9-2470-11e8-a20d-3417eb5d225f.jpg';
		$user->NickName = $NickName;

		$data = userService::insertUser($user);
		// echo $data;
		
		if($data){
			$result -> code = 100;
			$result -> message = "请求成功";
			$result -> data = $data;
		}

	// }

 echo json_encode($result);
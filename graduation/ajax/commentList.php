<?php 
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Method:POST,GET');
header("content-type:application/json;charset=utf-8");

require_once("graduation/service/listService.php");
require_once("graduation/model/responseInfo.php");

// print_r($_POST);
$Id="";

if(array_key_exists("Id" , $_POST)){
	$Id = $_POST["Id"];
}else{
	$Id="7cb905a6-2051-11e8-b106-14dda97c4e4d";
}
$key="";

// echo $Id;
$chats = ListService::getGraphyById($key,$Id)[1];
// print_r($chats);
$result = new ResponseInfo(101 , "请求失败" , null);

if($chats){
	$result -> code = 100;
	$result -> message = "请求成功";
	$result -> data = $chats;
}

echo json_encode($result);
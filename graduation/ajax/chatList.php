<?php 
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Method:POST,GET');
header("content-type:application/json;charset=utf-8");

require_once("graduation/service/chatService.php");
require_once("graduation/model/responseInfo.php");

$Id="";

if(array_key_exists("Id" , $_GET)){
	$Id = $_GET["Id"];
}else{
	$Id="08524d12-234d-11e8-b2bf-14dda97c4e4d";
}
// echo $Id;
$comments = chatService::getChatById($Id);
// print_r($comments);
$result = new ResponseInfo(101 , "请求失败" , null);

if($comments){
	$result -> code = 100;
	$result -> message = "请求成功";
	$result -> data = $comments;
}

echo json_encode($result);
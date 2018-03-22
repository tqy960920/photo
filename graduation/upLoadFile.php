<?php 

	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Method:POST,GET');
	header("content-type:application/json");

	$cover=$_FILES["cover"];
	// print_r($cover);

	$ext=pathinfo($cover["name"],PATHINFO_EXTENSION);
	$fileName=md5(uniqid(microtime(true) . mt_rand())) . "." . $ext;

	// echo $fileName;
	$flag=move_uploaded_file($cover["tmp_name"] , "images/".$fileName);
	// echo $flag;

	$result = [
		"code"=>101,
		"message"=>"上传失败",
		"data"=>null
	];

	if($flag){
		$result = [
			"code"=>100,
			"message"=>"上传成功",
			"data"=>[
				"name"=>$fileName,
				"path"=>"images/".$fileName
			]
		];
	}
	// print_r($result);

	echo json_encode($result);

 ?>
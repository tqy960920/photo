<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>发表新交流帖</title>
	<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="lib/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/include.css">
	<link rel="stylesheet" type="text/css" href="css/addPost.css">
</head>
<body>
	<?php 

		include_once("include/header.php");

	?>

	<?php 


		$userId="";
		if(array_key_exists("Current",$_SESSION))
			$userId=$_SESSION["Current"][1];

	 ?>
	<div class="addPost">
		<div class="addPost-title">
			<a href="chat.php">交流论坛&nbsp;&nbsp;>&nbsp;&nbsp;</a>
			<div>发表新帖</div>	
			<button onclick="history.back();">返回</button>	
		</div>
		<div id="dialog"></div>
		<div class="add-post">				
			<form method="post">
				<div class="row">
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<div class="add-title">
							<span class="t1"></span>
							<h3>帖子标题</h3>
						</div>
						<div class="add-msg">
							<span class="t4"></span>
							<input type="text" name="post-title" id="chat-title" placeholder="请填写帖子标题">
						</div>
						<div class="add-title">
							<span class="t1"></span>
							<h3>帖子内容</h3>
						</div>
						<div class="add-jiyu">
							<span class="t4"></span>
							<textarea name="post-jiyu" id="chat-jiyu" placeholder="请填写帖子内容"></textarea>
						</div>
						<div hidden="" id="addUserId"><?php echo $userId; ?></div>
					</div>
				</div>
			
				<button type="button" class="submit">发表</button>
			</form>
		</div>
		
		<!-- 回到顶部 -->
		<div class="fixed-div">
			<div class="fixed-back" style="display: none">
				<i class="fa fa-chevron-up"></i>
			</div>
		</div>
	
	</div>
	<?php 

		include_once("include/footer.php");

	?>

	<script type="text/javascript" src="js/include.js"></script>
	<script type="text/javascript" src="js/addChat.js">


	</script>

</body>
</html>
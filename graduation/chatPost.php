<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>交流贴</title>
	<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="lib/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/include.css">
	<link rel="stylesheet" type="text/css" href="css/chatPost.css">
	<link rel="stylesheet" type="text/css" href="css/fixed.css">
	
</head>
<body>
		
	<?php 
		include_once("include/header.php");
		require_once("graduation/service/chatService.php");
	?>

	<?php 

		$Id="";
		if(array_key_exists("Id", $_GET))
			$Id=$_GET["Id"];
		$data=ChatService::getChatById($Id);
		// print_r($data);
		$chat_msg=$data[0];
		$chat_comment=$data[1];
		$index=1;

		$name="";
		// print_r($_SESSION["Current"]);
		if(array_key_exists("Current",$_SESSION))
			$name=$_SESSION["Current"][0];

	 ?>
	
	<div class="chatPost">
		<div class="row">
			<div class="chatPost-title">
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<a href="chat.php">论坛&nbsp;&nbsp;>&nbsp;&nbsp;</a>
					<div>交流贴</div>	
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">	  
					<div class="col-xs-12 col-md-4"></div>
					<div class="col-xs-12 col-md-4"></div>
					<div class="col-xs-12 col-md-4">
						<button onclick="history.back();">返回</button>
					</div>
				</div>
			</div>
		</div>
		<div hidden="" id="CharterId"><?php echo $chat_msg->CharterId; ?></div>
		<h3 class="chatP-t"><?php echo $chat_msg->Title; ?></h3>
		<div class="row chatP-item">
			<div class="col-xs-12 col-sm-2 col-md-2">
				<div class="chatP-left">
					<img src="<?php echo $chat_msg->Header; ?>">
				</div>
			</div>
			<div class="col-xs-12 col-sm-8 col-md-8">
				<div class="chatP-mid">
					<div class="chatP-mid-top">
						<p><?php echo $chat_msg->NickName; ?></p>
						<p>发表了新帖</p>
						<p><?php echo $chat_msg->CreateTime; ?></p>
					</div>
					<div class="chatP-mid-con"><?php echo $chat_msg->Content; ?></div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-2 col-md-2">
				<div class="chatP-right">
					<div>
						<p id="index"><?php echo $index++; ?></p>
						<p>楼#</p>
					</div>
				</div>
			</div>
		</div>
		<div id="chat-id" hidden=""><?php echo $Id; ?></div>

		<div class="chatP-bom" id="chatP-bom">

		</div>

		<div class="body-comment">	
			<div class="col-md-2">
				<div class="comment-left">				
					<?php if(array_key_exists("Current",$_SESSION)) {?>
						<img src="<?php echo $_SESSION["Current"][2]; ?>" id="Header">
						<div id="NickName"><?php echo $_SESSION["Current"][0]; ?></div>
						<div id="FollowId" style="display: none;"><?php echo $_SESSION["Current"][1]; ?></div>
					<?php }else{ ?>
						<img src="image/2.jpg">
						<div><a href="login.php">尚未登录</a></div>
					<?php } ?>
				</div>
			</div>
			<div class="col-md-10">
				
				<textarea class="answer" id="chat-content" placeholder="发表一下你的看法吧~"></textarea>
				<button type="button" class="fabiao" id="btnAnswer">回复</button>
				
			</div>
		</div>
		<div id="dialog"></div>
		
		<!-- 回到顶部 -->
		<div class="fixed-div">
			<div class="fixed-add">
				<?php if($name==""){ ?>
					<a href="login.php" class="add">			
				<?php }else{ ?>
					<a href="addPost.php" class="add">			
				<?php } ?>
						<i class="fa fa-pencil"></i>
						<div>发帖</div>
					</a>
			</div>
			<div class="fixed-back" style="display: none">
				<i class="fa fa-chevron-up"></i>
			</div>
		</div>

	</div>

	<?php 
		include_once("include/footer.php");
	?>
	
	<script type="text/javascript" src="js/include.js"></script>
	<script type="text/javascript" src="js/chatPost.js"></script>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>论坛</title>
	<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="lib/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/include.css">
	<link rel="stylesheet" type="text/css" href="css/chat.css">
	<link rel="stylesheet" type="text/css" href="css/fixed.css">
</head>
<body>
	<?php 

		include_once("include/header.php");
		require_once("graduation/service/labelService.php");
		require_once("graduation/service/listService.php");
		require_once("graduation/service/chatService.php");

	?>
	<?php 

		$name="";
		// print_r($_SESSION["Current"]);
		if(array_key_exists("Current",$_SESSION))
			$name=$_SESSION["Current"][0];
		$userId="";
		if(array_key_exists("Current",$_SESSION))
			$userId=$_SESSION["Current"][1];

		$label=LabelService::getLabel();
		$HotGraphy=ListService::getHotGraphy();

		$chat=ChatService::getAllChat();
		//print_r($chat);

	 ?>
	<div class="chat">
		<!-- 大图 -->
		<div class="join">
			<div class="bg"></div>
			<a href="register.php" class="add">加入我们</a>
		</div>

		<!-- 帖子 -->
		<div class="all-chat">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
					<div class="post-left">
						<div class="chat-top">
							<div class="top-left">
								<div>
									<a href="addChat.php">
										<i class="fa fa-pencil"></i>发表新帖
									</a>
								</div>
								<div>默认</div>
								<div>最新</div>
							</div>
							 <div class="top-right">
								<!-- <p>共10张帖子</p> -->
							</div> 
						</div>
						<div class="chat-body">
							<table class="table table-hover table-post">
								<thead>
									<th>主题</th>
									<th>作者</th>
									<th>时间</th>
									<th>操作</th>
								</thead>
								<tbody>
									<?php foreach ($chat as $single) : ?>
									<tr>
										<td><?php echo $single->Title; ?></td>
										<td><?php echo $single->NickName; ?></td>
										<td><?php echo $single->CreateTime; ?></td>
										<td><a href="chatPost.php?Id=<?php echo $single->Id; ?>">查看</a></td>
									</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
						<!-- <div class="chat-page">
							<a href="" class="paged">1</a>
							<a href="" class="paged">2</a>
							<a href="" class="paged">3</a>
							<a href="" class="paged">4</a>
						</div> -->
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
					<div class="post-right">
						<div >
							<h4 class="hot-one">热门标签</h4>
							<div class="hot-a">
								<?php for($i=0;$i<6;$i++): ?>
									<a href="list.php?Id=<?php echo $label[$i]->Id; ?>"><?php echo $label[$i]->Name; ?></a>
								<?php endfor ?>
							</div>
						</div>						
						<div>
							<h4 class="hot-one">美图推荐</h4>
							<div class="hot-a">
								<?php for($i=0;$i<3;$i++) : ?>
								<div class="hot-img">
									<a href="post.php?Id=<?php echo $HotGraphy[$i]->Id; ?>">
										<img src="<?php echo $HotGraphy[$i]->Images[0]; ?>">
									</a>
									<div>[<?php echo $HotGraphy[$i]->Title; ?>]---<?php echo $HotGraphy[$i]->NickName; ?></div>
								</div>
								<?php endfor ?>
							</div>
						</div>
					</div>
				</div>
			</div>
					
		</div>

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

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>查看帖子</title>
	<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="lib/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/include.css">
	<link rel="stylesheet" type="text/css" href="css/post.css">
	<link rel="stylesheet" type="text/css" href="css/fixed.css">
</head>
<body>
	<?php 

		include_once("include/header.php");
		require_once("graduation/service/listService.php");
		require_once("graduation/service/userService.php");

	?>
	<?php 
 		
 		// 数据显示
 		$Id="";

		if(array_key_exists("Id" , $_GET)){
			$Id = $_GET["Id"];
		}

		$key="";

		if(array_key_exists("key" , $_GET)){
			$key = $_GET["key"];
		}

		$data=ListService::getGraphyById($key,$Id);
		// print_r($data);
		$graphy=$data[0];
		
	
		// 提交评论

		// 当前用户
		$userId="";
		if(array_key_exists("Current",$_SESSION))
			$userId=$_SESSION["Current"][1];


		// 帖子用户
		$graphyId=$graphy->UserId;
		
		$index=0;// 未关注
		$graphyFensi=UserService::getFensi($graphyId);
		// print_r($graphyFensi);

		// echo count($graphyFensi);
		for($i=0;$i<count($graphyFensi);$i++){
			if($userId==$graphyFensi[$i]->Id)
				$index=1;//已关注
		}
		// echo $index;

 	?>

	<div class="my-post">
		<div class="row">
			<div class="my-top">
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<a href="list.php">作品展示&nbsp;&nbsp;>&nbsp;&nbsp;</a>
					<div>正文</div>
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
		<div class="my-body">
			<div id="this-id" hidden=""><?php echo $Id; ?></div>
			<div class="body-top">
				<h3><?php echo $graphy->Title; ?></h3>
				<div>
					<p><i class="fa fa-heart-o"></i>&nbsp;<?php echo $graphy->Like; ?></p>&nbsp;&nbsp;
					<p><i class="fa fa-commenting-o"></i>&nbsp;3</p>
				</div>
				<div>
					<a href="list.php"><?php echo $graphy->LabelName; ?></a>
				</div>
				<div hidden="" id="graphyUserId"><?php echo $graphy->UserId; ?></div>
			</div>
			<div class="back"></div>
			<div class="body-body">

				<!-- 摄影帖 -->
				<div class="body-author">
					<div class="row">
						<div class="col-md-2">
							<div class="body-authorLeft">
								<a href="personal.php?Id=<?php echo $graphy->UserId; ?>">
									<img src="<?php echo $graphy->Header; ?>">
								</a>
								<p>
									<i class="fa fa-user"></i><?php echo $graphy->NickName; ?>
								</p>
								<div>

									<?php if($userId==""){ ?>
										<div hidden=""></div>
									<?php }else if($index==1){ ?>
										<div class="aready1" id="aready1">已关注</div>
										<div class="aready2" id="aready2" style="display: none;"><i class="fa fa-plus"></i>关注</div>
									<?php }else{ ?>
										<div class="aready1" id="aready1" style="display: none;">已关注</div>
										<div class="aready2" id="aready2"><i class="fa fa-plus"></i>关注</div>
									<?php } ?>
									
								</div>
							</div>
						</div>
						<div class="col-md-10">
							<div class="body-authorRight">
								<div class="authorRight-time">
									<div class="floor">
										<p>1</p>
										<p>楼</p>
									</div>
									<div><?php echo $graphy->CreateTime; ?></div>
								</div>	
								<div class="authorRight-title">
									<p>主题：</p><p><?php echo $graphy->Title; ?></p>
								</div>
								<div class="authorRight-read">
									<p>寄语：</p><p><?php echo $graphy->Introduce; ?></p>
								</div>	
								<div class="authorRight-img">
									<div class="row">
										<?php for($i=0;$i<count($graphy->Images);$i++): ?>
											<div class="col-md-6">
												<div class="img-love">
													<img src="<?php echo $graphy->Images[$i]; ?>">
													<div id="likeCount">
														<i class="fa fa-heart" ></i>
													</div>
													
												</div>
												
											</div>	
										<?php endfor ?>
									</div>	
									<div class="graphy-like">
										<p id="countNum"><?php echo $graphy->Like; ?></p>
										<p>人点赞</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- 评论+留言 -->
				<div class="graphy-comment">						
					<div class="this-comment">
						<h3 class="comment">评论区</h3>

						<!-- 评论 -->
						<div class="body-comment" id="body-comment">	
							<div id="body-no">暂无评论，快去评论点什么吧！</div>
						</div>


						<h3 class="comment">我要留言</h3>

						<div class="body-comment">	
							<!-- <form method="post"> -->
								<div class="col-md-2">
									<div class="comment-left">				
										<?php if(array_key_exists("Current",$_SESSION)) {?>
											<img src="<?php echo $_SESSION["Current"][2]; ?>"id="Header">
											<div id="NickName"><?php echo $_SESSION["Current"][0]; ?></div>
											<div id="UserId" style="display: none;"><?php echo $_SESSION["Current"][1]; ?></div>
										<?php }else{ ?>
											<img src="image/2.jpg">
											<div><a href="login.php">尚未登录</a></div>
										<?php } ?>
									</div>
								</div>
								<div class="col-md-10">
									
									<textarea class="answer" id="text-content" placeholder="发表一下你的看法吧~"></textarea>
									<button type="button" class="fabiao" id="btnSave">发表</button>
									
								</div>
							<!-- </form> -->
						</div>
					</div>
					<div id="dialog"></div>

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
	<script type="text/javascript" src="js/post.js"></script>

</body>
</html>
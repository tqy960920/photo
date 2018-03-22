<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>摄影师</title>
	<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="lib/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/include.css">
	<link rel="stylesheet" type="text/css" href="css/personal.css">
	<link rel="stylesheet" type="text/css" href="css/fixed.css">
</head>
<body>
	<?php 

		include_once("include/header.php");
		require_once("graduation/service/userService.php");
		require_once("graduation/service/listService.php");

	?>
	<?php 

		$Id="";
		if(array_key_exists("Id", $_GET)){
			$Id = $_GET["Id"];
			// echo $Id;
			// 查询用户信息
			$PersonalMsg=UserService::getUsersByID($Id);
			// print_r($PersonalMsg);
			// 用户对应的关注量和粉丝量
			// $guanzhu=UserService::getGuanzhuCount($Id);

			// $fensi=UserService::getFensiCount($Id);
			// print_r($fensi);
			// 单个帖子信息
			$graphy=ListService::getGraphyByUser($Id);
			// print_r($graphy);

			$guanzhuPeople=UserService::getGuanzhu($Id);
			// print_r($guanzhuPeople);
			$fensiPeople=UserService::getFensi($Id);
			
			// print_r($fensiPeople);
			// echo count($fensiPeople);
		}

		$userId="";
		if(array_key_exists("Current",$_SESSION))
			$userId=$_SESSION["Current"][1];
		
		$name="";
		// print_r($_SESSION["Current"]);
		if(array_key_exists("Current",$_SESSION))
			$name=$_SESSION["Current"][0];
	 ?>

	<div class="personal">	
		<div class="row">
			<div class="personal-title">
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<a href="hotPeople.php">红人排行榜&nbsp;&nbsp;>&nbsp;&nbsp;</a>
					<div>个人介绍</div>	
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


		<div class="personal-msg">
			<div class="personal-img">
				<img src="<?php echo $PersonalMsg->Header; ?>">
			</div>
			<div class="personal-name">
				<div><?php echo $PersonalMsg->NickName; ?></div>
				<!-- <div><div>+&nbsp;&nbsp;关注</div></div>			 -->
			</div>		
		</div>
		<div class="personal-detail">
			<div class="row">
				<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
					<div class="personal-left1">	
						<div id="guanzhu">
							<p><?php echo count($guanzhuPeople); ?></p>
							<p>关注</p>
						</div>
						<div id="fensi">
							<p><?php echo count($fensiPeople); ?></p>
							<p>粉丝</p>
						</div>
					</div>
					<div class="personal-left2">
						<ul>
							<li id="dongtai" class="personal-active">
								
								<?php if($userId!=$Id){ ?>
									他的动态
								<?php }else{ ?>
									我的动态
								<?php } ?>
							</li>
							<li id="ziliao">
								
								<?php if($userId!=$Id){ ?>
									他的资料
								<?php }else{ ?>
									我的资料
								<?php } ?>
							</li>
							<li id="daishenhe">
								<?php if($userId!=$Id){ ?>
									
								<?php }else{ ?>
									待审核
								<?php } ?>

							</li>
							<li id="weishenhe" >				
								<?php if($userId!=$Id){ ?>
									
								<?php }else{ ?>
									未通过审核
								<?php } ?>
							</li>
						</ul>
					</div>
					
				</div>
				<!-- 动态 -->
				<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10" id="body-1">
					<div class="pright-top">全部动态</div>
					<?php foreach ($graphy as $singleGraphy) :?>
					<div class="row">
						<div class="pright-body">
							<div class="col-sx-12 col-md-1">
								<div class="pright-item-img">
									<img src="<?php echo $singleGraphy->Header; ?>">
								</div>
							</div>
							<div class="col-sx-12 col-md-8">
								<div class="row-left">
									<div>
										<p><?php echo $singleGraphy->NickName; ?>:</p>
										<p>发表了一个帖子</p>
										<p><?php echo $singleGraphy->Title; ?></p>
									</div>
									<div><?php echo $singleGraphy->Title; ?></div>
									<div class="row">
										<?php for($i=0;$i<count($singleGraphy->Images);$i++): ?>
											<div class="col-md-6">
												<div class="pright-postImg">
													<img src="<?php echo $singleGraphy->Images[$i]; ?>">
												</div>					
											</div>	
										<?php endfor ?>								
									</div>
									
								</div>
							</div>
							<div class="col-sx-12 col-md-2">2018-3-1</div>
							<div class="change-to">
								<a href="post.php?Id=<?php echo $singleGraphy->Id; ?>">回复</a>
							</div>
							
						</div>				
					</div>
					<?php endforeach ?>
				</div>
				<!-- 资料 -->
				<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10" id="body-2" style="display: none">
					<div class="pright-top">个人资料</div>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
							<div class="pright-center">
								<img src="<?php echo $PersonalMsg->Header; ?>">
								<div>昵称：<?php echo $PersonalMsg->NickName; ?></div>
								<div>手机号码：<?php echo $PersonalMsg->Phone; ?></div>
							</div>
						</div>
					</div>
				</div>
				<!-- 关注 -->
				<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10" id="body-3" style="display: none">
					<div class="pright-top">关注</div>
					<div class="row">
						<?php foreach ($guanzhuPeople as $singleGuan) :?>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<div class="pright-person">
									<img src="<?php echo $singleGuan->Header; ?>">
									<div><?php echo $singleGuan->NickName; ?></div>
								</div>
							</div>
						<?php endforeach ?>
					</div>
				</div>
				<!-- 粉丝 -->
				<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10" id="body-4" style="display: none">
					<div class="pright-top">粉丝</div>
					<div class="row">
						<?php foreach ($fensiPeople as $singleFen) :?>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<div class="pright-person">
									<img src="<?php echo $singleFen->Header; ?>">
									<div><?php echo $singleFen->NickName; ?></div>
								</div>
							</div>
						<?php endforeach ?>
					</div>
				</div>
					<!-- 待审核 -->
				<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10" id="body-5" style="display: none">
					<div class="pright-top">需审核帖子</div>
					
						
							<?php 
								$waitGraphy=ListService::getDaiGraphy($Id);
								// print_r($waitGraphy);
								if(is_null($waitGraphy)){
							?>
							 	暂无待审核贴子
							<?php }else{ ?>
							
								<div class="wait-graphy">
									
									<?php foreach ($waitGraphy as $wait) :?>
										<div class="wait-item">
											<div><?php echo $wait->Title; ?></div>
											<img src="<?php echo $wait->Images[0]; ?>">
										</div>
									<?php endforeach ?>
								</div>
							
							
							<?php } ?>
					
				</div>	
				<!-- 审核未通过 -->
				<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10" id="body-6" style="display: none;">
					<div class="pright-top">未通过审核帖子</div>
						
							<?php 
								$noPassGraphy=ListService::getNoPassGraphy($Id);
								// print_r($noPassGraphy);
								// var_dump($noPassGraphy);
								if(is_null($noPassGraphy)){
							?>
							 	暂无未通过审核贴子
							<?php }else{ ?>
								<div class="no-graphy">
									<?php foreach ($noPassGraphy as $noPass) {?>
										<div class="no-item">
											<div><?php echo $noPass->Title; ?></div>
											<img src="<?php echo $noPass->Images[0]; ?>">
										</div>
									<?php } ?>
								</div>
							<?php } ?>
					
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
	<script type="text/javascript" src="js/personal.js"></script>

</body>
</html>
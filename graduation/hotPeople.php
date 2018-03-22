<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>红人推荐</title>
	<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="lib/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/include.css">
	<link rel="stylesheet" type="text/css" href="css/people.css">
	<link rel="stylesheet" type="text/css" href="css/fixed.css">
</head>
<body>
	<?php 

		include_once("include/header.php");
		require_once("graduation/model/HotPeopleImg.php");
		require_once("graduation/service/userService.php");
		require_once("graduation/service/listService.php");
	?>

	<?php 
		// 按人气排
		$HotPeople=UserService::getHotUsers();
		// print_r($HotPeople);
		// 按帖子排
		$UserCountGraphy=UserService::getCountGraphy();
		// print_r($UserCountGraphy);
		
		$peopleImage=[];
		foreach ($HotPeople as $HotP1) {
			$peopleImage=ListService::getGraphyByUser($HotP1->ConcernId);
		}
		
		$peopleImage_1=$peopleImage[0]->Images[0];
		$peopleImage_2=$peopleImage[1]->Images[0];
		$peopleImage_3=$peopleImage[2]->Images[0];

		$name="";
		// print_r($_SESSION["Current"]);
		if(array_key_exists("Current",$_SESSION))
			$name=$_SESSION["Current"][0];

	 ?>
	<div class="people">
		<div class="p">	
			<!-- 关注度排名		 -->
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
					<div class="p-item">
						<div class="pLeft-top">
						<p>最高人气排行</p>
						</div>
						<div class="pLeft-topHot">
							<div class="row pLeft-img">
								<!-- 第二名 -->
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<div class="pLeft-header">
										<div class="bg1 bg11"></div>
										<a href="personal.php?Id=<?php echo $HotPeople[1]->ConcernId; ?>">
											<img src="<?php echo $HotPeople[1]->Header; ?>">
										</a>
										<div class="bg2 bg21">
											<p><?php echo $HotPeople[1]->NickName; ?></p>
										</div>
									</div>						
								</div>
								<!-- 第一名 -->
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<div class="pLeft-header">
										<div class="bg1 bg12"></div>
										<a href="personal.php?Id=<?php echo $HotPeople[0]->ConcernId; ?>">
											<img src="<?php echo $HotPeople[0]->Header; ?>">
										</a>
										<div class="bg2 bg22">
											<p><?php echo $HotPeople[0]->NickName; ?></p>
										</div>
									</div>
								</div>
								
								<!-- 第三名 -->
								<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<div class="pLeft-header">
										<div class="bg1 bg13"></div>
										<a href="personal.php?Id=<?php echo $HotPeople[2]->ConcernId; ?>">
											<img src="<?php echo $HotPeople[2]->Header; ?>">
										</a>
										<div class="bg2 bg23">
											<p><?php echo $HotPeople[2]->NickName; ?></p>
										</div>
									</div>
								</div>
							</div>
							<div class="pLeft-topOther">
								<table class="table table-striped top-table">
									<thead>
										<th colspan="2">用户</th>
										<th></th>
										<th>人气</th>
									</thead>
									<tbody id="hot-tbody">
										<?php for($i=3;$i<count($HotPeople);$i++): ?>
											<tr>
												<td><?php echo $i+1; ?></td>
												<td>
													<a href="personal.php?Id=<?php echo $HotPeople[$i]->ConcernId; ?>">
														<img src="<?php echo $HotPeople[$i]->Header; ?>">
													</a>
												</td>
												<td><?php echo $HotPeople[$i]->NickName; ?></td>
												<td><?php echo $HotPeople[$i]->Count1; ?></td>
											</tr>
										<?php endfor ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>			
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
					<div class="p-item">
						<div class="pRight-top">
							<p>前三优秀作品展示</p>
						</div>
						<div class="pRight-img">
							<div class="change">
								<img src="<?php echo $peopleImage_1; ?>"> 
								<img src="<?php echo $peopleImage_2; ?>"> 
								<img src="<?php echo $peopleImage_3; ?>"> 

								<div class="nav-left"></div>
								<div class="nav-right"></div>

								<div class="navNum">
									<i class="navactived">No.1</i>
									<i>No.2</i>
									<i>No.3</i>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!-- 发表帖子数量排名 -->
			<!-- <div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
					<div class="p-item">
						<div class="pLeft-top">
						<p>活跃度排行</p>
						</div>
						<div class="pLeft-topHot">
							<div class="row pLeft-img">
								
								
								<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
									<div class="pLeft-header">
										<div class="bg1 bg11"></div>
										<a href="personal.php">
											<img src="<?php echo $UserCountGraphy[1]->Header; ?>">
										</a>
										<div class="bg2 bg21">
											<p><?php echo $UserCountGraphy[1]->NickName; ?></p>
										</div>
									</div>						
								</div>
								
								<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
									<div class="pLeft-header">
										<div class="bg1 bg12"></div>
										<a href="personal.php">
											<img src="<?php echo $UserCountGraphy[0]->Header; ?>">
										</a>
										<div class="bg2 bg22">
											<p><?php echo $UserCountGraphy[0]->NickName; ?></p>
										</div>
									</div>
								</div>
								
								<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
									<div class="pLeft-header">
										<div class="bg1 bg13"></div>
										<a href="personal.php">
											<img src="<?php echo $UserCountGraphy[2]->Header; ?>">
										</a>
										<div class="bg2 bg23">
											<p><?php echo $UserCountGraphy[2]->NickName; ?></p>
										</div>
									</div>
								</div>
							</div>
							<div class="pLeft-topOther">
								<table class="table table-striped top-table">
									<thead>
										<th colspan="2">用户</th>
										<th></th>
										<th>帖子数</th>
									</thead>
									<tbody id="hot-tbody">
										<?php for($i=3;$i<count($UserCountGraphy);$i++): ?>
											<tr>
												<td><?php echo $i+1; ?></td>
												<td><img src="<?php echo $UserCountGraphy[$i]->Header; ?>"></td>
												<td><?php echo $UserCountGraphy[$i]->NickName; ?></td>
												<td><?php echo $UserCountGraphy[$i]->Count2; ?></td>
											</tr>
										<?php endfor ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>			
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
					<div class="p-item">
						
						
					</div>
				</div>
			</div> -->

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
	<script type="text/javascript" src="js/people.js"></script>
	
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>作品展示</title>
	<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="lib/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/include.css">
	<link rel="stylesheet" type="text/css" href="css/list.css">
	<link rel="stylesheet" type="text/css" href="css/fixed.css">
</head>
<body>
	<?php 

		include_once("include/header.php");
		require_once("graduation/service/labelService.php");
		require_once("graduation/service/listService.php");
	?>
	<?php 

		$labels=LabelService::getLabel();

		$Id="";
		

		if(array_key_exists("Id" , $_GET)){
			$Id = $_GET["Id"];
			$NewGraphy=ListService::getTimeGraphy($Id);
			// print_r($NewGraphy);
			$HotGraphy=ListService::getHotGraphy($Id);
			
		}
		else{
			$NewGraphy=ListService::getTimeGraphy();
			$HotGraphy=ListService::getHotGraphy();
			// print_r($listGraphy);
		}
		// echo $Id;

		$name="";
		// print_r($_SESSION["Current"]);
		if(array_key_exists("Current",$_SESSION))
			$name=$_SESSION["Current"][0];
		
		
	 ?>

	<div class="list">
		<div class="row">
			<div class="list-top1">
				<div class="row">							
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<i class="fa fa-tags"></i>
						<div><?php echo $NewGraphy[0]->LabelName; ?></div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<ul>
							<li class="li-active" id="newLi">最新</li>
							<li id="hotLi">最热</li>
						</ul>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">	  
						<div class="col-xs-12 col-md-4"></div>
						<div class="col-xs-12 col-md-4"></div>
						<div class="col-xs-12 col-md-4">
							<button onclick="history.back();">返回</button>
						</div>
					</div>
				</div>
			</div>
			<div class="list-top2">
				<?php foreach ($labels as $label) : ?>
					<a href="list.php?Id=<?php echo $label->Id; ?>"
						<?php echo $label->Id==$Id ? 'class="label-active"' : ""; ?>
					><?php echo $label->Name; ?></a>	
				<?php endforeach ?>		
			</div>
		</div>
		<div class="list-body" id="newList">	
			<div class="row">
				<?php foreach ($NewGraphy as $graphy):?>
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
						<div class="list-item" id="listNew">
							<div class="item-top">
								<div class="item-topLeft">
									<p><?php echo $graphy->Title ?></p>
								</div>
								<div class="item-topRight">
									<p><?php echo count($graphy->Images); ?></p>
									<img src="image/pic.png"> 
								</div>		 			
							</div>
							<a href="post.php?Id=<?php echo $graphy->Id; ?>">
								<img src="<?php echo $graphy->Images[0]; ?>">
							</a>		
							<div class="item-bom">
								<div class="item-bomLeft">
									<img src="<?php echo $graphy->Header; ?>">
									<div><?php echo $graphy->NickName; ?></div>
								</div>
								<div class="item-bomRight">
									<p><i class="fa fa-heart-o"></i>&nbsp;<?php echo $graphy->Like; ?></p>						
								</div>
							</div>							
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
		<div class="list-body" id="hotList" style="display: none;">	
			<div class="row">
				<?php foreach ($HotGraphy as $hot):?>
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
						<div class="list-item" id="listNew">
							<div class="item-top">
								<div class="item-topLeft">
									<p><?php echo $hot->Title ?></p>
								</div>
								<div class="item-topRight">
									<p><?php echo count($hot->Images); ?></p>
									<img src="image/pic.png"> 
								</div>		 			
							</div>
							<a href="post.php?Id=<?php echo $hot->Id; ?>">
								<img src="<?php echo $hot->Images[0]; ?>">
							</a>		
							<div class="item-bom">
								<div class="item-bomLeft">
									<img src="<?php echo $hot->Header; ?>">
									<div><?php echo $hot->NickName; ?></div>
								</div>
								<div class="item-bomRight">
									<p><i class="fa fa-heart-o"></i>&nbsp;<?php echo $hot->Like; ?></p>						
								</div>
							</div>							
						</div>
					</div>
				<?php endforeach ?>
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
	<script type="text/javascript" src="js/list.js"></script>

</body>
</html>
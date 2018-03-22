<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>设备介绍</title>
	<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="lib/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/include.css">
	<link rel="stylesheet" type="text/css" href="css/equip.css">
	<link rel="stylesheet" type="text/css" href="css/fixed.css">
</head>
<body>
	<?php 

		include_once("include/header.php");
		require_once("graduation/service/equipService.php");

	?>
	<?php 

		$name="";
		// print_r($_SESSION["Current"]);
		if(array_key_exists("Current",$_SESSION))
			$name=$_SESSION["Current"][0];

		$equips=EquipService::getEquip();
		// print_r($equips);
	?>


	<div class="equip">
		
		<div class="reason">
			<h3 class="reason-title">选择好器材的4大理由</h3>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<div class="reason-item">
						<div class="reason-circle">one</div>
						<div class="reason-msg">
							视角大，拍摄景物范围广				
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<div class="reason-item">
						<div class="reason-circle">two</div>
						<div class="reason-msg">
							加强对焦的敏感度
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<div class="reason-item">
						<div class="reason-circle">three</div>
						<div class="reason-msg">
							成像更加清晰锐利
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<div class="reason-item">
						<div class="reason-circle">four</div>
						<div class="reason-msg">
							严格的控制景深
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="introduce">
			<div class="row">
				<?php foreach ($equips as $equip) :?>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<div class="intro-item">
						<img src="images/<?php echo $equip->Image; ?>">
						<div class="intro-msg">
							<div><?php echo $equip->Name; ?></div>
							<div><?php echo $equip->Introduce?></div>
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

	</div>

	<?php 

		include_once("include/footer.php");

	?>

	<script type="text/javascript" src="js/include.js"></script>

</body>
</html>
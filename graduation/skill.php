<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>技巧</title>
	<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="lib/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/include.css">
	<link rel="stylesheet" type="text/css" href="css/skill.css">
	<link rel="stylesheet" type="text/css" href="css/fixed.css">
</head>
<body>
		
	<?php 

		include_once("include/header.php");
		require_once("graduation/service/skillService.php");

	?>
	<?php 

		$skills=SkillService::getSkill();

		$name="";
		// print_r($_SESSION["Current"]);
		if(array_key_exists("Current",$_SESSION))
			$name=$_SESSION["Current"][0];

	 ?>

	<div class="skill">
			
		<h4>摄影是一门技术，同样也是经验的积累。真正的摄影家所具备的能力是把日常生活中稍纵即逝的平凡事物转化为不朽的视觉图像，因此在摄影的过程中就必须要掌握相应的摄影技巧，这样才能拍摄出令人称道的好照片。</h4>
		
		<div class="skills">
			<div class="row">
				<?php foreach ($skills as $skill) :?>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<div class="skill-item">
							<div class="skill-title">『<?php echo $skill->Title ?>』</div>
							<div class="skill-img">
								<img src="<?php echo $skill->Image; ?>">
							</div>
							<div class="skill-msg">
								<?php echo $skill->Content; ?>
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

</body>
</html>
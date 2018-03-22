<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>发表新摄影帖</title>
	<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="lib/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/include.css">
	<link rel="stylesheet" type="text/css" href="css/addPost.css">
</head>
<body>
	<?php 

		include_once("include/header.php");
		require_once("graduation/service/labelService.php");

	?>

	<?php 

		$labels=LabelService::getLabel();

		$userId="";
		if(array_key_exists("Current",$_SESSION))
			$userId=$_SESSION["Current"][1];

	 ?>
	<div class="addPost">
		<div class="addPost-title">
			<a href="list.php">作品展示&nbsp;&nbsp;>&nbsp;&nbsp;</a>
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
							<h3>作品信息</h3>
						</div>
						<div class="add-msg">
							<span class="t4"></span>
							<input type="text" name="post-title" id="post-title" placeholder="请填写帖子标题">
						</div>
						<div class="add-jiyu">
							<span class="t4"></span>
							<textarea name="post-jiyu" id="post-jiyu" placeholder="请填写帖子寄语"></textarea>
						</div>
						<div hidden="" id="addUserId"><?php echo $userId; ?></div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<div class="add-title">
							<span class="t2"></span>
							<h3>上传图片</h3>
							<h5>(图片格式不限，单张最大尺寸为20M，图片大小为1024px*683px)</h5>
						</div>
						<div class="add-img">
							<div>
								<input type="file" id="fileUpload" hidden="" style="display: none;">
								<div class="file-add">
									<i class="fa fa-plus"></i>
									<p>点击添加图片</p>
								</div>
								<div class="file-in">
									<!-- <div class="file-item">
										<img src="" class="this_img" name="graphyImg">
										<input type="hidden" name="GraphyImage" value="图书名称">
									</div> -->
									
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<div class="add-title">
							<span class="t3"></span>
							<h3>添加标签</h3>
						</div>
						<div class="add-biaoqian">
							<span class="t4"></span>
							<select name="post-label" id="post-label">
								<?php foreach ($labels as $label) : ?>
									<option value="<?php echo $label->Id; ?>" id="labelId"><?php echo $label->Name; ?></option>
								<?php endforeach ?>	
							</select>
						</div>
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
	<script type="text/javascript" src="js/addPost.js">


	</script>

</body>
</html>
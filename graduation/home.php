<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>首页</title>
	<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="lib/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/include.css">
	<link rel="stylesheet" type="text/css" href="css/home.css">
	<link rel="stylesheet" type="text/css" href="css/fixed.css">
</head>
<body>
	<?php 

		include_once("include/header.php");
		require_once("graduation/service/listService.php");
		require_once("graduation/service/userService.php");

	?>

	<?php 

		$name="";
		// print_r($_SESSION["Current"]);
		if(array_key_exists("Current",$_SESSION))
			$name=$_SESSION["Current"][0];	

		$HotGraphy=ListService::getHotGraphy();
		$NewGraphy=ListService::getTimeGraphy();
		$HotPeople=UserService::getHotUsers();

	 ?>


	<div class="home">

		<!-- 轮播图 -->
		<div id="carousel-example-generic" class="carousel slide lunbo" data-ride="carousel">
		  <!-- Indicators -->
		  	<ol class="carousel-indicators">
			    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
			    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
			    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
		  	</ol>

		  <!-- Wrapper for slides -->
		  	<div class="carousel-inner" role="listbox">
		  		
		    	<div class="item active adImg">		
					<img src="image/home01.jpg" />	      	   
		    	</div>
			    <div class="item adImg">
			      	<img src="image/home02.jpg" />	     
			    </div>
		    	<div class="item adImg">
		      		<img src="image/home03.jpg" />	
		    	</div>
		    	<div class="item adImg">
		      		<img src="image/home04.jpg" />	
		    	</div>
		  	</div>

		  <!-- Controls -->
		  	<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
		  	</a>
		</div>

		<!-- 主体 -->
		<div class="body">
			<!-- 图片 -->	
			<div class="images">
				<h3 class="img-title">图片欣赏</h3>
				<div class="row">
					<?php for($i=0;$i<6;$i++): ?>
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<div class="little">				
									<a href="post.php?Id=<?php echo $HotGraphy[$i]->Id; ?>">
										<img src="<?php echo $HotGraphy[$i]->Images[0]; ?>" title="摄影师：<?php echo $HotGraphy[$i]->NickName; ?>">
									</a>
									<div>
										<p><?php echo $HotGraphy[$i++]->Title; ?></p>
									</div>
								</div>
								<div class="little">
									<a href="post.php?Id=<?php echo $HotGraphy[$i]->Id; ?>">
										<img src="<?php echo $HotGraphy[$i]->Images[0]; ?>" title="摄影师：<?php echo $HotGraphy[$i]->NickName; ?>">
									</a>
									<div>
										<p><?php echo $HotGraphy[$i++]->Title; ?></p>
									</div>						
								</div>						
							</div>
							<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
								<div class="big">
									<a href="post.php?Id=<?php echo $HotGraphy[$i]->Id; ?>">
										<img src="<?php echo $HotGraphy[$i]->Images[0]; ?>" title="摄影师：<?php echo $HotGraphy[$i]->NickName; ?>">
									</a>
									<div>
										<p><?php echo $HotGraphy[$i++]->Title; ?></p>
									</div>
								</div>						
							</div>
						</div>
					<?php endfor ?>
				</div>
			</div>

			<!-- 红人 -->
			<div class="people">
				<h3 class="img-title">红人推荐</h3>
				<div class="row people-item">
					<?php for($i=0;$i<count($HotPeople);$i++): ?>
						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">
							<div class="home-item">
								<p>No.<?php echo $i+1; ?></p>
								<a href="personal.php?Id=<?php echo $HotPeople[$i]->ConcernId; ?>"><img src="<?php echo $HotPeople[$i]->Header; ?>" /></a>
								<div class="item-anthor">
									<div>摄影者：<?php echo $HotPeople[$i]->NickName; ?></div>
									<div>联系方式：<?php echo $HotPeople[$i]->Phone; ?></div>
									<div class="people-more">
										<div>
											<i class="fa fa-heart-o"></i>
											<div><?php echo $HotPeople[$i]->Count1; ?>人关注</div>
										</div>
									</div>
								</div>
							</div>
						</div>	
					<?php endfor ?>							
				</div>
			</div>

			<!-- 设备 -->
			<div class="equipment">
				<div>摄影</div>
				<div>PGOTOGRAPH</div>
				<div>
					<a href="equip.php" id="jump">
					<h1>我知你痛</h1>
					</a>
				</div>
				<div>无影棚，无设备，摄影师在哪？</div>
				<div>不懂用光，布景，何来高质感照片？</div>
			</div>

			<!-- 帖子 -->
			<div class="posts">
				<h3 class="img-title">新帖速递</h3>
				<div class="row item-all">
					<?php for($i=0;$i<8;$i++) { ?>

						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
							<div class="item-div">
								<a href="post.php?Id=<?php echo $HotGraphy[$i]->Id; ?>"><img src="<?php echo $HotGraphy[$i]->Images[0]; ?>"></a>
								<div class="img-div">
									<div class="img-left">
										<img src="<?php echo $HotGraphy[$i]->Header; ?>">
										<div><?php echo $HotGraphy[$i]->NickName; ?></div>
									</div>
									<div class="img-right">
										<p><i class="fa fa-heart-o"></i>&nbsp;<?php echo $HotGraphy[$i]->Like; ?></p>&nbsp;&nbsp;
									</div>
								</div>
							</div>			
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
	<script type="text/javascript">   
	    function changeColor(){   
		    var color="#f00|#0f0|#00f|#ff0|#ffc0cb|#0ff|#fafff0|#191970";//定义一条变换颜色的字符串  
		    color=color.split("|"); //然后通过split方法进行分割  
		    var xuan = document.getElementsByTagName("h1");//获得元素
		    // console.log(xuan);
		  
		    for(var i=0;i<xuan.length;i++){  
		    	xuan[i].style.color=color[parseInt(Math.random() * color.length)];//设置样式   		  
		    }   
	    }   
	    setInterval("changeColor()",1000);//死循环，每0.2秒变换一种颜色  
	</script>

</body>
</html>
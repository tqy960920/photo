<?php 
	
	session_start();

	$name="";
	// print_r($_SESSION["Current"]);
	if(array_key_exists("Current",$_SESSION))
		$name=$_SESSION["Current"][0];
	$userId="";
	if(array_key_exists("Current",$_SESSION))
		$userId=$_SESSION["Current"][1];

	$keyWord="";

	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$keyWord=$_POST["keyWord"];
	}

	if(!is_null($keyWord))
		$_SESSION["Key"]=$keyWord;

 ?>

<div class="include">
	<div class="header">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<img src="image/logo.png">
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<div class="header-mid">
					<form>
						<input type="text" name="keyWord" class="key-search" pattern="请输入查询内容">
						<button type="button" class="btn btn-primary" id="keyTitle">查询</button>
					</form>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<div class="header-right" id="log-reg" >
					<a href="login.php" class="logout" id="login">登录</a>
					<a href="register.php" class="register" id="login">免费注册</a>
				</div>
				<div class="header-right" id="my-name" style="display: none;">
					<div>
						<p>欢迎，</p>
						<p id="userName"><?php echo $name; ?></p>
					</div>			
					<a href="personal.php?Id=<?php echo $userId; ?>">个人中心</a>
					<a href="logout.php">注销</a>
				</div>
			</div>
		</div>	
	</div>
</div>
<?php 
	// 导航选中切换
	 // print_r($_SERVER);

	$currentActive=$_SERVER["REQUEST_URI"];

	// echo $currentActive;

	$home=strpos($currentActive,"home.php");
	// echo $home;
	$list=strpos($currentActive,"list.php")||strpos($currentActive,"post.php")||strpos($currentActive,"addPost.php");

	$hotPeople=strpos($currentActive,"hotPeople.php")||strpos($currentActive,"personal.php");

	$equip=strpos($currentActive,"equip.php");

	$skill=strpos($currentActive,"skill.php");

	$chat=strpos($currentActive,"chat.php")||strpos($currentActive,"addChat.php");

 ?>
	<nav class="navbar navbar-default bgColor" role="navigation">
		<div class="container-fluid thisLeft"> 
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
						data-target="#example-navbar-collapse">
					<span class="sr-only">切换导航</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">摄影导航</a>
			</div>
			<div class="collapse navbar-collapse" id="example-navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="home.php" <?php echo $home!=false ? 'class="active"' : "" ?> >首页</a>	</li>
					<li><a href="list.php" <?php echo $list!=false ? 'class="active"' : "" ?> >作品展示</a></li>
					 <li><a href="hotPeople.php" <?php echo $hotPeople!=false ? 'class="active"' : "" ?> >排行榜</a></li>
				    <li><a href="equip.php" <?php echo $equip!=false ? 'class="active"' : "" ?> >设备介绍</a></li>
				    <li><a href="skill.php" <?php echo $skill!=false ? 'class="active"' : "" ?> >拍摄技巧</a></li>	
				    <li><a href="chat.php" <?php echo $chat!=false ? 'class="active"' : "" ?> >交流论坛</a></li>
				</ul>
			</div>
		</div>
	</nav>
  		 			



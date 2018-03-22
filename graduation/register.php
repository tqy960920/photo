<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>注册</title>
	<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="lib/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/register.css">
</head>
<body>

	
	<div class="reg">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"></div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div class="reg-title">开启你的视觉之旅</div>
				<div class="register">
					<div class="register-title">注册竹鸟账号</div>
					<div class="reg-msg">
						<form action="" method="post" id="frmReg">
						<div class="row regD">
							<label class="col-xs-12 col-sm-12 col-md-12 col-lg-3 left-name">昵称:</label>
							<input type="text" name="nick" id="nick" placeholder="请输入您的昵称" class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
							<!-- <label id="nickError"></label> -->
							
						</div>
						<div class="row regD">
							<label class="col-xs-12 col-sm-12 col-md-12 col-lg-3 left-name">账号:</label>
							<input type="text" name="phone" id="phone" placeholder="请输入手机号码" class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
							<!-- <label id="phoneError"></label> -->
						</div>
						<div class="row regD">
							<label class="col-xs-12 col-sm-12 col-md-12 col-lg-3 left-name">密码:</label>
							<input type="text" name="password" id="password" placeholder="请输入密码" class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
							<!-- <label id="passError"></label> -->
						</div> 
						<div class="row regD">
							<label class="col-xs-12 col-sm-12 col-md-12 col-lg-3 left-name">验证码:</label>
							<input type="text" id="code" class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
							<button type="button" id="btnSendCode" class="col-xs-12 col-sm-12 col-md-12 col-lg-3">获取验证码</button>
						</div> 
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
							<button class="col-xs-12 col-sm-12 col-md-12 col-lg-6 reg-atonce" id="btnReg">立即注册</button>	
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
							<a href="<?php echo $_SERVER["HTTP_REFERER"] ?>" class="col-xs-12 col-sm-12 col-md-12 col-lg-6 btn btn-default">返回</a>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3"></div>
						</div>
					</div>
					</form>				
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"></div>
		</div>
	</div>
	
	<script type="text/javascript" src="lib/js/jquery-1.11.1.js"></script>

	<script src="lib/js/jquery.validate.js"></script>
	<script type="text/javascript" src="js/register.js"></script>

</body>
</html>
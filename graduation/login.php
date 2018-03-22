<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>登录</title>
  <link rel="stylesheet" type="text/css" href="css/login.css">
  <link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
</head>
<body>
	<?php 
		require_once("graduation/service/loginService.php");
	 ?>

	<?php 
		session_start();

		// if(array_key_exists("Current",$_SESSION)){
		// 	header("location:index.php");
		// 	exit;
		// }
	
		$msg="";
		//判断用户名和密码
		if($_SERVER["REQUEST_METHOD"]=="POST"){
			/**
			 * 接受用户登陆时提交的验证码
			 */
			//1. 获取到用户提交的验证码
			$captcha = $_POST["captcha"];
			$msg="";
			//2. 将session中的验证码和用户提交的验证码进行核对,当成功时提示验证码正确，并销毁之前的session值,不成功则重新提交
			if(strtolower($_SESSION["captcha"]) == strtolower($captcha)){
			    // $msg = "验证码正确!";
			    $_SESSION["captcha"] = "";

			    $phone=$_POST["phone"];
				$password=$_POST["password"];
				echo $phone;
				echo $password;
				if($phone!="" && $password!=""){
					$result=LoginService::getLogin($phone,$password);
					// print_r($result);
					if(!is_null($result)){
						$_SESSION["Current"]=[$result->NickName,$result->Id,$result->Header];
						// 跳转，从哪里来回哪里
						header("location:" . $_SESSION["BackUrl"]);
						unset($_SESSION["BackUrl"]);
						exit;
					}			
				}

			}else{
			    $msg = "验证码不正确!";
			}
				
		}
		else{
			$backURL = $_SERVER["HTTP_REFERER"];
			echo $backURL;
			echo "<hr />";
			$_SESSION["BackUrl"] = $backURL;
		}

	?>
	
  	<div class="login-bg">
    	<div class="opacity">
	      	<div>
	        	<img src="image/login.png">
		    </div>
		    <div class="container">
	        	<h2 class="log-name">Login</h2>
		        <form method="post" id="frm">
		            <div class="log-item">
		            	<input type="text" name="phone" id="phone" placeholder="请输入手机号码">            
		          	</div>
		          	<div class="log-item">
		            	<input type="text" name="password" id="password" placeholder="请输入密码" >
		          	</div>
		          	<div class="log-item">
		          		<input type="text" name="captcha" placeholder="请输入图片中的验证码">
		          		<img src="util/createCode.php" onclick="this.src='util/createCode.php?'+new Date().getTime();" width="80" height="40">
		          		<label class="error"><?php echo $msg; ?></label>
		          	</div>
		          	<div class="log-item">
		            	<button class="btn btn-primary">登录</button>
		            	<a href="<?php echo $_SERVER["HTTP_REFERER"] ?>" class="btn btn-default cancel">返回</a>
		          	</div>
		          
		        </form>
	      	</div>
	    </div>
	  </div>

  <script type="text/javascript" src="lib/js/jquery-1.11.1.js"></script>
  <script type="text/javascript" src="lib/js/jquery.validate.js"></script>
  <script src="js/login.js"></script> 
  
</body>
</html>
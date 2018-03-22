<?php 

	require_once("dbHelper.php");
	require_once("graduation/model/userInfo.php");
	require_once("graduation/util/globalSetting.php");
	// 获取所有设备信息

	class LoginService{

		/**
		*/
		public static function getLogin($phone,$pass){
			

			$sql = "select Id,Phone,NickName,Header from user where Phone='{$phone}' and Password=MD5('{$pass}')";

			$result = DBHelper::executeDQL($sql);
			// print_r($result);

			if(is_bool($result)){
				return false;
			}


			foreach($result as $row){
				$thisUser = new UserInfo();

				$thisUser -> Id = $row[0];
				$thisUser -> Phone = $row[1];
				$thisUser -> NickName = $row[2];
				$thisUser -> Header = GlobalSetting::IMAGE_URL . $row[3];

			}

			return $thisUser;

		}

	}

?>
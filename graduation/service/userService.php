<?php 

require_once("dbHelper.php");
require_once("graduation/model/userInfo.php");
require_once("graduation/util/globalSetting.php");


class UserService{

	/**
		获取所有用户信息
	*/
	public static function getUsers(){
		$sql="select * from user";

		$result = DBHelper::executeDQL($sql);
		// print_r($result);
		if(is_bool($result)){
			return false;
		}


		$users = [];

		foreach($result as $row){
			$thisUser = new UserInfo();

			$thisUser -> Id = $row[0];
			$thisUser -> Phone = $row[1];
			$thisUser -> NickName = $row[3];
			$thisUser -> Header = GlobalSetting::IMAGE_URL . $row[4];

			$users[] = $thisUser;
		}

		return $users;
	}

	/**
		获取单个用户信息
	*/
	public static function getUsersByID($Id){
		$sql = "select Id,Phone,Password,NickName,Header from user where Id='{$Id}';";

		$result = DBHelper::executeDQL($sql);
		// print_r($result);

		if(is_bool($result)){
			return false;
		}


		foreach($result as $row){
			$thisUser = new UserInfo();

			$thisUser -> Id = $row[0];
			$thisUser -> Phone = $row[1];
			$thisUser -> NickName = $row[3];
			$thisUser -> Header = GlobalSetting::IMAGE_URL . $row[4];

		}

		return $thisUser;

	}

	/*
		根据关注度排序	
	*/

	public static function getHotUsers(){
		$sql = "select n.concernId,u.phone,u.NickName,u.Header,count(1) from notice n inner join user u on u.id = n.concernId group by n.concernId,u.phone,u.NickName,u.Header order by count(1) desc;";

		$result = DBHelper::executeDQL($sql);

		if(is_bool($result)){
			return false;
		}

		$users = [];

		foreach($result as $row){
			$thisUser = new UserInfo();

			$thisUser -> ConcernId = $row[0];
			$thisUser -> Phone = $row[1];
			$thisUser -> NickName = $row[2];
			$thisUser -> Header = GlobalSetting::IMAGE_URL . $row[3];
			$thisUser -> Count1 = $row[4];

			$users[] = $thisUser;
		}

		return $users;

	}

	/*
		获取发帖者共发多少帖子信息			
	*/

	public static function getCountGraphy(){
		$sql = "select g.UserId,u.phone,u.NickName,u.Header,count(1) from graphy g inner join user u on u.id = g.UserId group by g.UserId,u.phone,u.NickName,u.Header order by count(1) desc;";

		$result = DBHelper::executeDQL($sql);
		// print_r($result);

		if(is_bool($result)){
			return false;
		}

		$users=[];

		foreach($result as $row){

			$thisUser = new UserInfo();

			$thisUser -> ConcernId = $row[0];
			$thisUser -> Phone = $row[1];
			$thisUser -> NickName = $row[2];
			$thisUser -> Header = GlobalSetting::IMAGE_URL . $row[3];
			$thisUser -> Count2 = $row[4];

			$users[] = $thisUser;
		}

		return $users;

	}

	/*
		关注该用户（粉丝）		
	*/

	public static function getFensiCount($Id){
		$sql = "select u.Id,u.NickName,u.Header,COUNT(*) from user u inner join notice n on n.ConcernId=u.Id where n.ConcernId='{$Id}';";

		$result = DBHelper::executeDQL($sql);
		// print_r($result);

		if(is_bool($result)){
			return false;
		}


		foreach($result as $row){

			$thisUser = new UserInfo();

			$thisUser -> Id = $row[0];
			$thisUser -> NickName = $row[1];
			$thisUser -> Header = GlobalSetting::IMAGE_URL . $row[2];
			$thisUser -> Count1 = $row[3];

		}

		return $thisUser;

	}


	/*
		用户关注别人（关注）			
	*/

	public static function getGuanzhuCount($Id){
		$sql = "select u.Id,u.NickName,u.Header,COUNT(*) from user u inner join notice n on n.ConcernId=u.Id where n.NoticerId='{$Id}';";

		$result = DBHelper::executeDQL($sql);
		// print_r($result);

		if(is_bool($result)){
			return false;
		}


		foreach($result as $row){

			$thisUser = new UserInfo();

			$thisUser -> Id = $row[0];
			$thisUser -> NickName = $row[1];
			$thisUser -> Header = GlobalSetting::IMAGE_URL . $row[2];
			$thisUser -> Count3 = $row[3];

		}

		return $thisUser;

	}

	/*关注了谁*/
	public static function getGuanzhu($Id){
		$sql = "select u.id , u.phone , u.nickname , u.Header from user u inner join notice n on n.ConcernId = u.Id where n.noticerId = '{$Id}'";

		$result = DBHelper::executeDQL($sql);
		// print_r($result);

		if(is_bool($result)){
			return false;
		}

		$user = [];
		foreach($result as $row){

			$thisUser = new UserInfo();
		
			$thisUser -> Id = $row[0];
			$thisUser -> phone = $row[1];
			$thisUser -> NickName = $row[2];
			$thisUser -> Header = GlobalSetting::IMAGE_URL . $row[3];

			$user[] = $thisUser;
		}

		return $user;

	}


	/*粉丝有谁*/
	public static function getFensi($Id){
		$sql = "select u.id , u.phone , u.nickname , u.Header from user u inner join notice n on n.NoticerId = u.Id where n.ConcernId = '{$Id}'";

		$result = DBHelper::executeDQL($sql);
		// print_r($result);

		if(is_bool($result)){
			return false;
		}
		$user = [];

		foreach($result as $row){

			$thisUser = new UserInfo();

			$thisUser -> Id = $row[0];
			$thisUser -> phone = $row[1];
			$thisUser -> NickName = $row[2];
			$thisUser -> Header = GlobalSetting::IMAGE_URL . $row[3];
			

			$user[] = $thisUser;
		}

		return $user;

	}


	/*  插入一条用户信息 */

	public static function insertUser($user){	

		$sql="insert into user values('{$user->Id}','{$user->Phone}',md5('{$user->Password}'),'{$user->NickName}','{$user->Header}')";
		
		 //echo $sql;
		$result = DBHelper::executeDML($sql);
		
		 //echo $result;

		return $result;

	}

	/*  插入一条关注信息 */

	public static function insertNotice($notice){	
		
		$sql="insert into notice values('{$notice->Id}','{$notice->ConcernId}','{$notice->NoticerId}')";
		
		 //echo $sql;
		$result = DBHelper::executeDML($sql);
		
		 //echo $result;

		return $result;

	}

		/*  删除一条关注信息 */

	public static function deleteNotice($notice){	
		
		$sql="delete from notice where ConcernId='{$notice->ConcernId}' and NoticerId='{$notice->NoticerId}';";
		
		 //echo $sql;
		$result = DBHelper::executeDML($sql);
		
		 //echo $result;

		return $result;

	}


	

}
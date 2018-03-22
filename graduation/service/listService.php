<?php 

	require_once("dbHelper.php");
	require_once("graduation/model/listInfo.php");
	require_once("graduation/model/commentInfo.php");
	require_once("graduation/util/globalSetting.php");
	

	class ListService{

		/**
			获取所有摄影帖信息(State=1)
		*/
		
		public static function getGraphy($lId = ""){
			
			$sql = " select g.Id,g.Title,g.Introduce,g.Image,g.CreateTime,g.`Like`,g.State,u.Header,u.NickName,l.Id,l.Name from graphy g inner join user u on g.UserId=u.Id inner join label l on g.LabelId=l.Id where g.State=1";
				
			if($lId != ""){
				$sql = "select g.Id,g.Title,g.Introduce,g.Image,g.CreateTime,g.`Like`,g.State,u.Header,u.NickName,l.Id,l.Name from graphy g inner join user u on g.UserId=u.Id inner join label l on g.LabelId=l.Id where g.State=1 and l.id = '{$lId}' ;";
			}


			$result = DBHelper::executeDQL($sql);

			if(is_bool($result)){
				return false;
			}

			$photography = [];

			foreach($result as $row){
	
				$thisGraphy = new ListInfo();

				$thisGraphy -> Id = $row[0];
				$thisGraphy -> Title = $row[1];
				$thisGraphy -> Introduce = $row[2];
				$thisGraphy -> Image = $row[3];
				$thisGraphy -> Images = explode("," , $thisGraphy->Image);

			
				$count = count($thisGraphy->Images);
				for($i = 0 ; $i < $count; $i++){
					$thisGraphy->Images[$i] = GlobalSetting::IMAGE_URL . $thisGraphy->Images[$i] ;
				}

				$thisGraphy -> CreateTime = date("Y-m-d H:i:s" , intval($row[4]));
				$thisGraphy -> Like = $row[5];
				$thisGraphy -> State = $row[6];
				$thisGraphy -> Header = GlobalSetting::IMAGE_URL . $row[7];
				$thisGraphy -> NickName = $row[8];
				$thisGraphy -> LabelId = $row[9];
				$thisGraphy -> LabelName = $row[10];

				$photography[] = $thisGraphy;
			}

			return $photography;

		}

		/**
			获取所有摄影帖信息,根据时间排序
		*/

		public static function getTimeGraphy($lId = ""){
			
			$sql = "select g.Id,g.Title,g.Introduce,g.Image,g.CreateTime,g.`Like`,g.State,u.Header,u.NickName,l.Name from graphy g inner join user u on g.UserId=u.Id inner join label l on g.LabelId=l.Id where g.State=1 order by g.CreateTime DESC;";
				
			if($lId != ""){
				$sql = "select g.Id,g.Title,g.Introduce,g.Image,g.CreateTime,g.`Like`,g.State,u.Header,u.NickName,l.Name from graphy g inner join user u on g.UserId=u.Id inner join label l on g.LabelId=l.Id where g.State=1 and l.id = '{$lId}'order by g.CreateTime DESC;";
			}


			$result = DBHelper::executeDQL($sql);

			if(is_bool($result)){
				return false;
			}

			$photography = [];

			foreach($result as $row){
	
				$thisGraphy = new ListInfo();

				$thisGraphy -> Id = $row[0];
				$thisGraphy -> Title = $row[1];
				$thisGraphy -> Introduce = $row[2];
				$thisGraphy -> Image = $row[3];
				$thisGraphy -> Images = explode("," , $thisGraphy->Image);

			
				$count = count($thisGraphy->Images);
				for($i = 0 ; $i < $count; $i++){
					$thisGraphy->Images[$i] = GlobalSetting::IMAGE_URL . $thisGraphy->Images[$i] ;
				}

				$thisGraphy -> CreateTime = date("Y-m-d H:i:s" , intval($row[4]));
				$thisGraphy -> Like = $row[5];
				$thisGraphy -> State = $row[6];
				$thisGraphy -> Header = GlobalSetting::IMAGE_URL . $row[7];
				$thisGraphy -> NickName = $row[8];
				$thisGraphy -> LabelName = $row[9];

				$photography[] = $thisGraphy;
			}

			return $photography;

		}
		
		/*
			获取所有摄影帖信息，根据喜欢程度排序
		*/

		public static function getHotGraphy($lId = ""){
			
			$sql="select g.Id,g.Title,g.Introduce,g.Image,g.CreateTime,g.`Like`,g.State,u.Header,u.NickName,l.Name from graphy g inner join user u on g.UserId=u.Id inner join label l on g.LabelId=l.Id where g.State=1 order by g.`Like` DESC;";
				
			if($lId != ""){
				$sql = "select g.Id,g.Title,g.Introduce,g.Image,g.CreateTime,g.`Like`,g.State,u.Header,u.NickName,l.Name from graphy g inner join user u on g.UserId=u.Id inner join label l on g.LabelId=l.Id where g.State=1 and l.id = '{$lId}' order by g.`Like` DESC;";
			}


			$result = DBHelper::executeDQL($sql);

			if(is_bool($result)){
				return false;
			}

			$photography = [];

			foreach($result as $row){
	
				$thisGraphy = new ListInfo();

				$thisGraphy -> Id = $row[0];
				$thisGraphy -> Title = $row[1];
				$thisGraphy -> Introduce = $row[2];
				$thisGraphy -> Image = $row[3];
				$thisGraphy -> Images = explode("," , $thisGraphy->Image);

			
				$count = count($thisGraphy->Images);
				for($i = 0 ; $i < $count; $i++){
					$thisGraphy->Images[$i] = GlobalSetting::IMAGE_URL . $thisGraphy->Images[$i] ;
				}

				$thisGraphy -> CreateTime = date("Y-m-d H:i:s" , intval($row[4]));
				$thisGraphy -> Like = $row[5];
				$thisGraphy -> State = $row[6];
				$thisGraphy -> Header = GlobalSetting::IMAGE_URL . $row[7];
				$thisGraphy -> NickName = $row[8];
				$thisGraphy -> LabelName = $row[9];

				$photography[] = $thisGraphy;
			}

			return $photography;

		}

		/*
			获取特定帖子下的摄影帖信息(帖子Id)
	
			获取特定帖子下的摄影帖评论信息
		*/

		public static function getGraphyById($key="",$Id=""){
			$sql1 = "select g.Id,g.Title,g.Introduce,g.Image,g.CreateTime,g.`Like`,g.State,u.Header,u.NickName,l.Name,u.Id from graphy g inner join user u on g.UserId=u.Id inner join label l on g.LabelId=l.Id where g.State=1";	

			$sql2="select c.Id,c.Content,c.CommentTime,u.NickName,u.Header,u.Id from comment c inner join user u where u.Id=c.commentId and c.GraphyId='{$Id}';";
			// echo $sql2;
			
			if($Id!=""){
				$sql1=$sql1 ." and g.Id='{$Id}';";
			}
			
			if($key != ""){
				$sql1 = $sql1 . " and instr(g.Title,'{$key}')>0;";		
			}

			
			$result1 = DBHelper::executeDQL($sql1);
			// print_r($result1);
			$result2 = DBHelper::executeDQL($sql2);
			// print_r($result2);

			if(is_bool($result1)){
				return false;
			}


			if(is_bool($result2)){
				return false;
			}

			// $data=[];

			// 某标签下的帖子
			foreach($result1 as $row){

				$thisGraphy = new ListInfo();

				$thisGraphy -> Id = $row[0];
				$thisGraphy -> Title = $row[1];
				$thisGraphy -> Introduce = $row[2];
				$thisGraphy -> Image = $row[3];
				$thisGraphy -> Images = explode("," , $thisGraphy->Image);

			
				$count = count($thisGraphy->Images);
				for($i = 0 ; $i < $count; $i++){
					$thisGraphy->Images[$i] = GlobalSetting::IMAGE_URL . $thisGraphy->Images[$i] ;
				}

				$thisGraphy -> CreateTime = date("Y-m-d H:i:s" , intval($row[4]));
				$thisGraphy -> Like = $row[5];
				$thisGraphy -> State = $row[6];
				$thisGraphy -> Header = GlobalSetting::IMAGE_URL . $row[7];
				$thisGraphy -> NickName = $row[8];
				$thisGraphy -> LabelName = $row[9];
				$thisGraphy -> UserId = $row[10];

			}
			$data[]=$thisGraphy;
			// print_r($thisGraphy);


			// 某标签下帖子对应评论
			$comments=[];

			foreach($result2 as $row){

				$comment = new CommentInfo();

				$comment -> Id = $row[0];
				$comment -> Content = $row[1];
				$comment -> CommentTime = date("Y-m-d H:i:s" , intval($row[2]));
				$comment -> NickName = $row[3];
				$comment -> Header = GlobalSetting::IMAGE_URL . $row[4];
				$comment -> UserId = $row[5];
 
				$comments[]=$comment;

			}
			// print_r($comments);
			$data[]=$comments;

			// $data=[
			// 	$currentGraphy = $thisGraphy,
			// 	$graphyComment = $comments
			// ];

			// print_r($data);

			return $data;

		 }


		/*
			获取用户Id下的摄影帖
		*/

		public static function getGraphyByUser($Id){	
		
			$sql="select g.Id,g.Title,g.Introduce,g.Image,g.CreateTime,g.`Like`,g.State,u.Header,u.NickName,l.Name from graphy g inner join user u on g.UserId=u.Id inner join label l on g.LabelId=l.Id where g.UserId='{$Id}' and g.State=1;";

			$result = DBHelper::executeDQL($sql);

			if(is_bool($result)){
				return false;
			}

			$graphy = [];
			foreach($result as $row){

				$thisGraphy = new ListInfo();

				$thisGraphy -> Id = $row[0];
				$thisGraphy -> Title = $row[1];
				$thisGraphy -> Introduce = $row[2];
				$thisGraphy -> Image = $row[3];
				$thisGraphy -> Images = explode("," , $thisGraphy->Image);

			
				$count = count($thisGraphy->Images);
				for($i = 0 ; $i < $count; $i++){
					$thisGraphy->Images[$i] = GlobalSetting::IMAGE_URL . $thisGraphy->Images[$i] ;
				}

				$thisGraphy -> CreateTime = date("Y-m-d H:i:s" , intval($row[4]));
				$thisGraphy -> Like = $row[5];
				$thisGraphy -> State = $row[6];
				$thisGraphy -> Header = GlobalSetting::IMAGE_URL . $row[7];
				$thisGraphy -> NickName = $row[8];
				$thisGraphy -> LabelName = $row[9];

				$graphy[] = $thisGraphy; 
			}

			return $graphy;

		}


		/*
			判断待审核的帖子
		*/
		public static function getDaiGraphy($Id =''){
			// 待审核
			if($Id==''){
				$sql="select g.Id,g.Title,g.Introduce,g.Image,g.CreateTime,g.`Like`,g.State,u.Header,u.NickName,l.Name from graphy g inner join user u on g.UserId=u.Id inner join label l on g.LabelId=l.Id where g.State=2;";
			}
			else{
				$sql="select g.Id,g.Title,g.Introduce,g.Image,g.CreateTime,g.`Like`,g.State,u.Header,u.NickName,l.Name from graphy g inner join user u on g.UserId=u.Id inner join label l on g.LabelId=l.Id where g.UserId='{$Id}' and g.State=2;";
			}

			$result = DBHelper::executeDQL($sql);

			if(is_bool($result)){
				return false;
			}

			$graphy = [];
			foreach($result as $row){

				$thisGraphy = new ListInfo();

				$thisGraphy -> Id = $row[0];
				$thisGraphy -> Title = $row[1];
				$thisGraphy -> Introduce = $row[2];
				$thisGraphy -> Image = $row[3];
				$thisGraphy -> Images = explode("," , $thisGraphy->Image);

			
				$count = count($thisGraphy->Images);
				for($i = 0 ; $i < $count; $i++){
					$thisGraphy->Images[$i] = GlobalSetting::IMAGE_URL . $thisGraphy->Images[$i] ;
				}

				$thisGraphy -> CreateTime = date("Y-m-d H:i:s" , intval($row[4]));
				$thisGraphy -> Like = $row[5];
				$thisGraphy -> State = $row[6];
				$thisGraphy -> Header = GlobalSetting::IMAGE_URL . $row[7];
				$thisGraphy -> NickName = $row[8];
				$thisGraphy -> LabelName = $row[9];

				$graphy[] = $thisGraphy; 
			}

			return $graphy;

		}


		/*
			审核未通过的帖子
		*/
		public static function getNoPassGraphy($Id=''){
			// 待审核
			if($Id==''){
				$sql="select g.Id,g.Title,g.Introduce,g.Image,g.CreateTime,g.`Like`,g.State,u.Header,u.NickName,l.Name from graphy g inner join user u on g.UserId=u.Id inner join label l on g.LabelId=l.Id where g.State=0;";
			}else{
				$sql="select g.Id,g.Title,g.Introduce,g.Image,g.CreateTime,g.`Like`,g.State,u.Header,u.NickName,l.Name from graphy g inner join user u on g.UserId=u.Id inner join label l on g.LabelId=l.Id where g.UserId='{$Id}' and g.State=0;";
			}

			$result = DBHelper::executeDQL($sql);

			if(is_bool($result)){
				return false;
			}

			$graphy = [];
			foreach($result as $row){

				$thisGraphy = new ListInfo();

				$thisGraphy -> Id = $row[0];
				$thisGraphy -> Title = $row[1];
				$thisGraphy -> Introduce = $row[2];
				$thisGraphy -> Image = $row[3];
				$thisGraphy -> Images = explode("," , $thisGraphy->Image);

			
				$count = count($thisGraphy->Images);
				for($i = 0 ; $i < $count; $i++){
					$thisGraphy->Images[$i] = GlobalSetting::IMAGE_URL . $thisGraphy->Images[$i] ;
				}

				$thisGraphy -> CreateTime = date("Y-m-d H:i:s" , intval($row[4]));
				$thisGraphy -> Like = $row[5];
				$thisGraphy -> State = $row[6];
				$thisGraphy -> Header = GlobalSetting::IMAGE_URL . $row[7];
				$thisGraphy -> NickName = $row[8];
				$thisGraphy -> LabelName = $row[9];

				$graphy[] = $thisGraphy; 
			}

			return $graphy;

		}

		/*
			写入一条摄影帖评论信息
		*/

		public static function insertComment($comment){	
		
			$sql="insert into comment values('{$comment->Id}','{$comment->GraphyId}','{$comment->UserId}','{$comment->Content}',{$comment->CommentTime})";

			$result = DBHelper::executeDML($sql);
			
			// echo $result;

			return $result;

		}

		/*
			插入一条摄影帖评论信息
		*/

		public static function insertGraphy($graphy){

			$sql="insert into graphy values('{$graphy->Id}','{$graphy->Title}','{$graphy->Introduce}','{$graphy->Image}',{$graphy->CreateTime},'{$graphy->UserId}','{$graphy->LabelId}',{$graphy->Like},{$graphy->State},'{$graphy->Review}')";
			// echo $sql;
			$result = DBHelper::executeDML($sql);
			
			// echo $result;

			return $result;
		}

		/*
			更新一条摄影帖评论信息
		*/

		public static function updateGraphy($Id){
			$sql="update graphy set `like`=`like`+1;";

			$result = DBHelper::executeDML($sql);

			return $result;
		}

		public static function updateState($state,$Id){
			$sql="update graphy set State={$state} where Id='{$Id}'";

			$result = DBHelper::executeDML($sql);

			return $result;

		}




	}

?>
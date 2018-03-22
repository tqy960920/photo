<?php 

	require_once("dbHelper.php");
	require_once("graduation/model/chatInfo.php");
	require_once("graduation/model/chatMsgInfo.php");
	require_once("graduation/util/globalSetting.php");
	// 获取所有交流贴信息

	class ChatService{

		/**
			获取所有帖子
		*/
		public static function getAllChat(){
			$sql = "select c.Id,c.Title,c.Content,c.CreateTime,u.NickName,u.Id from chat c inner join user u on c.ChaterId=u.Id";

			$result = DBHelper::executeDQL($sql);

			if(is_bool($result)){
				return false;
			}

			$chats = [];

			foreach($result as $row){
				$chat = new ChatInfo();

				$chat -> Id = $row[0];
				$chat -> Title = $row[1];
				$chat -> Content =  $row[2];
				$chat -> CreateTime = date("Y-m-d H:i:s" , intval($row[3]));
				$chat -> NickName= $row[4];
				$chat -> ChaterId=$row[5];
				$chats[] = $chat;
			}
			// print_r($chats);

			return $chats;

		}

		/**
			获取对应帖子ID下的记录
		*/

		public static function getChatById($Id){

			$sql1="select c.Id,c.Title,c.Content,c.CreateTime,u.NickName,u.Id,u.Header from chat c inner join user u on c.ChaterId=u.Id where c.Id='{$Id}';";

			$sql2 = "select c1.Id,c1.Content,c1.FollowId,c1.FollowTime,c2.Id,u.NickName,u.Header from chatMsg c1 inner join chat c2 on c1.chatId=c2.Id inner join user u on c1.FollowId=u.Id where c2.Id='{$Id}' ORDER BY c1.FollowTime desc;";

			$result1 = DBHelper::executeDQL($sql1);
			$result2 = DBHelper::executeDQL($sql2);

			if(is_bool($result1)){
				return false;
			}
			if(is_bool($result2)){
				return false;
			}

			$data=[];
			// print_r($result1);

			foreach($result1 as $row){
				$chat1 = new ChatInfo();

				$chat1 -> Id = $row[0];
				$chat1 -> Title = $row[1];
				$chat1 -> Content =  $row[2];
				$chat1 -> CreateTime = date("Y-m-d H:i:s" , intval($row[3]));
				$chat1 -> NickName= $row[4];
				$chat1 -> ChaterId=$row[5];
				$chat1 -> Header=GlobalSetting::IMAGE_URL . $row[6];

			}
			// echo($chat);


			$chats = [];

			foreach($result2 as $row){
				$chat = new ChatMsgInfo();
	
				$chat -> Id = $row[0];
				$chat -> Content = $row[1];
				$chat -> FollowId =  $row[2];
				$chat -> FollowTime = date("Y-m-d H:i:s" , intval($row[3]));
				$chat -> UserId= $row[4];
				$chat -> NickName = $row[5];
				$chat -> Header= GlobalSetting::IMAGE_URL . $row[6];

				$chats[] = $chat;
			}


			$data=[
				$single=$chat1,
				$chaters=$chats
			];
			// print_r($data);
			return $data;

		}

		/**
			插入一条帖子ID下的记录
		*/
		public static function insertChat($chat){
			$sql="insert into chatMsg values('{$chat->Id}','{$chat->Content}','{$chat->FollowId}',{$chat->FollowTime},'{$chat->ChatId}')";


			$result = DBHelper::executeDML($sql);

			return $result;
		}

		/**
			插入新交流贴
		*/
		public static function insertOneChat($chat){
			$sql="insert into chat values('{$chat->Id}','{$chat->Title}','{$chat->Content}',{$chat->CreateTime},'{$chat->ChaterId}')";


			$result = DBHelper::executeDML($sql);

			return $result;
		}




	}

?>
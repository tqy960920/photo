<?php 

	require_once("dbHelper.php");
	require_once("graduation/model/skillInfo.php");
	require_once("graduation/util/globalSetting.php");
	// 获取所有技巧信息

	class SkillService{

		/**
			所有
		*/
		public static function getSkill(){
			$sql = "select Id,Title,Content,Image,CreateTime from skill";

			$result = DBHelper::executeDQL($sql);

			if(is_bool($result)){
				return false;
			}

			$skills = [];

			foreach($result as $row){
				$thisSkill = new SkillInfo();

				$thisSkill -> Id = $row[0];
				$thisSkill -> Title = $row[1];
				$thisSkill -> Content =  $row[2];
				$thisSkill -> Image = GlobalSetting::IMAGE_URL . $row[3];
				$thisSkill -> CreateTime = date("Y-m-d H:i:s" , intval($row[4]));

				$skills[] = $thisSkill;
			}

			return $skills;

		}

		public static function getSkillDetail($Id){
			$sql = "select Id,Title,Content,Image,CreateTime from skill where Id='{$Id}'";

			$result = DBHelper::executeDQL($sql);

			if(is_bool($result)){
				return false;
			}

			foreach($result as $row){
				$thisSkill = new SkillInfo();

				$thisSkill -> Id = $row[0];
				$thisSkill -> Title = $row[1];
				$thisSkill -> Content =  $row[2];
				$thisSkill -> Image = GlobalSetting::IMAGE_URL . $row[3];
				$thisSkill -> CreateTime = date("Y-m-d H:i:s" , intval($row[4]));
			}

			return $thisSkill;

		}

		// 添加

		public static function addSkill($skill){
			$sql="insert into skill values('{$skill->Id}','{$skill->Title}','{$skill->Content}','{$skill->Image}',{$skill->CreateTime});";

			$result = DBHelper::executeDML($sql);

			return $result;
		}


		/**
			删除
		*/
		public static function deleteSkill($Id){
			$sql="delete from skill where Id='{$Id}'";

			$result = DBHelper::executeDML($sql);


			return $result;

		}
		// 编辑

		public static function editSkill($skill){
			$sql="update skill set Title='{$skill->Title}',Content='{$skill->Content}',Image='{$skill->Image}',CreateTime={$skill->CreateTime} where Id='{$skill->Id}';";
			// echo $sql;
			$result = DBHelper::executeDML($sql);

			return $result;
		}


	}

?>
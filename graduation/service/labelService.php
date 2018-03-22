<?php

	require_once("dbHelper.php");
	require_once("graduation/model/labelInfo.php");
	// require_once("gra_ajax/util/globalSetting.php");
	// 获取所有设备信息

	class LabelService{

		/**
			获取所有
		*/
		public static function getLabel(){
			$sql = "select Id,Name from label";

			$result = DBHelper::executeDQL($sql);

			if(is_bool($result)){
				return false;
			}

			$labels = [];

			foreach($result as $row){
				$thisLabel = new LabelInfo();

				$thisLabel -> Id = $row[0];
				$thisLabel -> Name = $row[1];

				$labels[] = $thisLabel;
			}

			return $labels;

		}

		/**
			更新
		*/
		public static function updateLabel($label){
			$sql="update label set name='{$label->Name}' where Id='{$label->Id}';";

			$result = DBHelper::executeDML($sql);


			return $result;

		}

		/**
			添加
		*/
		public static function insertLabel($label){
			$sql="insert into label values('{$label->Id}','{$label->Name}')";

			$result = DBHelper::executeDML($sql);


			return $result;

		}

		/**
			删除
		*/
		public static function deleteLabel($Id){
			$sql="delete from label where Id='{$Id}'";

			$result = DBHelper::executeDML($sql);


			return $result;

		}



}
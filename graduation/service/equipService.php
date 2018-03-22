<?php 

	require_once("dbHelper.php");
	require_once("graduation/model/equipInfo.php");
	// require_once("gra_ajax/util/globalSetting.php");
	// 获取所有设备信息

	class EquipService{

		/**
		*/
		public static function getEquip(){
			$sql = "select Id,Name,Image,Introduce from equip";

			$result = DBHelper::executeDQL($sql);

			if(is_bool($result)){
				return false;
			}

			$equips = [];

			foreach($result as $row){
				$thisEquip = new EquipInfo();

				$thisEquip -> Id = $row[0];
				$thisEquip -> Name = $row[1];
				$thisEquip -> Image =  $row[2];
				$thisEquip -> Introduce = $row[3];

				$equips[] = $thisEquip;
			}

			return $equips;

		}

	}

?>
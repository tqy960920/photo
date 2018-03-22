<?php 

class GlobalSetting{
	const IMAGE_URL = "http://192.168.12.109:9091/graduation/images/";


	public static function getUUID(){
		return md5(uniqid(microtime(true) . mt_rand()));
	}
	

}
<?php 

class DBHelper{

	const DB_HOST = "127.0.0.1"; // static
	const DB_USER = "root";
	const DB_PASSWORD = "1111";
	const DB_NAME = "photography";

	// const IMG_ROOT = "http://127.0.0.1:9091/graduation/image/";

	/*
		通过insert update delete的查询返回影响行数
	*/
	public static function executeDML($sql){

		$con = @new mysqli(self::DB_HOST , self::DB_USER , self::DB_PASSWORD , self::DB_NAME);

		if($con -> connect_errno){
			return false;
		}

		$val = $con -> query($sql);

		$con -> close();

		return $val;

	}

	/*
		select 语句查询返回结果集
	*/
	public static function executeDQL($sql){
		// 创建连接对象
		$con = @new mysqli(self::DB_HOST , self::DB_USER , self::DB_PASSWORD , self::DB_NAME);
		// 检查连接状态
		if($con -> connect_errno){
			return false;
		}
		// 执行SQL语句
		$result = $con -> query($sql);

		if($result){
			$rows = $result->fetch_all();

			$result->close();
			$con -> close();

			return $rows;
		}

		$con -> close();
		return false;

	}
}
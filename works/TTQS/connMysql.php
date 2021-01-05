<?php
	//資料庫主機設定
<<<<<<< HEAD
	$db_host = "localhost"; //預設3306
	$db_username = "root";
	$db_password = "";
	$db_name = "great_light";
=======
	$db_host = "sql304.byethost17.com"; //預設3306
	$db_username = "";
	$db_password = "";
	$db_name = "b17_27105184_TTQS";
>>>>>>> e91684a32015674a051b63b9f622dbc3af5c3efe
	//連線資料庫
	$db_link = @new mysqli($db_host, $db_username, $db_password, $db_name);
	//錯誤處理
	if ($db_link->connect_error != "") {
		echo "資料庫連結失敗！";
	}else{
		//設定字元集與編碼
		$db_link->query("SET NAMES 'utf8'");
	}
?>

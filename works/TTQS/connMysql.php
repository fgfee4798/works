<?php
	//資料庫主機設定
	$db_host = "sql304.byethost17.com"; //預設3306
	$db_username = "b17_27105184";
	$db_password = "CHEN5660";
	$db_name = "b17_27105184_TTQS";
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
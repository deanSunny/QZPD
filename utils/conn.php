<?php
	$tIP = "127.0.0.1";
	$loginname = "root";
	$loginpwd = "";
	$dbName = "QZPD";

	$conn = mysql_connect($tIP, $loginname, $loginpwd) or die("数据库连接错误，请重试！".mysql_error());
	mysql_select_db($dbName, $conn) or die("数据库访问错误，请重试！".mysql_error());
?>
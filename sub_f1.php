<?php 
	session_start();
	$username = $_SESSION['username'];
	$authorization = $_SESSION['userauthorization'];
	$user_path = 'user\\$username';
	$dbname = $_POST['db'];
	$result_num = $_POST['result_num'];
	$im_name = $_POST['upImName'];
	$cmd = system("python demo.py src", $result);//
	include_once("utils/CreateDB.php");
	include_once("utils/conn.php");
	$sql = DB::insert_user_details($username, 1, '', $authorization, $im_name);
	$res = new stdClass();
	$res->dbname = $dbname;
	$res->im_name = $im_name;
	$res->result_num = $result_num;
	$res->result = $result;
	$res->sql = $sql;
	echo json_encode($res);
?>
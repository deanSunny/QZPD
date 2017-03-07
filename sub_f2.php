<?php
	session_start();
	$username = $_SESSION['username'];
	$authorization = $_SESSION['userauthorization'];
	$upImName_1 = $_POST['upImName_1'];
	$upImName_2 = $_POST['upImName_2'];
	$res = new stdClass();
	$res->im1 = $upImName_1;
	$res->im2 = $upImName_2;
	//$res->sim = system("python demo2.py ".$upImName_1." ".$upImName_2);
	
	include_once("utils/CreateDB.php");
	include_once("utils/conn.php");
	$res->time= DB::insert_user_details($username, 2, '', $authorization, $upImName_1.' '.$upImName_2);
	//$result = exec();
	if(!empty($res->time)){
		$time = strtotime($res->time);
		mkdir('user/'.$username.'/'.$time, 0777);
		chmod('user/'.$username.'/'.$time, 0777);
	}
	echo json_encode($res);
	
?>
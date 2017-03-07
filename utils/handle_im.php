<?php
 session_start();
 function UploadIm($im_file){
	 $err = $_FILES[$im_file]["error"];
	 $im = $_FILES[$im_file];
	 $uname = $_SESSION['username'];
	 $res = new stdClass();
	 if($err > 0){
		 $res->err = $err;
		 $res->remark = 'failed';
		 return json_encode($res);	 
	 }
	 move_uploaded_file($im["tmp_name"], "temp/im/".$uname."_".$im["name"]);
	 
	 
	 $res->err = $err;
	 $res->remark = 'success';
	 $res->user = $uname;
	 $res->type = $im["type"];
	 $res->size = $im["size"];
	 $res->temp = $im["tmp_name"];
	 $res->url = 'temp/im/'.$uname."_".$im["name"];
	 //$res->im = $im;
	 return json_encode($res);
 }
 
 
?>
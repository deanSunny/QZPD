<?php
	require("utils/handle_im.php");
	/*$res = UploadIm("f2_im_1");
	echo $res;*/
	$im_id = $_GET["im_id"];
	$res = UploadIm("f2_im_".$im_id);
	echo $res;
?>
<?php
	session_start();
	if (!isset($_POST['button'])) {
		exit('非法访问！');
	}
	$username = htmlspecialchars($_POST['username']);
	$password = MD5($_POST['userpwd']);
	$tablename = 'user';
	include("utils/conn.php");
	include_once("utils/CreateDB.php");
	$result = DB::get_user_from_user_list($tablename, $username, $password);
	if($result == 1){
		mysql_close()
		?>
		<script type="text/javascript" language="javascript">
			window.location.href = "index.php";
		</script>
    <?php
	}else{
		?>
		<script type="text/javascript" language="javascript">
			alert("用户名或密码错误，请重试！<?php echo $result?>");
			window.location.href = "login.html";
		</script>
        <?php
		}
?>
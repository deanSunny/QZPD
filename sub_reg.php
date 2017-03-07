<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>请稍后</title>
</head>
<body>
<?php
	if (!isset($_POST['btn_reg'])){
		exit('非法访问！');	
	}
	$dbname = "user";
	$userdb = "user_details";
	$username = $_POST['username'];
	include("conn.php");
	$find_name = mysql_query("select * from $dbname where username = '$username'");
	$count_users = mysql_query("select count(*) from $dbname");
	$count = mysql_fetch_array($count_users);
	$conf_db = mysql_query("show Tables like '$userdb'");
	if (mysql_num_rows($conf_db) < 1){
		include_once('utils/CreateDB.php');
		DB::create_table_user_details();
	}
	$rescdb = mysql_fetch_array($conf_db);
	if ($count[0] >= 20){
		?>
        <script type="text/javascript" language="javascript">
			//alert('用户数已经超过20，请用已有账户登录！');
			alert('<?php echo $count?>');
			window.location.href = "login.html";
		</script>
        <?php
	}else{
		if ($result = mysql_fetch_array($find_name)){
			?>
		<script type="text/javascript" language="javascript">
			alert('该用户名已经存在！');
			window.location.href = "register.html";
		</script>
			<?php
		}else{
			$pwd = MD5($_POST['userpwd']);
			$remark = $_POST['remark'];
	
			$reg_query = mysql_query("insert into $dbname(username, password, remark) values('$username', '$pwd', '$remark')");
			if ($reg_query) {
				mkdir('user/'.$username, 0777);
				chmod('user/'.$username, 0777);
				?>
		<script type="text/javascript" language="javascript">
			alert('注册成功！');
			//alert("<?php echo $rescdb[0]?>");
			window.location.href = "login.html";
		</script>
				<?php
			}else{
				?>
		<script type="text/javascript" language="javascript">
			alert('注册失败，请重试！');
			window.location.href = "register.html";
		</script>
				<?php	
			}
		}
	}

?>
</body>
</html>
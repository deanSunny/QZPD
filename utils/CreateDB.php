<?php
	session_start();
	class DB{
		static function create_table_user_list(){
			$db_name = 'user';
			$conf_db = "show Tables like '$db_name'";
			$re_conf_db = mysql_query($conf_db);
			$sql = "CREATE TABLE `$db_name` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `username` varchar(100) NOT NULL DEFAULT '',
					  `password` varchar(100) NOT NULL DEFAULT '',
					  `remark` varchar(200) DEFAULT NULL,
					  `level` int(11) NOT NULL DEFAULT '5',
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;";
			if(mysql_num_rows($re_conf_db) < 1){
				mysql_query($sql);
			}	
			mysql_close();
			return $sql;
		}
		static function create_table_user_details(){
			$db_name = 'user_details';
			$sql = "CREATE TABLE `$db_name` (
					  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
					  `username` varchar(100) NOT NULL DEFAULT '',
					  `func` int(11) NOT NULL,
					  `results` varchar(1000) DEFAULT NULL,
					  `date` datetime NOT NULL,
					  `authorization` int(11) NOT NULL,
					  `input` varchar(1000) NOT NULL DEFAULT '',
					  `checked` int(2) NOT NULL,
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
			mysql_query($sql);
			mysql_close();
		}	
		static function get_user_from_user_list($dbname, $username, $password){
			$sql = "select * from `$dbname` where username='$username' and password='$password'";
			$check_query = mysql_query($sql);
			if($result = mysql_fetch_row($check_query)){
				$_SESSION['username'] = $result[1];
				$_SESSION['userid'] = $result[0];
				$_SESSION['userremark'] = $result[3];
				$_SESSION['userauthorization'] = $result[4];
				if (!isset($_COOKIE['username'])){
					setcookie('username', $result[0], time()+ 3600 * 24);
				}	
				return 1;
			}else{
				return 0;	
			}
			//mysql_close();
		}
		static function insert_user_details($username, $func, $results, $authorization, $input){
			$dbname = "user_details";
			date_default_timezone_set("PRC");
			$date_time = date('Y-m-d H:i:s');
			$sql = "insert into `$dbname`(username, func, results, date, authorization, input, checked) values('$username', $func, ' ', '$date_time', $authorization, '$input', 0)";
			mysql_query($sql);
			return $date_time;
		}
		static function get_user_details($username, $authorization){
			$dbname = "user_details";
			if($authorization != 1){
				$sql = "select * from `$dbname` where `username` = '$username'";
				//echo $sql;
				$res = mysql_query($sql);
				return $res;
			}else{
				$sql = "select * from `$dbname`";
				$res = mysql_query($sql);
				return $res;
			}
		}
		static function get_user_info(){
			$dbname	= 'user';
			$sql = "select * from `$dbname`";
			//echo $sql;
			$res = mysql_query($sql);
			return $res;
		}
		
	}
?>
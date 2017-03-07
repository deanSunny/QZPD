<?php 
	session_start();
	include_once('utils/conn.php');
	include_once('utils/CreateDB.php');
	DB::create_table_user_list();
?>
<!DOCTYPE html>
<?php
	//session_start();
	//$userbrowser = $_SERVER['HTTP_USER_AGENT'];
	function getBrowser(){
		$agent=$_SERVER["HTTP_USER_AGENT"];
		if(strpos($agent,'MSIE')!==false || strpos($agent,'rv:11.0')) //ie11判断
		return "ie";
		else if(strpos($agent,'Firefox')!==false)
		return "firefox";
		else if(strpos($agent,'Chrome')!==false)
		return "chrome";
		else if(strpos($agent,'Opera')!==false)
		return 'opera';
		else if((strpos($agent,'Chrome')==false)&&strpos($agent,'Safari')!==false)
		return 'safari';
		else 
		return 'unknown';
	}
	
	function getBrowserVer(){
		if (empty($_SERVER['HTTP_USER_AGENT'])){    //当浏览器没有发送访问者的信息的时候
			return 'unknow';
		}
		$agent= $_SERVER['HTTP_USER_AGENT'];   
		if (preg_match('/MSIE\s(\d+)\..*/i', $agent, $regs))
			return $regs[1];
		elseif (preg_match('/FireFox\/(\d+)\..*/i', $agent, $regs))
			return $regs[1];
		elseif (preg_match('/Opera[\s|\/](\d+)\..*/i', $agent, $regs))
			return $regs[1];
		elseif (preg_match('/Chrome\/(\d+)\..*/i', $agent, $regs))
			return $regs[1];
		elseif ((strpos($agent,'Chrome')==false)&&preg_match('/Safari\/(\d+)\..*$/i', $agent, $regs))
			return $regs[1];
		else
			return 'unknow';
	}
	?>
	<script type="text/javascript" language="javascript">
		alert("<?php echo getBrowser().getBrowserVer();?>");
    </script>
	<?php
	if(!isset($_SESSION['username'])){
		?>
        <script type="text/javascript" language="javascript">
			window.location.href="login.html";
		</script>
        <?php
		}else{
			$username = $_SESSION['username'];	
		}
?>
<html>

	<head>
		<meta charset="utf-8">
		<title>人脸识别系统</title>
		<meta name="renderer" content="webkit">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="format-detection" content="telephone=no">

		<link rel="stylesheet" href="plugins/layui/css/layui.css" media="all" />
		<link rel="stylesheet" href="css/global.css" media="all">
		<link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
		<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	</head>

	<body>
		<div class="layui-layout layui-layout-admin">
			<div class="layui-header header header-demo">
				<div class="layui-main">
					<div class="admin-login-box">
						<a class="logo" style="left: 0;" href="">
							<span style="font-size: 22px;">人脸识别系统</span>
						</a>
						<div class="admin-side-toggle">
							<i class="fa fa-bars" aria-hidden="true"></i>
						</div>
					</div>
					<ul class="layui-nav admin-header-item">
						<!--<li class="layui-nav-item">
							<a href="javascript:;">清除缓存</a>
						</li>-->
						<!--<li class="layui-nav-item">
							<a href="javascript:;">浏览网站</a>
						</li>
						<li class="layui-nav-item" id="video1">
							<a href="javascript:;">视频</a>
						</li>-->
						<li class="layui-nav-item">
							<a href="javascript:;" class="admin-header-user">
								<img src="images/0.jpg" />
								<span><?php echo $username;?></span>
							</a>
							<dl class="layui-nav-child">
								<dd>
									<a id="user" href="javascript:void(0);"><i class="fa fa-user-circle" aria-hidden="true"></i> 个人信息</a>
								</dd>
								<dd>
									<a href="javascript:void(0);"><i class="fa fa-gear" aria-hidden="true"></i> 设置</a>
								</dd>
								<dd id="lock">
									<a href="javascript:;">
										<i class="fa fa-lock" aria-hidden="true" style="padding-right: 3px;padding-left: 1px;"></i> 锁屏 (Alt+L)
									</a>
								</dd>
								<dd>
									<a id="logout" href="javascript:void(0);"><i class="fa fa-sign-out" aria-hidden="true"></i> 注销</a>
								</dd>
							</dl>
						</li>
					</ul>
					<ul class="layui-nav admin-header-item-mobile">
						<li class="layui-nav-item">
							<a href="login.html"><i class="fa fa-sign-out" aria-hidden="true"></i> 注销</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="layui-side layui-bg-black" id="admin-side">
				<div class="layui-side-scroll" id="admin-navbar-side" lay-filter="side"></div>
			</div>
			<div class="layui-body" style="bottom: 0;border-left: solid 2px #1AA094;" id="admin-body">
				<div class="layui-tab admin-nav-card layui-tab-brief" lay-filter="admin-tab">
					<ul class="layui-tab-title">
						<li class="layui-this">
							<i class="fa fa-dashboard" aria-hidden="true"></i>
							<cite>首页</cite>
						</li>
					</ul>
					<div class="layui-tab-content" style="min-height: 150px; padding: 5px 0 0 0;">
						<div class="layui-tab-item layui-show">
							<iframe src="main.html"></iframe>
						</div>
					</div>
				</div>
			</div>
			<div class="layui-footer footer footer-demo" id="admin-footer">
				<div class="layui-main">
					<p>2017 &copy;
						<a href="" target="_blank">杭州树冠视觉科技有限公司</a>
					</p>
				</div>
			</div>
			<div class="site-tree-mobile layui-hide">
				<i class="layui-icon">&#xe602;</i>
			</div>
			<div class="site-mobile-shade"></div>
			
			<!--锁屏模板 start-->
			<script type="text/template" id="lock-temp">
				<div class="admin-header-lock" id="lock-box">
					<div class="admin-header-lock-img">
						<img src="images/0.jpg"/>
					</div>
					<div class="admin-header-lock-name" id="lockUserName">
					<?php echo $username;?>
					</div>
					<input type="text" class="admin-header-lock-input" value="输入密码解锁.." name="lockPwd" id="lockPwd" />
					<button class="layui-btn layui-btn-small" id="unlock">解锁</button>
				</div>
			</script>
			<!--锁屏模板 end -->
			
			<script type="text/javascript" src="plugins/layui/layui.js"></script>
			<script type="text/javascript" src="datas/nav.js"></script>
			<script src="js/index.js"></script>
			<script>
				layui.use('layer', function() {
					var $ = layui.jquery,
						layer = layui.layer;

					$('#user').on('click', function() {
						layer.open({
							title: '个人信息',
							maxmin: true,
							type: 2,
							content: 'user.php',
							area: ['960px', '680px']
						});
					});

				});
				$('#logout').click(function(){
					//alert("1");
					<?php 
						//session_destroy();
					?>	
					window.location.href = 'login.html';
				});
			</script>
		</div>
	</body>

</html>
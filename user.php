<?php 
	session_start();
	$username = $_SESSION['username'];
	$authorization = $_SESSION['userauthorization'];
?>
<!doctype html>
<html>

	<head>
		<meta charset="utf-8">
		<title>个人信息</title>
		<meta name="renderer" content="webkit">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" href="plugins/layui/css/layui.css" media="all" />
		<link rel="stylesheet" href="css/global.css" media="all">
        <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	</head>

	<body>
		<div style="margin: 15px;">
        	<div class="layui-tab layui-tab-card">
              <ul class="layui-tab-title">
                <li class="layui-this">历史查询记录</li>
                <?php 
					if($authorization == 1){
					?><li>用户管理</li><?php	
					}
				?>
              </ul>
              <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <fieldset class="layui-elem-field">
                    <legend>历史使用记录</legend>
                    <div class="layui-field-box">
                    <?php 
                    include_once('utils/conn.php');
                    include_once('utils/CreateDB.php');
                    $res = DB::get_user_details($username, $authorization);
                    if(mysql_num_rows($res) < 1){
                        ?>
                        <div class="layui-field-box">
                            <blockquote class="layui-elem-quote">暂时无查询内容<label id="f2_result"></label></blockquote>
                        </div>
                        <?php
                    }else{
                    ?>
                        <table class="layui-table" lay-skin="line">
                          <colgroup>
                            <col width="150">
                            <col width="200">
                            <col>
                          </colgroup>
                          <thead>
                            <tr>
                              <th>用户名</th>
                              <th>时间</th>
                              <th>使用功能</th>
                            </tr> 
                          </thead>
                          <tbody>
                            <?php 
                            while($result = mysql_fetch_row($res)){
                                ?>
                                
                                <tr>
                                    <th><?php echo $result[1]?></th>
                                    <th><?php echo $result[4]?></th>
                                    
                                    <th>
									<a href="result.php"><?php 
                                        switch($result[2]){
                                            case 1:
                                                echo "人脸数据库检索";
                                                break;
                                            case 2:
                                                echo "认证比对";
                                                break;
                                            case 3:
                                                echo "实时监控";
                                                break;
                                            case 4:
                                                echo "视频倒查";
                                                break;	
                                        }
                                    ?></a></th>
                                </tr>
                                
                                <?php
                            }
                        }
                            ?>
                          </tbody>
                        </table>
                                
                    </div>
                </fieldset>
                </div>
                <?php 
					if($authorization == 1){
					?>
                <div class="layui-tab-item">
                <button class="layui-btn layui-btn-primary layui-btn-small">修改</button>
                    <fieldset class="layui-elem-field">
                    <legend>用户管理</legend>
                    <div class="layui-field-box">
                    
                		<table class="layui-table" lay-skin="line">
                          <colgroup>
                            <col width="150">
                            <col width="200">
                            <col>
                          </colgroup>
                          <thead>
                            <tr>
                              <th>用户名</th>
                              <th>权限</th>
                              <th>备注</th>
                            </tr> 
                          </thead>
                          
                          <tbody id="user_search">
                          <?php 
						  	$res_u = DB::get_user_info();
							//echo $res_u[0];
							while($ru = mysql_fetch_row($res_u)){
								?>
                                
								<tr>
                                	<th><?php echo $ru[1]?></th>
                                    <th><?php echo $ru[4]?></th>
                                    <th><?php echo $ru[3]?></th>
                                </tr>
                                
								<?php	
							}
						  ?>
                          </tbody>
                          <tbody id="user_alert">
                          <form class="layui-form">
                          <?php 
						  	$res_u = DB::get_user_info();
							while($ru = mysql_fetch_row($res_u)){
								?>
                                
								<tr>
                                	<th><?php echo $ru[1]?></th>
                                    <th><?php echo $ru[4]?></th>
                                    <th><?php echo $ru[3]?></th>
                                </tr>
                                
								<?php	
							}
						  ?>
                          </form>
                          </tbody>
                        </table>
                    </div>
                    </fieldset>
                    </div>
                </div><?php	
					}
				?>
                
              </div>
			
            </div>
		</div>
		<script type="text/javascript" src="plugins/layui/layui.js"></script>
        <script type="text/javascript">
			layui.use('element', function(){
				var element = layui.element();
			});
        </script>
	</body>

</html>
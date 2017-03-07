<?php
	$t = $_GET['t'];
	include_once('utils/conn.php');
	include_once('utils/CreateDB.php');
?>
<!doctype html>
<html>

	<head>
		<meta charset="utf-8">
		<title>历史结果</title>
		<meta name="renderer" content="webkit">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" href="plugins/layui/css/layui.css" media="all" />
		<link rel="stylesheet" href="css/global.css" media="all">
        <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	</head>

	<body>
		<div style="margin: 15px;">
			<fieldset class="layui-elem-field">
				<legend>认证比对</legend>
				<div class="layui-field-box">
                        	<!--<input id="upLoadBtn" class="layui-btn layui-btn-normal" type="button" value="上传图片">-->
							<form class="layui-form" method="post" enctype="multipart/form-data" action="">
                            <div class="layui-form-item">
                            <label class="layui-form-label">待测图片</label>
                            <div class="layui-input-block">
                            	<input class="layui-upload-file" id="f2_im_1" name="f2_im_1" type="file" lay-title="上传图片">
                                <input id="upImName_1" type="text" name="upImName_1" class="layui-input" style="display:none;">
                            </div>
                            </div>
                            <div class="layui-form-item">
                            <label class="layui-form-label">对比图片</label>
                            <div class="layui-input-block">
                            	<input class="layui-upload-file" id="f2_im_2" name="f2_im_2" type="file" lay-title="上传图片">
                                <input id="upImName_2" type="text" name="upImName_2" class="layui-input" style="display:none;">
                            </div>
                            </div>
                            </form>
                        </div>
                    <fieldset class="layui-elem-field layui-field-title">
						<legend>待检测人脸图像</legend>
                        <div class="layui-field-box">
                        	<img id="input_im_1" />
                            <img id="input_im_2" />
						</div>
					</fieldset>
					<fieldset class="layui-elem-field layui-field-title">
						<legend>比对结果</legend>
						<div class="layui-field-box">
							<blockquote class="layui-elem-quote">两张图片认证相似度：<label id="f2_result"></label></blockquote>
						</div>
					</fieldset>
			</fieldset>
            
			<!--<iframe id="hidden_submit" name="hidden_subm	it" style="display:none;" onload="iframeLoad(this);"></iframe>-->
		</div>
		<script type="text/javascript" src="plugins/layui/layui.js"></script>
        <script type="text/javascript">
			layui.use(['upload', 'layer', 'form'], function(){
				var form = layui.form(),
					layer = layui.layer;

				
			});
        </script>
	</body>

</html>
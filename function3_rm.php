<!doctype html>
<html>

	<head>
		<meta charset="utf-8">
		<title>Layui</title>
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
				<legend>实时监控</legend>
				<div class="layui-field-box">
					<fieldset class="layui-elem-field layui-field-title">
						<legend>待检测人脸图像</legend>
						<div class="layui-field-box">
                        	<!--<input id="upLoadBtn" class="layui-btn layui-btn-normal" type="button" value="上传图片">-->
                            
							<form method="post" enctype="multipart/form-data">
                           
                            <input class="layui-upload-file" id="upLoadIm" name="upLoadIm" type="file" lay-title="上传图片">
                            <!--<div class="layui-input-block">
                              <button class="layui-btn" lay-submit lay-filter="f1">开始查询</button>
                              <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                            </div>-->
                            
                            </form>
                        </div>
                        <div class="layui-field-box">
                        	<img id="input_im" style="height:300px;" />
						</div>
					</fieldset>
					<fieldset class="layui-elem-field layui-field-title">
						<legend>比对结果</legend>
						<div class="layui-field-box">
							<img id="res_im1" style="height:300px;" />
                            <img id="res_im2" style="height:300px;" />
                            <img id="res_im3" style="height:300px;" />
						</div>
					</fieldset>
				</div>
			</fieldset>
			<!--<iframe id="hidden_submit" name="hidden_subm	it" style="display:none;" onload="iframeLoad(this);"></iframe>-->
		</div>
		<script type="text/javascript" src="plugins/layui/layui.js"></script>
        <script type="text/javascript">
        	/*$("#upLoadIm").change(function(e){
				for(var i = 0; i < e.target.files.length; i++){
					var file = e.target.files.item(i);
					var freader = new FileReader();
					freader.readAsDataURL(file);
					freader.onload = function(e) {
						var src = e.target.result;
						$("#input_im").attr("src", src);	
					}
				}
			});*/
			layui.use(['upload', 'layer', 'form'], function(){
				layui.upload({
					url: "handle_im.php"
					, elem: '#upLoadIm'
					, ext: 'jpg|png|gif|jpeg'
					, type: 'images'
					, before: function(input){
						layer.msg('图片上传处理中，请稍后...');
					}
					
					,success: function(res, input){
    					console.log(res);
						$('#input_im').attr("src", res.url);
						//console.log(input);
  					}
				});
				
			});
			/*function iframeLoad(iframe){
				var doc = iframe.contentWindow.document;
				var html = doc.body.innerHTML;
				if (html != ''){
					var obj = eval("(" + html + ")");
				}	
				if(obj.status < 1){
					alert(obj.msg);	
				}
			}*/
        </script>
	</body>

</html>
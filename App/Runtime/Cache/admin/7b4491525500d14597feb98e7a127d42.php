<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/public.css" />
	<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript">
		function Tomessage(){
			var mobile = $("#ctelnum").val();
			var pwd = $("#Mess_pwd").val();
			var name= $("#Mess_user").val();
			var content = '这是一条测试短信！';
			var sign = '华劳人力';	
			$("#ctel").val("发送中");
			$.getScript("http://web.cr6868.com/asmx/smsservice.aspx?name="+name+"&pwd="+pwd+"&content="+content+"&mobile="+mobile+"&sign="+sign+"&type=pt&extno=8711",function(date){
				$("#ctel").val(data+'完成');
			})
		}
	</script>
</head>
<body>
	<form action="<?php echo U(GROUP_NAME . '/Message/RunSet');?>" method="post">
		<table class="table">
			<tr>
				<td colspan="3">留言板设置</td>
			</tr>
			<tr>
				<td width="10%">通知方式：</td>
				<td>
					<input name="mess" <?php if($data["mess"] == 1): ?>checked="checked"<?php endif; ?> type="checkbox" value="1" />短信通知 
					<input name="email" <?php if($data["email"] == 1): ?>checked="checked"<?php endif; ?> type="checkbox" value="1" />E-mail通知
				</td>
				<td>说明：选择通知方式时，相应的接口必须设置，否则不生效！</td>
			</tr>
			<tr>
				<td colspan="3">短信接口设置</td>
			</tr>
			<tr>
				<td>短信平台</td>
				<td colspan="2"><a href="http://web.cr6868.com/">接口平台</a></td>
			</tr>
			<tr>
				<td>账号/识别号：</td>
				<td>
					<input type="text" id="Mess_user" name="Mess_user" value="<?php echo ($data["Mess_user"]); ?>" />
				</td>
				<td>注：账号由平台提供！</td>
			</tr>
			<tr>
				<td>密码：</td>
				<td>
					<input type="password" id="Mess_pwd"   name="Mess_pwd"  value="<?php echo ($data["Mess_pwd"]); ?>" />
				</td>
				<td>注：密码由平台提供！</td>
			</tr>
			<tr>
				<td>接收手机号：</td>
				<td>
					<input type="text" id="ctelnum"  name="ctelnum" value="<?php echo ($data["ctelnum"]); ?>" />
				</td>
				<td>
					<input type="button" id="ctel" onclick="Tomessage()" value="测试" />
				</td>
			</tr>

			<tr>
				<td colspan="3">E-mail接口设置</td>
			</tr>
			<tr>
				<td>服务器(smtp):</td>
				<td>
					<input type="text" name="SMTP_HOST" value="<?php echo ($data["SMTP_HOST"]); ?>" />
				</td>
				<td>如：smtp.163.com</td>
			</tr>
			<tr>
				<td>端口号:</td>
				<td>
					<input type="text" name="SMTP_PORT" value="<?php echo ($data["SMTP_PORT"]); ?>" />
				</td>
				<td>如：大多默认25</td>
			</tr>
			<tr>
				<td>发件人邮箱:</td>
				<td>
					<input type="text" name="FROM_EMAIL" value="<?php echo ($data["FROM_EMAIL"]); ?>" />
				</td>
				<td>如：发件人邮箱uesrname@163.com</td>
			</tr>
			<tr>
				<td>账号：</td>
				<td>
					<input type="text" name="SMTP_USER" value="<?php echo ($data["SMTP_USER"]); ?>" />
				</td>
				<td>注：账号由平台提供！</td>
			</tr>
			<tr>
				<td>密码：</td>
				<td>
					<input type="password" name="SMTP_PASS" value="<?php echo ($data["SMTP_PASS"]); ?>" />
				</td>
				<td>注：密码由平台提供！</td>
			</tr>
			<tr>
				<td>接收邮箱：</td>
				<td>
					<input type="text" name="TO_EMAIL" value="<?php echo ($data["TO_EMAIL"]); ?>"/>
				</td>
				<td>
					<a href="<?php echo U(GROUP_NAME . '/Message/ToEmail');?>">测试</a>
				</td>
			</tr>

			<tr>
				<td colspan="3" align="center">
					<input type="submit" value="保存" />
				</td>
			</tr>
		</table>
	</form>
</body>
</html>
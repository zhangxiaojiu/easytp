<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/public.css" />
</head>
<body>
	<form action="<?php echo U(GROUP_NAME .'/User/RunEditUser');?>" method="post">
		<table class="table">
			<tr>
				<td align="right">用户名：</td>
				<td><?php echo ($user["username"]); ?></td>
			</tr>
			<tr>
				<td align="right">密码：</td>
				<td>
					<input type="password" name="password" />
				</td>
			</tr>
			<tr>
				<td align="right">再次密码：</td>
				<td>
					<input type="password" name="twopassword" />
					<input type="hidden" name="id" value="<?php echo ($user["id"]); ?>"/>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" value="保存" />
				</td>
			</tr>
		</table>
	</form>
</body>
</html>
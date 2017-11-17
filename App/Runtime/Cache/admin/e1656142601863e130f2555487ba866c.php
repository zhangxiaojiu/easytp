<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>修改广告</title>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/public.css" />
</head>
<body>
	<form action="<?php echo U(GROUP_NAME.'/Adv/RunEditAd');?>" method="post" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<td colspan="2">修改广告</td>
			</tr>
			<tr>
				<td width="20%">广告描述：</td>
				<td>
					<input type="hidden" name="id" value="<?php echo ($ad["id"]); ?>" />
					<input type="text" name="title" value="<?php echo ($ad["title"]); ?>" />
				</td>
			</tr>
			<tr>
				<td>广告内容：</td>
				<td>
					<input type="file" name="img"/>
					<img src="<?php echo ($ad["img"]); ?>" width="200"/>
				</td>
			</tr>
			<tr>
				<td width="20%">广告链接：</td>
				<td>
					<input type="text" name="link" value="<?php echo ($ad["link"]); ?>" />
				</td>
			</tr>
			<tr>
				<td align="center" colspan="2">
					<input type="submit" value="保存" />
				</td>
			</tr>

		</table>
	</form>
</body>
</html>
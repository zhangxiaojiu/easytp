<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>添加栏目</title>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/public.css" />
</head>
<body>
	<form action="<?php echo U(GROUP_NAME . '/Cate/RunAddCate');?>" method="post">
		<table class="table">
			<tr>
				<td colspan="2">添加栏目</td>
			</tr>
			<tr>
				<th>栏目名称：</th>
				<td><input type="text" name="catename" /></td>
			</tr>
			<tr>
				<th>模板类型：</th>
				<td>
					<select name="lid">
						<option value="0">文章类目</option>
						<option value="1">单网页</option>
						<option value="2">图片类型</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>排序：</th>
				<td>
					<input type="text" name="sort" />
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="hidden" name="pid" value="<?php echo ($pid); ?>" />
					<input type="submit" value="保存" />
				</td>
			</tr>
		</table>
	</form>
</body>
</html>
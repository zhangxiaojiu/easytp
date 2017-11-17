<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/public.css" />
</head>
<body>
	<table class="table">
		<tr align="center">
			<td width="5%">代理商名称</td>
			<td width="8%">品牌产品</td>
			<td width="10%">对接业务经理</td>
			<td width="10%">投诉详情</td>
			<td width="10%">相关图片</td>
			<td width="15%">投诉时间</td>
		</tr>
		<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr align="center">
				<td><?php echo ($v["name"]); ?></td>
				<td><?php echo ($v["brand"]); ?></td>
				<td><?php echo ($v["manager"]); ?></td>
				<td><?php echo ($v["detail"]); ?></td>
				<td><a href="<?php echo ($v["images"]); ?>"><img style="height: 50px;" src='<?php echo ($v["images"]); ?>'/></a></td>
				<td><?php echo ($v["date"]); ?></td>
			</tr><?php endforeach; endif; ?>
	</table>
</body>
</html>
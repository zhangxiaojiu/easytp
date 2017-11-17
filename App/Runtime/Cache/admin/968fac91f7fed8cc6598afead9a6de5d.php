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
			<td width="5%">序号</td>
			<td width="8%">称呼</td>
			<td width="10%">联系方式</td>
			<td width="10%">类型</td>
			<td width="10%">来源</td>
		
			<td width="15%">留言时间</td>
		</tr>
		<?php if(is_array($mess)): foreach($mess as $key=>$v): ?><tr align="center">
				<td><?php echo ($v["id"]); ?></td>
				<td><?php echo ($v["name"]); ?></td>
				<td><?php echo ($v["tel"]); ?></td>
				<td><?php echo ($v["type"]); ?></td>
				<td><?php echo ($v["region"]); ?></td>
				
				<td><?php echo (date('Y-m-d H:i',$v["addtime"])); ?></td>
			</tr><?php endforeach; endif; ?>
	</table>
</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>轮播管理</title>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/public.css" />
</head>
<body>
	<table class="table">
		<tr>
			<td colspan="4">[<a href="<?php echo U(GROUP_NAME.'/Adv/AddAd');?>">添加轮播</a>]</td>
		</tr>
		<tr align="center">
			<td width="5%">序号</td>
			<td width="15%">描述</td>
			<td width="30%">内容</td>
			<td width="15%">链接</td>
			<td width="15%">添加时间</td>
			<td>操作</td>
		</tr>
		<?php if(is_array($ad)): foreach($ad as $key=>$v): ?><tr align="center">
				<td><?php echo ($v["id"]); ?></td>
				<td><?php echo ($v["title"]); ?></td>
				<td>
					<img src="<?php echo ($v["img"]); ?>" width="300"/>
				</td>
				<td><?php echo ($v["link"]); ?></td>
				<td><?php echo (date('Y-m-d H:i',$v["addtime"])); ?></td>
				<td>
					[<a href="<?php echo U(GROUP_NAME.'/Adv/EditAd',array('id'=>$v['id']));?>">修改</a>]
					[<a href="<?php echo U(GROUP_NAME.'/Adv/DelAd',array('id'=>$v['id']));?>">删除</a>]
				</td>
			</tr><?php endforeach; endif; ?>
	</table>
</body>
</html>
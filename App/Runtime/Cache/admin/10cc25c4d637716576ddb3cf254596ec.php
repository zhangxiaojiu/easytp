<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>文章列表</title>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/public.css" />
</head>
<body>
	<table class="table">
		<tr>
			<td colspan="6">文章列表</td>
		</tr>
		<tr>
			<form action="<?php echo U(GROUP_NAME . '/News/index');?>" method="post">
				<td colspan="6">
					<select name="sea_cid">
						<option value="0">===请选择分类===</option>
						<?php if(is_array($cate)): foreach($cate as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["html"]); echo ($v["catename"]); ?></option><?php endforeach; endif; ?>
					</select>
					<input type="submit" value="搜索" />
				</td>
			</form>
		</tr>
		<tr align="center">
			<td width="5%">序号</td>
			<td width="40%">标题</td>
			<td width="20%">所属分类</td>
			<td width="10%">缩略图</td>
			<td widht="10%">刷新时间</td>
			<td width="15%">操作</td>
		</tr>
		<?php if(is_array($news)): foreach($news as $key=>$v): ?><tr align="center">
				<td><?php echo ($v["id"]); ?></td>
				<td><?php echo ($v["title"]); ?></td>
				<td><?php echo ($v["catename"]); ?></td>
				<td><a href="<?php echo ($v["simage"]); ?>"><img src="<?php echo ($v["simage"]); ?>" width="40" /></a></td>
				<td><?php echo (date('Y-m-d H:i',$v["uptime"])); ?></td>
				<td>
					<?php if(ACTION_NAME == "BackNews"): ?>[<a href="<?php echo U(GROUP_NAME . '/News/operNew',array('op' => 'reduction','id' => $v['id']));?>">还原</a>]
						[<a href="<?php echo U(GROUP_NAME . '/News/operNew',array('op'=>'delete','id'=>$v['id']));?>">彻底删除</a>]
					<?php else: ?>
						[<a href="<?php echo U(GROUP_NAME . '/News/operNew',array('op'=>'edit','id'=>$v['id']));?>">修改</a>]
						[<a href="<?php echo U(GROUP_NAME . '/News/operNew',array('op' => 'refresh','id' => $v['id']));?>">刷新</a>]
						[<a href="<?php echo U(GROUP_NAME . '/News/operNew',array('op'=>'del','id'=>$v['id']));?>">删除</a>]<?php endif; ?>
				</td>
			</tr><?php endforeach; endif; ?>
	</table>
</body>
</html>
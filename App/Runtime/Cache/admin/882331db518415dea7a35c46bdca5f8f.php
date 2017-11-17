<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/public.css" />
</head>
<body>
	<table class="table">
		<tr>
			<td colspan="4">
				[<a href="<?php echo U(GROUP_NAME . '/User/AddUser');?>">添加管理员</a>]
			</td>
		</tr>
		<tr>
			<td width="20%" align="center">用户名</td>
			<td width="20%" align="center">登陆时间</td>
			<td width="20%" align="center">登陆ip</td>
			<td width="40%" align="center">操作</td>
		</tr>
		<?php if(is_array($user)): foreach($user as $key=>$v): ?><tr>
				<td align="center"><?php echo ($v["username"]); ?></td>
				<td align-"center"><?php echo (date('Y-m-d H:i:s',$v["logintime"])); ?></td>
				<td align="center"><?php echo ($v["loginip"]); ?></td>
				<td>
					[<a href="<?php echo U(GROUP_NAME . '/User/editUser',array('id'=>$v['id']));?>">修改密码</a>]
					[<a href="<?php echo U(GROUP_NAME . '/User/DelUser',array('id'=>$v['id']));?>">删除</a>]
				</td>
			</tr><?php endforeach; endif; ?>
	</table>
</body>
</html>
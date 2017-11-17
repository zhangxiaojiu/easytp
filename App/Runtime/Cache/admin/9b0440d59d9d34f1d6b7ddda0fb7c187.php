<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>栏目列表</title>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/public.css" />
</head>
<body>
	<form action="<?php echo U(GROUP_NAME . '/Cate/orderCate');?>" method="post">
		<table class="table">
			<tr>
				<td width="5%" align="center">排序</td>
				<td width="40%" align="center">栏目名称</td>
				<td width="50%" align="center">操作</td>
			</tr>
			<?php if(is_array($cate)): foreach($cate as $key=>$v): ?><tr>
					<td>
						<input type="text" style="width:60%" name="order" value="<?php echo ($v["sort"]); ?>" />
					</td>
					<td><?php echo ($v["html"]); echo ($v["catename"]); ?></td>
					<td>
						[<a href="<?php echo U(GROUP_NAME . '/Cate/AddCate',array('pid' => $v['id']));?>">添加子分类</a>]
						<?php if($v['lid'] == 1): ?>[<a href="<?php echo U(GROUP_NAME . '/News/Webhtml',array('id' => $v['id']));?>">修改网页内容</a>]<?php endif; ?>
						[<a href="<?php echo U(GROUP_NAME . '/Cate/editCate',array('id' => $v['id']));?>">修改</a>]
						[<a href="<?php echo U(GROUP_NAME . '/Cate/delCate',array('id' => $v['id']));?>">删除</a>]
					</td>
				</tr><?php endforeach; endif; ?>
		</table>
	</form>
</body>
</html>
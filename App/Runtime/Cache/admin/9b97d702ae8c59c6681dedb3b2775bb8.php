<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<title>YCMS-后台管理</title>
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/index.js"></script>
<link rel="stylesheet" href="__PUBLIC__/Css/public.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/index.css" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<base target="iframe"/>
<head>
</head>
<body>
	<div id="top">
		<!--<div class="menu">
			<a href="#">选择按钮</a>
			<a href="#">选择按钮</a>
			<a href="#">选择按钮</a>
			<a href="#">选择按钮</a>
			<a href="#">选择按钮</a>
		</div>-->
		<div class="exit">
			<span style="color:#f40;"><?php echo ($_SESSION['username']); ?> ,</span> 你好！
			<a href="<?php echo U(GROUP_NAME . '/Index/LoginOut');?>" target="_self">退出</a>
			<a href="/index.php" target="_blank">前端首页</a>
		</div>
	</div>
	<div id="left">
		<dl>
			<dt>网站配置</dt>
			<dd><a href="<?php echo U(GROUP_NAME . '/Set/index');?>">基本配置</a></dd>
			<dd><a href="<?php echo U(GROUP_NAME . '/User/index');?>">管理员设置</a></dd>
			<dd><a href="<?php echo U(GROUP_NAME . '/Adv/index');?>">轮播管理</a></dd>
			<dd><a href="<?php echo U(GROUP_NAME . '/Set/cache');?>">清除缓存</a></dd>
		</dl>
		<dl>
			<dt>栏目设置</dt>
			<dd><a href="<?php echo U(GROUP_NAME . '/Cate/index');?>">栏目列表</a></dd>
			<dd><a href="<?php echo U(GROUP_NAME .'/Cate/AddCate');?>">添加栏目</a></dd>
		</dl>
		<dl>
			<dt>文章设置</dt>
			<dd><a href="<?php echo U(GROUP_NAME . '/News/index');?>">文章列表</a></dd>
			<dd><a href="<?php echo U(GROUP_NAME . '/News/Html');?>">单网页</a></dd>
			<dd><a href="<?php echo U(GROUP_NAME . '/News/addNews');?>">添加文章</a></dd>
			<dd><a href="<?php echo U(GROUP_NAME . '/News/BackNews');?>">回收站</a></dd>
		</dl>
		<dl>
			<dt>留言板</dt>
			<dd><a href="<?php echo U(GROUP_NAME . '/Message/index');?>">通知设置</a></dd>
			<dd><a href="<?php echo U(GROUP_NAME . '/Message/MessList');?>">留言列表</a></dd>
		</dl>
	</div>
	<div id="right">
		<iframe name="iframe" src="<?php echo U(GROUP_NAME .'/Set/lead');?>">
		</iframe>
	</div>
</body>
</html>
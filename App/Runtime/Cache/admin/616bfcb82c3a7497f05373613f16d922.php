<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>站点设置</title>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/public.css" />
</head>
<body>
	<form action="<?php echo U(GROUP_NAME . '/Set/Addset');?>" method="post" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<td colspan="3">网站配置设置</td>
			</tr>
			<tr>
				<th>网站名称：</th>
				<td width="50%"><input type="text" name="webname" value="<?php echo ($set["webname"]); ?>" class="len400"/></td>
				<td>如：四川科美诺信息技术有限公司</td>
			</tr>
			<tr>
				<th>网站LOGO：</th>
				<td width="50%"><input type="file" name="logo" /></td>
				<td><img src="<?php echo ($set["logo"]); ?>" width="40"/><input type="hidden" value="<?php echo ($set["logo"]); ?>" name="blogo" /></td>
			</tr>
			<tr>
				<th>站点域名：</th>
				<td><input type="text" name="weburl" value="<?php echo ($set["weburl"]); ?>"  class="len400" /></td>
				<td>如：http://www.sckemeinuo.com</td>
			</tr>
			<tr>
				<th>关键字：</th>
				<td><input type="text" name="keyword" value="<?php echo ($set["keyword"]); ?>"  class="len400"/></td>
				<td>如：第三方支付,网站建设。以“,”隔开</td>
			</tr>
			<tr>
				<th>网站描述：</th>
				<td><input type="text" name="description" value="<?php echo ($set["description"]); ?>"  class="len400" /></td>
				<td>如：四川科美诺信息技术有限公司是一家专注于第三方支付行业的网络公司！</td>
			</tr>
			<tr>
				<th>联系电话：</th>
				<td><input type="text" name="telnum" value="<?php echo ($set["telnum"]); ?>"  class="len400"/></td>
				<td>如：152-8100-9455</td>
			</tr>
			<tr>
				<th>联系地址：</th>
				<td><input type="text" name="access" value="<?php echo ($set["access"]); ?>"  class="len400"/></td>
				<td>如：环球广场2302</td>
			</tr>
			<tr>
				<th>ICP备案号：</th>
				<td><input type="text" name="icpnum" value="<?php echo ($set["icpnum"]); ?>" class="len400"/></td>
				<td>如：川ICP备123456号</td>
			</tr>
			<tr>
				<th>第三方统计：</th>
				<td><input type="text" name="tongji" value="<?php echo ($set["tongji"]); ?>"  class="len400"/></td>
				<td>如：<a href="http://tongji.baidu.com">百度统计</a>
				<a href="http://51.la">51la统计</a>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<input type="submit" value="保存" />
				</td>
			</tr>
		</table>
	</form>
</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>添加文章</title>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/public.css" />
	<script type="text/javascript">
		window.UEDITOR_HOME_URL = '__ROOT__/date/Ueditor/';
		window.onload = function(){
			window.UEDITOR_CONFIG.initialFrameHeight = 400;
			UE.getEditor('content');
		}
	</script>
	<script type="text/javascript" src="__ROOT__/date/Ueditor/ueditor.config.js"></script>
	<script type="text/javascript" src="__ROOT__/date/Ueditor/ueditor.all.min.js"></script>
</head>
<body>
	<form action="<?php echo U(GROUP_NAME . '/News/RunAddNews');?>" method="post" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<td colspan="2"><strong>添加文章</strong></td>
			</tr>
			<tr>
				<td width="100" align="right" >标题：</td>
				<td>
					<input type="text" name="title" <?php if($news["lid"] == 1): ?>value="<?php echo ($news["title"]); ?>" readOnly="true"<?php endif; ?> />
				</td>
			</tr>
			<?php if($news["lid"] == 1): ?><input type="hidden" name="lid" value="1" />
				<input type="hidden" name="cid" value="<?php echo ($news["cid"]); ?>" />
			<?php else: ?>
				<tr>
					<td align="right">所属栏目</td>
					<input type="hidden" name="lid" value="0" />
					<td>
						<select name="cid">
							<option value="0" id="0">===请选择栏目===</option>
							<?php if(is_array($cate)): foreach($cate as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>" id="<?php echo ($v["id"]); ?>"><?php echo ($v["html"]); echo ($v["catename"]); ?></option><?php endforeach; endif; ?>
						</select>
					</td>
				</tr><?php endif; ?>
			<tr>
				<td align="right">缩略图：</td>
				<td><input type="file" name="simage" /></td>
			</tr>
			<tr>
				<td colspan="2">
					<textarea name="content" id="content"></textarea>
				</td>
			</tr>
			<tr>
				<td align='center' colspan="2">
					<input type="submit" value="保存"/>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>
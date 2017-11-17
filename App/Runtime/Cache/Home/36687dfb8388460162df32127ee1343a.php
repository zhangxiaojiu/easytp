<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>四川科美诺代理商投诉入口</title>
  <style type="text/css">
    form input{display: block; width:80%; height:120px; margin:80px auto; font-size: 60px; border-radius: 10px; padding-left:10px;}
    form textarea,div{display: block; width:80%; height:320px; margin:80px auto; font-size: 60px; border-radius: 10px; padding-left:10px;}
    form .btn{background: red; color:#fff;}

  </style>
</head>
<body style="background: #e6e6e6; width:100%;">
  <img style="width:30%; display: block; margin:50px auto; " src="/upload/images/logo.png">
  <h3 style="font-size: 60px; text-align: center;">四川科美诺代理商投诉入口</h3>
  <form style="padding:20px; margin:10px auto;" method="post" action="/index.php/home/index/doComplaint" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="代理商名称" required="required">
    <input type="text" name="brand" placeholder="品牌产品" required="required">
    <input type="text" name="manager" placeholder="对接业务经理" required="required">
    <textarea placeholder="投诉详情" name="detail"></textarea></div>
    <div>相关图片：<input type="file" placeholder="相关图片" name="img">
    <input class="btn" type="submit" value="提交">
  </form>
</body>
</html>
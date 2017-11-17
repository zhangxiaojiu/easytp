<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>拉卡拉收款宝招商发布会(杭州站)</title>
  <style type="text/css">
    form input{display: block; width:80%; height:120px; margin:80px auto; font-size: 60px; border-radius: 10px; padding-left:10px;}
    form select{display: block; width:80%; height:120px; margin:80px auto; font-size: 60px; border-radius: 10px; padding-left:10px;}
    form .btn{background: red; color:#fff;}

  </style>
</head>
<body style="background: #e6e6e6; width:100%;">
  <img style="width:70%; display: block; margin:50px auto; " src="/upload/images/web/logo.png">
  <h3 style="font-size: 60px; text-align: center;">拉卡拉收款宝招商发布会(杭州站)</h3>
  <form style="padding:20px; margin:10px auto;" method="post" action="/index.php/home/message/addmess">
    <input type="text" name="tel" placeholder="手机号" required="required">
    <input type="text" name="name" placeholder="姓名" required="required">
    

    <input class="btn" type="submit" value="签到">
    <input  type="hidden" name="type" value="2">
  </form>
  <!-- <img style="width:60%; display: block; margin:50px auto;" src="/upload/images/web/freetext.png"> -->
 <!--  <h3 style="text-align: center;">咨询电话:02867871580</h3> -->
</body>
</html>
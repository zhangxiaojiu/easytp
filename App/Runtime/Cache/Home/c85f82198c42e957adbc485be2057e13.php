<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="keywords" content="<?php echo ($web["keyword"]); ?>" />
<meta name="description" content="<?php echo ($web["description"]); ?>"	 />

<title><?php echo ($web["webname"]); ?></title>
<link href="__PUBLIC__/images/favicon.ico" rel="icon" type="image/x-icon" />
	
<link href="__PUBLIC__/css/main.css" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/css/base.css" rel="stylesheet" type="text/css">
<link href="__PUBLIC__/css/layout.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>

<script type="text/javascript" src="__PUBLIC__/js/Banner.js"></script>

<script type="text/javascript" src="__PUBLIC__/js/Slide.js"></script>


</head>

<body>


<div class="public_head">

	<div class="logo"><a href="/"><img style="height:60px" src="<?php echo ($web["logo"]); ?>" /></a></div>

	<div class="menu">

		<ul id="nav" class="public_nav clearfix">

        <li class="nLi">

          <h3><a href="/">首页</a></h3>

        </li>
        <li class="nLi">

          <h3><a href="/index.php/index/about">关于我们</a></h3>

        </li>

        <li class="nLi">

          <h3><a href="/index.php/index/lianxi">联系我们</a></h3>

        </li>
        <li class="nLi">

          <h3><a href="/index.php/index/jiaru">加入我们</a></h3>

        </li>




<!--         <li class="nLi">

          <h3><a href="/index.php/index/about">关于我们</a></h3>
          <ul class="sub">
            <li><a href="/index.php/index/about">公司简介</a></li>
            
            <li><a href="/index.php/index/lianxi">联系方式</a></li>
            <li><a href="/index.php/index/jiaru">加入我们</a></li>
           
          </ul>
        </li> -->

      </ul>
			<script type="text/javascript">

				jQuery("#nav").slide({ 

					type:"menu",// 效果类型，针对菜单/导航而引入的参数（默认slide）

					titCell:".nLi", //鼠标触发对象

					targetCell:".sub", //titCell里面包含的要显示/消失的对象

					effect:"slideDown", //targetCell下拉效果

					delayTime:300 , //效果时间

					triggerTime:0, //鼠标延迟触发时间（默认150）

				});

			</script>

	</div>

	<div class="bk3"></div>

</div>
<link href="__PUBLIC__/css/wapadd-main.css" rel="stylesheet">
<link href="__PUBLIC__/css/responsive.css" rel="stylesheet">
<link rel="stylesheet" href="__PUBLIC__/css/public_head.css" type="text/css" />

<!-- content start -->
<div class="Layout" style="padding: 0;">
<div class="content">
  <div class="locationBox">
  <div class="container">
  <i class="fa fa-home"></i><a href="index.html">首页</a>&nbsp;&nbsp;><a href="" title=""><?php echo ($about["title"]); ?></a>  </div>
  </div>
  <div class="con_Box">
  <div class="container clearfix">
    <!-- left about -->
    <div class="con_Left">
    <div class="mod_NavL">
      <div class="title"><i class="fa fa-angle-down"></i></div>
      <ul class="reset">
    
          <li 
    class="active"
            ><a href="about.html"><i class="fa fa-angle-right"></i><?php echo ($about["title"]); ?></a></li>
     

           
      
      </ul>
    </div>
    </div>    <!-- over -->
    <div class="con_Right">
      <div class="conR_title">
<?php echo ($about["title"]); ?>      </div>
      <div class="contact_Box">
        <?php echo ($about["content"]); ?>     
      </div>
    </div>
  </div>
  </div>
</div>
</div>
<!-- content end --> 
<div class="public_footer">

	<div class="w1200 pt30">

		<div class="foot_left">

			

			<div class="clear"></div>

			<div class="foot_title">

				<ul class="foot_t">

					<li>联系电话:&nbsp;<?php echo ($web["telnum"]); ?></li>
				</ul>

			</div>

			<div class="foot_copyright"><a href="/index.php/index/lianxi" title="四川科美诺信息科技有限公司" target="_blank">联系地址:&nbsp;<?php echo ($web["access"]); ?></a> <br /><a href="http://www.miibeian.gov.cn/" title="四川科美诺网站备案" target="_blank"><?php echo ($web["icpnum"]); ?></a></div>

			<div class="clear"></div>

		</div>

		<div class="foot_erweima"><img style="width:110px; height:110px;" src="__PUBLIC__/images/ercode.jpeg" alt="四川科美诺二维码" title="扫描四川科美诺二维码有惊喜"><br />四川科美诺官方微信</div>

	</div>
	<?php echo ($web["tongji"]); ?>
	<div class="clear pb30"></div>

</div>

<!-- 
<style>
		@charset "utf-8";

		#box-kefu { position: fixed; right: 0; top: 30%; z-index: 999; _position: absolute; _top: expression(eval(document.documentElement.scrollTop+100)); }
		#box-kefu .kefu-open { position: absolute; top: 0; right: 0; width: 60px;  overflow: hidden; width: 0;}
		#box-kefu .kefu-open .close{ display: block; position: absolute; width: 22px; height: 22px; right: 0; top: 0; text-indent: -9999px; background: url(../images/close.png) no-repeat; }
		#box-kefu .kefu-open div { padding-bottom: 5px; width: 88px; }
		#box-kefu .kefu-open ul { margin:0px; padding:0px}
		#box-kefu .kefu-open li { margin-bottom: 3px; list-style:none}
		#box-kefu .kefu-open li a {display: block;height: 60px;width: 60px;background: url(/upload/images/qtitle1.png) no-repeat; background-size: 60px; text-align: center; text-decoration:none}
		#box-kefu .kefu-open li a.q2{background: url(/upload/images/qtitle2.png) no-repeat; background-size: 60px;}
		#box-kefu .kefu-open li a.q3{background: url(/upload/images/qtitle3.png) no-repeat; background-size: 60px;}
		#box-kefu .kefu-open li a.q4{background: url(/upload/images/qtitle4.png) no-repeat; background-size: 60px;}
		#box-kefu .kefu-open li a span{ color: #fff; padding-top: 40px; display: block; font-size: 12px;}
		#box-kefu .kefu-open li a:hover { text-decoration: none; }
		#box-kefu .kefu-close { position: absolute; top: 0px; right: 0px; width: 40px; height: 107px; padding: 5px 0 5px 0px; cursor: pointer; overflow: hidden; background: url(../images/qtitle.png)  #fff right center no-repeat; }

	</style>
	<div id="box-kefu">
	   
	    <div class="kefu-open" style="width:60px;">
	        <div>
	        <ul>
	            
	        <li><a class="q1" href="tencent://message/?uin=274276153&amp;Site=&amp;Menu=yes" ><span>服务咨询</span></a></li>
	        
	        
	        <li><a class="q2" href="tencent://message/?uin=274276153&amp;Site=&amp;Menu=yes" ><span>服务购买</span></a></li>
	        
	        
	        <li><a class="q3" href="tencent://message/?uin=274276153&amp;Site=&amp;Menu=yes" ><span>售后支持</span></a></li>
	        
	        
	        <li><a class="q4" href="tel:15281009455" ><span>电话咨询</span></a></li>
	        
	        
	            
	        </ul>
	        </div>
	    </div>
	</div> -->
</body>

</html>
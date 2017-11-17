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

          <h3><a href="/index.php/index/加入">加入我们</a></h3>

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
<div class="Layout" style="padding:0;">
<div class="content">
  <div class="locationBox">
  <div class="container">
  <i class="fa fa-home"></i><a href="index.html">首页</a>&nbsp;&nbsp;><a href="about.html" title="关于">关于</a>><a href="lianxi.html" title="公司简介">联系方式</a>  </div>
  </div>
  <div class="con_Box">
  <div class="container clearfix">
<!--left news  -->
<div class="con_Left">
      <div class="mod_NavL" id="newsNav">
        <div class="title"><i class="fa fa-angle-down"></i>
		联系        </div>
        <ul class="reset">
		
          <li 
    class="active"
            ><a href="about.html"><i class="fa fa-angle-right"></i>公司简介</a></li>
     
          <li 
          ><a href="lianxi.html"><i class="fa fa-angle-right"></i>联系方式</a></li>
           
        </ul>
      </div>
</div><!-- over -->
    <div class="con_Right">
      <div class="conR_title">
联系方式      </div>
      <div class="contact_Box">
        <style type="text/css">       .iw_poi_title {color:#CC5522;font-size:14px;font-weight:bold;overflow:hidden;padding-right:13px;white-space:nowrap;}        .iw_poi_content {font:12px arial,sans-serif;overflow:visible;padding-top:4px;white-space:-moz-pre-wrap;word-wrap:break-word;}       </style>

<div style="width:100%px;height:300px;border:#ccc solid 1px;" id="dituContent">
</div>
<div id="allmap">

</div>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=tUnx9TmY9OLG3ViAtHRa4rNk"></script>
	<script type="text/javascript" src="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.js"></script>
	<link rel="stylesheet" href="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.css" />
	<script type="text/javascript">
		// 百度地图API功能
	    var map = new BMap.Map('dituContent');
	    var poi = new BMap.Point(104.055049,30.689725);
	    map.centerAndZoom(poi, 16);
	    map.enableScrollWheelZoom();

	    var content = '<div style="margin:0;line-height:20px;padding:2px;">' +
	                    '<img src="__PUBLIC__/images/baidu.png" alt="" style="float:right;zoom:1;overflow:hidden;width:100px;height:100px;margin-left:3px;">' +
	                    '地址：成都市金牛区环球广场<br/>电话：15281009455<br/>简介：环球广场' +
	                  '</div>';

	    //创建检索信息窗口对象
	    var searchInfoWindow = null;
		searchInfoWindow = new BMapLib.SearchInfoWindow(map, content, {
				title  : "环球广场",      //标题
				width  : 290,             //宽度
				height : 105,              //高度
				panel  : "panel",         //检索结果面板
				enableAutoPan : true,     //自动平移
				searchTypes   :[
					BMAPLIB_TAB_SEARCH,   //周边检索
					BMAPLIB_TAB_TO_HERE,  //到这里去
					BMAPLIB_TAB_FROM_HERE //从这里出发
				]
			});
	    var marker = new BMap.Marker(poi); //创建marker对象
	    marker.enableDragging(); //marker可拖拽
	    marker.addEventListener("click", function(e){
		    searchInfoWindow.open(marker);
	    })
	    map.addOverlay(marker); //在地图中添加marker
		//样式1
		var searchInfoWindow1 = new BMapLib.SearchInfoWindow(map, "信息框1内容", {
			title: "信息框1", //标题
			panel : "panel", //检索结果面板
			enableAutoPan : true, //自动平移
			searchTypes :[
				BMAPLIB_TAB_FROM_HERE, //从这里出发
				BMAPLIB_TAB_SEARCH   //周边检索
			]
		});
		function openInfoWindow1() {
			searchInfoWindow1.open(new BMap.Point(104.055049,30.689725));
		}
		//样式2
		var searchInfoWindow2 = new BMapLib.SearchInfoWindow(map, "信息框2内容", {
			title: "信息框2", //标题
			panel : "panel", //检索结果面板
			enableAutoPan : true, //自动平移
			searchTypes :[
				BMAPLIB_TAB_SEARCH   //周边检索
			]
		});
		function openInfoWindow2() {
			searchInfoWindow2.open(new BMap.Point(104.055049,30.689725));
		}
		//样式3
		var searchInfoWindow3 = new BMapLib.SearchInfoWindow(map, "信息框3内容", {
			title: "信息框3", //标题
			width: 290, //宽度
			height: 40, //高度
			panel : "panel", //检索结果面板
			enableAutoPan : true, //自动平移
			searchTypes :[
			]
		});
		function openInfoWindow3() {
			searchInfoWindow3.open(new BMap.Point(104.055049,30.689725)); 
		}
	</script>
	<p>
		<br />
	</p>
	<p>
		<br />
	</p>
	
<!-- 文字块基本信息 -->
	<h4>四川科美诺信息技术有限公司</h4><p><br /></p><p>地址：<?php echo ($web["access"]); ?></p><p>公司座机：<?php echo ($web["telnum"]); ?></p><!-- over -->
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
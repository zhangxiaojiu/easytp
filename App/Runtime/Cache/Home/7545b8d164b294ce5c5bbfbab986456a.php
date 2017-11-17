<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-CN"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="<?php echo ($web["description"]); ?>">
    <meta name="keywords" content="<?php echo ($web["keyword"]); ?>">
    <link rel="icon" href="__PUBLIC__/images/favicon.ico">

    <title><?php echo ($web["webname"]); ?></title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="__PUBLIC__/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="__PUBLIC__/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="__PUBLIC__/css/carousel.css" rel="stylesheet">
  </head>
<!-- NAVBAR
================================================== -->
  <body>
    <div class="navbar-wrapper">
      <div class="container">

        <nav class="navbar navbar-inverse navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="./"><img style="height:100%;" src="__PUBLIC__/images/web/logo.png"></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="/">主页</a></li>
                <li><a href="#about">关于我们</a></li>
                <li><a href="#connect">联系我们</a></li>
                <li><a href="#join">加入我们</a></li>
                <li class="dropdown hidden">
                  <a href="http://v3.bootcss.com/examples/carousel/#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">dropdown <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="http://v3.bootcss.com/examples/carousel/#">Action</a></li>
                    <li><a href="http://v3.bootcss.com/examples/carousel/#">Another action</a></li>
                    <li><a href="http://v3.bootcss.com/examples/carousel/#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li class="dropdown-header">Nav header</li>
                    <li><a href="http://v3.bootcss.com/examples/carousel/#">Separated link</a></li>
                    <li><a href="http://v3.bootcss.com/examples/carousel/#">One more separated link</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>

      </div>
    </div>


    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class=""></li>
        <li data-target="#myCarousel" data-slide-to="1" class=""></li>
        <li data-target="#myCarousel" data-slide-to="2" class="active"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img class="first-slide" src="__PUBLIC__/images/web/banner/1.jpg" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Welcome to sckemeinuo</h1>
              <p>欢迎来到四川科美诺信息技术有限公司</p>
              <p><a class="btn btn-lg btn-primary" href="#about" role="button">了解更多</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="second-slide" src="__PUBLIC__/images/web/banner/2.jpg" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>不止于支付</h1>
              <p>Not only pay</p>
              <p><a class="btn btn-lg btn-primary" href="#about" role="button">了解更多</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="third-slide" src="__PUBLIC__/images/web/banner/3.jpg" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>“服务”才是最重要的</h1>
              <p>The most important is "service"</p>
              <p><a class="btn btn-lg btn-primary" href="#about" role="button">了解更多</a></p>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="http://v3.bootcss.com/examples/carousel/#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="http://v3.bootcss.com/examples/carousel/#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- /.carousel -->


    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div class="row" id="about">
      	<div style="text-align: center; margin:50px auto;">
      		<h3>关于四川科美诺<br/>ABOUT US</h3>
      		<p>
      			　　四川科美诺信息技术有限公司（简称“科美诺”）是乐富、中汇、汇付天下、易宝支付、瀚银、付临门、拉卡拉等多家知名支付平台共同选择的专业承接第三方支付平台市场运营外包企业，自2011年科美诺团队诞生至今，凭借行业领先的品牌市场渠道建设体系和优秀的售后保障能力，在国内市场享有着良好的口碑和较高的知名度，并且在业内率先推出让每一位客户投资放心，运营省心，收益开心的“三心服务”，坚持诚信为本、服务至上的原则，为十几家知名支付平台建立了由遍布全国各地的数千家代理商组成的庞大市场渠道，并得到了上下游客户的一致好评！
      		</p>
      	</div>
      	<hr/>
        <div class="col-lg-4">
          <img class="img-circle" src="/upload/images/EDA_2015/about_pic01.jpg" alt="Generic placeholder image" width="140" height="140">
          <h2>多年的第三方支付之路</h2>
          <p>在第三方支付领域，我们的团队从始建之初到现在一直坚定不移的向前走，我们的第三方支付行业服务在国内同类服务中具有非常成熟的业务路线和技术基础为客户的各种需求提供更专业更贴心的服务</p>
          
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="img-circle" src="/upload/images/EDA_2015/about_pic02.jpg" alt="Generic placeholder image" width="140" height="140">
          <h2>专注于服务的精神</h2>
          <p>富有经验的客服人员，为客户提供详细的咨询服务，辅助客户操作运转，包括日常运作，提供长期的技术支持服务，保障客户起步阶段顺利实施，提供全委托运维服务，为客户提供全方位技术保障服务</p>
          
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="img-circle" src="/upload/images/EDA_2015/about_pic03.jpg" alt="Generic placeholder image" width="140" height="140">
          <h2>坚持支付行业的情怀</h2>
          <p>曾经有人问我们“支付行业到底能做到什么时候”，对于这个问题我们无从回答，我们只能说“过去我们在做支付，现在我们也在做支付，未来我们一样会做支付”，我们在，支付在，没错，就是这种情怀</p>
          
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->


      <!-- START THE FEATURETTES -->

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">初始团队创建. <span class="text-muted">2011年</span></h2>
          <p class="lead">2011年，初始团队创建于河北石家庄并决定从事第三方支付行业</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive center-block" src="/upload/images/web/index/choose3pay.jpg" data-holder-rendered="true">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7 col-md-push-5">
          <h2 class="featurette-heading">科美诺成立 <span class="text-muted">2014年</span></h2>
          <p class="lead">2014年，科美诺团队正式确定，并于2015年成立于天府之国-成都</p>
        </div>
        <div class="col-md-5 col-md-pull-7">
          <img class="featurette-image img-responsive center-block" src="/upload/images/web/index/cd.jpg" data-holder-rendered="true">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">合作-拉卡拉 <span class="text-muted">2017年</span></h2>
          <p class="lead">2017年，科美诺和拉卡拉合作并取得授权成为西南运营中心</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive center-block"  src="/upload/images/web/index/lkl.jpg" data-holder-rendered="true">
        </div>
      </div>

      <hr class="featurette-divider">

      <!-- /END THE FEATURETTES -->
      <div class="row" id="join">
      	<div>
      		<h3>加入四川科美诺<br/>JOIN US</h3>
      		<img class="img-responsive " src="/upload/images/web/index/team.jpg">
      		<h5>科美诺一直致力于打造一支用心的团队</h5>
      		<p>
      			地址：成都市金牛区环球广场2312<br/>
      			<a href="TEL:18080906268" id="connect">☎️</a>：18080906268
      		</p>
      	</div>
      </div>


      <hr class="featurette-divider">

      <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#">⬆️top</a></p>
        <p>© 2017 Ke Mei Nuo Information Technology CO.,LTD </p>

    </footer></div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="__PUBLIC__/js/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="__PUBLIC__/js/ie10-viewport-bug-workaround.js"></script>
  

<svg xmlns="http://www.w3.org/2000/svg" width="500" height="500" viewBox="0 0 500 500" preserveAspectRatio="none" style="display: none; visibility: hidden; position: absolute; top: -100%; left: -100%;"><defs><style type="text/css"></style></defs><text x="0" y="25" style="font-weight:bold;font-size:25pt;font-family:Arial, Helvetica, Open Sans, sans-serif">500x500</text></svg></body></html>
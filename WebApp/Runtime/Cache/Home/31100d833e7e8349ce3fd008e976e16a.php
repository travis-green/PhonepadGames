<?php if (!defined('THINK_PATH')) exit();?>﻿<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo ($arr_seo['title']); ?></title>
<meta name="keywords" content="<?php echo ($arr_seo['key']); ?>">
<meta name="description" content="<?php echo ($arr_seo['desc']); ?>">
<meta name="viewport" content="width=device-width; initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="baidu-site-verification" content="f7nqw8YR4G" />
<link rel="shortcut icon" href="/Public/home/img/ico.jpg" type="image/x-icon">
<link rel="stylesheet" type="text/css" media="screen and (min-width:1680px) and (max-device-width: 2048px)" href="/Public/home/css/style.css" />
<link rel="stylesheet" type="text/css" media="screen and (min-width: 720px) and (max-device-width: 1680px)" href="/Public/home/css/smallScreen.css" />
<link rel="stylesheet" type="text/css" media="screen and (min-width: 0px) and (max-device-width: 720px)" href="/Public/home/css/tinyScreen.css" />
<link rel="stylesheet" type="text/css" href="/Public/home/css/musicstyle.css" />
<script type="text/javascript" src="js/myplaylist.js"></script>
<script type="text/javascript" src="../plugin/jquery-jplayer/jquery.jplayer.js"></script>
    <script type="text/javascript" src="../plugin/ttw-music-player-min.js"></script>
    <script type="text/javascript" src="/Public/home/js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="/Public/home/js/jquery.SuperSlide.2.1.2.js"></script>
    <script src="/Public/home/js/com.js"></script>
<script src="/Public/home/js/BigPicture.js"></script>


 
</head>
<body style="width:100%;height:100%;">
<div class="top-nav">
    <div class="wrap tc">
        <div class="nav">
            <ul>
                <li <?php if($action_name == 'index'): ?>class="on"<?php endif; ?>><a href="<?php echo (C("SiteUrl")); ?>">官网首页</a></li>
                <li <?php if($action_name != 'index'): ?>class="on"<?php endif; ?>><a href="<?php echo U('Index/news');?>">游戏资讯</a></li>
                <li <?php if($action_name != 'index'): ?>class="on"<?php endif; ?>><a href="http://www.phonepadgames.com">游戏攻略</a></li>
                <li <?php if($action_name != 'index'): ?>class="on"<?php endif; ?>><a href="https://tieba.baidu.com/f?ie=utf-8&kw=绝对音域&fr=search	">官方贴吧</a></li>
                <li <?php if($action_name != 'index'): ?>class="on"<?php endif; ?>><a href="http://www.phonepadgames.com">访问蜂派</a></li>
                <!--<?php if(is_array($document)): $i = 0; $__LIST__ = $document;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dc): $mod = ($i % 2 );++$i;?>-->
                <!--<li <?php if($i == 1): ?>class="spec"<?php endif; ?>><a href="<?php echo ($dc['doc_key']); ?>" target="_blank"><?php echo ($dc['doc_title']); ?></a></li>-->
                <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
            </ul>
		<span class="sign"></span>
        </div> 
    </div>
    <a><img class="logo bounceIn" src="/Uploads/<?php echo ($web_stting['site_logo']); ?>" alt="<?php echo ($web_stting['site_name']); ?>" title="<?php echo ($web_stting['site_name']); ?>"></a>

</div>
 
	<div class="wrap">
		<div class="con-box" style="background:url(/Public/home/images/list.jpg) no-repeat left top; padding:0;">
			 <img class="place glintFlash" src="/Public/home/img/xi.png">
			<div class="app-down clearfix" style="padding:490px 0 0 0">
			</div>
		</div>
	</div>

<div class="new-main" style="margin-top:3%;">	
	<div class="wrap">
		<div class="container clearfix">
 			<div class="details-main">
 				<h1 class="head"><a href="<?php echo (C("SiteUrl")); ?>">首页</a> > <a href="<?php echo U('Index/news');?>">游戏资讯</a> <?php if(count($ac_info) > 0): ?>> <?php echo ($ac_info['ac_name']); endif; ?></h1>
 				<div class="text-box">
 					<h2 class="title"><?php echo ($art_info['article_title']); ?></h2>
 					<div class="time">发布于：<span><?php echo (date('Y-m-d H:i:s',$art_info['article_time'])); ?></span></div>
 					<div class="edit-container">
 						<?php echo ($art_info['article_content']); ?>
 					</div>
 				</div>
 			</div>
		</div>
	</div>	
</div>

<div class="fooder">
	<div class="wrap">
		<div class="main">
			<img class="pic1" src="/Uploads/<?php echo ($web_stting['member_logo']); ?>">
			<img class="pic2" src="/Uploads/<?php echo ($web_stting['seller_logo']); ?>">
			<div class="hint fr" style="width: 490px; text-align: justify;">
			<?php echo ($web_stting['footer_info']); ?>
			</div>
		</div>
	</div>
</div>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?ad1e873c04c1868885d6d10bcb7a28d0";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
 

</body>
</html>

 <!-- 滚动图js -->
<script>jQuery(".newRoll").slide({mainCell:".bd ul",effect:"fold",autoPlay:true,autoPage:true,titCell:".ol"});</script>
<script>jQuery(".link-box .main").slide({ mainCell:".con",autoPage:true,effect:"top",autoPlay:true,vis:1});
</script>
 

 <!-- tab 切换 -->
<script>
	$(function(){
		$('#inde li').mouseover(function(){
			var n = $(this).index();
			$('#inde li').removeClass('on');
			$(this).addClass('on');
			$('.con-item').each(function(){
				$(this).hide();
			});
			$('.con-item').eq(n).show();
		});
	});
</script>
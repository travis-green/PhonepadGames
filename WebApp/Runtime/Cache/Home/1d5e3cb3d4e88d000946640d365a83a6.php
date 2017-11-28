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
<link rel="stylesheet" href="/PhonepadGames/Public/home/css/style.css">
<link rel="stylesheet" type="text/css" media="screen and (max-device-width: 400px)" href="/PhonepadGames/Public/home/css/tinyScreen.css" />
<link rel="stylesheet" type="text/css" media="screen and (min-width: 400px) and (max-device-width: 600px)" href="/PhonepadGames/Public/home/css/smallScreen.css" />

    <script src="/PhonepadGames/Public/home/js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="/PhonepadGames/Public/home/js/jquery.SuperSlide.2.1.2.js"></script>
    <script src="/PhonepadGames/Public/home/js/com.js"></script>

 
</head>
<body style="background:url(/PhonepadGames/Public/home/images/list_b.jpg) no-repeat center top;">
	<div class="top-nav">
    <div class="wrap tc">
        <div class="nav">
            <ul>
                <li <?php if($action_name == 'index'): ?>class="on"<?php endif; ?>><a href="<?php echo (C("SiteUrl")); ?>">官网首页</a></li>
                <li <?php if($action_name != 'index'): ?>class="on"<?php endif; ?>><a href="<?php echo U('Index/news');?>">游戏资讯</a></li>
                <li <?php if($action_name != 'index'): ?>class="on"<?php endif; ?>><a href="<?php echo U('Index/news');?>">游戏攻略</a></li>
                <li <?php if($action_name != 'index'): ?>class="on"<?php endif; ?>><a href="<?php echo U('Index/news');?>">官方渠道</a></li>
                <li <?php if($action_name != 'index'): ?>class="on"<?php endif; ?>><a href="<?php echo U('Index/news');?>">访问蜂派</a></li>
                <!--<?php if(is_array($document)): $i = 0; $__LIST__ = $document;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dc): $mod = ($i % 2 );++$i;?>-->
                <!--<li <?php if($i == 1): ?>class="spec"<?php endif; ?>><a href="<?php echo ($dc['doc_key']); ?>" target="_blank"><?php echo ($dc['doc_title']); ?></a></li>-->
                <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
            </ul>
		<span class="sign"></span>
        </div> 
    </div>
    <a href="<?php echo (C("SiteUrl")); ?>"><img class="logo bounceIn" src="/PhonepadGames/Uploads/<?php echo ($web_stting['site_logo']); ?>" alt="<?php echo ($web_stting['site_name']); ?>" title="<?php echo ($web_stting['site_name']); ?>"></a>

</div>
 
	<div class="wrap">
		<div class="con-box" style="background:url(/PhonepadGames/Public/home/images/list.jpg) no-repeat left top; padding:0;">
			 <img class="place glintFlash" src="/PhonepadGames/Public/home/img/xi.png">
			<div class="app-down clearfix" style="padding:490px 0 0 0">
				<span class="fr"><img class="wx" src="/PhonepadGames/Uploads/<?php echo ($web_stting['weixin_qrcode']); ?>" alt="<?php echo ($web_stting['site_name']); ?>"></span>
				<span class="ios fr"><a href="<?php echo ($web_stting['ios_url']); ?>" target="_blank"> </a></span>
				<span class="android fr"><a href="<?php echo ($web_stting['android_url']); ?>" target="_blank"> </a></span>
			</div>
		</div>
	</div>

<div class="new-main">	
	<div class="wrap">
		<div class="container clearfix">
			<div class="l-con">
				<ul>
                <?php if(is_array($article_class)): $i = 0; $__LIST__ = $article_class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ac): $mod = ($i % 2 );++$i;?><li <?php if($ac['ac_id'] == $ac_id): ?>class="on"<?php endif; ?>><a href="<?php echo U('Index/news',array('ac_id'=>$ac['ac_id']));?>"><?php echo ($ac['ac_name']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>    
				</ul>
			</div>
			<div class="r-con">
				<h1><a href="<?php echo (C("SiteUrl")); ?>">首页</a> > <a href="<?php echo U('Index/news');?>">游戏资讯</a> <?php if(count($ac_info) > 0): ?>> <?php echo ($ac_info['ac_name']); endif; ?></h1>
				<ul>
				<?php if(is_array($art_list)): $i = 0; $__LIST__ = $art_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$art): $mod = ($i % 2 );++$i;?><li><span><a href="<?php echo U('Index/news_view',array('id'=>$art['article_id']));?>"><?php echo ($art['article_title']); ?></a></span> <i><?php echo (date('Y-m-d',$art['article_time'])); ?></i></li><?php endforeach; endif; else: echo "" ;endif; ?>    
				</ul>
					<div class="pro_page">  
						<?php echo ($page); ?>
					</div>
			</div>
		</div>
	</div>	
</div>

<div class="fooder">
	<div class="wrap">
		<div class="main">
			<img class="pic1" src="/PhonepadGames/Uploads/<?php echo ($web_stting['member_logo']); ?>">
			<img class="pic2" src="/PhonepadGames/Uploads/<?php echo ($web_stting['seller_logo']); ?>">
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
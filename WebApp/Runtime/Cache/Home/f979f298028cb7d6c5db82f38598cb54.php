<?php if (!defined('THINK_PATH')) exit();?>﻿<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo ($arr_seo['title']); ?></title>
<meta name="keywords" content="<?php echo ($arr_seo['key']); ?>">
<meta name="description" content="<?php echo ($arr_seo['desc']); ?>">
<meta name="viewport" content="width=device-width; initial-scale=1">
<meta name="baidu-site-verification" content="f7nqw8YR4G" />
<link rel="shortcut icon" href="/Public/home/img/ico.jpg" type="image/x-icon">
<link rel="stylesheet" href="/Public/home/css/style.css">
<link rel="stylesheet" type="text/css" media="screen and (max-device-width: 400px)" href="/Public/home/css/tinyScreen.css" />
<link rel="stylesheet" type="text/css" media="screen and (min-width: 400px) and (max-device-width: 600px)" href="/Public/home/css/smallScreen.css" />
<script src="/Public/home/js/jquery-1.11.3.min.js"></script>
<script src="/Public/home/js/jquery.SuperSlide.2.1.1.js"></script>
<script src="/Public/home/js/com.js"></script>
 
</head>
<body>
	<div class="top-nav">
    <div class="wrap tc">
        <a href="<?php echo (C("SiteUrl")); ?>"><img class="logo bounceIn" src="/Uploads/<?php echo ($web_stting['site_logo']); ?>" alt="<?php echo ($web_stting['site_name']); ?>" title="<?php echo ($web_stting['site_name']); ?>"></a>
        <div class="nav">
            <ul>
                <li <?php if($action_name == 'index'): ?>class="on"<?php endif; ?>><a href="<?php echo (C("SiteUrl")); ?>">官网首页</a></li>
                <li <?php if($action_name != 'index'): ?>class="on"<?php endif; ?>><a href="<?php echo U('Index/news');?>">游戏资讯</a></li>
                <?php if(is_array($document)): $i = 0; $__LIST__ = $document;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dc): $mod = ($i % 2 );++$i;?><li <?php if($i == 1): ?>class="spec"<?php endif; ?>><a href="<?php echo ($dc['doc_key']); ?>" target="_blank"><?php echo ($dc['doc_title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
		<span class="sign"></span>
        </div> 
    </div>
</div>
 

	<div class="wrap">
		<div class="con-box">
			<img class="star glintFlash" src="/Public/home/img/star.png" alt="">
			<a class="video playflash" href="javascript:showView()"><img src="/Public/home/img/music.png" alt="<?php echo ($web_stting['site_name']); ?>"></a>
			<div class="app-down clearfix">
				<span class="fr"><img class="wx" src="/Uploads/<?php echo ($web_stting['weixin_qrcode']); ?>" alt="<?php echo ($web_stting['site_name']); ?>"></span>
				<span class="ios fr"><a target="_blank"></a></span>
				<span class="android fr"><a target="_blank"> </a></span>
			</div>

			<div class="news-box clearfix">
				<div class="fl newRoll">
					 <div class="bd">
					 	<ul>
						<?php if(is_array($banner)): $i = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$bn): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($bn['ap_link']); ?>" target="_blank"><img src="/Uploads/<?php echo ($bn['ap_pic']); ?>" alt="<?php echo ($bn['ap_intro']); ?>"></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
					 	</ul>
					 </div>
					 <ol class="ol">
					 	<li></li>
					 </ol>
				  <div class="luce"></div>
				</div>	
				<div class="fr newList">
					<div class="list">
						<div class="head clearfix">
							<ol id="inde">
                            <?php if(is_array($article_class)): $i = 0; $__LIST__ = $article_class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ac): $mod = ($i % 2 );++$i;?><li <?php if($i == 1): ?>class="on"<?php endif; ?>><a href="<?php echo U('Index/news',array('ac_id'=>$ac['ac_id']));?>"><?php echo ($ac['ac_name']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>	
							</ol>
							<a href="<?php echo U('Index/news');?>" class="more"> </a>
						</div>

						<div class="main">
						<?php if(is_array($article_class)): $i = 0; $__LIST__ = $article_class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$at): $mod = ($i % 2 );++$i;?><div class="con-item" <?php if($i == 1): ?>style="display:block"<?php endif; ?>>
                            <ul>
                            <?php if(is_array($art_arr[$at['ac_id']])): $i = 0; $__LIST__ = $art_arr[$at['ac_id']];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$art): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Index/news_view',array('id'=>$art['article_id']));?>"><?php echo (cutstr($art['article_title'],30)); ?></a> <span><?php echo (date('m-d',$art['article_time'])); ?></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>

					</div>
				</div>	
			</div>

			<div class="other-box clearfix">
				<ul>
                <?php if(is_array($index_ad)): $i = 0; $__LIST__ = $index_ad;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$i_ad): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($i_ad['ap_link']); ?>" target="_blank"><img src="/Uploads/<?php echo ($i_ad['ap_pic']); ?>" onMouseOver="this.src='/Uploads/<?php echo ($i_ad["ap_pic_2"]); ?>'" onMouseOut="this.src='/Uploads/<?php echo ($i_ad["ap_pic"]); ?>'" alt="<?php echo ($i_ad['ap_intro']); ?>"></a></li><?php endforeach; endif; else: echo "" ;endif; ?>                    
				</ul>
			</div>
			<!-- 友情链接 -->
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
 

<!-- 弹出层 669X344-->
	<div id="Popup" class="modal-wrapper-bg" style="display:none">
	        <div class="modal-dialog bounceInDown">
				<?php echo (htmlspecialchars_decode($web_stting['video_info'])); ?>
				<!-- 关闭按钮 -->
	            <span onClick="Close()" id="close" class="close"></span>
	        </div>
	</div>
</body>
</html>

<script>
    // 滚动图js
	jQuery(".newRoll").slide({mainCell:".bd ul",effect:"fold",autoPlay:true,autoPage:true,titCell:".ol"});
	// 友情链接
	jQuery(".link-box .main").slide({ mainCell:".con ul",autoPage:true,effect:"leftLoop",autoPlay:true,vis:5,delayTime:1000});
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
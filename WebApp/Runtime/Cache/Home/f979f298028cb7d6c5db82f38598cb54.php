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
<link rel="stylesheet" href="/Phonepadgames/Public/home/css/style.css">

<link rel="stylesheet" type="text/css" media="screen and (max-device-width: 400px)" href="/Phonepadgames/Public/home/css/tinyScreen.css" />
<link rel="stylesheet" type="text/css" media="screen and (min-width: 400px) and (max-device-width: 600px)" href="/Phonepadgames/Public/home/css/smallScreen.css" />

    <script src="/Phonepadgames/Public/home/js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="/Phonepadgames/Public/home/js/jquery.SuperSlide.2.1.2.js"></script>
    <script src="/Phonepadgames/Public/home/js/com.js"></script>


 
</head>
<body>
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
    <a href="<?php echo (C("SiteUrl")); ?>"><img class="logo bounceIn" src="/Phonepadgames/Uploads/<?php echo ($web_stting['site_logo']); ?>" alt="<?php echo ($web_stting['site_name']); ?>" title="<?php echo ($web_stting['site_name']); ?>"></a>

</div>


	<div class="slide-box">
		<div id="myCarousel" class="carousel slide">
			<!-- 轮播（Carousel）指标 -->


			<!-- 轮播（Carousel）项目 -->
			<div class="carousel-inner">
				<div class="app-down clearfix ">
					<div class="cell"><span class="ios"><a target="_blank" href="#"></a></span></div>
					<div class="cell"><span class="android"><a target="_blank" href="#"> </a></span></div>
					<div class="cell-fenge"><span class="cell-fenge"><a target="_blank" href="#"> </a></span></div>
					<div class="cell"><span class="weibo"><a target="_blank" href="#"> </a></span></div>
				</div>

				<div class="fullSlide">
					<div class="bd">
						<ul>
							<li><a target="_blank"><img src="/Phonepadgames/Public/home/img/Banner-1.jpg"/></a></li>
							<li><a target="_blank"><img src="/Phonepadgames/Public/home/img/Banner-1.jpg"/></a></li>
							<li><a target="_blank"><img src="/Phonepadgames/Public/home/img/Banner-1.jpg"/></a></li>
							<li><a target="_blank"><img src="/Phonepadgames/Public/home/img/Banner-1.jpg"/></a></li>
							<li><a target="_blank"><img src="/Phonepadgames/Public/home/img/Banner-1.jpg"/></a></li>
						</ul>
					</div>
					<div class="hd" style="display: none"><ul></ul></div>
					<a class="prev" href="javascript:void(0)"></a>
					<a class="next" href="javascript:void(0)"></a>
				</div>
			</div>
			<div class="slide-bar">
				<volist>
					<ul>
						<li><span class="shouye"><a  href="carousel-inner" >首页</a></span></li>
						<li><span><a   href="carousel-inner" >角色</a></span></li>
						<li><span><a   href="carousel-inner" >攻略</a></span></li>
						<li><span><a   href="carousel-inner" >新曲</a></span></li>
						<li><span><a   href="carousel-inner" >图库</a></span></li>
						<li><span><a   href="carousel-inner" >活动</a></span></li>
						<li><span><a   href="carousel-inner" >返回</a></span></li>
					</ul>
				</volist>
			</div>
			<volist>
				<div class="connectlist">
					<ul>
						<li class="connectweixin" id="weixin"><a href="#"></a></li>
						<li class="connectqq" id="qq" onclick="javascript:window.location.href='http://wpa.qq.com/msgrd?v=3&uin=969336291&site=qq&menu=yes'"><li>
						<li class="connectfaq" id="FAQ"><a href="#"></a></li>
					</ul>
					<div class="connectother">
						<ul >
						</ul>
					</div>
					<div class="weixin" onmouseover="this.className = 'weixin on';" onmouseout="this.className = 'weixin';">
						<a href="javascript:;"></a>
						<div class="weixin_nr">
							<div class="arrow"></div>
							<img src="/Phonepadgames/Public/home/img/qrcode.png" width="100" height="100" />
							关注官方微信
						</div>
					</div>
				</div>
			</volist>
			<div class="news-box clearfix newswidth">
				<div class="fl newRoll newscontent-left">
					<div class="bd">
						<ul>
							<?php if(is_array($banner)): $i = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$bn): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($bn['ap_link']); ?>" target="_blank"><img src="/Phonepadgames/Uploads/<?php echo ($bn['ap_pic']); ?>" alt="<?php echo ($bn['ap_intro']); ?>"></a>
									<div class="luce"></div></li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>

					</div>
					<ol class="ol">
						<li></li>
					</ol>
				</div>

				<div class="fr newList newscontent-right">
					<div class="list">
						<div class="head clearfix">
							<ol id="inde">
								<?php if(is_array($article_class)): $i = 0; $__LIST__ = $article_class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ac): $mod = ($i % 2 );++$i;?><li <?php if($i == 1): ?>class="on"<?php endif; ?>><a href="<?php echo U('Index/news',array('ac_id'=>$ac['ac_id']));?>"><?php echo ($ac['ac_name']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ol>
							<a href="<?php echo U('Index/news');?>" class="more"> </a>
						</div>

						<div class="main">
							<?php if(is_array($article_class)): $i = 0; $__LIST__ = $article_class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$at): $mod = ($i % 2 );++$i;?><div class="con-item"<?php if($i == 1): ?>style="display:block"<?php endif; ?>>
								<ul>
									<?php if(is_array($art_arr[$at['ac_id']])): $i = 0; $__LIST__ = $art_arr[$at['ac_id']];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$art): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Index/news_view',array('id'=>$art['article_id']));?>"><?php echo (cutstr($art['article_title'],30)); ?></a> <span><?php echo (date('m-d',$art['article_time'])); ?></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
								</ul>
						</div><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</div>
			</div>
		</div>

			<!-- 轮播（Carousel）导航 -->
			<a class="carousel-control left" href="#myCarousel" data-slide="prev"></a>
			<a class="carousel-control right" href="#myCarousel" data-slide="next"></a>
		</div>

		<!-- 控制按钮 -->

	</div>
	<table cellpadding=3 cellspacing=5>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td >[ <?php echo (date('Y-m-d H:i:s',$vo["create_time"])); ?> ] <?php echo ($vo["title"]); ?> </td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		<tr>
		</tr>
	</table>
	<div class="result page"><?php echo ($page); ?></div>
	<div class="wrap">
		<div class="con-box">
			<!--<img class="star glintFlash" src="/Phonepadgames/Public/home/img/star.png" alt="">-->
			<!--<a class="video playflash" href="javascript:showView()"><img src="/Phonepadgames/Public/home/img/music.png" alt="<?php echo ($web_stting['site_name']); ?>"></a>-->
			<!--<span class="fr"><img class="wx" src="/Phonepadgames/Uploads/<?php echo ($web_stting['weixin_qrcode']); ?>" alt="<?php echo ($web_stting['site_name']); ?>"></span>-->

			<div class="character-box clearfix">
				<ul>
                <?php if(is_array($index_ad)): $i = 0; $__LIST__ = $index_ad;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$i_ad): $mod = ($i % 2 );++$i; endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
		<div class="guidance-box clearfix">
			<ul>
				<?php if(is_array($index_ad)): $i = 0; $__LIST__ = $index_ad;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$i_ad): $mod = ($i % 2 );++$i;?>攻略栏<?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		</div>

		<div class="gallery-box clearfix">
			<ul>
				<?php if(is_array($index_ad)): $i = 0; $__LIST__ = $index_ad;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$i_ad): $mod = ($i % 2 );++$i;?>图库栏<?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		</div>
			<div class="event-box clearfix">
				<ul>
					<?php if(is_array($index_ad)): $i = 0; $__LIST__ = $index_ad;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$i_ad): $mod = ($i % 2 );++$i;?>活动栏<?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
			<div class="other-box clearfix">
				<ul>
					<?php if(is_array($index_ad)): $i = 0; $__LIST__ = $index_ad;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$i_ad): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($i_ad['ap_link']); ?>" target="_blank"><img src="/Phonepadgames/Uploads/<?php echo ($i_ad['ap_pic']); ?>" onMouseOver="this.src='/Phonepadgames/Uploads/<?php echo ($i_ad["ap_pic_2"]); ?>'" onMouseOut="this.src='/Phonepadgames/Uploads/<?php echo ($i_ad["ap_pic"]); ?>'" alt="<?php echo ($i_ad['ap_intro']); ?>"></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
			<!-- 友情链接 -->
		</div>
	</div>
    
<div class="fooder">
	<div class="wrap">
		<div class="main">
			<img class="pic1" src="/Phonepadgames/Uploads/<?php echo ($web_stting['member_logo']); ?>">
			<img class="pic2" src="/Phonepadgames/Uploads/<?php echo ($web_stting['seller_logo']); ?>">
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
<script type="text/javascript">
    jQuery(".fullSlide").slide({ titCell:".hd ul", mainCell:".bd ul", vis:"auto", autoPlay:true, autoPage:true, interTime:3200,mouseOverStop:false,effect:"left",});
</script>
<script>window.jQuery || document.write('<script src="/Phonepadgames/Public/home/js/jquery-1.11.3.min.js"><\/script>')</script>
<script src="http://cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
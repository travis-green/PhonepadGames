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
<body>
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


	<div class="slide-box">
		<div id="myCarousel" class="carousel slide">
			<!-- 轮播（Carousel）指标 -->


			<!-- 轮播（Carousel）项目 -->
			<div class="carousel-inner">
				<div class="app-down clearfix ">
					<div class="cell"><span class="ios"><a target="_blank" href="http://a.app.qq.com/o/simple.jsp?pkgname=com.tencent.tmgp.ppgames.timetorock"></a></span>
					</div>
					<div class="cell"><span class="android"><a target="_blank" href="http://l.taptap.com/dgFKYOZf"> </a></span></div>
					<div class="cell-fenge"><span class="cell-fenge"><a target="_blank" > </a></span></div>
					<div class="cell"><span class="weibo"><a target="_blank" href="https://weibo.com/u/6275602923?refer_flag=1001030101_&is_hot=1"> </a></span></div>
				</div>

				<div class="fullSlide">
					<div class="bd">
						<ul>
							<li><a target="_blank"><img src="/Public/home/img/Banner-1.jpg"/></a></li>
							<li><a target="_blank"><img src="/Public/home/img/Banner-boy.png"/></a></li>
							<li><a target="_blank"><img src="/Public/home/img/Banner-1.jpg"/></a></li>
							<li><a target="_blank"><img src="/Public/home/img/Banner-boy.png"/></a></li>
						</ul>
					</div>
					<div class="hd" style="display: none"><ul></ul></div>
					<a class="prev" href="javascript:void(0)"></a>
					<a class="next" href="javascript:void(0)"></a>
				</div>
			</div>
			<div class="slide-bar" style="display:none">
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
							<img src="/Public/home/img/qrcode.png" width="100" height="100" />
							关注官方微信
						</div>
					</div>
				</div>
			<div class="news-box clearfix newswidth">
				<div class="fl newRoll newscontent-left">
					<div class="bd">
						<ul>
							<?php if(is_array($banner)): $i = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$bn): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($bn['ap_link']); ?>" target="_blank"><img src="/Uploads/<?php echo ($bn['ap_pic']); ?>" alt="<?php echo ($bn['ap_intro']); ?>"></a>
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
			<!--<img class="star glintFlash" src="/Public/home/img/star.png" alt="">-->
			<!--<a class="video playflash" href="javascript:showView()"><img src="/Public/home/img/music.png" alt="<?php echo ($web_stting['site_name']); ?>"></a>-->
			<!--<span class="fr"><img class="wx" src="/Uploads/<?php echo ($web_stting['weixin_qrcode']); ?>" alt="<?php echo ($web_stting['site_name']); ?>"></span>-->

			<div class="character-box clearfix">
				<ul>
                <?php if(is_array($index_ad)): $i = 0; $__LIST__ = $index_ad;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$i_ad): $mod = ($i % 2 );++$i; endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
		<div class="guidance-box clearfix">
		</div>

		<div class="gallery-box clearfix" id="pic">
			<div class="slideGroup" style="margin:0 auto">
				<div class="parHd">
					<ul><li>1</li><li>2</li><li>3</li></ul>
				</div>
				<div class="parBd">
					<div class="slideBox">
						<a class="sPrev" href="javascript:void(0)"></a>
						<ul>
							<li>
								<div class="pic"><a  target="_blank"><img class="zoom" src="/Public/home/img/gallery-xiaxiaotu.jpg" /></a></div>
							</li>
							<li>
								<div class="pic"><a  target="_blank"><img src="/Public/home/img/gallery-jingyunjiang.jpg" /></a></div>
							</li>
							<li>
								<div class="pic"><a  target="_blank"><img src="/Public/home/img/gallery-fenglang.jpg" /></a></div>
							</li>
							<li>
								<div class="pic"><a  target="_blank"><img src="/Public/home/img/gallery-anpo.jpg" /></a></div>
							</li>
						</ul>
						<ul>
							<li>
								<div class="pic"><a target="_blank"><img src="/Public/home/img/gallery-ouyangling.jpg" /></a></div>
							</li>
							<li>
								<div class="pic"><a  target="_blank"><img src="/Public/home/img/gallery-ouyangyi.jpg" /></a></div>
							</li>
							<li>
								<div class="pic"><a  target="_blank"><img src="/Public/home/img/gallery-ajie.jpg" /></a></div>
							</li>
							<li>
								<div class="pic"><a target="_blank"><img src="/Public/home/img/gallery-naxisai.jpg" /></a></div>
							</li>

						</ul>
						<a class="sNext" href="javascript:void(0)"></a>
					</div><!-- slideBox End -->

					<div class="slideBox">
						<a class="sPrev" href="javascript:void(0)"></a>
						<ul>
							<li>
								<div class="pic"><a target="_blank"><img src="/Public/home/img/gallery-liumengshu.jpg" /></a></div>
							</li>
							<li>
								<div class="pic"><a  target="_blank"><img src="/Public/home/img/gallery-gumange.jpg" /></a></div>
							</li>
							<li>
								<div class="pic"><a target="_blank"><img src="/Public/home/img/gallery-jinghe.jpg" /></a></div>
							</li>
							<li>
								<div class="pic"><a  target="_blank"><img src="/Public/home/img/gallery-lanshan.jpg" /></a></div>
							</li>
						</ul>
						<ul>
							<li>
								<div class="pic"><a target="_blank"><img src="/Public/home/img/gallery-luola.jpg" /></a></div>
							</li>
							<li>
								<div class="pic"><a target="_blank"><img src="/Public/home/img/gallery-qinchuan.jpg" /></a></div>
							</li>
							<li>
								<div class="pic"><a  target="_blank"><img src="/Public/home/img/gallery-yinlechen.jpg" /></a></div>
							</li>
							<li>
								<div class="pic"><a  target="_blank"><img src="/Public/home/img/gallery-youyou.jpg" /></a></div>
							</li>
						</ul>
						<a class="sNext" href="javascript:void(0)"></a>
					</div><!-- slideBox End -->

					<div class="slideBox">
						<a class="sPrev" href="javascript:void(0)"></a>
						<ul>
							<li>
								<div class="pic"><a target="_blank"><img src="/Public/home/img/gallery-zixuan.jpg" /></a></div>
							</li>
							<li>
								<div class="pic"><a target="_blank"><img src="/Public/home/img/guochang-1.jpg" /></a></div>
							</li>
							<li>
								<div class="pic"><a target="_blank"><img src="/Public/home/img/guochang-2.jpg" /></a></div>
							</li>
							<li>
								<div class="pic"><a target="_blank"><img src="/Public/home/img/guochang-3.jpg" /></a></div>
							</li>
						</ul>
						<ul>
							<li>
								<div class="pic"><a target="_blank"><img src="/Public/home/img/guochang-4.jpg" /></a></div>
							</li>
							<li>
								<div class="pic"><a target="_blank"><img src="/Public/home/img/guochang-5.jpg" /></a></div>
							</li>
							<li>
								<div class="pic"><a target="_blank"><img src="/Public/home/img/guochang-6.jpg" /></a></div>
							</li>
							<li>
								<div class="pic"><a target="_blank"><img src="/Public/home/img/guochang-7.jpg" /></a></div>
							</li>
						</ul>
						<a class="sNext" href="javascript:void(0)"></a>
					</div><!-- slideBox End -->
				</div><!-- parBd End -->
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
<script type="text/javascript">
    jQuery(".fullSlide").slide({ titCell:".hd ul", mainCell:".bd ul", vis:"auto", autoPlay:true, autoPage:true, interTime:3200,mouseOverStop:false,effect:"left",});
</script>
<script>window.jQuery || document.write('<script src="/Public/home/js/jquery-1.11.3.min.js"><\/script>')</script>
<script src="http://cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript">

    jQuery(".slideGroup .slideBox").slide({
        mainCell:"ul",
        vis:6,
        prevCell:".sPrev",
        nextCell:".sNext",
        effect:"leftLoop"
    });
	/* 外层tab切换 */
    jQuery(".slideGroup").slide({
        titCell:".parHd li",
        mainCell:".parBd"
    });
</script>
<script>
  (function() {

	function setClickHandler(id, fn) {
	  document.getElementById(id).onclick = fn;
	}

	setClickHandler('pic', function(e) {
	  e.target.tagName === 'IMG' && BigPicture({
		el: e.target,
		imgSrc: e.target.src.replace('_thumb', '')
	  });
	});

	setClickHandler('local_image_container', function(e) {
	  (e.target.tagName === 'IMG' || e.target.className === 'background-image') &&
		BigPicture({
		  el: e.target
		});
	});

	setClickHandler('video_container', function(e) {
	  var className = e.target.className;
	  ~className.indexOf('htmlvid') &&
		BigPicture({
		  el: e.target,
		  vidSrc: e.target.getAttribute('vidSrc')
		});
	  ~className.indexOf('vimeo') &&
		BigPicture({
		  el: e.target,
		  vimeoSrc: e.target.getAttribute('vimeoSrc')
		});
	  ~className.indexOf('youtube') &&
		BigPicture({
		  el: e.target,
		  ytSrc: e.target.getAttribute('ytSrc')
		});
	})

	setClickHandler('broken_container', function(e) {
	  e.target.id === 'broken_image' &&
		BigPicture({
		  el: e.target,
		  imgSrc: '/nopic.jpg'
		});
	  e.target.id === 'broken_vid' &&
		BigPicture({
		  el: e.target,
		  vidSrc: '/novid.mp4'
		});
	  ~e.target.className.indexOf('vimeo') &&
		BigPicture({
		  el: e.target,
		  vimeoSrc: 'ajoiejlkr'
		})
	  ~e.target.className.indexOf('youtube') &&
		BigPicture({
		  el: e.target,
		  ytSrc: 'oijlksdjf'
		})
	});

  })();
</script>
<script type="text/javascript">
        $(document).ready(function(){
            var description = ' ';
            $('body').ttwMusicPlayer(myPlaylist, {
                autoPlay:false, 
                description:description,
                jPlayer:{
                }
            });
        })
    </script>
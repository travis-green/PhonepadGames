<?php if (!defined('THINK_PATH')) exit();?>﻿<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo ($arr_seo['title']); ?></title>
<meta name="keywords" content="<?php echo ($arr_seo['key']); ?>">
<meta name="description" content="<?php echo ($arr_seo['desc']); ?>">
</head>
<link rel="stylesheet" href="/Public/mobile/css/style.css">
<link rel="stylesheet" href="/Public/mobile/css/swiper-3.3.1.min.css">
<script src="/Public/mobile/js/jquery-1.11.3.min.js"></script>
<script src="/Public/mobile/js/swiper-3.3.1.jquery.min.js"></script>
<body>
<div class="qj"><img src="/Public/mobile/img/back.jpg" width='100%' alt=""><div class="back"><img src="/Public/mobile/img/ck.jpg" width='100%' alt=""></div>
</div>

	<div id="top" class="wrapp">
		<div class="logo"><img src="/Uploads/<?php echo ($web_stting['m_site_logo']); ?>"></div>
			<div class="con">
				 <img class="bounceIn" src="/Public/mobile/img/contai.png" alt="">
				 <div class="music playflash"><img src="/Public/mobile/img/music.png" alt=""></a></div>
			</div>

			<div class="download">
				<a class="downloadbtn" href="<?php echo ($web_stting['app_url']); ?>" target="_blank"><img src="/Public/mobile/img/dow.png" alt=""></a>
			</div>

			<div class="distan">
				<div class="trans" style="display:none;">
					<div class="inter">
						<div class="title"><img src="/Public/mobile/img/title.png" alt=""></div>
						<div class="pic-link">
							<ul>
							<?php if(is_array($m_adv)): $i = 0; $__LIST__ = $m_adv;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ma): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($ma['ap_link']); ?>" target="_blank"><img src="/Uploads/<?php echo ($ma['ap_pic']); ?>" alt=""></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>


			<div class="distan">
				<div class="trans sroll">
					<div class="swiper-container banner">
						<ul class="swiper-wrapper">
                        <?php if(is_array($m_banner)): $i = 0; $__LIST__ = $m_banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mb): $mod = ($i % 2 );++$i;?><li class="swiper-slide"><a href="<?php echo ($mb['ap_link']); ?>" target="_blank"><img src="/Uploads/<?php echo ($mb['ap_pic']); ?>" alt=""></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
						<div class="swiper-pagination sub-box"></div>
					</div>
				</div>
			</div> 

			<script language="javascript"> 
		        var mySwiper = new Swiper('.swiper-container',{
		        pagination : '.swiper-pagination',
		        autoplay : 2000,
		        //pagination : '#swiper-pagination1',
		        })
	        </script>

			<!-- <div class="distan">
				<div class="server">
					<img src="/Public/mobile/img/servers.png" alt="">
				</div>
			</div> -->

			<div class="distan">
				<div class="server">
					<img class="bj" src="/Public/mobile/img/servers.png" alt="">
					<div class="adc">
						<p>客服热线：<?php echo ($web_stting['m_tel']); ?></p>
						<p onclick="javascript:window.location.href='http://wpa.qq.com/msgrd?v=3&uin=969336291&site=qq&menu=yes'">客服QQ1：<?php echo ($web_stting['m_qq1']); ?></p>
						<p onclick="javascript:window.location.href='http://wpa.qq.com/msgrd?v=3&uin=969336291&site=qq&menu=yes'">客服QQ2：<?php echo ($web_stting['m_qq2']); ?></p>
						<p>官方QQ群：<?php echo ($web_stting['m_qq_qun']); ?></p>
					</div>
				</div>
			</div>
			

			<div class="distan">
				<div class="atten">
					<ul>
						<li><a href="<?php echo ($web_stting['m_wb_url']); ?>" target="_blank"><img src="/Public/mobile/img/wb.png"></a></li>
						<li><a href="<?php echo ($web_stting['m_tb_url']); ?>"><img src="/Public/mobile/img/baidu.png"></a></li>
					</ul>
				</div>
				<div class="atten">
					<div style="padding:10px 0;"><img src="/Public/mobile/img/wx.png" alt="" width="100%"></div>
				</div>
			</div>

			<div class="download hidden">
				<a class="" href="#top"><img src="/Public/mobile/img/dow2.png" alt=""></a>
			</div>
			
	</div>
	
  <div id="Popup" class="modal-wrapper-bg" style="display: none;">
	        <div class="modal-dialog bounceInDown">
				<!-- 视频内容 可以删除 -->
	        	<!--<iframe frameborder="0" width="100%" src="http://v.qq.com/iframe/player.html?vid=d0193y873tw&tiny=0&auto=0" allowfullscreen></iframe>-->
                <?php echo (htmlspecialchars_decode($web_stting['m_video_info'])); ?>
				<!-- 关闭按钮 -->
	            <span onclick="Close()" id="close" class="close"></span>
	        </div>
	</div>

</body>
<script>
function showView(){
    document.getElementById('Popup').style.display='block';
}
function Close(){
    document.getElementById('Popup').style.display='none';
}
</script>
<script type="text/javascript">
 $(".downloadbtn").click(function() {
        var u = navigator.userAgent;
        var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
        var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
		var isbrowser= u.indexOf("Opera") > -1||u.indexOf("Chrome") > -1||u.indexOf("Firefox")||u.indexOf("compatible") > -1&&userAgent.indexOf("MSIE") > -1 && !isOpera ||u.indexOf("Safari") > -1;
          if (isAndroid) { 
				$(".downloadbtn").attr('href', 'https://www.taptap.com/app/58741'); 
			} else if (isiOS) {    
				$(".downloadbtn").attr('href', 'http://a.app.qq.com/o/simple.jsp?pkgname=com.tencent.tmgp.ppgames.timetorock ');
									}
		     else if  (isbrowser){
				$(".downloadbtn").attr('href', 'http://ygtime.cn');
			 }
			})
	  </script>
</html>
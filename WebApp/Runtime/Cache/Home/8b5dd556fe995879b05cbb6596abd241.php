<?php if (!defined('THINK_PATH')) exit();?>﻿
<!doctype html>
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
<body>
	<div class="pagination"><?php echo ($page); ?></div> //基本样式
	<div class="pagination pagination-large"><?php echo ($page); ?></div>//大号数字样式
	<div class="nav_main clearfix">
		<a href="/PhonepadGames" class="menu <?php if($curr): ?>current<?php endif; ?>">首 页</a>
		<?php if(is_array($cateres)): $i = 0; $__LIST__ = $cateres;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="/PhonepadGames/Home/<?php if($vo['type'] == 1): ?>List<?php elseif($vo['type'] == 2): ?>Page<?php else: ?>Topic<?php endif; ?>/index/cateid/<?php echo ($vo["id"]); ?>" class="menu <?php if($current == $vo['id']): ?>current<?php endif; ?>"><?php echo ($vo["catename"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
		<span class="icon_hot"></span>
	</div>
</body>
</html>
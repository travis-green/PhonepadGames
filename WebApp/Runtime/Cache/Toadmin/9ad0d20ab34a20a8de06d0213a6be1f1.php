<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>管理中心</title>
<link href="/Public/admin/css/login.css" rel="stylesheet" type="text/css">
</head>
<body>
<header class="header"><img src="/Public/admin/images/logo.gif"></header>
<div class="main_wrap">
  <div class="main_inner">
    <div id="loginwrap" class="login_inner login_shadow">
      <div class="login_hd">
        <h2>管理中心</h2>
        <a href="<?php echo (C("SiteUrl")); ?>" target='_blank'>返回首页</a> </div>
      <div class="login_bd">
        <form id="form_login" method="post">
          <div class="usernm">
            <h2>用户名:</h2>
            <input type="text" autocomplete="off" name="user_name" id="user_name" class="text">
          </div>
          <div class="password">
            <h2>密　码:</h2>
            <input type="password" autocomplete="off" id="password" name="password" class="text">
          </div>
          <div class="code">
            <h2>验证码:</h2>
			<input class="text" name="captcha" id="captcha" autocomplete="off"  type="text" style="width:120px;">
            <span>
            <a href="JavaScript:void(0);"><img class="verifyimg reloadverify" src="<?php echo U('Public/verify',array('id'=>1));?>" title="看不清 点击刷新" alt="看不清 点击刷新" name="codeimage" border="0" id="codeimage"/></a>
            </span>
		  </div>          
          <div class="login_btn clearfix">
			<input name="token" type="hidden" value="<?php echo ($token); ?>" />
            <input type="submit" value="" id="loginSubmit" class="btn-regist">
          </div>
        </form>
      </div>
    </div>
  </div>  
</div>

<script type="text/javascript" src="/Public/static/jquery.js"></script>
<script type="text/javascript">
$(function(){
	//初始化选中用户名输入框
	$("#form_login").find("input[name=user_name]").focus();
	//刷新验证码
	var verifyimg = $(".verifyimg").attr("src");
	$(".reloadverify").click(function(){
		if( verifyimg.indexOf('?')>0){
			$(".verifyimg").attr("src", verifyimg+'&id=1&random='+Math.random());
		}else{
			$(".verifyimg").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random()+'&id=1');
		}
	});

});
</script>
</body>
</html>
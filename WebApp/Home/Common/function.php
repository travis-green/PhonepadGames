<?php
/**
 * 模块公共方法
 * @package    function
 * @copyright  Copyright (c) 2014-2030 muxiangdao-cn Inc.(http://www.muxiangdao.cn)
 * @license    http://www.muxiangdao.cn
 * @link       http://www.muxiangdao.cn
 * @author	   muxiangdao-cn Team
 */

/**
 * 字符串匿名处理 eg:这是一个例子=>这**子
 * @param string $string 输入字符串
 * @return string
 */
function hideName($string){
	$len = strlen($string);
	if ($len >2) {
		$first = mb_substr($string,0,1,"UTF-8");
		$last = mb_substr($string,-1,1,"UTF-8");
		$string = $first."**".$last;
	}elseif ($len == 2) {
		$first = mb_substr($string,0,1,"UTF-8");
		$string = $first."*";
	}
	return $string;
}
/**
 * 微信获取code
 */
function getWxCode($scope='snsapi_userinfo',$uri=""){
	if ($uri == "") $uri = U();
	$appId = Wx_C('wx_appid');
	$redirect_uri = urlencode($uri);
	$response_type = 'code';
	$state = time();
	$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appId.'&redirect_uri='.$redirect_uri.'&response_type='.$response_type.'&scope='.$scope.'&state='.$state.'#wechat_redirect';
	get_url($url);
}
/**
 * 微信通过code换取网页授权access_token并获取用户信息,登录
 */
function checkLogin($code){
	if (empty($code)) {
		getWxCode('snsapi_userinfo',U());
	}else {
		$code = trim($_GET['code']);
		$state = trim($_GET['state']);
		$appid = Wx_C('wx_appid');
		$secret = Wx_C('wx_secret');
		$url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$secret.'&code='.$code.'&grant_type=authorization_code';
		$info = json_decode(get_url($url));
		$token = $info->access_token;
		$openid = $dejson->openid;
		$url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$token.'&openid='.$openid.'&lang=zh_CN';
		$member = json_decode(get_url($url));
		$data = array(
				'openid' => $member->openid,
				'member_name' => $member->nickname,
				'gender' => $member->sex,
				'city' => $member->city,
				'province' => $member->province,
				'avatar' => $member->headimgurl,
		);
		$where = array('openid'=>$data['openid']);
		$res = M('member')->where($where)->find();
		if (!$res) {
			M('member')->add($data);
		}else {
			M('member')->where($where)->save($data);
		}
		session('openid',$data['openid']);
	}
}
/**
 * 获取openid
 */
function getOpenId(){
	$code = $_GET['code'];
	$state = $_GET['state'];
	$appid = Wx_C('wx_appid');
	$secret = Wx_C('wx_secret');
}
/**
 * 获取member_id
 */
function getMid($value,$key='openid'){
	$mid = M('member')->where(array($key=>$value))->getField('member_id');
	return $mid;
}
/**
 * 根据订单号获取订单ID
 */
function getOrderId($order_sn){
	return M('Order')->where(array('order_sn'=>$order_sn))->getField('order_id');
}
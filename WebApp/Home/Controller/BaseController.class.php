<?php
/**
 * 基类
 * @package    Base
 * @copyright  Copyright (c) 2014-2030 muxiangdao-cn Inc.(http://www.muxiangdao.cn)
 * @license    http://www.muxiangdao.cn
 * @link       http://www.muxiangdao.cn
 * @author	   muxiangdao-cn Team
 */
namespace Home\Controller;
use Think\Controller;

class BaseController extends Controller{
	public function __construct()
	{
		parent::__construct();
		$this->assign('action_name',ACTION_NAME);
		//读取配置信息
		$web_stting = F('setting');
		if($web_stting === false) 
		{
			$params = array();
			$list = M('Setting')->getField('name,value');
			foreach ($list as $key=>$val) 
			{
				$params[$key] = unserialize($val) ? unserialize($val) : $val;
			}
			F('setting', $params); 				
			$web_stting = F('setting');
		}
		$this->assign('web_stting',$web_stting);
		//站点状态判断
		if($web_stting['site_status'] != 1){
		   echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		   echo $web_stting['closed_reason'];
		   exit;	
		}
		//导航链接
		$this->document = M('Document')->select();
	}
	public function seo_set($title='',$key='',$desc='')
	{	
	 	$web_seo = F('seo');
		if($web_seo === false){
			$seo_rs = M('Seo')->where('id=1')->find();	
			F('seo', $seo_rs); 	
			$web_seo = F('seo');		
		}
		$arr_seo = array();
		$arr_seo['title'] = $title ? $title : $web_seo['title'];
		$arr_seo['key'] = $key ? $key : $web_seo['keywords'];
		$arr_seo['desc'] = $desc ? $desc : $web_seo['description'];
		$this->assign('arr_seo',$arr_seo);
	}
	
}

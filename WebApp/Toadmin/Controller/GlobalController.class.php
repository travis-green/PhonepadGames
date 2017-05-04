<?php
/**
 * 基类
 * @copyright  Copyright (c) 2014-2030 muxiangdao-cn Inc.(http://www.muxiangdao.cn)
 * @license    http://www.muxiangdao.cn
 * @link       http://www.muxiangdao.cn
 * @author	   muxiangdao-cn Team
 */
namespace Toadmin\Controller;
use Think\Controller;

class GlobalController extends Controller {
	protected  $admin_name;
	protected  $_name = '';
    protected function _initialize()
	{
        $this->_name = CONTROLLER_NAME ;
		if(isLogin())
		{
			define('AID',isLogin());
			$this->admin_name = decrypt(cookie('admin_name'));
			$this->assign('admin_name',$this->admin_name);
		}else{
			$this->redirect('Public/login');
			exit;	
		}	
		//获取用户的权限组
		$admin_auth = M('Admin')->where('admin_issuper <> 1 AND admin_id='.AID)->getField('admin_auth');
		if($admin_auth)
		{
			$auth_rt = 0;
			$a_map = array();
			$a_map['a_id'] = array('in',$admin_auth);
			$a_name = M('AdminAuth')->where($a_map)->field('a_name')->select();
			if(is_array($a_name) && !empty($a_name))
			{
				$auth_arr = array();
				foreach($a_name as $au)
				{
					$auth_arr[] = $au['a_name'];	
				}
			}
			$a_controller = CONTROLLER_NAME.'-*';
			$a_actionname = CONTROLLER_NAME.'-'.ACTION_NAME;
			if(in_array($a_controller,$auth_arr) || in_array($a_actionname,$auth_arr))
			{
				$auth_rt = 1;
			}
			if($auth_rt == 0)
			{
				echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />您没有被授权，不可进行此操作！';die;
			}	
		}
		//权限END				
    }	    	
}
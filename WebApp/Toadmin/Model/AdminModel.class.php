<?php
/**
 * 管理员模型
 * @copyright  Copyright (c) 2014-2030 muxiangdao-cn Inc.(http://www.muxiangdao.cn)
 * @license    http://www.muxiangdao.cn
 * @link       http://www.muxiangdao.cn
 * @author	   muxiangdao-cn Team
 */
namespace Toadmin\Model;
use Think\Model;

class AdminModel extends Model {

	//管理员登录
	public function admin_login($name, $pwd)
	{
		$map = array();
		$map['admin_name'] = $name;
		$user = $this->where($map)->find();
		if(is_array($user) && !empty($user))
		{
			 if(re_md5($pwd) === $user['admin_pwd'])
			 {
				$data = array();
				$data['admin_lg_time'] = NOW_TIME;
				$data['admin_lg_oldtime'] = $user['admin_lg_time'];
				$data['admin_lg_ip'] = get_client_ip();
				$data['admin_lg_oldip'] = $user['admin_lg_ip'];
				$this->where('admin_id='.$user['admin_id'])->save($data);
							 
				cookie('admin_id',encrypt($user['admin_id']),3600*8); 
				cookie('admin_name',encrypt($user['admin_name']),3600*8);
				return $user['admin_id'];
			 }else{
				return -2; 
			 }
		}else {
			return -1; 
		}
	}
	//退出登录
    public function logout()
	{
	    cookie('admin_id',null);
	 	cookie('admin_name',null);
    }	
}

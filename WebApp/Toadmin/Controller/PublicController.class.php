<?php
/**
 * 公共
 * @copyright  Copyright (c) 2014-2030 muxiangdao-cn Inc.(http://www.muxiangdao.cn)
 * @license    http://www.muxiangdao.cn
 * @link       http://www.muxiangdao.cn
 * @author	   muxiangdao-cn Team
 */
namespace Toadmin\Controller;
use Think\Controller;
class PublicController extends Controller { 

    public function login()
	{	
		if(isLogin())
		{
			$this->redirect('Index/welcome');
			exit;	
		}	
        if(IS_POST)
		{
			$name = trim($_POST['user_name']);
			$pwd = trim($_POST['password']);
			$captcha = trim($_POST['captcha']);
			$token = trim($_POST['token']);
			
			if($name == '' || $pwd == '')
			{
				$this->error('用户名或密码为空！',U('login'));
				exit;
			}						
			if($captcha == '' || !check_verify($captcha,1))
			{
				$this->error('验证码输入错误！',U('login'));
				exit;
			}  
			if($token == '' || $token != session('admin_token'))
			{
				$this->error('非法请求！',U('login'));
				exit;				
			}
            $lg_sn = D('Admin')->admin_login($name, $pwd);
			if($lg_sn > 0)
			{	
			     session('admin_token',null); 		
				 $this->success('登录成功！', U('Index/index'));
				 exit;
			}else{
				switch($lg_sn)
				{
					case -1: 
						$error = '用户名或密码错误！'; 
						break; 
					case -2: 
						$error = '用户名或密码错误！'; 
						break;
					default: 
						$error = '未知错误！'; 
						break; 
				}
				$this->error($error,U('login'));			
			}			         
        }else{
			session('admin_token',md5(uniqid(rand(), TRUE)));
		    $this->assign('token',session('admin_token'));
        	$this->display();
        }
    }

	/**
	 * 退出系统
	 */
	public function logout()
	{
		D('Admin')->logout();
		$this->success('退出成功！', U('login'));	
		exit;
	}
	
	/**
	 * 生成验证码
	 */
     public function verify() 
	 {
		$config = array(    
			'fontSize'    => 14,    
			'length'      => 4,
			'imageW'      => 100,     
			'imageH'    => 38,    
			'useNoise' => false, 
			//'useCurve' => false, 
		);
		$verify = new \Think\Verify($config);		
		$verify->entry(1);
     }
}

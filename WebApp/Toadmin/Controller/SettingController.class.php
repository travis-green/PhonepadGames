<?php
/**
 * 设置
 * @copyright  Copyright (c) 2014-2030 muxiangdao-cn Inc.(http://www.muxiangdao.cn)
 * @license    http://www.muxiangdao.cn
 * @link       http://www.muxiangdao.cn
 * @author	   muxiangdao-cn Team
 */
namespace Toadmin\Controller;
class SettingController extends GlobalController {
	public function _initialize() 
	{
        parent::_initialize();
	}	
	//站点设置
	public function base_information()
	{
		$Setting = M('Setting');
		if(IS_POST)
		{
			$data = array();
			if(!empty($_FILES['site_logo']['name']))
			{
			    $param = array('savePath'=>'common/','subName'=>'','files'=>$_FILES['site_logo'],'saveName'=>'site_logo','saveExt'=>'');				
				//$up_return = upload_one($param);
				$up_return = upload_one($param);
				
				if($up_return == 'error')
				{
					$this->error('图片上传失败');
					exit;	
				}else{
					$data['site_logo'] = $up_return;	
				}					
			}
			if(!empty($_FILES['member_logo']['name']))
			{
			    $param = array('savePath'=>'common/','subName'=>'','files'=>$_FILES['member_logo'],'saveName'=>'member_logo','saveExt'=>'');				
				$up_return = upload_one($param);
				if($up_return == 'error')
				{
					$this->error('图片上传失败');
					exit;	
				}else{
					$data['member_logo'] = $up_return;	
				}					
			}	
			if(!empty($_FILES['seller_logo']['name']))
			{
			    $param = array('savePath'=>'common/','subName'=>'','files'=>$_FILES['seller_logo'],'saveName'=>'seller_logo','saveExt'=>'');				
				$up_return = upload_one($param);
				if($up_return == 'error')
				{
					$this->error('图片上传失败');
					exit;	
				}else{
					$data['seller_logo'] = $up_return;	
				}					
			}	
			if(!empty($_FILES['weixin_qrcode']['name']))
			{
			    $param = array('savePath'=>'common/','subName'=>'','files'=>$_FILES['weixin_qrcode'],'saveName'=>'weixin_qrcode','saveExt'=>'');				
				$up_return = upload_one($param);
				if($up_return == 'error')
				{
					$this->error('图片上传失败');
					exit;	
				}else{
					$data['weixin_qrcode'] = $up_return;	
				}					
			}									
			$data['site_name']	= str_rp(trim($_POST['site_name']));
			//$data['weixin_account']	= str_rp(trim($_POST['weixin_account']));
			$data['site_qq']	= str_rp(trim($_POST['site_qq']));
			$data['site_tel']	= str_rp(trim($_POST['site_tel']));
			$data['site_address']	= str_rp(trim($_POST['site_address']));
			$data['icp_number']	= str_rp(trim($_POST['icp_number']));
			$data['statistics_code'] = htmlspecialchars(trim($_POST['statistics_code']));
			$data['time_zone']	= str_rp(trim($_POST['time_zone']));
			$data['site_status']	= str_rp($_POST['site_status']);
			$data['closed_reason']	= str_rp($_POST['closed_reason']);
			$data['subdomain_status'] = $_POST['subdomain_status']?$_POST['subdomain_status']:0;
			$data['subdomain_refuse']  = str_rp(trim($_POST['subdomain_refuse']));
			$data['ios_url'] = str_rp(trim($_POST['ios_url']));
			$data['android_url'] = str_rp(trim($_POST['android_url']));
			$data['video_info'] = htmlspecialchars(trim($_POST['video_info']));
			$data['footer_info'] = str_replace('\'','&#39;',$_POST['footer_info']);
			
			foreach ($data as $key => $val) 
			{
				$val = is_array($val) ? serialize($val) : $val;
				$Setting->where(array('name' => $key))->save(array('value' => $val));
			}
			//写入缓存
			$params = array();
			$list = $Setting->getField('name,value');
			foreach ($list as $key=>$val) 
			{
				$params[$key] = unserialize($val) ? unserialize($val) : $val;
			}
			F('setting', $params); 	
				
		    $this->success("设置成功");  	
			exit;											
		}else{
		    if(F('setting') === false) 
			{
				$params = array();
				$list = $Setting->getField('name,value');
				foreach ($list as $key=>$val) 
				{
					$params[$key] = unserialize($val) ? unserialize($val) : $val;
				}
				F('setting', $params); 		
				$vo = $params;			
			}else{
				$vo = F('setting');
			}
			$this->assign('vo',$vo);
			$this->display();		
		}	
	}
	//站点设置
	public function mobile_information()
	{
		$Setting = M('Setting');
		if(IS_POST)
		{

			$data = array();
			if(!empty($_FILES['m_site_logo']['name']))
			{
			    $param = array('savePath'=>'common/','subName'=>'','files'=>$_FILES['m_site_logo'],'saveName'=>'m_site_logo','saveExt'=>'');				
				//$up_return = upload_one($param);
				$up_return = upload_one($param);
				
				if($up_return == 'error')
				{
					$this->error('图片上传失败');
					exit;	
				}else{
					$data['m_site_logo'] = $up_return;	
				}					
			}
			$data['weixin_account']	= str_rp(trim($_POST['weixin_account']));
			$data['app_url']	= str_rp(trim($_POST['app_url']));
			$data['lingqu_url']	= str_rp(trim($_POST['lingqu_url']));
			$data['m_video_info'] = htmlspecialchars(trim($_POST['m_video_info']));
			
			$data['m_tel']	= str_rp(trim($_POST['m_tel']));
			$data['m_qq_qun']	= str_rp(trim($_POST['m_qq_qun']));
			$data['m_qq1']	= str_rp(trim($_POST['m_qq1']));
			$data['m_qq2']	= str_rp(trim($_POST['m_qq2']));
			$data['m_wb_url'] = str_rp(trim($_POST['m_wb_url']));
			$data['m_tb_url'] = str_rp(trim($_POST['m_tb_url']));
						
			foreach ($data as $key => $val) 
			{
				$val = is_array($val) ? serialize($val) : $val;
				$Setting->where(array('name' => $key))->save(array('value' => $val));
			}
			//写入缓存
			$params = array();
			$list = $Setting->getField('name,value');
			foreach ($list as $key=>$val) 
			{
				$params[$key] = unserialize($val) ? unserialize($val) : $val;
			}
			F('setting', $params); 	
				
		    $this->success("设置成功");  	
			exit;											
		}else{
		    if(F('setting') === false) 
			{
				$params = array();
				$list = $Setting->getField('name,value');
				foreach ($list as $key=>$val) 
				{
					$params[$key] = unserialize($val) ? unserialize($val) : $val;
				}
				F('setting', $params); 		
				$vo = $params;			
			}else{
				$vo = F('setting');
			}
			$this->assign('vo',$vo);
			$this->display();		
		}	
	}		
	//SEO设置 	
	public function seo_information()
	{
		$Seo = M('Seo');
		if(IS_POST)
		{
			$seo_type = trim($_POST['seo_type']);
			$data =	array(
				'title'		=>	str_rp(trim($_POST['title'])),
				'keywords'	=>	str_rp(trim($_POST['keywords'])),
				'description'=>	str_rp(trim($_POST['description']))
			);			
			$Seo->where('type=\''.$seo_type.'\'')->save($data);
		    $this->success("保存成功");  	
			exit;					
		}else{	
			$type = trim($_GET['type']) !='' ? trim($_GET['type']) : 'index';
			$vo = $Seo->where('type=\''.$type.'\'')->find();
			$this->assign('vo',$vo);
			$this->assign('type',$type);
			$this->display();	
		}
	}	
	//邮箱设置
	public function email_information()
	{
		$Setting = M('Setting');
		if(IS_POST)
		{
			$update_array = array();
			$update_array['email_status'] = str_rp(trim($_POST['email_status']));
			$update_array['email_type']   = str_rp(trim($_POST['email_type']));
			$update_array['email_host']   = str_rp(trim($_POST['email_host']));
			$update_array['email_port']   = str_rp(trim($_POST['email_port']));
			$update_array['email_addr']   = str_rp(trim($_POST['email_addr']));
			$update_array['email_id']     = str_rp(trim($_POST['email_id']));
			$update_array['email_pass']   = str_rp(trim($_POST['email_pass']));
			
			foreach ($update_array as $key => $val) 
			{
				$val = is_array($val) ? serialize($val) : $val;
				$Setting->where(array('name' => $key))->save(array('value' => $val));
			}
			//写入缓存
			$params = array();
			$list = $Setting->getField('name,value');
			foreach ($list as $key=>$val) 
			{
				$params[$key] = unserialize($val) ? unserialize($val) : $val;
			}
			F('setting', $params); 	
		    $this->success("设置成功");  	
			exit;							
		}else{
			if(F('setting') === false) 
			{
				$params = array();
				$list = $Setting->getField('name,value');
				foreach ($list as $key=>$val) 
				{
					$params[$key] = unserialize($val) ? unserialize($val) : $val;
				}
				F('setting', $params); 		
				$vo = $params;			
			}else{
				$vo = F('setting');
			}
			$this->assign('vo',$vo);		
			$this->display();
		}
	}	
	//邮件测试
	public function email_testing()
	{
		$email_type = trim($_POST['email_type']);
		$email_host = trim($_POST['email_host']);
		$email_port = trim($_POST['email_port']);
		$email_addr = trim($_POST['email_addr']);
		$email_id   = trim($_POST['email_id']);
		$email_pass = trim($_POST['email_pass']);
		$email_test = trim($_POST['email_test']);
		$subject	= '邮件测试';
		$site_url	= C('SiteUrl');
        $site_title = C('site_name');
        $message = '<p>这是一封来自'."<a href='".$site_url."' target='_blank'>".$site_title.'</a>测试邮件</p>';
		
		if($email_type == '1')
		{
			$obj_email = new \Muxiangdao\Email();
			$obj_email->set('email_server',$email_host);
			$obj_email->set('email_port',$email_port);
			$obj_email->set('email_user',$email_id);
			$obj_email->set('email_password',$email_pass);
			$obj_email->set('email_from',$email_addr);
            $obj_email->set('site_name',$site_title);
			$result = $obj_email->send($email_test,$subject,$message);
		}else{
			$result = @mail($email_test,$subject,$message);
		}
        if($result === false)
	    {
			$this->ajaxReturn(array('msg'=>'测试邮件发送失败'));
        }else{
            $this->ajaxReturn(array('msg'=>'测试邮件发送成功'));
        }		
			
	}
	//管理员管理
	public function admin_list()
	{
		$Admin = M('Admin');
		$op = trim($_GET['op']) ? trim($_GET['op']) : 'list';
		switch($op)
		{
			case 'list':
				$list = $Admin->select();
				$this->assign('list',$list);		
				$this->display();	
				break;
			case 'del':
			 	$admin_id = intval($_GET['admin_id']);
			    if($admin_id && $admin_id != 1)
				{
					$Admin->where('admin_id='.$admin_id)->delete(); 
				    $this->success("删除成功",U('admin_list'));  	
					exit;	
				}
				break;
			case 'edit':
				if(IS_POST)
				{
					$admin_id = intval($_POST['admin_id']);	
					if(trim($_POST['admin_pwd']))
					{
						$admin_pwd = re_md5(trim($_POST['admin_pwd']));	
						$Admin->where('admin_id='.$admin_id)->setField('admin_pwd',$admin_pwd);
					}
					//权限
					$admin_auth = $_POST['admin_auth'];
					$auth = '';
					if(!empty($admin_auth))
					{
						foreach($admin_auth as $at)
						{
							$auth .= $at.',';
						}	
					}
					$auth_d = M('AdminAuth')->where('a_default=1')->select();
					if(is_array($auth_d) && !empty($auth_d))
					{
						foreach($auth_d as $ad)
						{
							$auth .= $ad['a_id'].',';
						}	
					}
					$auth = substr($auth,0,-1);
					$Admin->where('admin_id='.$admin_id)->setField('admin_auth',$auth);
					//权限END					
				    $this->success("操作成功",U('admin_list'));  	
					exit;						
				}else{
					$this->admin_auth = M('AdminAuth')->where('a_default=0 and a_show=1')->order('a_sort asc')->select();
					$admin_id = intval($_GET['admin_id']);
					$vo = $Admin->where('admin_id='.$admin_id)->find();
					$this->auth = explode(',',$vo['admin_auth']);
					$this->assign('vo',$vo);	
					$this->display('admin_edit');	
				}
				break;
			case 'add':	
				if(IS_POST)
				{
					$data = array();
					$data['admin_name'] = str_rp(trim($_POST['admin_name']));
					$data['admin_pwd'] = re_md5(trim($_POST['admin_pwd']));
					$data['admin_lg_time'] = NOW_TIME;
					$data['admin_lg_ip'] = get_client_ip();
					
					$admin_auth = $_POST['admin_auth'];
					$auth = '';
					if(!empty($admin_auth))
					{
						foreach($admin_auth as $at)
						{
							$auth .= $at.',';
						}	
					}
					$auth_d = M('AdminAuth')->where('a_default=1')->select();
					if(is_array($auth_d) && !empty($auth_d))
					{
						foreach($auth_d as $ad)
						{
							$auth .= $ad['a_id'].',';
						}	
					}
					$auth = substr($auth,0,-1);
					$data['admin_auth'] = $auth;
					
					$Admin->add($data);
				    $this->success("添加成功",U('admin_list'));  	
					exit;					
				}else{
					$this->admin_auth = M('AdminAuth')->where('a_default=0 and a_show=1')->order('a_sort asc')->select();
					$this->display('admin_add');			
				}
				break;							
		}
	}	
	
	//权限管理
	public function auth_list()
	{
		$AdminAuth = M('AdminAuth');
		$op = trim($_GET['op']) ? trim($_GET['op']) : 'list';
		switch($op)
		{
			case 'list':
				$list = $AdminAuth->where('a_default=0')->order('a_sort asc')->select();
				$this->assign('list',$list);		
				$this->display();	
				break;
			case 'del':
			 	$a_id = intval($_GET['a_id']);
			    if($a_id)
				{
					$AdminAuth->where('a_id='.$a_id)->delete(); 
				    $this->success("删除成功",U('auth_list'));  	
					exit;	
				}
				break;
			case 'edit':
				if(IS_POST)
				{
					$a_id = intval($_POST['a_id']);	
					$a_data = array();
					$a_data['a_name'] = str_rp(trim($_POST['a_name']));	
					$a_data['a_title'] = str_rp(trim($_POST['a_title']));
					$a_data['a_sort'] = intval($_POST['a_sort']);	
					$AdminAuth->where('a_id='.$a_id)->save($a_data);
				    $this->success("操作成功",U('auth_list'));  	
					exit;						
				}else{
					$a_id = intval($_GET['a_id']);
					$vo = $AdminAuth->where('a_id='.$a_id)->find();
					$this->assign('vo',$vo);	
					$this->display('auth_edit');	
				}
				break;
			case 'add':	
				if(IS_POST)
				{
					$data = array();
					$data['a_name'] = str_rp(trim($_POST['a_name']));
					$data['a_title'] = str_rp(trim($_POST['a_title']));
					$data['a_sort'] = intval($_POST['a_sort']);	
					$AdminAuth->add($data);
				    $this->success("添加成功",U('auth_list'));  	
					exit;					
				}else{
					$this->display('auth_add');			
				}
				break;							
		}
	}	
	//检查权限名称是否已经存在
	public function check_auth_name()
	{
		$a_id = intval($_GET['a_id']);
		$a_name = trim($_GET['a_name']);
		$map = array();
		if($a_id)$map['a_id'] = array('neq',$a_id);
		$map['a_name'] = array('eq',$a_name);
		$nums = M('AdminAuth')->where($map)->count();
		if($nums > 0)
		{
			echo 'false';
		}else{
			echo 'true';
		}
		exit;	
	}
		
	//检查管理员用户名是否已存在
	public function check_admin_name()
	{
		$admin_name	=	trim($_GET['admin_name']);
		$admininfo = M('Admin')->where('admin_name=\''.$admin_name.'\'')->find();
		if(!empty($admininfo))
		{
			echo 'false';
		}else{
			echo 'true';
		}
		exit;			
	}
	//支付方式管理
	public function payment()
	{
		$Payment = M('Payment');
		if(trim($_GET['op']) == 'edit')
		{
			if(IS_POST)
			{
				$data = array();
				$payment_id = intval($_POST['payment_id']);
				$data['payment_state'] = intval($_POST['payment_state']);
				//配置参数	
				$payment_config	= '';
				$config_array =	explode(',',$_POST["config_name"]); 			
				if(is_array($config_array) && !empty($config_array))
				{
					$config_info = array();
					foreach ($config_array as $k) 
					{
						$config_info[$k] = trim($_POST[$k]);
					}
					$payment_config	= serialize($config_info);
				}
				$data['payment_config'] = $payment_config;	
				$Payment->where('payment_id='.$payment_id)->save($data);
				$this->success("操作成功",U('payment'));  	
				exit;								
			}else{
				$payment_id = intval($_GET['payment_id']);	
				$vo = $Payment->where('payment_id='.$payment_id)->find();	
				$config_array =	unserialize($vo['payment_config']);				
				$this->assign('vo',$vo);	
				$this->assign('config_array',$config_array);
				$this->display('payment_edit');					
			}	
		}else{
			$list =	$Payment->select();
			$this->assign('list',$list);		
			$this->display();			
		}
	}			
	//清理缓存
	public function cache_clear()
	{
		if(IS_POST)
		{
			$cache_type = $_POST['cache'];
			if(is_array($cache_type) && !empty($cache_type))
			{
				$obj_dir = new \Muxiangdao\Dir();
				foreach ($cache_type as $k=>$v)
				{
					switch ($v){
						case 'setting':
							is_file(DATA_PATH.$v.'.php') && @unlink(DATA_PATH.$v.'.php');
							break;	
						case 'logs':
							is_dir(LOG_PATH) && $obj_dir->delDir(LOG_PATH);
							break;
						case 'tpl':
							is_dir(CACHE_PATH) && $obj_dir->delDir(CACHE_PATH);
							break;	
						case 'data':
							is_dir(DATA_PATH) && $obj_dir->delDir(DATA_PATH);
							break;	
						case 'district':
							is_file(DATA_PATH.$v.'.php') && @unlink(DATA_PATH.$v.'.php');
							break;
						case 'seo':
							is_file(DATA_PATH.$v.'.php') && @unlink(DATA_PATH.$v.'.php');
							break;																																						
					}
				}
				$this->success("缓存清除成功");
			}	
		}else{
			$this->display();
		}
	}	
	//关于我们
    public function aboutus()
	{
        $site_version = M('Setting')->where('name=\'site_version\'')->getField('value');//系统版本号
		$this->assign('site_version',$site_version);		
		$this->display();
    }	
	
    //异步获取省以外的其他城市地区
	public function get_city_list()
	{
		$sign = intval($_GET['sign']);
		$cid = intval($_GET['cid']);
		if($cid)
		{
			$District=M('District');
			$city_list=$District->where('upid='.$cid)->order('displayorder asc')->select();
			if($sign==1)$head='<select id="city" name="city" onchange="city()"><option value="0">请选择</option>';
			elseif($sign==2)$head='<select id="town" name="town" onchange="town()"><option value="0">请选择</option>'; 
			else $head='<select id="area" name="area"><option value="0">请选择</option>';
			if(is_array($city_list) && !empty($city_list))
			{
				foreach($city_list as $rs)
				{
					$id=$rs['id'];
					$name=$rs['name'];
					$mid.="<option value='$id'>$name</option>";
				}	
				 header("Cache-Control: no-cache");
				 echo $head.$mid.'</select>';
			}							
		}else{
			echo'';	
		}				
	}
	//地区管理
	public function district()
	{
		$District=M('District');
		$District_list=$District->where('level=1 and upid=0')->order('displayorder asc')->select();
		$this->assign('list', $District_list);	
		$this->display();	
	}
    //异步获取传递过来的城市ID的下级信息
	public function show_district_list()
	{
		$cid = intval($_GET['cid']);
		if($cid)
		{
			$District=M('District');
			$city_list=$District->where('upid='.$cid)->order('displayorder asc')->select();
			$output = json_encode($city_list);
			print_r($output);
			exit;									
		}else{
			echo'';	
		}				
	}
	//删除地区信息
	public function district_del()
	{
		$id=intval($_GET['id']);
		if($id)
		{  
			M('District')->where('id='.$id)->delete(); 
		    //不能随意删除城市信息 
			$this->success('删除成功！', U('Setting/district'));
		}else{
	  		$this->error('添加失败！');
			exit;	
		}
	}
	//常用地区设置
	public function hot_district()
	{
		$District=M('District');
		$hot_list=$District->where('usetype=1')->order('displayorder asc')->select();		
		$this->assign('list', $hot_list);	
		$this->display();				
	}	
	//添加地区设置
	public function add_district()
	{
		if(IS_POST)
		{
			$pid = intval($_POST['pid']);
			$rs = M('District')->where('id='.$pid)->find();
			$c_name = str_rp(trim($_POST['c_name']));
			$data=array();
			$data['name'] = $c_name;
			$data['first_letter'] = str_rp($_POST['first_letter']);
			$data['upid'] = $pid;
			$data['level']= $rs['level']+1;
			$data['status'] = 1;
			$rt = M('District')->add($data);
			if($rt)
			{
				$this->success('添加成功！', U('Setting/district'));
				exit;
			}else{
				$this->error('添加失败！');
			}
		}else{
			$id = intval($_GET['id']);
			$this->assign('pid', $id);		
			$this->display();
		}
	}	
			
	//异步处理 在线编辑
	public function ajax()
	{
		switch ($_GET['branch'])
		{
			case 'displayorder':
			case 'usetype':
			case 'name':
			case 'status':
			    $data_array=array();
				if(trim($_GET['column'])=='displayorder' || trim($_GET['column'])=='usetype' || trim($_GET['column'])=='status')
				{
					$data_array[trim($_GET['column'])] = intval($_GET['value']);
				}else{
					$data_array[trim($_GET['column'])] = trim($_GET['value']);
				}
				M("District")->where('id='.intval($_GET['id']))->save($data_array);
			    echo 'true';exit;
				break;	
			case 'a_sort':
			case 'a_show':
				M("AdminAuth")->where('a_id='.intval($_GET['id']))->setField(trim($_GET['column']),intval($_GET['value']));
			    echo 'true';exit;
				break;									
		}			
	}			
}
<?php
/**
 * 微信
 * @copyright  Copyright (c) 2014-2030 muxiangdao-cn Inc.(http://www.muxiangdao.cn)
 * @license    http://www.muxiangdao.cn
 * @link       http://www.muxiangdao.cn
 * @author	   muxiangdao-cn Team
 */
namespace Toadmin\Controller;
use Think\Controller;
use Think\Page;
class WeixinController extends GlobalController{
	public function _initialize()
	{
		parent::_initialize();
	}
	
	//公众号配置
	public function gzh_setting()
	{
		$wx_id = intval($_POST['wx_id']) ? intval($_POST['wx_id']) : 1;
		if(IS_POST)
		{
			$data = array();
			$data['wx_gzh_name'] = str_rp(trim($_POST['wx_gzh_name']));	
			$data['wx_appid'] = str_rp(trim($_POST['wx_appid']));
			$data['wx_secret'] = str_rp(trim($_POST['wx_secret']));
			$data['wx_api_url'] = str_rp(trim($_POST['wx_api_url']));
			$data['wx_mch_id'] = str_rp(trim($_POST['wx_mch_id']));
			$data['wx_token'] = str_rp(trim($_POST['wx_token'])); //开发者验证token
			$return = M('WxSetting')->where('wx_id='.$wx_id)->save($data);
			if($return)
			{   
				S('wx_access_token',null); //清理础支持的access_token缓存
				$this->success('操作成功', U('gzh_setting'));
			}else{
				$this->error("操作失败");	
			}
		}else{
			$vo = M('WxSetting')->where('wx_id='.$wx_id)->find();
			$this->assign('vo',$vo);
			$this->display();  		
		}
	}
	
	//自定义菜单
	public function wx_menu()
	{
	   $WxMenu = M('WxMenu');
		$list = $WxMenu->where('p_id=0')->order('sort asc')->select();
		if(is_array($list) && !empty($list))
		{
			foreach($list as $key=>$v)
			{			
				$sub_list = $WxMenu->where('p_id='.$v['id'])->order('sort asc')->select();
				$list[$key]['sub'] = $sub_list;
			}			
		}
		$this->assign('list',$list);
		$this->display();  						
	}
	//自定义菜单编辑
	public function wx_menu_edit()
	{
		$WxMenu = M('WxMenu');
		
		if(IS_AJAX && $_GET['id'])
		{
			$id = intval($_GET['id']);
			$rs = $WxMenu->where('id='.$id)->find();
			//if($rs['key_url'])$rs['key_url'] = urldecode($rs['key_url']);
			$this->assign('rs',$rs);
			$this->display();
		}	
		
		if(IS_POST && $_POST['id'])
		{
			$id = intval($_POST['id']);
			$name = str_rp(trim($_POST['name']));
			$type = str_rp(trim($_POST['type']));
			$key_url = str_rp(trim($_POST['key_url']));
			$sort = intval($_POST['sort']);
			if($type == 'click')
			{
				$key_url = 'M1001_'.$id;	
			}
			//else{
			//	if(!preg_match('/http:\/\/[\w.]+[\w\/]*[\w.]*\??[\w=&\+\%]*/is',$key_url))
			//	{
			//		$this->error('【数据】 URL格式错误！');
			//		exit;					
			//	}
			//}
			
			$data = array();
			$data['name'] = $name;
			$data['type'] = $type;
			$data['key_url'] = $key_url;
			$data['sort'] = $sort;
			$WxMenu->where('id='.$id)->save($data); 
			
			$this->success('信息编辑成功', U('Weixin/wx_menu'));	
			exit;					
		}
	}
	//新增子级菜单
	public function wx_menu_add()
	{
		$WxMenu = M('WxMenu');
		if(IS_AJAX && $_GET['id'])
		{
			$id = intval($_GET['id']);
			$rs = $WxMenu->where('id='.$id)->find();
			$this->assign('rs',$rs);
			$this->display();
		}
		if(IS_POST && $_POST['id'])
		{
			$id = intval($_POST['id']);
			$name = str_rp(trim($_POST['name']));
			$type = str_rp(trim($_POST['type']));
			$key_url = str_rp(trim($_POST['key_url']));
			$sort = intval($_POST['sort']);
			if($type == 'click')
			{
				$key_url = 'M1001_'.$id;
			}
			$data = array();
			$data['name'] = $name;
			$data['type'] = $type;
			$data['key_url'] = $key_url;
			$data['p_id'] = $id;
			$data['sort'] = $sort;
			$WxMenu->add($data);
			$this->success('菜单添加成功', U('Weixin/wx_menu'));
			exit;
		}
	}
	//AJAX显示状态切换
	public function isShow(){
		$this->mod = M('WxMenu');
		$menuId = intval($_POST['menuid']);
		$class = trim($_POST['class']);
		$where = array('id'=>$menuId);
		$isShow = $this->mod->where($where)->getField('is_show');
		if ($isShow) {
			$isShow = 0;
			$class .= " disabled";
		}else {
			$isShow = 1;
			$class .= " enabled";
		}
		$this->mod->where($where)->setField('is_show',$isShow);
		$sub = $this->mod->where(array('p_id'=>$menuId))->field('id')->select();
		if (!empty($sub) && is_array($sub)) {
			foreach ($sub as $key => $val){
				$this->mod->where(array('id'=>$val['id']))->setField('is_show',$isShow);
			}
		}
		echo $class;
	}
	//删除菜单
	public function ajaxDelMenu(){
		$this->mod = M('WxMenu');
		$menuId = intval($_POST['id']);
		$sub = $this->mod->where(array('p_id'=>$menuId))->find();
		if (!empty($sub)) {
			echo '请先删除当前菜单下的分级菜单';
			exit();
		}
		$result = $this->mod->where(array('id'=>$menuId))->delete();
		if ($result) {
			echo '菜单删除成功,请同步至服务器';
		}else {
			echo '菜单删除失败';
		}
	}
	//提交到服务器
	public function post_menu()
	{
	   //构造自定义菜单数据
		$WxMenu = M('WxMenu');
		$mu_map = array();
		$mu_map['p_id'] = array('eq',0);
		$mu_map['is_show'] = array('eq',1);
		$list = $WxMenu->where($mu_map)->order('sort asc')->select();		
				
		$post_arr = array();
		$post_sub_arr = array();
		if(is_array($list) && !empty($list))
		{
			foreach($list as $key=>$v)
			{	
				if($v['name'])
				{
					$post_arr['button'][$key]['name'] = $v['name'];
					$sub_mu = array();
					$sub_mu['p_id'] = array('eq',$v['id']);
					$sub_mu['is_show'] = array('eq',1);
					
					$sub_list = $WxMenu->where($sub_mu)->order('sort asc')->field('type,name,key_url')->select();
					$sb = array();
					if(is_array($sub_list) && !empty($sub_list))
					{
						foreach($sub_list as $k=>$sb)
						{	
							if($sb['name'])
							{
								$post_sub_arr[$k]['type'] = $sb['type'];	
								$post_sub_arr[$k]['name'] = $sb['name'];
															
								if($sb['type'] == 'view')
								{
									$post_sub_arr[$k]['url'] = $sb['key_url'];	
								}else{
									$post_sub_arr[$k]['key'] = $sb['key_url'];	
								}
							}							
						}
					}else {
						$post_arr['button'][$key]['type'] = $v['type'];
						if ($v['type'] == 'view') {
							$post_arr['button'][$key]['url'] = $v['key_url'];
						}else {
							$post_arr['button'][$key]['key'] = $v['key_url'];
						}
					}
					if (!empty($post_sub_arr)) {
						$post_arr['button'][$key]['sub_button'] = $post_sub_arr;
					}
					unset($post_sub_arr);	
				}
			}			
		}		
				
		//$post_data = json_encode($post_arr,JSON_UNESCAPED_UNICODE); //防中文转义
		$post_data = json_encode_ex($post_arr);
		$post_data = str_replace("\\/","/",$post_data); 

		$wx_ACCESS_TOKEN = get_wx_AccessToken(1);
		$url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$wx_ACCESS_TOKEN;
		$return = post_url($url,$post_data);
		if($return)
		{
			$this->success('操作成功', U('Weixin/wx_menu'));	
			exit;				
		}
	}
	
	
	//自动回复
	public function wx_msg()
	{
		$WxMsg = M('WxMsg');	
		$list = $WxMsg->order('id asc')->select();
		$this->assign('list',$list);
		$this->display();  					
	}
	//自动回复添加
	public function wx_msg_add()
	{
		$WxMsg = M('WxMsg');	
		if(IS_POST)
		{
			$msg_title = str_rp(trim($_POST['msg_title']));	
			$msg_type = str_rp(trim($_POST['msg_type']));	
			$msg_key = str_rp(trim($_POST['msg_key']));	
			$body = str_rp(trim($_POST['body']));	
			
			$data = array();
			$data['msg_title'] = $this->get_msg_title($msg_key);
			//$data['msg_type'] = $msg_type;
			$data['msg_key'] = $msg_key;
			$data['body'] = $body;
		    
			$return = $WxMsg->add($data);
			if($return)
			{	
				$this->success('操作成功', U('Weixin/wx_msg'));	
				exit;
			}
		}
		//查找类型
		$wx_menu = M('WxMenu')->where('is_show=1 AND type=\'click\'')->select();
		$this->assign('wx_menu',$wx_menu);
		$this->display();  						
	}	
	//消息编辑
	public function wx_msg_edit()
	{
		$WxMsg = M('WxMsg');
		$id = intval($_REQUEST['id']);
		if(IS_GET && $id)
		{
			$rs = $WxMsg->where('id='.$id)->find();
			$this->assign('rs',$rs);
			//查找类型
			$wx_menu = $WxMsg->select();
			$this->assign('wx_menu',$wx_menu);						
			$this->display();  		
		}
		
		if(IS_POST && $id)
		{
			$msg_title = str_rp(trim($_POST['msg_title']));	
			$msg_type = str_rp(trim($_POST['msg_type']));	
			$msg_key = str_rp(trim($_POST['msg_key']));	
			$body = str_rp(trim($_POST['body']));	
			
			$data = array();
			$data['msg_title'] = $this->get_msg_title($msg_key);;
			//$data['msg_type'] = $msg_type;
			$data['msg_key'] = $msg_key;
			$data['body'] = $body;
			$WxMsg->where('id='.$id)->save($data);

			$this->success('操作成功', U('Weixin/wx_msg'));	
			exit;
		}		
		
	}		
	//获取菜单标题
	public function get_msg_title($msg_key)
	{
		$name = M('WxMenu')->where('key_url=\''.$msg_key.'\'')->getField('name');
		return $name;
	}
	//菜单回复信息删除
	public function wx_msg_del()
	{
		$id = intval($_GET['id']);
		$del = M('WxMsg')->where('id='.$id)->delete(); 
		if($del)
		{
			$this->success('删除成功', U('Weixin/wx_msg'));	
			exit;			
		}	
	}
//===================================================================================================	
	//信息列表
	public function wx_list()
	{
		//删除操作
		if(IS_POST)
		{
			if(!empty($_POST['id']))
			{						
			   $bucket = C('OT_BUCKET');						
			   $Oss = new OssApi();
			   if(!empty($_POST['id']) && is_array($_POST['id']))
			   {
					foreach($_POST['id'] as $wx_id)
					{
						$del_info = $this->_mod->where('wx_id='.$wx_id)->field('wx_img')->find();			
						$wx_img = $del_info['wx_img'];
						if($wx_img !='')
						{
							$Oss->deleteObject($bucket,$wx_img);
						}
						$this->_mod->where('wx_id='.$wx_id)->delete();	
					}
					
					 $this->success('信息删除成功', U('Weixin/wx_list'));	
					 exit;	
			   }	
			}else{
				$this->error('请选择要删除的信息！');
				exit;
			}				
		}
		
		$map = array();
		if(intval($_GET['wx_status']) > 0)
		{
			if(intval($_GET['wx_status']) == 10 )$map['wx_status'] = array('eq',0);
			else $map['wx_status'] = array('eq',1);
		}
 		if(trim($_GET['wx_title']))$map['wx_title'] = array('like','%'.trim($_GET['wx_title']).'%');
        if(intval($_GET['wx_cate_id']))$map['wx_cate_id'] = array('eq', intval($_GET['wx_cate_id'])); 
		 
		$count = $this->_mod->where($map)->count();
		$page = new \Think\Page($count,10);
		$limit = $page->firstRow.','.$page->listRows;
	 
		$list = $this->_mod->where($map)->order('wx_sorts desc')->limit($limit)->select();
		$this->assign('list',$list);
		$this->assign('pages',$page->ashow());
		$this->assign('search',$_GET);
		$this->display();	
	}
	
	//信息添加
	public function wx_add()
	{
		if(IS_POST)
		{
			if($_FILES["wx_img"]["size"])
			{
				if(C('aliyun_oss.img_max_size') < $_FILES["wx_img"]["size"])
				{
					$this->error('您上传的图片过大，允许上传最大为'.C('aliyun_oss.img_max_size').'M'.'请重新上传');
					exit;
				}
			}
						
			$data = array();
			$data['wx_cate_id'] = intval($_POST['wx_cate_id']);
			$data['wx_title'] = str_rp(trim($_POST['wx_title']));
			$data['wx_author'] = str_rp(trim($_POST['wx_author']));
			$data['wx_sorts'] = intval($_POST['wx_sorts']);
			$data['wx_keywords'] = str_rp(trim($_POST['wx_keywords']));
			$data['wx_desc'] = trim($_POST['wx_desc']);
			$data['wx_content'] = str_replace('\'','&#39;',$_POST['wx_content']);
			$data['wx_addtime'] = NOW_TIME;	
			$data['wx_status'] = 1;	
		    
			$wx_id = $this->_mod->add($data);
			
			//上传图片处理
			if($wx_id && $_FILES["wx_img"]["size"])
			{
				$file=$_FILES["wx_img"]["tmp_name"];
				$key='ot/wx_'.$wx_id.'.jpg';
				$content = fopen($file, 'r');
				$size= filesize($file);
				$bucket = C('OT_BUCKET');
				$Oss = new OssApi();
				$return=$Oss->putResourceObject($bucket,$key, $content, $size);
				
				if($return)
				{
					$updata_arr['wx_img'] = $key;
					$this->_mod->where('wx_id='.$wx_id)->save($updata_arr);
				}
				fclose($file);		
			}
		   
		   $this->success('添加成功',U('Weixin/wx_list'));		
		   exit;
		}
		
		$this->display();		
	}
	
	//编辑
	public function wx_edit()
	{
		if(intval($_GET['wx_id']))
		{
			$wx_info = $this->_mod->where('wx_id='.intval($_GET['wx_id']))->find();
			$this->assign('wx_info',$wx_info);
			$this->display();	
		}


		if(IS_POST && intval($_POST['wx_id']))
		{
			if($_FILES["wx_img"]["size"])
			{
				if(C('aliyun_oss.img_max_size') < $_FILES["wx_img"]["size"])
				{
					$this->error('您上传的图片过大，允许上传最大为'.C('aliyun_oss.img_max_size').'M'.'请重新上传');
					exit;
				}
			}
						
			$data = array();
			$data['wx_cate_id'] = intval($_POST['wx_cate_id']);
			$data['wx_title'] = str_rp(trim($_POST['wx_title']));
			$data['wx_author'] = str_rp(trim($_POST['wx_author']));
			$data['wx_sorts'] = intval($_POST['wx_sorts']);
			$data['wx_keywords'] = str_rp(trim($_POST['wx_keywords']));
			$data['wx_desc'] = str_rp(trim($_POST['wx_desc']));
			$data['wx_content'] = str_replace('\'','&#39;',$_POST['wx_content']);
			$data['wx_addtime'] = NOW_TIME;	
			$data['wx_status'] = 1;	
		    $wx_id = intval($_POST['wx_id']);
			
			$this->_mod->where('wx_id='.$wx_id)->save($data);
			
			//上传图片处理
			if($wx_id && $_FILES["wx_img"]["size"])
			{
				$file=$_FILES["wx_img"]["tmp_name"];
				$key='ot/wx_'.$wx_id.'.jpg';
				$content = fopen($file, 'r');
				$size= filesize($file);
				$bucket = C('OT_BUCKET');
				$Oss = new OssApi();
				$return=$Oss->putResourceObject($bucket,$key, $content, $size);
				
				if($return)
				{
					$updata_arr['wx_img'] = $key;
					$this->_mod->where('wx_id='.$wx_id)->save($updata_arr);
				}
				fclose($file);		
			}
		   
		   $this->success('更新成功',U('Weixin/wx_list'));		
		   exit;
		}
					
	}
	//微信消息设置
	public function wx_info()
	{
		$WxInfo = M('WxInfo');
		if(IS_POST)
		{
			//删除处理
			if (is_array($_POST['del_id']) && !empty($_POST['del_id']))
			{
				foreach ($_POST['del_id'] as $wx_id)
				{
					$WxInfo->where('wx_id='.$wx_id)->delete(); 
				}
				$this->success("操作成功",U('wx_info'));  	
				exit;
			}else {
				$this->error("请选择要操作的对象"); 	
			}				
		}
		
		$map = array();	
		if(trim($_GET['wx_title']))$map['wx_title'] = array('like','%'.trim($_GET['wx_title']).'%');
		
		$totalRows = $WxInfo->where($map)->count();
		$page = new Page($totalRows,10);	
		$list = $WxInfo->where($map)->limit($page->firstRow.','.$page->listRows)->order('wx_sort desc')->select();
				
		$this->assign('list',$list);
		$this->assign('search',$_GET);	
		$this->assign('show_page',$page->show());		
		$this->display("wx_info_index");	
	}
	public function wx_info_add()
	{
		if(IS_POST)
		{
			$data = array();
			$data['wx_title'] = str_rp(trim($_POST['wx_title']));
			$data['wx_url'] = str_rp(trim($_POST['wx_url']));
			$data['wx_sort'] = intval($_POST['wx_sort']);
			$data['wx_desc'] = str_rp(trim($_POST['wx_desc']));
			$data['wx_addtime'] = NOW_TIME;
            $wx_img = 'wx_'.$data['wx_addtime'];
					
			//图片上传
			if(!empty($_FILES['wx_img']['name']))
			{
				$param = array('savePath'=>'artic/','subName'=>'','files'=>$_FILES['wx_img'],'saveName'=>$wx_img,'saveExt'=>'');				
				$up_return = upload_one($param);
				if($up_return == 'error')
				{
					$this->error('图片上传失败');
					exit;	
				}else{
					$data['wx_img'] = $up_return;	
				}					
			}	
						
			$wx_id = M('WxInfo')->add($data);
			if($wx_id)
			{					 
			 	$this->success('操作成功', U('wx_info'));
				exit;		
			}else{
				 $this->error('操作失败');
			}			
		}else{
			$this->display('wx_info_add');		
		}
	}
	//编辑
	public function wx_info_edit()
	{
		if(IS_POST)
		{
			$wx_id = intval($_POST['wx_id']);
			$data = array();
			$data['wx_title'] = str_rp(trim($_POST['wx_title']));
			$data['wx_url'] = str_rp(trim($_POST['wx_url']));
			$data['wx_sort'] = intval($_POST['wx_sort']);
			$data['wx_desc'] = str_rp(trim($_POST['wx_desc']));
			$data['wx_addtime'] = NOW_TIME;
            $wx_img = 'wx_'.$data['wx_addtime'];
					
			//图片上传
			if(!empty($_FILES['wx_img']['name']))
			{
				$param = array('savePath'=>'artic/','subName'=>'','files'=>$_FILES['wx_img'],'saveName'=>$wx_img,'saveExt'=>'');				
				$up_return = upload_one($param);
				if($up_return == 'error')
				{
					$this->error('图片上传失败');
					exit;	
				}else{
					$data['wx_img'] = $up_return;	
				}					
			}	
						
			$rest = M('WxInfo')->where('wx_id='.$wx_id)->save($data);
			if($rest)
			{					 
			 	$this->success('操作成功', U('wx_info'));
				exit;		
			}else{
				 $this->error('操作失败');
			}			
		}else{
			$wx_id = intval($_GET['wx_id']);
			$this->vo = M('WxInfo')->where('wx_id='.$wx_id)->find();
			$this->display('wx_info_edit');		
		}
	}
			
	public function ajax()
	{
		$this->mod = M('WxMenu');
		switch ($_GET['branch'])
		{
			case 'sort':
			case 'is_show':
				$this->mod->where(array('id'=>intval($_GET['id'])))->setField(trim($_GET['branch']),intval($_GET['value']));
			    echo 'true';exit;
				break;
			case 'name':
				$this->mod->where(array('id'=>intval($_GET['id'])))->setField('name',trim($_GET['value']));
				echo 'true';exit;
				break;
			default:
				echo 'false';exit;
				break;
		}		
			
	}
	
}
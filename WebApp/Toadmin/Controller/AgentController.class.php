<?php
/**
 * 经销商
 * @copyright  Copyright (c) 2014-2030 muxiangdao-cn Inc.(http://www.muxiangdao.cn)
 * @license    http://www.muxiangdao.cn
 * @link       http://www.muxiangdao.cn
 * @author	   muxiangdao-cn Team
 */
namespace Toadmin\Controller;
use Think\Page;
class AgentController extends GlobalController {
	public function _initialize() 
	{
        parent::_initialize();
		$this->model = D('Agent');
	}		
			
	//管理
	public function agent()
	{
		$map = array();
		$true_name = trim($_GET['true_name']);
		if($true_name)$map['true_name'] = array('like','%'.$true_name.'%');
		$totalRows = $this->model->where($map)->count();
		$page = new Page($totalRows,10);	
		$list = $this->model->where($map)->limit($page->firstRow.','.$page->listRows)->order('agent_sort desc')->select();				
		$this->assign('list',$list);
		$this->assign('search',$_GET);	
		$this->assign('page_show',$page->show());		
		$this->display();
	}
	//添加
	public function agent_add()
	{
		if(IS_POST){
			$data = array();
			$data['nick_name'] = trim($_POST['nick_name']);
			$data['true_name'] = trim($_POST['true_name']);
			$data['level_name'] = trim($_POST['level_name']);
			$data['address'] = trim($_POST['address']);
			$data['wexin_id'] = trim($_POST['wexin_id']);
			$data['agent_sort'] = intval($_POST['agent_sort']);
			$data['agent_time'] = NOW_TIME;
            $agent_pic = 'ap_'.$data['agent_time'];
			$agent_ewm = 'ewm_'.$data['agent_time'];		
			//图片上传
			if(!empty($_FILES['agent_pic']['name']))
			{
				$param = array('savePath'=>'agent/','subName'=>'','files'=>$_FILES['agent_pic'],'saveName'=>$agent_pic,'saveExt'=>'');				
				$up_return = upload_one($param);
				if($up_return == 'error')
				{
					$this->error('图片上传失败');
					exit;	
				}else{
					$data['agent_pic'] = $up_return;	
				}					
			}				

			if(!empty($_FILES['agent_ewm']['name']))
			{
				$param = array('savePath'=>'agent/','subName'=>'','files'=>$_FILES['agent_ewm'],'saveName'=>$agent_ewm,'saveExt'=>'');				
				$up_return = upload_one($param);
				if($up_return == 'error')
				{
					$this->error('图片上传失败');
					exit;	
				}else{
					$data['agent_ewm'] = $up_return;	
				}					
			}				
			
			$id = $this->model->add($data);
			if($id)
			{										 
			 	$this->success('操作成功', U('agent'));
				exit;		
			}else{
				 $this->error('操作失败');
			}				
		}else{		
			$this->display();	
		}
	}
	//添加
	public function agent_edit()
	{
		$id = intval($_REQUEST['id']);
		if(IS_POST)
		{
			$data = array();
			$data['nick_name'] = trim($_POST['nick_name']);
			$data['true_name'] = trim($_POST['true_name']);
			$data['level_name'] = trim($_POST['level_name']);
			$data['address'] = trim($_POST['address']);
			$data['wexin_id'] = trim($_POST['wexin_id']);
			$data['agent_sort'] = intval($_POST['agent_sort']);
			$data['agent_time'] = NOW_TIME;
            $agent_pic = 'ap_'.$data['agent_time'];
			$agent_ewm = 'ewm_'.$data['agent_time'];		
			//图片上传
			if(!empty($_FILES['agent_pic']['name']))
			{
				$param = array('savePath'=>'agent/','subName'=>'','files'=>$_FILES['agent_pic'],'saveName'=>$agent_pic,'saveExt'=>'');				
				$up_return = upload_one($param);
				if($up_return == 'error')
				{
					$this->error('图片上传失败');
					exit;	
				}else{
					$data['agent_pic'] = $up_return;	
				}					
			}				

			if(!empty($_FILES['agent_ewm']['name']))
			{
				$param = array('savePath'=>'agent/','subName'=>'','files'=>$_FILES['agent_ewm'],'saveName'=>$agent_ewm,'saveExt'=>'');				
				$up_return = upload_one($param);
				if($up_return == 'error')
				{
					$this->error('图片上传失败');
					exit;	
				}else{
					$data['agent_ewm'] = $up_return;	
				}					
			}				
			
			$return = $this->model->where('id='.$id)->save($data);
			if($return)
			{										 
			 	$this->success('操作成功', U('agent'));
				exit;		
			}else{
				 $this->error('操作失败');
			}				
		}else{
			$rs = $this->model->where('id='.$id)->find();
			$this->assign('rs', $rs);				
			$this->display();	
		}
	}	
	//删除
	public function agent_del()
	{
		if(IS_GET)
		{
			$this->model->where('id='.$_GET['id'])->delete(); 		
		}
		if(IS_POST)
		{
			$map = array();
			$map['id'] = array('in',$_POST['id']);
			$this->model->where($map)->delete(); 
		}
		$this->success("操作成功",U('agent'));  	
		exit;			
	}	
	//在线编辑	
	public function ajax()
	{
		$id = intval($_GET['id']);
		switch(trim($_GET['branch']))
		{
			case 'agent_sort':
			$this->model->where('id='.$id)->setField($_GET['column'],intval($_GET['value']));
			break;					
		}
	}
}
<?php
/**
 * 导航
 * @copyright  Copyright (c) 2014-2030 muxiangdao-cn Inc.(http://www.muxiangdao.cn)
 * @license    http://www.muxiangdao.cn
 * @link       http://www.muxiangdao.cn
 * @author	   muxiangdao-cn Team
 */
namespace Toadmin\Controller;
use Think\Page;
class NavigationController extends GlobalController {
	public function _initialize() 
	{
        parent::_initialize();
		$this->model = D('Navigation');
	}	
	//管理
	public function navigation()
	{
		if(IS_POST)
		{
			//删除处理
			if (is_array($_POST['del_id']) && !empty($_POST['del_id']))
			{
				foreach ($_POST['del_id'] as $nav_id)
				{
					$this->model->where('nav_id='.$nav_id)->delete(); 
				}
				$this->success("操作成功",U('navigation'));  	
				exit;
			}else {
				$this->error("请选择要操作的对象"); 	
			}				
		}
		$map = array();	
		if(trim($_GET['nav_title']))$map['nav_title'] = array('like','%'.trim($_GET['nav_title']).'%');
		if(intval($_GET['nav_location']))$map['nav_location'] = array('eq',intval($_GET['nav_location']));
		
		$totalRows = $this->model->where($map)->count();
		$page = new Page($totalRows,10);	
		$list = $this->model->where($map)->limit($page->firstRow.','.$page->listRows)->order('nav_sort desc')->select();	
				
		$this->assign('list',$list);
		$this->assign('search',$_GET);	
		$this->assign('show_page',$page->show());
		$this->display('navigation_index');				
	}
	//添加
	public function navigation_add()
	{
		if(IS_POST)
		{
			$data = array();
			$data['nav_type'] = intval($_POST['nav_type']);
			$data['nav_title'] = trim($_POST['nav_title']);
			$data['nav_byname'] = trim($_POST['nav_byname']);
			$data['nav_url'] = trim($_POST['nav_url']);
			$data['nav_location'] = intval($_POST['nav_location']);
			$data['nav_new_open'] = intval($_POST['nav_new_open']);
			$data['nav_sort'] = intval($_POST['nav_sort']);
			$nav_id = $this->model->add($data);
			if($nav_id)
			{					 
			 	$this->success('操作成功', U('navigation'));
				exit;		
			}else{
				 $this->error('操作失败');
			}			
		}else{
			$this->display('navigation_add');		
		}
	}
	//编辑
	public function navigation_edit()
	{
		if(IS_POST)
		{
			$nav_id = intval($_POST['nav_id']);
			$data = array();
			$data['nav_type'] = intval($_POST['nav_type']);
			$data['nav_title'] = trim($_POST['nav_title']);
			$data['nav_byname'] = trim($_POST['nav_byname']);
			$data['nav_url'] = trim($_POST['nav_url']);
			$data['nav_location'] = intval($_POST['nav_location']);
			$data['nav_new_open'] = intval($_POST['nav_new_open']);
			$data['nav_sort'] = intval($_POST['nav_sort']);
			$this->model->where('nav_id='.$nav_id)->save($data);
			$this->success('操作成功', U('navigation'));
			exit;					
		}else{
			$nav_id = intval($_GET['nav_id']);
			if($nav_id)
			{
				$vo = $this->model->where('nav_id='.$nav_id)->find();
				$this->assign('vo',$vo);
				$this->display('navigation_edit');					
			}
		}
	}
		
	//异步处理 在线编辑
	public function ajax()
	{
		switch ($_GET['branch'])
		{
			case 'nav_sort':
			    $data_array=array();
				$data_array[trim($_GET['column'])] = intval($_GET['value']);
				$this->model->where('nav_id='.intval($_GET['id']))->save($data_array);
			    echo 'true';exit;
				break;								
		}			
	}	
}
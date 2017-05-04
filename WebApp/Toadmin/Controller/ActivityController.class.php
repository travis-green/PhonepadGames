<?php
/**
 * 活动
 * @copyright  Copyright (c) 2014-2030 muxiangdao-cn Inc.(http://www.muxiangdao.cn)
 * @license    http://www.muxiangdao.cn
 * @link       http://www.muxiangdao.cn
 * @author	   muxiangdao-cn Team
 */
namespace Toadmin\Controller;
use Think\Page;
class ActivityController extends GlobalController {
	public function _initialize() 
	{
        parent::_initialize();
		$this->model = M('Activity');
	}	
	//活动管理
	public function activity()
	{			
		$totalRows = $this->model->count();
		$page = new Page($totalRows,10);	
		$list = $this->model->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('list',$list);
		$this->assign('page_show',$page->show());
		$this->display('activity_list');
	}
	//活动删除
	public function delactivity()
	{
		$activity_id = intval($_GET['activity_id']);
		if($activity_id)
		{
			$this->model->where('activity_id='.$activity_id)->delete(); 
			$this->success("操作成功",U('activity'));  	
			exit;					
		}	
	}
	
}
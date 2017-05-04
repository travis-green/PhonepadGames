<?php
/**
 * 评论
 * @copyright  Copyright (c) 2014-2030 muxiangdao-cn Inc.(http://www.muxiangdao.cn)
 * @license    http://www.muxiangdao.cn
 * @link       http://www.muxiangdao.cn
 * @author	   muxiangdao-cn Team
 */
namespace Toadmin\Controller;
use Think\Page;
class CommentController extends GlobalController {
	public function _initialize() 
	{
        parent::_initialize();
		$this->model = M('Comment');
	}	
	//评论管理
	public function commentlist()
	{
		$map = array();
		$s_type = trim($_GET['s_type']);
		$s_content = trim($_GET['s_content']);
		if($s_type && $s_content)
		{
		$map[$s_type] = array('like','%'.$s_content.'%');
		}			
		$totalRows = $this->model->where($map)->count();
		$page = new Page($totalRows,10);	
		$list = $this->model->where($map)->limit($page->firstRow.','.$page->listRows)->order('add_time desc')->select();				
		$this->assign('list',$list);
		$this->assign('search',$_GET);	
		$this->assign('page_show',$page->show());
		$this->display();
	}
	//删除
	public function comment_del()
	{
		$comment_id =intval($_GET['comment_id']);	
		if($comment_id)
		{
			$store_id = $this->model->where('comment_id='.$comment_id)->getField('store_id');
			$op = $this->model->where('comment_id='.$comment_id)->delete(); 	
			if($op)
			{
				M('Store')->where('store_id='.$store_id)->setDec('score',1); 	
			}
			$this->success("操作成功",U('commentlist'));  	
			exit;			
		}	
	}		
	//推荐
	public function recommend()
	{
		$op = $_REQUEST['op'];
		$comment_id = trim($_REQUEST['comment_id']);
		if($comment_id)
		{
			if($op)
			{
				$this->model->where('comment_id='.$comment_id)->setField('is_recommend',1);	
			}else{
				$this->model->where('comment_id='.$comment_id)->setField('is_recommend',0);	
			}
			$this->success("操作成功",U('commentlist'));  	
			exit;		
		}	
	}			
}
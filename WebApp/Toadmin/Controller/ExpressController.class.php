<?php
/**
 * 商品
 * @copyright  Copyright (c) 2014-2030 muxiangdao-cn Inc.(http://www.muxiangdao.cn)
 * @license    http://www.muxiangdao.cn
 * @link       http://www.muxiangdao.cn
 * @author	   muxiangdao-cn Team
 */
namespace Toadmin\Controller;
use Think\Page;
class ExpressController extends GlobalController {
	public function _initialize() 
	{
        parent::_initialize();
		$this->model = M('Express');
	}	
			
	//管理
	public function express_list()
	{
		$totalRows = $this->model->count();
		$page = new Page($totalRows,10);	
		$list = $this->model->limit($page->firstRow.','.$page->listRows)->order('e_order asc')->select();				
		$this->assign('list',$list);
		$this->assign('page_show',$page->show());				
		$this->display();
	}
	//在线编辑	
	public function ajax()
	{
		$id = intval($_GET['id']);
		if(trim($_GET['branch']) == 'order' || trim($_GET['branch']) == 'state')
		{
  			$this->model->where('id='.$id)->setField($_GET['column'],intval($_GET['value']));
		}
	}
}
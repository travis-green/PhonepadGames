<?php
/**
 * 结算
 * @copyright  Copyright (c) 2014-2030 muxiangdao-cn Inc.(http://www.muxiangdao.cn)
 * @license    http://www.muxiangdao.cn
 * @link       http://www.muxiangdao.cn
 * @author	   muxiangdao-cn Team
 */
namespace Toadmin\Controller;
use Think\Page;
class SettleController extends GlobalController {
	public function _initialize() 
	{
        parent::_initialize();
		$this->model = D('Settle');
	}	
	//管理
	public function settle_manage()
	{
		$map = array();	
		if(trim($_GET['store_name']))$map['store_name'] = array('like','%'.trim($_GET['store_name']).'%');
		if(intval($_GET['state']))$map['state'] = array('eq',intval($_GET['state']));
		
		$totalRows = $this->model->where($map)->count();
		$page = new Page($totalRows,10);	
		$list = $this->model->where($map)->limit($page->firstRow.','.$page->listRows)->order('settle_time desc')->select();	
		
		$this->assign('list',$list);
		$this->assign('search',$_GET);	
		$this->assign('show_page',$page->show());
		$this->display('settle_list');				
	}
	//开始结算
	public function ajax_settle()
	{
		echo json_encode(array('done'=>false,'msg'=>'开发中...'));die;
	}
	//结算操作
	public function settle_state_change()
	{
		$new_state = intval($_GET['new_state']);
		$settle_id = intval($_GET['settle_id']);
		if(($new_state != 2 && $new_state != 4) || $settle_id == 0)
		{
			$this->error("参数错误"); 
			exit;	
		}
		$data = array();
		$data['state'] = $new_state;
		$rs = $this->model->where('settle_id='.$settle_id)->save($data); 
		if($rs)
		{
			$this->success("操作成功",U('settle_manage'));  	
			exit;
		}else{
			$this->error("操作失败"); 	
		}
	}
	//明细
	public function settle_detail()
	{
		$settle_id = intval($_GET['settle_id']);
		if($settle_id <= 0){
			$this->error("参数错误"); 
		}
		$settle_info = $this->model->where(array('settle_id'=>$settle_id))->find();
		if(empty($settle_info))
		{
			$this->error("未找到该结算单信息");
		}
		
		$Order = M('Order');
		$condition = 'state = 3 and store_id = '.$settle_info['store_id'].' and use_time >= '.$settle_info['date_start'].' and use_time <= '.$settle_info['date_end'];
		$totalRows = $Order->where($condition)->count();
		$page = new Page($totalRows,10);	
		$order_list = $Order->where($condition)->limit($page->firstRow.','.$page->listRows)->order('use_time desc')->select();	

		$this->assign('settle_info',$settle_info);
		$this->assign('order_list',$order_list);
		$this->assign('show_page',$page->show());
		$this->display('settle_detail');
	}	
		
}
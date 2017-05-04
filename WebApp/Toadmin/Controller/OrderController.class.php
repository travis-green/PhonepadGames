<?php
/**
 * 交易
 * @copyright  Copyright (c) 2014-2030 muxiangdao-cn Inc.(http://www.muxiangdao.cn)
 * @license    http://www.muxiangdao.cn
 * @link       http://www.muxiangdao.cn
 * @author	   muxiangdao-cn Team
 */
namespace Toadmin\Controller;
use Think\Page;
class OrderController extends GlobalController {
	public function _initialize() 
	{
        parent::_initialize();
		$this->model = D('Order');
	}	
	//管理
	public function order()
	{
		$map = array();
		if(intval($_GET['order_state']))$map['order_state'] = array('eq',intval($_GET['order_state']));
		if(trim($_GET['field']) && trim($_GET['search_name']))$map[$_GET['field']] = array('like','%'.trim($_GET['search_name']).'%');
		$add_time_from = trim($_GET['add_time_from']) ? strtotime(trim($_GET['add_time_from'])) : 0;
		$add_time_to = trim($_GET['add_time_to']) ? strtotime(trim($_GET['add_time_to'])) : 0;
		if($add_time_from && $add_time_to)
		{
			$add_time_to = $add_time_from == $add_time_to ? $add_time_to+86400 : $add_time_to;
			$map['add_time'] = array('between',$add_time_from,$add_time_to);		
		}elseif($add_time_from && !$add_time_to){
			$map['add_time'] = array('egt',$add_time_from);	
		}elseif(!$add_time_from && $add_time_to){
			$map['add_time'] = array('elt',$add_time_to);	
		}
		$order_amount_from = trim($_GET['order_amount_from']) ? trim($_GET['order_amount_from']) : 0;
		$order_amount_to = trim($_GET['order_amount_to']) ? trim($_GET['order_amount_to']) : 0;
		if($order_amount_from && $order_amount_to)
		{
			$map['order_amount'] = array('between',$order_amount_from,$order_amount_to);	
		}elseif($order_amount_from && !$order_amount_to){
			$map['order_amount'] = array('egt',$order_amount_from);	
		}elseif(!$order_amount_from && $order_amount_to){
			$map['order_amount'] = array('elt',$order_amount_from);	
		}
		
		$totalRows = $this->model->where($map)->count();
		$page = new Page($totalRows,10);	
		$list = $this->model->where($map)->limit($page->firstRow.','.$page->listRows)->order('add_time desc')->select();				
		$this->assign('list',$list);
		$this->assign('page_show',$page->show());				
	    $this->assign('search', $_GET);							
		$this->display();
	}
	
	//查看订单	
	public function order_view()
	{
		$order_id = intval($_GET['order_id']);
		if($order_id)
		{
			$vo = $this->model->where('order_id='.$order_id)->relation('OrderGoods')->find();
			$addr = M('OrderAddress')->where('order_id='.$order_id)->find();
			$express = M('Express')->where('e_state=\'1\'')->select(); 
			
			$this->assign('vo', $vo);		
			$this->assign('addr', $addr);		
			$this->assign('express', $express);					
			$this->display();				
		}
	}
	//订单处理
	public function order_op()
	{
		$order_id = intval($_GET['order_id']);
		if($order_id)
		{
			$data = array();
			$data['shipping_name'] = str_rp(trim($_POST['shipping_name']));
			$data['shipping_code'] = str_rp(trim($_POST['shipping_code']));
			$data['shipping_time'] = NOW_TIME;
			$data['order_state'] = 30;
			
			$vo = $this->model->where('order_id='.$order_id)->find();
			if($vo['order_state'] == 20)
			{
				$this->model->where('order_id='.$order_id)->save($data);
				$this->success("操作成功",U('order'));  
				exit;	
			}
		
		}			
	}
	
}
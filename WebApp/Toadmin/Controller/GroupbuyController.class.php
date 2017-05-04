<?php
/**
 * 团购	
 * @copyright  Copyright (c) 2014-2030 muxiangdao-cn Inc.(http://www.muxiangdao.cn)
 * @license    http://www.muxiangdao.cn
 * @link       http://www.muxiangdao.cn
 * @author	   muxiangdao-cn Team
 */
namespace Toadmin\Controller;
use Think\Page;
class GroupbuyController extends GlobalController {
	public function _initialize() 
	{
        parent::_initialize();
		$this->model = M('Groupbuy');
	}	
	//团购管理
	public function groupbuy()
	{
		$group_name = trim($_GET['group_name']);
		$groupbuy_state = intval($_GET['groupbuy_state']);
		$is_audit = intval($_GET['is_audit']);
	    $map = array();	
		if($group_name)$map[$group_name] = array('like','%'.$group_name.'%');
		if($groupbuy_state == 1)
		{
			$map['start_time'] = array('gt',NOW_TIME);
		}elseif($groupbuy_state == 2){
			$map['start_time'] = array('lt',NOW_TIME);
			$map['end_time'] = array('gt',NOW_TIME);	
		}elseif($groupbuy_state == 3){
			$map['end_time'] = array('lt',NOW_TIME);
		}
		if($is_audit)$map['is_audit'] = array('eq',$is_audit);
				
		$totalRows = $this->model->where($map)->count();
		$page = new Page($totalRows,10);	
		$list = $this->model->where($map)->limit($page->firstRow.','.$page->listRows)->select();
		if(is_array($list) && !empty($list))
		{
			foreach($list as $key=>$vo)
			{
				if($vo['start_time'] > NOW_TIME)
				{
					$list[$key]['groupbuy_state']=1;
				}elseif($vo['start_time'] <= NOW_TIME && $vo['end_time'] >= NOW_TIME){
					$list[$key]['groupbuy_state']=2;
				}elseif($vo['end_time'] < NOW_TIME){
					$list[$key]['groupbuy_state']=3;
				}
			}	
		}	
		$this->assign('list',$list);
		$this->assign('search',$_GET);	
		$this->assign('page_show',$page->show());
		$this->display();
	}

	//团购订单
	public function groupbuyorder()
	{
		$Order = M('Order');
		$map = array();
		$s_type = trim($_GET['s_type']);
		$s_content = trim($_GET['s_content']);
		if($s_type && $s_content)
		{
			$map[$s_type] = array('like','%'.$s_content.'%');
		}
		$map['order_type'] = array('eq',1);
		$totalRows = $Order->where($map)->count();
		$page = new Page($totalRows,10);	
		$list = $Order->where($map)->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('list',$list);
		$this->assign('search',$_GET);	
		$this->assign('page_show',$page->show());
		$this->display();		
	}

	//团购订单退款
	public function groupbuyrefund()
	{
		$Refund = M('Refund');
		$map = array();
		$s_type = trim($_GET['s_type']);
		$s_content = trim($_GET['s_content']);
		if($s_type && $s_content)
		{
			$map[$s_type] = array('like','%'.$s_content.'%');
		}
		$totalRows = $Refund->where($map)->count();
		$page = new Page($totalRows,10);	
		$list = $Refund->where($map)->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('list',$list);
		$this->assign('search',$_GET);	
		$this->assign('page_show',$page->show());
		$this->display();			
	}
	//退款审核
	public function refundaudit()
	{
		$Refund = M('Refund');
		if(IS_POST)
		{
			$refund_id = intval($_POST['refund_id']);
			$is_refund = intval($_POST['is_refund']);	
			if($refund_id && in_array($is_refund,array(2,3)))
			{
				$refund = $Refund->where('refund_id='.$refund_id)->find();	
				if(is_array($refund) && !empty($refund))
				{
					$order = M('Order')->where('order_id='.$refund['order_id'])->find();
					$result = $Refund->where('refund_id='.$refund_id)->setField('audit',$is_refund); //更新退款状态
					if($result)
					{
						//审核通过，退款金额返回预存款
						if($is_refund == 2)
						{
							$res1 = M('Member')->where('member_id='.$refund['member_id'])->setInc('predeposit',$refund['refund_price']); //增加预存款
							$res2 = M('OrderPwd')->where(array('order_group_id'=>array('in',$refund['order_pwd_id'])))->delete(); //删除此团购券
							$number = count(explode(',',$refund['order_pwd']));
							$res3 = $this->model->where('group_id='.$order['item_id'])->setInc('buyer_count',$number);
							
							$save_data = array();
							$order_pwd_count = M('OrderPwd')->where('order_id='.$order['order_id'])->count();
							if($order_pwd_count == 0)
							{
								$save_data['state'] = 4;//退款
								M('Order')->where('order_id='.$order['order_id'])->save($save_data);
							}
							M('Order')->where('order_id='.$order['order_id'])->setDec('price',$refund['refund_price']); 
							M('Order')->where('order_id='.$order['order_id'])->setDec('number',$number); 
							
							//预存款日志
							$predeposit_params	= array();
							$predeposit_params['member_id'] = $_SESSION['member_id'];
							$predeposit_params['member_name'] = $_SESSION['member_name'];
							$predeposit_params['type']	= 1;//1.添加
							$predeposit_params['content'] = '订单号：'.$order['order_sn'].',退款金额：'.$refund['refund_price'];
							$predeposit_params['add_time'] = NOW_TIME;
							$res4 = M('PredepositLog')->add($predeposit_params); 						
						}else{
							//审核不通过，取消团购券锁定
							$refundArr = array();
							$refundArr = explode(',',$refund['order_pwd']);
							if(!empty($refundArr))
							{
								foreach($refundArr as $val)
								{
									M('OrderPwd')->where(array('order_group_id'=>$val))->setField('state',1);
								}
							}							
						}
						$this->success("操作成功",U('groupbuyrefund'));  	
						exit;	
					}
				}			
			}
			
		}else{
			$refund_id = intval($_GET['refund_id']);
			if($refund_id)
			{
				//退款信息
				$refund = $Refund->where('refund_id='.$refund_id)->find();	
				if(is_array($refund) && !empty($refund))
				{
					if($refund['audit'] == 1)
					{
						//团购券信息
						$map_pwd = array();
						$map_pwd['order_group_id'] = array('in',$refund['order_pwd_id']);
						$order_pwd = M('OrderPwd')->where($map_pwd)->select();			
						//订单信息
						$order = M('Order')->where('order_id='.$refund['order_id'])->find();
						
						$this->assign('refund',$refund);
						$this->assign('order_pwd',$order_pwd);
						$this->assign('order',$order);					
						$this->display();	
					}
				}		
			}
		}
	}		
	//团购审核
	public function groupbuyaudit()
	{
		if(IS_POST)
		{
			$data = array();
			$group_id = intval($_POST['group_id']);
			$data['is_audit'] = intval($_POST['is_audit']);
			$data['settle'] = intval($_POST['settle']);
			$data['audit_reason'] = trim($_POST['audit_reason']);
			if($data['is_audit'] > 100 || $data['is_audit'] < 0)
			{
				$this->error('分佣比例设置错误');	
			}
			$this->model->where('group_id='.$group_id)->save($data);
			$this->success("操作成功",U('groupbuy'));  	
			exit;			
		}else{
			$group_id = intval($_GET['group_id']);	
			$vo = $this->model->where('group_id='.$group_id)->field('group_id,is_audit,settle,audit_reason')->find();
			$this->assign('vo',$vo);
			$this->display();
		}
	}
   //团购推荐操作
	public function recommend()
	{
        $group_id = intval($_POST['group_id']);
		if($group_id)
		{
			if(intval($_POST['op_type']) == 1) //推荐
			{
				$result = $this->model->where('group_id='.$group_id)->setField('is_hot',2);
			}else{
				$result = $this->model->where('group_id='.$group_id)->setField('is_hot',1);
			}
			if($result)
			{
				$this->success("操作成功",U('groupbuy'));  	
				exit;					
			}else{
				$this->error('操作失败',U('groupbuy'));
			}
		}
	}	
	//查看团购券
	public function groupbuyvoucher()
	{	
		$group_id = intval($_GET['group_id']);			
		$end_time = $this->model->where('group_id='.$group_id)->getField('end_time');
		$this->assign('end_time',$end_time); //结束时间
		
		$map = array();
		$map['item_id'] = array('eq',$group_id);
	    $map['order_type'] = array('eq',1);
		
		$Order = D('Order');		
		$totalRows = $Order->where($map)->count();
		$page = new Page($totalRows,10);	
		$list = $Order->where($map)->relation('OrderPwd')->limit($page->firstRow.','.$page->listRows)->select();		

	    $this->assign('list',$list);
		$this->assign('page_show',$page->show());
		$this->display('voucher_list');
	}	
	//团购开启或者关闭
	public function groupbuystate()
	{
		$is_open = intval($_GET['is_open']);
		$group_id = intval($_GET['group_id']);
		$result = $this->model->where('group_id='.$group_id)->setField('is_open',$is_open);
		if($result)
		{
			$this->success("操作成功",U('groupbuy'));  	
			exit;				
		}else{
			$this->error('操作失败',U('groupbuy'));			
		}
	}	
	
}
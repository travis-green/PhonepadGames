<?php
/**
 * 积分商城
 * @copyright  Copyright (c) 2014-2030 muxiangdao-cn Inc.(http://www.muxiangdao.cn)
 * @license    http://www.muxiangdao.cn
 * @link       http://www.muxiangdao.cn
 * @author	   muxiangdao-cn Team
 */
namespace Toadmin\Controller;
use Think\Page;
class GiftController extends GlobalController {
	public function _initialize() 
	{
        parent::_initialize();
		$this->model = M('Gift');
	}	
	//管理
	public function gift_manage()
	{
		if(IS_POST)
		{
			//删除处理
			if (is_array($_POST['del_id']) && !empty($_POST['del_id']))
			{
				foreach ($_POST['del_id'] as $sg_id)
				{
					$this->model->where('sg_id='.$sg_id)->delete(); 
				}
				$this->success("操作成功",U('gift_manage'));  	
				exit;
			}else {
				$this->error("请选择要操作的对象"); 	
			}				
		}		
		$map = array();
		$sg_name = trim($_GET['sg_name']);
		if($sg_name)$map['sg_name'] = array('eq',$sg_name);
		
		$totalRows = $this->model->where($map)->count();
		$page = new Page($totalRows,10);	
		$list = $this->model->where($map)->limit($page->firstRow.','.$page->listRows)->order('sg_add_time desc,sg_last_change_time desc')->select();				
		$this->assign('list',$list);
		$this->assign('search',$_GET);	
		$this->assign('page_show',$page->show());
		$this->display();
	}
	//新增
	public function gift_add()
	{
		if(IS_POST)
		{
			$data = array();			
			$data['sg_name'] = trim($_POST['sg_name']);
			$data['sg_code'] = trim($_POST['sg_code']);
			$data['sg_intro'] = str_replace('\'','&#39;',$_POST['sg_intro']);
			$data['sg_point'] = intval($_POST['sg_point']);
			$data['sg_price'] = price_format(trim($_POST['sg_price']));
			$data['sg_num'] = intval($_POST['sg_num']);
			$data['sg_limit_num'] = intval($_POST['sg_limit_num']);
			$data['sg_member_degree'] = intval($_POST['sg_member_degree']);
			$data['sg_recommend'] = intval($_POST['sg_recommend']);
			$data['sg_sale'] = intval($_POST['sg_sale']);
			$data['sg_add_time'] = NOW_TIME;
			$data['sg_last_change_time'] = NOW_TIME;
			
			$sg_id = $this->model->add($data);

			if(!empty($_FILES['sg_pic']['name']) && $sg_id)
			{
			    $param = array('savePath'=>'gift/','subName'=>'','files'=>$_FILES['sg_pic'],'saveName'=>'gf_'.$sg_id,'saveExt'=>'');				
				$up_return = upload_one($param);
				if($up_return == 'error')
				{
					$this->error('图片上传失败');
					exit;	
				}else{	
					$this->model->where('sg_id='.$sg_id)->setField('sg_pic',$up_return);
				}					
			}			
			$this->success("操作成功",U('gift_manage'));  	
			exit;			
		}else{
			//会员等级
			$member_degree = M('MemberDegree')->select();	
			$this->assign('member_degree',$member_degree);	
			$this->display();
		}	
	}
	//编辑
	public function gift_edit()
	{
		if(IS_POST)
		{
			$sg_id = intval($_POST['sg_id']);
			$data = array();			
			$data['sg_name'] = trim($_POST['sg_name']);
			$data['sg_code'] = trim($_POST['sg_code']);
			$data['sg_intro'] = str_replace('\'','&#39;',$_POST['sg_intro']);
			$data['sg_point'] = intval($_POST['sg_point']);
			$data['sg_price'] = price_format(trim($_POST['sg_price']));
			$data['sg_num'] = intval($_POST['sg_num']);
			$data['sg_limit_num'] = intval($_POST['sg_limit_num']);
			$data['sg_member_degree'] = intval($_POST['sg_member_degree']);
			$data['sg_recommend'] = intval($_POST['sg_recommend']);
			$data['sg_sale'] = intval($_POST['sg_sale']);
			//$data['sg_add_time'] = NOW_TIME;
			$data['sg_last_change_time'] = NOW_TIME;
			
			if(!empty($_FILES['sg_pic']['name']))
			{
			    $param = array('savePath'=>'gift/','subName'=>'','files'=>$_FILES['sg_pic'],'saveName'=>'gf_'.$sg_id,'saveExt'=>'');				
				$up_return = upload_one($param);
				if($up_return == 'error')
				{
					$this->error('图片上传失败');
					exit;	
				}else{	
					$data['sg_pic'] = $up_return;
				}					
			}
						
			$this->model->where('sg_id='.$sg_id)->save($data);
			$this->success("操作成功",U('gift_manage'));  	
			exit;				
		}else{
			$sg_id = intval($_GET['sg_id']);
			$vo = $this->model->where('sg_id='.$sg_id)->find();
			//会员等级
			$member_degree = M('MemberDegree')->select();	
			$this->assign('member_degree',$member_degree);				
			$this->assign('vo',$vo);	
			$this->display();	
		}
	}
	//订单管理
	public function gift_order()
	{
		$GiftOrder = M('GiftOrder');
		$map = array();
		$member_name = trim($_GET['member_name']);
		$go_state = trim($_GET['go_state']);
		if($member_name)$map['member_name'] = array('eq',$member_name);
		if($go_state)$map['go_state'] = array('eq',$go_state);
		
		$totalRows = $GiftOrder->where($map)->count();
		$page = new Page($totalRows,10);	
		$list = $GiftOrder->where($map)->limit($page->firstRow.','.$page->listRows)->order('go_add_time desc')->select();				
		$this->assign('list',$list);
		$this->assign('search',$_GET);	
		$this->assign('page_show',$page->show());
		$this->display();			
	}	
	//订单详情
	public function order_detail()
	{
		$go_id = intval($_GET['go_id']);
		if($go_id)
		{
			$vo = M('GiftOrder')->where('go_id='.$go_id)->find();
			$this->assign('vo',$vo);
			$this->display();					
		}	
	}
	//发货处理
	public function order_ship()
	{
		$go_id = intval($_GET['go_id']);
		if($go_id)
		{
			$data = array();
			$data['go_state'] = 2;
			$data['go_change_time'] = NOW_TIME;
			$rs = M('GiftOrder')->where('go_id='.$go_id)->save($data);
			if($rs){
				$this->success("礼品订单发货成功",U('gift_order'));  	
				exit;					
			}else{
				$this->error('礼品订单发货失败');
			}
		}			
	}
}
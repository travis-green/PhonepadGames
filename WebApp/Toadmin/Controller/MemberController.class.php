<?php
/**
 * 会员
 * @copyright  Copyright (c) 2014-2030 muxiangdao-cn Inc.(http://www.muxiangdao.cn)
 * @license    http://www.muxiangdao.cn
 * @link       http://www.muxiangdao.cn
 * @author	   muxiangdao-cn Team
 */
namespace Toadmin\Controller;
use Think\Page;
class MemberController extends GlobalController {
	public function _initialize() 
	{
        parent::_initialize();
		$this->model = M('Member');
	}	
	//管理
	public function member()
	{
		$map = array();
		$member_name = trim($_GET['member_name']);
		if($member_name)$map['member_name'] = array('eq',$member_name);
		
		$totalRows = $this->model->where($map)->count();
		$page = new Page($totalRows,10);	
		$list = $this->model->where($map)->limit($page->firstRow.','.$page->listRows)->order('register_time desc')->select();				
		$this->assign('list',$list);
		$this->assign('search',$_GET);	
		$this->assign('page_show',$page->show());
		$this->display();
	}
	//删除
	public function member_del()
	{
		if(IS_GET && $_GET['member_id'])
		{
			$this->model->where('member_id='.intval($_GET['member_id']))->delete(); 		
		}
		$this->success("操作成功",U('member'));  	
		exit;			
	}		
	//重置密码
	public function resetpwd()
	{
		$member_id = intval($_GET['member_id']);
		if($member_id)
		{
			$pwd = '123456'; //默认重置密码为123456
			$pwd = re_md5($pwd);
			$this->model->where('member_id='.$member_id)->setField('pwd',$pwd);
			$this->success("操作成功",U('member'));  	
			exit;					
		}	
	}	
	//等级设置
	public function degree()
	{
		$MemberDegree = M('MemberDegree');
		if($_GET['ajax_submit'] == 'ok')
		{
			$type = trim($_GET['type']);
			$md_id = intval($_GET['md_id']);
			if($type == 'name')
			{
				$rs = $MemberDegree->where('md_id='.$md_id)->setField('md_name',trim($_GET['md_name']));	
			}else{
				$md_to = intval($_GET['md_to']);
				$md_from = $md_to+1;
				$md_fid = $md_id+1;
				$rs_a = $MemberDegree->where('md_id='.$md_id)->setField('md_to',$md_to);
				$rs_b = $MemberDegree->where('md_id='.$md_fid)->setField('md_from',$md_from);
				$rs = $rs_a && $rs_b;					
			}
			//更新缓存
			if($rs)
			{
/*				if(F('member_degree'))
				{
					F('member_degree',NULL);	
				}
				$member_degree = array();
				$tmp_list = $MemberDegree->order('md_id asc')->select();
				if(!empty($tmp_list))
				{
					foreach ($tmp_list as $val)
					{
						$member_degree[$val['md_from'].'-'.$val['md_to']] = $val;
					}
					F('member_degree', $member_degree); 	
				}*/
				echo json_encode(array('done'=>true));die;				
			}else{
				echo json_encode(array('done'=>false));die;	
			}
		}
		$list = $MemberDegree->order('md_id asc')->select();
		$this->assign('list',$list);
		$this->display('member_degree');	
	}
	//分数设置
	public function score()
	{
		$MemberScore = M('MemberScore');
		if($_GET['ajax_submit'] == 'ok')
		{
			$rs = $MemberScore->where('ss_id='.intval($_GET['ss_id']))->setField(trim($_GET['ss_type']),intval($_GET['value']));				
			if($rs)
			{
				echo json_encode(array('done'=>true));die;
			}else{
				echo json_encode(array('done'=>false));die;
			}
		}
		$list = $MemberScore->order('ss_id asc')->select();
		$this->assign('list',$list);		
		$this->display('member_score');	
	}
	//预存款充值管理
	public function predeposit()
	{
		$pc_model = M('PredepositCharge');
		$map = array();
		if($_GET['member_name'])$map['member_name'] = array('eq',trim($_GET['member_name']));	
		if($_GET['status'])$map['status'] = array('eq',intval($_GET['status']));
		
		$totalRows = $pc_model->where($map)->count();
		$page = new Page($totalRows,10);	
		$list = $pc_model->where($map)->limit($page->firstRow.','.$page->listRows)->order('charge_time desc')->select();				
		$this->assign('list',$list);
		$this->assign('search',$_GET);	
		$this->assign('page_show',$page->show());
		$this->display();		
	}	
	//预存款充值信息删除
	public function predeposit_del()
	{
		if(IS_GET && intval($_GET['pre_id']))
		{
			$status = M('PredepositCharge')->where('pre_id='.intval($_GET['pre_id']))->getField('status');
			if($status == 1)
			{
				M('PredepositCharge')->where('pre_id='.intval($_GET['pre_id']))->delete(); 
				$this->success("操作成功",U('predeposit'));  	
				exit;					
			}else{
				$this->error("操作失败",U('predeposit'));  	
				exit;						
			}
		}
	}

}
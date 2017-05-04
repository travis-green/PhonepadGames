<?php
/**
 * 优惠券
 * @copyright  Copyright (c) 2014-2030 muxiangdao-cn Inc.(http://www.muxiangdao.cn)
 * @license    http://www.muxiangdao.cn
 * @link       http://www.muxiangdao.cn
 * @author	   muxiangdao-cn Team
 */
namespace Toadmin\Controller;
use Think\Page;
class CouponController extends GlobalController {
	public function _initialize() 
	{
        parent::_initialize();
		$this->model = M('coupon');
	}	
	//优惠券管理
	public function coupon()
	{
		$map = array();
		$s_type = trim($_GET['s_type']);
		$s_content = trim($_GET['s_content']);
		if($s_type && $s_content)
		{
			$map[$s_type] = array('like','%'.$s_content.'%');
		}	
		if($_GET['s_audit'])$map['audit'] = array('eq',intval($_GET['s_audit']));
				
		$totalRows = $this->model->where($map)->count();
		$page = new Page($totalRows,10);	
		$list = $this->model->where($map)->limit($page->firstRow.','.$page->listRows)->select();				
		$this->assign('list',$list);
		$this->assign('search',$_GET);	
		$this->assign('page_show',$page->show());
		$this->display();
	}
	//审核
	public function audit()
	{
		if(IS_POST)
		{
			$data = array();
			$data['audit'] = intval($_POST['audit']);	
			$data['audit_reason'] = trim($_POST['audit_reason']);	
			$this->model->where('coupon_id='.intval($_POST['coupon_id']))->save($data); 
			$this->success("操作成功",U('coupon'));  	
			exit;			
		}
		if(IS_GET)
		{
			$coupon_id = intval($_GET['coupon_id']);
			$vo = $this->model->where('coupon_id='.$coupon_id)->find();
			$this->assign('vo',$vo);
			$this->display('coupon_audit');		
		}
	}
	//删除
	public function coupon_del()
	{
		//单个删除
		if(isset($_GET['coupon_id']) && !empty($_GET['coupon_id']))
		{
			$result = $this->model->where('coupon_id='.intval($_GET['coupon_id']))->delete(); 
		}
		//批量删除
		if(isset($_POST['coupon_id']) && !empty($_POST['coupon_id']))
		{
			$map = array();
			$map['coupon_id'] = array('in',$_POST['coupon_id']);
			$result = $this->model->where($map)->delete();
		}	
		//操作结果	
		if($result)
		{
			$this->success("操作成功",U('coupon'));  	
			exit;				
		}else{
			$this->error("操作失败",U('coupon'));  					
		}		
	}
	
	//优惠券下载
	public function coupon_download()
	{
		$map = array();
		if($_GET['coupon_name'])$map['coupon_name'] = array('eq',trim($_GET['coupon_name']));
		
		$totalRows = M('CouponDownload')->where($map)->count();
		$page = new Page($totalRows,10);	
		$list = M('CouponDownload')->where($map)->limit($page->firstRow.','.$page->listRows)->order('download_time desc')->select();				
		$this->assign('list',$list);
		$this->assign('search',$_GET);	
		$this->assign('page_show',$page->show());
		$this->display();		
	}		

	//推荐设置
	public function ajax_recommend()
	{
    	$coupon_id = intval($_GET['coupon_id']);
    	$stat = intval($_GET['stat']);
    	if($coupon_id > 0 && ($stat==0 || $stat==1)){
    		$rs = $this->model->where('coupon_id='.$coupon_id)->setField('is_recommend',$stat);
    		if($rs){
    			echo json_encode(array('done'=>true));die;
    		}else{
    			echo json_encode(array('done'=>false));die;
    		}
    	}else{
    		echo json_encode(array('done'=>false));die;
    	}			
	}		
}
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
class AlbumController extends GlobalController {
	public function _initialize() 
	{
        parent::_initialize();
		$this->ac_mod = D('AlbumClass');
		$this->ap_mod = M('AlbumPic');
	}	
	public function album()
	{	
		$map = array();
		$aclass_name = trim($_GET['aclass_name']);
		if($aclass_name)$map['aclass_name'] = array('like','%'.$aclass_name.'%');	
		
		$totalRows = $this->ac_mod->where($map)->count();
		$page = new Page($totalRows,10);	
		$list = $this->ac_mod->where($map)->relation('AlbumPic')->limit($page->firstRow.','.$page->listRows)->order('aclass_sort asc')->select();	
					
		$this->assign('list',$list);
		$this->assign('search',$_GET);	
		$this->assign('page_show',$page->show());				
		$this->display();		
	}	
	//相册添加
	public function album_add()
	{
		if(IS_POST)
		{
			$data = array();
			$data['aclass_name'] = trim($_POST['aclass_name']);	
			$data['aclass_sort'] = intval($_POST['aclass_sort']);
			$data['upload_time'] = NOW_TIME;
			$return = $this->ac_mod->add($data);
			if($return)
			{
				$this->success('操作成功', U('album'));
				exit;
			}else{
				$this->error('操作失败');
			}
		}
		$this->display();	
	}	
	//相册删除
	public function album_del()
	{
		$aclass_id = intval($_GET['aclass_id']);
		if($aclass_id)
		{
			//删除分类
			$this->ac_mod->where('aclass_id='.$aclass_id)->delete();
			//删除图片	
			$list = $this->ap_mod->where('aclass_id='.$aclass_id)->select(); 		
			if(is_array($list) && !empty($list))
			{
				foreach($list as $vo)
				{
					if($vo['apic_cover'])
					{
						@unlink(BasePath.'/Uploads/'.$vo['apic_cover']);			
					}
				}	
			}		
			$this->ap_mod->where('aclass_id='.$aclass_id)->delete(); 
			$this->success("操作成功",U('Album/album'));  	
			exit;				
		}	
	}
	//添加照片
	public function album_pic_add()
	{
		if(IS_POST)
		{
			//.....		
		}else{
			$ac_rs = $this->ac_mod->where('aclass_id='.intval($_GET['aclass_id']))->find();
			$this->assign('ac_rs',$ac_rs);	
			$this->display();
		}
	}
	//批量上传图片
	public function uploadImg()
	{
		if (isset($_POST["PHPSESSID"])) 
		{
			session_id($_POST["PHPSESSID"]);
		}
		$sid = intval($_POST['sid']);
		if (!empty($_POST['category_id']) && !empty($_POST['sid'])){
			$category_id 	= intval($_POST['category_id']);
			$store_id		= $sid;
		}else {
			echo json_encode(array('state'=>'false','message'=>'上传失败'));
			exit;
		}

		/**
		 * 上传图片
		 */
		//$goods_img = 'g_'.$category_id.'_'.NOW_TIME;
		$param = array('savePath'=>'goods/','subName'=>'','files'=>$_FILES['Filedata'],'saveName'=>'','saveExt'=>'');				
		$result = upload_one($param);
		if($result == 'error'){
			echo json_encode(array('state'=>'false','message'=>'上传失败'));
			exit;			
		}else{
			$_POST['pic'] = C('SiteUrl').'/Uploads/'.$result;
			$_POST['pic_thumb'] = C('SiteUrl').'/Uploads/'.$result;
			
			$insert_array = array();
			$insert_array['apic_name']	= $_FILES['Filedata']['name'];
			$insert_array['apic_tag']	= '';
			$insert_array['aclass_id']	= $category_id;
			$insert_array['apic_cover']	= $result;
			$insert_array['apic_size']	= intval($_FILES['Filedata']['size']);
			$insert_array['apic_spec']	= '';
			$insert_array['upload_time']= NOW_TIME;
			$insert_array['store_id']	= $store_id;
			$in_result = $this->ap_mod->add($insert_array);
	
			$data = array();
			$data['file_id'] = $in_result;
			$data['file_name'] = $_POST['pic'];
			$data['file_path'] = $_POST['pic'];
			$data['instance'] = 'goods_image';
			$data['state'] = 'true';
			/**
			 * 整理为json格式
			 */
			$output = json_encode($data);
			echo $output;				
		}		  		
	}	
		
	//照片预览
	public function album_pic()
	{
		$map = array();
		$map['aclass_id'] = array('eq',intval($_GET['aclass_id']));
		$totalRows = $this->ap_mod->where($map)->count();
		$page = new Page($totalRows,16);	
		$list = $this->ap_mod->where($map)->limit($page->firstRow.','.$page->listRows)->order('upload_time desc')->select();				
		$this->assign('list',$list);
		$this->assign('search',$_GET);	
		$this->assign('page_show',$page->show());	
		$this->display();			
	}	
	//替换图片
	public function replace_img_upload()
	{
		if(IS_POST && intval($_POST['apic_id']))
		{
			$apic_id = intval($_POST['apic_id']);
			$rs = $this->ap_mod->where('apic_id='.$apic_id)->find();
			//删除原图
			$apic_cover = $rs['apic_cover']; 
			if($apic_cover)
			{
				$del_img = BasePath.'/Uploads/'.$apic_cover;
				$del_img = iconv('gb2312','utf-8',$del_img);
				@unlink($del_img);				
			}	
			//$apic_cover_arr = explode('.',$rs['apic_cover']);
			//$apic_type = $apic_cover_arr[1];
			/**
			 * 上传新图片
			 */
			$param = array('savePath'=>'goods/','subName'=>'','files'=>$_FILES['file'],'saveName'=>'','saveExt'=>'');				
			$result = upload_one($param);				
			if($result == 'error')
			{
				$this->error('操作失败');		
			}else{
				$data = array();
				$data['apic_name']	= $_FILES['file']['name'];
				$data['apic_cover']	= $result;
				$data['apic_size']	= intval($_FILES['file']['size']);
				$data['upload_time']= NOW_TIME;
				$this->ap_mod->where('apic_id='.$apic_id)->save($data);	
				
				$url = U('Album/album_pic',array('aclass_id'=>$rs['aclass_id']));
				echo '<script language="javascript" type="text/javascript">parent.location.href="'.$url.'";</script>';				
				//$this->success("操作成功",U('Album/album_pic',array('aclass_id'=>$rs['aclass_id'])));  	
				//exit;
			}
		}else{
			$this->assign('apic_id',intval($_GET['apic_id']));
			$this->display();
		}
	}	
	//删除
	public function album_pic_del()
	{
		$apic_id = intval($_GET['apic_id']);
		if($apic_id)
		{
			$rs = $this->ap_mod->where('apic_id='.$apic_id)->find(); 		
			//删除图片
			if($rs['apic_cover'])
			{
				$del_img = BasePath.'/Uploads/'.$rs['apic_cover'];
				$del_img = iconv('gb2312','utf-8',$del_img);
				if(file_exists($del_img))
				{
					@unlink($del_img);	
				}else{
					$this->error('操作失败');	
				}
				$this->ap_mod->where('apic_id='.$apic_id)->delete(); 		
				$this->success("操作成功",U('Album/album_pic',array('aclass_id'=>$rs['aclass_id'])));  	
				exit;	
			}
		}		
	}	
	//在线编辑	
	public function ajax()
	{
		$id = intval($_GET['id']);
		switch(trim($_GET['branch']))
		{
			case 'aclass_sort':
			$this->ac_mod->where('aclass_id='.$id)->setField($_GET['column'],intval($_GET['value']));
			break;
			case 'aclass_name':
			$this->ac_mod->where('aclass_id='.$id)->setField($_GET['column'],trim($_GET['value']));
			break;						
		}
	}
}
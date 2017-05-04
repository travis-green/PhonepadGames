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
class GoodsController extends GlobalController {
	public function _initialize() 
	{
        parent::_initialize();
		$this->model = D('Goods');
	}	
	//分类
	public function goods_class()
	{
	    $GoodsClass = M("GoodsClass");	
		$parent_id = $_GET['gc_parent_id']?intval($_GET['gc_parent_id']):0;
        //$gc_list =  $GoodsClass->where('gc_parent_id=0')->order('gc_sort asc')->select();		
		$tmp_list = getTreeClassList(3);
		if (is_array($tmp_list)){
			foreach ($tmp_list as $k => $v){
				if ($v['gc_parent_id'] == $parent_id){
					/**
					 * 判断是否有子类
					 */
					if ($tmp_list[$k+1]['deep'] > $v['deep']){
						$v['have_child'] = 1;
					}
					$class_list[] = $v;
				}
			}
		}	
		$this->assign('class_list', $class_list);			
		$this->display();		
	}
    //产品类别添加
    public function goods_class_add()
	{
		$GoodsClass = M("GoodsClass");
		if(IS_POST && $_POST['form_submit'] == 'ok')
		{
			$map=array();
			$level = 0;
			$map['gc_name']      = str_rp(trim($_POST['gc_name']));
			$map['gc_parent_id'] = intval($_POST['gc_parent_id']);
			$map['gc_title']      = str_rp(trim($_POST['gc_title']));
			$map['gc_key']      = str_rp(trim($_POST['gc_key']));
			$map['gc_desc']      = str_rp(trim($_POST['gc_desc']));
            $map['gc_sort']      = intval($_POST['gc_sort']);
			if($map['gc_parent_id'])
			{
				$level = $GoodsClass->where('gc_id='.$map['gc_parent_id'])->getField('level');	
			}
			$map['level']      = $level+1;
            $return = $GoodsClass->add($map);
			if($return)
			{
				if(!empty($_FILES['gc_img']['name']))
	            {
	            	$gc_img = 'gc_'.time();
	            	$param = array('savePath'=>'goodsclass/','subName'=>'','files'=>$_FILES['gc_img'],'saveName'=>$gc_img,'saveExt'=>'');
	            	$up_return = upload_one($param);
	            	if($up_return == 'error')
	            	{
	            		$this->error('图片上传失败');
	            		exit;
	            	}else{
	            		$data['gc_img'] = $up_return;
	            		$GoodsClass->where('gc_id='.$return)->save($data);
	            	}
	            }
				$this->success('添加成功！', U('goods_class'));
			}else{
				$this->error('添加失败！');		
			}
		}else{
			/**
			 * 父类列表，只取到第二级
			 */
			$class_list = getTreeClassList(1);
			if (is_array($class_list)){
				foreach ($class_list as $k => $v){
					$class_list[$k]['gc_name'] = str_repeat("&nbsp;",$v['deep']*2).'├ '.$v['gc_name'];
				}
			}	
			$this->gc_parent_id = intval($_GET['gc_parent_id']);		
			$this->assign('class_list', $class_list);		
			$this->display();	
		}
		
    }	

    //产品选择一级类别异步加载二级分类 goods_class_add.html
	public function goods_class_ajax()
	{
		$gc_parent_id = intval($_GET['gc_parent_id']); 
		if($gc_parent_id)
		{
			$GoodsClass = M("GoodsClass");
		    $gc_list =$GoodsClass->where('gc_parent_id='.$gc_parent_id)->select(); 
            if(is_array($gc_list) && !empty($gc_list))
			{
			   foreach($gc_list as $rs)
			   {	
				   $gc_id = $rs['gc_id'];
				   $gc_name = $rs['gc_name'];
				   $gc_v.="<option  value='$gc_id'>&nbsp;&nbsp;$gc_name</option>";	
			   }
			}			
		}
		echo "<select name='gc_parent_id_2' id='gc_parent_id_2'><option value='0'>请选择...</option>".$gc_v."</select>";
	}	

	//异步获取产品下级分类
	public function goods_nc_ajax()
	{
	 	$gc_parent_id = $_GET['gc_parent_id']?intval($_GET['gc_parent_id']):0;
		$tmp_list = getTreeClassList(3); //取分类列表
		if (is_array($tmp_list))
		{
			foreach ($tmp_list as $k => $v)
			{
				if ($v['gc_parent_id'] == $gc_parent_id)
				{
					/**
					 * 判断是否有子类
					 */
					if ($tmp_list[$k+1]['deep'] > $v['deep'])
					{
						$v['have_child'] = 1;
					}
					$class_list[] = $v;
				}
			}
		}	
		$output = json_encode($class_list);
		print_r($output);
		exit;			
	}
	
	//编辑分类
	public function goods_class_edit()
	{
		$GoodsClass = M("GoodsClass");
		if(IS_POST && $_POST['gc_id'])
		{
			$data = array();
			$level = 0;
			$data['gc_id'] = intval($_POST['gc_id']);
			$data['gc_name'] = str_rp(trim($_POST['gc_name']));
			$data['gc_parent_id'] = intval($_POST['gc_parent_id']);
			$data['gc_title']      = str_rp(trim($_POST['gc_title']));
			$data['gc_key']      = str_rp(trim($_POST['gc_key']));
			$data['gc_desc']      = str_rp(trim($_POST['gc_desc']));			
            $data['gc_sort']      = intval($_POST['gc_sort']);
			if($data['gc_parent_id'])
			{
				$level = $GoodsClass->where('gc_id='.$data['gc_parent_id'])->getField('level');	
			}
			$data['level']      = $level+1;			
            //图片上传
            if(!empty($_FILES['gc_img']['name']))
            {
            	$gc_img = 'gc_'.time();
            	$param = array('savePath'=>'goodsclass/','subName'=>'','files'=>$_FILES['gc_img'],'saveName'=>$gc_img,'saveExt'=>'');
            	$up_return = upload_one($param);
            	if($up_return == 'error')
            	{
            		$this->error('图片上传失败');
            		exit;
            	}else{
            		$data['gc_img'] = $up_return;
            	}
            }
            if ($GoodsClass->where('gc_id='.$data['gc_id'])->save($data)) {
            	$this->success('操作成功！', U('goods_class'));
            }else {
            	$this->error('操作失败！');
            }
		}else{
			$gc_id = intval($_GET['gc_id']);
			$rs = $GoodsClass->where('gc_id='.$gc_id)->find();
				/**
				 * 父类列表，只取到第二级
				 */
				$class_list = getTreeClassList(1);
				if (is_array($class_list)){
					foreach ($class_list as $k => $v){
						$class_list[$k]['gc_name'] = str_repeat("&nbsp;",$v['deep']*2).'├ '.$v['gc_name'];
					}
				}		
			$this->assign('class_list', $class_list);	
			$this->assign('rs',$rs);	
			$this->display();	
		}
	}	
	//删除分类信息
	public function goods_class_del()
	{
		$GoodsClass = M("GoodsClass");
		$gc_id = intval($_GET['gc_id']);	
		if($gc_id)
		{
			$map = array();
			$all_next_gc_id='';
			$in_arr = get_all_gc_id($gc_id); //该分类下的所有分类
			$all_next_gc_id='';
			$map['gc_id'] = array('in',$in_arr);
			$gc_list = $GoodsClass->where($map)->select();
			if(is_array($gc_list) && !empty($gc_list))
			{
				foreach($gc_list as $gc)
				{
					if($gc['gc_img'])
					{
						//删除图片
						@unlink(BasePath.'/Uploads/'.$gc['gc_img']);	
					}
				}	
			}			
			$delnum = $GoodsClass->where($map)->delete(); 
			if($delnum)
			{
				$this->success('操作成功！', U('goods_class'));
			}else{
				$this->error('操作失败！');
			}
		}
	}	
			
	//管理
	public function goods()
	{
		$map = array();
		$goods_name = trim($_GET['goods_name']);
		$gc_id = intval($_GET['gc_id']);
		if($goods_name)$map['goods_name'] = array('like','%'.$goods_name.'%');
		if($gc_id)
		{
			$all_next_gc_id='';
			$in_arr = get_all_gc_id($gc_id); //该分类下的所有分类
			$all_next_gc_id='';
			$map['gc_id'] = array('in',$in_arr);	
		}
		$totalRows = $this->model->where($map)->count();
		$page = new Page($totalRows,10);	
		$list = $this->model->where($map)->relation('GoodsClass')->limit($page->firstRow.','.$page->listRows)->order('add_time desc')->select();				
		$this->assign('list',$list);
		$this->assign('search',$_GET);	
		$this->assign('page_show',$page->show());
		/**
		 * 父类列表，只取到第二级
		 */
		$class_list = getTreeClassList(3);
		if (is_array($class_list)){
			foreach ($class_list as $k => $v){
				$class_list[$k]['gc_name'] = str_repeat("&nbsp;",$v['deep']*2).'├ '.$v['gc_name'];
			}
		}			
		$this->assign('class_list', $class_list);	
					
		$this->display();
	}
	//添加
	public function goods_add()
	{
		if(IS_POST){
			$data = array();
			$data['gc_id'] = intval($_POST['gc_id']);
			$data['goods_name'] = str_rp(trim($_POST['goods_name']));
			$data['goods_key'] = str_rp(trim($_POST['goods_key']));
			$data['goods_desc'] = str_rp(trim($_POST['goods_desc']));
			$data['goods_url'] = str_rp(trim($_POST['goods_url']));
			$data['goods_storage'] = intval($_POST['goods_storage']);
			$data['goods_serial'] = str_rp(trim($_POST['goods_serial']));
			$data['goods_price'] = price_format(trim($_POST['goods_store_price']));
			$data['goods_sort'] = intval($_POST['goods_sort']);
			$data['goods_body'] = str_replace('\'','&#39;',$_POST['goods_body']);
			$data['goods_sign'] = intval($_POST['goods_sign']);
			$data['add_time'] = NOW_TIME;
					
			//图片上传
			if(!empty($_FILES['goods_pic']['name']))
			{
				$goods_img = 'g_'.$data['add_time'];
				$param = array('savePath'=>'goods/','subName'=>'','files'=>$_FILES['goods_pic'],'saveName'=>$goods_img,'saveExt'=>'');				
				$up_return = upload_one($param);
				if($up_return == 'error')
				{
					$this->error('图片上传失败');
					exit;	
				}else{
					$data['goods_pic'] = $up_return;	
				}					
			}	
			if(!empty($_FILES['goods_big_pic']['name']))
			{
				$goods_img = 'g_big_'.$data['add_time'];
				$param = array('savePath'=>'goods/','subName'=>'','files'=>$_FILES['goods_big_pic'],'saveName'=>$goods_img,'saveExt'=>'');				
				$up_return = upload_one($param);
				if($up_return == 'error')
				{
					$this->error('图片上传失败');
					exit;	
				}else{
					$data['goods_big_pic'] = $up_return;	
				}					
			}			
			$goods_id = $this->model->add($data);
			if($goods_id)
			{	
			    //规格处理
				$spec_val = $_POST['s_value'];
				if(is_array($spec_val) && !empty($spec_val))
				{
					foreach ($spec_val as $k=>$val)
					{
						$val['sort']	= intval($val['sort']);	
						$val['name']	= trim($val['name']);
						$val['price']	= trim($val['price']);
                        if($val['name'] && $val['price'])
						{
							/**
							 * 新增规格值
							 */
							$val_add	= array();
							$val_add['goods_id'] = $goods_id;
							$val_add['spec_name'] = trim($val['name']);
							$val_add['spec_goods_price'] = price_format(trim($val['price']));
							$val_add['spec_goods_sort']	= intval($val['sort']);
							$return = M('GoodsSpec')->add($val_add);
							unset($val_add);	
						}
					}
					//更新商品列表默认规格信息
					$df_spec = M('GoodsSpec')->where('goods_id='.$goods_id)->order('spec_goods_price asc')->find();
					if(is_array($df_spec) && !empty($df_spec))
					{
						$spec_data = array();
						$spec_data['spec_id'] = $df_spec['spec_id'];	
						$spec_data['spec_name'] = $df_spec['spec_name'];	
						$spec_data['goods_price'] = $df_spec['spec_goods_price'];
						$this->model->where('goods_id='.$goods_id)->save($spec_data);	
					}
				}													 
			 	$this->success('操作成功', U('goods'));
				exit;		
			}else{
				 $this->error('操作失败');
			}				
		}else{
			/**
			 * 父类列表
			 */
			$class_list = getTreeClassList(3);
			if (is_array($class_list)){
				foreach ($class_list as $k => $v){
					$class_list[$k]['gc_name'] = str_repeat("&nbsp;",$v['deep']*2).'├ '.$v['gc_name'];
				}
			}		
			//规格
			$spec_list = D('Spec')->relation('SpecValue')->where('sp_show=1')->order('sp_sort asc')->select();
			
			//相册
			$ac_list = M('AlbumClass')->order('aclass_sort asc')->select();
			$pc_list = M('AlbumPic')->where('aclass_id=1')->order('upload_time asc')->select();
			
			$this->assign('ac_list', $ac_list);
			$this->assign('pc_list', $pc_list);
			
			$this->assign('class_list', $class_list);
			$this->assign('spec_list', $spec_list);		
			$this->assign('sign_i', count($spec_list));				
			$this->display();	
		}
	}
	//添加
	public function goods_edit()
	{
		$goods_id = intval($_REQUEST['goods_id']);
		if(IS_POST){
			$data = array();
			$data['gc_id'] = intval($_POST['gc_id']);
			$data['goods_name'] = str_rp(trim($_POST['goods_name']));
			$data['goods_key'] = str_rp(trim($_POST['goods_key']));
			$data['goods_desc'] = str_rp(trim($_POST['goods_desc']));
			$data['goods_url'] = str_rp(trim($_POST['goods_url']));
			$data['goods_storage'] = intval($_POST['goods_storage']);
			$data['goods_serial'] = str_rp(trim($_POST['goods_serial']));
			$data['goods_price'] = price_format(trim($_POST['goods_store_price']));
			$data['goods_sort'] = intval($_POST['goods_sort']);
			$data['goods_body'] = str_replace('\'','&#39;',$_POST['goods_body']);
			$data['goods_sign'] = intval($_POST['goods_sign']);
			$data['add_time'] = NOW_TIME;
					
			//图片上传
			if(!empty($_FILES['goods_pic']['name']))
			{
				$goods_img = 'g_'.$data['add_time'];
				$gd = $this->model->where('goods_id='.$goods_id)->find();
				if($gd['goods_pic'])
				{	
					$old_pic = BasePath.'/Uploads/'.$gd['goods_pic'];			
					unlink($old_pic);	
				}
				$param = array('savePath'=>'goods/','subName'=>'','files'=>$_FILES['goods_pic'],'saveName'=>$goods_img,'saveExt'=>'');				
				$up_return = upload_one($param);
				if($up_return == 'error')
				{
					$this->error('图片上传失败');
					exit;	
				}else{
					$data['goods_pic'] = $up_return;	
				}					
			}
			if(!empty($_FILES['goods_big_pic']['name']))
			{
				$goods_img = 'g_big_'.$data['add_time'];
				$gd = $this->model->where('goods_id='.$goods_id)->find();
				if($gd['goods_big_pic'])
				{	
					$old_pic = BasePath.'/Uploads/'.$gd['goods_big_pic'];			
					unlink($old_pic);	
				}
				$param = array('savePath'=>'goods/','subName'=>'','files'=>$_FILES['goods_big_pic'],'saveName'=>$goods_img,'saveExt'=>'');				
				$up_return = upload_one($param);
				if($up_return == 'error')
				{
					$this->error('图片上传失败');
					exit;	
				}else{
					$data['goods_big_pic'] = $up_return;	
				}					
			}				
						
			$return = $this->model->where('goods_id='.$goods_id)->save($data);
			if($return)
			{
			    //规格处理
				$GoodsSpec = M('GoodsSpec');
				$spec_val = $_POST['s_value'];
				if(is_array($spec_val) && !empty($spec_val))
				{
					$GoodsSpec->where('goods_id='.$goods_id)->delete($data); // 删除原来的规格
					foreach ($spec_val as $k=>$val)
					{
						$val['sort']	= intval($val['sort']);	
						$val['name']	= trim($val['name']);
						$val['price']	= trim($val['price']);
                        if($val['name'] && $val['price'])
						{
							/**
							 * 新增规格值
							 */
							$val_add	= array();
							$val_add['goods_id'] = $goods_id;
							$val_add['spec_name'] = trim($val['name']);
							$val_add['spec_goods_price'] = price_format(trim($val['price']));
							$val_add['spec_goods_sort']	= intval($val['sort']);
							$return = $GoodsSpec->add($val_add);
							unset($val_add);	
						}
					}
					//更新商品列表默认规格信息
					$df_spec = M('GoodsSpec')->where('goods_id='.$goods_id)->order('spec_goods_price asc')->find();
					if(is_array($df_spec) && !empty($df_spec))
					{
						$spec_data = array();
						$spec_data['spec_id'] = $df_spec['spec_id'];	
						$spec_data['spec_name'] = $df_spec['spec_name'];	
						$spec_data['goods_price'] = $df_spec['spec_goods_price'];
						$this->model->where('goods_id='.$goods_id)->save($spec_data);	
					}					
				}else{
					$spec_data = array();
					$spec_data['spec_id'] = 0;	
					$spec_data['spec_name'] = '';	
					$this->model->where('goods_id='.$goods_id)->save($spec_data);						
					$GoodsSpec->where('goods_id='.$goods_id)->delete($data); // 删除原来的规格	
				}	
																		 
			 	$this->success('操作成功', U('goods'));
				exit;		
			}else{
				 $this->error('操作失败');
			}				
		}else{
			/**
			 * 父类列表
			 */
			$class_list = getTreeClassList(3);
			if (is_array($class_list)){
				foreach ($class_list as $k => $v){
					$class_list[$k]['gc_name'] = str_repeat("&nbsp;",$v['deep']*2).'├ '.$v['gc_name'];
				}
			}	
			
			$rs = $this->model->where('goods_id='.$goods_id)->find();
			$this->assign('rs', $rs);	
			
			//规格
			$spec_list = M('GoodsSpec')->where('goods_id='.$goods_id)->order('spec_goods_sort asc')->select();
			
			//相册
			$ac_list = M('AlbumClass')->order('aclass_sort asc')->select();
			$pc_list = M('AlbumPic')->where('aclass_id=1')->order('upload_time asc')->select();
			$this->assign('ac_list', $ac_list);
			$this->assign('pc_list', $pc_list);
			$this->assign('spec_list', $spec_list);			
			$this->assign('spec_list_i', count($spec_list)+1);		
			$this->assign('class_list', $class_list);			
			$this->display();	
		}
	}	
	//删除
	public function goods_del()
	{
		if(IS_GET)
		{
			$this->model->where('goods_id='.$_GET['goods_id'])->delete(); 
			M('GoodsSpec')->where('goods_id='.$_GET['goods_id'])->delete();		
		}
		if(IS_POST)
		{
			$map = array();
			$map['goods_id'] = array('in',$_POST['goods_id']);
			$this->model->where($map)->delete();
			M('GoodsSpec')->where($map)->delete(); 
		}
		$this->success("操作成功",U('goods'));  	
		exit;			
	}	
	//异步获取图片
	public function get_album_list()
	{
		$sign = intval($_GET['sign']);
		$aclass_id = intval($_GET['aclass_id']);
		if($aclass_id)
		{
			//$AlbumClass = M('AlbumClass');
			$AlbumPic = M('AlbumPic');
			$pic_list=$AlbumPic->where('aclass_id='.$aclass_id)->order('upload_time asc')->select();
			if(is_array($pic_list) && !empty($pic_list))
			{
				foreach($pic_list as $rs)
				{
					$apic_cover = C('SiteUrl').'/Uploads/'.$rs['apic_cover'];
					if($sign==1)
					{
						$pic_list_str.='<li onclick="insert_img_editor(\''.$apic_cover.'\');"><a href="JavaScript:void(0);"><span class="thumb size90"><img src="'.$apic_cover.'" title="点击插入"></span></a></li>';
					}else{
						$pic_list_str.='<li onclick="insert_img(\''.$apic_cover.'\');"><a href="JavaScript:void(0);"><span class="thumb size90"><img src="'.$apic_cover.'" title="点击插入"></span></a></li>';
					}
				}	
				 header("Cache-Control: no-cache");
				 echo $pic_list_str;
			}							
		}else{
			echo'';	
		}				
	}	
	//在线编辑	
	public function ajax()
	{
		$id = intval($_GET['id']);
		switch(trim($_GET['branch']))
		{
			case 'gc_sort':
			M('GoodsClass')->where('gc_id='.$id)->setField($_GET['column'],intval($_GET['value']));
			break;
			case 'gc_name':
			M('GoodsClass')->where('gc_id='.$id)->setField($_GET['column'],trim($_GET['value']));
			break;	
			case 'goods_sort':
			M('Goods')->where('goods_id='.$id)->setField($_GET['column'],intval($_GET['value']));
			break;					
		}
	}
}
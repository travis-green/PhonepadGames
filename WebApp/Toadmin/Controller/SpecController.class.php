<?php
/**
 * 商品
 * @copyright  Copyright (c) 2014-2030 muxiangdao-cn Inc.(http://www.muxiangdao.cn)
 * @license    http://www.muxiangdao.cn
 * @link       http://www.muxiangdao.cn
 * @author	   muxiangdao-cn Team
 */
namespace Toadmin\Controller;
class SpecController extends GlobalController {
	public function _initialize() 
	{
        parent::_initialize();
		$this->model = M('Spec');
	}	
	public function spec()
	{
		$spec_list = $this->model->order('sp_sort asc')->select();	
		$this->assign('spec_list', $spec_list);			
		$this->display();		
	}
	//删除规格
	public function spec_del()
	{
		echo'开发中...';	
	}
	//编辑
	public function spec_edit()
	{
		$SpecValue = M('SpecValue');
		if(IS_POST){
			/**
			 * 更新规格值表
			 */
			$string_value	= '';
			$spec_val		= $_POST['s_value'];
			if(is_array($spec_val) && !empty($spec_val))
			{
				// 要删除的规格值id
				$del_array	= array();
				if(!empty($_POST['s_del']))
				{
					$del_array	= $_POST['s_del'];
				}
				
				foreach ($spec_val as $k=>$val)
				{
					$val['name']	= trim($val['name']);
					$val['sort']	= intval($val['sort']);
					
					if(isset($val['form_submit']) && $val['form_submit'] == 'ok' && !in_array($k, $del_array)) //原有规格已修改
					{		
						if($_POST['s_dtype'] == 'text') //文字模式
						{								
							/**
							 * 判断原有图片是否存在，如存在删除
							 */
							if(isset($val['image']) && $val['image'] != '')
							{
								/**
								 * 删除图片
								 */
								@unlink(C('SiteUrl').'/Uploads/'.$val['image']);
							}
							
							$val['image'] = '';
						}else if($_POST['s_dtype'] == 'image'){	//图片模式
							/**
							 * 图片上传
							 */
							if(!empty($_FILES['s_value_'.$k]['name']))
							{
								
								if(isset($val['image']) && $val['image'] != '')
								{
									/**
									 * 删除图片
									 */
									@unlink(C('SiteUrl').'/Uploads/'.$val['image']);
								}
	                            $spc_img_name = 'spc_'.NOW_TIME.$k;
								$param = array('savePath'=>'spec/','subName'=>'','files'=>$_FILES['s_value_'.$k],'saveName'=>$spc_img_name,'saveExt'=>'');				
								$up_return = upload_one($param);
								if($up_return == 'error')
								{
									$this->error('图片上传失败');
								}else{
									$val['image'] = $up_return;
								}
							}
						}
						/**
						 * 更新规格值
						 */
						$spc_data = array();
						$spc_data['sp_value_name'] = $val['name'];
						$spc_data['sp_value_image'] = $val['image'];
						$spc_data['sp_value_sort'] = $val['sort'];
						
						$spc_map = array();
						$spc_map['sp_value_id'] = array('eq',$k);
						$spc_map['sp_id'] = array('eq',intval($_POST['s_id']));
						$return = $SpecValue->where($spc_map)->save($spc_data);
						if(!$return){
							$this->error('规格信息更新失败');
						}
						$string_value	.= $val['name'].',';
						unset($spc_data);
						unset($spc_map);
					}else if(isset($val['form_submit']) && $val['form_submit'] == ''  && !in_array($k, $del_array)){	//原有规格未修改	
						
						if($_POST['s_dtype'] == 'text') //文字模式
						{								
							
							/**
							 * 判断原有图片是否存在，如存在删除
							 */
							if(isset($val['image']) && $val['image'] != '')
							{
								/**
								 * 删除图片
								 */
								@unlink(C('SiteUrl').'/Uploads/'.$val['image']);
								
								/**
								 * 更新规格值
								 */
								$spc_map = array();
								$spc_map['sp_value_id'] = array('eq',$k);	
								$spc_map['sp_id'] = array('eq',intval($_POST['s_id']));							 
								$return = $SpecValue->where($spc_map)->setField('sp_value_image','');
								if(!$return)
								{
									$this->error('规格信息更新失败');
								}
								unset($spc_map);
							}
							
							$val['image'] = '';
						}
						
						$string_value	.= $val['name'].',';
						
					}else if(!in_array($k, $del_array)){  //新添加规格值
						/**
						 * 图片上传
						 */
						$val['image'] = '';
						if($_POST['s_dtype'] == 'image') //图片模式
						{								
							/**
							 * 图片上传
							 */
							if(!empty($_FILES['s_value_'.$k]['name']))
							{
							    $spc_img_name = 'spc_'.NOW_TIME.$k;
								$param = array('savePath'=>'spec/','subName'=>'','files'=>$_FILES['s_value_'.$k],'saveName'=>$spc_img_name,'saveExt'=>'');				
								$up_return = upload_one($param);
								if($up_return == 'error')
								{
									$this->error('图片上传失败');
								}else{
									$val['image'] = $up_return;
								}
							}
						}
						
						/**
						 * 新增规格值
						 */
						$val_add	= array();
						$val_add['sp_value_name']	= trim($val['name']);
						$val_add['sp_id']			= intval($_POST['s_id']);
						$val_add['sp_value_image']	= $val['image'];
						$val_add['sp_value_sort']	= trim($val['sort']);
						$return = $SpecValue->add($val_add);
						unset($val_add);
						if(!$return)
						{
							$this->error('规格添加失败');
						}
						$string_value	.= $val['name'].',';
					}
				}
				
				// 删除规格值表
				if(!empty($_POST['s_del']))
				{
					$del_id	= implode(',', $_POST['s_del']);
					$del_map = array();
					$del_map['sp_value_id']  = array('in',$del_id);
					$SpecValue->where($del_map)->delete();
					foreach($_POST['s_del'] as $val)
					{
						if(!empty($_POST['s_value'][$val]['image']))
						{
							/**
							 * 删除图片
							 */
							@unlink(C('SiteUrl').'/Uploads/'.$_POST['s_value'][$val]['image']);
						}
					}
					unset($del_map);
				}
			}
		
			/**
			 * 更新规格表
			 */
			$param_spc		= array();
			$param_spc['sp_name']		= trim($_POST['s_name']);
			$param_spc['sp_format']		= $_POST['s_dtype'];
			$param_spc['sp_value']		= rtrim($string_value,',');
			$param_spc['sp_sort']		= intval($_POST['s_sort']);
			$return = M('Spec')->where('sp_id='.intval($_POST['s_id']))->save($param_spc);
			if($return)
			{
				$this->success('操作成功', U('spec'));
			}else{
				$this->error('操作失败！');	
			}
							
		}else{ //读取规格列表信息
			
			$sp_id 	= intval($_GET['sp_id']);
			if($sp_id){
				$spec_list = $this->model->where('sp_id='.$sp_id)->find();	
				$sp_value	= $SpecValue->where('sp_id='.$sp_id)->order('sp_value_sort asc')->select();
				$this->assign('sp_list', $spec_list);	
				$this->assign('sp_value', $sp_value);		
				$this->display();			
			}else{
				$this->error('请求失败！');			
			}			
		}
	}
	/**
	 * ajax操作
	 */
	public function ajax()
	{
		switch ($_GET['branch']){
			case 'sort':
			case 'name':
			case 'sp_show':
				$return = $this->model->where('sp_id='.intval($_GET['id']))->setField(trim($_GET['column']),trim($_GET['value']));
				if($return){
					echo 'true';exit;
				}else{
					echo 'false';exit;
				}
				break;
		}
	}
}
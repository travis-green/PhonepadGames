<?php
/**
 * 商铺
 * @copyright  Copyright (c) 2014-2030 muxiangdao-cn Inc.(http://www.muxiangdao.cn)
 * @license    http://www.muxiangdao.cn
 * @link       http://www.muxiangdao.cn
 * @author	   muxiangdao-cn Team
 */
namespace Toadmin\Controller;
use Think\Page;
class StoreController extends GlobalController {
	public function _initialize() 
	{
        parent::_initialize();
	}	
	//商户管理
	public function storelist()
	{
		$Store = M('Store');
		$op = trim($_GET['op']) ? trim($_GET['op']) : 'list';
		if($op == 'list') //管理
		{
			$store_state = $_GET['store_state'] ? $_GET['store_state'] : 2;
			$_GET['store_state'] = $store_state;
			$map = array();	
			$map['store_state'] = array('eq',$store_state);
			if($_GET['is_audit'])$map['is_audit'] = array('eq',intval($_GET['is_audit']));
			if(trim($_GET['store_name']))$map['store_name'] = array('like','%'.trim($_GET['store_name']).'%');
			if($_GET['city_id'])$map['city_id'] = array('eq',intval($_GET['city_id']));
			
			$totalRows = $Store->where($map)->count();
			$page = new Page($totalRows,10);	
			$list = $Store->where($map)->limit($page->firstRow.','.$page->listRows)->order('add_time desc')->select();
			$city = M('District')->where('level=2 and upid=24')->order('d_sort asc')->select();
			
			$this->assign('city',$city);				
			$this->assign('list',$list);
			$this->assign('search',$_GET);	
			$this->assign('page_show',$page->show());
			$this->display();
		}
		if($op == "add") //创建商铺账号
		{
			if(IS_POST)
			{
				$data = array();
				$data['store_name'] = trim($_POST['store_name']);
				$data['account'] = trim($_POST['account']);
				$data['pwd'] = re_md5(trim($_POST['pwd']));
				$data['add_time'] = NOW_TIME;
				if($Store->add($data))
				{
					$this->success("操作成功",U('storelist'));  	
					exit;							
				} 
			}else{
				$this->display("storeadd");	
			}
		}
		
	}
	//商户密码修改
	public function changepwd()
	{
		$Store = M('Store');
		$store_id = intval($_REQUEST['store_id']);	
		if(IS_POST && $store_id)
		{
			$pwd = re_md5(trim($_POST['pwd']));
			$Store-> where('store_id='.$store_id)->setField('pwd',$pwd); 
			$this->success("操作成功",U('storelist'));  	
			exit;			
		}else{
			$vo = $Store->where('store_id='.$store_id)->field('store_id,account')->find();
			$this->assign('vo',$vo);
			$this->display();		
		}
	}
	
	//商户分类管理
	public function storeclass()
	{
		$StoreClass = M('StoreClass');
		$list = $StoreClass->order('class_sort asc')->select();
		$this->assign('list',$list);
		$this->display();				
	}
	//商户分类添加
	public function storeclass_add()
	{
		$StoreClass = M('StoreClass');
		if(IS_POST)
		{
			$data = array();
			$data['class_name'] = trim($_POST['class_name']);
			$data['class_pid'] = intval($_POST['class_pid']);
			$data['class_sort'] = intval($_POST['class_sort']);
			$data['class_recommend'] = intval($_POST['class_recommend']);
			$class_id = $StoreClass->add($data); 
			
			if(!empty($_FILES['class_img']['name']) && $class_id)
			{
			    $param = array('savePath'=>'storeclass/','subName'=>'','files'=>$_FILES['class_img'],'saveName'=>'sc_'.$class_id,'saveExt'=>'');				
				$up_return = upload_one($param);
				if($up_return == 'error')
				{
					$this->error('图片上传失败');
					exit;	
				}else{	
					$StoreClass->where('class_id='.$class_id)->setField('class_img',$up_return);
				}					
			}
			$this->success("添加成功",U('storeclass'));  	
			exit;								
		}else{
			$p_class = $StoreClass->where('class_pid=0')->order('class_sort asc')->select();		
			$this->assign('class_pid',intval($_GET['class_pid']));
			$this->assign('p_class',$p_class);
			$this->display();		
		}
	}
	//商户分类删除
	public function storeclass_del()
	{
		$class_id = trim($_POST['class_id']);
        $condition = array();
        $condition['class_pid'] = array('in',$class_id);
        $class_list =  M('StoreClass')->where($condition)->field('class_id,class_img')->select();
        if(!empty($class_list) && is_array($class_list)) 
		{
            foreach($class_list as $val) 
			{
                $class_id .= ','.$val['class_id']; 
				if($val['class_img'])
				{
					$img = C('SiteUrl').'/Uploads/'.$val['class_img'];
					if(is_file($img))unlink($img);	
				}
            }
        }
        $class_id = rtrim($class_id,',');
        $map = array();
        $map['class_id'] = array('in',$class_id);		
		M('StoreClass')->where($map)->delete(); 
		$this->success("操作成功",U('storeclass'));  	
		exit;		
	}
	//商户分类编辑
	public function storeclass_edit()
	{
		$StoreClass = M('StoreClass');
		if(IS_POST && intval($_POST['class_id']))
		{
			$class_id = intval($_POST['class_id']);
			$data = array();
			$data['class_name'] = trim($_POST['class_name']);
			$data['class_pid'] = intval($_POST['class_pid']);
			$data['class_sort'] = intval($_POST['class_sort']);
			$data['class_recommend'] = intval($_POST['class_recommend']);
			$StoreClass->where('class_id='.$class_id)->save($data); 
			
			if(!empty($_FILES['class_img']['name']) && $class_id)
			{
			    $param = array('savePath'=>'storeclass/','subName'=>'','files'=>$_FILES['class_img'],'saveName'=>'sc_'.$class_id,'saveExt'=>'');				
				$up_return = upload_one($param);
				if($up_return == 'error')
				{
					$this->error('图片上传失败');
					exit;	
				}else{	
					$StoreClass->where('class_id='.$class_id)->setField('class_img',$up_return);
				}					
			}
			$this->success("添加成功",U('storeclass'));  	
			exit;								
		}else{
			$class_id = intval($_GET['class_id']);
			if($class_id)
			{
				$p_class = $StoreClass->where('class_pid=0')->order('class_sort asc')->select();		
				$vo = $StoreClass->where('class_id='.$class_id)->find();
				$this->assign('vo',$vo);
				$this->assign('p_class',$p_class);
				$this->display();		
			}
		}			
	}
	
    //ajax修改分类信息
    public function ajax_update_class()
	{
    	$type = trim($_GET['type']);
    	$class_id = intval($_GET['class_id']);
    	$value = trim($_GET['value']);
    	if($type == 'class_settle' && intval($value) > 100)
		{
    		echo json_encode(array('done'=>false,'msg'=>'分佣比例不能超过100%'));die;
    	}
    	if($class_id > 0 && $type != '')
		{
			$rs = M('StoreClass')->where('class_id='.$class_id)->setField($type,$value);
    		if($rs){
    			echo json_encode(array('done'=>true));die;
    		}else{
    			echo json_encode(array('done'=>false,'msg'=>'修改失败'));die;
    		}
    	}else{
    		echo json_encode(array('done'=>false,'msg'=>'参数错误'));die;
    	}
    }	
	//ajax修改分类推荐状态
    public function ajax_recommend()
	{
    	$class_id = intval($_GET['class_id']);
    	$stat = intval($_GET['stat']);
    	if($class_id > 0 && ($stat==0 || $stat==1))
		{
    		$rs = M('StoreClass')->where('class_id='.$class_id)->setField('class_recommend',$stat);
    		if($rs){
    			echo json_encode(array('done'=>true));die;
    		}else{
    			echo json_encode(array('done'=>false));die;
    		}
    	}else{
    		echo json_encode(array('done'=>false));die;
    	}
    }	
	//检查商铺账号是否已存在
	public function storecheck()
	{
		$where = trim($_GET['account']) ? 'account=\''.trim($_GET['account']).'\'' : 'store_name=\''.trim($_GET['store_name']).'\'';	
		$num = M('Store')->where($where)->count();
		if($num > 0)
		{
			echo 'false';
		}else{
			echo 'true';
		}
		exit;		
	}
	
	//异步处理 在线编辑
/*	public function ajax()
	{
		switch ($_GET['branch'])
		{
			case 'd_sort':
			case 'usetype':
			case 'name':
			    $data_array=array();
				if(trim($_GET['column'])=='d_sort' || trim($_GET['column'])=='usetype')
				{
					$data_array[trim($_GET['column'])] = intval($_GET['value']);
				}else{
					$data_array[trim($_GET['column'])] = trim($_GET['value']);
				}
				M("District")->where('id='.intval($_GET['id']))->save($data_array);
			    echo 'true';exit;
				break;					
		}			
	}*/
				
}
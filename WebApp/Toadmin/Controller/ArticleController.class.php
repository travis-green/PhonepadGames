<?php
/**
 * 文章
 * @copyright  Copyright (c) 2014-2030 muxiangdao-cn Inc.(http://www.muxiangdao.cn)
 * @license    http://www.muxiangdao.cn
 * @link       http://www.muxiangdao.cn
 * @author	   muxiangdao-cn Team
 */
namespace Toadmin\Controller;
use Think\Page;
class ArticleController extends GlobalController {
	public function _initialize() 
	{
        parent::_initialize();
		$this->art = D('Article');
		$this->art_class = M('ArticleClass');
	}	
	//分类管理
	public function article_class()
	{	
		if(IS_POST) //删除
		{
			if (!empty($_POST['check_ac_id']))
			{
				if (is_array($_POST['check_ac_id']))
				{
					foreach ($_POST['check_ac_id'] as $ac_id)
					{ 
						$this->art_class->where('ac_id='.$ac_id)->delete(); 
						$this->art_class->where('ac_parent_id='.$ac_id)->delete(); 
					}
					$this->success("操作成功",U('article_class'));  	
					exit;						
				}
			}else {
				$this->error("请选择要操作的对象"); 	
			}				
		}else{			
			$list = $this->art_class->where('ac_parent_id=0')->order('ac_sort asc')->select();
			if(is_array($list) && !empty($list))
			{
				foreach($list as $key=>$lt)
				{
					$sub = $this->art_class->where('ac_parent_id='.$lt['ac_id'])->order('ac_sort asc')->select();
					$list[$key]['sub'] = $sub;	
				}	
			}
			$this->assign('list',$list);
			$this->display('articleclass_list');
		}
	}
	//分类编辑
	public function article_class_edit()
	{
		if(IS_POST)
		{
			$ac_id = intval($_POST['ac_id']);
			$data = array();
			$data['ac_parent_id'] = intval($_POST['ac_parent_id']);
			$data['ac_name'] = trim($_POST['ac_name']);
			$data['ac_title'] = str_rp(trim($_POST['ac_title']));
			$data['ac_key'] = str_rp(trim($_POST['ac_key']));
			$data['ac_desc'] = str_rp(trim($_POST['ac_desc']));			
			$data['ac_sort'] = intval($_POST['ac_sort']);	
			$num = $this->art_class->where('ac_name=\''.$data['ac_name'].'\' and ac_id<>'.$ac_id)->count();
			if($num > 0)
			{
				$this->error("已存在相同的名称",U('article_class_edit',array('ac_id'=>$ac_id))); 	
			}
			$this->art_class->where('ac_id='.$ac_id)->save($data);
			$this->success("操作成功",U('article_class'));  	
			exit;			 			
		}else{
			$ac_id = intval($_GET['ac_id']);
			$vo = $this->art_class->where('ac_id='.$ac_id)->find();
			$this->ac_list = $this->art_class->where('ac_parent_id=0')->select();
			$this->assign('vo',$vo);
			$this->display('articleclass_edit');	
		}
	}
	//分类添加
	public function article_class_add()
	{
		if(IS_POST)
		{
			$data = array();
			$data['ac_parent_id'] = intval($_POST['ac_parent_id']);
			$data['ac_name'] = str_rp(trim($_POST['ac_name']));
			$data['ac_title'] = str_rp(trim($_POST['ac_title']));
			$data['ac_key'] = str_rp(trim($_POST['ac_key']));
			$data['ac_desc'] = str_rp(trim($_POST['ac_desc']));			
			$data['ac_sort'] = intval($_POST['ac_sort']);	
			$num = $this->art_class->where('ac_name=\''.$data['ac_name'].'\'')->count();
			if($num > 0)
			{
				$this->error("已存在相同的名称",U('article_class_add')); 	
			}
			$return = $this->art_class->add($data);
			if($return)
			{
				$this->success("操作成功",U('article_class'));  	
				exit;				
			}
		}else{
			$this->ac_list = $this->art_class->where('ac_parent_id=0')->select();
			$this->display('articleclass_add');
		}
	}
	//文章管理
	public function article()
	{
		if(IS_POST)
		{
			//删除处理
			if (is_array($_POST['del_id']) && !empty($_POST['del_id']))
			{
				foreach ($_POST['del_id'] as $article_id)
				{
					//删除图片
					$article_pic = $this->art->where('article_id='.$article_id)->getField('article_pic');
					if($article_pic)
					{
						@unlink(BasePath.'/Uploads/'.$article_pic);						
					}
					$this->art->where('article_id='.$article_id)->delete(); 
				}
				$this->success("操作成功",U('article'));  	
				exit;
			}else {
				$this->error("请选择要操作的对象"); 	
			}				
		}
		$map = array();	
		if(trim($_GET['article_title']))$map['article_title'] = array('like','%'.trim($_GET['article_title']).'%');
		if(intval($_GET['ac_id']))$map['ac_id'] = array('eq',intval($_GET['ac_id']));
		$article_show = intval($_GET['article_show']);
		if($article_show)
		{
			if($article_show == 1)
			{
				$map['article_show'] = array('eq',1);	
			}else{
				$map['article_show'] = array('neq',1);		
			}
		}
		
		$totalRows = $this->art->where($map)->count();
		$page = new Page($totalRows,10);	
		$list = $this->art->where($map)->relation('ArticleClass')->limit($page->firstRow.','.$page->listRows)->order('article_sort desc')->select();
			
		$ac_list = getArticleClassList(2);
		if (is_array($ac_list)){
			foreach ($ac_list as $k => $v){
				$ac_list[$k]['ac_name'] = str_repeat("&nbsp;",$v['deep']*2).'├ '.$v['ac_name'];
			}
		}		
		$this->assign('ac_list', $ac_list);	
				
		$this->assign('list',$list);
		$this->assign('search',$_GET);	
		$this->assign('show_page',$page->show());
		$this->display('article_index');				
	}
	//文章添加
	public function article_add()
	{
		if(IS_POST)
		{
			$data = array();
			$data['article_title'] = str_rp(trim($_POST['article_title']));
			$data['ac_id'] = intval($_POST['ac_id']);
			$data['article_key'] = str_rp(trim($_POST['article_key']));
			$data['article_desc'] = str_rp(trim($_POST['article_desc']));
			$data['article_url'] = str_rp(trim($_POST['article_url']));
			$data['article_show'] = intval($_POST['article_show']);
			$data['article_sort'] = intval($_POST['article_sort']);
			$data['article_content'] = str_replace('\'','&#39;',$_POST['article_content']);
			$data['article_time'] = NOW_TIME;
            $arc_img = 'g_'.$data['article_time'];
					
			//图片上传
			if(!empty($_FILES['article_pic']['name']))
			{
				$param = array('savePath'=>'artic/','subName'=>'','files'=>$_FILES['article_pic'],'saveName'=>$arc_img,'saveExt'=>'');				
				$up_return = upload_one($param);
				if($up_return == 'error')
				{
					$this->error('图片上传失败');
					exit;	
				}else{
					$data['article_pic'] = $up_return;	
				}					
			}	
						
			$article_id = $this->art->add($data);
			if($article_id)
			{	
									 
			 	$this->success('操作成功', U('article'));
				exit;		
			}else{
				 $this->error('操作失败');
			}			
		}else{
			$ac_list = getArticleClassList(2);
			if (is_array($ac_list)){
				foreach ($ac_list as $k => $v){
					$ac_list[$k]['ac_name'] = str_repeat("&nbsp;",$v['deep']*2).'├ '.$v['ac_name'];
				}
			}		
			$this->assign('ac_list', $ac_list);	
			$this->assign('ac_list',$ac_list);	
			$this->display('article_add');		
		}
	}
	//文章编辑
	public function article_edit()
	{
		if(IS_POST)
		{
			$article_id = intval($_POST['article_id']);
			$data = array();
			$data['article_title'] = str_rp(trim($_POST['article_title']));
			$data['ac_id'] = intval($_POST['ac_id']);
			$data['article_key'] = str_rp(trim($_POST['article_key']));
			$data['article_desc'] = str_rp(trim($_POST['article_desc']));
			$data['article_url'] = str_rp(trim($_POST['article_url']));
			$data['article_show'] = intval($_POST['article_show']);
			$data['article_sort'] = intval($_POST['article_sort']);
			$data['article_content'] = str_replace('\'','&#39;',$_POST['article_content']);
			$data['article_time'] = NOW_TIME;
            $arc_img = 'g_'.$data['article_time'];
					
			//图片上传
			if(!empty($_FILES['article_pic']['name']))
			{
				$param = array('savePath'=>'artic/','subName'=>'','files'=>$_FILES['article_pic'],'saveName'=>$arc_img,'saveExt'=>'');				
				$up_return = upload_one($param);
				if($up_return == 'error')
				{
					$this->error('图片上传失败');
					exit;	
				}else{
					$data['article_pic'] = $up_return;	
				}					
			}				
			
			$this->art->where('article_id='.$article_id)->save($data);
			$this->success('操作成功', U('article'));
			exit;					
		}else{
			$article_id = intval($_GET['article_id']);
			if($article_id)
			{
				$vo = $this->art->where('article_id='.$article_id)->find();
				$ac_list = $this->art_class->order('ac_sort asc')->select();
				$this->assign('vo',$vo);
				$this->assign('ac_list',$ac_list);	
				$this->display('article_edit');					
			}
		}
	}
	//系统文章
	public function document()
	{
		$list = M('Document')->select();
		$this->assign('list',$list);
		$this->display('document_index');			
	}
	//系统文章编辑
	public function document_edit()
	{
		$Document = M('Document');
		if(IS_POST)
		{
			$doc_id = intval($_POST['doc_id']);	
			if($doc_id)
			{
				$data = array();
				$data['doc_title'] = str_rp(trim($_POST['doc_title']));	
				$data['doc_key'] = str_rp(trim($_POST['doc_key']));	
				$data['doc_desc'] = str_rp(trim($_POST['doc_desc']));	
				$data['doc_content'] = str_replace('\'','&#39;',$_POST['doc_content']);
				$data['doc_time'] = NOW_TIME;
				$Document->where('doc_id='.$doc_id)->save($data); 
			 	$this->success('操作成功', U('document'));
				exit;				
			}			
		}else{
			$doc_id = intval($_GET['doc_id']);	
			$vo = $Document->where('doc_id='.$doc_id)->find();
			$this->assign('vo',$vo);
			$this->display('document_edit');			
		}
	}
		
	//异步处理 在线编辑
	public function ajax()
	{
		switch ($_GET['branch'])
		{
			case 'article_class_sort':
			case 'article_class_name':
			    $data_array=array();
				if(trim($_GET['column'])=='ac_sort')
				{
					$data_array[trim($_GET['column'])] = intval($_GET['value']);
				}else{
					$data_array[trim($_GET['column'])] = trim($_GET['value']);
				}
				$this->art_class->where('ac_id='.intval($_GET['id']))->save($data_array);
			    echo 'true';exit;
				break;								
		}			
	}	
}
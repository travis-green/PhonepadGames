<?php
namespace Home\Controller;
use Think\Page;

class IndexController extends BaseController {
	public function __construct()
	{
		parent::__construct();
		$this->Seo = M('Seo');
		$this->article_class = M('ArticleClass')->order('ac_sort asc')->select();
	}  
    public function index()
	{	
		//滚动图
		$this->banner = M('AdvPosition')->where('ap_code=\'banner\'')->select();
		//中部广告图
		$this->index_ad = M('AdvPosition')->where('ap_code=\'index\'')->limit(4)->select();
		//友情链接
		$this->link = M('AdvPosition')->where('ap_code=\'link\'')->select();
		//资讯
		$Article = M('Article');
		$art_arr = array();
		if(is_array($this->article_class) && !empty($this->article_class))
		{
			foreach($this->article_class as $ac)
			{
				$art_arr[$ac['ac_id']] = $Article->where('article_show=1 and ac_id='.$ac['ac_id'])->order('article_sort desc')->limit(4)->select();
			}	
		}
		$this->art_arr = $art_arr;
		//SEO
    	$seo = $this->Seo->where('type=\'index\'')->find();
		$this->seo_set($seo['title'],$seo['keywords'],$seo['description']);
		$this->display();
	}
	//新闻
	public function news()
	{
		$Article = M('Article');
		$ArticleClass = M('ArticleClass');
		$this->ac_id = intval($_GET['ac_id']);
		$this->ac_info = $ArticleClass->where('ac_id='.$this->ac_id)->find();
         
		$map = array();
		if($this->ac_id)
		{
			$map['ac_id'] = array('eq',$this->ac_id); 
			$this->seo_set($this->ac_info['ac_title'],$this->ac_info['ac_key'],$this->ac_info['ac_desc']);
		}else{
			$seo = $this->Seo->where('type=\'news\'')->find();
			$this->seo_set($seo['title'],$seo['keywords'],$seo['description']);				
		}
		$totalRows=$Article->where($map)->count();
		$listRows=10;
		$page=new Page($totalRows,$listRows);
		$this->art_list=$Article->where($map)->limit($page->firstRow.','.$page->listRows)->order('article_sort desc,article_time desc')->select();
		$this->assign('page',$page->show());
				
		$this->display();
	}
	public function news_view()
	{
		$Article = M('Article');
		$ArticleClass = M('ArticleClass');
		$id = intval($_GET['id']);
		$this->art_info = $Article->where('article_id='.$id)->find();
		$this->ac_info = $ArticleClass->where('ac_id='.$this->art_info['ac_id'])->find();
		$this->seo_set($this->art_info['article_title'],$this->art_info['article_key'],$this->art_info['article_desc']);
		$this->display();
	}
    public function page (){
        $Data = M('Character'); // 实例化Data数据对象  date 是你的表名
        import('ORG.Util.Page');// 导入分页类
        $count = $Data->where($type)->count();// 查询满足要求的总记录数 $map表示查询条件
        $Page = new Page($count);// 实例化分页类 传入总记录数
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询
        $list = $Data->where($type)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select(); // $Page->firstRow 起始条数 $Page->listRows 获取多少条
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }
}
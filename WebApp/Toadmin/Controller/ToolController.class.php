<?php
/**
 * 工具
 * @author 杨
 */
namespace Toadmin\Controller;
use Think\Db;

class ToolController extends GlobalController{
	public function _initialize() {
        parent::_initialize();
    }
   
   //数据库管理
	public function dbbackup()
	{
		$type = I('type','export','trim');
		switch ($type) {
			/* 数据还原 */
/*			case 'import':
				//列出备份文件列表
				$path = realpath(C('DATA_BACKUP_PATH'));
				$flag = \FilesystemIterator::KEY_AS_FILENAME;
				$glob = new \FilesystemIterator($path,  $flag);
				$list = array();
				foreach ($glob as $name => $file) {
					if(preg_match('/^\d{8,8}-\d{6,6}-\d+\.sql(?:\.gz)?$/', $name)){
						$name = sscanf($name, '%4s%2s%2s-%2s%2s%2s-%d');
		
						$date = "{$name[0]}-{$name[1]}-{$name[2]}";
						$time = "{$name[3]}:{$name[4]}:{$name[5]}";
						$part = $name[6];
		
						if(isset($list["{$date} {$time}"])){
							$info = $list["{$date} {$time}"];
							$info['part'] = max($info['part'], $part);
							$info['size'] = $info['size'] + $file->getSize();
						} else {
							$info['part'] = $part;
							$info['size'] = $file->getSize();
						}
						$extension        = strtoupper(pathinfo($file->getFilename(), PATHINFO_EXTENSION));
						$info['compress'] = ($extension === 'SQL') ? '-' : $extension;
						$info['time']     = strtotime("{$date} {$time}");
		
						$list["{$date} {$time}"] = $info;
					}
				}
				break;*/
		
				/* 数据表列表 */
			case 'export':
				$Db    = Db::getInstance();
				$list  = $Db->query('SHOW TABLE STATUS');
				$list  = array_map('array_change_key_case', $list);
				break;
		
			default:
				$this->error('参数错误！');
		}
		$this->assign('list', $list);
		$this->display();
	}	
	/**
	 * 优化表
	 */
	public function optimize(){
		$tables = $_REQUEST['tables'];
		
		if($tables) {
			$Db   = Db::getInstance();
			if(is_array($tables)){
				$tables = implode('`,`', $tables);
				$list = $Db->query("OPTIMIZE TABLE `{$tables}`");
	
				if($list){
					$this->ajaxReturn(1,"数据表优化完成！");
				} else {
					$this->ajaxReturn(0,"数据表优化出错请重试！");
				}
			} else {
				$list = $Db->query("OPTIMIZE TABLE `{$tables}`");
				$tables_ts = substr($tables,3);
				if($list){
					$this->ajaxReturn(1,"数据表'{$tables_ts}'优化完成！");
				} else {
					$this->ajaxReturn(0,"数据表'{$tables_ts}'优化出错请重试！");
				}
			}
		} else {
			$this->ajaxReturn(0,"请指定要优化的表！");
		}
	}
	
	
	/**
	 * 修复表
	 */
/*	
	public function repair($tables = null){
		if($tables) {
			$Db   = Db::getInstance();
			if(is_array($tables)){
				$tables = implode('`,`', $tables);
				$list = $Db->query("REPAIR TABLE `{$tables}`");
	
				if($list){
					$this->ajaxReturn(1,"数据表修复完成！");
				} else {
					$this->ajaxReturn(0,"数据表修复出错请重试！");
				}
			} else {
				$list = $Db->query("REPAIR TABLE `{$tables}`");
				if($list){
					$this->ajaxReturn(1,"数据表'{$tables}'修复完成！");
				} else {
					$this->ajaxReturn(0,"数据表'{$tables}'修复出错请重试！");
				}
			}
		} else {
			$this->ajaxReturn(0,"请指定要修复的表！");
		}
	}
*/
	
	public function del(){
		$id = implode(',', $_POST['log_id']);
		!$id&&$this->error("没有选取要删除的数据！");
		if (false !== D('AdminLog')->delete($id)) {
			$this->success("删除成功！");
		} else {
			$this->error("删除失败！");
		}
	}	
	
	
	//生成XML地图
	public function sitemap()
	{
		if(IS_POST)
		{
			$Article = M('Article');
			$ArticleClass = M('ArticleClass');
			$Goods = M('Goods');
			$GoodsClass = M('GoodsClass');
			//$Document = M('Document');
			
			$sitemap_head = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n<urlset>\r\n";
            $sitemap_foot = '</urlset>';
			
			//文章分类
			$art_class_sitemap = '';	
			$art_class = $ArticleClass->select();
			if(is_array($art_class) && !empty($art_class))
			{
				foreach($art_class as $ac)
				{
					$art_class_sitemap .= "<url>\r\n"."<loc>".C('SiteUrl').'/Index/news/ac_id/'.$ac['ac_id'].".html</loc>\r\n"."<priority>0.6</priority>\r\n<lastmod>".date('Y-m-d',NOW_TIME)."</lastmod>\r\n<changefreq>daily</changefreq>\r\n</url>\r\n";		
				}	
			}
			//文章信息
			$art_list_sitemap = '';	
            $art_list = $Article->order('article_time desc')->select();
			if(is_array($art_list) && !empty($art_list))
			{       
				foreach($art_list as $k=>$v)
				{
					$art_list_sitemap .= "<url>\r\n"."<loc>".C('SiteUrl').'/Index/news_view/id/'.$v['article_id'].".html</loc>\r\n"."<priority>0.8</priority>\r\n<lastmod>".date('Y-m-d',$v['article_time'])."</lastmod>\r\n<changefreq>daily</changefreq>\r\n</url>\r\n";
		   
				}
			}   
		   //商品分类				
/*			$gd_class_sitemap = '';	
			$gd_class = $GoodsClass->select();
			if(is_array($gd_class) && !empty($gd_class))
			{
				foreach($gd_class as $gc)
				{
					$gd_class_sitemap .= "<url>\r\n"."<loc>".C('SiteUrl').'/Goods/index/id/'.$gc['gc_id'].".html</loc>\r\n"."<priority>0.5</priority>\r\n<lastmod>".date('Y-m-d',NOW_TIME)."</lastmod>\r\n<changefreq>daily</changefreq>\r\n</url>\r\n";		
				}	
			}   */
           //商品信息
/*			$gd_list_sitemap = '';	
			$gd_list = $Goods->order('add_time desc')->select();
			if(is_array($gd_list) && !empty($gd_list))
			{
				foreach($gd_list as $gd)
				{
					$goods_url = $gd['goods_url'] ? $gd['goods_url'] : C('SiteUrl').'/Goods/detail/id/'.$gd['goods_id'].'.html';			
					$gd_list_sitemap .= "<url>\r\n"."<loc>".$goods_url."</loc>\r\n"."<priority>0.8</priority>\r\n<lastmod>".date('Y-m-d',$gd['add_time'])."</lastmod>\r\n<changefreq>daily</changefreq>\r\n</url>\r\n";		
				}	
			}  */
			//系统文章
/*			$art_list_sitemap .= "<url>\r\n"."<loc>".C('SiteUrl')."/about.html</loc>\r\n"."<priority>0.6</priority>\r\n<lastmod>".date('Y-m-d')."</lastmod>\r\n<changefreq>daily</changefreq>\r\n</url>\r\n";	  */ 	

            $sitemap = $sitemap_head.$art_class_sitemap.$art_list_sitemap.$sitemap_foot;
			chmod("sitemap.xml",0755);	
			$file = fopen("sitemap.xml","w");
            fwrite($file,$sitemap);
            fclose($file);
								
            $this->success('地图生成成功');
			exit;			
					
		}
		
		$this->display();
	}
		
}
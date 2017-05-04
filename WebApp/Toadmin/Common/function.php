<?php
/**
 * 模块公共方法
 * @package    function
 * @copyright  Copyright (c) 2014-2030 muxiangdao-cn Inc.(http://www.muxiangdao.cn)
 * @license    http://www.muxiangdao.cn
 * @link       http://www.muxiangdao.cn
 * @author	   muxiangdao-cn Team
 */

/**
 * 检测管理员是否登录
 * @return integer 0-未登录，大于0-当前登录用户ID
 */
function isLogin()
{
	$admin_id = cookie('admin_id')? decrypt(cookie('admin_id')) : 0;
    return $admin_id;
}

/**
 * 单文件上传
 * @param array
 * @return string 
 */
function upload_one($param)
{    
	$upload = new \Think\Upload();    
	$upload->maxSize   =  2097152;  //字节 1KB=1024字节 默认为2M
	$upload->exts      =  array('jpg', 'gif', 'png', 'jpeg');
	$upload->savePath  =  $param['savePath']; //保存路径 相对路径
	$upload->subName   =  $param['subName'];  //子目录
	$upload->saveName  =  $param['saveName']; //保存名称 
	$upload->saveExt   =  $param['saveExt'];  //保存后缀  
	$upload->replace   =  true; //存在同名的文件 覆盖
	$info   =   $upload->uploadOne($param['files']);    
	if(!$info) 
	{ 
		return 'error';  
	}else{ 
		return $info['savepath'].$info['savename'];    
	}
}

function upload_one_thumb($param,$w=680,$h=250)
{    
	$upload = new \Think\Upload();    
	$upload->maxSize   =  2097152;  //字节 1KB=1024字节 默认为2M
	$upload->exts      =  array('jpg', 'gif', 'png', 'jpeg');
	$upload->savePath  =  $param['savePath']; //保存路径 相对路径
	$upload->subName   =  $param['subName'];  //子目录
	$upload->saveName  =  $param['saveName']; //保存名称 
	$upload->saveExt   =  $param['saveExt'];  //保存后缀  
	$upload->replace   =  true; //存在同名的文件 覆盖
	$info   =   $upload->uploadOne($param['files']);    
	if(!$info) 
	{ 
		return 'error';  
	}else{ 
		$img_src = './Uploads/'.$info['savepath'].$info['savename'];    
		$image = new \Think\Image(); 
		$image->open($img_src);
		//将图片裁剪为680X250并保存为
		$new_img_src = './Uploads/'.$info['savepath'].'thumb_'.$info['savename'];    
		$image->crop($w,$h)->save($new_img_src);	
		return $info['savepath'].$info['savename'];    
		//return $info['savepath'].'thumb_'.$info['savename'];  
	}
}

/**
 * 取分类列表，最多为三级
 *
 * @param int $show_deep 显示深度
 * @return array 数组类型的返回结果
 */
function getTreeClassList($show_deep='3')
{
    $GoodsClass = M("GoodsClass");
	//$class_list=$GoodsClass->join('LEFT JOIN __GOODS_TYPE__ ON __GOODS_CLASS__.gc_type_id= __GOODS_TYPE__.type_id')->order('gc_parent_id asc,gc_sort asc,gc_id asc')->select();
	$class_list=$GoodsClass->order('gc_parent_id asc,gc_sort asc,gc_id asc')->select();
	
	$goods_class = array();//分类数组
	if(is_array($class_list) && !empty($class_list)) 
	{
		$show_deep = intval($show_deep);
	    $goods_class = dg_getTreeClassList($show_deep,$class_list);
	}
	return $goods_class;
}
	
/**
 * 递归 整理分类
 *
 * @param int $show_deep 显示深度
 * @param array $class_list 类别内容集合
 * @param int $deep 深度
 * @param int $parent_id 父类编号
 * @param int $i 上次循环编号
 * @return array $show_class 返回数组形式的查询结果
 */
function dg_getTreeClassList($show_deep,$class_list,$deep=1,$parent_id=0,$i=0)
{
	static $show_class = array();//树状的平行数组
	if(is_array($class_list) && !empty($class_list)) 
	{
		$size = count($class_list);
		if($i == 0) $show_class = array();//从0开始时清空数组，防止多次调用后出现重复
		for ($i;$i < $size;$i++)  //$i为上次循环到的分类编号，避免重新从第一条开始
		{
			$val = $class_list[$i];
			$gc_id = $val['gc_id'];
			$gc_parent_id	= $val['gc_parent_id'];
			if($gc_parent_id == $parent_id) 
			{
				$val['deep'] = $deep;
				$show_class[] = $val;
				if($deep < $show_deep && $deep < 3) {//本次深度小于显示深度时执行，避免取出的数据无用
					dg_getTreeClassList($show_deep,$class_list,$deep+1,$gc_id,$i+1);
				}
			}
			if($gc_parent_id > $parent_id) break;//当前分类的父编号大于本次递归的时退出循环
		}
	}
	return $show_class;
}	
/**
 * 取文章分类列表，最多为三级
 *
 * @param int $show_deep 显示深度
 * @return array 数组类型的返回结果
 */
function getTreeClassList1($show_deep='3')
{
	$ArticleClass = M("ArticleClass");
	$class_list=$ArticleClass->order('pid asc,sorts asc,id asc')->select();
	//$class_list=$GoodsClass->order('gc_parent_id asc,gc_sort asc,gc_id asc')->select();

	$article_class = array();//分类数组
	if(is_array($class_list) && !empty($class_list))
	{
		$show_deep = intval($show_deep);
		$article_class = dg_getTreeClassList1($show_deep,$class_list);
	}
	return $article_class;
}

/**
 * 递归 整理分类
 *
 * @param int $show_deep 显示深度
 * @param array $class_list 类别内容集合
 * @param int $deep 深度
 * @param int $parent_id 父类编号
 * @param int $i 上次循环编号
 * @return array $show_class 返回数组形式的查询结果
 */
function dg_getTreeClassList1($show_deep,$class_list,$deep=1,$parent_id=0,$i=0)
{
	static $show_class = array();//树状的平行数组
	if(is_array($class_list) && !empty($class_list))
	{
		$size = count($class_list);
		if($i == 0) $show_class = array();//从0开始时清空数组，防止多次调用后出现重复
		for ($i;$i < $size;$i++)  //$i为上次循环到的分类编号，避免重新从第一条开始
		{
			$val = $class_list[$i];
			$gc_id = $val['id'];
			$gc_parent_id	= $val['pid'];
			if($gc_parent_id == $parent_id)
			{
				$val['deep'] = $deep;
				$show_class[] = $val;
				if($deep < $show_deep && $deep < 3) {//本次深度小于显示深度时执行，避免取出的数据无用
					dg_getTreeClassList1($show_deep,$class_list,$deep+1,$gc_id,$i+1);
				}
			}
			if($gc_parent_id > $parent_id) break;//当前分类的父编号大于本次递归的时退出循环
		}
	}
	return $show_class;
}

/**
 * 取分类列表，最多为三级
 *
 * @param int $show_deep 显示深度
 * @return array 数组类型的返回结果
 */
function getArticleClassList($show_deep='3')
{
    $ArticleClass = M("ArticleClass");
	$class_list=$ArticleClass->order('ac_parent_id asc,ac_sort asc,ac_id asc')->select();
	
	$artcle_class = array();//分类数组
	if(is_array($class_list) && !empty($class_list)) 
	{
		$show_deep = intval($show_deep);
	    $artcle_class = dg_getArticleCClassList($show_deep,$class_list);
	}
	return $artcle_class;
}
	
/**
 * 递归 整理分类
 *
 * @param int $show_deep 显示深度
 * @param array $class_list 类别内容集合
 * @param int $deep 深度
 * @param int $parent_id 父类编号
 * @param int $i 上次循环编号
 * @return array $show_class 返回数组形式的查询结果
 */
function dg_getArticleCClassList($show_deep,$class_list,$deep=1,$parent_id=0,$i=0)
{
	static $show_Artclass = array();//树状的平行数组
	if(is_array($class_list) && !empty($class_list)) 
	{
		$size = count($class_list);
		if($i == 0) $show_Artclass = array();//从0开始时清空数组，防止多次调用后出现重复
		for ($i;$i < $size;$i++)  //$i为上次循环到的分类编号，避免重新从第一条开始
		{
			$val = $class_list[$i];
			$ac_id = $val['ac_id'];
			$ac_parent_id	= $val['ac_parent_id'];
			if($ac_parent_id == $parent_id) 
			{
				$val['deep'] = $deep;
				$show_Artclass[] = $val;
				if($deep < $show_deep && $deep < 3) {//本次深度小于显示深度时执行，避免取出的数据无用
					dg_getArticleCClassList($show_deep,$class_list,$deep+1,$ac_id,$i+1);
				}
			}
			if($ac_parent_id > $parent_id) break;//当前分类的父编号大于本次递归的时退出循环
		}
	}
	return $show_Artclass;
}
<?php
/**
 * 文章模型
 * @copyright  Copyright (c) 2014-2030 muxiangdao-cn Inc.(http://www.muxiangdao.cn)
 * @license    http://www.muxiangdao.cn
 * @link       http://www.muxiangdao.cn
 * @author	   muxiangdao-cn Team
 */
namespace Toadmin\Model;
use Think\Model\RelationModel;

class ArticleModel extends RelationModel{
	protected $_link = array(
		'ArticleClass' => array(             
		 'mapping_type' => self::BELONGS_TO,         
		 'class_name' => 'ArticleClass', 
		 'foreign_key' => 'ac_id',			 
		),
	); 	
}

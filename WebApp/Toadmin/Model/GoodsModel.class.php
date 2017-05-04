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

class GoodsModel extends RelationModel{
	protected $_link = array(
		'GoodsClass' => array(             
		 'mapping_type' => self::BELONGS_TO,         
		 'class_name' => 'GoodsClass', 
		 'foreign_key' => 'gc_id',			 
		),
	); 	
}

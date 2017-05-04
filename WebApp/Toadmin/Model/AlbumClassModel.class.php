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

class AlbumClassModel extends RelationModel{
	protected $_link = array(
		'AlbumPic' => array(             
		 'mapping_type' => self::HAS_MANY,         
		 'class_name' => 'AlbumPic', 
		 'foreign_key' => 'aclass_id',		 
		),
	); 	
}

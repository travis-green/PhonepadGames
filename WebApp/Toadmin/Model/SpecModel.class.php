<?php
/**
 * 产品规格模型
 * @copyright  Copyright (c) 2014-2030 muxiangdao-cn Inc.(http://www.muxiangdao.cn)
 * @license    http://www.muxiangdao.cn
 * @link       http://www.muxiangdao.cn
 * @author	   muxiangdao-cn Team
 */
namespace Toadmin\Model;
use Think\Model\RelationModel;

class SpecModel extends RelationModel{
	protected $_link = array(
		'SpecValue' => array(             
		 'mapping_type' => self::HAS_MANY,         
		 'class_name' => 'SpecValue', 
		 'foreign_key' => 'sp_id',			 
		),
	); 	
}

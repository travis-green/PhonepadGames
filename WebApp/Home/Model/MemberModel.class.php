<?php
/**
 * 会员模型
 * @copyright  Copyright (c) 2014-2030 muxiangdao-cn Inc.(http://www.muxiangdao.cn)
 * @license    http://www.muxiangdao.cn
 * @link       http://www.muxiangdao.cn
 * @author	   muxiangdao-cn Team
 */
namespace Home\Model;
use Think\Model\RelationModel;

class MemberModel extends RelationModel{
	protected $_link = array(
		'Order' => array(             
			'mapping_type' => self::BELONGS_TO,         
			'class_name' => 'Order', 
			'foreign_key' => 'buyer_id',			 
		),
	);
}

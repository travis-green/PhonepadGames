<?php
/**
 * 订单模型
 * @copyright  Copyright (c) 2014-2030 phonepadgames-cn Inc.(http://www.phonepadgames.com)
 * @license    http://www.phonepadgames.com
 * @link       http://www.phonepadgames.com
 * @author	   phonepadgames-cn Team
 */
namespace Home\Model;
use Think\Model\RelationModel;

class OrderModel extends RelationModel{
	protected $_link = array(
		'OrderGoods' => array(             
			'mapping_type' => self::HAS_MANY,         
			'class_name' => 'OrderGoods', 
			'foreign_key' => 'order_id',
			'mapping_name'  => 'goods',
			'mapping_fields' => 'goods_id,goods_name,goods_price,goods_num,goods_image',
			'mapping_order' => 'goods_id desc',
		),
		'OrderAddress' => array(
			'mapping_type' => self::HAS_ONE,
			'class_name' => 'OrderAddress',
			'foreign_key' => 'order_id',
			'mapping_name' => 'address',
			'mapping_fields' => '',
		),
		'OrderLog' => array(
			'mapping_type' => self::HAS_ONE,
			'class_name' => 'OrderLog',
			'foreign_key' => 'order_id',
			'mapping_name' => 'Log',
			'mapping_fields' => '',
		),
	);
}

<?php
/**
 * 订单模型
 * @copyright  Copyright (c) 2014-2030 muxiangdao-cn Inc.(http://www.muxiangdao.cn)
 * @license    http://www.muxiangdao.cn
 * @link       http://www.muxiangdao.cn
 * @author	   muxiangdao-cn Team
 */
namespace Toadmin\Model;
use Think\Model\RelationModel;

class OrderModel extends RelationModel{

	protected $_link = array(
		'OrderPwd' => array(             
		'mapping_type' => self::HAS_ONE,         
		'class_name' => 'OrderPwd', 
		'foreign_key' => 'order_id',			 
		),
	); 	
}

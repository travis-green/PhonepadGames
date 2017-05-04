<?php
/**
 * 入口
 * @copyright  Copyright (c) 2014-2030 muxiangdao-cn Inc.(http://www.muxiangdao.cn)
 * @license    http://www.muxiangdao.cn
 * @link       http://www.muxiangdao.cn
 * @author	   muxiangdao-cn Team
 */
namespace Toadmin\Controller;
class IndexController extends GlobalController {
	public function _initialize() 
	{
        parent::_initialize();
	}  
    public function index()
	{
		$this->display();
    }
	
}
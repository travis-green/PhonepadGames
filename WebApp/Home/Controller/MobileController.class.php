<?php
namespace Home\Controller;
class MobileController extends BaseController {
	public function __construct()
	{
		parent::__construct();
		$seo = M('Seo')->where('type=\'about\'')->find();
		$this->seo_set($seo['title'],$seo['keywords'],$seo['description']);
	}  
    public function index()
	{	
        $this->m_banner = M('AdvPosition')->where('ap_code=\'m_banner\'')->select();
		$this->m_adv = M('AdvPosition')->where('ap_code=\'m_adv\'')->limit(3)->select();
		$this->display();
	}
	
}
<?php
/**
 * 编辑器文件上传处理类
 * @package    Edit
 * @copyright  Copyright (c) 2014-2030 muxiangdao-cn Inc.(http://www.muxiangdao.cn)
 * @license    http://www.muxiangdao.cn
 * @link       http://www.muxiangdao.cn
 * @author	   muxiangdao-cn Team
 */
namespace Home\Controller;
use Think\Controller;
class EdituploadController extends Controller {
	public function __construct()
	{
		parent::__construct();
	}  
    public function upload()
	{
		header("Content-Type:text/html;charset=utf-8");
		$upload = new \Think\Upload();  
		
		$upload->maxSize  = 3145728;
		$upload->exts  = array('jpg', 'gif', 'png', 'jpeg');	
		$upload->autoSub = true;
 		$upload->subName = array('date','Ymd');
		$upload->saveName = array('uniqid','');
		$upload->savePath = './edit/'; //图片的的保存位置
		$info = $upload->uploadOne($_FILES['imgFile']);
		if(!$info)
		{
			$error['error']=1;
			$error['message']=$upload->error($upload->getError());
			exit(json_encode($error));
		}
		$data=array(
		'url'=>str_replace('./',__ROOT__.'/Uploads/',$info['savepath']).$info['savename'],
		'error'=>0
		);		
		exit(json_encode($data));		
    }
	
}
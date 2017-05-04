<?php
/**
 * 杨胜江
 * 编辑器图片上传
 */
require_once('JSON.php');

exit; //不做处理

$php_path = dirname(__FILE__) . '/';
$php_url = dirname($_SERVER['PHP_SELF']) . '/';

//根目录路径，可以指定绝对路径，比如 /var/www/attached/
$root_path = $php_path . '../Uploads/edit/';
//根目录URL，可以指定绝对路径，比如 http://www.yoursite.com/attached/
$root_url = $php_url . '../Uploads/edit/';

//定义允许上传的文件扩展名
$ext_arr = array('gif', 'jpg', 'jpeg', 'png', 'bmp');
//最大文件大小
$max_size = 2*1000*1000; //允许上传最大2M

//有上传文件时
if (empty($_FILES) === false) {
	//原文件名
	$file_name = $_FILES['imgFile']['name'];
	//服务器上临时文件名
	$tmp_name = $_FILES['imgFile']['tmp_name'];
	//文件大小
	$file_size = $_FILES['imgFile']['size'];
	//检查文件名
	if (!$file_name) {
		alert("请选择文件。");
	}
	
	//检查是否已上传
	if (@is_uploaded_file($tmp_name) === false) {
		alert("临时文件可能不是上传文件。");
	}
	//检查文件大小
	if ($file_size > $max_size) {
		alert("上传文件大小超过限制。");
	}
	//获得文件扩展名
	$temp_arr = explode(".", $file_name);
	$file_ext = array_pop($temp_arr);
	$file_ext = trim($file_ext);
	$file_ext = strtolower($file_ext);
	//检查扩展名
	if (in_array($file_ext, $ext_arr) === false) {
		alert("上传文件扩展名是不允许的扩展名。");
	}
	//新文件名
	$new_file_name = 'ed_'.uniqid().'_'.rand(10000, 99999).'.'.$file_ext;
		
	$file_path = $root_path . $new_file_name; //移动文件
	if (move_uploaded_file($tmp_name, $file_path) === false) 
	{
		alert("上传文件失败。");
	}
	@chmod($file_path, 0644); //所有者可读写，其他人可读
	
	
	$file_url = $root_url . $new_file_name;
	
	header('Content-type: text/html; charset=UTF-8');
	$json = new Services_JSON();
	echo $json->encode(array('error' => 0, 'url' => $file_url));
	exit;
}

function alert($msg) {
	header('Content-type: text/html; charset=UTF-8');
	$json = new Services_JSON();
	echo $json->encode(array('error' => 1, 'message' => $msg));
	exit;
}
?>
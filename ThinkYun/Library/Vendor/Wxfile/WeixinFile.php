<?php
/**
* 微信文件处理
**/
// 引入七牛云 鉴权类、上传类
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class WeixinFile {
	private $media_id;
	
	public function __construct($media_id) 
	{
		$this->media_id = $media_id;
	}
	
	public function upload()
	{
		$media_id = $this->media_id;
		$access_token = get_wx_AccessToken(1);
		
		//微信上传下载媒体文件
		$url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token={$access_token}&media_id={$media_id}";
		$fileInfo = $this->downloadWeixinFile($url);
		$type = $this->header_byte($fileInfo['header']['content_type']);
		$filename = "wx_".time().rand(1111,9999).".".$type;
		$file_data = "Wxupload/".$filename;
		$res = $this->saveWeixinFile("./Uploads/".$file_data, $fileInfo['body']);
       
		//上传到七牛云
		Vendor('Qin.autoload');
		//配置
		$accessKey = C('qiniu_accessKey');
		$secretKey = C('qiniu_secretKey');
		$bucket = C('qiniu_bucket');
		$key = "wx_".NOW_TIME.rand(1111,9999);		
         
	    //上传策略
		$scope = $bucket.':'.$key; 
		$deadline = NOW_TIME+3600;
		$persistentOps = 'avthumb/mp3|saveas/'.base64_encode($scope);
		$persistentNotifyUrl = C('SiteUrl').'/Notify/qiniu';
		
		$policy = array(
			 'scope' => $scope,
			 'deadline' => $deadline,
			 'persistentOps' => $persistentOps,
			 'persistentNotifyUrl' => $persistentNotifyUrl,
		);
		//构建鉴权对象
		$auth = new Auth($accessKey, $secretKey);		
		$upToken = $auth->uploadToken($bucket, null, 3600, $policy);
	    $uploadMgr = new UploadManager(); 
		$filePath = './Uploads/'.$file_data;	
		list($ret, $err) = $uploadMgr->putFile($upToken, $key, $filePath);				
		if ($err !== null) {
			return false;
		} else {
			unlink($filePath);
			return $ret;
		}				
	}
	
	function downloadWeixinFile($url)
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_NOBODY, 0);    //只取body头
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$package = curl_exec($ch);
		$httpinfo = curl_getinfo($ch);
		curl_close($ch);
		$imageAll = array_merge(array('header' => $httpinfo), array('body' => $package));
		return $imageAll;
	}
	
	//文件格式
	function header_byte($type)
	{
		switch ($type)
		{
			case 'audio/x-speex-with-header-byte; rate=16000':
				$tp = "speex";
				break;
			case 'audio/mp3':  //音频
				$tp = "mp3";
				break;				
			case 'audio/amr':  
				$tp = "amr";
				break;
			case 'video/mp4':  
				$tp = "mp4";
				break;	
			case 'image/jpeg': //图片
				$tp = "jpg";
				break;				
			//其他文件格式自行添加	
			default:
				$tp = "notype";
				break;
		}
		return $tp;
	}
	
	function saveWeixinFile($filename, $filecontent)
	{
		$local_file = fopen($filename, 'w');
		if(false !== $local_file)
		{
			if(false !== fwrite($local_file, $filecontent)) 
			{
				fclose($local_file);
			}
		}
	}

}
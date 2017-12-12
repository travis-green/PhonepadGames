<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Type" content="text/html;" charset="<?php echo CHARSET;?>">
<title>本地生活</title>
<link href="/Public/admin/css/skin_0.css" rel="stylesheet" type="text/css" id="cssfile"/>
<script type="text/javascript" src="/Public/static/jquery.js"></script>
<script type="text/javascript" src="/Public/static/jquery.validation.min.js"></script>
<script type="text/javascript" src="/Public/admin/js/jquery.cookie.js"></script>
<script type="text/javascript" src="/Public/admin/js/admincp.js"></script>
<script type="text/javascript" src="/Public/admin/js/jquery.tooltip.js"></script>
<script language="javascript">
var SiteUrl = '<?php echo (C("SiteUrl")); ?>';
var AdminUrl = SiteUrl+'/<?php echo (MODULE_NAME); ?>';
</script>
</head><body>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>站点设置</h3>
      <ul class="tab-base">
        <li><a href="<?php echo U('Setting/base_information');?>"><span>PC端基本设置</span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span>手机端基本设置</span></a></li>
        
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" enctype="multipart/form-data" name="form1">
    <table class="table tb-type2">
      <tbody>
        <tr>
          <td colspan="2" class="required"><label for="m_site_logo">站点Logo:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
          	<span class="type-file-show">
          		<img class="show_image" src="/Public/admin/images/preview.png">
            	<div class="type-file-preview"><img src="/Uploads/<?php echo ($vo['m_site_logo']); ?>"></div>
            </span>     
            <span class="type-file-box">
            <input type='text' name='txt_m_site_logo' id='txt_m_site_logo' class='type-file-text' />
            <input type='button' name='but_m_site_logo' id='but_m_site_logo' value='' class='type-file-button' />
            <input name="m_site_logo" type="file" class="type-file-file" id="m_site_logo" size="30" hidefocus="true" nc_type="change_m_site_logo">
            </span>
          </td>
          <td class="vatop tips"><span class="vatop rowform"></span></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="m_tel">客服热线:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="m_tel" name="m_tel" value="<?php echo ($vo['m_tel']); ?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform"></span></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="m_qq_qun">官方QQ群:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="m_qq_qun" name="m_qq_qun" value="<?php echo ($vo['m_qq_qun']); ?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform"></span></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="m_qq1">客服QQ1:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="m_qq1" name="m_qq1" value="<?php echo ($vo['m_qq1']); ?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform"></span></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="m_qq2">客服QQ2:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="m_qq2" name="m_qq2" value="<?php echo ($vo['m_qq2']); ?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform"></span></td>
        </tr>
                                        
<!--        <tr>
          <td colspan="2" class="required"><label for="icp_number">官方公众号:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="weixin_account" name="weixin_account" value="<?php echo ($vo['weixin_account']); ?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform"></span></td>
        </tr>-->
               
        <tr class="noborder">
          <td colspan="2" class="required"><label for="app_url">下载地址:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="app_url" name="app_url" value="<?php echo ($vo['app_url']); ?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform"></span></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label for="lingqu_url">领取地址:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="lingqu_url" name="lingqu_url" value="<?php echo ($vo['lingqu_url']); ?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform"></span></td>
        </tr>

        <tr class="noborder">
          <td colspan="2" class="required"><label for="m_wb_url">微博地址:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="m_wb_url" name="m_wb_url" value="<?php echo ($vo['m_wb_url']); ?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform"></span></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label for="m_tb_url">贴吧地址:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="m_tb_url" name="m_tb_url" value="<?php echo ($vo['m_tb_url']); ?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform"></span></td>
        </tr>
                        
        <tr class="noborder">
          <td colspan="2" class="required"><label for="m_video_info">视频信息:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><textarea name="m_video_info" rows="6" class="tarea" id="m_video_info"><?php echo ($vo['m_video_info']); ?></textarea></td>
          <td class="vatop tips"><span class="vatop rowform">建议使用iframe并且宽度设置为100%</span></td>
        </tr>
                  
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="2" ><a href="JavaScript:void(0);" class="btn" onclick="document.form1.submit()"><span>保存</span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script type="text/javascript">
// 模拟网站LOGO上传input type='file'样式
$(function(){
	$("#m_site_logo").change(function(){
		$("#txt_m_site_logo").val($(this).val());
	});
// 上传图片类型
$('input[class="type-file-file"]').change(function(){
	var filepatd=$(this).val();	
	var extStart=filepatd.lastIndexOf(".");
	var ext=filepatd.substring(extStart,filepatd.lengtd).toUpperCase();		
		if(ext!=".PNG"&&ext!=".GIF"&&ext!=".JPG"&&ext!=".JPEG"){
			alert("图片格式错误");
				$(this).attr('value','');
			return false;
		}
	});
//$('#time_zone').attr('value','<?php echo ($vo['time_zone']); ?>');	
});
</script>
</body></html>
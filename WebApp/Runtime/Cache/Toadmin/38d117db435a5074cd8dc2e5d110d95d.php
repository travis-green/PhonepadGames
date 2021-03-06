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
        <li><a href="JavaScript:void(0);" class="current"><span>PC端基本设置</span></a></li>
        <li><a href="<?php echo U('Setting/mobile_information');?>"><span>手机端基本设置</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" enctype="multipart/form-data" name="form1">
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label for="site_name">网站名称:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="site_name" name="site_name" value="<?php echo ($vo['site_name']); ?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform">网站名称，将显示在前台顶部欢迎信息等位置</span></td>
        </tr>
        <!--站点logo-->
        <tr>
          <td colspan="2" class="required"><label for="site_logo">网站Logo:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
          	<span class="type-file-show">
          		<img class="show_image" src="/Public/admin/images/preview.png">
            	<div class="type-file-preview"><img src="/Uploads/<?php echo ($vo['site_logo']); ?>"></div>
            </span>     
            <span class="type-file-box">
            <input type='text' name='txt_site_logo' id='txt_site_logo' class='type-file-text' />
            <input type='button' name='but_site_logo' id='but_site_logo' value='' class='type-file-button' />
            <input name="site_logo" type="file" class="type-file-file" id="site_logo" size="30" hidefocus="true" nc_type="change_site_logo">
            </span>
          </td>
          <td class="vatop tips"><span class="vatop rowform"></span></td>
        </tr>
        <!--会员中心logo-->
         <tr>
          <td colspan="2" class="required"><label for="member_logo">底部图一:</label></td>
        </tr>
         <tr class="noborder">
          <td class="vatop rowform">
          	<span class="type-file-show">
          		<img class="show_image" src="/Public/admin/images/preview.png">
            	<div class="type-file-preview">
            		<img src="/Uploads/<?php echo ($vo['member_logo']); ?>">
            	</div>
            </span>
            <span class="type-file-box">
            <input type='text' name='txt_member_logo' id='txt_member_logo' class='type-file-text' />
            <input type='button' name='but_member_logo' id='but_member_logo' value='' class='type-file-button' />
            <input name="member_logo" type="file" class="type-file-file" id="member_logo" size="30" hidefocus="true" nc_type="change_site_logo">
            </span>
          </td>
          <td class="vatop tips"><span class="vatop rowform">82px * </span></td>
        </tr>
        <!--卖家中心logo-->        
         <tr>
          <td colspan="2" class="required"><label for="seller_logo">底部图二:</label></td>
        </tr>
         <tr class="noborder">
          <td class="vatop rowform">
          	<span class="type-file-show">
          		<img class="show_image" src="/Public/admin/images/preview.png">
            	<div class="type-file-preview">
            		<img src="/Uploads/<?php echo ($vo['seller_logo']); ?>">
            	</div>
            </span>
            <span class="type-file-box">
            <input type='text' name='txt_seller_logo' id='txt_seller_logo' class='type-file-text' />
            <input type='button' name='but_seller_logo' id='but_seller_logo' value='' class='type-file-button' />
            <input name="seller_logo" type="file" class="type-file-file" id="seller_logo" size="30" hidefocus="true" nc_type="change_site_logo">
            </span>
          </td>
          <td class="vatop tips"><span class="vatop rowform">82px * </span></td>
        </tr>
<!--        <tr>
          <td colspan="2" class="required"><label for="icp_number">网站官方微信账号:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="weixin_account" name="weixin_account" value="<?php echo ($vo['weixin_account']); ?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform"></span></td>
        </tr>-->
               
         <tr>
          <td colspan="2" class="required"><label for="site_logo">网站官方微信二维码图片:</label></td>
        </tr>
         <tr class="noborder">
          <td class="vatop rowform">
          	<span class="type-file-show">
          		<img class="show_image" src="/Public/admin/images/preview.png">
            	<div class="type-file-preview">
            		<img src="/Uploads/<?php echo ($vo['weixin_qrcode']); ?>">
            	</div>
            </span>
            <span class="type-file-box">
            <input type='text' name='txt_weixin_qrcode' id='txt_weixin_qrcode' class='type-file-text' />
            <input type='button' name='but_weixin_qrcode' id='but_weixin_qrcode' value='' class='type-file-button' />
            <input name="weixin_qrcode" type="file" class="type-file-file" id="weixin_qrcode" size="30" hidefocus="true" nc_type="change_site_logo">
            </span>
          </td>
          <td class="vatop tips"><span class="vatop rowform">用户扫描该二维码来关注网站官方微信公共账号</span></td>
        </tr>

        <tr class="noborder">
          <td colspan="2" class="required"><label for="android_url">安卓下载地址:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="android_url" name="android_url" value="<?php echo ($vo['android_url']); ?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform"></span></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label for="ios_url">苹果下载地址:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="ios_url" name="ios_url" value="<?php echo ($vo['ios_url']); ?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform"></span></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label for="video_info">视频信息:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><textarea name="video_info" rows="6" class="tarea" id="video_info"><?php echo ($vo['video_info']); ?></textarea></td>
          <td class="vatop tips"><span class="vatop rowform">视频代码信息（建议尺寸669X344px）</span></td>
        </tr>
        
         <tr>
          <td colspan="2" class="required"><label for="footer_info">底部信息:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php kindEditor('footer_info',$vo['footer_info'],'400px','150px');?></td>
          <td class="vatop tips"><span class="vatop rowform"></span></td>
        </tr>                        
                        
<!--        <tr class="noborder">
          <td colspan="2" class="required"><label for="site_qq">客服QQ	:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="site_qq" name="site_qq" value="<?php echo ($vo['site_qq']); ?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform"></span></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label for="site_tel">客服电话:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="site_tel" name="site_tel" value="<?php echo ($vo['site_tel']); ?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform"></span></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label for="site_address">联系地址:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="site_address" name="site_address" value="<?php echo ($vo['site_address']); ?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform"></span></td>
        </tr>-->
                                
<!--        <tr>
          <td colspan="2" class="required"><label for="icp_number">ICP证书号:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="icp_number" name="icp_number" value="<?php echo ($vo['icp_number']); ?>" class="txt" type="text" /></td>
          <td class="vatop tips"><span class="vatop rowform">前台页面底部可以显示 ICP 备案信息，如果网站已备案，在此输入你的授权码，它将显示在前台页面底部，如果没有请留空</span></td>
        </tr>-->
<!--        <tr>
          <td colspan="2" class="required"><label for="statistics_code">第三方流量统计代码:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><textarea name="statistics_code" rows="6" class="tarea" id="statistics_code"><?php echo ($vo['statistics_code']); ?></textarea></td>
          <td class="vatop tips"><span class="vatop rowform">前台页面底部可以显示第三方统计</span></td>
        </tr> -->
<!--        <tr>
          <td colspan="2" class="required"><label for="time_zone">时区:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
              <select id="time_zone" name="time_zone">
              <option value="-12">(GMT -12:00) Eniwetok, Kwajalein</option>
              <option value="-11">(GMT -11:00) Midway Island, Samoa</option>
              <option value="-10">(GMT -10:00) Hawaii</option>
              <option value="-9">(GMT -09:00) Alaska</option>
              <option value="-8">(GMT -08:00) Pacific Time (US &amp; Canada), Tijuana</option>
              <option value="-7">(GMT -07:00) Mountain Time (US &amp; Canada), Arizona</option>
              <option value="-6">(GMT -06:00) Central Time (US &amp; Canada), Mexico City</option>
              <option value="-5">(GMT -05:00) Eastern Time (US &amp; Canada), Bogota, Lima, Quito</option>
              <option value="-4">(GMT -04:00) Atlantic Time (Canada), Caracas, La Paz</option>
              <option value="-3.5">(GMT -03:30) Newfoundland</option>
              <option value="-3">(GMT -03:00) Brassila, Buenos Aires, Georgetown, Falkland Is</option>
              <option value="-2">(GMT -02:00) Mid-Atlantic, Ascension Is., St. Helena</option>
              <option value="-1">(GMT -01:00) Azores, Cape Verde Islands</option>
              <option value="0">(GMT) Casablanca, Dublin, Edinburgh, London, Lisbon, Monrovia</option>
              <option value="1">(GMT +01:00) Amsterdam, Berlin, Brussels, Madrid, Paris, Rome</option>
              <option value="2">(GMT +02:00) Cairo, Helsinki, Kaliningrad, South Africa</option>
              <option value="3">(GMT +03:00) Baghdad, Riyadh, Moscow, Nairobi</option>
              <option value="3.5">(GMT +03:30) Tehran</option>
              <option value="4">(GMT +04:00) Abu Dhabi, Baku, Muscat, Tbilisi</option>
              <option value="4.5">(GMT +04:30) Kabul</option>
              <option value="5">(GMT +05:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
              <option value="5.5">(GMT +05:30) Bombay, Calcutta, Madras, New Delhi</option>
              <option value="5.75">(GMT +05:45) Katmandu</option>
              <option value="6">(GMT +06:00) Almaty, Colombo, Dhaka, Novosibirsk</option>
              <option value="6.5">(GMT +06:30) Rangoon</option>
              <option value="7">(GMT +07:00) Bangkok, Hanoi, Jakarta</option>
              <option value="8">(GMT +08:00) Beijing, Hong Kong, Perth, Singapore, Taipei</option>
              <option value="9">(GMT +09:00) Osaka, Sapporo, Seoul, Tokyo, Yakutsk</option>
              <option value="9.5">(GMT +09:30) Adelaide, Darwin</option>
              <option value="10">(GMT +10:00) Canberra, Guam, Melbourne, Sydney, Vladivostok</option>
              <option value="11">(GMT +11:00) Magadan, New Caledonia, Solomon Islands</option>
              <option value="12">(GMT +12:00) Auckland, Wellington, Fiji, Marshall Island</option>
            </select>
          </td>
          <td class="vatop tips"><span class="vatop rowform">设置系统使用的时区，中国为+8</span></td>
        </tr> -->
                    
        <tr>
          <td colspan="2" class="required">站点状态:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff">
            <label for="site_status1" class="cb-enable <?php if($vo['site_status'] == '1'): ?>selected<?php endif; ?>" ><span>开</span></label>
            <label for="site_status0" class="cb-disable <?php if($vo['site_status'] == '0'): ?>selected<?php endif; ?>" ><span>关</span></label>
            <input id="site_status1" name="site_status" <?php if($vo['site_status'] == '1'): ?>checked="checked"<?php endif; ?> value="1" type="radio">
            <input id="site_status0" name="site_status" <?php if($vo['site_status'] == '0'): ?>checked="checked"<?php endif; ?> value="0" type="radio"></td>
          <td class="vatop tips"><span class="vatop rowform">开启关闭网站</span></td>
        </tr>
        
        <tr>
          <td colspan="2" class="required"><label for="closed_reason">关闭原因:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><textarea name="closed_reason" rows="6" class="tarea" id="closed_reason" ><?php echo ($vo['closed_reason']); ?></textarea></td>
          <td class="vatop tips"><span class="vatop rowform">网站关闭的原因</span></td>
        </tr>

<!--        <tr>
          <td colspan="2" class="required">是否开启店铺二级域名:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff">
            <label for="subdomain_status1" class="cb-enable <?php if($vo['subdomain_status'] == '1'): ?>selected<?php endif; ?>" ><span>开</span></label>
            <label for="subdomain_status0" class="cb-disable <?php if($vo['subdomain_status'] == '0'): ?>selected<?php endif; ?>" ><span>关</span></label>
            <input id="subdomain_status1" name="subdomain_status" <?php if($vo['subdomain_status'] == '1'): ?>checked="checked"<?php endif; ?> value="1" type="radio">
            <input id="subdomain_status0" name="subdomain_status" <?php if($vo['subdomain_status'] == '0'): ?>checked="checked"<?php endif; ?> value="0" type="radio"></td>
          <td class="vatop tips"><span class="vatop rowform"></span></td>
        </tr>
        <tr>
          <td colspan="2" class="required">受限制二级域名:</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><textarea name="subdomain_refuse" rows="4" class="tarea" id="subdomain_refuse" ><?php echo ($vo['subdomain_refuse']); ?></textarea></td>
          <td class="vatop tips"><span class="vatop rowform">可以在这里设置不允许商户使用的二级域名，请以英文逗号分隔</span></td>
        </tr>-->
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
	$("#site_logo").change(function(){
		$("#txt_site_logo").val($(this).val());
	});
	$("#member_logo").change(function(){
		$("#txt_member_logo").val($(this).val());
	});
	$("#seller_logo").change(function(){
		$("#txt_seller_logo").val($(this).val());
	});
	$("#weixin_qrcode").change(function(){
		$("#txt_weixin_qrcode").val($(this).val());
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
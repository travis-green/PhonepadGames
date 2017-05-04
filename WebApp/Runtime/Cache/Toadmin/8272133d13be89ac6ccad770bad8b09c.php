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
      <h3>清理缓存</h3>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12" class="nobg"><div class="title">
            <h5>操作提示</h5>
            <span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td>
        	<ul>
            	<li>缓存数据是为了提高网站的运行速度</li>
          	</ul>
        </td>
      </tr>
    </tbody>
  </table>    
  <form id="cache_form" method="post" <?php echo U('Setting/cache_clear');?>>
    <table class="table nobdb">
      <tbody>
        <tr>
          <td colspan="2"><table class="table nomargin">
              <tbody>
                <tr>
                  <td class="required"><input id="cls_full" name="cls_full" value="1" type="checkbox">
                    &nbsp;
                    <label for="cls_full">全部</label></td>
                </tr>
                <tr class="noborder">
                  <td class="vatop rowform">
                  <ul class="nofloat w830">
                  	  <li class="left w18pre">
                        <label><input type="checkbox" name="cache[]" value="setting">&nbsp;网站配置</label>
                      </li>
                      <li class="left w18pre">
						<label><input type="checkbox" name="cache[]" value="logs">&nbsp;日志文件</label>
                      </li>
                      <li class="left w18pre">
						<label><input type="checkbox" name="cache[]" value="tpl" >&nbsp;模板缓存</label>
                      </li>
                      <li class="left w18pre">
						<label><input type="checkbox" name="cache[]" value="data">&nbsp;DATA缓存</label>
                      </li>
<!--					  <li class="left w18pre">
 						<label><input type="checkbox" name="cache[]" value="district">&nbsp;地区信息</label>
                      </li>-->
					  <li class="left w18pre">
 						<label><input type="checkbox" name="cache[]" value="seo">&nbsp;SEO缓存</label>
                      </li>                                        
                    </ul>
                </td>
                </tr>
              </tbody>
            </table></td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="2"><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span>提交</span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script>
//按钮先执行验证再提交表
$(function(){
	$("#submitBtn").click(function(){
		if($('input[name="cache[]"]:checked').size()>0){
			$("#cache_form").submit();
		}
	});
	$('#cls_full').click(function(){
		$('input[name="cache[]"]').attr('checked',$(this).attr('checked') == 'checked');
	});
});
</script>
</body></html>
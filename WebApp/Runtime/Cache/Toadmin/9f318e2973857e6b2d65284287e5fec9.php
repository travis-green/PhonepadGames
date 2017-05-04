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
      <h3>SEO设置</h3>
      <ul class="tab-base">
        <li><a href="<?php echo U('Setting/seo_information',array('type'=>'index'));?>" class="<?php if(($type) == "index"): ?>current<?php endif; ?>"><span>首页</span></a></li>
        <!--<li><a href="<?php echo U('Setting/seo_information',array('type'=>'goods'));?>" class="<?php if(($type) == "goods"): ?>current<?php endif; ?>"><span>产品</span></a></li>-->
		<li><a href="<?php echo U('Setting/seo_information',array('type'=>'news'));?>" class="<?php if(($type) == "news"): ?>current<?php endif; ?>"><span>资讯</span></a></li>
		<li><a href="<?php echo U('Setting/seo_information',array('type'=>'about'));?>" class="<?php if(($type) == "about"): ?>current<?php endif; ?>"><span>手机</span></a></li>
		<!--<li><a href="<?php echo U('Setting/seo_information',array('type'=>'content'));?>" class="<?php if(($type) == "content"): ?>current<?php endif; ?>"><span>联系</span></a></li>-->
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12" class="nobg"><div class="title"><h5>操作提示</h5><span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td>
			<ul>
				<li>请填写title、keyword、description信息</li>
			</ul>
		</td>
      </tr>
    </tbody>
  </table>
  <form method="post" name="form_index">
    <input type="hidden" name="seo_type" value="<?php echo ($type); ?>"/>
    <table class="table tb-type2">
      <tbody>
        <tr>
          <td colspan="2" class="required">
          <label>
              <?php if($type == 'index'): ?>首页
              <?php elseif($type == 'goods'): ?>产品
              <?php elseif($type == 'news'): ?>资讯
              <?php elseif($type == 'about'): ?>手机
              <?php elseif($type == 'content'): ?>联系
              <?php else: endif; ?>
          </label>
          </td>
        </tr>
        <tr class="noborder">
          <td class="w96">title</td><td><input id="seo_title" name="title" value="<?php echo ($vo["title"]); ?>" class="w300" type="text"/></td>
        </tr>
        <tr class="noborder">
          <td class="w96">keywords</td><td><input id="keywords" name="keywords" value="<?php echo ($vo["keywords"]); ?>" class="w300" type="text" maxlength="200" /></td>
        </tr>
        <tr class="noborder">
          <td class="w96">description</td><td><textarea name="description" rows="6" class="w300" id="description" ><?php echo ($vo['description']); ?></textarea></td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="2" ><a href="JavaScript:void(0);" class="btn" onclick="document.form_index.submit()"><span>保存</span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
</body></html>
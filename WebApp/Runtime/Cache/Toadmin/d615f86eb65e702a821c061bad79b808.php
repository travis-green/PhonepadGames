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
      <h3>生成sitemap.xml</h3>
    </div>
  </div>
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
            	<li>生成以资讯等为内容的sitemap.xml方便搜索引擎更好的抓取网站内容</li>
          	</ul>
        </td>
      </tr>
    </tbody>
  </table>  
    <form name="sitemap_from" id="sitemap_from" method="post" action="<?php echo U('Tool/sitemap');?>">
    <table class="table tb-type2 nobdb">
    	<tbody>      
    		<tr class="hover">
    			<td class="w150">&nbsp;</td>
    			<td><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span>一键更新生成</span></a></td>
                <td>&nbsp;</td>
   			</tr>      		
            
    	</tbody>
    </table>
    </form>
</div>

<script>
$(function(){
	$("#submitBtn").click(function(){
		$("#sitemap_from").submit();
	});
});
</script>
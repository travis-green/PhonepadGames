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
      <h3>数据库备份</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>管理</span></a></li>
        <li>
        <a href='javascript:if(confirm("确定要备份所有数据?"))window.location ="<?php echo U('Database/backall');?>";'><span>点击备份数据</span></a></li>
        <li><!--<a href="<?php echo U('Database/tablist');?>"><span>备份部分数据</span></a></li>-->
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
    <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th class="nobg" colspan="12"><div class="title"><h5>操作提示</h5><span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td>
        <ul>
         <li>定期进行本地数据备份、可提高系统数据安全、可靠性！</li>
         <li>建议备份后将sql文件下载到本地保存，并删除服务器上的sql文件</li>
        </ul>
        </td>
      </tr>
    </tbody>
  </table>
  <table class="table tb-type2 nobdb">
    <thead>
      <tr class="thead">
        <th>备份文件名</th>
        <th class="align-center">备份时间</th>
        <th class="align-center">文件大小</th>
        <th class="align-center">操作</th>
      </tr>
    </thead>
    <tbody>
      <?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr class="hover">
        <td ><?php echo ($v['name']); ?></td>
        <td class="w25pre align-center"><?php echo ($v['time']); ?></td>
        <td class="w25pre align-center"><?php echo ($v['size']); ?></td>
        <td class="align-center">
        <a href="javascript:alert('演示数据不提供下载');">下载</a>
        <!--<a href="<?php echo (C("SiteUrl")); ?>/Backup/<?php echo ($v['name']); ?>">下载</a>-->&nbsp;&nbsp;|&nbsp;&nbsp;
        <a href='javascript:if(confirm("确定要删除？该操作不可逆,请谨慎操作!"))window.location ="<?php echo U('Database/deletebak',array('file'=>$v['name']));?>";'>删除</a></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      <?php else: ?>
      <tr class="no_data">
        <td colspan="15">暂无记录</td>
      </tr><?php endif; ?>
    </tbody>
  </table>
</div>
</body></html>
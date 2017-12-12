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
      <h3>系统用户管理</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>管理</span></a></li>
        <li><a href="<?php echo U('Setting/admin_list',array('op'=>'add'));?>" ><span>添加</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="post" id="form_admin" action="<?php echo U('Setting/admin_list',array('op'=>'del'));?>">
    <table class="table tb-type2">
      <thead>
        <tr class="space">
          <th colspan="15" class="nobg"><?php echo $lang['nc_list'];?></th>
        </tr>
        <tr class="thead">
          <th><input type="checkbox" class="checkall" id="checkallBottom" name="chkVal"></th>
          <th>账号</th>
          <th class="align-center">最近登录时间</th>
          <th class="align-center">最近登录IP</th>
          <th class="align-center">操作</th>
        </tr>
      </thead>
      <tbody>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="hover">
          <td class="w24">
            <?php if($vo['admin_id'] != 1): ?><input type="checkbox" name="del_id[]" value="$vo['admin_id']" class="checkitem" onclick="javascript:chkRow(this);">
            <?php else: ?>
            	<input name="del_id[]" type="checkbox" value="$vo['admin_id']" disabled="disabled"><?php endif; ?>
            </td>
          <td><?php echo ($vo['admin_name']); ?></td>
          <td class="align-center"><?php echo (date('Y-m-d H:i:s',$vo['admin_lg_time'])); ?></td>
          <td class="align-center"><?php echo ($vo['admin_lg_ip']); ?></td>
          <td class="w150 align-center">
			<a href="<?php echo U('Setting/admin_list',array('op'=>'edit','admin_id'=>$vo['admin_id']));?>">编辑</a>
            <?php if($vo['admin_id'] != 1): ?>&nbsp;|&nbsp;
            <a href='javascript:if(confirm("您确定要删除吗？"))window.location="<?php echo U('Setting/admin_list',array('op'=>'del','admin_id'=>$vo['admin_id']));?>";'>删除</a><?php endif; ?>
          </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </tbody>
      <tfoot>
        <tr class="tfoot">
        <td colspan="16"></td>
        </tr>
      </tfoot>      
    </table>
  </form>
</div>
</body></html>
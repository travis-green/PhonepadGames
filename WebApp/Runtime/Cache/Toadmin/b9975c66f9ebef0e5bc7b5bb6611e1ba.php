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
      <h3>广告管理</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>管理</span></a></li>
        <li><a href="<?php echo U('Adv/adv_add');?>"><span>添加</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <!-- 广告查询 -->
  <form method="get" name="formSearch">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th>广告位置</th>
          <td>
          	<select name='ap_code'>
          		<option value="">请选择</option>
          		<option value="banner" <?php if($search['ap_code'] == 'banner'): ?>selected<?php endif; ?>>PC首页轮播图</option>
                <option value="index" <?php if($search['ap_code'] == 'index'): ?>selected<?php endif; ?>>PC首页中部广告</option>
                <option value="link" <?php if($search['ap_code'] == 'link'): ?>selected<?php endif; ?>>PC友情链接</option>
              <option value="m_banner" <?php if($search['ap_code'] == 'm_banner'): ?>selected="selected"<?php endif; ?>>手机轮播图</option>
              <option value="m_adv" <?php if($search['ap_code'] == 'm_adv'): ?>selected="selected"<?php endif; ?>>手机中部广告图</option>                  
          	</select>
          </td>
          <th>名称</th>
          <td><input type="text" value="<?php echo ($search['ap_name']); ?>" name="ap_name" class="txt"></td>
          <td><a href="javascript:document.formSearch.submit();" class="btn-search tooltip" title="查询">&nbsp;</a></td>
        </tr>
      </tbody>
    </table>
  </form>
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12">
        	<div class="title">
	            <h5>操作提示</h5>
	            <span class="arrow"></span>
            </div>
        </th>
      </tr>
      <tr>
      	<td>
      		<ul>
      			<li>可以对广告位进行查询，进行编辑、删除、代码调用等操作</li>
      		</ul>
      	</td>
      </tr>
    </tbody>
  </table>
  <form method='post' id="form_rec"> 
    <table class="table tb-type2 nobdb">
      <thead>
        <tr class="thead">
          <th>&nbsp;</th>
          <th>名称</th>
          <th>位置</th>
          <th>调用ID</th>
          <th class="align-center">操作</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr class="hover edit">
          <td class="w24"><input type="checkbox" name="del_id[]" value="<?php echo ($v['ap_id']); ?>" class="checkitem"></td>
          <td><?php echo ($v['ap_name']); ?></td>
          <td>
          <?php if($v['ap_code'] == 'banner'): ?>PC首页滚动图
          <?php elseif($v['ap_code'] == 'index'): ?>PC首页中部广告
          <?php elseif($v['ap_code'] == 'link'): ?>PC友情链接
          <?php elseif($v['ap_code'] == 'm_banner'): ?>手机轮播图
          <?php elseif($v['ap_code'] == 'm_adv'): ?>手机中部广告图
          <?php else: endif; ?>
          </td>
          <td><?php echo ($v['ap_code']); ?></td>
          <td class="w48 align-center">
          	<a href="<?php echo U('Adv/adv_edit',array('ap_id'=>$v['ap_id']));?>">编辑</a>
          </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        <?php else: ?>
        <tr class="no_data">
          <td colspan="10">暂无记录</td>
        </tr><?php endif; ?>
      </tbody>
      <tfoot>
        <?php if(!empty($list)): ?><tr class="tfoot" id="dataFuncs">
          <td><input type="checkbox" class="checkall" id="checkallBottom"></td>
          <td colspan="16" id="batchAction">
          	<label for="checkallBottom">全选</label>
            &nbsp;&nbsp; 
            <a href="JavaScript:void(0);" class="btn" onclick="javascript:submit_delete_batch();"><span>删除</span></a>
            <div class="pagination"><?php echo ($show_page); ?></div></td>
        </tr>
      </tfoot><?php endif; ?>
    </table>
  </form>
</div>
<script type="text/javascript">
function submit_delete_batch(id)
{
    if(confirm('确定要进行此操作?')) 
	{
        $('#form_rec').submit();
    }
}
</script>
</body></html>
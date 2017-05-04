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
      <h3>文章分类</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>管理</span></a></li>
        <li><a href="<?php echo U('Article/article_class_add');?>" ><span>添加</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th class="nobg" colspan="12"><div class="title">
            <h5>操作提示</h5>
            <span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td><ul>
            <li>管理员新增文章时，可选择文章分类，文章分类将在前台文章列表页显示</li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <form method='post'>
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="w48"></th>
          <th class="w48">排序</th>
          <th>分类名称</th>
          <th class="w96 align-center">操作</th>
        </tr>
      </thead>
      <tbody id="treet1">
        <?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr class="hover edit">
          <td>
            <input type="checkbox" name='check_ac_id[]' value="<?php echo ($v['ac_id']); ?>" class="checkitem">
           </td>
          <td class="sort">
          	<span title="可编辑" ajax_control="Article" ajax_branch='article_class_sort' datatype="number" fieldid="<?php echo ($v['ac_id']); ?>" fieldname="ac_sort" nc_type="inline_edit" class="editable"><?php echo ($v['ac_sort']); ?></span>
          </td>
          <td class="name">
         	<span title="可编辑" ajax_control="Article" required="1" fieldid="<?php echo ($v['ac_id']); ?>" ajax_branch='article_class_name' fieldname="ac_name" nc_type="inline_edit" class="editable tooltip"><?php echo ($v['ac_name']); ?></span>
          </td>
          <td class="align-center"><a href="<?php echo U('Article/article_class_edit',array('ac_id'=>$v['ac_id']));?>">编辑</a></td>
        </tr>
        
           <?php if(is_array($v['sub'])): $i = 0; $__LIST__ = $v['sub'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vb): $mod = ($i % 2 );++$i;?><tr class="hover edit">
              <td>
                <input type="checkbox" name='check_ac_id[]' value="<?php echo ($vb['ac_id']); ?>" class="checkitem">
               </td>
              <td class="sort">
                <span title="可编辑" ajax_control="Article" ajax_branch='article_class_sort' datatype="number" fieldid="<?php echo ($vb['ac_id']); ?>" fieldname="ac_sort" nc_type="inline_edit" class="editable"><?php echo ($vb['ac_sort']); ?></span>
              </td>
              <td class="name">
                <img src="/Public/admin/images/tv-expandable1.gif" nc_type="flex" status="none" fieldid="4">
                <span title="可编辑" ajax_control="Article" required="1" fieldid="<?php echo ($vb['ac_id']); ?>" ajax_branch='article_class_name' fieldname="ac_name" nc_type="inline_edit" class="editable tooltip"><?php echo ($vb['ac_name']); ?></span>
              </td>
              <td class="align-center"><a href="<?php echo U('Article/article_class_edit',array('ac_id'=>$vb['ac_id']));?>">编辑</a></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
        <?php else: ?>
        <tr class="no_data">
          <td colspan="10">暂无记录</td>
        </tr><?php endif; ?>
      </tbody>
      <tfoot>
        <?php if(!empty($list)): ?><tr>
          <td><label for="checkall1">
              <input type="checkbox" class="checkall" id="checkall_2">
            </label></td>
          <td colspan="16"><label for="checkall_2">全选</label>
            &nbsp;&nbsp;<a href="JavaScript:void(0);" class="btn" onclick="if(confirm('你确定要删除？')){$('form:first').submit();}"><span>删除</span></a>
          </td>
        </tr><?php endif; ?>
      </tfoot>
    </table>
  </form>
</div>
<script type="text/javascript" src="/Public/admin/js/jquery.edit.js" charset="utf-8"></script> 
</body></html>
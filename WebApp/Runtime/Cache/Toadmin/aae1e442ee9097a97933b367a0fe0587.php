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
      <h3>文章管理</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>管理</span></a></li>
        <li><a href="<?php echo U('Article/article_add');?>" ><span>添加</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="get" name="formSearch">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="article_title">标题</label></th>
          <td><input type="text" value="<?php echo ($search['article_title']); ?>" name="article_title" id="article_title" class="txt"></td>
          <th><label for="search_ac_id">分类</label></th>
          <td><select name="ac_id" id="ac_id" class="">
              <option value="">请选择...</option>
			  <?php if(is_array($ac_list)): $i = 0; $__LIST__ = $ac_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option <?php if($search['ac_id'] == $vo['ac_id']): ?>selected='selected'<?php endif; ?> value="<?php echo ($vo['ac_id']); ?>"><?php echo ($vo['ac_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>	
            </select>
          </td>
          <td><select name="article_show" id="article_show" class="">
              <option value="">是否推荐</option>
              <option <?php if($search['article_show'] == 1): ?>selected='selected'<?php endif; ?> value="1">是</option>
              <option <?php if($search['article_show'] == 2): ?>selected='selected'<?php endif; ?> value="2">否</option>
            </select>
          </td>          
          <td>
            <a href="javascript:document.formSearch.submit();" class="btn-search tooltip" title="查询">&nbsp;</a>
            <?php if(($search['article_title'] != '') OR ($search['ac_id'] != '')): ?><a href="<?php echo U('Article/article');?>" class="btns tooltip" title="取消查询"><span>取消查询</span></a><?php endif; ?>
         </td>
        </tr>
      </tbody>
    </table>
  </form>
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12"><div class="title">
            <h5>操作提示</h5>
            <span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td><ul>
            <li>区别于系统文章，可在文章列表页点击查看</li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <form method="post" id="form_article">
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="w24"></th>
          <th class="w48">排序</th>
          <th>标题</th>
          <th class="align-center">分类</th>
          <th class="align-center">推荐</th>
          <th class="align-center">发布时间</th>
          <th class="w60 align-center">操作</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr class="hover">
          <td><input type="checkbox" name='del_id[]' value="<?php echo ($v['article_id']); ?>" class="checkitem"></td>
          <td><?php echo ($v['article_sort']); ?></td>
          <td class="goods-name w270">
          	<p><span class="editable-tarea tooltip"><?php echo ($v['article_title']); ?></span></p>
          </td>
          <td class="align-center"><?php echo ($v['ArticleClass']['ac_name']); ?></td>
          <td class="align-center"><?php echo ($v['article_show']==0?'否':'是'); ?></td>
          <td class="nowrap align-center"><?php echo (date('Y-m-d H:i:s',$v['article_time'])); ?></td>
          <td class="align-center"><a href="<?php echo U('Article/article_edit',array('article_id'=>$v['article_id']));?>">编辑</a></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        <?php else: ?>
        <tr class="no_data">
          <td colspan="10">暂时无记录</td>
        </tr><?php endif; ?>
      </tbody>
      <tfoot>
        <?php if(!empty($list)): ?><tr class="tfoot">
          <td><input type="checkbox" class="checkall" id="checkallBottom"></td>
          <td colspan="16"><label for="checkallBottom">全选</label>
            &nbsp;&nbsp;<a href="JavaScript:void(0);" class="btn" onclick="if(confirm('你确定要删除？')){$('#form_article').submit();}"><span>删除</span></a>
            <div class="pagination"><?php echo ($show_page); ?></div></td>
        </tr><?php endif; ?>
      </tfoot>
    </table>
  </form>
</div>
</body></html>
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
        <li><a href="<?php echo U('Article/article_class');?>">管理</span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span>添加</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="article_class_form" method="post">
    <table class="table tb-type2">
      <tbody>
<!--        <tr>
          <td colspan="2" class="required"><label for="ac_parent_id">上一级分类:</label></td>
        </tr>
        <tr class="noborder">
        <td class="vatop rowform">
        <select name="ac_parent_id" id="ac_parent_id">
        <option value="0">请选择...</option>    
        <?php if(is_array($ac_list)): $i = 0; $__LIST__ = $ac_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option  value="<?php echo ($vo["ac_id"]); ?>"><?php echo ($vo["ac_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
        </td>
        <td class="vatop tips">如果选择上级分类，那么新增的分类则为被选择上级分类的子分类</td>
        </tr>  -->    
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="ac_name">分类名称:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="ac_name" id="ac_name" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>

        <tr class="noborder">
          <td colspan="2" class="required"><label for="ac_title">SEO标题:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="ac_title" id="ac_title" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label for="ac_key">SEO关键词:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="ac_key" id="ac_key" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label for="ac_desc">SEO描述:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><textarea name="ac_desc" rows="6" class="w300" id="ac_desc"></textarea></td>
          <td class="vatop tips"></td>
        </tr> 
                
        <tr>
          <td colspan="2" class="required"><label for="ac_sort">排序:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="10" name="ac_sort" id="ac_sort" class="txt"></td>
          <td class="vatop tips">格式为正整数</td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="15" ><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span>提交</span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script>
//按钮先执行验证再提交表单
$(function(){$("#submitBtn").click(function(){
    if($("#article_class_form").valid()){
     $("#article_class_form").submit();
	}
	});
});
//
$(document).ready(function(){
	$('#article_class_form').validate({
        errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        success: function(label){
            label.addClass('valid');
        },
        rules : {
            ac_name : {
                required : true
            },
            ac_sort : {
				required : true,
                number   : true
            }
        },
        messages : {
            ac_name : {
                required : '请输入分类名称'
            },
            ac_sort  : {
				required : '请输入排序信息',
                number   : '排序格式错误'
            }
        }
    });
});
</script>
</body></html>
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
        <li><a href="<?php echo U('Article/article');?>"><span>管理</span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span>编辑</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="article_form" method="post" name="articleForm" enctype="multipart/form-data">
    <input name="article_id" id="article_id" type="hidden" value="<?php echo ($vo['article_id']); ?>"/>
    <table class="table tb-type2 nobdb">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation">标题:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo ($vo['article_title']); ?>" name="article_title" id="article_title" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="cate_id">所属分类:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><select name="ac_id" id="ac_id">
              <option value="">请选择...</option>
 			  <?php if(is_array($ac_list)): $i = 0; $__LIST__ = $ac_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v['ac_id']); ?>" <?php if($v['ac_id'] == $vo['ac_id']): ?>selected="selected"<?php endif; ?>><?php echo ($v['ac_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select></td>
          <td class="vatop tips"></td>
        </tr>
         <tr class="noborder">
          <td colspan="2" class="required"><label>关键词:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo ($vo['article_key']); ?>" name="article_key" id="article_key" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>         
         <tr class="noborder">
          <td colspan="2" class="required"><label>描述信息:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><textarea id="article_desc" class="tarea" rows="6" name="article_desc"><?php echo ($vo['article_desc']); ?></textarea></td>
          <td class="vatop tips"></td>
        </tr> 
              
<!--        <tr>
          <td colspan="2" class="required"><label for="article_pic">图片:</label></td>
        </tr>
        <tr class="noborder">
         <td class="vatop rowform">  
            <span class="type-file-show">
          	<img class="show_image" src="/Public/admin/images/preview.png">
            <div class="type-file-preview"><img src="/Uploads/<?php echo ($vo['article_pic']); ?>"></div>
            </span>
            <span class="type-file-box">
            <input type='text' name='txt_article_pic' id='txt_article_pic' class='type-file-text' />
            <input type='button' name='but_article_pic' id='but_article_pic' value='' class='type-file-button' />
            <input name="article_pic" type="file" class="type-file-file" id="article_pic" size="30" hidefocus="true" nc_type="change_article_pic">
            </span>
          </td>
          <td class="vatop tips"><span class="vatop rowform"></span></td>
        </tr>        
        <tr>
          <td colspan="2" class="required"><label for="articleForm">链接:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo ($vo['article_url']); ?>" name="article_url" id="article_url" class="txt"></td>
          <td class="vatop tips">链接格式请以http://开头</td>
        </tr>-->
        
        <tr>
          <td colspan="2" class="required"><label>是否推荐:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff"><label for="article_show1" class='cb-enable <?php if($vo['article_show'] == 1): ?>selected<?php endif; ?>'><span>是</span></label>
            <label for="article_show0" class='cb-disable <?php if($vo['article_show'] == 0): ?>selected<?php endif; ?>'><span>否</span></label>
            <input id="article_show1" name="article_show" <?php if($vo['article_show'] == 1): ?>checked="checked"<?php endif; ?> value="1" type="radio">
            <input id="article_show0" name="article_show" <?php if($vo['article_show'] == 0): ?>checked="checked"<?php endif; ?> value="0" type="radio"></td>
          <td class="vatop tips">设为推荐将在首页中显示</td>
        </tr>
        <tr>
          <td colspan="2" class="required">排序: </td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo ($vo['article_sort']); ?>" name="article_sort" id="article_sort" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation">文章内容:</label></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="vatop rowform"><?php kindEditor('article_content',$vo['article_content']);?></td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="15" ><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span>保存</span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script>
//按钮先执行验证再提交表单
$(function(){$("#submitBtn").click(function(){
    if($("#article_form").valid()){
     $("#article_form").submit();
	}
	});
});
//
$(document).ready(function(){
	$('#article_form').validate({
        errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        success: function(label){
            label.addClass('valid');
        },
        rules : {
            article_title : {
                required   : true
            },
			ac_id : {
                required   : true
            },
			article_url : {
				url : true
            },
			article_content : {
                required   : true
            },
            article_sort : {
                number   : true
            }
        },
        messages : {
            article_title : {
                required   : '请输入标题'
            },
			ac_id : {
                required   : '请选择分类'
            },
			article_url : {
				url : '输入错误'
            },
			article_content : {
                required   : '请输入内容'
            },
            article_sort  : {
                number   : '输入错误'
            }
        }
    });
	
});
</script>
<script type="text/javascript">
// 模拟网站LOGO上传input type='file'样式
$(function(){
	$("#article_pic").change(function(){
		$("#txt_article_pic").val($(this).val());
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
});
</script>
</body></html>
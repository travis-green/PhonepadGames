var goods_class_deep = 2;//默认产品分类为2级
$(document).ready(function(){
	//列表下拉
	$('img[nc_type="flex"]').click(function(){
		var status = $(this).attr('status');
		if(status == 'open'){
			var pr = $(this).parent('td').parent('tr');
			var id = $(this).attr('fieldid');
			var obj = $(this);
			$(this).attr('status','none');
			//ajax
			$.ajax({
				url: AdminUrl+'/Goods/goods_nc_ajax/gc_parent_id/'+id,
				dataType: 'json',
				success: function(data){
					var src='';
					for(var i = 0; i < data.length; i++){
						var tmp_vertline = "<img class='preimg' src='"+SiteUrl+"/Public/admin/images/vertline.gif'/>";
						src += "<tr class='"+pr.attr('class')+" row"+id+"'>";
						src += "<td class='w36'><input type='checkbox' name='check_gc_id[]' value='"+data[i].gc_id+"' class='checkitem'>";
						//图片
						if(data[i].have_child == 1){
							src += " <img fieldid='"+data[i].gc_id+"' status='open' nc_type='flex' src='"+SiteUrl+"/Public/admin/images/tv-expandable.gif' />";
						}else{
							src += " <img fieldid='"+data[i].gc_id+"' status='none' nc_type='flex' src='"+SiteUrl+"/Public/admin/images/tv-item.gif' />";
						}
						src += "</td><td class='w48 sort'>";						
						//排序
						src += " <span title='可编辑下级分类排序' ajax_branch='gc_sort' ajax_control='Goods' datatype='number' fieldid='"+data[i].gc_id+"' fieldname='gc_sort' ajax_control='Goods' nc_type='inline_edit' class='editable tooltip'>"+data[i].gc_sort+"</span></td>";
						//名称
						src += "<td class='w50pre name'>";
						
						
						for(var tmp_i=1; tmp_i < (data[i].deep-1); tmp_i++){
							src += tmp_vertline;
						}
						if(data[i].have_child == 1){
							src += " <img fieldid='"+data[i].gc_id+"' status='open' nc_type='flex' src='"+SiteUrl+"/Public/admin/images/tv-item1.gif' />";
						}else{
							src += " <img fieldid='"+data[i].gc_id+"' status='none' nc_type='flex' src='"+SiteUrl+"/Public/admin/images/tv-expandable1.gif' />";
						}
						src += " <span title='可编辑下级分类名称' required='1' fieldid='"+data[i].gc_id+"' ajax_branch='gc_name' t' ajax_control='Goods' ajax_control='Goods' fieldname='gc_name' nc_type='inline_edit' class='editable tooltip'>"+data[i].gc_name+"</span>";
						//新增下级
						if(data[i].deep < goods_class_deep){
							src += "<a class='btn-add-nofloat marginleft' href='"+AdminUrl+"/Goods/goods_class_add/gc_parent_id/"+data[i].gc_id+"'><span>新增下级</span></a>";
						}
						src += "</td>";
						//类型
						src += "<td></td>";
						//显示
						src += "<td class='align-center power-onoff'>";
						src += "</td>";
						//显示
						src += "</td>";						
						//操作
						src += "<td class='w84'>";
						src += "<a href='"+AdminUrl+"/Goods/goods_class_edit/gc_id/"+data[i].gc_id+"'>编辑</a>";
						src += " | <a href=\"javascript:if(confirm('您确定要删除吗'))window.location = '"+AdminUrl+"/Goods/goods_class_del/gc_id/"+data[i].gc_id+"';\">删除</a>";
						src += "</td>";
						src += "</tr>";
					}
					//插入
					pr.after(src);
					obj.attr('status','close');
					obj.attr('src',obj.attr('src').replace("tv-expandable","tv-collapsable"));
					$('img[nc_type="flex"]').unbind('click');
					$('span[nc_type="inline_edit"]').unbind('click');
					//重现初始化页面
                    $.getScript(SiteUrl+"/Public/admin/js/jquery.edit.js");
					$.getScript(SiteUrl+"/Public/admin/js/jquery.goods_class.js");
					$.getScript(SiteUrl+"/Public/admin/js/jquery.tooltip.js");
					$.getScript(SiteUrl+"/Public/admin/js/admincp.js");
				},
				error: function(){
					alert('获取信息失败');
				}
			});
		}
		if(status == 'close'){
			$(".row"+$(this).attr('fieldid')).remove();
			$(this).attr('src',$(this).attr('src').replace("tv-collapsable","tv-expandable"));
			$(this).attr('status','open');
		}
	})
});
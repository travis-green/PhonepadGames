	$(document).ready(function(){
		$("#province").change(function(){
			var province_id=$(this).val();
			var pr = $("#district_list");
			$("#citySpan").load(AdminUrl+"/Setting/get_city_list?sign=1&cid="+province_id);
			$("#townSpan").html('');
			$("#areaSpan").html('');
			$.ajax({
				url: AdminUrl+"/Setting/show_district_list?cid="+province_id,
				dataType: 'json',
				success: function(data){
					var info='';
					for(var i = 0; i < data.length; i++)
					{
						info+='<tr class="hover edit">';
						info+='<td class="w48 sort"><span title="可编辑" ajax_branch="d_sort" ajax_control="Setting" datatype="number" fieldid="'+data[i].id+'"fieldname="d_sort" nc_type="inline_edit" class="editable tooltip">'+data[i].d_sort+'</span></td>';
						info+='<td class="w50pre name"><span title="可编辑" required="1" fieldid="'+data[i].id+'" ajax_branch="name" ajax_control="Setting" fieldname="name" nc_type="inline_edit" class="editable tooltip">'+data[i].name+'</span></td>';		
						info+='<td class="power-onoff"><a href="JavaScript:void(0);" class="tooltip disabled" fieldvalue="0" fieldid="'+data[i].id+'" ajax_control="Setting" ajax_branch="usetype" fieldname="usetype" nc_type="inline_edit" title="设置为常用城市"><img src="'+SiteUrl+'/Public/admin/images/transparent.gif"></a></td></tr>';
						
					}
					pr.html(info);
					$.getScript(SiteUrl+"/Public/admin/js/jquery.edit.js");
					$.getScript(SiteUrl+"/Public/admin/js/arealist.js");
					$.getScript(SiteUrl+"/Public/admin/js/jquery.tooltip.js");
					$.getScript(SiteUrl+"/Public/admin/js/admincp.js");				  
				},
				error: function(){
					alert('获取信息失败');
				}				
			});	
		});		

	})

	function city()
	{
		var city_id=$("#city").val();
		var pr = $("#district_list");
		$("#townSpan").load(AdminUrl+"/Setting/get_city_list?sign=2&cid="+city_id);
		$("#areaSpan").html('');
		$.ajax({
			url: AdminUrl+"/Setting/show_district_list?cid="+city_id,
			dataType: 'json',
			success: function(data){
				var info='';
				for(var i = 0; i < data.length; i++)
				{
					info+='<tr class="hover edit">';
					info+='<td class="w48 sort"><span title="可编辑" ajax_branch="d_sort" ajax_control="Setting" datatype="number" fieldid="'+data[i].id+'"fieldname="d_sort" nc_type="inline_edit" class="editable tooltip">'+data[i].d_sort+'</span></td>';
					info+='<td class="w50pre name"><span title="可编辑" required="1" fieldid="'+data[i].id+'" ajax_branch="name" ajax_control="Setting" fieldname="name" nc_type="inline_edit" class="editable tooltip">'+data[i].name+'</span></td>';		
					info+='<td class="power-onoff"><a href="JavaScript:void(0);" class="tooltip disabled" fieldvalue="0" fieldid="'+data[i].id+'" ajax_control="Setting" ajax_branch="usetype" fieldname="usetype" nc_type="inline_edit" title="设置为常用城市"><img src="'+SiteUrl+'/Public/admin/images/transparent.gif"></a></td></tr>';
				}
				pr.html(info);
				$.getScript(SiteUrl+"/Public/admin/js/jquery.edit.js");
				$.getScript(SiteUrl+"/Public/admin/js/arealist.js");
				$.getScript(SiteUrl+"/Public/admin/js/jquery.tooltip.js");
				$.getScript(SiteUrl+"/Public/admin/js/admincp.js");				  
			},
			error: function(){
				alert('获取信息失败');
			}				
		});	
	}	
	function town()
	{
		var town_id=$("#town").val();
		var pr = $("#district_list");
		$("#areaSpan").load(AdminUrl+"/Setting/get_city_list?sign=3&cid="+town_id);
		$.ajax({
			url: AdminUrl+"/Setting/show_district_list?cid="+town_id,
			dataType: 'json',
			success: function(data){
				var info='';
				for(var i = 0; i < data.length; i++)
				{
					info+='<tr class="hover edit">';
					info+='<td class="w48 sort"><span title="可编辑" ajax_branch="d_sort" ajax_control="Setting" datatype="number" fieldid="'+data[i].id+'"fieldname="d_sort" nc_type="inline_edit" class="editable tooltip">'+data[i].d_sort+'</span></td>';
					info+='<td class="w50pre name"><span title="可编辑" required="1" fieldid="'+data[i].id+'" ajax_branch="name" ajax_control="Setting" fieldname="name" nc_type="inline_edit" class="editable tooltip">'+data[i].name+'</span></td>';		
					info+='<td class="power-onoff"><a href="JavaScript:void(0);" class="tooltip disabled" fieldvalue="0" fieldid="'+data[i].id+'" ajax_control="Setting" ajax_branch="usetype" fieldname="usetype" nc_type="inline_edit" title="设置为常用城市"><img src="'+SiteUrl+'/Public/admin/images/transparent.gif"></a></td></tr>';
				}
				pr.html(info);
				$.getScript(SiteUrl+"/Public/admin/js/jquery.edit.js");
				$.getScript(SiteUrl+"/Public/admin/js/jquery.district.js");
				$.getScript(SiteUrl+"/Public/admin/js/jquery.tooltip.js");
				$.getScript(SiteUrl+"/Public/admin/js/admincp.js");				  
			},
			error: function(){
				alert('获取信息失败');
			}				
		});			
	}
$(document).ready(function(){
    var url = window.location.search;
    var params  = url.substr(1).split('&');
    var act = '';
    var op  = '';
    for(var j=0; j < params.length; j++)
    {
        var param = params[j];
        var arr   = param.split('=');
        if(arr[0] == 'act')
        {
            act = arr[1];
        }
        if(arr[0] == 'op')
        {
            sort = arr[1];
        }
    }
	//给需要修改的位置添加修改行为
	$('span[nc_type="inline_edit"]').click(function(){
		var s_value  = $(this).text();
		var s_name   = $(this).attr('fieldname');
		var s_id     = $(this).attr('fieldid');
		var req      = $(this).attr('required');
		var type     = $(this).attr('datatype');
		var max      = $(this).attr('maxvalue');
		var ajax_branch = $(this).attr('ajax_branch');
		var ajax_control = $(this).attr('ajax_control'); //控制器名称
		
		$('<input type="text">')
                        .attr({value:s_value})
                        .insertAfter($(this))
                        .focus()
                        .select()
                       
					.blur(function(){
					if(req)
					{
						if(!required($(this).attr('value'),s_value,$(this)))
						{
							return;
						}
					}
					if(type)
					{
						if(!check_type(type,$(this).attr('value'),s_value,$(this)))
						{
							return;
						}
					}
					if(max)
					{
						if(!check_max($(this).attr('value'),s_value,max,$(this)))
						{
							return;
						}
					}
					$(this).prev('span').show().text($(this).attr('value'));
					$.get(AdminUrl+'/'+ajax_control+'/ajax',{branch:ajax_branch,id:s_id,column:s_name,value:$(this).attr('value')},function(data){
						if(data === 'false')
						{
							alert('名称已经存在，请您换一个');
							$('span[fieldname="'+s_name+'"][fieldid="'+s_id+'"]').text(s_value);
							return;
						}
					});
					$(this).remove();
				});
		$(this).hide();
	});
	
	$('a[nc_type="inline_edit"]').click(function(){
		var i_id    = $(this).attr('fieldid');
		var i_name  = $(this).attr('fieldname');
		var i_src   = $(this).attr('src');
		var i_val   = ($(this).attr('fieldvalue'))== 0 ? 1 : 0;
		var ajax_branch      = $(this).attr('ajax_branch');
		var ajax_control = $(this).attr('ajax_control'); //控制器名称

		$.get(AdminUrl+'/'+ajax_control+'/ajax',{branch:ajax_branch,id:i_id,column:i_name,value:i_val},function(data){
		if(data == 'true')
			{
				if(i_val == 0){
					$('a[fieldid="'+i_id+'"][fieldname="'+i_name+'"]').attr({'class':('enabled','disabled'),'title':('开启','关闭'),'fieldvalue':i_val});
				}else{
					$('a[fieldid="'+i_id+'"][fieldname="'+i_name+'"]').attr({'class':('disabled','enabled'),'title':('关闭','开启'),'fieldvalue':i_val});
				}
			}else{
				alert('响应失败');
			}
		});
	});

    //给列表有排序行为的列添加鼠标手型效果
    $('span[nc_type="order_by"]').hover(function(){$(this).css({cursor:'pointer'});},function(){});
	
});
//检查提交内容的必须项
function required(str,s_value,jqobj)
{
	if(str == '')
	{
		jqobj.prev('span').show().text(s_value);
		jqobj.remove();
		alert('此项不能为空');
		return 0;
	}
return 1;
}
//检查提交内容的类型是否合法
function check_type(type, value, s_value, jqobj)
{
	if(type == 'number')
	{
		if(isNaN(value))
		{
		jqobj.prev('span').show().text(s_value);
		jqobj.remove();
		alert('此项仅能为数字');
		return 0;
		}
	}
	if(type == 'int')
	{
		var regu = /^-{0,1}[0-9]{1,}$/;
		if(!regu.test(value))
		{
			jqobj.prev('span').show().text(s_value);
			jqobj.remove();
			alert('此项仅能为整数');
			return 0;
		}
	}
	if(type == 'pint')
	{
		var regu = /^[0-9]+$/;
		if(!regu.test(value))
		{
			jqobj.prev('span').show().text(s_value);
			jqobj.remove();
			alert('此项仅能为正整数');
			return 0;
		}
	}
	if(type == 'zint')
	{
		var regu = /^[1-9]\d*$/;
		if(!regu.test(value))
		{
			jqobj.prev('span').show().text(s_value);
			jqobj.remove();
			alert('此项仅能为正整数');
			return 0;
		}
	}
		if(type == 'discount')
	{
		var regu = /[1-9]|0\.[1-9]|[1-9]\.[0-9]/;
		if(!regu.test(value))
		{
			jqobj.prev('span').show().text(s_value);
			jqobj.remove();
			alert('只能是0.1-9.9之间的数字');
			return 0;
		}
	}
	return 1;
}
//检查所填项的最大值
function check_max(str,s_value,max,jqobj)
{
	if(parseInt(str) > parseInt(max))
	{
		jqobj.prev('span').show().text(s_value);
		jqobj.remove();
		alert('此项应小于等于'+max);
		return 0;
	}
	return 1;
}
/**
* 杨胜江
* 前台公共函数
**/
var SITE_URL ='127.0.0.1/ychl';

/* 格式化金额 */
function price_format(price)
{
    if(typeof(PRICE_FORMAT) == 'undefined'){
        PRICE_FORMAT = '&yen;%s';
    }
    price = number_format(price, 2);

    return PRICE_FORMAT.replace('%s', price);
}

function number_format(num, ext)
{
    if(ext < 0){
        return num;
    }
    num = Number(num);
    if(isNaN(num)){
        num = 0;
    }
    var _str = num.toString();
    var _arr = _str.split('.');
    var _int = _arr[0];
    var _flt = _arr[1];
    if(_str.indexOf('.') == -1){
        /* 找不到小数点，则添加 */
        if(ext == 0){
            return _str;
        }
        var _tmp = '';
        for(var i = 0; i < ext; i++){
            _tmp += '0';
        }
        _str = _str + '.' + _tmp;
    }else{
        if(_flt.length == ext){
            return _str;
        }
        /* 找得到小数点，则截取 */
        if(_flt.length > ext){
            _str = _str.substr(0, _str.length - (_flt.length - ext));
            if(ext == 0){
                _str = _int;
            }
        }else{
            for(var i = 0; i < ext - _flt.length; i++){
                _str += '0';
            }
        }
    }

    return _str;
}

//收藏js
function collect_info(info_id,infotype)
{
	
	$.get(SITE_URL+'/Index/isLogin', function(result){
	    if(result=='0'){
	    	//alert('请先登录');
			ajax_form('dialog_ts', '信息提示', "/index.php?m=Home&c=Public&a=dialog&t="+infotype+"&id="+info_id+"&info=请先登录", 400,0);
	    }else{
	    	var url = SITE_URL+'/Member/Operation/favorites';
	    	$.getJSON(url, {'type':infotype,'info_id':info_id}, function(data){
              // alert(data.msg);
			   ajax_form('dialog_ts', '信息提示', "/index.php?m=Home&c=Public&a=dialog&info="+data.msg, 400,0);
	        });
	    }
	});
	
}

//加入收藏
function AddFavorite(sURL, sTitle) {
    sURL = encodeURI(sURL);
 try{  
     window.external.addFavorite(sURL, sTitle);  
 }catch(e) {  
     try{  
         window.sidebar.addPanel(sTitle, sURL, "");  
     }catch (e) {
          alert("加入收藏失败，请使用Ctrl+D进行添加,或手动在浏览器里进行设置.");
		 // ajax_form('dialog_ts', '信息提示', "/index.php?m=Home&c=Public&a=dialog&info=收藏失败,请手动进行设置", 400,0);
     }  
 }
}
//设为首页
function SetHome(url){
 if (document.all) {
        document.body.style.behavior='url(#default#homepage)';
        document.body.setHomePage(url);
 }else{
     alert("您好,您的浏览器不支持自动设置页面为首页功能,请您手动在浏览器里设置该页面为首页!");
	// ajax_form('dialog_ts', '信息提示', "/index.php?m=Home&c=Public&a=dialog&info=浏览器不支持,请手动进行设置", 400,0);
 }
}
/* 显示Ajax表单 */
function ajax_form(id, title, url, width, model)
{
    if (!width)	width = 480;
    if (!model) model = 1;
    var d = DialogManager.create(id);
    d.setTitle(title);
    d.setContents('ajax', url);
    d.setWidth(width);
    d.show('center',model);
    return d;
}
function ajax_form1(id, title, url, width, model)
{
    //if (!width)	width = '100%';
    if (!model) model = 1;
    var d = DialogManager.create(id);
    d.setTitle(title);
    d.setContents('ajax', url);
   // d.setWidth(width);
	//d.setStyle("",'z-index: 1100; position: absolute; top: 109.5px;left:0;');//'style','z-index: 1100; position: absolute; top: 109.5px;left:0;'
	d.setPosition('');
    d.show('left',model);
    return d;
}
var showDialogST = null;
function showDialog(msg, mode, t, func, cover, funccancel, leftmsg, confirmtxt, canceltxt, closetime, locationtime) {
	if (mode == 'js'){
		eval(func);
		//hideMenu(menuid, 'dialog');
		return ;
	}

	clearTimeout(showDialogST);
	cover = isUndefined(cover) ? (mode == 'info' ? 0 : 1) : cover;
	leftmsg = isUndefined(leftmsg) ? '' : leftmsg;
	mode = in_array(mode, ['confirm', 'notice', 'info', 'succ']) ? mode : 'alert';
	var menuid = 'fwin_dialog';
	var menuObj = $$(menuid);
	var showconfirm = 1;
	confirmtxtdefault = '确定';
	closetime = isUndefined(closetime) ? '' : closetime;
	closefunc = function () {
		if(typeof func == 'function') func();
		else eval(func);
		hideMenu(menuid, 'dialog');
	};
	if(closetime) {
		leftmsg = closetime + ' 秒后窗口关闭';
		showDialogST = setTimeout(closefunc, closetime * 1000);
		showconfirm = 0;
	}
	locationtime = isUndefined(locationtime) ? '' : locationtime;
	if(locationtime) {
		leftmsg = locationtime + ' 秒后页面跳转';
		showDialogST = setTimeout(closefunc, locationtime * 1000);
		showconfirm = 0;
	}
	confirmtxt = confirmtxt ? confirmtxt : confirmtxtdefault;
	canceltxt = canceltxt ? canceltxt : '取消';

	if(menuObj) hideMenu('fwin_dialog', 'dialog');
	menuObj = document.createElement('div');
	menuObj.style.display = 'none';
	menuObj.className = 'fwinmask';
	menuObj.id = menuid;
	$$('append_parent').appendChild(menuObj);
	var hidedom = '';
	if(!BROWSER.ie) {
		hidedom = '<style type="text/css">object{visibility:hidden;}</style>';
	}
	var s = hidedom + '<table cellpadding="0" cellspacing="0" class="fwin"><tr><td class="t_l"></td><td class="t_c"></td><td class="t_r"></td></tr><tr><td class="m_l">&nbsp;</td><td class="m_c"><h3 class="flb"><div class="flb_title">';
	s += t ? t : '提示信息';
	s += '</div><span><a href="javascript:void(0)" id="fwin_dialog_close" class="flbc" onclick="hideMenu(\'' + menuid + '\', \'dialog\')" title="关闭">关闭</a></span></h3>';
	if(mode == 'info') {
		s += msg ? msg : '';
	} else {
		s += '<div class="c altw"><div class="' + (mode == 'alert' ? 'alert_error' : (mode == 'succ' ? 'alert_right' : 'alert_info')) + '"><p>' + msg + '</p></div></div>';
		s += '<p class="o pns">' + (leftmsg ? '<span class="z xg1">' + leftmsg + '</span>' : '') + (showconfirm ? '<button id="fwin_dialog_submit" value="true" class="pn pnc"><strong>'+confirmtxt+'</strong></button>' : '');
		s += mode == 'confirm' ? '<button id="fwin_dialog_cancel" value="true" class="pn" onclick="hideMenu(\'' + menuid + '\', \'dialog\')"><strong>'+canceltxt+'</strong></button>' : '';
		s += '</p>';
	}
	s += '</td><td class="m_r"></td></tr><tr><td class="b_l"></td><td class="b_c"></td><td class="b_r"></td></tr></table>';
	menuObj.innerHTML = s;
	if($$('fwin_dialog_submit')) $$('fwin_dialog_submit').onclick = function() {
		if(typeof func == 'function') func();
		else eval(func);
		hideMenu(menuid, 'dialog');
	};
	if($$('fwin_dialog_cancel')) {
		$$('fwin_dialog_cancel').onclick = function() {
			if(typeof funccancel == 'function') funccancel();
			else eval(funccancel);
			hideMenu(menuid, 'dialog');
		};
		$$('fwin_dialog_close').onclick = $$('fwin_dialog_cancel').onclick;
	}
	showMenu({'mtype':'dialog','menuid':menuid,'duration':3,'pos':'00','zindex':JSMENU['zIndex']['dialog'],'cache':0,'cover':cover});
	try {
		if($$('fwin_dialog_submit')) $$('fwin_dialog_submit').focus();
	} catch(e) {}
}
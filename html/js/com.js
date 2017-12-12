function showView(){
    document.getElementById('Popup').style.display='block';
}
function Close(){
    document.getElementById('Popup').style.display='none';
}

$(function(){
	var e;
	$('.nav ul li').hover(function(){
		  e&&clearTimeout(e);
	      var m_l=parseInt($(this).position().left) + parseInt($(this).css('margin-left'));
		  $('.sign').animate({
		    	left:m_l
		  });
	},function(){
		  e=setTimeout(function(){
			var on_Val = parseInt( $('.nav ul li.on').position().left ) + parseInt($('.nav ul li.on').css('margin-left'));
			$('.sign').animate({
				left:on_Val
			});
		},500);
	});
});
jQuery(document).ready(function($) {
	
	$('a[href$=".gif"], a[href$=".jpg"], a[href$=".png"], a[href$=".bmp"]').addClass("fancybox");
	$('.fancybox').fancybox();
	
	$(window).scroll(function(){
		var windowScrollTop = $(window).scrollTop();
		var moveMe = Math.round($(window).scrollTop()/12);

		if( windowScrollTop > 200 ) {
			$('body').addClass('body-scrolled');
		} else {
			$('body').removeClass('body-scrolled');
		}

	});

	$('.menu > li').each(function(){
		if( $(this).find('.sub-menu').length > 0 ) {
			$(this).find('a').first().removeAttr('href').css('cursor','pointer').addClass('open-subnav');
		}
	});

	$('body').on('click, tap', '.phone-nav', function(e){
		$(this).toggleClass('phone-nav-active');
		$('.menu').toggleClass('menu-active');
		$(window).scrollTop(0);
		
	});

});

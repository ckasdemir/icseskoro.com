jQuery(function($) {

    /*==========================================
    GENERAL CUSTOM SCRIPTS
    =====================================================*/

	

    // LINKS SCROLLING FUNCTION 

	$('.navbar-nav > li').click(function(event) {
		event.preventDefault();
		var target = $(this).find('>a').prop('hash');
		$('html, body').animate({
			scrollTop: $(target).offset().top
		}, 500);
	});

	
    // PRETTYPHOTO FUNCTION 

	$("a.preview").prettyPhoto({
		social_tools: false
	});

	//ISOTOPE FUNCTION - FILTER PORTFOLIO FUNCTION
	$(window).load(function(){
		$portfolio = $('.portfolio-items, .portfolio-items2');
		$portfolio.isotope({
			itemSelector : 'article',
			layoutMode : 'fitRows'
		});
		$portfolio_selectors = $('.portfolio-filter >li>a, .portfolio-filter2 >li>a');
		$portfolio_selectors.on('click', function(){
			$portfolio_selectors.removeClass('active');
			$(this).addClass('active');
			var selector = $(this).attr('data-filter');
			$portfolio.isotope({ filter: selector });
			return false;
		});
	});

   

    /*==========================================
    WRITE  YOUR  SCRIPTS BELOW
    =====================================================*/

});
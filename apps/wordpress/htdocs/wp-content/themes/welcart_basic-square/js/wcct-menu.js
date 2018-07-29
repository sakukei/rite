( function( $ ) {

//$( document ).ready( function() {
	$( window ).load( function() {

		$(document).on('click touchend', function(event) {
		  
			/* search */
			if (!$(event.target).closest('.snav i, .s-box , .membership ul').length) {
				$(".snav div").removeClass('On');				
			}
			
			/* widget-cart */
			if ($(event.target).closest('.incart-btn i.widget-cart').length) {
				$(".view-cart").toggleClass('On');
			}else if (! $(event.target).closest('.view-cart').length) {
				$(".view-cart").removeClass('On');			  
			}
			
			});
		
		if( $('.tab-list').length ){
			$('.tab-list li:first,.tab-box:first').addClass('select');
			$('.tab-list li').click(function() {
				var num = $('.tab-list li').index(this);
				$('.tab-list li,.tab-box').removeClass('select');
				$(this).addClass('select');
				$('.tab-box').eq(num).addClass('select');
			});
		}
		
		var bodyhsize = $('body').height();

		if ( $(window).width() <= 1000 ) {
			var sitenav = $('#mobile-menu');
			var menutrigger = $('.menu-trigger');
			sitenav.css('height', bodyhsize + 'px');

			menutrigger.click(function(){
				sitenav.toggleClass('On');
				$(this).toggleClass('active');
			});

		} else {
			var sitehead = $('.site-header');
			var conhsize = bodyhsize - sitehead.height();
			var winhsize = $(window).height();
			if( conhsize > winhsize ) {
				$(window).on('scroll', function() {
					if ( $(this).scrollTop() > 48 ) {
						sitehead.addClass('fixed');
					} else {
						sitehead.removeClass('fixed');
					}
				});
			}
		}

	} );

	
} )( jQuery );
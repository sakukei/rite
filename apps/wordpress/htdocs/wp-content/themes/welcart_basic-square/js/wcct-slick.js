( function( $ ) {
$( document ).ready( function() {
	$('.slider-for').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		fade: true,
		asNavFor: '.slider-nav'
	});
	$('.slider-nav').slick({
		slidesToShow: 4,
		slidesToScroll: 1,
		speed: 150,
		asNavFor: '.slider-for',
		arrows: true,
		dots: false,
		focusOnSelect: true
	});
	

/*　front-page.php main-image　*/

		$('.main-slider').slick({
			autoplay: true,
			autoplaySpeed: 5000,
			speed: 800,
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			dots: true,
			focusOnSelect: false,
		});

	
/*　front-page.php .category-area block　*/

		$('.cat-slider').slick({
			slidesToShow: 4,
			slidesToScroll: 1,
			speed: 150,
			arrows: true,
			dots: false,
			focusOnSelect: false,
			responsive: [{
				breakpoint: 620,
				settings: {
					slidesToShow: 2,
				}
			}, {
				breakpoint: 1400,
				settings: {
					slidesToShow: 3,
				}						
			}]
			
		});

/*　front-page.php .front-il block　*/

		$('.item-block-slider').slick({
			slidesToShow: 5,
			slidesToScroll: 1,
			speed: 150,
			arrows: true,
			dots: false,
			touchMove: true,
			swipeToSlide: true,

			focusOnSelect: false,
			responsive: [{
				breakpoint: 620,
				settings: {
					slidesToShow: 2,
				}
			}, {
				breakpoint: 1000,
				settings: {
					slidesToShow: 3,
				}						
			},{
				breakpoint: 1400,
				settings: {
					slidesToShow: 4,
				}						
			}]
		});


} );
} )( jQuery );
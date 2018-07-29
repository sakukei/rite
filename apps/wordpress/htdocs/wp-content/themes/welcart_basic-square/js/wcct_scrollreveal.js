( function( $ ) {
	
	$(window).load(function(){

        var config = {
		  reset: false,
		  viewFactor : 0.1,
          duration   : 800,
          distance   : "0px",
          scale      : 0.1,
        };

        window.sr = ScrollReveal( config );
		sr.reveal( '.grid-item .inner');

	} );

} )( jQuery );

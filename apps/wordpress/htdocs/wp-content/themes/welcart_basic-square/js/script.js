var nowPostNum = 15; // 現在表示されている数
var getPostNum = 15; // 一度に取得する数
var baseUrl = location.protocol + '//' + location.hostname + '/wp-content/themes/welcart_basic-square';

jQuery( function() {
	jQuery( '#more a' ).live( 'click', function() {
		jQuery( '#more' ).html( '<img class="ajax_loading" src="' + baseUrl + '/images/loading.gif" />' );

		jQuery.ajax({
			type: 'post',
			url: baseUrl + '/more-pickup.php',
			data: {
				nowPostNum: nowPostNum,
				getPostNum: getPostNum
			},
			success: function( data ) {
				data = JSON.parse( data );
				nowPostNum = nowPostNum + getPostNum;
				jQuery( '.top-pickup' ).append( data.html );
				jQuery( '#more' ).remove();
				if ( ! data.noDataFlg ) {
					jQuery( '.top-pickup' ).append( '<div id="more"><p class="incart-btn"><a href="#" class="header-incart-btn"><span class="incart-btn-text">もっと見る</span></a></p></div>' );
				}
			}
		});
		return false;
	});
  jQuery('.js-cart').on('click',function(){
    ga('send','event', {
      eventCategory: 'Link',
      eventAction: 'click',
      eventLabel: location.href
    });
  });
});



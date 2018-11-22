var nowPostNum = 15; // 現在表示されている数
var getPostNum = 15; // 一度に取得する数
var nowPostNumS = 10; // 現在表示されている数
var getPostNumS = 10; // 一度に取得する数
var baseUrl = location.protocol + '//' + location.hostname + '/wp-content/themes/welcart_basic-square';

/* more pickup */
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
});

/* more search */
jQuery( function() {
	jQuery( '#more-search a' ).live( 'click', function() {
		jQuery( '#more-search' ).html( '<img class="ajax_loading" src="' + baseUrl + '/images/loading.gif" />' );

		jQuery.ajax({
			type: 'post',
			url: baseUrl + '/more-search.php',
			data: {
				nowPostNumS: nowPostNumS,
				getPostNumS: getPostNumS
			},
			success: function( data ) {
				data = JSON.parse( data );
				nowPostNumS = nowPostNumS + getPostNumS;
				jQuery( '.search-li' ).append( data.html );
				jQuery( '#more-search' ).remove();
				if ( ! data.noDataFlg ) {
					jQuery( '.column' ).append( '<div id="more-search"><p class="incart-btn"><a href="#" class="header-incart-btn"><span class="incart-btn-text">もっと見る</span></a></p></div>' );
				}
			}
		});
		return false;
	});
});

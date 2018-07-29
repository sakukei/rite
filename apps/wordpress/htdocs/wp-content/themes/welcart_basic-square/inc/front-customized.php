<?php 
/***********************************************************
* welcart_basic_filter_single_item_autodelivery
***********************************************************/
add_action( 'welcart_basic_filter_single_item_autodelivery', 'welcart_basic_child_filter_single_item_autodelivery' );
function welcart_basic_child_filter_single_item_autodelivery($html) {
	global $post, $usces;

	ob_start();
	if( 'regular' == $usces->getItemChargingType( $post->ID ) ) : 
		$regular_unit = get_post_meta( $post->ID, '_wcad_regular_unit', true );
		if( 'day' == $regular_unit ) {
			$regular_unit_name = __('Daily','autodelivery');
		} elseif( 'month' == $regular_unit ) {
			$regular_unit_name = __('Monthly','autodelivery');
		} else {
			$regular_unit_name = '';
		}
		$regular_interval = get_post_meta( $post->ID, '_wcad_regular_interval', true );
		$regular_frequency = get_post_meta( $post->ID, '_wcad_regular_frequency', true );

		if( usces_have_zaiko_anyone( $post->ID ) ) :
			usces_the_item();
?>
<div id="wc_regular">
	<p class="wcr_tlt"><?php _e('Regular Purchase', 'autodelivery') ?></p>
	<div class="field">
		<table class="autodelivery">
			<tr><th><?php echo apply_filters( 'wcad_filter_item_single_label_interval', __('Interval', 'autodelivery') ); ?></th><td><?php echo $regular_interval; ?><?php echo $regular_unit_name; ?></td></tr>
		<?php if( 1 < (int)$regular_frequency ) : ?>
			<tr><th><?php echo apply_filters( 'wcad_filter_item_single_label_frequency', __('Frequency', 'autodelivery') ); ?></th><td><?php echo $regular_frequency; ?><?php _e('times', 'autodelivery'); ?></td></tr>
		<?php else: ?>
			<tr><th><?php echo apply_filters( 'wcad_filter_item_single_label_frequency_free', __('Frequency', 'autodelivery') ); ?></th><td><?php echo apply_filters( 'wcad_filter_item_single_value_frequency_free', __('Free cycle', 'autodelivery') ); ?></td></tr>
		<?php endif; ?>
		</table>
	</div>

	<form action="<?php echo USCES_CART_URL; ?>" method="post">

	<?php while( usces_have_skus() ) : ?>
		<div class="skuform">
			<?php if( '' !== usces_the_itemSkuDisp('return') ) : ?>
			<div class="skuname"><?php usces_the_itemSkuDisp(); ?></div>
			<?php endif; ?>

			<?php if( usces_is_options() ) : ?>
			<dl class="item-option">
				<?php while( usces_have_options() ) : ?>
				<dt><?php usces_the_itemOptName(); ?></dt>
				<dd><?php wcad_the_itemOption( usces_getItemOptName(), '' ); ?></dd>
				<?php endwhile; ?>
			</dl>
			<?php endif; ?>

			<?php usces_the_itemGpExp(); ?>

			<div class="field">
				<div class="zaikostatus"><?php _e('stock status', 'usces'); ?> : <?php usces_the_itemZaikoStatus(); ?></div>
				<div class="field_price">
				<?php if( usces_the_itemCprice('return') > 0 ) : ?>
					<span class="field_cprice"><?php usces_the_itemCpriceCr(); ?></span>
				<?php endif; ?>
					<?php wcad_the_itemPriceCr(); ?><?php usces_guid_tax(); ?>
				</div>
			</div>

			<?php if( !usces_have_zaiko() ) : ?>

				<?php if(wcct_get_options('inquiry_link_button')):?>
					<div class="contact-item"><a href="<?php echo wcct_get_inquiry_link_url(); ?>"><i class="fa fa-envelope"></i><?php _e('Inquiries regarding this item' , 'welcart_basic_square'); ?></a></div>
				<?php else: ?>	
				<div class="itemsoldout"><?php echo apply_filters( 'usces_filters_single_sku_zaiko_message', __('At present we cannot deal with this product.','welcart_basic') ); ?></div>
				<?php endif; ?>
				
			<?php else : ?>
			<div class="c-box">
				<span class="quantity"><?php _e('Quantity', 'usces'); ?><?php wcad_the_itemQuant(); ?><?php usces_the_itemSkuUnit(); ?></span>
				<span class="cart-button"><?php wcad_the_itemSkuButton( __('Apply for a regular purchase', 'autodelivery'), 0 ); ?></span>
			</div>
			<?php endif; ?>
			<div class="error_message"><?php usces_singleitem_error_message( $post->ID, usces_the_itemSku('return') ); ?></div>
		</div><!-- .skuform -->
	<?php endwhile; ?>

	<?php echo apply_filters( 'wcad_single_item_multi_sku_after_field', NULL ); ?>
	<?php do_action( 'wcad_action_single_item_inform' ); ?>
	</form>
</div>
<?php
		endif;
	endif;

	$html = ob_get_contents();
	ob_end_clean();

	echo $html;
}


/***********************************************************
* WCEX Auto Delivery + WCEX SKU SELECT
***********************************************************/

add_action( 'welcart_basic_filter_single_item_autodelivery_sku_select', 'welcart_square_filter_single_item_autodelivery_sku_select' );
function welcart_square_filter_single_item_autodelivery_sku_select(){
	global $post, $usces;

	ob_start();
	if( 'regular' == $usces->getItemChargingType( $post->ID ) ) : 
		$regular_unit = get_post_meta( $post->ID, '_wcad_regular_unit', true );
		if( 'day' == $regular_unit ) {
			$regular_unit_name = __('Daily','autodelivery');
		} elseif( 'month' == $regular_unit ) {
			$regular_unit_name = __('Monthly','autodelivery');
		} else {
			$regular_unit_name = '';
		}

		$regular_interval = get_post_meta( $post->ID, '_wcad_regular_interval', true );
		$regular_frequency = get_post_meta( $post->ID, '_wcad_regular_frequency', true );

		if( usces_have_zaiko_anyone( $post->ID ) ) : 
			usces_the_item();
?>
<div id="wc_regular">
	<p class="wcr_tlt"><?php _e('Regular Purchase', 'autodelivery') ?></p>
	<div class="field">
		<table class="autodelivery">
			<tr><th><?php echo apply_filters( 'wcad_filter_item_single_label_interval', __('Interval', 'autodelivery') ); ?></th><td><?php echo $regular_interval; ?><?php echo $regular_unit_name; ?></td></tr>
		<?php if( 1 < (int)$regular_frequency ) : ?>
			<tr><th><?php echo apply_filters( 'wcad_filter_item_single_label_frequency', __('Frequency', 'autodelivery') ); ?></th><td><?php echo $regular_frequency; ?><?php _e('times', 'autodelivery'); ?></td></tr>
		<?php else: ?>
			<tr><th><?php echo apply_filters( 'wcad_filter_item_single_label_frequency_free', __('Frequency', 'autodelivery') ); ?></th><td><?php echo apply_filters( 'wcad_filter_item_single_value_frequency_free', __('Free cycle', 'autodelivery') ); ?></td></tr>
		<?php endif; ?>
		</table>
	</div>

	<form action="<?php echo USCES_CART_URL; ?>" method="post">
		<div class="skuform" id="skuform_regular">

			<?php wcex_auto_delivery_sku_select_form(); ?>

			<?php if( usces_is_options() ) : ?>
			<dl class="item-option">
				<?php while( usces_have_options() ) : ?>
				<dt><?php usces_the_itemOptName(); ?></dt>
				<dd><?php wcad_the_itemOption( usces_getItemOptName(), '' ); ?></dd>
				<?php endwhile; ?>
			</dl>
			<?php endif; ?>

			<?php //usces_the_itemGpExp(); ?>


			<div class="field">
				<div class="zaikostatus"><?php _e('stock status', 'usces'); ?> : <span class="ss_stockstatus_regular"><?php usces_the_itemZaikoStatus(); ?></span></div>
				<div class="field_price">
				<?php if( usces_the_itemCprice('return') > 0 ) : ?>
					<span class="field_cprice ss_cprice_regular"><?php usces_the_itemCpriceCr(); ?></span>
				<?php endif; ?>
					<span class="sell_price ss_price_regular"><?php wcad_the_itemPriceCr(); ?></span><?php usces_guid_tax(); ?>
				</div>
			</div>

			<div id="checkout_box">

				<?php if(wcct_get_options('inquiry_link_button')):?>
					<div class="contact-item inquiry"><a href="<?php echo wcct_get_inquiry_link_url(); ?>"><i class="fa fa-envelope"></i><?php _e('Inquiries regarding this item' , 'welcart_basic_square'); ?></a></div>
				<?php else : ?>
					<div class="itemsoldout"><?php echo apply_filters( 'usces_filters_single_sku_zaiko_message', __('At present we cannot deal with this product.','welcart_basic') ); ?></div>
				<?php endif; ?>
				
				<div class="c-box">
					<span class="quantity"><?php _e('Quantity', 'usces'); ?><?php wcad_the_itemQuant(); ?><?php usces_the_itemSkuUnit(); ?></span>
					<span class="cart-button"><?php wcad_the_itemSkuButton( __('Apply for a regular purchase', 'autodelivery'), 0 ); ?></span>
				</div>
			
			</div><!-- #cheackout_box -->
			<div class="error_message"><?php usces_singleitem_error_message( $post->ID, usces_the_itemSku('return') ); ?></div>
			<div class="wcss_loading"></div>
		</div><!-- .skuform -->

	<?php echo apply_filters( 'wcad_single_item_multi_sku_after_field', NULL ); ?>
	<?php do_action( 'wcad_action_single_item_inform' ); ?>
	</form>
</div>
<?php
		endif;
	endif;

	$html = ob_get_contents();
	ob_end_clean();

	echo $html;
}


/***********************************************************
* Review
***********************************************************/
if ( !function_exists( 'wc_review' ) ) :
function wc_review( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-review-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">

		<div class="review-meta reviewmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'welcart_basic_square' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'welcart_basic_square' ), ' ' );
			?>
		</div><!-- .review-meta .reviewmetadata -->
		
		<?php if ( $comment->comment_approved == '0' ) : ?>
		
			<em><?php _e( 'Thank you for the review. Please wait for a while until it is published.', 'welcart_basic_square' ); ?></em>
			<br />
		
		<?php else: ?>

		<div class="review-author vcard">
			<?php printf( __( '%s <span class="says">says:</span>', 'welcart_basic_square' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .review-author .vcard -->
		<div class="review-body"><?php comment_text(); ?></div>
		
		<?php endif; ?>



	</div><!-- #review-##  -->

	<?php
			break;
	endswitch;
}
endif;


/***********************************************************
* Product Tag
***********************************************************/
function wcct_get_produt_tag() {
	if( !wcct_get_options( 'display_produt_tag' ) )
		return;
	
	$flag = array(); 
	$html = '';
	
	$cats = get_the_category();
	foreach( $cats as $cat ) {
		switch ( $cat->slug ) {
			case 'itemnew':
				$flag['new'] = 1;
				break;
			case 'itemreco':
				$flag['reco'] = 1;
				break;
		}
	}
	
	$html .= '<ul class="cf opt-tag">' . "\n";
		if( isset( $flag['new'] ) ) $html .= '<li class="new">New</li>' . "\n";
		if( isset( $flag['reco'] ) ) $html .= '<li class="recommend">Hot</li>' . "\n";
		if( usces_have_fewstock() ) $html .= '<li class="stock">Low</li>' . "\n";
		if( wcct_has_campaign() ) $html .= '<li class="sale">Sale</li>' . "\n";	
	$html .= '</ul>' . "\n";
	
	return $html;
}
function wcct_produt_tag() {
	echo wcct_get_produt_tag();
}

/***********************************************************
* Product low in stock
***********************************************************/
if( !function_exists( 'usces_have_fewstock' ) ){
	function usces_have_fewstock( $post_id = NULL ){
		global $post, $usces;
		if( NULL == $post_id ) $post_id = $post->ID;
		
		$skus = $usces->get_skus($post_id);
		$res = false;
		foreach($skus as $sku){
			if( 1 === (int)$sku['stock'] ){
				$res = true;
				break;
			}
		}
		return $res;
	}
}

/***********************************************************
* Product Campaign
***********************************************************/
function wcct_has_campaign( $post_id = NULL ){
	global $post, $usces;
	if( NULL == $post_id ) $post_id = $post->ID;
	
	if ( 'Promotionsale' == $usces->options[ 'display_mode' ] && in_category( (int)$usces->options[ 'campaign_category' ], $post_id ) ) {
		$res = true;
	} else {
		$res = false;
	}
	
	return $res;
}

/************************************************************
* Contact Form 7
*************************************************************/
function wcct_get_inquiry_link_url(){
	if( defined('WPCF7_VERSION') ) {
		global $post;
	
		$item_id = $post->ID;
		$sku_code = urlencode( usces_the_itemSku( 'return' ) );
		$url = add_query_arg( array( 'from_item' => $item_id, 'from_sku' => $sku_code ), get_permalink( wcct_get_options( 'inquiry_link' ) ) );
	} else {
		$url = get_permalink( wcct_get_options( 'inquiry_link' ) );
	}
	
	return $url;
}

if( defined('WPCF7_VERSION') ) {
	add_filter('wpcf7_mail_components', 'wcct_mail_components', 10, 3);
	function wcct_mail_components($components, $current_form, $mail_object){
		global $usces;
		
		$post_id =  isset($_GET['from_item']) ? $_GET['from_item']: '';
		if( strlen($post_id) > 0 ){
			$itemname = $usces->getItemName($post_id);
			$skucode = isset($_GET['from_sku']) ? $_GET['from_sku']: '';
			$skuname = ( strlen($skucode) > 0 ) ? $usces->getItemSkuDisp($post_id, $skucode): '';
	
			$body = $components['body'];
			
			if( strlen($itemname) > 0 && strlen($skuname) > 0 ){
				$components['body'] = __( 'item name', 'usces' ) . '：'.$itemname. ' '. $skuname. "\n". $body;
			}elseif( strlen($itemname) > 0 ){
				$components['body'] = __( 'item name', 'usces' ) . '：'.$itemname. "\n". $body;
			}
		}
		return $components;
	}
}

/************************************************************
* Continue shopping button
*************************************************************/
add_filter( 'usces_filter_cart_prebutton', 'wcct_cart_prebutton' );
function wcct_cart_prebutton( $link ){
	if( wcct_get_options( 'continue_shopping_button' ) ) {
		$url = wcct_get_options( 'continue_shopping_url' );
		if( empty( $url ) ) $url = esc_url( home_url( '/' ) );
		
		$link = ' onclick="location.href=\'' . $url . '\'"';
	}
	
	return $link;
}

/************************************************************
* Redirect review
*************************************************************/
add_action( 'usces_action_login_page_inform', 'wcct_login_inform_referer' );
function wcct_login_inform_referer(){
	if( isset( $_REQUEST['login_ref'] ) && !empty( $_REQUEST['login_ref'] ) ){
		echo '<input type="hidden" name="login_ref" value="' . esc_url(urldecode( $_REQUEST['login_ref'] )) . '" >'."\n";
	}
}
add_action( 'usces_action_after_login', 'wcct_after_login_redirect' );
function wcct_after_login_redirect(){
	if( isset( $_REQUEST['login_ref'] ) && !empty( $_REQUEST['login_ref'] ) ){
		wp_redirect(esc_url($_REQUEST['login_ref'].'#wc_reviews'));
		exit;
	}
}

/************************************************************
* Change the effect of the image
*************************************************************/
function wcct_item_image_effect_scripts() {

	$stylesheet_dir = get_stylesheet_directory_uri();
	
	wp_enqueue_style( 'slick-style', $stylesheet_dir . '/css/slick.css', array(), '1.0' );
	wp_enqueue_style( 'slick-theme-style', $stylesheet_dir . '/css/slick-theme.css', array(), '1.0' );
	wp_enqueue_script( 'slick-js', $stylesheet_dir .'/js/slick.min.js', array( 'jquery' ), '1.0');
	wp_enqueue_script( 'wcct-slick-js', $stylesheet_dir .'/js/wcct-slick.js', array( 'slick-js' ), '1.0');
}
add_action( 'wp_enqueue_scripts', 'wcct_item_image_effect_scripts' );

/************************************************************
* itemQuant_select
*************************************************************/
function wcct_the_itemQuant_select( $max = null ) {
	global $post, $usces;
	if( empty( $max ) )
		$max = 50;
	$zaiko = usces_the_itemZaikoNum('return');
	$sku_enc = urlencode( usces_the_itemSku('return') );
	$restriction = $usces->getItemRestriction($post->ID);
	
	if( ('' != $zaiko && 0 < $zaiko && '' != $restriction && $zaiko > $restriction) || ( '' == $zaiko && '' != $restriction) ) {
		$max = $restriction;
	}elseif( ( '' != $zaiko && 0 < $zaiko && '' != $restriction && $zaiko < $restriction ) || ( '' != $zaiko && '' == $restriction) ) {
		$max = $zaiko;
	}
	
	$select = '<select name ="quant[' . $post->ID . '][' . $sku_enc . ']" id ="quant[' . $post ->ID . '][' . $sku_enc . ']" class="skuquantity" onkeydown="if(event.keyCode == 13) {return false;}">' . "\n";
		for($i =1; $i<=$max; $i++) {
			$select .= '<option value="' . $i . '">' . $i . '</option>' . "\n";
		}
	$select .= '</select>';
	
	echo $select;
}

/************************************************************
* Change Archive Title
*************************************************************/
function wcct_archive_title( $title ){
	if( is_category() ) {
		$title = single_cat_title( '', false );
	}
	
	return $title;
}
add_filter( 'get_the_archive_title', 'wcct_archive_title' );


function welcart_search_page() {
	global $usces;
	if( 'search_item' == $usces->page ) return true;
}

/************************************************************
* pre_get_posts 
*************************************************************/
function welcart_square_query( $query ) {
	if( is_admin() || !$query->is_main_query() ) {
		return;
	}

	if( 'posts' == get_option( 'show_on_front' ) && ( $query->is_home() || $query->is_front_page() ) ) {
		$h_itemcat = get_option( 'welcart_basic_h_itemcat' );
		$h_itemnum = get_option( 'welcart_basic_h_itemnum' );
		$h_itemsort = wcct_get_options( 'display_sort' );
		$info_disp = wcct_get_options( 'display_info' );
		$info_cat = wcct_get_options( 'info_cat' );
		$info_num = $info_disp ? wcct_get_options( 'info_num' ) : 0;
		if( empty($h_itemcat) ) $h_itemcat = 'itemreco';
		if( empty($h_itemnum) ) $h_itemnum = '10';
		$posts_per_page = $h_itemnum;
		
		//get informations
		if( $info_disp ){
			$infocat = get_category_by_slug($info_cat);
			$info_posts_args = array(
						'cat'			=> $infocat->term_id,
						'posts_per_page'	=> $info_num,
						'post_type'			=> 'post',
						);
			switch( $h_itemsort ){
				case 1:
					$info_posts_args['order'] = 'DESC';
					$info_posts_args['orderby'] = 'date';
					break;
				case 2:
					$info_posts_args['orderby'] = 'rand';
					break;
				default:
					$info_posts_args['order'] = 'DESC';
					$info_posts_args['orderby'] = 'ID';
					break;
			}
			$info_posts = new WP_Query( $info_posts_args );
			$include_info = array();
			foreach( $info_posts->posts as $infopost ){
				$include_info[] = $infopost->ID;
			}
			$posts_per_page += $info_num;
		}
		
		//get products
		$itemcat = get_category_by_slug($h_itemcat); 
		$item_posts_args = array(
					'cat'			=> $itemcat->term_id,
					'posts_per_page'	=> $h_itemnum,
					'post_type'			=> 'post',
					);
		switch( $h_itemsort ){
			case 1:
				$item_posts_args['order'] = 'DESC';
				$item_posts_args['orderby'] = 'date';
				break;
			case 2:
				$item_posts_args['orderby'] = 'rand';
				break;
			default:
				$item_posts_args['order'] = 'DESC';
				$item_posts_args['orderby'] = 'ID';
				break;
		}
		$item_posts = new WP_Query( $item_posts_args );
		foreach( $item_posts->posts as $itempost ){
			$include_info[] = $itempost->ID;
		}
		
		//get total posts
		$query->set( 'post__in', $include_info );
		$query->set( 'posts_per_page', $posts_per_page );
		
		switch( $h_itemsort ){
			case 1:
				$query->set( 'order', 'DESC' );
				$query->set( 'orderby', 'date' );
				break;
			case 2:
				$query->set( 'orderby', 'rand' );
				break;
			default:
				$query->set( 'order', 'DESC' );
				$query->set( 'orderby', 'ID' );
				break;
		}
		return;
	}
}

add_action( 'after_setup_theme', 'remove_basic_pre_get_posts');
function remove_basic_pre_get_posts(){
	remove_action( 'pre_get_posts', 'welcart_basic_posts_per_page' );
	add_action( 'pre_get_posts', 'welcart_square_query', 5 );
}

/************************************************************
* widget cart total quant 
*************************************************************/
add_filter( 'widgetcart_get_cart_row', 'wcct_widgetcart_total_quant', 10, 2 );
function wcct_widgetcart_total_quant( $html, $cart ){
	global $usces;
	$quant = $usces->get_total_quantity($cart);
	
	$html .='
	<script type="text/javascript">
		jQuery("#widgetcart-total-quant").html("' . $quant . '");
	</script>';
	
	return $html;
}

/************************************************************
* Welcart Basic Widget
*************************************************************/
add_filter( 'welcart_basic_filter_item_post', 'wcct_filter_item_post', 10 );
function wcct_filter_item_post( $list ){
	$list = '';
	
	$list .= '<article id="post-' . get_the_ID() . '">' . "\n";
		$list .= '<a href="' . get_permalink( get_the_ID() ) .'">' . "\n";
			$list .= '<div class="itemimg">' . "\n";
				$list .= usces_the_itemImage( 0, 300, 300, '', 'return' ) . "\n";
				if( wcct_get_options( 'display_soldout' ) && !usces_have_zaiko_anyone() ) {
					$list .= '<div class="itemsoldout">' . "\n";
						$list .= '<div class="inner">' . "\n";
							$list .= __( 'SOLD OUT', 'welcart_basic_carina' ) . "\n";
						$list .= '</div>' . "\n";
					$list .= '</div>' . "\n";
				}
			$list .= '</div>' . "\n";
			$list .= wcct_get_produt_tag() . "\n";
			$list .= '<div class="item-info-wrap"><div class="inner">' . "\n";
				$list .= '<div class="itemname">' . usces_the_itemName( 'return' ) . '</div>' . "\n";
				$list .= '<div class="itemprice">' . usces_crform( usces_the_firstPrice( 'return' ), true, false, 'return' ) . usces_guid_tax( 'return' ) . '</div>' . "\n";
				$list .= get_welcart_basic_campaign_message() . "\n";
			$list .= '</div></div>' . "\n";
		$list .= '</a>' . "\n";
	$list .= '</article>';
	
	return $list;
}

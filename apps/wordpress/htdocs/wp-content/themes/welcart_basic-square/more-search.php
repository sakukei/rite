<?php
/**
 * Ajax More Search
 *
 * @package WordPress
 * https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/wpdb_Class
 */

require_once '../../../wp-config.php';

$now_post_num = $_POST['nowPostNumS'];
$get_post_num = $_POST['getPostNumS'];

$next_now_post_num = $now_post_num + $get_post_num;
$next_get_post_num = $get_post_num + $get_post_num;

$sql = "SELECT
        $wpdb->posts.ID
    FROM
        $wpdb->posts
    WHERE
        $wpdb->posts.post_type = 'post' AND $wpdb->posts.post_status = 'publish'
    ORDER BY
        $wpdb->posts.post_date DESC
    LIMIT $now_post_num, $get_post_num";

$results = $wpdb->get_results( $sql );

$sql = "SELECT
        $wpdb->posts.ID
    FROM
        $wpdb->posts
    WHERE
        $wpdb->posts.post_type = 'post' AND $wpdb->posts.post_status = 'publish'
    ORDER BY
        $wpdb->posts.post_date DESC
    LIMIT $next_now_post_num, $next_get_post_num";

$next_results = $wpdb->get_results( $sql );


$no_data_flg = 0;
if ( count( $results ) < $get_post_num || ! count( $next_results ) ) {
	$no_data_flg = 1;
}

$html     = '';
$post__in = array();

foreach ( $results as $result ) {
	$post__in[] = $result->ID;
}

$ajax_query = new WP_Query( array( 'post__in' => $post__in ) );
while ( $ajax_query->have_posts() ) {
	$ajax_query->the_post();
	$html .= '<article id="post-' . esc_html( get_the_ID() ) . '" class="grid-item">';
	$html .= '<div class="inner" data-sr-id="11" style="visibility: visible; -webkit-transform: scale(1); opacity: 1;transform: scale(1); opacity: 1;-webkit-transition: -webkit-transform 0.8s cubic-bezier(0.6, 0.2, 0.1, 1) 0s, opacity 0.8s cubic-bezier(0.6, 0.2, 0.1, 1) 0s; transition: transform 0.8s cubic-bezier(0.6, 0.2, 0.1, 1) 0s, opacity 0.8s cubic-bezier(0.6, 0.2, 0.1, 1) 0s;">';
	$html .= '<div class="itemimg">';
	$html .= '<a href="' . esc_url( get_permalink( $result_post->ID ) ) . '">';
	$html .= usces_the_itemImage( 0, 300, 300, $post, 'return' );
	if ( wcct_get_options( 'display_soldout' ) && ! usces_have_zaiko_anyone() ) {
		$html .= '<div class="itemsoldout">';
		$html .= '<div class="inner" style="visibility: visible; -webkit-transform: scale(1); opacity: 1;transform: scale(1); opacity: 1;-webkit-transition: -webkit-transform 0.8s cubic-bezier(0.6, 0.2, 0.1, 1) 0s, opacity 0.8s cubic-bezier(0.6, 0.2, 0.1, 1) 0s; transition: transform 0.8s cubic-bezier(0.6, 0.2, 0.1, 1) 0s, opacity 0.8s cubic-bezier(0.6, 0.2, 0.1, 1) 0s;">';
		$html .= __( 'SOLD OUT', 'welcart_basic_square' );
		if ( wcct_get_options( 'display_inquiry' ) ) {
			ob_start();
			wcct_options( 'display_inquiry_text' );
			$error_message = ob_get_contents();
			ob_end_clean();
			$html .= '<span class="text">' . $error_message . '</span>';
		}
		$html .= '</div><!-- /inner -->';
		$html .= '</div><!-- /itemsoldout -->';
	}
	$html .= '</a>';
	$html .= '</div><!-- /itemimg -->';
	ob_start();
	wcct_produt_tag();
	welcart_basic_campaign_message();
	$html .= ob_get_contents();
	ob_end_clean();
	$html .= '<div class="item-info-wrap">';
	$html .= '<div class="itemname">';
	$html .= '<a href="' . esc_url( get_permalink( $result_post->ID ) ) . '" rel="bookmark">';
	$html .= usces_the_itemName( 'return' );
	$html .= '</a>';
	$html .= '</div><!-- /itemname -->';
	$html .= usces_crform( usces_the_firstPrice( 'return' ), true, false, 'return' ) . usces_guid_tax( 'return' );
	$html .= '</div><!-- /item-info-wrap -->';
	$html .= '</div><!-- /inner -->';
	$html .= '</article>';
}
wp_reset_postdata();

$return_obj = array(
	'noDataFlg' => $no_data_flg,
	'html'      => $html,
);
$return_obj = wp_json_encode( $return_obj );

echo $return_obj;

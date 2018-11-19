<?php
/**
 * Ajax
 *
 * @package WordPress
 * https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/wpdb_Class
 */

require_once '../../../wp-config.php';

$now_post_num = $_POST['nowPostNum'];
$get_post_num = $_POST['getPostNum'];

$next_now_post_num = $now_post_num + $get_post_num;
$next_get_post_num = $get_post_num + $get_post_num;

$sql = "SELECT
        $wpdb->posts.ID
    FROM
        $wpdb->posts
    WHERE
        $wpdb->posts.post_type = 'top_pickup' AND $wpdb->posts.post_status = 'publish'
    ORDER BY
        $wpdb->posts.post_date DESC
    LIMIT $now_post_num, $get_post_num";

$results = $wpdb->get_results( $sql );

$sql = "SELECT
        $wpdb->posts.ID
    FROM
        $wpdb->posts
    WHERE
        $wpdb->posts.post_type = 'top_pickup' AND $wpdb->posts.post_status = 'publish'
    ORDER BY
        $wpdb->posts.post_date DESC
    LIMIT $next_now_post_num, $next_get_post_num";

$next_results = $wpdb->get_results( $sql );


$no_data_flg = 0;
if ( count( $results ) < $get_post_num || ! count( $next_results ) ) {
	$no_data_flg = 1;
}

$html = '';

foreach ( $results as $result ) {
	$result_post        = get_post( $result->ID );
	$result_post_author = get_userdata( $result_post->post_author );

	$html .= '<article id="post-' . esc_html( $result_post->ID ) . '" class="post pickup-article">';
	$html .= '<a href="' . esc_url( get_permalink( $result_post->ID ) ) . '">';
	$html .= '<div class="pickup">';
	$html .= '<div class="pickup-img">';
	$html .= get_the_post_thumbnail( $result_post->ID, 'full' );
	$html .= '</div>';
	$html .= '<div class="pickup-content">';
	$html .= '<div class="pickup-content-inner">';
	$html .= '<p class="pickup-content-title">' . $result_post->post_title . '</p>';
	$html .= '<div class="pickup-content-column">';
	$html .= '<p class="pickup-content-lead">' . wp_trim_words( $result_post->post_content, 50, '...' ) . '</p>';
	$html .= '<div class="pickup-contributor">';
	$html .= '<div class="pickup-contributor-column">';
	$html .= '<div class="pickup-icon contributor-icon">';
	$html .= get_avatar( $result_post->post_author, 30 );
	$html .= '</div>';
	$html .= '<div class="pickup-name">';
	$html .= $result_post_author->display_name;
	$html .= '</div>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= '</a>';
	$html .= '</article>';

}

$return_obj = array(
	'noDataFlg' => $no_data_flg,
	'html'      => $html,
);
$return_obj = wp_json_encode( $return_obj );

echo $return_obj;

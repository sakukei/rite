<?php
/**
 * @package Welcart
 * @subpackage Welcart_Basic
 */

global $usces; ?>

<div class="sidebar widget-area" role="complementary">

<?php if ( ! dynamic_sidebar( 'side-widget-area2' ) ) {

		//Default Welcart Recommend Widget
		$args = array(
			'before_widget' => '<section id="welcart_featured-3" class="widget widget_welcart_featured">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="widget_title">',
			'after_title' => '</h3>',
		);
		global $wp_filter;
		if( array_key_exists('usces_filter_featured_widget', $wp_filter) ){
			$num = 5;
		}else{
			$num = 3;
		}
		$Welcart_featured =array(
			'title' => __('Items recommended','usces'),
			'icon' => 1,
			'num' => $num
		);
		the_widget( 'Welcart_featured', $Welcart_featured, $args );	

	
} ?>

</div><!-- .sidebar -->

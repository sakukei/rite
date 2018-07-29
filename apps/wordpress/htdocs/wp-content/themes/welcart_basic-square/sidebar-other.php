<?php
/**
 * @package Welcart
 * @subpackage Welcart_Basic
 */

global $usces; ?>

<div class="sidebar widget-area" role="complementary">

<?php if ( ! dynamic_sidebar( 'side-widget-area3' ) ) {


	//Default Recent_Posts Widget
	$args = array(
		'before_widget' => '<div id="wcct_recent-posts-3" class="widget widget_recent_entries">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget_title">',
		'after_title' => '</h3>',
	);
	the_widget( 'WP_Widget_Recent_Posts', '', $args );	

	$args = array(
		'before_title' => '<h3 class="widget_title">',
		'after_title' => '</h3>',
	);
	the_widget( 'WP_Widget_Archives', '', $args );

	$args = array(
		'before_title' => '<h3 class="widget_title">',
		'after_title' => '</h3>',
	);
	the_widget( 'WP_Widget_Recent_Comments', '', $args );
	
	//Default Welcart Calendar Widget
	$args = array(
		'before_widget' => '<div id="welcart_calendar-3" class="widget widget_welcart_calendar">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget_title">',
		'after_title' => '</h3>',
	);

	
} ?>

</div><!-- .sidebar -->
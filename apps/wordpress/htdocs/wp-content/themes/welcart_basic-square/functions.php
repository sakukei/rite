<?php

if ( !defined('USCES_VERSION') ) return;

/***********************************************************
* includes
***********************************************************/
require( dirname( __FILE__ ) . '/inc/theme-customizer.php' );
require( get_stylesheet_directory() . '/inc/front-customized.php' );
require( get_stylesheet_directory() . '/inc/term-customized.php' );

/***********************************************************
* welcart_setup
***********************************************************/
function wcct_setup() {
	load_child_theme_textdomain( 'welcart_basic_square', get_stylesheet_directory() . '/languages' );

	register_default_headers( array(
		'wcct-default'	=> array(
			'url'			=> '%2$s/images/image-top.jpg',
			'thumbnail_url'	=> '%2$s/images/image-top.jpg',
		)
	) );

	add_theme_support('post-thumbnails');

	add_theme_support( 'custom-background', array(
		'default-color' => 'fff',
		'default-image' => get_stylesheet_directory_uri(). '/images/square-bg.gif',
	) );
}
add_action( 'after_setup_theme', 'wcct_setup' );

/***********************************************************
* Custom Header
***********************************************************/
function wcct_custom_header_args( $array ) {
	$array['default-image']	= get_stylesheet_directory_uri(). '/images/image-top.jpg';
	$array['width']			= '850';
	$array['height']		= '400';

	return $array;
}
add_filter( 'welcart_basic_custom_header_args', 'wcct_custom_header_args' );

/***********************************************************
* Admin css
***********************************************************/
function wcct_admin_enqueue( $hook ){
	if( 'widgets.php' == $hook ){
		wp_enqueue_style( 'wcct_admin_style', get_stylesheet_directory_uri() . '/css/admin.css', array( 'basic_admin_style' ) );
	}
}
add_action( 'admin_enqueue_scripts', 'wcct_admin_enqueue' );

/***********************************************************
* Theme Version
***********************************************************/
function wcct_version(){
	$theme		= wp_get_theme( 'welcart_basic-square' );
	$theme_ver	= !empty($theme) ? $theme->get('Version') : '0';
	$theme_name	= !empty($theme) ? $theme->get('Name') : '';
	echo "<!-- {$theme_name} : v{$theme_ver} -->\n";
}
add_action( 'wp_footer', 'wcct_version', 11 );

/***********************************************************
* widget-area
***********************************************************/

function wcct_widgets_init() {

	unregister_sidebar( 'left-widget-area' );
	unregister_sidebar( 'center-widget-area' );
	unregister_sidebar( 'right-widget-area' );

	register_sidebar(array(
		'name'			=> __( 'Main sidebar', 'welcart_basic_square' ),
		'id'			=> 'side-widget-area1',
		'description'	=> __( 'Widget area of common', 'welcart_basic_square' ),
		'before_widget'	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title'	=> '<h3 class="widget_title">',
		'after_title'	=> '</h3>',
	));

	register_sidebar(array(
		'name'			=> __( 'Sub sidebar (Item Detail Page)', 'welcart_basic_square' ),
		'id'			=> 'side-widget-area2',
		'description'	=> __( 'Widget area of product detail page', 'welcart_basic_square' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h3 class="widget_title">',
		'after_title'	=> '</h3>',
	));

	register_sidebar(array(
		'name'			=> __( 'Sub sidebar (Other Page)', 'welcart_basic_square' ),
		'id'			=> 'side-widget-area3',
		'description'	=> __( 'Widget area of posts and pages', 'welcart_basic' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h3 class="widget_title">',
		'after_title'	=> '</h3>',
	));

}
add_action( 'widgets_init', 'wcct_widgets_init', 11 );

/***********************************************************
* wp_enqueue_scripts
***********************************************************/
function wcct_enqueue_styles() {
	global $usces, $is_IE, $is_safari;

	$template_dir = get_template_directory_uri();

	wp_enqueue_style( 'parent-style', $template_dir . '/style.css' );
	wp_enqueue_style( 'parent-welcart-style', $template_dir . '/usces_cart.css', array(), '1.0' );

	if( defined( 'WCEX_MSA_VERSION' ) ) {
		wp_enqueue_style( 'parent-msa', $template_dir . '/wcex_multi_shipping.css', array('msa_style'), WCEX_MSA_VERSION, false );
	}
	if( defined( 'WCEX_ORDER_LIST_WIDGET' ) ) {
		wp_enqueue_style( 'parent-olwidget', $template_dir . '/wcex_olwidget.css', array(), '1.0');
	}
	if( defined( 'WCEX_WIDGET_CART' ) ) {
		wp_enqueue_style( 'parent-widget_cart', $template_dir . '/wcex_widget_cart.css', array(), '1.0');
	}
	if( defined( 'WCEX_SLIDE_SHOWCASE' ) ) {
		wp_enqueue_style( 'parent-slide_showcase', $template_dir . '/slide_showcase.css', array(), '1.0');
	}
	if( defined( 'WCEX_AUTO_DELIVERY' ) ) {
		wp_enqueue_style( 'parent-auto_delivery', $template_dir . '/auto_delivery.css', array(), '1.0');
	}
	if( defined( 'WCEX_SKU_SELECT' ) ) {
		wp_enqueue_style( 'parent-sku_select', $template_dir . '/wcex_sku_select.css', array(), '1.0');
	}

	if( defined('WCEX_POPLINK') && welcart_basic_is_poplink_page() ) {
		wp_enqueue_style( 'wcct_poplink', get_stylesheet_directory_uri() . '/css/poplink.css', array('wc_basic_poplink'), '1.0' );
	}

	if($is_IE) {
		wp_enqueue_style( 'wc_ie', get_stylesheet_directory_uri() . '/css/ie.css', array('wc-basic-ie'), '1.0' );
	}
	wp_enqueue_script( 'scrollreveal', get_stylesheet_directory_uri() . '/js/scrollreveal.js', array(), '1.0' );
	wp_enqueue_script( 'wcct_scrollreveal', get_stylesheet_directory_uri() . '/js/wcct_scrollreveal.js', array(), '1.0' );
	wp_enqueue_script( 'masonry_pkgd', get_stylesheet_directory_uri() . '/js/masonry.pkgd.min.js', array(), '1.0' );
	wp_enqueue_script( 'wcct_masonry', get_stylesheet_directory_uri() . '/js/wcct-masonry.js', array(), '1.0' );

	wp_enqueue_script( 'wcct-menu', get_stylesheet_directory_uri() . '/js/wcct-menu.js', array(), '1.0' );
	wp_enqueue_script( 'archiveLayout', get_stylesheet_directory_uri() . '/js/archiveLayout.js', array(), '1.0' );
	wp_enqueue_script( 'my_script', get_stylesheet_directory_uri() . '/js/script.js', array( 'jquery' ), '1.0', true );
  wp_enqueue_script( 'bundle', get_stylesheet_directory_uri() . '/js/bundle.js', array(), '1.0', true );

}
add_action( 'wp_enqueue_scripts', 'wcct_enqueue_styles' , 9 );

/***********************************************************
* excerpt
***********************************************************/
remove_filter( 'the_excerpt', 'wpautop' );

function wcct_the_excerpt( $postContent ) {
	if( is_home() || is_front_page() ) {
		$postContent = wp_trim_words( $postContent, 100 );
	}

	return $postContent;
}
add_filter( 'the_excerpt', 'wcct_the_excerpt' );

function wcct_excerpt_more( $more ) {
	return '…';
}
add_filter( 'excerpt_more', 'wcct_excerpt_more' );



/***********************************************************
 * 追加
 ***********************************************************/

// カスタム投稿タイプ - ピックアップ記事 -
function cptui_register_my_cpts_top_pickup() {

    /**
     * Post Type: top_pickup.
     */

    $labels = array(
        "name" => __( "top_pickup", "" ),
        "singular_name" => __( "top_pickup", "" ),
    );

    $args = array(
        "label" => __( "top_pickup", "" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => false,
        "rest_base" => "",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array( "slug" => "top_pickup", "with_front" => true ),
        "query_var" => true,
        "supports" => array( "title", "editor", "thumbnail" ),
        "yarpp_support" => true,
    );

    register_post_type( "top_pickup", $args );
}

add_action( 'init', 'cptui_register_my_cpts_top_pickup' );

// カスタム投稿タイプ - メイン記事 -
function cptui_register_my_cpts_top_main() {

    /**
     * Post Type: top_main.
     */

    $labels = array(
        "name" => __( "top_main", "" ),
        "singular_name" => __( "top_main", "" ),
    );

    $args = array(
        "label" => __( "top_main", "" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => false,
        "rest_base" => "",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array( "slug" => "top_main", "with_front" => true ),
        "query_var" => true,
        "supports" => array( "title", "editor", "thumbnail" ),
        "yarpp_support" => true,
    );

    register_post_type( "top_main", $args );
}

add_action( 'init', 'cptui_register_my_cpts_top_main' );

// Gravator
function validate_gravatar($email) {
    // 使われる URL を作成しヘッダーをテスト
    $hash = md5($email);
    $uri = 'http://www.gravatar.com/avatar/' . $hash . '?d=404';
    $headers = @get_headers($uri);
    if (!preg_match("|200|", $headers[0])) {
        $has_valid_avatar = FALSE;
    } else {
        $has_valid_avatar = TRUE;
    }
    return $has_valid_avatar;
}

// カスタム投稿タイプに通常の投稿と同じカテゴリーとタグの設定
function my_main_query( $query ) {
    if ( is_admin() || ! $query->is_main_query() )
        return;

    if ( $query->is_category() || $query->is_tag() ) {
        $query->set( 'post_type', array( 'post', 'top_main', 'top_pickup' ) );
        return;
    }
}
add_action( 'pre_get_posts', 'my_main_query' );

// YARPPのwidget.cssを削除
add_action('wp_print_styles','crunchify_dequeue_header_styles');
function crunchify_dequeue_header_styles()
{
    wp_dequeue_style('yarppWidgetCss');
}

// YARPPのrelated.cssを削除
add_action('get_footer','crunchify_dequeue_footer_styles');
function crunchify_dequeue_footer_styles()
{
    wp_dequeue_style('yarppRelatedCss');
}

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

//カテゴリ名を取得する関数を登録
add_action( 'rest_api_init', 'register_category_name' );

function register_category_name() {
//register_rest_field関数を用いget_category_name関数からカテゴリ名を取得し、追加する
  register_rest_field( 'post',
    'category_name',
    array(
      'get_callback'    => 'get_category_name'
    )
  );
}

//$objectは現在の投稿の詳細データが入る
function get_category_name( $object ) {
  $category = get_the_category($object[ 'id' ]);
  for ($i = 0; $i < count($category); ++$i) {
    $cat_name[$i] = $category[$i]->cat_name;
  }
  return $cat_name;
}

//タグ名を取得する関数を登録
add_action( 'rest_api_init', 'register_tag_name' );

function register_tag_name() {
//register_rest_field関数を用いget_category_name関数からカテゴリ名を取得し、追加する
  register_rest_field( 'post',
    'tag_name',
    array(
      'get_callback'    => 'get_tag_name'
    )
  );
}

//$objectは現在の投稿の詳細データが入る
function get_tag_name( $object ) {
  $tag = get_the_tags($object[ 'id' ]);
  for ($i = 0; $i < count($tag); ++$i) {
    if(strpos($tag[$i]->name,'¥') === false) {
      $tag_name[$i] = $tag[$i]->name;
    }
  }
  return $tag_name;
}

//値段を取得する関数を登録
add_action( 'rest_api_init', 'register_price' );

function register_price() {
  register_rest_field( 'post',
    'tag_price',
    array(
      'get_callback'    => 'get_price'
    )
  );
}

//「¥」が付いていたときprice判定
function get_price( $object ) {
  $tag = get_the_tags($object[ 'id' ]);
  for ($i = 0; $i < count($tag); ++$i) {
    if(strpos($tag[$i]->name,'¥') !== false) {
      return $tag[$i]->name;
    }
  }
}

// SKUの選択情報を追加
add_action( 'rest_api_init', 'register_select_sku' );

function register_select_sku() {
  register_rest_field( 'post',
    'select_sku_info',
    array(
      'get_callback'    => 'get_select_sku'
    )
  );
}

function get_select_sku( $object ) {
  $sku = get_post_meta($object[ 'id' ], '_select_sku', true);
  if ( ! empty( $sku ) ) {
    return $sku;
  }

  return null;
}

// SKU情報を追加
add_action( 'rest_api_init', 'register_sku' );

function register_sku() {
  register_rest_field( 'post',
    'sku_info',
    array(
      'get_callback'    => 'get_sku'
    )
  );
}

function get_sku( $object ) {
  $sku = get_post_meta($object[ 'id' ], '_isku_', false);
  if ( ! empty( $sku ) ) {
    return $sku;
  }

  return null;
}

// SKU名
add_action( 'rest_api_init', 'register_sku_name' );

function register_sku_name() {
  register_rest_field( 'post',
    'sku_name',
    array(
      'get_callback'    => 'get_sku_name'
    )
  );
}

function get_sku_name( $object ) {
  $product = get_post_meta($object[ 'id' ], '_itemName', true);
  if ( ! empty( $product ) ) {
    return $product;
  }

  return null;
}

// 記事と商品紐づけmeta情報
add_action( 'rest_api_init', 'register_influncer_product' );

function register_influncer_product() {
  register_rest_field( 'post',
    'influncer_product',
    array(
      'get_callback'    => 'get_influncer_product'
    )
  );
}

function get_influncer_product( $object ) {
  $product = get_post_meta($object[ 'id' ], 'influncer_product', true);
  if ( ! empty( $product ) ) {
    return $product;
  }

  return null;
}

// 購入情報に紐付けるインフルエンサー入力情報
add_action( 'rest_api_init', 'register_influncer_input' );

function register_influncer_input() {
  register_rest_field( 'post',
    'influncer_input',
    array(
      'get_callback'    => 'get_product_input_option'
    )
  );
}

function get_product_input_option( $object ) {
  $product = get_post_meta($object[ 'id' ], '_iopt_', true);
  if ( ! empty( $product ) ) {
    return $product;
  }

  return null;
}

// カテゴリー画像、インスタグラムリンク、ブランドのスラッグ
add_action( 'rest_api_init', 'register_category_image' );

function register_category_image() {
  register_rest_field( 'category',
    'image',
    array(
      'get_callback'    => 'get_category_image'
    )
  );
  register_rest_field( 'category',
    'instagram',
    array(
      'get_callback'    => 'get_category_instagram'
    )
  );

  register_rest_field( 'category',
    'brand_slug',
    array(
      'get_callback'    => 'get_category_brand_slug'
    )
  );

  register_rest_field( 'category',
    'brand_business_law',
    array(
      'get_callback'    => 'get_category_brand_business_law'
    )
  );
}

function get_category_image( $cat ) {
  $image_path = get_term_meta($cat[ 'id' ], 'wcct-tag-thumbnail-url', true);
  if (! empty($image_path)) {
    return $image_path;
  }
  return null;
}

function get_category_instagram( $cat ) {
  $url = get_term_meta($cat[ 'id' ], 'instagram', true);
  if (! empty($url)) {
    return $url;
  }
  return null;
}

function get_category_brand_slug( $cat ) {
  $url = get_term_meta($cat[ 'id' ], 'brand-slug', true);
  if (! empty($url)) {
    return $url;
  }
  return null;
}

function get_category_brand_business_law( $cat ) {
  $url = get_term_meta($cat[ 'id' ], 'business-law-notation', true);
  if (! empty($url)) {
    return $url;
  }
  return null;
}

// ユーザーとカテゴリーの紐づけ
// ユーザーAPIにカテゴリー情報を付加する
add_action( 'rest_api_init', 'register_user_category' );

function register_user_category() {
  register_rest_field( 'user',
    'category',
    array(
      'get_callback'    => 'get_user_cagtegory'
    )
  );
}

function get_user_cagtegory( $user ) {
  $influncer_name = get_user_meta($user[ 'id' ], 'influncerName', true);
  if (empty($influncer_name)) {
    return null;
  }
  $cat_id = get_cat_ID( $influncer_name );
  $cat = get_category($cat_id, ARRAY_A);
  $cat['image'] = get_term_meta($cat_id, 'wcct-tag-thumbnail-url', true);;
  $cat['instagram'] = get_term_meta($cat_id, 'instagram', true);;
  return $cat;
}

add_action('rest_api_init', 'wp_add_thumbnail_to_JSON');
function wp_add_thumbnail_to_JSON() {
//Add featured image
  register_rest_field('post',
    'featured_image', //NAME OF THE NEW FIELD TO BE ADDED - you can call this anything
    array(
      'get_callback' => 'wp_get_image',
      'update_callback' => null,
      'schema' => null,
    )
  );
}

function wp_get_image($object, $field_name, $request) {
  $feat_img_array = wp_get_attachment_image_src($object['featured_media'], 'large', true);
  return [
    'src' => $feat_img_array[0],
    'width' => $feat_img_array[1],
    'height' => $feat_img_array[2],
  ];
}

// 関連記事情報
add_action( 'rest_api_init', 'register_related_posts' );

function register_related_posts() {
  register_rest_field( 'post',
    'related_posts',
    array(
      'get_callback'    => 'get_related_posts'
    )
  );
}

function get_related_posts( $object ) {
  global $yarpp;
  $posts = array();
  foreach ($yarpp->get_related($object['id']) as $related ) {
    $posts[] = $related->ID;
  }

  return $posts;
}

<?php
/**
 * @package Welcart
 * @subpackage Welcart_Basic
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>"/>
  <meta name="viewport" content="width=device-width, user-scalable=no">
  <meta name="format-detection" content="telephone=no"/>

  <link href='https://fonts.googleapis.com/css?family=Lora:400,700' rel='stylesheet' type='text/css'>

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
$opt = ' class="display-desc"';
?>

<div class="p-main" <?php if (wcct_get_options('display_description')) {
  echo $opt;
} ?>>

  <?php if (wcct_get_options('display_description')): ?>
    <p class="szite-description">
      <?php bloginfo('description'); ?>
    </p>
  <?php endif; ?>

  <header class="l-header p-header">

    <div class="p-header-inner">

      <div class="l-header-column p-header-column">

        <div class="p-header-logo"><a href="<?php echo esc_url(home_url('/')); ?>"><img
              src="<?php echo get_stylesheet_directory_uri(); ?>/images/header-logo.png"
              alt="rite"></a>
        </div>

        <div class="p-header-nav">
          <div class="l-header-column p-header-nav-column">
            <div class="p-header-icon p-header-search">
              <!--<input id="p-header-nav-input" type="checkbox" class="p-header-nav-unshown">-->
              <!--<label id="p-header-nav-open" for="p-header-nav-input"><span></span></label>-->
              <!--<label class="p-header-nav-unshown" id="nav-close" for="nav-input"></label>-->
              <a class="menu-trigger"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_search.png"
                                           alt="検索のアイコン""></a>
            </div>
            <div class=" p-header-icon p-header-bag">
              <a class="menu-trigger"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_bag.png"
                                           alt="バッグのアイコン""></a>
            </div>
            <div class=" p-header-icon p-header-account">
              <a class="menu-trigger"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_account.png"
                                           alt="アカウントのアイコン""></a>
            </div>
          </div>
        </div>

      </div>

    </div>

    <div class="p-drawer">

      <div class="p-drawer-inner">
        
        <div class="p-drawer-searchBar">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_search_bar.svg" alt="">
        </div>

        <div class="p-drawer-searchBox">
          <?php get_search_form(); ?>
        </div>

        <div class="p-drawer-nav">
          <div class="p-drawer-nav-item">
            <h3 class="p-drawer-nav-item-title">traveler</h3>
            <ul class="p-drawer-nav-item-list">
              <li><a href="<?php get_stylesheet_directory_uri(); ?>/category/traveler/aya/"><img
                    src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_traveler_hasegawa_aya.jpeg"
                    alt=""><span class="p-drawer-nav-item-list-name">長谷川あや</span></a></li>
              <li><a href="<?php get_stylesheet_directory_uri(); ?>/category/traveler/hitomi"><img
                    src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_traveler_yoshino_hitomi.jpg"
                    alt=""><span class="p-drawer-nav-item-list-name">良野仁美</span></a></li>
              <li><a href="<?php get_stylesheet_directory_uri(); ?>/category/traveler/nami"><img
                    src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_traveler_namiy_73.jpg"
                    alt=""><span class="p-drawer-nav-item-list-name">なみ</span></a></li>
              <li><a href="<?php get_stylesheet_directory_uri(); ?>/category/traveler/yuika"><img
                    src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_traveler_yu_i_k_a.jpg"
                    alt=""><span class="p-drawer-nav-item-list-name">yu.i.k.a</span></a></li>
              <li><a href="<?php get_stylesheet_directory_uri(); ?>/category/traveler/chiha"><img
                    src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_traveler_chiha6710.jpg"
                    alt=""><span class="p-drawer-nav-item-list-name">chiha</span></a></li>
              <li><a href="<?php get_stylesheet_directory_uri(); ?>/category/traveler/ayumi"><img
                    src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_traveler_oayumi.jpg"
                    alt=""><span class="p-drawer-nav-item-list-name">AYUMI</span></a></li>
            </ul>
          </div>
          <div class="p-drawer-nav-item">
            <h3 class="p-drawer-nav-item-title">categoly</h3>
            <ul class="p-drawer-nav-item-list p-drawer-nav-item-list-categoly">
              <li><a href="<?php get_stylesheet_directory_uri(); ?>/#/all/"><img
                    src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_all.svg"
                    alt=""><span class="p-drawer-nav-item-list-name">all</span></a></li>
              <li><a href="<?php get_stylesheet_directory_uri(); ?>/#/"><img
                    src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_pickup.svg"
                    alt=""><span class="p-drawer-nav-item-list-name">pickup</span></a></li>
              <li><a href="<?php get_stylesheet_directory_uri(); ?>/#/traveler/"><img
                    src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_traveler.svg"
                    alt=""><span class="p-drawer-nav-item-list-name">traveler</span></a></li>
              <li><a href="<?php get_stylesheet_directory_uri(); ?>/#/fashion/"><img
                    src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_fashion.svg"
                    alt=""><span class="p-drawer-nav-item-list-name">fashion</span></a></li>
              <li><a href="<?php get_stylesheet_directory_uri(); ?>/#/food/"><img
                    src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_food.svg"
                    alt=""><span class="p-drawer-nav-item-list-name">food</span></a></li>
              <li><a href="<?php get_stylesheet_directory_uri(); ?>/#/spot/"><img
                    src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_spot.svg"
                    alt=""><span class="p-drawer-nav-item-list-name">spot</span></a></li>
            </ul>
          </div>
        </div>

      </div>

    </div>

  </header>


  <?php

  if (is_front_page() || is_home() || is_archive() || is_category() || is_search() || is_404()) {

    $class = 'two-column';

  } elseif (welcart_basic_is_cart_page()) {

    $class = 'two-column cart-page';

  } elseif (welcart_basic_is_member_page()) {

    $class = 'two-column member-page';

  } elseif (welcart_search_page()) {

    $class = 'two-column search-page';

  } else {

    $class = 'three-column';

  };
  ?>

  <div id="main" class="<?php echo $class; ?>">
    <div class="l-inner">

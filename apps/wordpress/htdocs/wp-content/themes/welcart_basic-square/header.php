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

  <header class="header-header-vNoK7j">
    <div class="header-top">
      <div class="logo"><a href="/"><img src="https://rite.co.jp/wp-content/uploads/2019/07/22181254/logo.png"
                                         alt="riteのロゴ"></a></div>
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

  <div class="p-main-content <?php echo $class; ?>">
    <div class="l-inner">

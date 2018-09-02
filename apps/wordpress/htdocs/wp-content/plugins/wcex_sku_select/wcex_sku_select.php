<?php
/*
Plugin Name: WCEX SKU Select
Plugin URI: http://www.welcart.com/
Description: This plugin is the extension plugin for Welcart only. Please use with Welcart.
Version: 1.1.1
Author: Collne Inc.
Author URI: http://www.colle.com/
*/

define('WCEX_SKU_SELECT', true);
define('WCEX_SKU_SELECT_VERSION', "1.1.1.1802021");
define('WCEX_SKU_SELECT_DIR', WP_PLUGIN_DIR . '/' . plugin_basename(dirname(__FILE__)));
define('WCEX_SKU_SELECT_URL', WP_PLUGIN_URL . '/' . plugin_basename(dirname(__FILE__)));

require_once( WCEX_SKU_SELECT_DIR . '/sku_select.class.php' );
require_once( WCEX_SKU_SELECT_DIR . '/template_func.php' );

WCEX_SKU_SELECT::load_textdomain();
add_action( 'plugins_loaded', array( 'WCEX_SKU_SELECT', 'get_instance' ) );

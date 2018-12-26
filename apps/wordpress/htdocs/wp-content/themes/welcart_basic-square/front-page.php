<?php
/**
 * Front Page
 *
 * @package WordPress
 */

get_header(); ?>



  <div id="primary" class="site-content">
      <div id="app">
          <test-axios :the-url='theUrlAlpha'></test-axios>
          <hr>
          <test-axios :the-url='theUrlBravo'></test-axios>
      </div>

  <?php get_footer(); ?>

<?php
/**
 * Front Page
 *
 * @package WordPress
 */

get_header(); ?>

<!-- TOPメイン記事 -->
<div class="top-main">
  <div id="app">
    <p>
      <router-link to="/">PICKUP</router-link>
      <router-link to="/all">ALL</router-link>
    </p>
    <router-view></router-view>
  </div>
</div>
<?php get_footer(); ?>

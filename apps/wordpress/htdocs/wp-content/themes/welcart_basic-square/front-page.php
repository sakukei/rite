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
    <h1>Hello App!</h1>
    <p>
      <router-link to="/foo">Go to Foo</router-link>
      <router-link to="/bar">Go to Bar</router-link>
    </p>
    <router-view></router-view>
  </div>
</div>
<?php get_footer(); ?>

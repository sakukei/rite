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
      <router-link to="/country">COUNTRY</router-link>
      <router-link to="/traveler">TRAVELER</router-link>
    </p>
    <router-view></router-view>
    <div>
      <h1>posts</h1>
      <div>{{this.posts}}</div>
    </div>
    <div>
      <h1>pickup</h1>
      <div>{{this.pickup}}</div>
    </div>
  </div>
</div>
<?php get_footer(); ?>

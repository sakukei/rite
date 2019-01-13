<?php
/**
 * @package Welcart
 * @subpackage Welcart_Basic
 */

get_header(); ?>
<!--　TOP2カラム　-->

// 記事の自動整形を無効にする
<?php remove_filter('the_content', 'wpautop'); ?>
// 抜粋の自動整形を無効にする
<?php remove_filter('the_excerpt', 'wpautop'); ?>
<div class="contents-column">

  <div id="primary" class="site-content">
    <div id="content" class="cf" role="main">

      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <?php get_template_part('template-parts/content', get_post_format()); ?>
        <?php posts_nav_link(' &#8212; ', __('&laquo; Newer Posts'), __('Older Posts &raquo;')); ?>

        <?php if (!usces_is_item()): ?>

          <div class="comment-area">
            <div class="feedback">
              <?php wp_link_pages(); ?>
            </div>
            <!--						--><?php //comments_template( '', true ); ?>
          </div><!-- .comment-area -->

        <?php endif; ?>

      <?php endwhile; else: ?>

        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

      <?php endif; ?>

      <div class="p-user">
        <div class="p-user-iconWrap">
          <?php echo get_avatar(get_the_author_meta('ID'), '','', '', array('class' => 'c-icon-user p-user-icon')); ?>
        </div>
        <p class="p-user_name"><?php echo get_the_author(); ?></p>
        <p class="p-user_description"><?php the_author_meta('description'); ?></p>
        <p class="c-account p-user_account">
          <a href="<?php the_author_meta('user_url'); ?>" class="c-account_link"><?php the_author_meta('nickname'); ?></a>
        </p>
      </div>

        <?php
      $args = array(
        // 関連記事を表示する最大件数
        'limit' => 10,
        // 使用するテンプレートの名前を指定
        'template' => 'yarpp-template-relative.php',
      );
      yarpp_related($args);
      ?>

      <!--			--><?php //get_sidebar('other'); ?>


    </div><!-- #content -->
  </div><!-- #primary -->

<!--  --><?php //get_sidebar(); ?>
</div>
<?php get_footer(); ?>

<?php
/**
 * @package Welcart
 * @subpackage Welcart_Basic
 */

get_header(); ?>

<section id="primary" class="site-content">
  <div class="p-search" id="content" role="main">

    <h1
      class="p-search-title"><?php printf(__('Search Results for: %s', 'welcart_basic'), '<span>' . esc_html(get_search_query()) . '</span>'); ?></h1>

    <?php if (have_posts()) : ?>
      <div class="p-search-list">
        <ul class="p-main-grid">

        <?php while (have_posts()) : the_post(); ?>

          <li id="post-<?php the_ID(); ?>" <?php post_class('grid-item'); ?>>

            <div class="inner">

              <div class="itemimg">
                <a href="<?php the_permalink() ?>">
                  <?php usces_the_itemImage(0, 300, 300); ?>
                  <!--                  --><?php //if (wcct_get_options('display_soldout') && !usces_have_zaiko_anyone()): ?>
                  <!--                    <div class="itemsoldout">-->
                  <!---->
                  <!--                      <div class="inner">-->
                  <!---->
                  <!--                        --><?php //_e('SOLD OUT', 'welcart_basic_square'); ?>
                  <!---->
                  <!--                        --><?php //if (wcct_get_options('display_inquiry')): ?>
                  <!--                          <span class="text">-->
                  <?php //wcct_options('display_inquiry_text'); ?><!--</span>-->
                  <!--                        --><?php //endif; ?>
                  <!---->
                  <!--                      </div>-->
                  <!---->
                  <!--                    </div>-->
                  <!--                  --><?php //endif; ?>
                </a>
              </div>
              <?php wcct_produt_tag(); ?>
              <?php welcart_basic_campaign_message(); ?>
              <!--              <div class="item-info-wrap">-->
              <!--                <div class="itemname"><a href="--><?php //the_permalink(); ?><!--"-->
              <!--                                         rel="bookmark">-->
              <?php //usces_the_itemName(); ?><!--</a></div>-->
              <!--                <div-->
              <!--                  class="itemprice">-->
              <?php //usces_crform(usces_the_firstPrice('return'), true, false) . usces_guid_tax(); ?><!--</div>-->
              <!--              </div><!-- item-info-box -->

            </div><!-- .inner -->

          </li>

        <?php endwhile; ?>

      </ul>
      </div>

    <?php else: ?>

      <p class="no-date"><?php echo __('No posts found.', 'usces'); ?></p>

    <?php endif; ?>

    <div class="pagination_wrapper">
      <?php
      $args = array(
        'type' => 'list',
        'prev_text' => __(' &laquo; ', 'welcart_basic'),
        'next_text' => __(' &raquo; ', 'welcart_basic'),
      );
      echo paginate_links($args);
      ?>
    </div><!-- .pagination_wrapper -->


  </div><!-- #content -->
</section><!-- #primary -->

<?php get_footer(); ?>

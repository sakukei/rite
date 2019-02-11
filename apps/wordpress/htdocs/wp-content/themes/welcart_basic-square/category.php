<?php
/**
 * @package Welcart
 * @subpackage Welcart_Basic
 */

get_header(); ?>

<section id="primary" class="site-content">

  <?php if (usces_is_cat_of_item(get_query_var('cat'))): ?>

    <?php if (have_posts()) : ?>

      <div class="cat-il grid">

        <div class="grid-item main category-grid">
          <div class="inner">
            <?php
            $term_img = $term_class = $term_before = $term_after = '';
            $term_id = get_query_var('cat');
            $term_img_url = get_term_meta($term_id, 'wcct-tag-thumbnail-url', true);
            if (!empty($term_img_url)) {
              $term_img = '<p class="taxonomy-img"><img src="' . get_term_meta($term_id, 'wcct-tag-thumbnail-url', true) . '"></p>';
            }
            if (wcct_get_options('cat_image') && !empty($term_img_url)) {
              $term_class = ' over';
              $term_before = '<div class="wrap"><div class="in">';
              $term_after = '</div></div>';
            }
            ?>
            <div class="page-header<?php echo $term_class; ?>">
              <?php
              echo $term_img;
              echo $term_before;
              echo $term_after;
              ?>
            </div><!-- .page-header -->

          </div><!-- .inner -->
        </div>

        <?php while (have_posts()) : the_post(); ?>

          <article id="post-<?php the_ID(); ?>" class="grid-item">

            <div class="inner">

              <div class="itemimg">
                <a href="<?php the_permalink(); ?>">
                  <?php usces_the_itemImage(0, 300, 300); ?>
                  <?php if (wcct_get_options('display_soldout') && !usces_have_zaiko_anyone()): ?>
                    <div class="itemsoldout">
                      <div class="inner">
                        <?php _e('SOLD OUT', 'welcart_basic_square'); ?>
                        <?php if (wcct_get_options('display_inquiry')): ?>
                          <span class="text"><?php wcct_options('display_inquiry_text'); ?></span>
                        <?php endif; ?>
                      </div>
                    </div>
                  <?php endif; ?>
                </a>
              </div>
              <?php wcct_produt_tag(); ?>
              <?php welcart_basic_campaign_message(); ?>
              <div class="item-info-wrap">
                <div class="itemname"><a href="<?php the_permalink(); ?>"
                                         rel="bookmark"><?php usces_the_itemName(); ?></a>
                </div>
                <div
                  class="itemprice"><?php usces_crform(usces_the_firstPrice('return'), true, false) . usces_guid_tax(); ?></div>
              </div><!-- item-info-box -->

            </div><!-- inner -->

          </article>
        <?php endwhile; ?>

      </div><!-- .cat-il -->

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
    </div><!-- .pagenation-wrapper -->

  <?php else : ?>

  <?php if (have_posts()) : ?>

  <div class="post-li grid">

    <div class="grid-item main category-grid">
      <div class="inner">

        <?php
        $term_img = $term_class = $term_before = $term_after = '';
        $term_id = get_query_var('cat');
        $term_img_url = get_term_meta($term_id, 'wcct-tag-thumbnail-url', true);
        if (!empty($term_img_url)) {
          $term_img = '<p class="p-taxonomy-img"><img src="' . get_term_meta($term_id, 'wcct-tag-thumbnail-url', true) . '"></p>';
        }
        if (wcct_get_options('cat_image') && !empty($term_img_url)) {
          $term_class = ' over';
//          $term_before = '<div class="wrap"><div class="in">';
//          $term_after = '</div></div>';
        }
        ?>
        <div class="p-page-header<?php echo $term_class; ?>">
          <?php
          //カスタムフィールドを読み込むために、カテゴリIDを取得
          $cat = get_the_category();
          $cat = $cat[0];
          $catid = $cat->cat_ID;
          $post_id = 'category_' . $catid;
          ?>
          <?php if (get_field('instagram', $post_id)): ?>
            <?php
            echo $term_img;
            echo $term_before;
            ?>
            <div class="p-category-head">
              <?php
              the_archive_title('<h1 class="p-category-user-title">', '</h1>');
              ?>
              <?php
              the_archive_description('<div class="p-category-user-description">', '</div>');
              echo $term_after;
              ?>
              <div class="p-category-user-instagram">
                <a href="<?php echo the_field('instagram', $post_id); ?>" target="_blank"
                   class="p-category-user-instagramLink">
                  <div class="p-category-user-instagramInner">
                    <div class="p-category-user-instagramIcon">
                      <img alt="リンクはこちら" src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_instagram.png"/>
                    </div>
                    <p class="p-category-user-instagramName"><?php echo the_field('instagram_user', $post_id); ?></p>
                  </div>
                </a>
              </div><!-- /category-instagram -->
            </div><!-- /category-instagram-head -->
          <?php endif; ?>

        </div><!-- .page-header -->

        <?php if (get_field('instagram')): ?>
          <a href="<?php echo the_field('instagram'); ?>" target="_blank">
            <img alt="リンクはこちら" src="<?php echo get_template_directory_uri(); ?>/images/icon_instagram.png"/>
          </a>
        <?php endif; ?>

      </div><!-- .inner -->
    </div>

    <!-- タブ -->
    <div class="p-tab" id="tab">
      <ul class="p-tab-list">
        <li class="firstview is-current">記事</li>
        <li class="no-view">商品</li>
      </ul>
    </div>

    <!-- タブの中身 -->
    <div class="p-tab-container">
      <div class="p-tab-contents firstview is-current">
        <ul class="p-main-grid">
          <?php while (have_posts()) : the_post(); ?>
            <?php if (has_post_thumbnail()): ?>
              <li>
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
              </li>
            <?php endif; ?>
          <?php endwhile; ?>
        </ul>
      </div>

      <?php else: ?>

        <p class="no-date"><?php echo __('No posts found.', 'usces'); ?></p>

      <?php endif; ?>

      <?php endif; ?>
      <div class="tab-contents no-view">

        <div class="relatied">
          <?php
          $this_cat_slug = get_category($cat)->slug;
          $cat_query = new WP_Query(array('tag' => $this_cat_slug, 'status' => 'post', 'posts_per_page' => 20, 'orderby' => 'rand'));
          ?>
          <div class="post-column-wrap">
            <div class="post-column">
              <?php if ($cat_query->have_posts()) : while ($cat_query->have_posts()) : $cat_query->the_post(); ?>
                <?php
                usces_the_item();
                usces_have_skus();
                ?>
                <div class="grid-item">
                  <div class="inner">
                    <div class="itemimg">
                      <a href="<?php the_permalink() ?>">
                        <?php usces_the_itemImage(0, 1000, 9999); ?>
                        <?php if (wcct_get_options('display_soldout') && !usces_have_zaiko_anyone()): ?>
                          <div class="itemsoldout">

                            <div class="inner">

                              <?php _e('SOLD OUT', 'welcart_basic_square'); ?>

                              <?php if (wcct_get_options('display_inquiry')): ?>
                                <span class="text"><?php wcct_options('display_inquiry_text'); ?></span>
                              <?php endif; ?>

                            </div>

                          </div>
                        <?php endif; ?>
                      </a>
                    </div>
                    <?php wcct_produt_tag(); ?>
                    <?php welcart_basic_campaign_message(); ?>
                    <div class="item-info-wrap">
                      <div class="itemname">
                        <a href="<?php the_permalink(); ?>" rel="bookmark"><?php usces_the_itemName(); ?></a>
                      </div>
                      <div
                        class="itemprice"><?php usces_crform(usces_the_firstPrice('return'), true, false) . usces_guid_tax(); ?></div>
                    </div><!-- item-info-box -->
                  </div>
                </div>
              <?php endwhile; else: ?>
                <p>商品が見つかりません。</p>
              <?php endif; ?>
              <?php wp_reset_postdata(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>

</section><!-- #primary -->


<?php get_footer(); ?>

<?php
/**
 * @package Welcart
 * @subpackage Welcart_Basic
 */

get_header(); ?>
    <!--　TOP2カラム　-->
    <div class="contents-column">

    <div id="primary" class="site-content">
        <div id="content" class="cf" role="main">

            <div class="column-wrap">

                <div class="column">

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

                </div><!-- column -->
            </div><!-- column-wrap -->


            <?php
                $args = array(
                    // 関連記事を表示する最大件数
                    'limit'    => 3,
                    // 使用するテンプレートの名前を指定
                    'template' => 'yarpp-template-relative.php',
                );
                yarpp_related($args);
            ?>

            <!--			--><?php //get_sidebar('other'); ?>



        </div><!-- #content -->
    </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
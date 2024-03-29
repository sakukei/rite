<?php
/**
 * @package Welcart
 * @subpackage Welcart_Basic
 */

get_header(); ?>

<!--    <div id="primary" class="site-content">-->
<!--        <div id="content" class="cf" role="main">-->
<!---->
<!--            <div class="column-wrap">-->
<!---->
<!--                <div class="column">-->
    <div class="fixed-bg">

                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                        <?php get_template_part( 'template-parts/content', get_post_format() ); ?>
                        <?php posts_nav_link(' &#8212; ', __('&laquo; Newer Posts'), __('Older Posts &raquo;')); ?>

                    <?php endwhile; else: ?>

                        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

                    <?php endif; ?>
    </div>
<!--                </div><!-- column -->
<!--            </div><!-- column-wrap -->
<!---->
<!--            --><?php //get_sidebar('other'); ?>
<!---->
<!--        </div><!-- #content -->
<!--    </div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
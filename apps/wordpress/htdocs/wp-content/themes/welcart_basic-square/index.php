<?php
/**
 * @package Welcart
 * @subpackage Welcart_Basic
 */

get_header(); ?>

<!--　TOP2カラム　-->
<div class="contents-column">

    <div id="primary" class="site-content">
		<div id="content" role="main">
		
		<div class="column-wrap">

			<?php if ( get_option('page_for_posts') ) {

					$class = 'column front-post';
				}else {
					
					$class = 'column';
				}
			
			?>
			<div class="<?php echo $class; ?>">
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

					<div class="entry-box">
					
						<h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>					
	
						<div class="entry-meta">
							<span class="date"><time><?php the_date(); ?></time></span>
							<span class="cat"><?php _e("Filed under:"); ?> <?php the_category(',') ?></span>
							<span class="tag"><?php the_tags(__('Tags: ')); ?></span>
							<span class="author"><?php the_author() ?><?php edit_post_link(__('Edit This')); ?></span>
						</div>
						<div class="entry-content">
							<?php the_excerpt(); ?>
						</div>

					</div><!-- .entry-box -->

				</article>
			<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif; ?>

			<div class="pagination_wrapper">
				<?php
				$args = array (
					'type' => 'list',
					'prev_text' => __( ' &laquo; ', 'welcart_basic' ),
					'next_text' => __( ' &raquo; ', 'welcart_basic' ),
				);
				echo paginate_links( $args );
				?>
			</div><!-- .pagenation-wrapper -->
			
			</div><!-- .column -->
		</div><!-- .column-wrap -->			
		</div><!-- #content -->
	</div><!-- #primary -->
    <?php get_sidebar(); ?>
</div>





<?php get_footer(); ?>
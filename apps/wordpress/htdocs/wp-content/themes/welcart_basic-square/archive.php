<?php
/**
 * @package Welcart
 * @subpackage Welcart_Basic
 */

get_header(); ?>

	<section id="primary" class="site-content">
		<div id="content" role="main">

			<div class="column-wrap">

				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>

				<div class="column">
		
				<?php if (have_posts()) : ?>
		
				<div class="post-li grid">

					<div class="grid-sizer"></div>

					<?php while (have_posts()) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class('grid-item'); ?>>
							<div class="inner">
								<?php if(usces_is_item()): ?>
								<div class="thumb-img">
									<a href="<?php the_permalink(); ?>">
										<?php usces_the_itemImage( 0, 300, 300 ); ?>
									</a>
								</div>
								<?php else: ?>
								<div class="thumb-img"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a></div>
								<?php endif; ?>
								<div class="post-info-wrap">
									<div class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
									<?php remove_filter('the_excerpt',array($usces,'filter_cartContent'),20); ?>
									<div class="post-excerpt"><?php the_excerpt(); ?></div>
									<div class="post-cat"><?php the_category(',') ?></div>
									<div class="post-date"><?php the_date(); ?></div>
								</div><!-- post-info-wrap -->
							</div><!-- .inner -->
						</article>
					<?php endwhile; ?>
				</div>
				
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
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

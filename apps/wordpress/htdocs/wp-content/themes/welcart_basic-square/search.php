<?php
/**
 *
 * Search
 *
 * @package Welcart
 * @subpackage Welcart_Basic
 */

get_header(); ?>

<!--　TOP2カラム　-->
<div class="contents-column">

	<section id="primary" class="site-content">
		<div id="content" role="main">

			<div class="column-wrap">

				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'welcart_basic' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>

				<div class="column">

							<?php
							$count          = 0;
							$posts_per_page = 10;
							$search_query   = new WP_Query(
								array(
									'post_type'      => get_query_var( 'post_type', 'post' ),
									'posts_per_page' => $posts_per_page,
									's'              => get_search_query(),
								)
							);
							if ( $search_query->have_posts() ) :
								?>

							<div class="search-li grid">

								<div class="grid-sizer"></div>

								<?php
								while ( $search_query->have_posts() ) :
									$search_query->the_post();
									?>

								<article id="post-<?php the_ID(); ?>" <?php post_class( 'grid-item' ); ?>>

									<div class="inner">

										<div class="itemimg">
											<a href="<?php the_permalink(); ?>">
												<?php usces_the_itemImage( 0, 300, 300 ); ?>
												<?php if ( wcct_get_options( 'display_soldout' ) && ! usces_have_zaiko_anyone() ) : ?>
												<div class="itemsoldout">

													<div class="inner">

														<?php _e( 'SOLD OUT', 'welcart_basic_square' ); ?>

														<?php if ( wcct_get_options( 'display_inquiry' ) ) : ?>
														<span class="text"><?php wcct_options( 'display_inquiry_text' ); ?></span>
														<?php endif; ?>

													</div>

												</div>
												<?php endif; ?>
											</a>
										</div>
										<?php wcct_produt_tag(); ?>
										<?php welcart_basic_campaign_message(); ?>
										<div class="item-info-wrap">
											<div class="itemname"><a href="<?php the_permalink(); ?>"  rel="bookmark"><?php usces_the_itemName(); ?></a></div>
											<div class="itemprice"><?php usces_crform( usces_the_firstPrice( 'return' ), true, false ) . usces_guid_tax(); ?></div>
										</div><!-- item-info-box -->

									</div><!-- .inner -->

								</article>

									<?php
									$count++;
									endwhile;
								?>
								</div><!-- .search-li -->
								<?php
								if ( $count == $posts_per_page ) :
									?>
								<div id="more-search"><p class="incart-btn"><a href="#" class="header-incart-btn"><span class="incart-btn-text">もっと見る</span></a></p></div>
							<?php endif; ?>
								<?php else : ?>

									<p class="no-date"><?php echo __( 'No posts found.', 'usces' ); ?></p>

								<?php
								endif;
								wp_reset_postdata();
?>

				</div><!-- column -->
			</div><!-- column-wrap -->

		</div><!-- #content -->
	</section><!-- #primary -->
	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>

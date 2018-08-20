<?php
/**
 * @package Welcart
 * @subpackage Welcart_Basic
 */

get_header(); ?>

	<section id="primary" class="site-content">
		<div id="content" role="main">

			<div class="column-wrap">
				<div class="column">


					<?php if( usces_is_cat_of_item( get_query_var( 'cat') ) ): ?>
			
						<?php if (have_posts()) : ?> 
			
						<div class="cat-il grid">
							
							<div class="grid-sizer"></div>
							
							<div class="grid-item main">
								<div class="inner">

									<?php
									$term_img = $term_class = $term_before = $term_after = '';
									$term_id		= get_query_var( 'cat' );
									$term_img_url	= get_term_meta( $term_id, 'wcct-tag-thumbnail-url', true );
									if( ! empty( $term_img_url ) ) {
										$term_img	= '<p class="taxonomy-img"><img src="' . get_term_meta( $term_id, 'wcct-tag-thumbnail-url', true ) . '"></p>';
									}
									if( wcct_get_options( 'cat_image' ) && ! empty( $term_img_url ) ) {
										$term_class		= ' over';
										$term_before	= '<div class="wrap"><div class="in">';
										$term_after		= '</div></div>';
									}
									?>
									<div class="page-header<?php echo $term_class; ?>">
										<?php
										echo $term_img;
										echo $term_before;
										the_archive_title( '<h1 class="page-title">', '</h1>' );
										the_archive_description( '<div class="taxonomy-description">', '</div>' );
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
												<?php usces_the_itemImage( 0, 300, 300 ); ?>
												<?php if( wcct_get_options( 'display_soldout' ) && ! usces_have_zaiko_anyone() ): ?>
												<div class="itemsoldout">
													<div class="inner">
														<?php _e('SOLD OUT', 'welcart_basic_square' ); ?>
														<?php if( wcct_get_options( 'display_inquiry' ) ): ?>
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
											<div class="itemname"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php usces_the_itemName(); ?></a></div>
											<div class="itemprice"><?php usces_crform( usces_the_firstPrice('return'), true, false ) . usces_guid_tax(); ?></div>
										</div><!-- item-info-box -->
									
									</div><!-- inner -->
			
								</article>
							<?php endwhile; ?>
			
						</div><!-- .cat-il -->
			
						<?php else: ?>
						
							<p class="no-date"><?php echo __('No posts found.', 'usces'); ?></p>
			
						<?php endif; ?>
			
					<?php else : ?>
			
						<?php if (have_posts()) : ?>
						
						<div class="post-li grid">
							
							<div class="grid-sizer"></div>

							<div class="grid-item main">
								<div class="inner">

									<?php
									$term_img = $term_class = $term_before = $term_after = '';
									$term_id		= get_query_var( 'cat' );
									$term_img_url	= get_term_meta( $term_id, 'wcct-tag-thumbnail-url', true );
									if( ! empty( $term_img_url ) ) {
										$term_img	= '<p class="taxonomy-img"><img src="' . get_term_meta( $term_id, 'wcct-tag-thumbnail-url', true ) . '"></p>';
									}
									if( wcct_get_options( 'cat_image' ) && ! empty( $term_img_url ) ) {
										$term_class		= ' over';
										$term_before	= '<div class="wrap"><div class="in">';
										$term_after		= '</div></div>';
									}
									?>
									<div class="page-header<?php echo $term_class; ?>">
										<?php
										echo $term_img;
										echo $term_before;
										the_archive_title( '<h1 class="page-title">', '</h1>' );
										the_archive_description( '<div class="taxonomy-description">', '</div>' );
										echo $term_after;
										?>
									</div><!-- .page-header -->

								</div><!-- .inner -->
							</div>

							
							<?php while (have_posts()) : the_post(); ?>
								<article id="post-<?php the_ID(); ?>" class="grid-item">
									<div class="inner">
										<?php if ( has_post_thumbnail() ): ?>
										<div class="thumb-img"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a></div>
										<?php endif; ?>
										<div class="post-info-wrap">
                                            <div class="post-character">
                                                <div class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                                                <div class="post-excerpt"><?php the_excerpt(); ?></div>
                                            </div>
                                            <!--<div class="post-cat">--><?php //the_category(',') ?><!--</div>-->
                                            <!--<div class="post-date">--><?php //the_date(); ?><!--</div>-->
                                            <div class="post-contributor">
                                                <div class="post-icon"><?php echo get_avatar( $id_or_email, 48, $default, $alt, $args ); ?></div>
                                                <div class="post-name"><?php echo get_the_author(); ?></div>
                                            </div>
										</div><!-- post-info-wrap -->
									</div><!-- inner -->
								</article>
							<?php endwhile; ?>
						</div>
						
						<?php else: ?>
						
							<p class="no-date"><?php echo __('No posts found.', 'usces'); ?></p>
						
						<?php endif; ?>
			
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

				</div><!-- column -->
			</div><!-- column-wrap -->	

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

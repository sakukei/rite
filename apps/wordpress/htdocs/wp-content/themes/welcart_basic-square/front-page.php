<?php get_header(); ?>

<div class="top-main">
    <?php $args = array(
        'numberposts' => 5,                //表示（取得）する記事の数
        'post_type' => 'top_main'    //投稿タイプの指定
    );
    $posts = get_posts( $args );
    if( $posts ) : foreach( $posts as $post ) : setup_postdata( $post ); ?>
        <article id="post-<?php the_ID(); ?>" class="post main-article">
            <a href="<?php the_permalink(); ?>">
                <div class="main">
                    <div class="main-img">
                        <?php the_post_thumbnail('thumbnail'); ?>
                    </div>
                    <div class="main-content">
                        <div class="main-content-inner">
                            <p class="main-content-title"><?php the_title(); ?></p>
                            <div class="main-content-column">
                                <p class="main-content-lead"><?php the_content(); ?></p>
                                <div class="main-contributor">
                                    <div class="main-icon contributor-icon">
                                        <?php echo get_avatar( $id_or_email, 48, $default, $alt, $args ); ?>
                                    </div>
                                    <div class="main-name">
                                        <?php echo get_the_author(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </article>
    <?php endforeach; ?>
    <?php else : //記事が無い場合 ?>
        <div>
            <p>記事はまだありません。</p>
        </div>
    <?php endif;
    wp_reset_postdata(); //クエリのリセット ?>

</div>

<div class="contents-column">

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<div class="column-wrap">
				<div class="column">

					<?php if ( 'page' == get_option('show_on_front') ): ?>

					<div class="sof">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<article <?php post_class() ?> id="post-
							<?php the_ID(); ?>">
							<div class="entry-box">
								<h2 class="entry-title">
									<?php the_title(); ?>
								</h2>
								<div class="entry-content">
									<?php the_content(); ?>
								</div>
							</div>
							<!-- .entry-box -->
						</article>
						<?php endwhile; else: ?>
						<p>
							<?php _e('Sorry, no posts matched your criteria.'); ?>
						</p>
						<?php endif; ?>

					</div>

					<?php else: ?>


					<div class="grid">

						<div class="grid-sizer"></div>
						<?php
					if( get_header_image() ):
						$allheaderimg = get_uploaded_header_images();
						if(count($allheaderimg) >= 1 ): 
					?>
							<div class="grid-item main">
								<div class="inner slider main-slider">
									<?php foreach ($allheaderimg as $key => $value): ?>
									<div><img src="<?php echo $value['url']; ?>" /></div>
									<?php endforeach; ?>
								</div>
							</div>
							<?php else: ?>
							<div class="main-image grid-item main">
								<div class="inner">
									<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
								</div>
							</div>
							<!-- main-image -->
							<?php
						endif;
					endif;
					
					//　商品
					if( have_posts() ) :
						while( have_posts() ) : the_post();
							if( usces_is_item( $post->ID) ){
						
						 		usces_the_item();
					?>
								<article id="post-<?php the_ID(); ?>" class="grid-item">
									<div class="inner">
										<div class="itemimg">
											<a href="<?php the_permalink(); ?>">
												<?php usces_the_itemImage( 0, 300, 300 ); ?>
												<?php if( wcct_get_options('display_soldout') && !usces_have_zaiko_anyone() ): ?>
												<div class="itemsoldout">
													<div class="inner">
														<?php _e('SOLD OUT', 'welcart_basic_square' ); ?>
														<?php if( wcct_get_options('display_inquiry') ): ?>
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
												<a href="<?php the_permalink(); ?>" rel="bookmark">
													<?php usces_the_itemName(); ?>
												</a>
											</div>
											<div class="itemprice">
												<?php usces_crform( usces_the_firstPrice('return'), true, false ) . usces_guid_tax(); ?>
											</div>
										</div>
										<!-- item-info-box -->
									</div>
									<!-- .inner -->
								</article>
								<?php
							}else{
					?>
								<article id="post-<?php the_ID(); ?>" class="grid-item post">
									<div class="inner">
										<?php if ( has_post_thumbnail() ): ?>
										<div class="thumb-img">
											<a href="<?php the_permalink(); ?>">
												<?php the_post_thumbnail(array(300,300)); ?>
											</a>
										</div>
										<?php endif; ?>
										<div class="post-info-wrap">
											<div class="post-character">
												<div class="post-title">
													<a href="<?php the_permalink(); ?>">
														<?php the_title(); ?>
													</a>
												</div>
												<div class="post-excerpt">
													<?php the_excerpt(); ?>
												</div>
											</div>
											<!--										<div class="post-cat">-->
											<?php //the_category(',') ?>
											<!--</div>-->
											<!--										<div class="post-date">-->
											<?php //the_date(); ?>
											<!--</div>-->
											<div class="post-contributor">
												<div class="post-icon">
													<?php echo get_avatar( $id_or_email, 48, $default, $alt, $args ); ?>
												</div>
												<div class="post-name">
													<?php echo get_the_author(); ?>
												</div>
											</div>
										</div>
										<!-- post-info-wrap -->
									</div>
								</article>
								<?php
							}

						endwhile;
					endif;
					?>

					</div>
					<!-- .grid -->

					<?php endif; ?>

					<div class="top-pickup">
						<p class="contents-title">ピックアップ</p>
							<?php $args = array(
                            'numberposts' => 5,                //表示（取得）する記事の数
                            'post_type' => 'top_pickup'    //投稿タイプの指定
                        );
                        $posts = get_posts( $args );
                        if( $posts ) : foreach( $posts as $post ) : setup_postdata( $post ); ?>
                        <article id="post-<?php the_ID(); ?>" class="post pickup-article">
                            <a href="<?php the_permalink(); ?>">
                                <div class="pickup">
                                    <div class="pickup-img">
                                        <?php the_post_thumbnail('thumbnail'); ?>
                                    </div>
                                    <div class="pickup-content">
                                        <div class="pickup-content-inner">
                                            <p class="pickup-content-title"><?php the_title(); ?></p>
                                            <div class="pickup-content-column">
                                                <p class="pickup-content-lead"><?php the_content(); ?></p>
                                                <div class="pickup-contributor">
                                                    <div class="pickup-contributor-column">
                                                        <div class="pickup-icon contributor-icon">
                                                            <?php echo get_avatar( $id_or_email, 48, $default, $alt, $args ); ?>
                                                        </div>
                                                        <div class="pickup-name">
                                                            <?php echo get_the_author(); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </article>
							<?php endforeach; ?>
							<?php else : //記事が無い場合 ?>
							<div>
								<p>記事はまだありません。</p>
							</div>
							<?php endif;
                        wp_reset_postdata(); //クエリのリセット ?>

					</div>

				</div>
				<!-- .column -->
			</div>
			<!-- column-wrap -->
		</div>
		<!-- #content -->
	</div>
	<!-- #primary -->

	<?php get_sidebar(); ?>
	<?php get_footer(); ?>

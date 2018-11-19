<?php
/**
 * Front Page
 *
 * @package WordPress
 */

get_header(); ?>

<!-- TOPメイン記事 -->
<div class="top-main">
	<?php
	$args  = array(
		'numberposts' => 5,           // 表示（取得）する記事の数.
		'post_type'   => 'top_main', // 投稿タイプの指定.
	);
	$posts = get_posts( $args );
	if ( $posts ) :
		foreach ( $posts as $post ) :
			setup_postdata( $post );
			?>
		<article id="post-<?php the_ID(); ?>" class="post main-article">
			<a href="<?php the_permalink(); ?>">
				<div class="main">
					<div class="main-img thumb">
							<?php the_post_thumbnail( 'full' ); ?>
					</div>
					<div class="main-content">
						<div class="main-content-inner">
							<p class="main-content-title"><?php the_title(); ?></p>
							<div class="main-content-column">
								<p class="main-content-lead"><?php echo wp_kses_post( wp_trim_words( get_the_content(), 50, '...' ) ); ?></p>
								<div class="main-contributor">
									<div class="main-icon contributor-icon">
										<?php echo get_avatar( get_the_author_meta( 'ID' ), 46 ); ?>
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
		<?php else : // 記事が無い場合. ?>
		<div>
			<p>記事はまだありません。</p>
		</div>
	<?php
	endif;
	wp_reset_postdata(); // クエリのリセット.
?>

</div>

<!--　TOP2カラム　-->
<div class="contents-column">

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<div class="column-wrap">
				<div class="column">

					<!-- TOPピックアップ記事 -->
					<div class="top-pickup">
						<p class="contents-title">ピックアップ</p>
						<?php
						$count          = 0;
						$posts_per_page = 15;
						$pickup_query   = new WP_Query(
							array(
								'posts_per_page' => $posts_per_page, // 表示（取得）する記事の数.
								'post_type'      => 'top_pickup',    // 投稿タイプの指定.
							)
						);
						?>
						<?php
						if ( $pickup_query->have_posts() ) :
							while ( $pickup_query->have_posts() ) :
								$pickup_query->the_post();
								?>
							<article id="post-<?php the_ID(); ?>" class="post pickup-article">
								<a href="<?php the_permalink(); ?>">
									<div class="pickup">
										<div class="pickup-img">
											<?php the_post_thumbnail( 'full' ); ?>
										</div>
										<div class="pickup-content">
											<div class="pickup-content-inner">
												<p class="pickup-content-title"><?php the_title(); ?></p>
												<div class="pickup-content-column">
													<p class="pickup-content-lead"><?php echo wp_kses_post( wp_trim_words( get_the_content(), 50, '...' ) ); ?></p>
													<div class="pickup-contributor">
														<div class="pickup-contributor-column">
															<div class="pickup-icon contributor-icon">
																<?php echo get_avatar( get_the_author_meta( 'ID' ), 30 ); ?>
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
								<?php
								$count++;
							endwhile;
							if ( $count === $posts_per_page ) :
								?>
							<div id="more"><p class="incart-btn"><a href="#" class="header-incart-btn"><span class="incart-btn-text">もっと見る</span></a></p></div>
							<?php endif; ?>
						<?php else : // 記事が無い場合. ?>
							<div>
								<p>記事はまだありません。</p>
							</div>
						<?php
						endif;
						wp_reset_postdata();
?>
					</div>
				</div><!-- /column -->
			</div><!-- /column-wrap -->
		</div><!-- /#content -->
	</div><!-- /#primary -->

	<?php get_sidebar(); ?>
	<?php get_footer(); ?>

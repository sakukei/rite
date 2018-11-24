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
	$main_query = new WP_Query(
		array(
			'posts_per_page' => 3,          // 表示（取得）する記事の数.
			'post_type'      => 'top_main', // 投稿タイプの指定.
		)
	);
	if ( $main_query->have_posts() ) :
		while ( $main_query->have_posts() ) :
			$main_query->the_post();
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
			<?php
		endwhile;
		else :
			?>
			<div><p>記事はまだありません。</p></div>
			<?php
		endif;
		wp_reset_postdata();
		?>
</div><!-- /top-main -->

<!-- 商品一覧 -->
<?php
$item_query = new WP_Query(
	array(
		'post_type'      => 'post',
		'posts_per_page' => 8,
	)
);
?>
<?php if ( $item_query->have_posts() ) : ?>
	<div class="top-items">
		<p class="contents-title">商品一覧</p>
		<div class="row row-0">
		<?php
		while ( $item_query->have_posts() ) :
			$item_query->the_post();
			?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'card-item' ); ?>>
			<div class="card-item-img">
				<a href="<?php the_permalink(); ?>">
					<?php usces_the_itemImage( 0, 300, 300 ); ?>
				</a>
			</div><!-- /card-item-img -->
			<div class="card-item-body">
				<div class="card-item-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php usces_the_itemName(); ?></a></div>
				<div class="card-item-price"><?php usces_crform( usces_the_firstPrice( 'return' ), true, false ) . usces_guid_tax(); ?></div>
			</div><!-- /card-item-body -->
		</article><!-- /card-item -->
		<?php endwhile; ?>
		</div><!-- /row -->
		<div class="more-items"><a class="btn btn-primary btn-wide-sp" href="<?php echo esc_url( get_category_link( get_category_by_slug( 'item' )->cat_ID ) ); ?>">もっと見る</a></div>
	</div><!-- /top-items -->
	<?php
endif;
wp_reset_postdata();
?>

<!--　TOP2カラム　-->
<div class="contents-column">

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<div class="column-wrap">
				<div class="column">

					<!-- TOPピックアップ記事 -->
					<div class="top-pickup">

					<!-- 旅人一覧 -->
					<?php $traveller_ids = array( 7, 36, 47, 58 ); // カテゴリーID ?>
					<?php if ( ! empty( $traveller_ids ) ) : ?>
					<div class="top-travellers">
						<p class="contents-title">たびびと一覧</p>
						<div class="row row-0">
						<?php foreach ( $traveller_ids as $traveller_id ) : ?>
							<?php $traveller = get_category( $traveller_id ); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'card-traveller' ); ?>>
							<a href="<?php echo esc_url( get_category_link( $traveller_id ) ); ?>">
								<div class="card-traveller-img" style="background: url(<?php echo esc_url( get_term_meta( $traveller_id, 'wcct-tag-thumbnail-url', true ) ); ?>) no-repeat center center / cover;">
										<!-- <img src="<?php echo esc_url( get_term_meta( $traveller_id, 'wcct-tag-thumbnail-url', true ) ); ?>"> -->
								</div><!-- /card-traveller-img -->
							</a>
							<div class="card-traveller-body">
								<div class="card-traveller-title"><a href="<?php echo esc_url( get_category_link( $traveller_id ) ); ?>" rel="bookmark"><?php echo esc_html( $traveller->cat_name ); ?></a></div>
							</div><!-- /card-traveller-body -->
						</article><!-- /card-traveller -->
					<?php endforeach; ?>
						</div><!-- /row -->
					</div><!-- /top-travellers -->
					<?php endif; ?>

						<p class="contents-title">ピックアップ</p>
						<?php
						$count          = 0;
						$posts_per_page = -1; // 15
						$pickup_query   = new WP_Query(
							array(
								'posts_per_page' => $posts_per_page, // 表示（取得）する記事の数.
								'post_type'      => 'top_pickup',    // 投稿タイプの指定.
							)
						);
						?>
						<?php
						if ( $pickup_query->have_posts() ) : ?>
						<div class="row row-0">
						<?php
							while ( $pickup_query->have_posts() ) :
								$pickup_query->the_post();
								?>
							<article id="post-<?php the_ID(); ?>" class="post pickup-article">
								<a href="<?php the_permalink(); ?>">
									<div class="pickup">
										<div class="pickup-img">
											<?php the_post_thumbnail( 'full' ); ?>
										</div><!-- /pickup-img -->
										<div class="pickup-content">
											<div class="pickup-content-inner">
												<p class="pickup-content-title"><?php the_title(); ?></p>
												<div class="pickup-content-column">
													<?php if ( wp_is_mobile() ) : ?>
													<p class="pickup-content-lead"><?php echo wp_kses_post( wp_trim_words( get_the_content(), 36, '...' ) ); ?></p>
													<?php else : ?>
													<p class="pickup-content-lead"><?php echo wp_kses_post( wp_trim_words( get_the_content(), 50, '...' ) ); ?></p>
													<?php endif; ?>
													<div class="pickup-contributor">
														<div class="pickup-contributor-column">
															<div class="pickup-icon contributor-icon">
																<?php echo get_avatar( get_the_author_meta( 'ID' ), 30 ); ?>
															</div>
															<div class="pickup-name">
																<?php echo get_the_author(); ?>
															</div>
														</div><!-- /pickup-contributor-column -->
													</div><!-- /pickup-contributor -->
												</div><!-- /pickup-content-column -->
											</div><!-- /pickup-content-inner -->
										</div><!-- /pickup-content -->
									</div><!-- /pickup -->
								</a>
							</article>
								<?php
								$count++;
							endwhile;
							?>
							</div><!-- /row -->
							<?php
							if ( $count === $posts_per_page ) :
								?>
							<!-- <div id="more"><a href="#" class="btn btn-primary btn-wide-sp">もっと見る</a></div> -->
							<?php endif; ?>
						<?php else : // 記事が無い場合. ?>
							<div><p>記事はまだありません。</p></div>
						<?php
						endif;
						wp_reset_postdata();
?>
					</div><!-- /top-pickup -->
				</div><!-- /column -->
			</div><!-- /column-wrap -->
		</div><!-- /#content -->
	</div><!-- /#primary -->

	<?php get_sidebar(); ?>
	<?php get_footer(); ?>

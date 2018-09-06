<?php
/**
 * @package Welcart
 * @subpackage Welcart_Basic
 */

get_header(); ?>
<!--　TOP2カラム　-->
<div class="contents-column contents-column-404">
	<div id="primary" class="content-area">
		<main id="content" class="site-main" role="main">
		
			<div class="column-wrap">

				<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'welcart_basic' ); ?></h1>

				<div class="column">
				
					<section class="error-404 not-found">
		
						<div class="page-content">
							<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'welcart_basic' ); ?></p>
		
							<?php get_search_form(); ?>
						</div><!-- .page-content -->
					</section><!-- .error-404 -->
					
				</div><!-- .column -->
			</div><!-- .column-wrap -->
			
		</main><!-- .site-main -->

	</div><!-- .content-area -->
    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>

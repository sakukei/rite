<?php
/*
Template Name: Inquiry
 * @package Welcart
 * @subpackage Welcart_Basic
 */

get_header(); ?>

<!--	<section id="primary" class="site-content">-->
<!--		<div id="content" role="main">-->
<!--		-->
<!--			<div class="column-wrap">-->
<!---->
<!--				<div class="column">-->
    <div class="fixed-bg">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<article class="inqbox">
						<div class="entry-box">
							<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
							<?php the_content(); ?>
							<?php usces_the_inquiry_form(); ?>
							<?php edit_post_link(__('Edit this'), '<p>', '</p>'); ?>
						</div><!-- .entry-box -->
					</article>
				<?php endwhile; endif; ?>
    </div>
				
<!--				</div><!-- .column -->
<!---->
<!--			</div><!-- .column-wrap -->
<!---->
<!--			--><?php //get_sidebar('other'); ?>
<!---->
<!--		</div><!-- #content -->
<!--	</section><!-- #primary -->
	
<!--	--><?php //get_sidebar(); ?>
	<?php get_footer(); ?>
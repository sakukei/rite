<?php
/**
 * @package Welcart
 * @subpackage Welcart_Basic
 */
?>

<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

	<?php if ( has_post_thumbnail() ): ?>
	<div class="entry-thumb">
		<?php the_post_thumbnail( 'full' ); ?>
	</div><!-- entry-thumb -->
	<?php endif; ?>

	<div class="entry-box">

		<h2 class="entry-title"><?php the_title(); ?></h2>
		
		<?php if ( is_single() ): ?>
			<div class="entry-meta">
				<span class="date"><time><?php the_date(); ?></time></span>
				<span class="cat"><?php the_category(',') ?></span>
				<span class="tag"><?php the_tags(__('Tags: ')); ?></span>
				<span class="author"><?php the_author() ?><?php edit_post_link(__('Edit This')); ?></span>
			</div>
		<?php endif; ?>
	
		<div class="entry-content">
			<?php the_content(); ?>
		</div><!-- .entry-content -->
	
	</div>

</article>
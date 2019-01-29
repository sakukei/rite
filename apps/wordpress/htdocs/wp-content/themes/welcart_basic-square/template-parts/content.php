<?php
/**
 * @package Welcart
 * @subpackage Welcart_Basic
 */
?>

<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

  <div class="p-content-entry">
    <?php if (has_post_thumbnail()): ?>
      <div class="p-content-entry-thumb">
        <?php the_post_thumbnail('full'); ?>
        <h2 class="p-content-entry-title"><?php the_title(); ?></h2>
      </div>
    <?php endif; ?>

    <div class="p-content-entry-detail">
      <?php the_content(); ?>
    </div><!-- .entry-content -->

  </div>

</article>

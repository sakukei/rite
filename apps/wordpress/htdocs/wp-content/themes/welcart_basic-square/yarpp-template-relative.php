<div class="p-related">
  <?php if (have_posts()): ?>
    <h3 class="p-related-title">関連記事</h3>
    <ul class="p-related-list">
      <?php while (have_posts()) : the_post(); ?>
        <li>
          <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"
             class="p-related-entry">
            <?php if (has_post_thumbnail()) : ?>
              <?php the_post_thumbnail(); ?>
            <?php else : ?>
              <img src="<?php echo plugins_url() . '/' . 'yet-another-related-posts-plugin/images/default.png' ?>"
                   alt="no thumbnail"
                   title="no thumbnail"/>
            <?php endif; ?>
          </a>
        </li>
      <?php endwhile; ?>
    </ul>
  <?php else : ?>
    <!--<p>関連するページはありません。</p>-->
  <?php endif; ?>
</div>

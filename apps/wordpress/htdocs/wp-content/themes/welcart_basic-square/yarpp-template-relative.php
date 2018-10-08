<h3>あなたにおすすめの記事</h3>
<?php if (have_posts()): ?>
    <div class="related-entry-list">
        <ul class="slider">
            <?php while (have_posts()) : the_post(); ?>
                <li>
                    <div>
                        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"
                           class="related-entry">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail(
                                    array('full'),
                                    array('alt' => $title, 'title' => $title));
                                ?>
                            <?php else : ?>
                                <img src="<?php echo plugins_url() . '/' . 'yet-another-related-posts-plugin/images/default.png' ?>"
                                     alt="no thumbnail"
                                     title="no thumbnail"/>
                            <?php endif; ?>

                        </a>
                    </div>
                    <div class="post-title">
                        <a href="<?php the_permalink(); ?>"><?php
                            if (mb_strlen($post->post_title) > 24) {
                                $title = mb_substr($post->post_title, 0, 24);
                                echo $title . '...';
                            } else {
                                echo $post->post_title;
                            }
                            ?>
                        </a>
                    </div>
                    <div class="post-info-wrap">
                        <div class="post-character">
                            <div class="post-excerpt"><?php
                                if (mb_strlen($post->post_content, 'UTF-8') > 40) {
                                    $content = str_replace('\n', '', mb_substr(strip_tags($post->post_content), 0, 40, 'UTF-8'));
                                    echo $content . '……';
                                } else {
                                    echo str_replace('\n', '', strip_tags($post->post_content));
                                }
                                ?></div>
                        </div>
                        <div class="post-contributor">
                            <div class="post-icon"><?php echo get_avatar( get_the_author_meta( 'ID' ), 30 ); ?></div>
                            <div class="post-name"><?php echo get_the_author(); ?></div>
                        </div>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
<?php else : ?>
    <p>関連するページはありません。</p>
<?php endif; ?>
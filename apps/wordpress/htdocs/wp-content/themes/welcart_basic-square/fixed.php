<?php
/*
Template Name: 固定ページ
*/
?>
<!-- ヘッダー -->
<?php get_header(); ?>

<?php
if(have_posts()): while(have_posts()): the_post();?>

    <?php remove_filter(‘the_content’, ‘wpautop’); ?>
    <div class="fixed-bg">
        <?php the_content(); ?>
    </div>
<?php endwhile; endif; ?>

<!--　フッター　-->
<?php get_footer(); ?>

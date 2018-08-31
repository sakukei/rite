<?php
/*
Template Name: 固定ページ
*/
?>
<!-- ヘッダー -->
<?php get_header(); ?>

<?php
if(have_posts()): while(have_posts()): the_post();?>

    <?php the_content(); ?>

<?php endwhile; endif; ?>

<!--　フッター　-->
<?php get_footer(); ?>

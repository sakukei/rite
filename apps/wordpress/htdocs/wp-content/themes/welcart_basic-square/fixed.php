<?php
/*
Template Name: お問い合わせページ
*/
?>
<!-- ヘッダー -->
<?php get_header(); ?>

<?php
if(have_posts()): while(have_posts()): the_post();?>

    <div class="fixed-bg">
        <?php remove_filter(‘the_content’, ‘wpautop’); ?>
        <?php the_content(); ?>
        <div style=“width:100%;height:600px;overflow:auto;-webkit-overflow-scrolling:touch;“><iframe src=“https://tayori.com/form/078ee5a1e0088817f71e52826b33aeaa32485dda” width=“100%” height=“100%“></iframe></div>
    </div>
<?php endwhile; endif; ?>

<!--　フッター　-->
<?php get_footer(); ?>

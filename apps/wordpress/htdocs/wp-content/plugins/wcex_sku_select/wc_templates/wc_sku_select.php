<?php
/**
 * <meta content="charset=UTF-8">
 * @package Welcart
 * @subpackage Welcart Default Theme
 */
get_header();

?>
<div id="content" class="two-column">
<div class="catbox">

<?php if (have_posts()) : the_post(); ?>

<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
<h1 class="item_page_title"><?php the_title(); ?></h1>
<div class="storycontent">

<?php usces_remove_filter(); ?>
<?php usces_the_item(); ?>
<?php usces_have_skus(); ?>

<div id="itempage">
	<div class="itemimg">
	<a href="<?php usces_the_itemImageURL(0); ?>" <?php echo apply_filters('usces_itemimg_anchor_rel', NULL); ?>><?php usces_the_itemImage(0, 300, 300, $post); ?></a>
	</div>
	
	<h2 class="item_name"><?php usces_the_itemName(); ?> (<?php usces_the_itemCode(); ?>)</h2>
	<div class="exp clearfix">
		<div class="field">
		<?php if( usces_the_itemCprice('return') > 0 ) : ?>
			<div class="field_name"><?php _e('List price', 'usces'); ?><?php usces_guid_tax(); ?></div>
			<div class="field_cprice"><span class="ss_cprice"><?php usces_the_itemCpriceCr(); ?></span></div>
		<?php endif; ?>

			<div class="field_name"><?php _e('selling price', 'usces'); ?><?php usces_guid_tax(); ?></div>
			<div class="field_price"><span class="ss_price"><?php usces_the_itemPriceCr(); ?></span></div>
		</div>
		<div class="field"><?php _e('stock status', 'usces'); ?> : <span class="ss_stockstatus"><?php usces_the_itemZaikoStatus(); ?></span></div>
		<?php if( $item_custom = usces_get_item_custom( $post->ID, 'list', 'return' ) ) : ?>
		<div class="field"><?php echo $item_custom; ?></div>
		<?php endif; ?>
		
		<?php the_content(); ?>
	</div><!-- end of exp -->

	<form action="<?php echo USCES_CART_URL; ?>" method="post">
	<?php //usces_the_itemGpExp(); ?>

	<div class="skuform" id="skuform" align="right">

	<?php wcex_sku_select_form(); ?>

	<?php if (usces_is_options()) : ?>
		<table class='item_option'>
			<caption><?php _e('Please appoint an option.', 'usces'); ?></caption>
		<?php while (usces_have_options()) : ?>
			<tr><th><?php usces_the_itemOptName(); ?></th><td><?php usces_the_itemOption(usces_getItemOptName(),''); ?></td></tr>
		<?php endwhile; ?>
		</table>
	<?php endif; ?>
		<div class="zaiko_status itemsoldout"><span class="ss_stockstatus"><?php echo apply_filters('usces_filters_single_sku_zaiko_message', esc_html(usces_get_itemZaiko( 'name' ))); ?></span></div>
		<div style="margin-top:10px" class="c-box"><?php _e('Quantity', 'usces'); ?><?php usces_the_itemQuant(); ?><?php usces_the_itemSkuUnit(); ?><?php usces_the_itemSkuButton(__('Add to Shopping Cart', 'usces'), 0); ?></div>
		<div class="error_message"><?php usces_singleitem_error_message($post->ID, usces_the_itemSku('return')); ?></div>
		<div class="wcss_loading"></div>
	</div><!-- end of skuform -->
	<?php echo apply_filters('single_item_single_sku_after_field', NULL); ?>
	<?php do_action('usces_action_single_item_inform'); ?>
	</form>
	<?php do_action('usces_action_single_item_outform'); ?>

	<div class="itemsubimg">
<?php $imageid = usces_get_itemSubImageNums(); ?>
<?php foreach ( $imageid as $id ) : ?>
		<a href="<?php usces_the_itemImageURL($id); ?>" <?php echo apply_filters('usces_itemimg_anchor_rel', NULL); ?>><?php usces_the_itemImage($id, 135, 135, $post); ?></a>
<?php endforeach; ?>
	</div><!-- end of itemsubimg -->

<?php usces_assistance_item( $post->ID, __('An article concerned', 'usces') ); ?>

</div><!-- end of itemspage -->
</div><!-- end of storycontent -->
</div>

<?php else : ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

</div><!-- end of catbox -->
</div><!-- end of content -->

<?php get_sidebar( 'other' ); ?>

<?php get_footer(); ?>

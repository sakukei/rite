<?php
/**
 * @package Welcart
 * @subpackage Welcart_Basic
 */

$division = welcart_basic_get_item_division( $post->ID );
switch( $division ) :
case 'data':
	get_template_part( 'wc_templates/wc_item_single_data', get_post_format() );
	break;
case 'service':
	get_template_part( 'wc_templates/wc_item_single_service', get_post_format() );
	break;
default://shipped

get_header();
?>
<!--　TOP2カラム　-->
<div class="contents-column sku-select-column">
    <div id="primary" class="site-content">
        <div id="content" class="cf" role="main">

            <div class="column-wrap">

<!--    		<h1 class="item_page_title">--><?php //the_title(); ?><!--</h1>-->

                <div class="column">

                <?php if( have_posts() ) : the_post(); ?>

                    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

                        <div class="storycontent">

                        <?php usces_remove_filter(); ?>
                        <?php usces_the_item(); ?>
                        <?php usces_have_skus(); ?>

                            <div id="itempage">

                                <div id="img-box">

                                    <?php $imageid = usces_get_itemSubImageNums(); ?>
                                    <div class="slider slider-for itemimg">
                                        <div><a href="<?php usces_the_itemImageURL(0); ?>" <?php echo apply_filters( 'usces_itemimg_anchor_rel', NULL ); ?>><?php usces_the_itemImage( 0, 600, 600, $post ); ?></a></div>
                                        <?php foreach( $imageid as $id ) : ?>
                                        <div><a href="<?php usces_the_itemImageURL($id); ?>" <?php echo apply_filters( 'usces_itemimg_anchor_rel', NULL ); ?>><?php usces_the_itemImage( $id, 600, 600, $post ); ?></a></div>
                                        <?php endforeach; ?>
                                    </div>

                                    <?php if( !empty( $imageid ) ): ?>
                                    <div class="slider slider-nav itemsubimg">
                                        <div><?php usces_the_itemImage( 0, 150, 150, $post ); ?></div>
                                        <?php foreach( $imageid as $id ) : ?>
                                        <div><?php usces_the_itemImage( $id, 150, 150, $post ); ?></div>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>

                                </div><!-- #img-box -->

                                <div id="item-box">
                                    <div class="detail-box">
                                        <h1 class="item-name"><?php usces_the_itemName(); ?></h1>
    <!--									<div class="itemcode">--><?php //usces_the_itemCode(); ?><!--</div>-->

                                        <?php wcct_produt_tag(); ?>
                                        <?php welcart_basic_campaign_message(); ?>

                                        <?php if( 'continue' == welcart_basic_get_item_chargingtype( $post->ID ) ) : ?>
                                        <!-- Charging Type Continue shipped -->
                                        <div class="field">
                                            <table class="dlseller">
                                                <tr><th><?php _e('First Withdrawal Date', 'dlseller'); ?></th><td><?php echo dlseller_first_charging( $post->ID ); ?></td></tr>
                                                <?php if( 0 < (int)$usces_item['dlseller_interval'] ) : ?>
                                                <tr><th><?php _e('Contract Period', 'dlseller'); ?></th><td><?php echo $usces_item['dlseller_interval']; ?><?php _e('month (Automatic Updates)', 'welcart_basic'); ?></td></tr>
                                                <?php endif; ?>
                                            </table>
                                        </div>
                                        <?php endif; ?>
                                    </div><!-- .detail-box -->

                                    <div class="item-info">

                                        <?php if( $item_custom = usces_get_item_custom( $post->ID, 'list', 'return' ) ) : ?>
                                            <?php echo $item_custom; ?>
                                        <?php endif; ?>

                                        <form action="<?php echo USCES_CART_URL; ?>" method="post">

                                        <?php do { ?>
                                            <div class="skuform">
                                                <?php if( '' !== usces_the_itemSkuDisp('return') ) : ?>
                                                <div class="skuname"><?php usces_the_itemSkuDisp(); ?></div>
                                                <?php endif; ?>

                                                <?php usces_the_itemGpExp(); ?>

                                                <?php if( usces_is_options() ) : ?>
                                                <dl class="item-option">
                                                    <?php while( usces_have_options() ) : ?>
                                                    <dt><?php usces_the_itemOptName(); ?></dt>
                                                    <dd><?php usces_the_itemOption( usces_getItemOptName(), '' ); ?></dd>
                                                    <?php endwhile; ?>
                                                </dl>
                                                <?php endif; ?>

                                                <div class="field">

                                                    <div class="zaikostatus"><?php _e('stock status', 'usces'); ?> : <?php usces_the_itemZaikoStatus(); ?></div>

                                                    <?php if( 'continue' == welcart_basic_get_item_chargingtype( $post->ID ) ) : ?>
                                                    <div class="frequency"><span class="field_frequency"><?php dlseller_frequency_name($post->ID, 'amount'); ?></span></div>
                                                    <?php endif; ?>

                                                    <div class="field_price">
                                                    <?php if( usces_the_itemCprice('return') > 0 ) : ?>
                                                        <span class="field_cprice"><?php usces_the_itemCpriceCr(); ?></span>
                                                    <?php endif; ?>
                                                        <?php usces_the_itemPriceCr(); ?><?php usces_guid_tax(); ?>
                                                    </div>
                                                </div>

                                                <?php if( !usces_have_zaiko() ) : ?>
                                                    <?php if(wcct_get_options('inquiry_link_button')):?>
                                                    <div class="contact-item"><a href="<?php echo wcct_get_inquiry_link_url(); ?>"><i class="fa fa-envelope"></i><?php _e('Inquiries regarding this item' , 'welcart_basic_square'); ?></a></div>
                                                    <?php else: ?>
                                                    <div class="itemsoldout"><?php echo apply_filters( 'usces_filters_single_sku_zaiko_message', __('At present we cannot deal with this product.','welcart_basic') ); ?></div>
                                                    <?php endif; ?>
                                                <?php else : ?>

                                                <div class="c-box">
                                                    <span class="quantity"><?php _e('Quantity', 'usces'); ?><?php wcct_the_itemQuant_select(); ?><?php usces_the_itemSkuUnit(); ?></span>
                                                    <span class="cart-button"><?php usces_the_itemSkuButton( wcct_get_options('cart_button'), 0 ); ?></span>
                                                </div>
                                                <?php endif; ?>
                                                <div class="error_message"><?php usces_singleitem_error_message( $post->ID, usces_the_itemSku('return') ); ?></div>
                                            </div><!-- .skuform -->
                                        <?php } while ( usces_have_skus() ); ?>

                                            <?php do_action( 'usces_action_single_item_inform' ); ?>
                                        </form>
                                        <?php do_action( 'usces_action_single_item_outform' ); ?>

                                    </div><!-- .item-info -->
                                </div><!-- #item-box -->

                                <div id="tab">
                                    <ul class="tab-list cf">
                                        <li><?php _e('Product Details', 'welcart_basic_square'); ?></li>
                                        <?php if(wcct_get_options('review')): ?>
                                        <li><?php _e('Review', 'welcart_basic_square'); ?><span class="review-num">（ <?php echo get_comments_number(); ?> ）</span></li>
                                        <?php endif; ?>
                                    </ul>

                                    <div class="item-description tab-box">
                                        <?php the_content(); ?>
                                    </div>
                                    <?php if( wcct_get_options( 'review' ) ) comments_template( '/wc_templates/wc_review.php', false ); ?>
                                </div>

                                <?php usces_assistance_item( $post->ID, __('An article concerned', 'usces') ); ?>

                            </div><!-- #itemspage -->
                        </div><!-- .storycontent -->

                    </article>

                <?php else: ?>
                    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                <?php endif; ?>

                </div><!-- column -->
            </div><!-- column-wrap -->

    <!--		--><?php //get_sidebar('item'); ?>

        </div><!-- #content -->
    </div><!-- #primary -->
    <?php get_sidebar(); ?>
</div>


<?php get_footer(); ?>

<?php endswitch; ?>

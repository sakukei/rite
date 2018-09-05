<?php
/**
 * @package Welcart
 * @subpackage Welcart_Basic
 */

get_header();
?>
<!--　TOP2カラム　-->
<div class="contents-column sku-select-column">
    <div id="primary" class="site-content">
        <div id="content" role="main">

            <div class="column-wrap">

<!--                <h1 class="item_page_title">--><?php //the_title(); ?><!--</h1>-->

                <div class="column">

                <?php if( have_posts() ) : the_post(); ?>

                    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

                        <div class="storycontent">

                        <?php usces_remove_filter(); ?>
                        <?php usces_the_item(); ?>
                        <?php usces_have_skus(); ?>

                            <div id="itempage" class="service cf">

                                <div id="img-box">

                                    <div class="itemimg">
                                        <a href="<?php usces_the_itemImageURL(0); ?>" <?php echo apply_filters( 'usces_itemimg_anchor_rel', NULL ); ?>><?php usces_the_itemImage( 0, 335, 335, $post ); ?></a>
                                    </div>

                                    <?php
                                    $imageid = usces_get_itemSubImageNums();
                                    if( !empty( $imageid ) ):
                                    ?>
                                    <div class="itemsubimg">
                                    <?php foreach( $imageid as $id ) : ?>
                                        <a href="<?php usces_the_itemImageURL($id); ?>" <?php echo apply_filters( 'usces_itemimg_anchor_rel', NULL ); ?>><?php usces_the_itemImage( $id, 135, 135, $post ); ?></a>
                                    <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>

                                </div><!-- #img-box -->

                                <div id="item-box">
                                    <div class="detail-box">
                                        <h2 class="item-name"><?php usces_the_itemName(); ?></h2>
<!--                                        <div class="itemcode">(--><?php //usces_the_itemCode(); ?><!--)</div>-->

                                        <?php wcct_produt_tag(); ?>
                                        <?php welcart_basic_campaign_message(); ?>

                                        <?php if( 'continue' == dlseller_get_charging_type( $post->ID ) ) : ?>
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

                                        <form action="<?php usces_url('cart'); ?>" method="post">

                                        <?php do { ?>
                                            <div class="skuform">

                                                <?php if( '' !== usces_the_itemSkuDisp('return') ) : ?>
                                                <div class="skuname"><?php echo apply_filters( 'usces_filter_autocharge_price_label', usces_the_itemSkuDisp('return') ); ?></div>
                                                <?php endif; ?>

                                                <?php usces_the_itemGpExp(); ?>

                                                <?php if( usces_is_options() ) : ?>
                                                <dl class="item-option autocharge">
                                                    <?php while( usces_have_options() ) : ?>
                                                    <dt><?php usces_the_itemOptName(); ?></dt>
                                                    <dd><?php usces_the_itemOption(usces_getItemOptName(),''); ?></dd>
                                                    <?php endwhile; ?>
                                                </dl>
                                                <?php endif; ?>

                                                <div class="field">

                                                    <?php if( 'continue' == dlseller_get_charging_type( $post->ID ) ) : ?>
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
                                                    <span class="cart-button"><?php usces_the_itemSkuButton( wcct_get_options('cart_button'), 0 ); ?></span>
                                                </div>
                                                <?php endif; ?>
                                                <div class="error_message"><?php usces_singleitem_error_message( $post->ID, usces_the_itemSku('return') ); ?></div>
                                            </div><!-- .skuform -->
                                        <?php } while (usces_have_skus()); ?>

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


                </div><!-- .column -->
            </div><!-- .column-wrap -->

            <?php get_sidebar('item'); ?>

        </div><!-- #content -->
    </div><!-- #primary -->
    <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>

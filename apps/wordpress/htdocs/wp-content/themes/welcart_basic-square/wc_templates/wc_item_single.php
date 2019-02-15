<?php
/**
 * @package Welcart
 * @subpackage Welcart_Basic
 */

$division = welcart_basic_get_item_division($post->ID);
switch ($division) :
case 'data':
  get_template_part('wc_templates/wc_item_single_data', get_post_format());
  break;
case 'service':
  get_template_part('wc_templates/wc_item_single_service', get_post_format());
  break;
default://shipped

get_header();
?>
<!-- 記事の自動整形を無効にする -->
<?php remove_filter('the_content', 'wpautop'); ?>
<!-- 抜粋の自動整形を無効にする -->
<?php remove_filter('the_excerpt', 'wpautop'); ?>
<div class="p-content" role="main">

  <?php if (have_posts()) : the_post(); ?>

    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

      <div class="p-storycontent">

        <?php usces_remove_filter(); ?>
        <?php usces_the_item(); ?>
        <?php usces_have_skus(); ?>

        <div class="p-item-page">

          <!-- メインビジュアル -->
          <div class="p-item-hero">

            <?php $imageid = usces_get_itemSubImageNums(); ?>
            <h1 class="p-item-title"><?php the_title(); ?></h1>
            <div class="p-item-img">
              <a
                href="<?php usces_the_itemImageURL(0); ?>" <?php echo apply_filters('usces_itemimg_anchor_rel', NULL); ?>><?php usces_the_itemImage(0, 600, 600, $post); ?></a>
              <!--              --><?php //foreach ($imageid as $id) : ?>
              <!--                <a-->
              <!--                  href="--><?php //usces_the_itemImageURL($id); ?><!--" -->
              <?php //echo apply_filters('usces_itemimg_anchor_rel', NULL); ?><!-->
              <?php //usces_the_itemImage($id, 600, 600, $post); ?><!--</a>-->
              <!--              --><?php //endforeach; ?>
            </div>

            <!--            --><?php //if (!empty($imageid)): ?>
            <!--              <div class="itemsubimg">-->
            <!--                <div>--><?php //usces_the_itemImage(0, 150, 150, $post); ?><!--</div>-->
            <!--                --><?php //foreach ($imageid as $id) : ?>
            <!--                  <div>--><?php //usces_the_itemImage($id, 150, 150, $post); ?><!--</div>-->
            <!--                --><?php //endforeach; ?>
            <!--              </div>-->
            <!--            --><?php //endif; ?>

          </div>

          <!-- 商品購入導線ボタン -->
          <div class="p-item-buy" id="js-modal-open">
            <div class="p-item-buy-btn">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_item_add.svg" alt="商品追加アイコン">
            </div>
          </div>

          <!-- 商品購入導線モーダル -->
          <div class="p-modal-content p-item-box">
            <div class="p-item-box-inner">
              <?php wcct_produt_tag(); ?>
              <?php welcart_basic_campaign_message(); ?>
              <?php if ('continue' == welcart_basic_get_item_chargingtype($post->ID)) : ?>
                <!-- Charging Type Continue shipped -->
                <div class="field">
                  <table class="dlseller">
                    <tr>
                      <th><?php _e('First Withdrawal Date', 'dlseller'); ?></th>
                      <td><?php echo dlseller_first_charging($post->ID); ?></td>
                    </tr>
                    <?php if (0 < (int)$usces_item['dlseller_interval']) : ?>
                      <tr>
                        <th><?php _e('Contract Period', 'dlseller'); ?></th>
                        <td><?php echo $usces_item['dlseller_interval']; ?><?php _e('month (Automatic Updates)', 'welcart_basic'); ?></td>
                      </tr>
                    <?php endif; ?>
                  </table>
                </div>
              <?php endif; ?>
            </div><!-- .detail-box -->

            <div class="p-item-box-info">

              <?php if ($item_custom = usces_get_item_custom($post->ID, 'list', 'return')) : ?>
                <?php echo $item_custom; ?>
              <?php endif; ?>

              <form action="<?php echo USCES_CART_URL; ?>" method="post">

                <?php do { ?>
                  <div class="skuform">
                    <?php if ('' !== usces_the_itemSkuDisp('return')) : ?>
                      <div class="skuname"><?php usces_the_itemSkuDisp(); ?></div>
                    <?php endif; ?>

                    <?php usces_the_itemGpExp(); ?>

                    <?php if (usces_is_options()) : ?>
                      <dl class="item-option">
                        <?php while (usces_have_options()) : ?>
                          <dt><?php usces_the_itemOptName(); ?></dt>
                          <dd><?php usces_the_itemOption(usces_getItemOptName(), ''); ?></dd>
                        <?php endwhile; ?>
                      </dl>
                    <?php endif; ?>

                    <div class="p-item-box-head">
                      <div class="p-drawer-searchBar">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_search_bar.svg" alt="">
                      </div>
                      <h2 class="p-item-box-name"><?php usces_the_itemName(); ?></h2>
                      <!--                      <div class="zaikostatus">-->
                      <!--                        -->
                      <?php //_e('stock status', 'usces'); ?><!--: --><?php //usces_the_itemZaikoStatus(); ?>
                      <!--                      </div>-->

                      <?php if ('continue' == welcart_basic_get_item_chargingtype($post->ID)) : ?>
                        <div class="frequency">
                          <span class="field_frequency">
                            <?php dlseller_frequency_name($post->ID, 'amount'); ?>
                          </span>
                        </div>
                      <?php endif; ?>

                      <div class="p-item-box-price">
                        <!--                        --><?php //if (usces_the_itemCprice('return') > 0) : ?>
                        <!--                          <span class="p-item-cprice">-->
                        <?php //usces_the_itemCpriceCr(); ?><!--</span>-->
                        <!--                        --><?php //endif; ?>
                        <?php usces_the_itemPriceCr(); ?><?php //usces_guid_tax(); ?>
                      </div>
                    </div>

                    <?php if (!usces_have_zaiko()) : ?>
                      <?php if (wcct_get_options('inquiry_link_button')): ?>
                        <div class="contact-item">
                          <a href="<?php echo wcct_get_inquiry_link_url(); ?>">
                            <i class="fa fa-envelope"></i>
                            <?php _e('Inquiries regarding this item', 'welcart_basic_square'); ?>
                          </a>
                        </div>
                      <?php else: ?>
                        <div class="itemsoldout">
                          <?php echo apply_filters('usces_filters_single_sku_zaiko_message', __('At present we cannot deal with this product.', 'welcart_basic')); ?>
                        </div>
                      <?php endif; ?>
                    <?php else : ?>

                      <div class="p-item-box-quantity">
                        <div class="p-item-box-quantity-text">
                          <?php _e('Quantity', 'usces'); ?>
                        </div>
                        <?php wcct_the_itemQuant_select(); ?><?php usces_the_itemSkuUnit(); ?>
                      </div>
                      <div class="p-item-box-button">
                        <?php usces_the_itemSkuButton(wcct_get_options('cart_button'), 0); ?>
                      </div>
                    <?php endif; ?>
                    <div class="error_message">
                      <?php usces_singleitem_error_message($post->ID, usces_the_itemSku('return')); ?>
                    </div>
                  </div><!-- .skuform -->
                <?php } while (usces_have_skus()); ?>

                <?php do_action('usces_action_single_item_inform'); ?>
              </form>
              <?php do_action('usces_action_single_item_outform'); ?>

            </div><!-- .item-info -->
          </div><!-- #item-box -->

          <!--            <ul class="tab-list cf">-->
          <!--              <li>--><?php //_e('Product Details', 'welcart_basic_square'); ?><!--</li>-->
          <!--              --><?php //if (wcct_get_options('review')): ?>
          <!--                <li>-->
          <!--                  --><?php //_e('Review', 'welcart_basic_square'); ?>
          <!--                  <span class="review-num">（ --><?php //echo get_comments_number(); ?><!-- ）</span>-->
          <!--                </li>-->
          <!--              --><?php //endif; ?>
          <!--            </ul>-->

          <?php the_content(); ?>l
          <?php if (wcct_get_options('review')) comments_template('/wc_templates/wc_review.php', false); ?>

          <!-- ユーザー情報 -->
          <div class="p-user">
            <div class="p-user-iconWrap">
              <?php echo get_avatar(get_the_author_meta('ID'), '', '', '', array('class' => 'c-icon-user p-user-icon')); ?>
            </div>
            <p class="p-user_name"><?php echo get_the_author(); ?></p>
            <p class="p-user_description"><?php the_author_meta('description'); ?></p>
            <p class="c-account p-user_account">
              <a href="<?php the_author_meta('user_url'); ?>" class="c-account_link">
                <?php the_author_meta('nickname'); ?>
              </a>
            </p>
          </div>

          <!-- 関連商品 -->
          <div class="p-related">
            <?php usces_assistance_item($post->ID, __('An article concerned', 'usces')); ?>
          </div>

        </div><!-- .p-itemspage -->

      </div><!-- .p-storycontent -->

    </article>

  <?php else: ?>
    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
  <?php endif; ?>

  <?php get_footer(); ?>

  <?php endswitch; ?>

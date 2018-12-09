<?php
/**
 * @package Welcart
 * @subpackage Welcart_Basic
 */

global $usces; ?>

<aside id="secondary" class="widget-area cf" role="complementary">
  <p class="contents-title">カテゴリーから検索</p>

  <?php //if ( ! dynamic_sidebar( 'side-widget-area1' ) ): ?>
  <!--	--><?php
  //		//Default Welcart Category Widget
  //		$args = array(
  //			'before_widget' => '<section id="welcart_category-3" class="widget widget_welcart_category">',
  //			'after_widget' => '</section>',
  //			'before_title' => '<h3 class="widget_title">',
  //			'after_title' => '</h3>',
  //		);
  //		$Welcart_category =array(
  //			'title' => __('Item Category','usces'),
  //			'icon' => 1,
  //			'cat_slug' => 'itemgenre'
  //		);
  //		the_widget( 'Welcart_category', $Welcart_category, $args );
  //
  //		//Default Welcart Calendar Widget
  //		$args = array(
  //			'before_widget' => '<section id="welcart_calendar-3" class="widget widget_welcart_calendar">',
  //			'after_widget' => '</section>',
  //			'before_title' => '<h3 class="widget_title">',
  //			'after_title' => '</h3>',
  //		);
  //		$Welcart_calendar =array(
  //			'title' => __('Business Calendar','usces'),
  //			'icon' => 1,
  //		);
  //		the_widget( 'Welcart_calendar', $Welcart_calendar, $args );
  //	?>
  <?php //endif; ?>
  <section class="sidebar sidebar-item">
    <h3 class="sidebar-title">お買い物検索</h3>
    <ul class="sidebar-list">
      <li><a href="<?php get_stylesheet_directory_uri(); ?>/tag/fashion"><img
            src="<?php echo get_template_directory_uri(); ?>/images/sidebar-fashion.png" alt=""><span>ファッション</span></a>
      </li>
    </ul>
  </section>
  <section class="sidebar sidebar-area">
    <h3 class="sidebar-title">エリア検索</h3>
    <ul class="sidebar-list">
      <li><a href="<?php get_stylesheet_directory_uri(); ?>/tag/thailand"><img
            src="<?php echo get_template_directory_uri(); ?>/images/sidebar-thailand.png" alt="">タイ</a></li>
      <!--            <li><a href="--><?php //get_stylesheet_directory_uri(); ?><!--/tag/vietnam"><img src="-->
      <?php //echo get_template_directory_uri(); ?><!--/images/sidebar-vietnam.png" alt="">ベトナム</a></li>-->
      <!--            <li><a href="--><?php //get_stylesheet_directory_uri(); ?><!--/tag/hongkong"><img src="-->
      <?php //echo get_template_directory_uri(); ?><!--/images/sidebar-hongkong.png" alt="">香港</a></li>-->
      <!--            <li><a href="--><?php //get_stylesheet_directory_uri(); ?><!--/tag/taiwan"><img src="-->
      <?php //echo get_template_directory_uri(); ?><!--/images/sidebar-taiwan.png" alt="">台湾</a></li>-->
      <li><a href="<?php get_stylesheet_directory_uri(); ?>/tag/korea"><img
            src="<?php echo get_template_directory_uri(); ?>/images/sidebar-korea.png" alt=""><span>韓国</span></a></li>
      <li><a href="<?php get_stylesheet_directory_uri(); ?>/tag/bali"><img
            src="<?php echo get_template_directory_uri(); ?>/images/sidebar-bali.png" alt=""><span>バリ</span></a></li>
      <li><a href="<?php get_stylesheet_directory_uri(); ?>/tag/japan"><img
            src="<?php echo get_template_directory_uri(); ?>/images/sidebar-japan.png" alt=""><span>日本</span></a></li>
    </ul>
  </section>
  <section class="sidebar sidebar-contributor">
    <h3 class="sidebar-title">たびびと検索</h3>
    <ul class="sidebar-list">
      <li><a href="<?php get_stylesheet_directory_uri(); ?>/category/ayasuke_0516/"><img
            src="<?php echo get_template_directory_uri(); ?>/images/icon_hasegawa_aya.jpeg"
            alt=""><span>長谷川あや</span></a></li>
      <li><a href="<?php get_stylesheet_directory_uri(); ?>/category/hitostagram12"><img
            src="<?php echo get_template_directory_uri(); ?>/images/icon_yoshino_hitomi.jpg"
            alt=""><span>良野仁美</span></a></li>
      <li><a href="<?php get_stylesheet_directory_uri(); ?>/category/namiy_73"><img
            src="<?php echo get_template_directory_uri(); ?>/images/icon_namiy_73.jpg"
            alt=""><span>なみ</span></a></li>
      <li><a href="<?php get_stylesheet_directory_uri(); ?>/category/yuika"><img
            src="<?php echo get_template_directory_uri(); ?>/images/icon_yu_i_k_a.jpg"
            alt=""><span>yu.i.k.a</span></a></li>
      <li><a href="<?php get_stylesheet_directory_uri(); ?>/category/chiha6170"><img
            src="<?php echo get_template_directory_uri(); ?>/images/icon_chiha6710.jpg"
            alt=""><span>chiha</span></a></li>
      <li><a href="<?php get_stylesheet_directory_uri(); ?>/category/oayumi"><img
            src="<?php echo get_template_directory_uri(); ?>/images/icon_oayumi.jpg"
            alt=""><span>AYUMI</span></a></li>
    </ul>
  </section>
</aside><!-- #secondary -->

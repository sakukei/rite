</div><!-- .contents-column -->
</div><!-- .l-inner -->
</div><!-- #main -->

<?php if (!wp_is_mobile()): ?>

<?php endif; ?>

<section class="p-banner">
  <div class="p-banner-img">
    <a href="https://www.instagram.com/ritetravel/" target="_blank">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/banner_follow.png" alt="rite travel follow画像">
    </a>
  </div>  
</section>

<footer class="l-footer p-footer">

  <div class="p-footer-menu">

    <nav class="p-footer-nav">
      <ul class="p-footer-nav-list">
        <li>
          <a href="https://tayori.com/form/8efb7c3fbcb6b6d6cf6ab92d35f8bb1b7d053978" target="_blank"
             class="p-footer-link">お問い合わせ</a>
        </li>
      </ul>
      <input type="checkbox" id="p-footer-accordion-label" class="c-accordion-check p-footer-accordion-check"/>
      <label for="p-footer-accordion-label" class="c-accordion-label p-footer-accordion-label p-footer-link">会社概要・規約</label>
      <ul class="p-footer-nav-list-accordion">
        <li class="page-item footer-about">
          <a href="http://company.rite.co.jp/" target="_blank">会社概要</a>
        </li>
        <?php
        $page_c = get_page_by_path('usces-cart');
        $page_m = get_page_by_path('usces-member');
        $pages = "{$page_c->ID},{$page_m->ID}";
        wp_nav_menu(array('container' => 'ul', 'theme_location' => 'footer', 'exclude' => $pages, 'menu_class' => 'p-footer-menu-child'));
        ?>
      </ul>
    </nav>
    <p class="p-footer-copyright">&copy; 2019 rite inc.</p>

  </div>

</footer><!-- #colophon -->

</div><!-- wrapper -->


<?php wp_footer(); ?>
<script>
  jQuery(function ($) {
    // 関連商品にclass追加
    $('.p-related').find('h3').addClass('p-related-title');
    $('.p-related').find('ul').addClass('p-related-list');
    // 関連商品の文言変更
    $('.assistance_item').find('h3').html('関連おすすめ商品');
  });

  (function ($) {
    var $tabList = $(".tab-list li");
    var $tabContents = $(".tab-contents");
    $tabList.on("click", function () {
      var index = $(this).index();
      $tabList.removeClass("is-current");
      $tabContents.removeClass("is-current");
      $(this).addClass("is-current");
      $tabContents.eq(index).addClass("is-current");
    });
  })(jQuery);

  (function ($) {
    var hash = location.hash;
    //hashの中に#itemが存在するか確かめる
    if (hash.match(/^#item/)) {
      $(window).on('load', function () {
        var $tabList = $(".tab-list li");
        var $noViewtabList = $("li.no-view");
        var $tabContents = $(".tab-contents");
        var $noView = $(".no-view");
        $tabList.removeClass("is-current");
        $tabList.removeClass("select");
        $tabContents.removeClass("is-current");
        $noView.addClass("is-current");
        $noViewtabList.addClass("select");
      });
    }
  })(jQuery);
</script>
</body>
</html>

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
      <label for="p-footer-accordion-label"
             class="c-accordion-label p-footer-accordion-label p-footer-link">会社概要・規約</label>
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
  (function ($) {

    // 関連商品にclass追加
    $('.p-related').find('h3').addClass('p-related-title');
    $('.p-related').find('ul').addClass('p-related-list');
    // 関連商品の文言変更
    $('.assistance_item').find('h3').html('関連おすすめ商品');

    // TravellerのTabChange
    var $tabList = $(".p-tab-list li");
    var $tabContents = $(".p-tab-contents");
    $tabList.on("click", function () {
      var index = $(this).index();
      $tabList.removeClass("is-current");
      $tabContents.removeClass("is-current");
      $(this).addClass("is-current");
      $tabContents.eq(index).addClass("is-current");
    });

    // hashでファーストビューを出し分ける
    var hash = location.hash;
    //hashの中に#itemが存在するか確かめる
    if (hash.match(/^#item/)) {
      $(window).on('load', function () {
        var $tabList = $(".p-tab-list li");
        var $noViewtabList = $("li.no-view");
        var $tabContents = $(".p-tab-contents");
        var $noView = $(".no-view");
        $tabList.removeClass("is-current");
        $tabList.removeClass("select");
        $tabContents.removeClass("is-current");
        $noView.addClass("is-current");
        $noViewtabList.addClass("select");
      });
    }

    // 商品ページのモーダル
    $("#js-modal-open").click(function () {

      //キーボード操作などにより、オーバーレイが多重起動するのを防止する
      $(this).blur();	//ボタンからフォーカスを外す
      if ($(".p-modal-overlay")[0]) return false;		//新しくモーダルウィンドウを起動しない (防止策1)

      //オーバーレイを出現させる
      $("body").append('<div class="p-modal-overlay"></div>');
      $(".p-modal-overlay").fadeIn("slow");

      //コンテンツをセンタリングする
      centeringModalSyncer();

      //コンテンツをフェードインする
      $(".p-modal-content").fadeIn("slow");

      //[.p-modal-overlay]、または[.p-modal-close]をクリックしたら…
      $(".p-modal-overlay,p-modal-close").unbind().click(function () {

        //[.p-modal-content]と[.p-modal-overlay]をフェードアウトした後に…
        $(".p-modal-content,.p-modal-overlay").fadeOut("slow", function () {

          //[.p-modal-overlay]を削除する
          $('.p-modal-overlay').remove();

        });

      });

    });

    $(window).resize(centeringModalSyncer);

    //センタリングを実行する関数
    function centeringModalSyncer() {

      //画面(ウィンドウ)の幅、高さを取得
      var w = $(window).width();
      var h = $(window).height();

      // コンテンツ(.p-modal-content)の幅、高さを取得
      // jQueryのバージョンによっては、引数[{margin:true}]を指定した時、不具合を起こします。
//		var cw = $( ".p-modal-content" ).outerWidth( {margin:true} );
//		var ch = $( ".p-modal-content" ).outerHeight( {margin:true} );
      var cw = $(".p-modal-content").outerWidth();
      var ch = $(".p-modal-content").outerHeight();

      //センタリングを実行する
      $(".p-modal-content").css({"left": ((w - cw) / 2) + "px", "top": ((h - ch) / 2) + "px"});

    }

    const $searchIcon = $('#js-search');
    const $drawer = $('#js-drawer');
    const $close = $('.js-drawer-close');
    const $header = $('.p-header');
    $searchIcon.on('click', function() {
      $drawer.addClass('is-active');
      $header.css({'position': 'relative'});
    });
    $close.on('click', function() {
      $drawer.removeClass('is-active');
      $header.css({'position': ''});
    });





  })(jQuery);
</script>
</body>
</html>

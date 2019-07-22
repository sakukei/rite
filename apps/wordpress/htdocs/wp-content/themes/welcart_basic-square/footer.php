</div><!-- .contents-column -->
</div><!-- .l-inner -->
</div><!-- #main -->

<?php if (!wp_is_mobile()): ?>

<?php endif; ?>

<footer class="footer-footer-1Dvec6">
  <nav class="nav">
    <ul class="accordion">
      <li class="item"><a href="https://tayori.com/form/8efb7c3fbcb6b6d6cf6ab92d35f8bb1b7d053978"
                          target="_blank">お問い合わせ</a></li>
    </ul>
  </nav>
  <p class="copyright">© 2019 rite inc.</p></footer>

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
    const hash = location.hash;
    const regexpItem = /^#\/\#item/;
    //hashの中に#itemが存在するか確かめる
    if (hash.match(regexpItem)) {
      $(window).on('load', function () {
        const $tabList = $(".p-tab-list li");
        const $noViewtabList = $("li.js-noView");
        const $tabContents = $(".p-tab-contents");
        const $noView = $(".js-noView");
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
      // $(".p-modal-content").css({"left": ((w - cw) / 2) + "px", "top": ((h - ch) / 2) + "px"});

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

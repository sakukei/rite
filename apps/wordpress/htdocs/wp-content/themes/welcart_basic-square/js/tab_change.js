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

(function($) {
  var hash = location.hash;
  //hashの中に#itemが存在するか確かめる
  if(hash.match(/^#item\d+$/){
    var $tabList = $(".tab-list li");
    var $tabContents = $(".tab-contents");
    var $noView =$(".no-view");
    $tabList.removeClass("is-current");
    $tabContents.removeClass("is-current");
    $noView.addClass("is-current");
  }
})(jQuery);
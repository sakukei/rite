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
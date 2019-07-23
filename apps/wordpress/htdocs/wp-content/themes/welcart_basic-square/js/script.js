jQuery( function() {
  //カートに入れるボタンが押された時にgaのカスタムリンクでURLを送る
  jQuery('.skubutton').on('click',function(){
    ga('send','event', {
      eventCategory: 'Link',
      eventAction: 'click',
      eventLabel: location.href
    });
  });
  // jQuery('.to_customerinfo_button').val('会員登録せずに購入');
});



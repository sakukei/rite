jQuery( function() {
  //カートに入れるボタンが押された時にgaのカスタムリンクでURLを送る
  jQuery('.skubutton').on('click',function(){
    ga('send','event', {
      eventCategory: 'Link',
      eventAction: 'click',
      eventLabel: location.href
    });
  });
});





$(function () {
    $('.menu-trigger,.username').click(function () { //メニューボタンタップ後の処理
      // span
      $(this).toggleClass('active'); //クリックした要素に「.active」が無ければ要素を付与、あったら削除。
      $('.nav').css('display', 'block');//「.nav」要素の非表示を表示する
    
      // こっちがナビ用
    if ($(this).hasClass('active')) { //もしクリックした.menu-triggerに「.active」要素があれば
        $('.nav').addClass('active'); //「.active」要素を付与
      } else {//「.active」要素が無ければ
        $('.nav').removeClass('active'); //「.active」要素を外す
      }
  
    });
});


//モーダル表示
$(function () {
  $('.modal-open').each(function () {
    $(this).on('click', function () {
      //モーダルidの取得
      var target = $(this).data('target'); //クリックされたボタンのidを取得
      var modal = document.getElementById(target); //丸々コードを抽出
      // console.log(modal); //デバッグ用、コンソールに表示
      $(modal).fadeIn();//背景とモーダルをフェードイン
      $('.overlay').fadeIn();
      return false; //それ以降の処理は無効にする
    });
  });

  //背景を押すと消える
  $('.overlay').on('click', function () {
    $('.overlay, .modal-window').fadeOut();//背景とモーダルの消去
    return false;
  });
});

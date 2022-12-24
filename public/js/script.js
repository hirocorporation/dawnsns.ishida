$(function () {
  // タイトルをクリックすると
  $(".js-accordion-title").on("click", function () {
    // クリックした次の要素を開閉
    $(this).next().slideToggle(300);
    // タイトルにopenクラスを付け外しして矢印の向きを変更
    $(this).toggleClass("open", 300);
  });

});

// モーダル部分
// $(function () { //①
//   $('.modalopen').each(function () {
//     $(this).on('click', function () {
//       var target = $(this).data('target');

//       var modal = document.getElementById(target);
//       console.log(modal);
//       $(modal).fadeIn();
//       return false;
//     });
//   });
//   $('.modalClose,.fadein').on('click', function () {
//     $('.js-modal').fadeOut();
//     return false;
//   });
// });

// モーダル
$(function () {
  $('.modalopen').each(function () {
    $(this).on('click', function () {
      var target = $(this).data('target');
      var modal = document.getElementById(target);
      console.log(modal);
      $(modal).fadeIn();
      return false;
    });
  });
  $('#modal-overlay,.js-modal').on('click', function () {
    $('.js-modal').fadeOut();
  });

  $('.inner-content').on('click', function (e) {
    e.stopPropagation();
  });
});

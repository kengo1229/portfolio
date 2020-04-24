$(function(){

// ナビメニューの半透明化
  var targetHeight = $('.js-float-menu-target').height();
  $(window).on('scroll', function() {
    $('.js-float-menu').toggleClass('float-active', $(this).scrollTop() > targetHeight);
  });
// スクロールに対応したフェードイン
  $(window).scroll(function(){
    $('#profiele').each(function(){
      var imgPos = $(this).offset().top;
      var scroll = $(window).scrollTop();
      var windowHeight = $(window).height();
      if (scroll > imgPos - windowHeight + windowHeight/5){
        $(this).removeClass("container-hide").addClass("container-fadein");
      }
    });

    $('#skill').each(function(){
      var imgPos = $(this).offset().top;
      var scroll = $(window).scrollTop();
      var windowHeight = $(window).height();
      if (scroll > imgPos - windowHeight + windowHeight/5){
        $(this).removeClass("container-hide").addClass("container-fadein");
      }
    });

    $('#works').each(function(){
      var imgPos = $(this).offset().top;
      var scroll = $(window).scrollTop();
      var windowHeight = $(window).height();
      if (scroll > imgPos - windowHeight + windowHeight/5){
        $(this).removeClass("container-hide").addClass("container-fadein");
      }
    });

    $('#contact').each(function(){
      var imgPos = $(this).offset().top;
      var scroll = $(window).scrollTop();
      var windowHeight = $(window).height();
      if (scroll > imgPos - windowHeight + windowHeight/5){
        $(this).removeClass("container-hide").addClass("container-fadein");
      }
    });

  });
// ハンバーガーメニューをクリックした際のメニューの表示非表示
  $('.js-toggle-sp-menu').on('click', function () {
    $(this).toggleClass('active');
    $('.js-toggle-sp-menu-target').toggleClass('active');
  });

  $('.js-toggle-sp2-menu').on('click', function () {
    $('.js-toggle-sp-menu').toggleClass('active');
    $('.js-toggle-sp-menu-target').toggleClass('active');
  });



  // モーダルスライダー
  var currentItemNum = 1;
  var $sliderContainer = $('.slider__container');
  var sliderItemNum = $('.slider__item').length;
  var sliderItemWidth = $('.slider__item').innerWidth();
  var sliderContainerWidth = sliderItemWidth * sliderItemNum;
  var DURATION = 500;

$('.js-show-modal-slider').on('click', function(){
// クリックしたスライドの順番を取得
  var clickItemNum = $('.js-show-modal-slider').index(this) + 1;

  $sliderContainer.attr('style', 'width:' + sliderContainerWidth + 'px');
  var sliderClickWidth = (clickItemNum-1) * sliderItemWidth;
  $sliderContainer.animate({left: '-='+sliderClickWidth+'px'}, 0);
  currentItemNum = clickItemNum;
});

// スライド
$('.js-slide-next').on('click', function() {
  if(currentItemNum < sliderItemNum) {
    $sliderContainer.animate({left: '-='+sliderItemWidth+'px'}, DURATION);
    currentItemNum++
  }
});

$('.js-slide-prev').on('click', function () {
  if(currentItemNum > 1) {
    $sliderContainer.animate({left: '+='+sliderItemWidth+'px'}, DURATION);
    currentItemNum--;
  }
});

//モーダルの表示非表示
  $('.js-show-modal').on('click', function(){

    $('.js-show-modal-target').fadeIn();
    $('.js-show-modal-cover').fadeIn();
  });

  $('.js-hide-modal').on('click', function(){
    $('.js-show-modal-target').fadeOut();
    $('.js-show-modal-cover').fadeOut();
  });

  });

$(function(){

  $(window).scroll(function(){
    $('#skill').each(function(){
      var imgPos = $(this).offset().top;
      var scroll = $(window).scrollTop();
      var windowHeight = $(window).height();
      if (scroll > imgPos - windowHeight + windowHeight/5){
        $(this).addClass("js-scroll-show");
      }
    });

    $('#works').each(function(){
      var imgPos = $(this).offset().top;
      var scroll = $(window).scrollTop();
      var windowHeight = $(window).height();
      if (scroll > imgPos - windowHeight + windowHeight/5){
        $(this).addClass("js-scroll-show");
      }
    });

    $('#contact').each(function(){
      var imgPos = $(this).offset().top;
      var scroll = $(window).scrollTop();
      var windowHeight = $(window).height();
      if (scroll > imgPos - windowHeight + windowHeight/5){
        $(this).addClass("js-scroll-show");
      }
    });
  });

    $('.skillbar').skillBars({
    from: 0,	// バーの動くスタート位置
    speed: 4000,  // 動くスピード
    interval: 100, // 動き始めるまでの時間
  });

  $('#pagetop').click(function () {
        //id名#pagetopがクリックされたら、以下の処理を実行

        $("home,body").animate({scrollTop:0},'slow');
        return false;
    });
});

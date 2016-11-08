/* ===============================================================

top scripts

=============================================================== */

  window.onunload = function(){};

  var Top = function(){};

  Top = {
    bxslider : function(){
        $('.bxslider').bxSlider({
          minSlides: 2,
          maxSlides: 5,
          slideWidth: 170,
          slideMargin: 25,
          pager:false
        });
    }
  }

  $(function() {
    Top.bxslider();
  });

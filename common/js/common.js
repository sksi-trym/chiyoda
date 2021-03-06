/* ===============================================================

common scripts

=============================================================== */

  window.onunload = function(){};

  var g = {
    isSp:function(){ return ( g.winW() <= g.point )? true : false ; },// SP or PC
    winW:function(){ return $( window ).width(); },
    winH:function(){ return $( window ).height(); },
    winT:function(){ return $( window ).scrollTop(); },
    point: 768
  }

  var _ua = (function(u){
    return {
      Tablet:(u.indexOf("windows") != -1 && u.indexOf("touch") != -1 && u.indexOf("tablet pc") == -1)
        || u.indexOf("ipad") != -1
        || (u.indexOf("android") != -1 && u.indexOf("mobile") == -1)
        || (u.indexOf("firefox") != -1 && u.indexOf("tablet") != -1)
        || u.indexOf("kindle") != -1
        || u.indexOf("silk") != -1
        || u.indexOf("playbook") != -1,
      Mobile:(u.indexOf("windows") != -1 && u.indexOf("phone") != -1)
        || u.indexOf("iphone") != -1
        || u.indexOf("ipod") != -1
        || (u.indexOf("android") != -1 && u.indexOf("mobile") != -1)
        || (u.indexOf("firefox") != -1 && u.indexOf("mobile") != -1)
        || u.indexOf("blackberry") != -1
    }
  })(window.navigator.userAgent.toLowerCase());

  var Common = function(){};

  Common = {

    fadeAlpha : function(){

      $('.fadeAlpha').hover(function(){
        $(this).removeClass('out').addClass('over');
      },
      function(){
        $(this).removeClass('over').addClass('out');
      });

    },

    accordion : function(){

      $('.accordion').find('dt').not('.other').on("click", function() {
        $(this).toggleClass('active')
          .next('dd').slideToggle()
            .siblings('dd:visible').slideUp()
              .prev('dt').removeClass('active');

        if($(this).hasClass('active')){
          var on = $(this).find('img').attr('src').replace('_off','_on');
          $(this).find('img').attr('src', on);
        }else{
          var off = $(this).find('img').attr('src').replace('_on','_off');
          $(this).find('img').attr('src', off);
        }
      });

    },

    tab : function(){

      var $tab = $('div.inner');
      var $nav = $tab.find('.tabNav a');
      var $tabBody = $tab.find('.tabBody');

      $tabBody.not(':first').hide();
      $nav.eq(0).parent().addClass('active');

      $nav.click(function(){
        var $this = $(this);
        var targetTabId = $this.attr('href');

        $nav.parent().removeClass('active');
        $tabBody.hide();
        $this.parent().addClass('active');
        $(targetTabId).fadeIn(1000);

        return false;
      });

    },

    smoothScroll : function(){

      var path = location.pathname;

      if ( path == '/' ) {
        $('header nav,#footer-link').find('a').each(function() {
          var href = $(this).attr('href').replace(/\/(\#.*?)/, '$1');
          $(this).attr('href', href);
        });
      }

      headerH = $('header').outerHeight();

      $('a[href^="#"]').click(function() {
        $('html,body').animate({ scrollTop:
          $($(this).attr('href')).offset().top-headerH }, 'slow','swing');
          return false;
        });

    },

    pagetop : function(){

      //指定位置でstaticに
      var $elem = $(''),
          $content = $(''),
          $win = $(window);

          var contentTop = 0;

      function updatePosition(){
        contentTop = $content.offset().top + $elem.outerHeight();
      }

      function update(){
        if( $win.scrollTop() + $win.height() > contentTop ){
          $elem.addClass('static');
        } else if( $elem.hasClass('static') ){
          $elem.removeClass('static');
        }
      }

      $win.load(function(){
        updatePosition();
          update();
        })
        .resize(function(){
          updatePosition();
          update();
        })
        .scroll(function(){
          update();
        });


      $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
          $('.pagetop').fadeIn();
        } else {
          $('.pagetop').fadeOut();
        }
      });


    },

    currentNav : function(){

      var url = window.location.pathname;

      $('.nav.pg li a[href="'+url+'"]').parent().addClass('current');

      var url = url.replace(/\w*\.html$/,'');
      $('.nav.dr li a[href="'+url+'"]').parent().addClass('current');

      if ( $('.nrp li.current').size() > 0 ) {
        var $crimg = $('li.current').find("img[src*='_off']");
        $crimg.attr('src', $crimg.attr("src").replace(/_off/,'_on'));
      }

      /* CURRENT画像置換
      $('.nrp li').each(function(){

        var off = $(this).find('img').attr('src'),
             on = off.replace(/_off/, '_on');

       if ( $(this).hasClass('current') ) {
         $(this).find('img').attr('src', on);
       }

      });
      */

    },

    rollover : function(){

      $("img[src*='_on']").parents('li').addClass("current");

      $("img,input[type='image']").hover(function(){
        if ($(this).attr("src")){
          $(this).attr("src",$(this).attr("src").replace("_off.", "_on."));
        }
      },function(){
        if ($(this).attr("src") && !$(this).parents('li').hasClass("current") ){
          $(this).attr("src",$(this).attr("src").replace("_on.", "_off."));
        }
      });

    },

    popup : function(){

      $('.popup').click(function(){
        window.open(this.href, "WindowName","width=650,height=500,resizable=yes,scrollbars=yes");
        return false;
      });

    },

    resizeFnc : function(){

      //resizeFlag
      if ( g.isSp() ) {
        $('body').removeClass('pcview').addClass('spview');
      } else {
        $('body').removeClass('spview').addClass('pcview');
      }

      //SP Image changer
      if ( g.isSp() ) {

        var before = /pc_/,
            after = 'sp_';

        replaceImg();

      } else {

        var before = /sp_/,
            after = 'pc_';

        replaceImg();

      }

      function replaceImg(){
        $('img[src*=pc_],img[src*=sp_]').each(function(){
          var spImg = $(this).attr('src').replace(before, after);
          if( $(this).attr('src').match(before) ) {
            $(this).attr('src', spImg);
          }
        });
      }

    },

    //画像の有無を判断して置換
    getSpImg : function(){

      var pc = $(this).attr('src'),
          sp = pc.replace(/\/default\//, '/sphone/');

      $.get(sp, null, function(data, status) {

        $('img' + '[src="' + pc + '"]').attr('src', sp);

      });

    },

    altText : function(){

      $('.altText').each(function(){

        alt = $(this).find('img').attr('alt').replace(/\s{2}/, '<br>');
        $(this).prepend('<span class="sp">' + alt + '</span>');

      });

    },

    share : function(){

      var shareTitle = encodeURI($('title').html());
      var shareUrl = encodeURI(document.URL);
      var shareUrlComponent = encodeURIComponent(document.URL);
      $('.twitterShare a').attr("href", "http://twitter.com/share?url="+ shareUrl + "&text=" + shareTitle);
      $('.facebookShare a').attr("href", "http://www.facebook.com/sharer.php?u="+ shareUrl +"&t=" + shareTitle);
      $('.googleShare a').attr("href", "https://plus.google.com/share?url=" + shareUrl);
      $('.tumblrShare a').attr("href", "http://www.tumblr.com/share/link?&url=" + shareUrlComponent + "&name=" + shareTitle);
      $('.pinterestShare a').attr("href", " http://pinterest.com/pin/create/button/?url=" + shareUrl + "&media=画像URL" + shareTitle );
      $('.linkedinShare a').attr("href", "http://www.linkedin.com/shareArticle?mini=true&url=" + shareUrl + "&title=" + shareTitle);
      $('.lineShare a').attr("href", "http://line.me/R/msg/text/?" + shareTitle + shareUrl);
      $(".share a").click(function(){
        window.open(this.href, "social_window","width=600,height=600,resizable=yes,scrollbars=yes,toolbar=yes");
        return false;
      });

    },

    uaFnc : function(){

      if( _ua.Mobile || _ua.Tablet ){
        //スマホ OR タブレットの場合
      }

    },
    mmenu : function(){

          $header = jQuery('header');
          var nav = $header.find('nav').html();
          var logo = $header.find('#logo').html();

          jQuery('body').prepend('\
            <header class="sp">\
              <ul>\
                <li class="menuBtn"><a class="navToggle" href="#nav"><i class="fa fa-bars" aria-hidden="true"></i><i class="fa fa-times" aria-hidden="true"></i></a></li>\
                <li class="logo">' + logo + '</li>\
              </ul>\
              <div id="nav">\
                <div>\
                  <ul>' + nav + '</ul>\
                </div>\
              </div>\
            </header>'
          );

          var $menu = jQuery('#nav');

          $menu.mmenu({
            slidingSubmenus: false,
            "extensions": [
              "pagedim-black"
            ],
            offCanvas: {
              position: "right",
              zposition: "front"
            },
            classNames: {
              fixedElements: {
                fixed: "header"
              }
            }
          });


          var $mmenu = $menu.data( "mmenu" );

          $mmenu.bind('opened', function () {
            jQuery(function(){
              setTimeout(function(){
                jQuery('a[href="#nav"]').attr('href', '#nav-close');
              },500);
            });
          });

          $mmenu.bind('closed', function () {
            jQuery(function(){
              setTimeout(function(){
                jQuery('a[href="#nav-close"]').attr('href', '#nav');
              },500);
            });
          });

          jQuery(document).on('click', 'a[href="#nav-close"]', function(){
            $mmenu.close();
          });

          var $menu = $('#nav'),
          $html = $('html, body');
          var API = $menu.data( "mmenu" );


          var $anchor = false;
          $menu.find( 'li > a' ).on(
            'click',
            function( e )
            {
              $anchor = $(this);
            }
          );

          var api = $menu.data( 'mmenu' );
          api.bind( 'closed',
            function(){
              if ( $anchor ){
                var href = $anchor.attr( 'href' );
                $anchor = false;

                //  if the clicked link is linked to an anchor, scroll the page to that anchor
                if ( href.slice( 0, 1 ) == '#' ){
                  $html.animate({
                    scrollTop: $( href ).offset().top-60
                  });
                }
              }
            });
        }
  }

  $(function() {

    Common.smoothScroll();
    Common.accordion();
    Common.tab();
    Common.currentNav();
    Common.rollover();
    Common.popup();
    //Common.getSpImg();
    Common.altText();
    Common.share();
    Common.uaFnc();
    Common.mmenu();

    $(window).on('load resize', function(){

      Common.resizeFnc();

    });

  });

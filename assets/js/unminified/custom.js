jQuery(document).ready(function($){

/*------------------------------------------------
                BODY
------------------------------------------------*/
$('body').css({"display":"block"});

/*------------------------------------------------
                MENU
------------------------------------------------*/

$('.main-navigation ul li').click(function() {
    $('.main-navigation ul li').removeClass('current-menu-item');
    $(this).addClass('current-menu-item');
});

$('#sidr-left-top-button').sidr({
    name: 'sidr-left-top',
    timing: 'ease-in-out',
    speed: 500,
    side: 'left',
    source: '.left'
});

$('#sidr-right-top-button').sidr({
    name: 'sidr-right-top',
    timing: 'ease-in-out',
    speed: 500,
    side: 'right',
    source: '.right'
});


/*------------------------------------------------
                END MENU
------------------------------------------------*/

/*------------------------------------------------
                BACK TO TOP
------------------------------------------------*/

 $(window).scroll(function(){
    if ($(this).scrollTop() > 1) {
    $('.backtotop').css({bottom:"25px"});
    } else {
    $('.backtotop').css({bottom:"-100px"});
    }
    });
    $('.backtotop').click(function(){
    $('html, body').animate({scrollTop: '0px'}, 800);
    return false;
});
/*------------------------------------------------
                END BACK TO TOP
------------------------------------------------*/

/*------------------------------------------------
                SLICK SLIDER
------------------------------------------------*/
var $a = $('#main-slider .regular').data('effect');

$('#main-slider .regular').slick({
    cssEase: $a
});

$("#recent-classes-slider .regular").slick({
    responsive: [
    {
      breakpoint: 1200,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 767,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});

$('#client-testimonial-slider .regular').slick({
});
/*------------------------------------------------
                END SLICK SLIDER
------------------------------------------------*/



/*------------------------------------------------
              BLOG PORTFOLIO
------------------------------------------------*/
var $blogcontainer = $('.blog-portfolio'),
        colWidth = function () {
            var w = $blogcontainer.width(), 
                columnNum = 1,
                columnWidth = 0;
            if (w > 1200) {
                columnNum  = 2;
            } 
            else if (w > 700) {
                columnNum  = 2;
            } 
            else if (w > 300) {
                columnNum  = 1;
            }
            columnWidth = Math.floor(w/columnNum);
            $blogcontainer.find('.blog-item').each(function() {
                var $item = $(this),
                    multiplier_w = $item.attr('class').match(/item-w(\d)/),
                    multiplier_h = $item.attr('class').match(/item-h(\d)/),
                    width = multiplier_w ? columnWidth*multiplier_w[1]-0 : columnWidth-5,
                    height = multiplier_h ? columnWidth*multiplier_h[1]*1-5 : columnWidth*0.5-5;
                $item.css({
                    width: width,
                    height: height
                });
            });
            return columnWidth;
        }
                    
        function refreshWaypoints() {
            setTimeout(function() {
            }, 1000);   
        }
                    
        $('nav.portfolio-filter ul a').on('click', function() {
            var selector = $(this).attr('data-filter');
            $blogcontainer.isotope({ filter: selector }, refreshWaypoints());
            $('nav.portfolio-filter ul li').removeClass('active');
            $(this).parent().addClass('active');
            return false;
        });

        isotope = function () {
            $blogcontainer.isotope({
                resizable: true,
                itemSelector: '.blog-item',
                layoutMode : 'masonry',
                gutter: 20,
                masonry: {
                    columnWidth: colWidth(),
                    gutterWidth: 20
                }
            });
        };
    isotope();

    // Triggers re-layout on infinite scroll
    $( document.body ).on( 'post-load', function () {
        isotope();
        $('#two-column, #main').isotope( 'reloadItems' );
        isotope( 'relayout', true );
    });

/*------------------------------------------------
                END BLOG PORTFOLIO
------------------------------------------------*/


/*------------------------------------------------
                SECTIONS
------------------------------------------------*/
if($("#info-text").hasClass("section-removed")) {
    $("#info-text").removeClass("no-padding-bottom");
}

/*-----------------------------------------------
                  Gallery page 
-----------------------------------------------*/

$('.gallery .gallery-item .gallery-icon a').attr('data-lightbox', 'masonry');


/*-------------------------------------
               WOO COMMERCE 
---------------------------------------*/
$('.products').addClass('three-columns');


});



/*------------------------------------------------
            END JQUERY
------------------------------------------------*/




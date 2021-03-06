/**
 * @package Helix Ultimate Framework
 * @author JoomShaper https://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2018 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
*/

jQuery(function ($) {
    //button reviews
    $('.reviews_button').click(function(event){
        var tabTop=$(".tab-product").offset().top;
        $("html, body").animate({scrollTop:tabTop},1000);
        $('a[href=\'#reviews\']').trigger('click'); return false;
    });
    // Stikcy Header
    if ($('body').hasClass('sticky-header')) {
        var header = $('#sp-header');

        if($('#sp-header').length) {
            var headerHeight = header.outerHeight();
            var stickyHeaderTop = header.offset().top;
            var stickyHeader = function () {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > stickyHeaderTop) {
                    header.addClass('header-sticky');
                } else {
                    if (header.hasClass('header-sticky')) {
                        header.removeClass('header-sticky');
                    }
                }
            };
            stickyHeader();
            $(window).scroll(function () {
                stickyHeader();
            });
        }

        if ($('body').hasClass('layout-boxed')) {
            var windowWidth = header.parent().outerWidth();
            header.css({"max-width": windowWidth, "left": "auto"});
        }
    }
    // Resonsive Sidebar aside
    $(".open-sidebar").click(function(e){
        e.preventDefault();
        $(".sidebar-overlay").toggleClass("show");
        $(".sidebar-offcanvas").toggleClass("active");
        $("#close-sidebar").insertBefore('.filter-vm');
        $("#close-sidebar").insertBefore('.blog-search');
    });
      
    $(".sidebar-overlay").click(function(e){
        e.preventDefault();
        $(".sidebar-overlay").toggleClass("show");
        $(".sidebar-offcanvas").toggleClass("active");
    });
    $('#close-sidebar').click(function() {
        $('.sidebar-overlay').removeClass('show');
        $('.sidebar-offcanvas').removeClass('active');
        
    }); 
    // go to top
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.sp-scroll-up').fadeIn();
        } else {
            $('.sp-scroll-up').fadeOut(400);
        }
    });

    $('.sp-scroll-up').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

    // Preloader
    $(window).on('load', function () {
        $('.sp-preloader').fadeOut(500, function() {
            $(this).remove();
        });
    });
    //button reviews
    $('.reviews_button').click(function(event){
        var tabTop=$(".tab-product").offset().top;
        $("html, body").animate({scrollTop:tabTop},1000);
        $('a[href=\'#reviews\']').trigger('click'); return false;
    });
    //mega menu
    $('.sp-megamenu-wrapper').parent().parent().css('position', 'static').parent().css('position', 'relative');
    $('.sp-menu-full').each(function () {
        $(this).parent().addClass('menu-justify');
    });

    // Offcanvs
    $('#offcanvas-toggler').on('click', function (event) {
        event.preventDefault();
        $('.offcanvas-init').addClass('offcanvas-active');
    });

    $('.close-offcanvas, .offcanvas-overlay').on('click', function (event) {
        event.preventDefault();
        $('.offcanvas-init').removeClass('offcanvas-active');
    });
    
    $(document).on('click', '.offcanvas-inner .menu-toggler', function(event){
        event.preventDefault();
        $(this).closest('.menu-parent').toggleClass('menu-parent-open').find('>.menu-child').slideToggle(400);
    });
    
    //Tooltip
    $('[data-toggle="tooltip"]').tooltip();
    // Slideshow disaper and conflict with motools
    var carousel = jQuery('.carousel');
    if(carousel){
        if (typeof jQuery != 'undefined' && typeof MooTools != 'undefined' ) {
            Element.implement({
                slide: function(how, mode){
                    return this;
                }
            });
        }
    }
    // Article Ajax voting
    $('.article-ratings .rating-star').on('click', function (event) {
        event.preventDefault();
        var $parent = $(this).closest('.article-ratings');

        var request = {
            'option': 'com_ajax',
            'template': template,
            'action': 'rating',
            'rating': $(this).data('number'),
            'article_id': $parent.data('id'),
            'format': 'json'
        };

        $.ajax({
            type: 'POST',
            data: request,
            beforeSend: function () {
                $parent.find('.fa-spinner').show();
            },
            success: function (response) {
                var data = $.parseJSON(response);
                $parent.find('.ratings-count').text(data.message);
                $parent.find('.fa-spinner').hide();

                if(data.status)
                {
                    $parent.find('.rating-symbol').html(data.ratings)
                }

                setTimeout(function(){
                    $parent.find('.ratings-count').text('(' + data.rating_count + ')')
                }, 3000);
            }
        });
    });

    //  Cookie consent
    $('.sp-cookie-allow').on('click', function(event) {
        event.preventDefault();
        
        var date = new Date();
        date.setTime(date.getTime() + (30 * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();               
        document.cookie = "spcookie_status=ok" + expires + "; path=/";

        $(this).closest('.sp-cookie-consent').fadeOut();
    });

    //slider categories	
	var element = $('.block-hot-cate .owl-carousel'),
		$articleSlider = $(element);

	$articleSlider.on("initialized.owl.carousel", function () {
		$(".owl-controls", $articleSlider).insertBefore($articleSlider);
		$(".owl-dots", $articleSlider).insertAfter($(".owl-prev", $articleSlider));
		
	}); 	
	$articleSlider.owlCarousel({
		loop: false,
		margin: 30,
		dots: true,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1,
				nav: false
			},
			480: {
				items: 1,
				nav: false
			},
			768: {
				items: 3,
				nav: false
			},
			992: {
				items: 3,
				nav: false
			},
			1200: {
				items: 6,
				nav: false
			}
		}			
	})
});

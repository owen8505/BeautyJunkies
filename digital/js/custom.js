jQuery(function( $ ) {
	$(".single-nav a").tipsy({ gravity: "s" });
	$(".social a").tipsy({ gravity: "s" });
});


jQuery(function($){

	 $('#toggle-top').click(function() {
        $('#menu').slideToggle(400);
        $('#content').slideToggle(2);
        $(this).toggleClass("active");
 
        return false;
 
    });

    function mobileadjust() {
        
        var windowWidth = $(window).width();

        if( typeof window.orientation === 'undefined' ) {
             $('#menu').removeAttr('style');
        }

        if( windowWidth < 769 ) {
             $('#menu').addClass('mobile-menu');
        }
  
    }
    
    mobileadjust();

    $(window).resize(function() {
        mobileadjust();
    });



	$folioitems = $('#portfolio #portfolio-items');

	$folioitems.imagesLoaded(function(){
		$folioitems.isotope({
 			itemSelector : 'li',
 			filter: ( wpz_isHome ? ':nth-child(-n+6)' : '*' )
		});
	});

	if($('#portfolio-tags a.active').length <= 0) $('#portfolio-tags a[data-value="*"]').addClass('active');

	$('#portfolio-tags.iso-sort a').click(function(){
		var selector = $(this).attr('data-value');
		$('#portfolio-tags a').removeClass('active');
		$(this).addClass('active');
		$folioitems.isotope({ filter: selector });
		return false;
	});

	if(typeof wpz_currPage != 'undefined' && wpz_currPage < wpz_maxPages) {
		if($('#portfolio-items').length > 0) {
			$('#portfolio-items').after('<a id="load-more" href="#">Load More&hellip;</a>');
			$('#load-more').click(function(){
				if(wpz_currPage < wpz_maxPages) {
					$(this).text('Loading...');
					wpz_currPage++;
					$.get(wpz_pagingURL + wpz_currPage + '/', function(data){
						$newItems = $('#portfolio-items li', data);
						$newItems.imagesLoaded(function(){
							$folioitems.isotope('insert', $newItems);
						});

						if((wpz_currPage+1) < wpz_maxPages) {
							$('#load-more').text('Load More\u2026');
						} else {
							$('#load-more').animate({height:'hide', opacity:'hide'}, 'slow', function(){$(this).remove();});
						}
					});
				}
				return false;
			});
		} else {
			$('.navigation').after('<a id="load-more" href="#">Load More&hellip;</a>').remove();
			$('#load-more').click(function(){
				if(wpz_currPage < wpz_maxPages) {
					$(this).text('Loading...');
					wpz_currPage++;
					$.get(wpz_pagingURL.replace('%#%', wpz_currPage), function(data){
						$newItems = $('.posts', data);
						$newItems.addClass('hidden').css('display', 'none');
						$newItems.imagesLoaded(function(){
							$('.posts').last().after($newItems);
							$('.posts.hidden').show('slow');
						});

						if((wpz_currPage+1) < wpz_maxPages) {
							$('#load-more').text('Load More\u2026');
						} else {
							$('#load-more').animate({height:'hide', opacity:'hide'}, 'slow', function(){$(this).remove();});
						}
					});
				}
				return false;
			});
		}
	}

	 
	$('#menu a').on('click', function(e){ e.stopPropagation(); });

});

// jScroll 1.1 - William Duffy - http://www.wduffy.co.uk/jScroll
(function($){$.fn.jScroll=function(e){var f=$.extend({},$.fn.jScroll.defaults,e);return this.each(function(){var a=$(this);var b=$(window);var c=new location(a);b.scroll(function(){a.stop().animate(c.getMargin(b),f.speed)})});function location(d){this.min=d.offset().top;this.originalMargin=parseInt(d.css("margin-top"),10)||0;this.getMargin=function(a){var b=d.parent().height()-d.outerHeight();var c=this.originalMargin;if(a.scrollTop()>=this.min)c=c+f.top+a.scrollTop()-this.min;if(c>b)c=b;return({"marginTop":c+'px'})}}};$.fn.jScroll.defaults={speed:"slow",top:10}})(jQuery);
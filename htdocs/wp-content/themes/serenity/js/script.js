// ==============
// Tweet function
// ==============
var twt = jQuery('#tweet').attr('class');
jQuery("#tweet").tweet({
  avatar_size: 32,
  count: 2,
  username : twt,
  template: "{text} <br />{time}",
  loading_text: "searching twitter..."
}).bind("loaded", function() {
    jQuery(this).find("a").attr("target","_blank");
});

// ===============
// Slider function
// ===============
function slider(){

	//Main slider
	jQuery('#flexcarousel').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    itemWidth: 188,
    //itemMargin: 5 ,
    asNavFor: '#flexslider'
  });
   
  jQuery('#flexslider').flexslider({
    animation: "slide",
    controlNav: true,
    animationLoop: true,
    slideshow: true,
	slideshowSpeed: 5000,
	animationSpeed: 600,
    sync: "#flexcarousel"
  });
  
  // Thubnail
  jQuery('#flexcarousel-product').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    itemWidth: 115,
    asNavFor: "#flexslider-product"
  });
  
  jQuery('#flexslider-product').flexslider({
    animation: "slide",
    controlNav: true,
    animationLoop: true,
    slideshow: false,
    sync: "#flexcarousel-product"
  });

  // Brands
  jQuery('#flexcarousel-brands').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: true,
    slideshow: false,
    itemWidth: 180,
  });
  
  // Category
  jQuery('#flexcarousel-cat').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: true,
    slideshow: false,
    itemWidth: 145,
    itemMargin: 10,
  });
}

// ===================
// Navigation function
// ===================

function navWidth(){
	var nav = jQuery('.horizontal-nav ul li').not('.horizontal-nav ul li li'), 
	size = jQuery('.horizontal-nav ul li').not('.horizontal-nav ul li li').size(),
	percent = 100/size;
	nav.css('width', percent+'%').parent().show();
}

jQuery('.horizontal-nav ul li').mouseenter(function(){
	jQuery('ul', this).stop().slideDown('fast');
}).mouseleave(function(){
	jQuery('ul', this).stop().slideUp(150);
});

/* if (jQuery.browser.msie) {
	//Back off
} else {
	//What?
}; */

selectnav('nav', {
  label: 'Menu'
}); 

// ==========
// Google Map
// ==========

if (jQuery('#map').hasClass('gmap')) {
	jQuery('.gmap').mobileGmap();
}

// ============
// Initial load
// ============

jQuery(function(){

	// Hover effect for IOS
	var iOS = false,
    p = navigator.platform;
    
    if( p === 'iPad' || p === 'iPhone' || p === 'iPod' ){
	    iOS = true;
	    
		jQuery(function(){
			jQuery('.view-thumb').bind('hover', function(e){
				e.preventDefault();
				jQUery(this).toggleClass('hovere');
			});
		});    
	    
	}

	// Cart bubble
	jQuery('.counter a').on('click', function(){
		jQuery('.cartbubble').slideToggle();
	});

	jQuery('#closeit').on('click',function(e){
		e.preventDefault;
		jQuery('.cartbubble').slideUp();
	});
	
	// Tab function
	jQuery('#myTab a, #myTab button').click(function (e) {
		e.preventDefault();
		jQuery(this).tab('show');
	});
	
	// Fancybox function
	
	jQuery('a.zoom, a.show_review_form').fancybox();
	
	if (jQuery('body').hasClass('single-format-gallery')) {
		jQuery('.gallery-item a').attr('rel','gallery-thumb');
		jQuery('.gallery-item a').fancybox();
	}

	// Toggle function
	jQuery('.product h6.subhead').on('click', function(){
		jQuery('.query').slideToggle();
	});

	// Bootstrap collapse
    jQuery(".collapse").collapse();

    // Dotdotdot
    if (jQuery('#container').hasClass('container')) {
    	jQuery('.view-thumb p').dotdotdot({
    		watch: "window"
    	})
    }
    
    if (jQuery('body').hasClass('page-template-shop-full-php')) {
	    jQuery('.view-thumb p').dotdotdot({
    		watch: "window"
    	})
    }
    
    if (jQuery('body').hasClass('page-template-homepage-php')) {
	    jQuery('.view-thumb p').dotdotdot({
    		watch: "window"
    	})
    }
	
	slider();
	navWidth();

});
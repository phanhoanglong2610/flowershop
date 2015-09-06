/*-----------------------------------------------------------------------------------*/
/*	Loading to popup
/*-----------------------------------------------------------------------------------*/

jQuery(document).ready(function(jQuery) {
    jQuery('.blog-grid .post a').click(function(e){
        e.preventDefault();
        jQuery('.doc-title').text(jQuery(this).parent().parent().find('.title a').text());
        jQuery('.doc-head').html(jQuery(this).parent().parent().find('.frame').html());
        jQuery('.doc-content').html(jQuery(this).parent().parent().find('.post-content').html()).find('.hidden-text').removeClass('hidden-text').parent().find('.readmore').hide();
        jQuery('.doc-popup-shadow, .doc-popup').fadeIn();
    });
    
    jQuery('.doc-popup-shadow, .doc-close').click(function(){
        jQuery('.doc-popup-shadow, .doc-popup').fadeOut();
    });
    
    jQuery('.doc-head a').click(function(e){
        e.preventDefault();
    });
    
    jQuery('#tiny a').click(function(e){
        e.preventDefault();
        var href = jQuery(this).attr('href');
        var targetOffset = jQuery(href).offset().top;
        jQuery("html,body").stop().animate({
            scrollTop: targetOffset - 30
        }, 1000 );
    });
    
    jQuery('.movetop').click(function(e){
        e.preventDefault();
        jQuery("html,body").stop().animate({
            scrollTop: 0
        }, 500 );
    });
});	

/*-----------------------------------------------------------------------------------*/
/*	VIDEO
/*-----------------------------------------------------------------------------------*/

jQuery(document).ready(function(jQuery) {
    jQuery('.video').fitVids();
});	

    
/*-----------------------------------------------------------------------------------*/
/*	BUTTON HOVER
/*-----------------------------------------------------------------------------------*/

jQuery(document).ready(function(jQuery)  {
jQuery("a.button, .forms fieldset .btn-submit, #commentform input#submit").css("opacity","1.0");
jQuery("a.button, .forms fieldset .btn-submit, #commentform input#submit").hover(function () {
jQuery(this).stop().animate({ opacity: 0.85 }, "fast");  },
function () {
jQuery(this).stop().animate({ opacity: 1.0 }, "fast");  
}); 
});

/*-----------------------------------------------------------------------------------*/
/*	IMAGE HOVER
/*-----------------------------------------------------------------------------------*/		
		
jQuery(document).ready(function(jQuery) {	
jQuery('.quick-flickr-item').addClass("frame");
jQuery('.frame a').prepend('<span class="more"></span>');
});

jQuery(document).ready(function(jQuery) {
        jQuery('.frame').mouseenter(function(e) {

            jQuery(this).children('a').children('span').fadeIn(300);
        }).mouseleave(function(e) {

            jQuery(this).children('a').children('span').fadeOut(200);
        });
    });	

/*-----------------------------------------------------------------------------------*/
/*	MENU
/*-----------------------------------------------------------------------------------*/
ddsmoothmenu.init({
	mainmenuid: "menu",
	orientation: 'h',
	classname: 'menu',
	contentsource: "markup"
})
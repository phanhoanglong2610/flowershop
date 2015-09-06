// check for mobile (plugin)
(function(a){jQuery.browser.mobile=/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|meego.+mobile|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))})(navigator.userAgent||navigator.vendor||window.opera);

jQuery(document).ready(function($){

// MENU SCRIPT
$('#navigation .menu  li:has(ul)').children('a').addClass('has_ul').append('<span class="expand">+</span>');

   $('#navigation .menu   li:has(ul)').children('a').click(function() {
  
  	if (jQuery.browser.mobile == 1 || $('html').hasClass('touch') || $('html').hasClass('ie7')){
      $(this).next('ul').fadeToggle();}
    else {
      $(this).next('ul').slideToggle();
     } 
      $(this).toggleClass('active');
   
      var text = $('span', this).text() == '+' ? '-' : '+';
         $('span', this)
         .text(text)
      
      $('ul',$(this).parent().siblings()).fadeOut();
      return false;    
   });

   
// CHECK IF MENU > WINDOW HEIGHT AND MAKE POSITION ABSOLUTE INSTEAD OF FIXED
var w_h = $(window).height();
var n_h = $('.menu').height() + $('#logo').height() + 100; 

if (!(jQuery.browser.mobile == 1 || $('html').hasClass('touch'))) {
	if (n_h > w_h)
	{ $('#navigation, footer').css('position', 'absolute'); }
}


$(window).resize(function() {

var w_h = $(window).height();
var n_h = $('.menu').height() + $('#logo').height() + $('footer').height(); 

	if (!(jQuery.browser.mobile == 1 || $('html').hasClass('touch'))) {
		if (n_h > w_h)
		{ $('#navigation, footer').css('position', 'absolute'); }
		else {
//			 $('#navigation, footer').css('position', 'fixed');
		}
	}
});

$(window).trigger('resize');

// CONTACT FORM HANDLING SCRIPT - WHEN USER CLICKS "SUBMIT"
	
	$("#contactform #form_submit").click(function(){		
		   				 		
		$('.error').fadeOut().remove();
		$('.success').fadeOut();
	
		// remove "error" class from text fields
		$("#contactform input, #contactform textarea").focus(function() {
 			$(this).removeClass('error_input');
 			$(this).closest('p').find('.error').fadeOut().remove();
 			$(this).closest('p').find('label:not(.error)').fadeIn();
 			
		});

		// set variables
		var hasError = false;
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		
		var nameErrorText = '<label for="form_name" class="error">' + custom_var.nameError + '</label>';
		
		var emailErrorText = '<label for="form_email" class="error">' + custom_var.emailError + '</label>';
		
		var nameWrongText = '<label for="form_email" class="error">' + custom_var.emailWrong + '</label>';
		
		var messageErrorText = '<label for="form_message" class="comment_error error">' + custom_var.messageError + '</label>';
		
		
		// validate "name" field
		var nameVal = $("#form_name").val();
		
		
		var nameErrorText = '<label for="form_name" class="error">' + custom_var.nameError + '</label>';
		
		if(nameVal == '') {
			$("#form_name")
			.after(nameErrorText)
			.addClass('error_input')				  
			hasError = true;
			$("#form_name").parent().find('label:not(.error)').hide();			
		}
	
		// validate "e-mail" field - andd error message and animate border to red color on error
		var emailVal = $("#form_email").val();
		if(emailVal == '') {
			$("#form_email")
			.after(emailErrorText)
			.addClass('error_input')
			hasError = true; 
			
			$("#form_email").parent().find('label:not(.error)').hide();
				
		} else if(!emailReg.test(emailVal)) {	
			$("#form_email")
			.after(emailWrongText)
			.addClass('error_input')
			hasError = true;
			$("#form_email").attr("value", "");
			$("#form_email").parent().find('label:not(.error)').hide();
		}
		
				
		// validate "message" field
		var messageVal = $("#form_message").val();
		if(messageVal == '') {
			
			$("#form_message")
			.after(messageErrorText)
			.addClass('error_input')
			hasError = true;
			
			$("#form_message").parent().find('label:not(.error)').hide();
		}
		
                // if the are errors - return false
                if(hasError == true) { return false; }
            
		// if no errors are found - submit the form with AJAX
		if(hasError == false) {
			
		var dataString = $('#contactform').serialize();

		//hide the submit button and show the loader image	
		$('#loader').css('display', 'inline-block'); 
		$(this).fadeOut(); 
			       
			
		// make an Ajax request
        $.ajax({
            type: "POST",
            url: theme_path + "/php/contact-send.php",
            data: dataString,
            success: function(){ 
           
          // on success fade out the form and show the success message
          $('#loader').hide();
          $('.contact_info').fadeOut('fast');
          $('.success').fadeIn();
          $('#form_submit').fadeIn(); 
           
           
           
              	
            }
        }); // end ajax

		  
		} 	
		
		return false; 
		
	});		
	
	
	
	$("#commentform #submit").click(function(){	
	
	
		var nameVal = $("#form_name").val();
			if(nameVal == '') {
				$("#form_name")
				.after('<label for="form_name" class="error">Please enter your name</label>')
				.addClass('error_input')				  
				hasError = true;
				$("#form_name").parent().find('label:not(.error)').hide();	
			}
		
			// validate "e-mail" field - andd error message and animate border to red color on error
			var emailVal = $("#form_email").val();
			if(emailVal == '') {
				$("#form_email")
				.after('<label for="form_email" class="error">Please enter your e-mail</label>')
				.addClass('error_input')
				hasError = true; 
				
				$("#form_email").parent().find('label:not(.error)').hide();
					
			} else if(!emailReg.test(emailVal)) {	
				$("#form_email")
				.after('<label for="form_email" class="error">Please provide a valid e-mail</label>')
				.addClass('error_input')
				hasError = true;
				$("#form_email").attr("value", "");
				$("#form_email").parent().find('label:not(.error)').hide();
			}
			
					
			// validate "message" field
			var messageVal = $("#form_message").val();
			if(messageVal == '') {
				
				$("#form_message")
				.after('<label for="form_message" class="error comment_error">Please enter your message</label>')
				.addClass('error_input')
				hasError = true;
				
				$("#form_message").parent().find('label:not(.error)').hide();
			}
		
	
	
		});
	


/*global jQuery */
/*jshint multistr:true browser:true */
/*!
* FitVids 1.0
*
* Copyright 2011, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
* Date: Thu Sept 01 18:00:00 2011 -0500
*/

(function( $ ){

  $.fn.fitVids = function( options ) {
    var settings = {
      customSelector: null
    };

    var div = document.createElement('div'),
        ref = document.getElementsByTagName('base')[0] || document.getElementsByTagName('script')[0];

    div.className = 'fit-vids-style';
    div.innerHTML = '&shy;<style>         \
      .fluid-width-video-wrapper {        \
         width: 100%;                     \
         position: relative;              \
         padding: 0;                      \
      }                                   \
                                          \
      .fluid-width-video-wrapper iframe,  \
      .fluid-width-video-wrapper object,  \
      .fluid-width-video-wrapper embed {  \
         position: absolute;              \
         top: 0;                          \
         left: 0;                         \
         width: 100%;                     \
         height: 100%;                    \
      }                                   \
    </style>';

    ref.parentNode.insertBefore(div,ref);

    if ( options ) {
      $.extend( settings, options );
    }

    return this.each(function(){
      var selectors = [
        "iframe[src*='player.vimeo.com']",
        "iframe[src*='www.youtube.com']",
        "iframe[src*='www.kickstarter.com']",
        "object",
        "embed"
      ];

      if (settings.customSelector) {
        selectors.push(settings.customSelector);
      }

      var $allVideos = $(this).find(selectors.join(','));

      $allVideos.each(function(){
        var $this = $(this);
        if (this.tagName.toLowerCase() === 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) { return; }
        var height = ( this.tagName.toLowerCase() === 'object' || $this.attr('height') ) ? parseInt($this.attr('height'), 10) : $this.height(),
            width = $this.attr('width') ? parseInt($this.attr('width'), 10) : $this.width(),
            aspectRatio = height / width;
        if(!$this.attr('id')){
          var videoID = 'fitvid' + Math.floor(Math.random()*999999);
          $this.attr('id', videoID);
        }
        $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100)+"%");
        $this.removeAttr('height').removeAttr('width');
      });
    });
  };
})( jQuery );

$(".post").fitVids();


/**
 * jQuery Mobile Menu 
 * Turn unordered list menu into dropdown select menu
 * version 1.0(31-OCT-2011)
 * 
 * Built on top of the jQuery library
 *   http://jquery.com
 * 
 * Documentation
 * 	 http://github.com/mambows/mobilemenu
 */
(function($){
$.fn.mobileMenu = function(options) {
	
	var defaults = {
			defaultText: 'Navigate to...',
			className: 'select-menu',
			subMenuClass: 'sub-menu',
			subMenuDash: '&ndash;'
		},
		settings = $.extend( defaults, options ),
		el = $(this);
	
	this.each(function(){
		// ad class to submenu list
		el.find('ul').addClass(settings.subMenuClass);

		// Create base menu
		$('<select />',{
			'class' : settings.className
		}).insertAfter( el );

		// Create default option
		$('<option />', {
			"value"		: '#',
			"text"		: settings.defaultText
		}).appendTo( '.' + settings.className );

		// Create select option from menu
		el.find('a').each(function(){
			var $this 	= $(this),
					optText	= '&nbsp;' + $this.text(),
					optSub	= $this.parents( '.' + settings.subMenuClass ),
					len			= optSub.length,
					dash;
			
			// if menu has sub menu
			if( $this.parents('ul').hasClass( settings.subMenuClass ) ) {
				dash = Array( len+1 ).join( settings.subMenuDash );
				optText = dash + optText;
			}

			// Now build menu and append it
			$('<option />', {
				"value"	: this.href,
				"html"	: optText,
				"selected" : (this.href == window.location.href)
			}).appendTo( '.' + settings.className );

		}); // End el.find('a').each

		// Change event on select element
		$('.' + settings.className).change(function(){
			var locations = $(this).val();
			if( locations !== '#' ) {
				window.location.href = $(this).val();
			};
		});

	}); // End this.each

	return this;

};
})(jQuery);


$('#navigation .menu').mobileMenu();

var $fluid_items = $('.post').find('img,video,object');
$fluid_items.removeAttr('width');
$fluid_items.removeAttr('height');

});
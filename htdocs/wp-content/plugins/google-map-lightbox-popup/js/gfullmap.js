/*
GoogleMap LightBox Popup Front Script
*/

function generate_popup(){		
	jQuery('.createPopup').fadeOut().animate({
		height:'0%',
		width:'0%',
		top:'50%',
		left:'50%',
		visibility:'hidden',
	},0, function() {
		jQuery('.createPopup').parent('.gmbdm-dialog').fadeOut();
		jQuery('.createPopup').find('iframe').hide();
	});
}

jQuery('document').ready(function(){
 
	jQuery('.click_it').click(function(){
	
		var createp ='.'+ (jQuery(this).attr('class-value'));
		jQuery(createp).css({visibility:'visible'});
		jQuery(createp).show().animate({
			height:'100%',
			width:'100%',
			top:'0',
			left:'0',
		}, 0, function() {
			jQuery(createp).parent('.gmbdm-dialog').fadeIn();
			var Iframe = jQuery(createp).find('iframe');
			var src    = Iframe.attr('src');
			Iframe.attr('src', '');
			Iframe.attr('src', src);
			Iframe.load(function(){
				Iframe = jQuery(createp).find('iframe');
				Iframe.fadeIn();
			});
		});
		var map_val = (jQuery('.gmbdm-dialog').attr('data-map-height'))/2;
		var x = jQuery(window).height();
		var y= (x/2)- map_val;
		if(y < 0 ){y=0;}
		jQuery('.innerdiv').css({'display':'block','top': y, });
	});
	jQuery('.createPopup').click(function(){
		generate_popup();
	});
	jQuery('.innerdiv').click(function(e){
		e.stopPropagation();
	});
});

jQuery(document).keyup(function(e) { 
	if (e.keyCode == 27) {
		generate_popup();
	}
});

jQuery('.cf-close').click(function(e) { 
	generate_popup();        
});
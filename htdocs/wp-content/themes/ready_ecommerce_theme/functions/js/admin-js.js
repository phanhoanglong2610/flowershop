function scCancelColorPicker(){
  var oldColor = jQuery("#colorpicker").attr('old-color');
  if (oldColor) {
    jQuery.farbtastic("#colorpicker").setColor(oldColor);
    jQuery("#colorpicker").hide();
  }
}

jQuery(document).ready(function(){ 
    jQuery( "#rt_tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
    jQuery( "#rt_tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
    
    // change preview bg
	jQuery('a.body-change').click(function(event){
        event.preventDefault();
        var imgUrl = jQuery(this).attr('href');
        jQuery('#live-prev').css({'background-image':"url('"+imgUrl+"')", "background-attachment":"fixed", "background-position":"top center", "background-attachment":"fixed", "background-repeat":"repeat"});
        jQuery('#ready_bgimg').val('background-image:url('+imgUrl+'); background-attachment:fixed; background-position:0 50%; background-attachment:fixed; background-repeat:repeat;');
   });
   
   // headings font
	jQuery('#ready_google_font_name').change(function(){
        var selectors = '#prev-head p';
        var gFontVal = jQuery("option:selected", this).val();
		var gFontName = gFontVal.split(':');
		
		if (jQuery('head').find('link#gFontName-css').length < 1){
			jQuery('head').append('<link id="gFontName-css" rel="stylesheet" type="text/css" href="" />');
		}
		// We will remove this tag and recreate it each time as IE don't want to correct modify of style tag content
		jQuery('head').find('style#gFontStyles').remove();
		//if (jQuery('head').find('style#gFontStyles').length < 1){
		jQuery('head').append('<style id="gFontStyles" type="text/css">'+ selectors + ' { font-family:"' + gFontName[0] + '", "Trebuchet MS", Arial, "Helvetica CY", "Nimbus Sans L", sans-serif !important; }</style>');
		//}
		
		jQuery('link#gFontName-css').attr({href:'http://fonts.googleapis.com/css?family=' + gFontVal+'&subset=latin,cyrillic-ext'});
		//jQuery('style#gFontStyles').html(selectors + ' { font-family:"' + gFontName[0] + '", "Trebuchet MS", Arial, "Helvetica CY", "Nimbus Sans L", sans-serif !important; }');
		
    });
    
    // paragraph
	jQuery('#ready_content_font_name').change(function(){
		var pfontVal = jQuery("#ready_content_font_name option:selected").val();
		// We will remove this tag and recreate it each time as IE don't want to correct modify of style tag content
		jQuery('head').find('style#cFontStyles').remove();
		//if (jQuery('head').find('style#cFontStyles').length < 1){
			jQuery('head').append('<style id="cFontStyles" type="text/css"> #prev-content p { font-family:' + pfontVal + ' !important; } </style>');
		//}
		//jQuery('style#cFontStyles').text('#prev-content p { font-family:' + pfontVal + ' !important; }');
	});
    
    // Color picker. Farbtastic.

      jQuery("body").append("<div id='colorpicker'></div>");
      jQuery("#colorpicker").farbtastic(".colorpicker:first").prepend("<span class='ui-icon ui-icon-check'></span>");
      jQuery('.colorpicker').each(function(){
            jQuery.farbtastic("#colorpicker").linkTo(jQuery(this));
      });
      jQuery('.colorpicker').focus(function() {
            jQuery("#colorpicker").hide();
            jQuery.farbtastic("#colorpicker").linkTo(jQuery(this));
            jQuery("#colorpicker").attr('old-color', jQuery.farbtastic("#colorpicker").color);
            var offset = jQuery(this).offset();
            jQuery("#colorpicker").css('left', offset.left - 68).css('top', offset.top + 20).fadeIn(400);
            jQuery(this).attr('value', jQuery.farbtastic("#colorpicker").color);
      });
      jQuery("#colorpicker .ui-icon-check").click(function(){
            jQuery("#colorpicker").hide();
            var BgCol = jQuery(".colorpicker").css('background-color');
            jQuery('#live-prev').css({'background-color':BgCol});
      });
      jQuery('.colorpicker').live('click',function(){
            jQuery("#colorpicker").attr('old-color', jQuery.farbtastic("#colorpicker").color);
            jQuery("#colorpicker").show();
      });
      jQuery('.colorpicker').keydown(function(event) {
            // Esc.
            if (event.keyCode == 27) {scCancelColorPicker()}
            // Enter.
            if (event.keyCode == 13) {
              jQuery("#colorpicker .ui-icon-check").click();
              event.preventDefault();
            }
            // Space.
            if (event.keyCode == 32) {jQuery("#colorpicker").show();}
      });    
});
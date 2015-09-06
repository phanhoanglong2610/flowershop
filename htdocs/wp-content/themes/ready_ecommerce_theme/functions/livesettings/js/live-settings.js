jQuery(document).ready(function(){    				

    // change body bg
	jQuery('a.body-change').click(function(event){
        event.preventDefault();
        var imgUrl = jQuery(this).attr('href');
        jQuery('body').css({'background-image':"url('"+imgUrl+"')", "background-attachment":"fixed", "background-position":"top center", "background-attachment":"fixed", "background-repeat":"repeat"});
    });
    
    // headings font
	jQuery('#hfont').change(function(){
        var selectors = 'h1, h2, h3, .slider-text h2';
		var live = '#shop-name, .info-block em, .text-left';
        var gFontVal = jQuery("option:selected", this).val();
		var gFontName = gFontVal.split(':');
		if (jQuery('head').find('link#gFontName').length < 1){
			jQuery('head').append('<link id="gFontName" rel="stylesheet" type="text/css" href="" />');
		}
		if (jQuery('head').find('style#gFontStyles').length < 1){
			jQuery('head').append('<style id="gFontStyles" type="text/css"></style>');
		}
		jQuery('link#gFontName').attr({href:'http://fonts.googleapis.com/css?family=' + gFontVal+'&subset=latin,cyrillic-ext'});
		jQuery('style#gFontStyles').html(selectors + ', ' + live + ' { font-family:"' + gFontName[0] + '", "Trebuchet MS", Arial, "Helvetica CY", "Nimbus Sans L", sans-serif !important; }');
	});
    
    // paragraph
	jQuery('#pfont').change(function(){
		var pfontVal = jQuery("#pfont option:selected").val();
		if (jQuery('head').find('style#cFontStyles').length < 1){
			jQuery('head').append('<style id="cFontStyles" type="text/css"></style>');
		}
		jQuery('style#cFontStyles').text('body { font-family:' + pfontVal + ' !important; }');
	});
    
    jQuery("#handler").click(function(){
        if (jQuery(this).hasClass("close")){
            jQuery(this).removeClass("close");
            jQuery(this).addClass("edit");
            jQuery(this).parent().animate({
                left:'-187px'
            },300);
        } else {
            jQuery(this).removeClass("edit");
            jQuery(this).addClass("close");
            jQuery(this).parent().animate({
                left:'0px'
            },300);
        }
    });
    
    jQuery('#handler').parent().delay(1000).animate({left:'-187px'}, 300, function(){
		jQuery(this).find('#handler').removeClass('close').addClass('edit');
	});
    
    // colorpicker body background      
	jQuery('.style-picker #bgColor').parent('a').ColorPicker({
		onChange:function(hsb, hex, rgb){
			jQuery('.style-picker').find('#bgColor').css({backgroundColor:'#' + hex});
			jQuery('body').css({backgroundColor:'#' + hex});
		},
		onSubmit:function(hsb, hex, rgb, el){
			jQuery(el).find('#bgColor').css({backgroundColor:'#' + hex});
			jQuery(el).find('#bgColor').attr({title:hex});
			jQuery('body').css({backgroundColor:'#' + hex});
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow:function(){
		    var hex = jQuery('.style-picker').find('#bgColor').attr('title');
			jQuery(this).ColorPickerSetColor(hex); 
		}
	});
});
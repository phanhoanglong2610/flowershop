jQuery(document).ready(function($) {

// MAKING INPUTS SHOW IF FIELD IS FILLED

if($('#post_type_custom').is(':checked'))
{
$('#portfolio_custom_type, #_list_meta_metabox').fadeIn('fast');
}

$('#post_type_custom').click(function() {
	if($('#post_type_custom').is(':checked'))
	{
	$('#portfolio_custom_type, #_list_meta_metabox').fadeIn('100');
	}	
});	

$('#post_type_regular').click(function() {
	$('#portfolio_custom_type,  #_list_meta_metabox').fadeOut('100');	
});

$('.inputs input').not('#fullscreen_video').click(function() {
	$('.source, .hd_source').fadeOut('100');	
});

$('.inputs input').not('#lightbox_video').click(function() {
	$('.source').fadeOut('100');	
});

if($('#lightbox_video').is(':checked') || $('#fullscreen_video').is(':checked'))
{
$('.source').fadeIn('fast');
}

if($('#fullscreen_video').is(':checked'))
{$('.hd_source').fadeIn('fast');}

$('#lightbox_video, #fullscreen_video').click(function() {
	if($('#lightbox_video').is(':checked') || $('#fullscreen_video').is(':checked'))
	{
	$('.source').fadeIn('100');
	}	
});

$('#lightbox_video, #fullscreen_video').click(function() {
	if( $('#fullscreen_video').is(':checked'))
	{
	$('.hd_source').fadeIn('100');
	}	
});



$('.video_wrap_show').each(function(index) {
    
    if($(this).is(':checked'))
    {
    $(this).closest('div').find('.custom_video_wrap').css('display', 'block');
    }
    
});


$('.video_wrap_show').live("click", function() {

	if($(this).is(':checked'))
	{
	$(this).closest('div').find('.custom_video_wrap').slideDown('fast');
	}	
	else {
		$(this).closest('div').find('.custom_video_wrap').slideUp('fast');
	}
	
});	



});



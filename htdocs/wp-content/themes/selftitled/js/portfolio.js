jQuery(document).ready(function($) {

// if mobile
if (jQuery.browser.mobile == 1 || $('html').hasClass('touch'))
{
	// video links go to page on mobile
	$('.slides li').each(function() {
		var link2 = $(this).find('.nojs').attr('href');	
		$(this).find('a').attr('href', link2);	
	});
}

//if desktop
else {
	// fullscreen video 
		$('.fullscreen_video a.play_video_fullscreen').click(function(){
		$('a.close_video').fadeIn('fast');
		$('#mediaspace,  #mediaspace_wrapper').css('visibility', 'visible');
		return false;
	});
	
	
	$('.play_video_vimeo_fullscreen').click(function () {	
		//vimeo video
		var vimeo_link = $(this).attr('rel');
		$('.loading, a.close_video').fadeIn('fast');
		$('body').append('<div id="backgroundvimeo"><iframe frameborder="0" src="http://player.vimeo.com/video/' + vimeo_link + '?autoplay=1" webkitallowfullscreen="" allowfullscreen=""></iframe></div>');	
		return false;	
	});
	
	
	$('.play_video_youtube_fullscreen').click(function () {	
		//youtube video
		
		
		
		var yotube_link = $(this).attr('rel');
		$('.loading, a.close_video').fadeIn('fast');
		$('a.close_video').css('visibility', 'visible').css('z-index', '10000000000');
		$('body').append('<div id="backgroundvimeo"><iframe src="http://www.youtube.com/embed/' + yotube_link + '?wmode=transparent&autoplay=1" frameborder="0" allowfullscreen></iframe></div>');	
		return false;	
	});
	
		
		
		
	// close video
	$('a.close_video').click(function () {
		$('.loading, a.close_video').css('display', 'none');
		$('#mediaspace, #mediaspace_wrapper').css('visibility','hidden');
		$('#backgroundvimeo').remove();
		return false;	
	});
		
	// close player on complete	
	jwplayer('mediaspace').onComplete(function() {
		$('#mediaspace, #mediaspace_wrapper').css('visibility','hidden');
		$('.loading, a.close_video').css('display', 'none');
	 });
}	
// if desktop check ends	
		
});
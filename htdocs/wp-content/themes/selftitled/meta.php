<div class="meta">
	<!-- time -->
	<div class="time meta_info">&bull;<span><time datetime="<?php echo date(DATE_W3C); ?>" pubdate class="updated"><?php the_time('F jS, Y') ?></time></span></div>
	
	<!-- author -->
	<div class="meta_info">&bull;<span class="byline author vcard">
		<em<?php _e('by', 'selftitled'); ?></em> <?php the_author() ?></span></div>
		
	<!-- comments -->	
	<div class="meta_info">&bull;
	<?php comments_popup_link('0', '1', '%', 'comments-link', ''); ?></div>
	
</div>	
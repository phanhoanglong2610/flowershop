<?php global $wpalchemy_media_access; ?>

<?php while($mb->have_fields_and_multi('slides')): ?>

<?php $mb->the_group_open(); ?>


<?php $metabox->the_field('single_slide'); ?>
		<?php $wpalchemy_media_access->setGroupName('img-nn'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
		
		
		<?php if(!is_null($mb->get_the_value()))
		{
		
			$img_src = $mb->get_the_value();
			
			if(strpos($img_src,'jpg') !== false || strpos($img_src,'jpeg') !== false || strpos($img_src,'png') !== false)
			{
			echo '<img class="list_image" src="' . aq_resize($img_src, 600, 200) . '" height="200">';
			}
			else {
				echo '<img class="list_video" src="' . get_template_directory_uri() . '/images/play_icon.png" height="100">';
			}
			
		}	
		?>
	
	
	<label class="upload_label"><?php _e("Upload your portfolio item", "selftitled"); ?></label>	

		
		<a class="tooltip" href="#"><img src="<?php echo get_template_directory_uri(); ?>/lib/admin/css/images/help.png" alt="Help" width="16" /><span class="custom help_tooltip"><img class="help_image" src="<?php echo get_template_directory_uri(); ?>/lib/admin/css/images/help.png" alt="Help" /><?php _e("Upload your portfolio item: image (<strong>.jpg</strong> or <strong>.png</strong>) / YouTube link / Vimeo link / custom video (<em>recommended <strong>.mp4</strong> or <strong>m4v</strong> iOS compatible</em>)", "selftitled"); ?></span></a>

		<p class="upload_media">
			<?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
			<?php echo $wpalchemy_media_access->getButton(); ?>
		</p>	


<p>
<?php $mb->the_field('slide_title'); ?>

  <input type="text"  name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/><label class="left_margin"><?php _e("Title (for images, <em>optional</em>)", "selftitled"); ?> 
  </label>
</p>


<p>
<?php $mb->the_field('custom_video_portfolio'); ?>
<input type="checkbox" class="video_wrap_show" name="<?php $mb->the_name(); ?>" value="yes"<?php $mb->the_checkbox_state('yes'); ?>/><?php _e("Custom video?", "selftitled"); ?> 
</p>

<div class="custom_video_wrap">


<div class="custom_video">
	
 <label><?php _e("Upload custom video thumbnail", "selftitled"); ?> </label>	
 
 <a class="tooltip" href="#"><img src="<?php echo get_template_directory_uri(); ?>/lib/admin/css/images/help.png" alt="Help" width="16" /><span class="custom help_tooltip"><img class="help_image" src="<?php echo get_template_directory_uri(); ?>/lib/admin/css/images/help.png" alt="Help" /><?php _e("Since player doesn't create images automatically you need upload a thumbnail for video (<strong>.jpg</strong> or <strong>.png</strong>, 650px max width)", "selftitled"); ?></span></a>
 	
<p class="upload_media">

<?php $metabox->the_field('custom_video_thumb'); ?>
		<?php $wpalchemy_media_access->setGroupName('img-n2'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>

			<?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
			<?php echo $wpalchemy_media_access->getButton(); ?>
</p>

</div>
	
</div>


<a href="#" class="dodelete button"><?php _e('Remove', 'selftitled') ?></a>


<?php $mb->the_group_close(); ?>
<?php endwhile; ?>

	<p style="margin-bottom:15px; padding-top:5px;"><a href="#" class="docopy-slides copy-button button"><span><?php _e('Add slide', 'selftitled') ?></span></a></p>
	

<p class="submit_panel"><input type="submit" class="button-primary" value="<?php _e('Save Changes', 'selftitled') ?>" /></p>	
	
	
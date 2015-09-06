<?php global $wpalchemy_media_access; ?>

<label><?php _e("Upload your background image", "selftitled"); ?></label>

<a class="tooltip" href="#"><img src="<?php echo get_template_directory_uri(); ?>/lib/admin/css/images/help.png" alt="Help" width="16" /><span class="custom help_tooltip"><img class="help_image" src="<?php echo get_template_directory_uri(); ?>/lib/admin/css/images/help.png" alt="Help" /><?php _e("Upload your fullscreen background (<strong>.jpg</strong> or <strong>.png</strong>, <em>.jpg recommended</em>)", "selftitled"); ?></span></a>


<?php $metabox->the_field('background_source'); ?>
<?php $wpalchemy_media_access->setGroupName('img-nn'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>

		<p class="upload_media">
			<?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
			<?php echo $wpalchemy_media_access->getButton(); ?>
		</p>	
		
<p class="submit_panel"><input type="submit" class="button-primary" value="<?php _e('Save Changes', 'selftitled') ?>" /></p>			

<?php 

$query_images_args = array(
    'post_type' => 'attachment', 'post_mime_type' =>'image', 'post_status' => 'inherit', 'posts_per_page' => -1,
);

?>
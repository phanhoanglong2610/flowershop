<?php global $wpalchemy_media_access; ?>



<h4><?php _e("How it will be shown on portfolio page", "selftitled"); ?></h4>

 <?php $metabox->the_field('portfolio_single_type');

if(is_null($mb->get_the_value()))
	$mb->meta[$mb->name] = 'nothing';
?>

<div class="inputs">
<input type="radio" name="<?php $mb->the_name(); ?>" value="image"<?php echo ($mb->get_the_value() == 'image')?' checked="checked"':''; ?>/><?php _e("Image (no link)", "selftitled"); ?> 

<input type="radio" id="fullscreen_video" name="<?php $mb->the_name(); ?>" value="fullscreen_video"<?php echo ($mb->get_the_value() == 'fullscreen_video')?' checked="checked"':''; ?>/><?php _e("Fullscreen video", "selftitled"); ?> 

<input type="radio" id="lightbox_video" name="<?php $mb->the_name(); ?>" value="lightbox_video"<?php echo ($mb->get_the_value() == 'lightbox_video')?' checked="checked"':''; ?>/><?php _e("Lightbox video", "selftitled"); ?> 

<input type="radio" name="<?php $mb->the_name(); ?>" value="nothing"<?php echo ($mb->get_the_value() == 'nothing')?' checked="checked"':''; ?>/><?php _e("Link to post", "selftitled"); ?> 
</div>


<div class="source">
<?php $metabox->the_field('video_source'); ?>
		<?php $wpalchemy_media_access->setGroupName('img-nn'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>

		<p class="upload_media">
		<label>Upload video</label>
			<?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
		    <?php echo $wpalchemy_media_access->getButton(); ?>
		</p>	
</div>

<div class="hd_source">
<?php $metabox->the_field('hd_video_source'); ?>

		<?php $wpalchemy_media_access->setGroupName('img-nn-hd'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
	
		<p class="upload_media">
		<label>Upload HD video</label>
			<?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
		    <?php echo $wpalchemy_media_access->getButton(); ?>
		</p>	
</div>



<div class="portfolio_single_page">
 <?php $metabox->the_field('portfolio_single_page');

if(is_null($mb->get_the_value()))
	$mb->meta[$mb->name] = 'regular_post';
?>

<input type="radio" id="post_type_custom" name="<?php $mb->the_name(); ?>" value="portfolio_post"<?php echo ($mb->get_the_value() == 'portfolio_post')?' checked="checked"':''; ?>/><?php _e("Portfolio custom post type", "selftitled"); ?> 

<input type="radio" id="post_type_regular" name="<?php $mb->the_name(); ?>" value="regular_post"<?php echo ($mb->get_the_value() == 'regular_post')?' checked="checked"':''; ?>/><?php _e("Regular post", "selftitled"); ?> 
</div>



<div id="portfolio_custom_type">


<h4><?php _e("Show content?", "selftitled"); ?></h4>

<?php $mb->the_field('show_content'); ?>
<input type="checkbox" name="<?php $mb->the_name(); ?>" value="yes"<?php $mb->the_checkbox_state('yes'); ?>/><?php _e("Show content?", "selftitled"); ?> 

<h4><?php _e("Project details?", "selftitled"); ?></h4>

<?php $mb->the_field('show_project_details'); ?>
<input type="checkbox" name="<?php $mb->the_name(); ?>" value="yes"<?php $mb->the_checkbox_state('yes'); ?>/><?php _e("Show project details?", "selftitled"); ?> 

<a class="tooltip" href="#"><img src="<?php echo get_template_directory_uri(); ?>/lib/admin/css/images/help.png" alt="Help" width="16" /><span class="custom help_tooltip"><img class="help_image" src="<?php echo get_template_directory_uri(); ?>/lib/admin/css/images/help.png" alt="Help" /><?php _e("<em>example</em> <br /> Client : Google <br />  Date : 2012 <br />  What we have done: SEO <br /> etc.", "selftitled"); ?></span></a>


<?php while($mb->have_fields_and_multi('details')): ?>

<?php $mb->the_group_open(); ?>
<div class="project_detail">
<?php $mb->the_field('details_category'); ?>
<p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/> :  
<?php $mb->the_field('details_value'); ?><input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>


<a href="#" class="dodelete"><?php _e("Remove", "selftitled"); ?> </a>

</div>

<?php $mb->the_group_close(); ?>
<?php endwhile; ?>

	<p style="margin-bottom:45px; padding-top:5px;"><a href="#" class="docopy-details copy-button button"><span><?php _e("Add line", "selftitled"); ?> </span></a></p>
	

<!-- Tetimonials-->

<h4><?php _e("Show testimonials?", "selftitled"); ?></h4>

<?php $mb->the_field('show_testimonials'); ?>
<input type="checkbox" name="<?php $mb->the_name(); ?>" value="yes"<?php $mb->the_checkbox_state('yes'); ?>/><?php _e("Show testimonials?", "selftitled"); ?> 


<?php while($mb->have_fields_and_multi('testimonials')): ?>

<?php $mb->the_group_open(); ?>

<div class="testimonial_admin">

<div class="test_text">

<?php $metabox->the_field('single_testimonial'); ?>	
	
<label><?php _e("Testimonial text", "selftitled"); ?></label> 
<textarea type="text" name="<?php $mb->the_name(); ?>" /><?php echo strip_tags($mb->get_the_value()); ?></textarea>

</div>

<div class="test_details">

<p>
<?php $mb->the_field('testimonial_author'); ?>
   <label><?php _e("Testimonial author", "selftitled"); ?> 
   </label>
 <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
</p>

<p>
<?php $mb->the_field('testimonial_author_details'); ?>
   <label><?php _e("Author details (company, etc.)", "selftitled"); ?> 
   </label>
 <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
</p>

</div>

<a href="#" class="dodelete"><?php _e('Remove', 'selftitled'); ?></a>

</div>

<?php $mb->the_group_close(); ?>
<?php endwhile; ?>



	<p style="margin-bottom:15px; padding-top:5px;"><a href="#" class="docopy-testimonials copy-button button"><span><?php _e('Add Testimonial', 'selftitled'); ?></span></a></p>
	
</div> 

<p class="submit_panel"><input type="submit" class="button-primary" value="<?php _e('Save Changes', 'selftitled') ?>" /></p>	

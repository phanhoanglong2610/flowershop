<?php get_header(); 

// get options data
global $data;

$custom_404 = ($data['custom_404'] == TRUE) ? 'custom_error' : '';
 	

?>

<div id="wrapper" class="not_found_page">

	<h1 class="<?php echo $custom_404; ?>"><?php _e('Error 404 - page not found','selftitled'); ?></h1>
	
	<p><?php _e('Go', 'selftitled'); ?> <a href="<?php echo get_home_url(); ?>"><?php _e('back home', 'selftitled'); ?></a><?php _e(' or use the search form below', 'selftitled');?></p>

	<div class="search_404">
	<?php get_search_form(); ?>
	</div>

<?php // get_sidebar(); ?>

<?php get_footer(); ?>
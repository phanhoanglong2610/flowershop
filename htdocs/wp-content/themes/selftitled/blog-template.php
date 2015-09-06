<?php 

/* Template name: Blog */

get_header(); the_post(); ?>

<?php global $data;  // get theme options ?>

<!-- wrapper -->
<div id="wrapper">

	<?php if($data['show_title_blog']) {
	echo '<h1 class="big_title">' . get_the_title() . '</h1>';
	}?>
	
	<?php
	
	//set posts limit
	 
	if($data['posts_per_page'])
	{$limit = stripslashes($data['posts_per_page']);}
	else {
	$limit = 5;	
	}
	?>
	
	<?php
	
	//query posts
	
	 query_posts('posts_per_page=' . $limit . ' .&order=DESC&paged=' . get_query_var('paged')); ?>
	
	<?php 
	
	// get loop
	
	get_template_part('loop'); ?>
	
	<?php if($data['show_sidebar_blog'] == TRUE)
	{ 
	the_post(); // get post
	
	get_sidebar(); 
	} ?>	

<?php get_footer(); ?>
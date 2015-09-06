<?php 

get_header(); the_post(); ?>

<?php
// get options data
 global $data;  ?>

<div id="wrapper">

	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

	<?php /* If this is a category archive */ if (is_category()) { ?>
		<h1><?php _e('Archive for the &#8216', 'selftitled');
		single_cat_title(); 
		_e('&#8217; Category', 'selftitled'); ?></h1>

	<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h1><?php _e('Posts Tagged &#8216;', 'selftitled');
		single_cat_title(); 
		_e('&#8217;', 'selftitled'); ?></h1>

	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
	
		<h1><?php _e('Archive for ', 'selftitled');
		the_time('F jS, Y'); ?>
		</h1>

	<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		
		<h1><?php _e('Archive for ', 'selftitled');
		the_time('F, Y'); ?>
		</h1>

	<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h1><?php _e('Archive for ', 'selftitled');
		the_time(' Y'); ?>
		</h1>

	<?php /* If this is an author archive */ } elseif (is_author()) { ?>
	<h1><?php _e('Author Archive', 'selftitled'); ?></h1>

	<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h1 class="pagetitle"><?php _e('Blog Archives', 'selftitled'); ?></h1>
	
	<?php } ?>


	<?php 
	
	//set posts limit
	
	if($data['posts_per_page'])
	{ $limit = stripslashes($data['posts_per_page']); }
	else {
	$limit = 5;	
	}
	?>
	
	<?php 
	
	 if(have_posts())
	{
	
	// get loop 
	get_template_part('loop'); ?>
	
	<?php if($data['show_sidebar_blog'] == TRUE)
	{ 
	get_sidebar(); 
	} ?>

	}

<?php get_footer(); ?>
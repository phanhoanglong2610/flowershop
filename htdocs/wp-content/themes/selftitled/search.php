<?php 

get_header(); the_post();?>

<?php global $data;  // get theme options ?>

<div id="wrapper">

<!-- search heading -->
<h1 class="big_title"><span class="big_title_search"><?php _e('Search', 'selftitled'); ?></span><?php _e('Results', 'selftitled'); ?></h1>

<?php 

if($data['show_sidebar_blog'] == 0)
{ 
$blog_list_class = "no_sidebar";
}
else {
$blog_list_class = "with_sidebar";
} ?>

<div class="blog_list <?php echo $blog_list_class; ?>">

<?php $posts=query_posts($query_string . '&posts_per_page=-1'); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>



<!-- post -->
	<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

	<h2 class="blog_title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
	
	<!-- show metadata if enabled -->
		<?php if($data['metadata'] == TRUE)
			{
				get_template_part('meta');
			}	
		?>

	<!-- thumbnail -->
		<?php if ( has_post_thumbnail() ) { 

			if($data['thumb_link'] == "post") {
			echo '<a class="no_lightbox" href="' . get_permalink() . '">';	  
			}
			else {	
			 $full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
			echo '<a class="fancybox" rel="prettyPhoto[gallery]" href="' . $full_image_url[0]  . '">';
			}
			
			the_post_thumbnail( 'blog-thumb' );  
			echo '</a>';
				  
		} ?>

		<!-- content -->
		<div class="entry">
			<?php if ($data['enable_excerpts']) {
			echo the_excerpt(); 
			}
			else {
			echo the_content();
			} ?>
		</div>

		<!-- more link -->
		<a href="<?php echo get_permalink();?>" class="more-link">
			<?php if ($data['read_more']) {
				echo stripslashes($data['read_more']);
			}
			else {
				 _e('Read more &rarr;', 'selftitled'); 
			} ?>
		</a>

	</article>
	<!-- post ends -->

	<?php endwhile; ?>

		<?php else : ?>

		<h2><?php _e('No Posts Found', 'selftitled'); ?></h2>

	<?php endif; ?>


<?php
	
	// pagination 
	if($data['pagination']) {
	
		// older / newer posts
		if($data['pagination'] == "Older / Newer posts") {
			
			$prev_link = get_previous_posts_link(__('Newer Entries &raquo;', 'selftitled'));
			$next_link = get_next_posts_link(__('&laquo; Older Entries', 'selftitled'));
	
			if ($prev_link || $next_link || $prev_link && $next_link) {
			  echo '<div id="pagination" class="pagination_words">';
				  if ($next_link){
				    echo '<div class="prev-posts">'. $next_link .'</div>';
				  }
				  
				  if($prev_link && $next_link){
				  	echo '<span class="bullet">&bull;</span>';
				  }
				  
				  if ($prev_link){
				    echo '<div class="next-posts">'. $prev_link .'</div>';
				  }
				  
				  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				  $pages = $wp_query->max_num_pages;	
					
				   echo '<p class="page_amount">'. __( 'Page ', 'selftitled' ) . $paged.  __( ' of ', 'selftitled' ) .$pages.'</p>'; 
				  
			  echo '</div>';
			}
		?>
		 
	<?php  
	}
		
	// numbers (1, 2, 3, 4, 5)	
	elseif($data['pagination'] == "Page numbers like 1, 2, 3, 4, 5...") {
		
		pagination();
		
		}
	}
	
	// if no pages
	else {
		// display nothing
	}
	  ?>
	  
</div>
<!-- blog list ends -->


<?php if($data['show_sidebar_blog'] == TRUE)
{ 
get_sidebar(); 
} ?>

<?php get_footer(); ?>

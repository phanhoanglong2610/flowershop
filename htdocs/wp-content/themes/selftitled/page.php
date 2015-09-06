<?php get_header();?>

<!-- wrapper -->
<div id="wrapper">

<?php 
	$sidebar = ($data['show_sidebar_page'] == TRUE) ? '' : 'no_sidebar';
?> 	
	
	<!-- heading -->
	<h2 class="post_head"><?php the_title(); ?></h2>
	
	
	<!-- main -->
	<div id="main">
	
	<!-- article -->	
	<article class="post <?php echo $sidebar; ?>" id="post-<?php the_ID(); ?>">
	
		<!-- show meta if enabled --> 
		<?php if($data['metadata_page'] == TRUE)	
		{
			get_template_part('meta');
		}	
		?>

		<!-- content --> 
		<div class="entry">
			<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
			<?php the_content(); ?>
			<?php endwhile; ?>
			<?php endif; ?>
			<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
		</div>

		<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
	
	 	<!-- show comments if enabled -->
		<?php if( $data['comments_page'] == TRUE) 
		{
		comments_template(); 		
		} ?>

	</article>
	<!-- article ends -->

<!-- show sidebar if enabled --> 
<?php if($data['show_sidebar_page'])
{
get_sidebar(); 
}  
?>

	</div>
	<!-- main ends -->

<?php get_footer(); ?>

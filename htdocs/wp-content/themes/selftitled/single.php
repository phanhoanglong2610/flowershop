<?php get_header(); the_post();?>

<!-- wrapper -->
<div id="wrapper">
		
	<!-- add class for sidebar if enabled -->		
	<?php $sidebar = ($data['show_sidebar_single'] == TRUE) ? '' : 'no_sidebar'; ?> 		
		
	<h2 class="post_head"><?php the_title(); ?></h2>	
		
	<!-- main -->
	<div id="main">	
		
	<!-- article -->		
	<article class="post <?php echo $sidebar; ?>" id="post-<?php the_ID(); ?>">

		<!-- show meta if enabled -->
		<?php if($data['metadata_post'] == TRUE)	
			{
				get_template_part('meta');
			}	
		?>

		<!-- content -->
		<div class="entry">

			<?php the_content(); ?>

			<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>

		</div>

		<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
	
		<?php if( $data['comment_post'] == TRUE) 
		{
		comments_template();  		
		} ?>

	</article>

<!-- show sidebar if enabled -->
<?php if($data['show_sidebar_single'])
{
get_sidebar(); 
}  
?>

	</div>
	<!-- main ends -->

<?php get_footer(); ?>

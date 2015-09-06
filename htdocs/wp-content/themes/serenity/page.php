<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package humbleshop
 * @since humbleshop 1.0
 */

get_header(); ?>

<!-- ============= -->
<!-- PAGE TEMPLATE -->
<!-- ============= -->

<div class="container">
	<section class="page">
		
		<div class="row">
			<header class="span12 prime">
				<h3><?php the_title() ?></h3>
			</header>
		</div>

		<div class="wrap">
			<div class="row-fluid">
				
				<?php 
					$sidebar = ot_get_option( 'hs_sidebarpage' ); 
					if ($sidebar == 1) { ?>
					<!-- Sidebar -->
					<div class="span4">
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>

				<!-- Content -->
				<?php if ($sidebar == 0) { ?>
					<div class="span12">	
					<?php } else { ?>
					<div class="span8">
				<?php } ?>
				
					<?php while ( have_posts() ) : the_post(); ?>

						<div class="content clearfix">
							<?php the_content(); ?>
						</div>
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'humbleshop' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'humbleshop' ), ' <p class="tcenter"><i class="icon-pencil"></i>', '</p>' ); ?>

						<div class="comments clearfix">
						
						<?php
							// If comments are open or we have at least one comment, load up the comment template
							if ( comments_open() || '0' != get_comments_number() )
								echo '<hr>';
								comments_template( '', true );
						?>	
						</div>

					<?php endwhile; // end of the loop. ?>					
				</div>

				<?php if ($sidebar == 2) { ?>
					<!-- Sidebar -->
					<div class="span4">
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
			
			</div>
		</div>

	</section>
</div>
<?php get_footer(); ?>
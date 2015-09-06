<?php
/*
Template Name: Full Width
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

				<!-- Content -->
				<div class="span12">	
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
			
			</div>
		</div>

	</section>
</div>
<?php get_footer(); ?>
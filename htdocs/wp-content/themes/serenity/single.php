<?php
/**
 * The Template for displaying all single posts.
 *
 * @package humbleshop
 * @since humbleshop 1.0
 */

get_header(); ?>

<!-- =========== -->
<!-- SINGLE PAGE -->
<!-- =========== -->

<div class="container">

	<?php while ( have_posts() ) : the_post(); ?>

	<section class="blog">

		<div class="row">
			<header class="span12 prime">
				<h3><?php the_title(); ?></h3>
				<p class="catmeta">
					<span class="date">
					<i class="icon-calendar"></i> <?php the_date(); ?> 
					<i class="icon-bookmark"></i> <?php the_category(', '); ?>
					</span>
				</p>
				<p class="catmeta">
					<?php $tag = get_the_tags(); if ($tag) { ?>
					<i class="icon-tag"></i> <?php the_tags('',',',''); ?>
					<?php } ?>
				</p>
			</header>
		</div>

		<div class="wrap">
			<div class="row-fluid post">
				
				<?php 
					$sidebar = ot_get_option( 'hs_sidebarblog' ); 
					if ($sidebar == 1) { ?>
					<!-- Sidebar -->
					<div class="span4">
						<div class="sidebar">
						<?php if ( ! dynamic_sidebar( 'sidebar-2' ) ) : ?>
							
							<aside id="archives" class="widget ">
								<h5>No widget in 'Post Sidebar' panel</h5>
								Add some <a href="<?php echo home_url(); ?>/wp-admin/widgets.php">here</a>
							</aside>

						<?php endif; // end sidebar widget area ?>	
						</div>
					</div>
				<?php } ?>

				<?php if ($sidebar == 0) { ?>
					<div class="span12">	
					<?php } else { ?>
					<div class="span8">
				<?php } ?>
					
					<div class="content clearfix">
						
						<?php the_content(); ?>
					</div>

					<?php edit_post_link( __( 'Edit', 'humbleshop' ), ' <p class="tcenter"><i class="icon-pencil"></i>', '</p>' ); ?>
					<hr>
				
					<!-- Social Share -->
					<div class="share">
						<a target="_blank" href="http://twitter.com/home?status=<?php the_title(); ?> - <?php the_permalink(); ?>" title="Click to share this post on Twitter">Twitter</a>
						<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(the_permalink()); ?>&t=<?php echo urlencode(the_title()); ?>">Facebook</a>
						<a target="_blank" href="http://pinterest.com/pin/create/button?url=<?php echo urlencode(the_permalink()); ?>&media=<?php echo catch_that_image() ?>&description=<?php echo urlencode(the_title()); ?>">Pinterest</a>  
						<a target="_blank" href="https://plus.google.com/share?url=<?php echo urlencode(the_permalink()); ?>">Google</a>
						<a target="_blank" href="mailto:me?subject=<?php echo urlencode(the_title()); ?>&body=<?php echo urlencode(the_permalink()); ?>">Email</a>
					</div>

					<hr>

					<!-- Navigation -->
					<div class="navigate clearfix">
						<div class="pull-left"><?php previous_post_link('&larr; %link'); ?></div>
						<div class="pull-right"><?php next_post_link('%link &rarr;'); ?></div>
					</div>

					<hr>

					<div class="comments">
						<?php
							// If comments are open or we have at least one comment, load up the comment template
							if ( comments_open() || '0' != get_comments_number() )
								comments_template( '', true );
						?>
					</div>
				</div>

				<?php if ($sidebar == 2) { ?>
					<!-- Sidebar -->
					<div class="span4">
						<div class="sidebar">
						<?php if ( ! dynamic_sidebar( 'sidebar-2' ) ) : ?>
							
							<aside id="archives" class="widget ">
								<h5>No widget in 'Post Sidebar' panel</h5>
								Add some <a href="<?php echo home_url(); ?>/wp-admin/widgets.php">here</a>
							</aside>

						<?php endif; // end sidebar widget area ?>	
						</div>
					</div>
				<?php } ?>	
			</div>
		</div>		

	</section>

	<?php endwhile; // end of the loop. ?>

</div>

<?php get_footer(); ?>
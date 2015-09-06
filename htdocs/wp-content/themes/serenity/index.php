<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package humbleshop
 * @since humbleshop 1.0
 */

get_header(); ?>

<!-- ============ -->
<!-- MAIN CONTENT -->
<!-- ============ -->

<div class="container">
	<section class="blog">

		<div class="wrap bloglist">
			<div class="row-fluid">
			
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
					<div class="span12 list">	
					<?php } else { ?>
					<div class="span8 list">
				<?php } ?>

				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<article id="clearfix post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<h4>
								<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'humbleshop' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
							<?php 
							if ( has_post_format( 'aside' )) {
							  echo '<i class="icon-layout theme"></i>';
							} elseif( has_post_format( 'link' )) {
								echo '<i class="icon-link theme"></i>';
							} elseif( has_post_format( 'gallery' )) {
								echo '<i class="icon-picture theme"></i>';
							} elseif( has_post_format( 'quote' )) {
								echo '<i class="icon-quote theme"></i>';
							} elseif( has_post_format( 'status' )) {
								echo '<i class="icon-chat theme"></i>';
							} elseif( has_post_format( 'image' )) {
								echo '<i class="icon-camera theme"></i>';
							} elseif( has_post_format( 'audio' )) {
								echo '<i class="icon-music theme"></i>';
							} elseif( has_post_format( 'video' )) {
								echo '<i class="icon-video theme"></i>';
							} else {
								echo '<i class="icon-pencil theme"></i>';
							}
							
							?>
								<?php the_title(); ?></a>
							</h4>
							<p><small class="date"><i class="icon-calendar"></i> <?php the_date(); ?></small> | <small class="comments"><a href="#"><i class="icon-comment"></i> <?php comments_popup_link( __( 'Leave a comment', 'humbleshop' ), __( '1 Comment', 'humbleshop' ), __( '% Comments', 'humbleshop' ) ); ?></a></small> <?php edit_post_link( __( 'Edit', 'humbleshop' ), ' | <small> <i class="icon-pencil"></i>', '</small>' ); ?></p>

							<?php if ( is_search() ) : ?>
							<div class="entry-summary">
								<?php the_excerpt(); ?>
							</div>
							<?php else : ?>
								<?php the_content( __( '<p><span class="theme">Read more &rarr;</span></p>', 'humbleshop' ) ); ?>
							<?php endif; ?>

							<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : endif; ?>
						</article>
								
					<?php endwhile; ?>

					<?php global $wp_query;

					$total_pages = $wp_query->max_num_pages;
					if ($total_pages > 1){
					$current_page = max(1, get_query_var('paged'));

					echo '<div class="pagination tcenter ">';

					echo paginate_links(array(
					'base' => get_pagenum_link(1) . '%_%',
					'format' => '/page/%#%',
					'current' => $current_page,
					'total' => $total_pages,
					'type' => 'list',
					'prev_text' => 'Prev',
					'next_text' => 'Next'
					));

					echo '</div>';

					} ?>

				<?php else : ?>

					<?php get_template_part( 'no-results', 'index' ); ?>

				<?php endif; ?>
				</div>
				
				<?php if ($sidebar == 2) { ?>
					<!-- Sidebar -->
					<div class="span4">
						
						<div class="sidebar">
						<?php if ( ! dynamic_sidebar( 'sidebar-2' ) ) : ?>
							
							<aside id="archives" class="widget ">
								<h5>No widget in 'Post Sidebar' panel</h5>
								Add some <a href="<?php bloginfo( url ); ?>/wp-admin/widgets.php">here</a>
							</aside>

						<?php endif; // end sidebar widget area ?>
						</div>	
						
					</div>
				<?php } ?>
				
			</div>

	</section>
</div>
<?php get_footer(); ?>
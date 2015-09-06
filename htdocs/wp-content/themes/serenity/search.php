<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package humbleshop
 * @since humbleshop 1.0
 */

get_header(); ?>

<!-- ============== -->
<!-- SEARCH SECTION -->
<!-- ============== -->

<div class="container">
	
	<section>
		<div class="row">
			<header class="span12 prime">
				<h3><?php printf( __( 'Search Results for: %s', 'humbleshop' ), '<span>' . get_search_query() . '</span>' ); ?></h3>
			</header>
		</div>

		<div class="wrap">
			<div class="row-fluid">
				<div class="span8 list">
					<?php if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" class="clearfix <?php  get_post_class(); ?>" >
								<h4><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'humbleshop' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
								<p><small class="date"><i class="icon-calendar"></i> <?php the_date(); ?></small></p>
								<?php the_content( __( '<p><span class="theme">Read more &rarr;</span></p>', 'humbleshop' ) ); ?>
								<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : endif; ?>
							</article>
									

						<?php endwhile; ?>

						<?php  global $wp_query;

						$total_pages = $wp_query->max_num_pages;
						if ($total_pages > 1){
						$current_page = max(1, get_query_var('paged'));

						echo '<div class="pagination tcenter">';

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

						<h3><?php _e( 'Nothing Found', 'humbleshop' ); ?></h3>

						<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

							<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'humbleshop' ), admin_url( 'post-new.php' ) ); ?></p>

						<?php elseif ( is_search() ) : ?>

							<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'humbleshop' ); ?></p>
							<?php get_search_form(); ?>

						<?php else : ?>

							<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'humbleshop' ); ?></p>
							<?php get_search_form(); ?>

						<?php endif; ?>						

					<?php endif; ?>	
				</div>
				<div class="span4">
					<?php get_sidebar(); ?>
				</div>
				
			
			</div>
		</div>
	</section>

</div>		
<?php get_footer(); ?>
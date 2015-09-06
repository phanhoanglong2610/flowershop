<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package humbleshop
 * @since humbleshop 1.0
 */

get_header(); ?>

<!-- ======= -->
<!-- ARCHIVE -->
<!-- ======= -->

<div class="container">
	
	<section>

		<div class="row">
			<header class="span12 prime">
				<h3>
					
					<?php
						if ( is_category() ) {
							printf( __( 'Category Archives: %s', 'humbleshop' ), '<span>' . single_cat_title( '', false ) . '</span>' );

						} elseif ( is_tag() ) {
							printf( __( 'Tag Archives: %s', 'humbleshop' ), '<span>' . single_tag_title( '', false ) . '</span>' );

						} elseif ( is_author() ) {
							/* Queue the first post, that way we know
							 * what author we're dealing with (if that is the case).
							*/
							the_post();
							printf( __( 'Author Archives: %s', 'humbleshop' ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
							/* Since we called the_post() above, we need to
							 * rewind the loop back to the beginning that way
							 * we can run the loop properly, in full.
							 */
							rewind_posts();

						} elseif ( is_day() ) {
							printf( __( 'Daily Archives: %s', 'humbleshop' ), '<span>' . get_the_date() . '</span>' );

						} elseif ( is_month() ) {
							printf( __( 'Monthly Archives: %s', 'humbleshop' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

						} elseif ( is_year() ) {
							printf( __( 'Yearly Archives: %s', 'humbleshop' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

						} else {
							_e( 'Archives', 'humbleshop' );

						}
					?>

					<?php
					if ( is_category() ) {
						// show an optional category description
						$category_description = category_description();
						if ( ! empty( $category_description ) )
							echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' );

					} elseif ( is_tag() ) {
						// show an optional tag description
						$tag_description = tag_description();
						if ( ! empty( $tag_description ) )
							echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
					}
				?>

				</h3>
			</header>
		</div>
		
		<div class="wrap">
			<div class="row-fluid">

				<?php 
					$sidebar = ot_get_option( 'hs_sidebarblog' ); 
					if ($sidebar == 1) { ?>
					<!-- Sidebar -->
					<div class="span4">
						<div class="sidebar">
						<?php if ( ! dynamic_sidebar( 'sidebar-2' ) ) : ?>
							
							<aside id="archives" class="widget">
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

						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
							}  elseif( has_post_format( 'video' )) {
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

					<?php get_template_part( 'no-results', 'index' ); ?>

				<?php endif; ?>
				</div>
				
				<?php if ($sidebar == 2) { ?>
					<!-- Sidebar -->
					<div class="span4">
						<div class="sidebar">
						<?php if ( ! dynamic_sidebar( 'sidebar-2' ) ) : ?>
							
							<aside id="archives" class="widget">
								<h5>No widget in 'Post Sidebar' panel</h5>
								Add some <a href="<?php bloginfo( url ); ?>/wp-admin/widgets.php">here</a>
							</aside>

						<?php endif; // end sidebar widget area ?>	
						</div>
					</div>
				<?php } ?>

				</div>
			</div>
		</div>	

	</section>

</div>

<?php get_footer(); ?>
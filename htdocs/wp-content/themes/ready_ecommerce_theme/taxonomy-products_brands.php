<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package Ready_ecommerce
 * @since Ready_ecommerce 0.1
 */
global $wp_query;
get_header(); ?>

		<section id="primary">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php
						printf( __( 'Catalogue: %s', 'ready_ecommerce' ), '<span>' . single_cat_title( '', false ) . '</span>' );
					?></h1>

					<?php
						$category_description = category_description();
						if ( ! empty( $category_description ) )
							echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
					?>
				</header>
                            <div class="page_navigation_top"><?php ready_ecommerce_sort(); ?></div>
				
                            <div class="clr"></div>

                            <?php
									  while ( have_posts() ) : the_post();
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', 'product_in_category' );
					
                                      endwhile;
                            ?> 
                            <div class="clr"></div>
                            <div class="page_navigation_bottom">
                            <?php ready_ecommerce_sort();?> 
                                <div class="clr"></div>
                            </div>
                            <?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'ready_ecommerce' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'ready_ecommerce' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</section><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
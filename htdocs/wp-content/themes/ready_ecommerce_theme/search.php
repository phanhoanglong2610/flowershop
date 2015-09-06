<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Ready_ecommerce
 * @since Ready_ecommerce 0.1
 */

get_header(); ?>

		<section id="primary">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'ready_ecommerce' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header>

				<div class="page_navigation_top"><?php ready_ecommerce_sort(); ?></div>
				
                            <div class="clr"></div>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php $tplFormat = (get_post_type() == S_PRODUCT ? 'product_in_category' : 'search')?>
					<?php get_template_part( 'content', $tplFormat ); ?>

				<?php endwhile; ?>

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
						<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ready_ecommerce' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</section><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
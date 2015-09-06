<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Ready_ecommerce
 * @since Ready_ecommerce 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		
		<?php if (is_page('shopping-cart') ): ?>
    <div class="breadcrumbs">
			<?php if ( is_active_sidebar( 'breadcrumbs' ) ) : ?>
				<?php dynamic_sidebar( 'breadcrumbs' ); ?>
			<?php endif; ?>
		</div>
    <?php else : ?>
    <h2 class="entry-title"><?php the_title(); ?></h2>
    <div class="clear"></div>
    <?php endif; ?>
		
		
	</header><!-- .entry-header -->

	<div class="entry-content">
	
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'ready_ecommerce' ), 'after' => '</div>' ) ); ?>
		<?php edit_post_link( __( 'Edit', 'ready_ecommerce' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->

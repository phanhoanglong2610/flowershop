<?php
/**
 * @package Ready_ecommerce
 */
?>
<div class="breadcrumbs">
	<?php if ( is_active_sidebar( 'breadcrumbs' ) ) : ?>
    <?php dynamic_sidebar( 'breadcrumbs' ); ?>
	<?php endif; ?>
</div>
<product id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<info class="entry-content">	
		<?php the_content(); ?>
	</info><!-- .entry-content -->

	<footer class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'ready_ecommerce' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</product><!-- #post-<?php the_ID(); ?> -->

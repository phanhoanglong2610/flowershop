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
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="entry-meta">
			<?php ready_ecommerce_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
	
		<?php the_content(); ?>

		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'ready_ecommerce' ), 'after' => '</div>' ) ); ?>
	
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php
		
			//translators: used between list items, there is a space after the comma 
			$category_list = get_the_category_list( __( ', ', 'ready_ecommerce' ) );

			// translators: used between list items, there is a space after the comma 
			$tag_list = get_the_tag_list( '', ', ' );

			if ( ! ready_ecommerce_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'ready_ecommerce' );
				} else {
					$meta_text = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'ready_ecommerce' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'ready_ecommerce' );
				} else {
					$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'ready_ecommerce' );
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink(),
				the_title_attribute( 'echo=0' )
			); 
		?>

		<?php edit_post_link( __( 'Edit', 'ready_ecommerce' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->

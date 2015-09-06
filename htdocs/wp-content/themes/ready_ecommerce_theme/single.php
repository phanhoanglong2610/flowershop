<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Ready_ecommerce
 * @since Ready_ecommerce 0.1
 */

get_header(); ?>
<div id="primary">
    <div id="content" role="main">
        <?php while ( have_posts() ) : the_post(); ?>
        <?php //ready_ecommerce_content_nav( 'nav-above' ); ?>
        <?php get_template_part( 'content-single-product', get_post_format() ); ?>
        <?php endwhile; // end of the loop. ?></div>
    <!-- #content -->
    <div class="clr"></div>
    <?php
// If comments are open or we have at least one comment, load up the comment template
if ( comments_open() || '0' != get_comments_number() )
    comments_template( '', true );
?>
    <?php if (get_post_type() != 'product'):
    //get_sidebar(); 
endif;
?>
    <div class="clr"></div>
</div>
<!-- #primary -->
<?php get_footer(); ?>
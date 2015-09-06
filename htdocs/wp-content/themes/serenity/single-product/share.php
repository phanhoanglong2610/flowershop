<?php
/**
 * Single Product Share
 *
 * Sharing plugins can hook into here or you can add your own code directly.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
?>
<?php //do_action('woocommerce_share'); // Sharing plugins can hook into here 
	global $post;
?>

<hr>
<div class="row-fluid socialshare">
	<div class="span6 decidernote"><?php echo ot_get_option( 'hs_Lng_share' ); ?></div>
	<div class="span6 decider">

		<a target="_blank" href="http://twitter.com/home?status=<?php the_title(); ?> - <?php the_permalink(); ?>" title="Click to share this post on Twitter"><i class="icon-twitter-circled"></i></a>
		<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(the_permalink()); ?>&t=<?php echo urlencode(the_title()); ?>"><i class="icon-facebook-circled"></i></a>
		<a target="_blank" href="http://pinterest.com/pin/create/button?url=<?php echo urlencode(the_permalink()); ?>&media=<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>&description=<?php echo urlencode(the_title()); ?>"><i class="icon-pinterest-circled"></i></a>  
		<a target="_blank" href="https://plus.google.com/share?url=<?php echo urlencode(the_permalink()); ?>"><i class="icon-gplus-circled"></i></a>
		<a target="_blank" href="mailto:me?subject=<?php echo urlencode(the_title()); ?>&body=<?php echo urlencode(the_permalink()); ?>"><i class="icon-mail"></i></a>
	</div>
</div>
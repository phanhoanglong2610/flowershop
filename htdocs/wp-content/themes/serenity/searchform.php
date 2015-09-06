<?php
/**
 * The template for displaying search forms in humbleshop
 *
 * @package humbleshop
 * @since humbleshop 1.0
 */
?>

	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search" class="topsearch form-horizontal">
		<input type="text" class="top-search" name="s" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'humbleshop' ); ?>" />
		<button type="submit" class="submit btn" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'humbleshop' ); ?>"><i class="icon-search"></i></button>
	</form>

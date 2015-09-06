<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package humbleshop
 * @since humbleshop 1.0
 */

get_header(); ?>

<div class="container">
	<section>
		
		<div class="row">
			<header class="span12 prime">
				<h3><?php _e( 'W P L OC KE R .C O M  - Oops! That page can&rsquo;t be found.', 'humbleshop' ); ?></h3>
			</header>
		</div>

		<div class="wrap">
			<div class="row-fluid">
				<div class="span12 tcenter" style="height:350px">
					
					<?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'humbleshop' ); ?></p>

					<?php get_search_form(); ?>					

				</div>
			</div>
		</div>	

	</section>
</div>

<?php get_footer(); ?>
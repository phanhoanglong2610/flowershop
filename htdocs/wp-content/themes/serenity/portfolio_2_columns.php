<?php
/*
Template Name: Portifolio 2 Columns
*/
?>

<?php
get_header(); ?>
<div class="container">
	<section class="page">
		<div class="row">
			<header class="span12 prime">
				<h3><?php the_title() ?></h3>
			</header>
		</div>
		<div id="primary">
			<div id="content" role="main">

			<?php
				 $terms = get_terms("tagportifolio");
				 $count = count($terms);
				 echo '<ul id="portfolio-filter">';
					echo '<li><a href="#all" title="">All</a></li>';
				 if ( $count > 0 ){
					
						foreach ( $terms as $term ) {
							
							$termname = strtolower($term->name);
							$termname = str_replace(' ', '-', $termname);
							echo '<li><a href="#'.$termname.'" title="" rel="'.$termname.'">'.$term->name.'</a></li>';
						}
				 }
				 echo "</ul>";
			?>
<div class="row">
			<?php 
				$loop = new WP_Query(array('post_type' => 'project', 'posts_per_page' => -1));
				$count =0;
			?>
			
			<div id="portfolio-wrapper">
				<ul id="portfolio-list">
			
				<?php if ( $loop ) : 
					 
					while ( $loop->have_posts() ) : $loop->the_post(); ?>
					
						<?php
						$terms = get_the_terms( $post->ID, 'tagportifolio' );
								
						if ( $terms && ! is_wp_error( $terms ) ) : 
							$links = array();

							foreach ( $terms as $term ) 
							{
								$links[] = $term->name;
							}
							$links = str_replace(' ', '-', $links);	
							$tax = join( " ", $links );		
						else :	
							$tax = '';	
						endif;
						?>
						<?php $infos = get_post_custom_values('_url'); ?>
						<li class="portfolio-item <?php echo strtolower($tax); ?> all span6">
							<div class="thumb"><a href="<?php the_permalink() ?>"><?php the_post_thumbnail(  ); ?></a></div>
							<p class="excerpt"><a href="<?php the_permalink() ?>"><?php echo get_the_excerpt(); ?></a></p>
							<h3><i class="icon-layout"></i><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
							
						</li>
					<?php endwhile; ?>
				<?php endif; ?>
				</ul>
			</div> <!-- end #portfolio-wrapper-->

			<script>
				jQuery(document).ready(function() {	
					jQuery("#portfolio-list").filterable();
				});
			</script>
			
			</div><!-- #content -->
		</div><!-- #primary -->
		</section>
		</div><!-- #container -->

<?php get_footer(); ?>
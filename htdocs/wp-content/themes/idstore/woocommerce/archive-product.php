<?php 
    get_header('shop');
?> 

<div class="container">
    <div class="row">
        <div class="span12 breadcrumbs">
            <?php
                do_action('woocommerce_before_main_content'); 

                extract(etheme_get_shop_sidebar());

	        ?>      	
	        <a class="back-to" href="javascript: history.go(-1)"><span>&lsaquo;</span> <?php _e('Return to Previous Page', ETHEME_DOMAIN); ?></a>
         
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <?php if($product_sidebar && $responsive == 'top') : ?>
        	<div id="products-sidebar" class="span3 sidebar_grid leftnav acc_enabled sidebar_<?php echo $grid_sidebar ?>">
        		<?php if ( is_active_sidebar( 'product-widget-area' ) ) : ?>
        			<?php dynamic_sidebar( 'product-widget-area' ); ?>
                <?php else: ?>
                    <?php etheme_get_wc_categories_menu() ?>
        		<?php endif; ?>	
                <div class="clear"></div>
            </div>
    	<?php endif; ?>	
    	<div id="default_products_page_container" class="grid_content with-sidebar-<?php echo $grid_sidebar ?> <?php if(!$product_sidebar) echo 'span12 no-sidebar'; else echo 'span9 with-sidebar'?>">
        <?php
            global $wp_query;
            $cat = $wp_query->get_queried_object();
            if(!@$cat->term_id){
                $image = etheme_get_option('product_bage_banner');
            }else{
                $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
                $image = wp_get_attachment_url( $thumbnail_id );
            }
            if($image && $image !=''){
                ?> 
                    <div class="grid_slider">
                        <img class="cat-banner" src="<?php echo $image ?>" /> 
                    </div>
                <?php
            }
            if(isset($cat->description) && $cat->description !='' && !is_shop()) {
	            ?>
	            	<div class="product-category-description">
		            	<?php echo do_shortcode($cat->description); ?>
	            	</div>
	            <?php
            }
            
            
            
         ?>
                
                <?php etheme_demo_alerts(); ?>
                
    		<?php if ( have_posts() ) : ?>
    
                <div class="grid_pagination_block">
                	<?php do_action('woocommerce_before_shop_loop'); ?>
                    <div class="clear"></div>
                </div>
                
    				<?php woocommerce_product_subcategories(); ?>
    				

					<?php $view_mode = etheme_get_option('view_mode'); ?>
			        <?php 
			            if($view_mode == 'grid' || $view_mode == 'grid_list') {
				            $view_class = 'products-grid'; 
			            }else{
				            $view_class = 'products-list'; 
			            }
			            
			        ?>
			        
                    <div id="products-grid" class="products_grid <?php echo $view_class;  ?> row rows-count<?php echo $product_per_row ?>">
        				<?php while ( have_posts() ) : the_post(); ?>
        		
        					<?php woocommerce_get_template_part( 'content', 'product' ); ?>
        		
        				<?php endwhile; // end of the loop. ?>
                        <div style="clear: both;"></div>
    				</div>
    				<script type="text/javascript">listSwitcher(); check_view_mod();</script>
    				
    				
        		<div class="clear"></div>
        
                <div class="grid_pagination_bottom_block">
                	<?php do_action('woocommerce_after_shop_loop'); ?>
                    <div class="clear"></div>
                </div>
        		
    		<?php else : ?>
    		
    			<?php if ( ! woocommerce_product_subcategories( array( 'before' => '<ul class="products">', 'after' => '</ul>' ) ) ) : ?>
    					
    				<p class="error"><?php _e( 'No products found which match your selection.', ETHEME_DOMAIN ); ?></p>
    					
    			<?php endif; ?>
    		
    		<?php endif; ?>
    		
            <?php dynamic_sidebar( 'under-product-widget-area' ); ?>
    
    
    	   <?php do_action('woocommerce_after_main_content'); ?>
            </div>
        <?php if($product_sidebar && $responsive == 'bottom') : ?>
        	<div id="products-sidebar" class="span3 sidebar_grid leftnav acc_enabled sidebar_<?php echo $grid_sidebar ?>">
        		<?php if ( is_active_sidebar( 'product-widget-area' ) ) : ?>
        			<?php dynamic_sidebar( 'product-widget-area' ); ?>
                <?php else: ?>
                    <?php etheme_get_wc_categories_menu() ?>
        		<?php endif; ?>	
                <div class="clear"></div>
            </div>
    	<?php endif; ?>	
        <div class="clear"></div>
    </div>
</div><!-- .container -->
<?php get_footer('shop'); ?>
<script type="text/javascript">
jQuery(document).ready(function(){

	var formId = "#toeAddToCartForm<?php echo $this->post->ID?>";
	/* Catalog Items color (except GRID) */
	var image_border_color = "<?php echo $this->viewOptions['image_border_color'];?>";
	var price_color = "<?php echo $this->viewOptions['price_color'];?>";
	var short_descr_color = "<?php echo $this->viewOptions['short_descr_color'];?>";
	var title_color = "<?php echo $this->viewOptions['title_color'];?>";
	
	jQuery(formId + " .product_block_wrapper h1 a").css("color",title_color);
	jQuery(formId + " .product_excerpt").css("color",short_descr_color);
	jQuery(formId + " .product_price").css("color",price_color);
	jQuery(formId + " .product_image img").css("border","1px solid"+image_border_color);
	
});
</script>
<form action="" method="post" class="toeAddToCartForm" id="toeAddToCartForm<?php echo $this->post->ID?>" onsubmit="toeAddToCart(this); return false;">
<div class="category_product">
    <div class="product_wrap">
        <div class="product_main">
            <!--toeImage-->
                <div class="product_image">
                    <a href="<?php echo $this->post->guid; ?>" title="<?php echo get_the_title();?>" style="height: <?php echo $this->image['thumb'][2]; ?>px">
                        <img src="<?php echo $this->image['thumb'][0]; ?>" 
                             width="<?php echo $this->image['thumb'][1]; ?>"
                             height="<?php echo $this->image['thumb'][2]; ?>"
                             alt="<?php echo get_the_title();?>"
                             class="productPict" />
                    </a>
                    <?php if(!empty($this->saleTpl)) { ?>
                            <?php echo $this->saleTpl?>
                     <?php }?>
                </div>
            <!--/toeImage-->
        </div>
        <div class="product_info">            
                <div class="product_block_wrapper">
                    <?php if ($this->viewOptions['title']) :?>
                        <!--toetitle-->
                             <h1><a href="<?php echo $this->post->guid; ?>" title="<?php lang::_e('View product page')?>"><?php echo get_the_title()?></a></h1>
                        <!--/toetitle-->
                    <?php endif;?>
                    <?php if ($this->viewOptions['short_descr']) :?>
                        <!--toeshort_description-->
                            <div class="product_excerpt">
                                
                            <?php echo get_the_excerpt(); ?>
                                    
                            </div>
                        <!--/toeshort_description-->
                    <?php endif;?>
                    <!--toeadd_to_cart-->
                    <?php if ($this->viewOptions['price']) :?>
                        <div class="product_price">
                          <span><?php echo $this->priceHtml?></span>
                        </div>
                    <?php endif;?>
                    
                        <div class="clr"></div>
                        <?php if ($this->viewOptions['add_to_cart']) :?>
                            <div class="product_to_cart">
                                  <?php echo $this->actionButtons ?>
                            </div>
                        <?php endif;?>
                        <div class="clr"></div>
                    <!--/toeadd_to_cart-->
                </div>
         
            <div><?php echo $this->ratingBox;?></div>
        </div>
        
    </div>
</div>
</form>
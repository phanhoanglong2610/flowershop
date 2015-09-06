<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Ready_ecommerce
 * @since Ready_ecommerce 0.1
 */
    $options = get_option('re_theme_options');
?>
<div class="clr"></div>
</div>
<!-- #main -->

<!-- #colophon -->
</div>
<!-- #page -->

<div id="colophon">
    <div class="colophon_wrapper">
        <div class="footer">
            <div class="widget-3">
                <?php if (get_option('ready_recent_hide') != 'on') :?>
                <div id="heavy_theme_recent_posts" class="widget">
                    <h1 class="widget-title"><?php lang::_e('Recent Posts'); ?></h1>
                        <?php
                            $args = array( 'numberposts' => 2, 'order'=> 'DESC', 'orderby' => 'post_date' );
                            $postslist = get_posts( $args );
                            foreach ($postslist as $post) :  setup_postdata($post);
                            ?>
                            <div class="recent_post">
                                <div class="post-thumbnail">
                                    <?php the_post_thumbnail(array(64,64), array ('class' => 'alignleft'));?>
                                </div>
                                <div class="post_content">
                                    <p>
                                        <a class="post_link" href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a> <span class="sep"> | </span>
                                        <span class="post_date"><?php the_date(); ?></span>
                                    </p>
                                    <div class="post_excerpt">
                                        <?php ready_ecommerce_max_text_length($post->post_content, 140) ?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                </div>
                <?php endif;?>
                <?php if ( is_active_sidebar( 'sidebar-2' ) ) : 
                         dynamic_sidebar( 'sidebar-2' );
                      endif; ?>
            </div>
            <div class="widget-4">
                <?php if (get_option('ready_contact_hide') != 'on') :?>

                <div>
                     <?php echo do_shortcode('[TINY-CONTACT-FORM]'); ?> 
                </div>
                <?php endif;?>
                <?php if ( is_active_sidebar( 'sidebar-3' ) ) : 
                         dynamic_sidebar( 'sidebar-3' );
                      endif; ?>
            </div>
            <div class="widget-5">
                <?php if (get_option('ready_newsletter_hide') != 'on') :?>
                <div>
                    <h1 class="widget-title"><?php lang::_e('Newsletters'); ?></h1>
                    <div class="post_content">
                        <?php lang::_e('Sign up to our weekly newsletter to recieve special offers and news');?>
                    </div>
                    <form method="post" id="subscribe" action="">
                        <input name="email" id="subscribe_email" size="30" type="text"
                            value="" placeholder="<?php lang::_e('enter your e-mail') ?>"
                            class="subscribe_email" />
                        <input type="submit" value="<?php lang::_e('Subscribe');?>" />
                        <input type="hidden" name="action" value="postSubscriber" />
                        <input type="hidden" name="page" value="messenger" />
                        <input type="hidden" name="reqType" value="ajax" />
                        <br clear="all" />
                        <span id="mod_msg_subscriber" class="mod_msg"></span>
                    </form>
                </div>
                <?php endif;?>
                <?php if (get_option('ready_findus_hide') != 'on') :?>
                <div>
                    <h2 class="widget-title"><?php lang::_e('Kết nối với FlowerShop'); ?></h2>
                    <div class="post_content">
                        <?php echo ready_ecommerce_find_us(); ?>
                    </div>
                </div>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'sidebar-4' ) ) :
                         dynamic_sidebar( 'sidebar-4' );
                endif; ?>
            </div>
            <div class="clr"></div>
        </div>
   <div id="site-generator">
       <div id="" class="footer" style="text-align:center;">

            <?php do_action( 'ready_ecommerce_credits' ); ?>
            
            <span class="">
                <?php echo esc_attr(get_option('ready_copyright')); ?>
            </span> 
            <div class="clr"></div>

        </div>
    </div>
   </div>
</div>
	<?php wp_footer(); ?>
</body>
</html>
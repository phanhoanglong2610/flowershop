<?php 

// get needed sidebar from post meta
//

global $sidebar_metabox;
$sidebar_meta = get_post_meta(get_the_ID(), $sidebar_metabox->get_the_ID(), TRUE); 
$sidebar = $sidebar_meta['dynamic_sidebar'];
?>

<div id="sidebar" class="clearfix">

<span class="separator"></span>

    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar) ) : ?> 
    
        <!-- All this stuff in here only shows up if you DON'T have any widgets active in this zone -->

		<h2>Search</h2>
    	<?php get_search_form(); ?>
    
    
    	<div>
    	<h2>Archives</h2>
    	<ul>
    		<?php wp_get_archives('type=monthly'); ?>
    	</ul>
        </div>
        
        <div>
        <h2>Categories</h2>
        <ul>
    	   <?php wp_list_categories('show_count=1&title_li='); ?>
        </ul>
        </div>
        
        <div>	
    	<h2>Meta</h2>
    	<ul>
    		<?php wp_register(); ?>
    		<li><?php wp_loginout(); ?></li>
    		<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
    		<?php wp_meta(); ?>
    	</ul>
    	</div>
    	
    	<div>
    	<h2>Subscribe</h2>
    	<ul>
    		<li><a href="<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a></li>
    		<li><a href="<?php bloginfo('comments_rss2_url'); ?>">Comments (RSS)</a></li>
    	</ul>
    	</div>
	
	<?php endif; ?>

</div>
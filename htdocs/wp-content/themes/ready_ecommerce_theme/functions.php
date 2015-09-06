<?php
/**
 * Ready_ecommerce functions and definitions
 *
 * @package Ready_ecommerce
 * @since Ready_ecommerce 0.1
 */

 /* Check ie browser */
global $is_IE; 

require_once get_template_directory() . '/update.php';

if(get_option('ready_live_settings') == 'on') require_once (TEMPLATEPATH . '/functions/livesettings/live-settings.php');
require_once TEMPLATEPATH . '/functions/admin-menu.php';
require_once TEMPLATEPATH . '/functions/documentations/documentation.php';

/* Include breadcrumb module */
require_once get_template_directory() . '/functions/bread.php';

/* Include Contact Form Module */
if( !class_exists(toeTinyContactForm)){
	require_once get_template_directory() . '/functions/tiny-contact-form.php'; 
}

/* Include Social links Module */
if( !class_exists(SocialLinks)){
	require_once get_template_directory() . '/functions/sociallinks.php'; 
}

// including slider to admin page
require_once (TEMPLATEPATH . '/functions/admin_slider/index.php');



/* After Setup theme */
if ( ! function_exists( 'ready_ecommerce_setup' ) ):
	function ready_ecommerce_setup() {

		global $wpdb;

		/* Language Support */
		load_theme_textdomain( 'ready_ecommerce', get_template_directory() . '/languages' );
		$locale = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";
		if ( is_readable( $locale_file ) ) require_once $locale_file;

		/* Add default posts and comments RSS feed links to head */
		add_theme_support( 'automatic-feed-links' );

		/* This theme uses wp_nav_menu() in two location.*/
		register_nav_menus( array(
				'primary' => __( 'Primary Menu', 'ready_ecommerce' ),
				'top'=>__( 'Top "Drop-Down" Menu', 'ready_ecommerce' ),
		) );

		/* Create theme custom menu */
		$name = 'Ready! Ecommerce Menu';
		$menu = wp_get_nav_menu_object( $name );
		if ( !$menu ) {
			$menu_id = wp_create_nav_menu( $name );
			$options = get_option( 'nav_menu_options' );
			$options['auto_add'][] = $menu_id;
			update_option( 'nav_menu_options', $options );
			$itemData = array( 'menu-item-type' => 'custom', 'menu-item-url' => get_home_url( '/' ), 'menu-item-title' => 'Home' );
			wp_update_nav_menu_item( $menu_id, 0, $itemData );
			// if Ready! Commerce plugin is already installed add the pages to menu
			require_once ABSPATH . 'wp-admin/includes/plugin-install.php'; // Need for plugins_api
			
		} else {
			$menu_id = $menu->term_id;
		}

		/* Set Custom Menu */
		if ( !has_nav_menu( 'primary' ) ) {
			$locations = get_theme_mod( 'nav_menu_locations' );
			$locations['primary'] = $menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );
		}
		if ( !has_nav_menu( 'top' ) ) {
			$locations = get_theme_mod( 'nav_menu_locations' );
			$locations['top'] = $menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );
		}
		
		/* Activate Social Links Module */
		$social_links = new SocialLinks();
		$social_links->social_links_install();

		/* Add support for the Aside and Gallery Post Formats */
		add_theme_support( 'post-formats', array( 'aside', 'image', 'gallery' ) );
		if(class_exists('frame')) {
        frame::_()->getModule('options')->getModel('')->put(array('code' => 'default_theme', 'value' => 'ready_ecommerce_theme'));

    	}
    	wp_update_term(1, 'category', array(
	  'name' => 'Shop',
	  'slug' => 'shop'
));
	}
endif; // ready_ecommerce_setup

/* Tell WordPress to run ready_ecommerce_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'ready_ecommerce_setup' );

/* Setting Default Product View Options for this Theme */
if ( ! function_exists( 'toeSetThemeDefaultOptions' ) ) :
	function toeSetThemeDefaultOptions() {
		$productViewTab = frame::_()->getModule('products')->getView('productViewTab');
		$productViewTab->setThemeOptions(toeGetProductViewOptions(),"re_product_single");
		$productViewTab->setThemeOptions(toeGetProductCategoryViewOptions(),"re_product_category");
	}
endif;
/* Full list of deault options for Product View. Comment not used options. */
if ( ! function_exists( 'toeGetProductViewOptions' ) ) :
	function toeGetProductViewOptions() {
		return $options = array(
			   'full_image' => 1,
			   'preview_images' => 1,
			   //'title' => 1,
			   //'price' => 1,
			   //'show_extra_fields' => 1,
			   'sku' => 0,
			   'details' => 0,
			   'quantity' => 0,
			   'show_twitter' => 1,
			   'show_gplus' => 1,
			   'show_facebook' => 1,
			   'short_descr' => 1,
			   'full_descr' => 1,
			   'add_to_cart' => 1,
			   'add_to_cart_text' => '#11ff00',
			   'gallery_position' => 'left'
		   );
	}
endif;
/* Full list of deault options for Product Category View. Comment not used options. */
if ( ! function_exists( 'toeGetProductCategoryViewOptions' ) ) :
	function toeGetProductCategoryViewOptions() {
		return $options = array(
			   'catalog_view' => 'grid',
			   'grid_preview_size'  => 176,
			   'list_preview_size'  => 176,
			   //'grid_vert_distance' => 20,
			   //'list_vert_distance' => 20,
			   'grid_hor_distance'  => 20,
			   'shadow_border' => 1,
			   'short_descr_size' => 3,
			   'catalog_image' => 1,
			   'title' => 1,
			   'price' => 1,
			   'more' => 1,
			   'short_descr' => 1,
			   'add_to_cart' => 1,
			   'hover_item_bg' => '#ffffff',
			   'short_descr_color' => '#9D9D9D',
			   'title_color' => '#6f6f6f',
			   'image_border_color' => '#e2e2e2',
			   'price_color' => '#f58586'
		   );
	}
endif;

/* Add action to theme switch */
add_action( 'switch_theme', 'toeSetThemeDefaultOptions' );

/* Returns the list of all social links available */
function ready_ecommerce_find_us() {
	$social_links = new SocialLinks();
	$output = $social_links->generateSocialLinksInnerHTML();
	return $output;
}
/* Pagination */
function ready_ecommerce_pagination( $pages = '', $range = 3 ) {
	global $paged;
	$showitems = ( $range * 2 )+1;
	if ( empty( $paged ) ) $paged = 1;
	if ( $pages == '' ) {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if ( !$pages ) {
			$pages = 1;
		}
	}

	if ( 1 != $pages ) {
		echo "<div class=\"pagination\">";
		if ( $paged > 2 && $paged > $range+1 && $showitems < $pages ) echo "<a href='".get_pagenum_link( 1 )."' class='arrow first_page'></a>";
		if ( $paged > 1 && $showitems < $pages ) echo "<a href='".get_pagenum_link( $paged - 1 )."' class='arrow previous_page'></a>";

		for ( $i=1; $i <= $pages; $i++ ) {
			if ( 1 != $pages &&( !( $i >= $paged+$range+1 || $i <= $paged-$range-1 ) || $pages <= $showitems ) ) {
				echo ( $paged == $i )? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link( $i )."' class=\"inactive\">".$i."</a>";
			}
		}

		if ( $paged < $pages && $showitems < $pages ) echo "<a href=\"".get_pagenum_link( $paged + 1 )."\" class='arrow next_page'></a>";
		if ( $paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages ) echo "<a href='".get_pagenum_link( $pages )."' class='arrow last_page'></a>";
		echo "<span class='current'>".__( 'Page', 'ready_ecommerce' ).' '.$paged.' '.__( 'of', 'ready_ecommerce' ).' '.$pages."</span><div class='clr'></div>";
		echo "</div>\n";
	}
}

/* Pagination */
function ready_ecommerce_per_page( $per_page = 25 ) {
	global $paged;
	if ( empty( $paged ) ) $paged = 1;
	$url = get_pagenum_link( $paged );
	$query = parse_url( $url, PHP_URL_QUERY );
	parse_str( $query, $get );
?>
<div class="products_per_page_wrap">
<form action="" method="get" class="products_per_page_form">
<label>
<?php _e( 'Per page: ' )?>
</label>
<select name="per_page" class="products_per_page">
	<option value="25"<?php if ( $per_page == 25 ) echo ' selected="selected"'?>>25</option>
	<option value="50"<?php if ( $per_page == 50 ) echo ' selected="selected"'?>>50</option>
	<option value="100"<?php if ( $per_page == 100 ) echo ' selected="selected"'?>>100</option>
	<option value="999999"<?php if ( $per_page == 999999 ) echo ' selected="selected"'?>>
	<?php _e( 'all', 'ready_ecommerce' )?>
	</option>
</select>
<?php
if ( !empty( $get ) ) :
	foreach ( $get as $key=>$value ) :
		if ( $key != 'per_page' ) {?>
<input type="hidden" name="<?php echo $key?>" value="<?php echo $value?>" />
<?php }
	endforeach;
endif;
?>
</form>
</div>
<?php
}

/* Set a default theme color array for WP.com. */
$themecolors = array(
	'bg' => 'ffffff',
	'border' => 'cccccc',
	'text' => '000000',
);

/* Excerpts chars */
function custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 10 );
remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );

/* Enable support for post-thumbnails */
add_theme_support( 'post-thumbnails' );
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
}

// including home slider
function ready_slider(){
    $data = get_option(OPTIONS);
    $slides = $data['ready_slider'];
    if (!empty($slides)){
?>

<div id="startslider"  class="evoslider default">
    <dl>
        <?php 
        foreach ($slides as $slide => $value) {?>
            <dt><?php echo $value['title']?></dt>
            <dd data-src="<?php echo $value['url']; ?>" data-text="overlay"<?php if($value['link'] != '') {?> data-url="<?php echo $value['link']; ?>" <?php }?>>
                <?php if($value['description'] != '') {?><div class="evoText"><?php echo $value['description']; ?></div><?php }?>
            </dd>
        <?php }?>
    </dl>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
    startcommerceSlider = jQuery("#startslider").evoSlider({
        mode:"<?php echo $data['mode']?>",
        speed: <?php if($data['speed'] != '') {echo $data['speed'];} else {echo '500';}?>,
        interval: <?php if($data['interval'] != '') {echo $data['interval'];} else {echo '3000';}?>,
        pauseOnHover: <?php echo $data['pauseOnHover'] ? 'true' : 'false'?>,
        showPlayButton: <?php echo $data['showPlayButton'] ? 'true' : 'false'?>,
        directionNav: <?php echo $data['directionNav'] ? 'true' : 'false'?>,                 // Shows directional navigation when initialized
        directionNavAutoHide: <?php echo $data['directionNavAutoHide'] ? 'true' : 'false'?>,        // Shows directional navigation on hover and hide it when mouseout
        width: <?php if($data['width'] != '') {echo $data['width'];} else {echo '1010';}?>,
        height: <?php if($data['height'] != '') {echo $data['height'];} else {echo '400';}?>,
        <?php if($data['slideSpace'] != '') {echo 'slideSpace:'.$data['slideSpace'].',';} ?>                      // The space between slides
        <?php if($data['paddingRight'] != '') {echo 'paddingRight:'.$data['paddingRight'].',';} ?> // Padding right of the container/frame
        titleClockWiseRotation: <?php echo $data['directionNavAutoHide'] ? 'true' : 'false'?>,      // Rotates title bar by clock wise
        hideCurrentTitle: <?php echo $data['hideCurrentTitle'] ? 'true' : 'false'?>,            // Hides active title bar
        <?php if($data['startIndex'] != '') {echo 'startIndex:'.$data['startIndex'].',';} ?> // Start index when initialized
        showIndex: false,                    // Displays index in toggle icon and bullets control
        mouse: false,                        // Enables mousewheel scroll navigation
        keyboard: true,                     // Enables keyboard navigation (left and right arrows)
        easing: "swing",                    // Defines the easing effect mode
        loop: true,                         // Rotate slideshow
        lazyLoad: <?php echo $data['lazyLoad'] ? 'true' : 'false'?>,                    // Enables lazy load feature
        autoplay: true,                     // Sets EvoSlider to play slideshow when initialized
        pauseOnClick: true,                 // Stop slideshow if playing
        playButtonAutoHide: <?php echo $data['playButtonAutoHide'] ? 'true' : 'false'?>,          // Shows play/pause button on hover and hide it when mouseout
        toggleIcon: true,                   // Enables toggle icon
        showDirectionText: <?php echo $data['showDirectionText'] ? 'true' : 'false'?>,           // Shows text on direction navigation
        nextText: "<?php echo $data['nextText']?>",                   // Next button text
        prevText: "<?php echo $data['prevText']?>",                   // Prev button text
        controlNav: <?php echo $data['controlNav']?>,                   // Enables control navigation
        controlNavMode: "<?php echo $data['controlNavMode']?>",          // Sets control navigation mode ("bullets", "thumbnails", or "rotator")
        controlNavVertical: <?php echo $data['controlNavVertical'] ? 'true' : 'false'?>,          // Defines control navigation to display vertically
        controlNavPosition: "<?php echo $data['controlNavPosition']?>",       // Sets control navigation position ("inside" or "outside")
        controlNavVerticalAlign: "<?php echo $data['controlNavVerticalAlign']?>",   // Sets position of the vertical control navigation ("left" or "right")
        <?php if($data['controlSpace'] != '') {echo 'controlSpace:'.$data['controlSpace'].',';} ?>  // The space between outside control navigation with slides                 
        controlNavAutoHide: <?php echo $data['controlNavAutoHide'] ? 'true' : 'false'?>,          // Shows control navigation on mouseover and hide it when mouseout
        showRotatorTitles: true,            // Shows rotator titles
        showRotatorThumbs: true,            // Shows rotator thumbnails
        rotatorThumbsAlign: "<?php echo $data['rotatorThumbsAlign']?>",         // Thumbnails float position
        classBtnNext: "<?php if ($data['classBtnNext'] != '') {echo $data['classBtnNext'];} else {echo 'evo_next';}?>",           // The CSS class used for the next button
        classBtnPrev: "<?php if ($data['classBtnPrev'] != '') {echo $data['classBtnPrev'];} else {echo 'evo_prev';}?>",           // The CSS class used for the next button
        classExtLink: "<?php if ($data['classExtLink'] != '') {echo $data['classExtLink'];} else {echo 'evo_link';}?>",           // The CSS class used for the next button
        permalink: <?php echo $data['permalink'] ? 'true' : 'false'?>,                   // Enable or disable linking to slides via the url
        autoHideText: <?php echo $data['autoHideText'] ? 'true' : 'false'?>,                // Shows overlay text on mouseover and hide it on mouseout    
        outerText: <?php echo $data['outerText'] ? 'true' : 'false'?>,                   // Enables outer text
        outerTextPosition: "<?php echo $data['outerTextPosition']?>",         // Outer text align ("left" or "right")
        <?php if($data['outerTextSpace'] != '') {echo 'outerTextSpace:'.$data['outerTextSpace'].',';} ?>  // Space between text and slide
        linkTarget: "<?php echo $data['linkTarget']?>",               // The target attribute of the image link ("_blank", "_parent", "_self", or "_top")
        responsive: <?php echo $data['responsive'] ? 'true' : 'false'?>,                  // Enables responsive layout
        imageScale: "<?php echo $data['imageScale']?>"            // Sets image scale option ("fullSize", "fitImage", "fitWidth", "fitHeight", "none")                
    });
});
</script>

<?php    
    }
} // end Slider

// Add new image size in WP Uploader popup window
function true_get_the_sizes() {
   $s = array('');
   global $_wp_additional_image_sizes;
   if ( isset($_wp_additional_image_sizes) && count($_wp_additional_image_sizes) ) {
       $s = apply_filters( 'intermediate_image_sizes', $_wp_additional_image_sizes );
       $s = apply_filters( 'true_get_the_sizes', $_wp_additional_image_sizes );
   }
   return $s;
}
 
function true_sizes_input_fields( $fields, $post ) {
   if ( !isset($fields['image-size']['html']) || substr($post->post_mime_type, 0, 5) != 'image' )
       return $fields;
 
   $s = true_get_the_sizes();
   if ( !count($s) )
       return $fields;
 
   $items = array();
   foreach ( array_keys($s) as $size ) {
       $l = apply_filters( 'img_sz_name', $size );
       $element_id = "image-size-{$size}-{$post->ID}";
       $ds = image_downsize( $post->ID, $size );
       $enabled = $ds[3];
       $html = "<div class='image-size-item'>\n";
       $html .= "\t<input type='radio' " . disabled( $enabled, false, false ) . "name='attachments[{$post->ID}][image-size]' id='{$element_id}' value='{$size}' />\n";
       $html .= "\t<label for='{$element_id}' style='margin:0 0 0 2px;'>{$l}</label>\n";
       if ( $enabled )
           $html .= "\t<label for='{$element_id}' class='help'>" . sprintf( "(%d&nbsp;&times;&nbsp;%d)", $ds[1], $ds[2] ). "</label>\n";
       $html .= "</div>";
       $items[] = $html;
   }
 
   $items = join( "\n", $items );
   $fields['image-size']['html'] = "{$fields['image-size']['html']}\n{$items}";
 
   return $fields;
}
 
add_filter( 'attachment_fields_to_edit', 'true_sizes_input_fields', 11, 2 );

add_image_size('Slider', 978, 359, true);

function ready_ecommerce_sort(){
    if(class_exists('frame') && frame::_()->getModule('pagination')) {
        frame::_()->getModule('pagination')->getView()->display(array('nav_id' => 'nav-below', 'show' => array('navigation', 'perPage', 'ordering')));
       }

}
/* Register widgetized area and update sidebar with default widgets */
function ready_ecommerce_widgets_init() {
	register_sidebar( array(
			'name' => __( 'Home Page', 'ready_ecommerce' ),
			'id' => 'sidebar-1',
			'before_widget' => '<div class="toeWidget">',
			'after_widget' => "</div>",
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		) );

	register_sidebar( array(
			'name' => __( 'Footer Left', 'ready_ecommerce' ),
			'id' => 'sidebar-2',
			'description' => __( 'Footer left widgets area', 'ready_ecommerce' ),
			'before_widget' => '<footer_widget id="%1$s" class="widget %2$s">',
			'after_widget' => "</footer_widget>",
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		) );
	register_sidebar( array(
			'name' => __( 'Footer Middle', 'ready_ecommerce' ),
			'id' => 'sidebar-3',
			'description' => __( 'Footer middle widgets area', 'ready_ecommerce' ),
			'before_widget' => '<footer_widget id="%1$s" class="widget %2$s">',
			'after_widget' => "</footer_widget>",
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		) );
	register_sidebar( array(
			'name' => __( 'Footer Right', 'ready_ecommerce' ),
			'id' => 'sidebar-4',
			'description' => __( 'Footer left widgets area', 'ready_ecommerce' ),
			'before_widget' => '<footer_widget id="%1$s" class="widget %2$s">',
			'after_widget' => "</footer_widget>",
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		) );
	register_sidebar( array(
			'name' => __( 'Content Pages Right', 'ready_ecommerce' ),
			'id' => 'sidebar-5',
			'description' => __( 'Right sidebar area for content pages only. Not availabe at products or catalogue pages', 'ready_ecommerce' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		) );
	register_sidebar( array(
			'name' => __( 'Header Widgets', 'ready_ecommerce' ),
			'id' => 'header',
			'description' => __( 'Header place near title', 'ready_ecommerce' ),
			'before_widget' => '<hwidget id="%1$s" class="widget %2$s">',
			'after_widget' => "</hwidget>",
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		) );
	register_sidebar( array(
			'name' => __( 'Breadcrumbs', 'ready_ecommerce' ),
			'id' => 'breadcrumbs',
			'description' => __( 'Only for breadcrumbs widget', 'ready_ecommerce' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => "</div>",
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h12>',
		) );

}
add_action( 'init', 'ready_ecommerce_widgets_init' );

// widget code here

/*
 * Adding Custom Widget Set on Theme activation
 * $sidebarSlug - Sidebar Slug Name
 * $widgetSlug - Widget Slug Name
 * $countMod - use 0, if you want add only one copy of widget, if you adding same widget second time use 1, third time - use 2
 * $widgetSettings - this is associative array of widget settings
 */
function addWidgetToSidebar($sidebarSlug, $widgetSlug, $countMod, $widgetSettings = array()){   
    $sidebarOptions = get_option('sidebars_widgets');
    if(!isset($sidebarOptions[$sidebarSlug])){
        $sidebarOptions[$sidebarSlug] = array('_multiwidget' => 1);
    }
    $newWidget = get_option('widget_'.$widgetSlug);
    if(!is_array($newWidget))$newWidget = array();
    $count = count($newWidget)+1+$countMod;
    $sidebarOptions[$sidebarSlug][] = $widgetSlug.'-'.$count;
    
    // widget settings
    $newWidget[$count] = $widgetSettings;
    
    update_option('sidebars_widgets', $sidebarOptions);
    update_option('widget_'.$widgetSlug, $newWidget);
}

$checkWidgets = get_option('re_theme_widgets');

//echo $checkWidgets;

if($checkWidgets != 'set'){
		
	update_option('sidebars_widgets', '');
	
	addWidgetToSidebar('sidebar-1', 'toefpwidget', 1, array('title' => 'Featured Products', 'number_of_products' => '4', 'show_price' => 'YES', 'show_add_to_cart' => 'NO'));
	
	addWidgetToSidebar('sidebar-1', 'toebcwidget', 2, array('title' => 'Categories', 'list' => 'Categories', 'view' => 'Image view'));
	
	addWidgetToSidebar('header', 'toeshoppingcartwidget', 0);
	addWidgetToSidebar('breadcrumbs', 'toebrcwidget', 0);
	
	
	update_option('re_theme_widgets', 'set');
}


if ( ! function_exists( 'ready_ecommerce_content_nav' ) ):
	/**
	 * Display navigation to next/previous pages when applicable
	 *
	 * @since Ready_ecommerce 1.2
	 */
	function ready_ecommerce_content_nav( $nav_id ) {
		global $wp_query;

?>
<nav id="<?php echo $nav_id; ?>">
	<h1 class="assistive-text section-heading">
		<?php _e( 'Post navigation', 'ready_ecommerce' ); ?>
	</h1>
	<?php if ( is_single() ) : // navigation links for single posts ?>
		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'ready_ecommerce' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'ready_ecommerce' ) . '</span>' ); ?>
		<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>
		<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous">
			<?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'ready_ecommerce' ) ); ?>
			</div>
		<?php endif; ?>
		<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next">
			<?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'ready_ecommerce' ) ); ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>
</nav>
<!-- #<?php echo $nav_id; ?> -->
<?php
	}
endif; // ready_ecommerce_content_nav


if ( ! function_exists( 'ready_ecommerce_comment' ) ) :
	/**
	* Template for comments and pingbacks.
	*
	* To override this walker in a child theme without modifying the comments template
	* simply create your own ready_ecommerce_comment(), and that function will be used instead.
	*
	* Used as a callback by wp_list_comments() for displaying the comments.
	*
	* @since Ready_ecommerce 0.4
	*/
	function ready_ecommerce_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		?>
		<li class="post pingback">
		<p>
		<?php _e( 'Pingback:', 'ready_ecommerce' ); ?>
		<?php comment_author_link(); ?>
		<?php edit_comment_link( __( '(Edit)', 'ready_ecommerce' ), ' ' ); ?>
		</p>
		<?php
		break;
		
		default :
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer>
				<div class="comment-author vcard"> <?php echo get_avatar( $comment, 40 ); ?> <?php printf( __( '%s <span class="says">says:</span>', 'ready_ecommerce' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?> </div>
				<!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em>
					<?php _e( 'Your comment is awaiting moderation.', 'ready_ecommerce' ); ?>
					</em><br />
				<?php endif; ?>
				<div class="comment-meta commentmetadata"> <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
				<time pubdate datetime="<?php comment_time( 'c' ); ?>">
					<?php
					/* translators: 1: date, 2: time */
					printf( __( '%1$s at %2$s', 'ready_ecommerce' ), get_comment_date(), get_comment_time() ); ?>
				</time>
				</a>
				<?php edit_comment_link( __( '(Edit)', 'ready_ecommerce' ), ' ' );
				?>
				</div>
				<!-- .comment-meta .commentmetadata -->
			</footer>
			<div class="comment-content">
			<?php comment_text(); ?>
			</div>
			<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div>
			<!-- .reply -->
		</article>
		<!-- #comment-## -->

		<?php
		break;
	endswitch;
	}
endif; // ends check for ready_ecommerce_comment()

if ( ! function_exists( 'ready_ecommerce_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 * Create your own ready_ecommerce_posted_on to override in a child theme
	 *
	 * @since Ready_ecommerce 1.2
	 */
	function ready_ecommerce_posted_on() {
		printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="byline"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'ready_ecommerce' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'ready_ecommerce' ), get_the_author() ) ),
			esc_html( get_the_author() )
		);
	}
endif;

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Ready_ecommerce 1.2
 */
function ready_ecommerce_body_classes( $classes ) {
	// Adds a class of single-author to blogs with only 1 published author
	if ( ! is_multi_author() ) {
		$classes[] = 'single-author';
	}

	return $classes;
}
add_filter( 'body_class', 'ready_ecommerce_body_classes' );

/**
 * Returns true if a blog has more than 1 category
 *
 * @since Ready_ecommerce 1.2
 */
function ready_ecommerce_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
				'hide_empty' => 1,
			) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so ready_ecommerce_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so ready_ecommerce_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in ready_ecommerce_categorized_blog
 *
 * @since Ready_ecommerce 1.2
 */
function ready_ecommerce_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'ready_ecommerce_category_transient_flusher' );
add_action( 'save_post', 'ready_ecommerce_category_transient_flusher' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function ready_ecommerce_enhanced_image_navigation( $url ) {
	global $post, $wp_rewrite;

	$id = (int) $post->ID;
	$object = get_post( $id );
	if ( wp_attachment_is_image( $post->ID ) && ( $wp_rewrite->using_permalinks() && ( $object->post_parent > 0 ) && ( $object->post_parent != $id ) ) )
		$url = $url . '#main';

	return $url;
}
add_filter( 'attachment_link', 'ready_ecommerce_enhanced_image_navigation' );

/**
 * Filter cut text by length
 */
function ready_ecommerce_max_text_length( $fulltext, $charlength ) {
	if ( mb_strlen( $fulltext ) > $charlength ) {
        $subex = mb_substr( $fulltext, 0, $charlength - 5 );
        $exwords = explode( ' ', $subex );
        $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
        if ( $excut < 0 ) {
            echo mb_substr( $subex, 0, $excut );
        } else {
            echo $subex;
        }
        echo '[...]';
    } else {
        echo $fulltext;
    }; 
}



//Search Form
function my_search_form( $form ) {
	$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
<div id="search_wrapper">
<div class="forminput">
<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="Tìm kiếm" />
<input type="submit" id="searchsubmit" value="'. esc_attr__( '      ' ) .'" />
</div>
</div>
</form>
<div class="clr"></div>';
	return $form;
}
add_filter( 'get_search_form', 'my_search_form' );

add_action( 'init', 'ready_ecommerce_modify_posts_per_page', 0 );

function ready_ecommerce_modify_posts_per_page() {

	add_filter( 'option_posts_per_page', 'ready_ecommerce_option_posts_per_page' );

}

function ready_ecommerce_option_posts_per_page( $value ) {
	if ( get_post_type() == 'product' ) {
		return 1;
	} else {
		return $value;
	}

}

/**
 * This theme was built with PHP, Semantic HTML, CSS, love, and a Ready_ecommerce.
 */

$filters = array( 'pre_term_description', 'pre_link_description', 'pre_link_notes', 'pre_user_description' );
foreach ( $filters as $filter ) {
	remove_filter( $filter, 'wp_filter_kses' );
}

function my_scripts_method() {
	//wp_deregister_script( 'jquery' );
	//wp_register_script( 'jquery', 'http://code.jquery.com/jquery.min.js' );
	//wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-ui-core', '', '', '', true );
	wp_enqueue_script( 'jquery-ui-tabs', '', '', '', true );
	wp_register_script( 'radio_script', get_template_directory_uri() . '/js/custom_radio_checkbox.js', array( 'jquery' ), '1.0' );
	wp_enqueue_script( 'radio_script' );
	wp_enqueue_script( 'pict_script', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array( 'jquery' ), '1.0' );
	wp_enqueue_script( 'select_script', get_template_directory_uri() . '/js/jquery.selectbox-0.6.1.js', array( 'jquery' ), '1.0' );
	wp_register_script( 'tiny_slider', get_template_directory_uri() . '/js/jquery.slider.js', array( 'jquery' ), '1.0' );
	wp_enqueue_style('colorpicker-style', get_template_directory_uri().'/functions/livesettings/css/colorpicker.css');
    wp_enqueue_style('live-settings-style', get_template_directory_uri().'/functions/livesettings/css/live-settings.css');

	if(toe_tpl_enable_live_settings()) {
		wp_enqueue_script('live-settings-script', get_template_directory_uri().'/functions/livesettings/js/live-settings.js');
	}
	wp_enqueue_script( 'tabs_script', get_template_directory_uri() . '/js/tabs.js', array( 'jquery', 'jquery-ui-tabs' ), '1.0' );
	wp_enqueue_script( 'theme_script', get_template_directory_uri() . '/js/theme-scripts.js', array( 'jquery' ), '1.0' );

}
add_action( 'wp_enqueue_scripts', 'my_scripts_method' );
// Add style for IE
if ( $is_IE ) {
	wp_register_script( 'pie_script', get_template_directory_uri() . '/js/pie.js', array( 'jquery' ), '1.0' );
	wp_register_script( 'add_script', get_template_directory_uri() . '/js/add.js', array( 'jquery' ), '1.0' );
	wp_enqueue_script( 'add_script' );
	wp_enqueue_script( 'pie_script' );
	require get_template_directory() . '/ie.php'; /* ie support */
}
// Activate Ready! Ecommerce plugin if not yet
require_once dirname( __FILE__ ) . '/plugin-activation.php';
add_action( 'tgmpa_register', 'ready_ecommerce_register_required_plugins' );
function ready_ecommerce_register_required_plugins() {
	$plugins = array(
		array(
			'name'     => 'Ready! Ecommerce', // The plugin name
			'slug'     => 'ready-ecommerce', // The plugin slug (typically the folder name)
			'required' => true // If false, the plugin is only 'recommended' instead of required
		)
	);
	$config = array(
		'strings'      => array(
		)
	);
	tgmpa( $plugins, $config );
}
function toe_tpl_enable_live_settings() {
	return (get_option('ready_live_settings') == 'on' && utils::isMobile() == false);
}
?>
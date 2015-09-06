<?php
/**
 * serenity functions and definitions
 *
 * @package humbleshop
 * @since humbleshop 1.0
 */

// Initial Setup ****************************************************

if ( ! isset( $content_width ) ) $content_width = 960;

if ( ! function_exists( 'humbleshop_setup' ) ) :
	function humbleshop_setup() {

		// Theme option
		add_filter( 'ot_show_pages', '__return_false' );
		add_filter( 'ot_show_new_layout', '__return_false' );
		add_filter( 'ot_theme_mode', '__return_true' );
		include_once( 'option-tree/ot-loader.php' );
		include_once( 'option-tree/theme-options.php' );	
		
		// Default wordpress function
		load_theme_textdomain( 'humbleshop', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'humbleshop' ),
		) );
		add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image', 'audio', 'video' ) );
	}
endif; // humbleshop_setup
add_action( 'after_setup_theme', 'humbleshop_setup' );


// Comment function ****************************************************


if ( ! function_exists( 'humbleshop_comment' ) ) :
	function humbleshop_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<article class="post pingback">
			<p><?php _e( 'Pingback:', 'humbleshop' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'humbleshop' ), ' ' ); ?></p>
		<?php
				break;
			default :
		?>

		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article class="clearfix" <?php //comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<div class="pull-left avatar tcenter">
				<?php echo get_avatar( $comment, 40 ); ?>
				<br>
				<small class="visible-desktop"><span><?php comment_author(); ?></span> <br>
				<?php edit_comment_link( __( '<i class="icon-pencil"></i> Edit', 'humbleshop' ), ' ' ); ?></small>
			</div>
			<div class="pull-right text">
				<?php comment_text(); ?>
				<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', 'humbleshop' ); ?></em>
				<?php endif; ?>
				<div class="commentmeta clearfix">
					<small>
					<div class="pull-left">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"> 
					<time pubdate datetime="<?php comment_time( 'c' ); ?>"><i class="icon-calendar"></i> <?php comment_date(); ?> at <?php comment_time(); ?></time></a>
					</div>
					<div class="pull-right">
						<i class="icon-ccw"></i> <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div></small>
				</div>
			</div>

		<?php
				break;
		endswitch;
	}
endif;


// Fallback menu to homelink ****************************************************


function humbleshop_page_menu_args( $args ) {
	$args['show_home'] = true;
	echo '<ul id="nav" class="nav"><li><a href="wp-admin/nav-menus.php">THEME SHARED ON WPLOCKER.COM - Create Menu</a></li></ul>';
	return $args;
}
add_filter( 'wp_page_menu_args', 'humbleshop_page_menu_args' );


// Custom body classes ****************************************************


function humbleshop_body_classes( $classes ) {
	$classes[] = 'wf-active';
	
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'humbleshop_body_classes' );


// Custom wordpress title ****************************************************


function humbleshop_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'humbleshop' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'humbleshop_wp_title', 10, 2 );


// Register widgets ****************************************************


function humbleshop_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Page Sidebar', 'humbleshop' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<p class="title">',
		'after_title' => '</p>',
	) );
	register_sidebar( array(
		'name' => __( 'Post Sidebar', 'humbleshop' ),
		'id' => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<p class="title">',
		'after_title' => '</p>',
	) );
	register_sidebar( array(
		'name' => __( 'Shop Sidebar', 'humbleshop' ),
		'id' => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<p class="title">',
		'after_title' => '</p>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Bottom Widget One', 'humbleshop' ),
		'id' => 'sidebar-4',
		'description' => __( 'A widget area for your site footer', 'humbleshop' ),
		'before_widget' => '<article id="%1$s" class="span3 %2$s">',
		'after_widget' => "</article>",
		'before_title' => '<strong class="title">',
		'after_title' => '</strong>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Bottom Widget Two', 'humbleshop' ),
		'id' => 'sidebar-5',
		'description' => __( 'A widget area for your site footer', 'humbleshop' ),
		'before_widget' => '<article id="%1$s" class="span3 %2$s">',
		'after_widget' => "</article>",
		'before_title' => '<strong class="title">',
		'after_title' => '</strong>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Bottom Widget Three', 'humbleshop' ),
		'id' => 'sidebar-6',
		'description' => __( 'A widget area for your site footer', 'humbleshop' ),
		'before_widget' => '<article id="%1$s" class="span3 %2$s">',
		'after_widget' => "</article>",
		'before_title' => '<strong class="title">',
		'after_title' => '</strong>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer Bottom Widget Four', 'humbleshop' ),
		'id' => 'sidebar-7',
		'description' => __( 'A widget area for your site footer', 'humbleshop' ),
		'before_widget' => '<article id="%1$s" class="span3 %2$s">',
		'after_widget' => "</article>",
		'before_title' => '<strong class="title">',
		'after_title' => '</strong>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer Top Widget One', 'humbleshop' ),
		'id' => 'sidebar-9',
		'description' => __( 'A widget area for your site single product', 'humbleshop' ),
		'before_widget' => '<article id="%1$s" class="span3 %2$s">',
		'after_widget' => "</article>",
		'before_title' => '<strong class="title">',
		'after_title' => '</strong>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer Top Widget Two', 'humbleshop' ),
		'id' => 'sidebar-10',
		'description' => __( 'A widget area for your site single product', 'humbleshop' ),
		'before_widget' => '<article id="%1$s" class="span3 %2$s">',
		'after_widget' => "</article>",
		'before_title' => '<strong class="title">',
		'after_title' => '</strong>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer Top Widget Three', 'humbleshop' ),
		'id' => 'sidebar-11',
		'description' => __( 'A widget area for your site single product', 'humbleshop' ),
		'before_widget' => '<article id="%1$s" class="span3 %2$s">',
		'after_widget' => "</article>",
		'before_title' => '<strong class="title">',
		'after_title' => '</strong>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer Top Widget Four', 'humbleshop' ),
		'id' => 'sidebar-12',
		'description' => __( 'A widget area for your site single product', 'humbleshop' ),
		'before_widget' => '<article id="%1$s" class="span3 %2$s">',
		'after_widget' => "</article>",
		'before_title' => '<strong class="title">',
		'after_title' => '</strong>',
	) );
}
add_action( 'widgets_init', 'humbleshop_widgets_init' );

// protfolio  ****************************************************

	add_action('init', 'project_custom_init');  
	
	/*-- Custom Post Init Begin --*/
	function project_custom_init()
	{
	  $labels = array(
		'name' => _x('Portfolio', 'post type general name'),
		'singular_name' => _x('Portfolio', 'post type singular name'),
		'add_new' => _x('Add New', 'Portfolio'),
		'add_new_item' => __('Add New Portfolio'),
		'edit_item' => __('Edit Portfolio'),
		'new_item' => __('New Portfolio'),
		'view_item' => __('View Portfolio'),
		'search_items' => __('Search Portfolios'),
		'not_found' =>  __('No Portfolios found'),
		'not_found_in_trash' => __('No Portfolios found in Trash'),
		'parent_item_colon' => '',
		'menu_name' => 'Portfolio'

	  );
	  
	 $args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','author','thumbnail','excerpt','comments', 'post-formats')
	  );
	  // The following is the main step where we register the post.
	  register_post_type('project',$args);
	  
	  // Initialize New Taxonomy Labels
	  $labels = array(
		'name' => _x( 'Tags', 'taxonomy general name' ),
		'singular_name' => _x( 'Tag', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Types' ),
		'all_items' => __( 'All Tags' ),
		'parent_item' => __( 'Parent Tag' ),
		'parent_item_colon' => __( 'Parent Tag:' ),
		'edit_item' => __( 'Edit Tags' ),
		'update_item' => __( 'Update Tag' ),
		'add_new_item' => __( 'Add New Tag' ),
		'new_item_name' => __( 'New Tag Name' ),
	  );
		// Custom taxonomy for Project Tags
		register_taxonomy('tagportifolio',array('project'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'tag-portifolio' ),
	  ));
	  
	}
	/*-- Custom Post Init Ends --*/
	
	/*--- Custom Messages - project_updated_messages ---*/
	add_filter('post_updated_messages', 'project_updated_messages');
	
	function project_updated_messages( $messages ) {
	  global $post, $post_ID;

	  $messages['project'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Portfolios updated. <a href="%s">View Portfolios</a>'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('Portfolios updated.'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Portfolios restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Portfolios published. <a href="%s">View Portfolios</a>'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Portfolios saved.'),
		8 => sprintf( __('Portfolios submitted. <a target="_blank" href="%s">Preview Portfolios</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Portfolios scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Portfolios</a>'),
		  // translators: Publish box date format, see http://php.net/date
		  date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Portfolios draft updated. <a target="_blank" href="%s">Preview Portfolios</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	  );

	  return $messages;
	}
	
	/*--- #end portfolio SECTION - project_updated_messages ---*/


// Register scripts and styles ****************************************************


function humbleshop_scripts() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'font', get_template_directory_uri() . '/css/font.css' );
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_enqueue_script( 'gmap', 'http://maps.googleapis.com/maps/api/js?sensor=false', array( 'jquery' ), '20121210', true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '20121210', true );
	wp_enqueue_script( 'shop', get_template_directory_uri() . '/js/shop.js', array( 'jquery' ), '20121210', true );
	wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '20130124', true );
	wp_enqueue_script( 'filterable', get_template_directory_uri() . '/js/filterable.js', array( 'jquery' ), '20130124', true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'humbleshop_scripts' );


// HTML5 Audio shortcode ****************************************************


function html5_audio($atts, $content = null) {
    extract(shortcode_atts(array(
        "src" => '',
        "autoplay" => '',
        "preload"=> 'true',
        "loop" => '',
        "controls"=> ''
    ), $atts));
    return '<audio src="'.$src.'" autoplay="'.$autoplay.'" preload="'.$preload.'" loop="'.$loop.'" controls="'.$controls.'" autobuffer />';
}
add_shortcode('audio', 'html5_audio');


// Additional Post Class
add_filter('post_class', 'additional_classes');

function additional_classes($c) {
       $c[] = 'clearfix';
       return $c;
}


// Walker Function ****************************************************


class My_Walker_Nav_Menu extends Walker_Nav_Menu {
  function start_lvl(&$output, $depth) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"nav\">\n";
  }
}


// Woocommerce Customization ****************************************************

add_theme_support( 'woocommerce' );
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
//remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

add_action( 'woocommerce_pagination', 'woocommerce_catalog_ordering',10);
add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 60);
 


// Custom list bookmarks ****************************************************


add_filter( 'wp_list_bookmarks', 'humbleshop_brand_class', 10, 1 );

function humbleshop_brand_class( $html )
{
    return str_replace( "class='xoxo blogroll'", "class='slides blogroll'", $html );
}


// Meta Open Graph ****************************************************
function get_excerpt_by_id($post_id){
    $the_post = get_post($post_id); //Gets post ID
    $the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
    $excerpt_length = 35; //Sets excerpt length by word count
    $the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
    $words = explode(' ', $the_excerpt, $excerpt_length + 1);

    if(count($words) > $excerpt_length) :
        array_pop($words);
        array_push($words, '...');
        $the_excerpt = implode(' ', $words);
    endif;

    $the_excerpt = $the_excerpt;

    return $the_excerpt;
}

function humbleshop_fb_opengraph() {
	$post_id = '';
	$wpc_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); ?>
	<!-- Open Graph -->
	<meta property="og:title" content="<?php the_title(); ?>" />
	<meta property="og:url" content="<?php the_permalink(); ?>" />
	<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
	<meta property="og:description" content="<?php echo $my_excerpt = get_excerpt_by_id($post_id); ?>" />
	<meta property="og:image" content="<?php echo $wpc_image_url[0] ?>"/>
<?php }

add_action('wp_head', 'humbleshop_fb_opengraph');


// Theme Option ****************************************************


function humbleshop_custom_styling() { ?>

	<!-- =========== -->
	<!-- Google Font -->
	<!-- =========== -->
			
	<script type="text/javascript">
	
		// Add Google Font name here
		
		WebFontConfig = { google: { families: [ '<?php echo ot_get_option( 'hs_logofont' , 'Bangers' ); ?>' , '<?php echo ot_get_option( 'hs_fontgoogle', 'Lato' ); ?>' ] } };
		(function() {
		var wf = document.createElement('script');
		wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
		'://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
		wf.type = 'text/javascript';
		wf.async = 'true';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(wf, s);
		})();
		
	</script>

	<style type="text/css">
			
			/* Add Google Font name here */
			.wf-active {font-family: '<?php echo ot_get_option( 'hs_fontgoogle' ); ?>',serif;}
			.wf-active .logo {
				font-family: '<?php echo ot_get_option( 'hs_logofont' ); ?>', serif;
				font-size: <?php $font = ot_get_option( 'hs_logofontsize' ); 
				if(isset($font[0]) && isset($font[1])){
					echo $font[0]; echo $font[1]; 
				} ?> !important;
			}

			<?php 
				$fonts = ot_get_option( 'hs_font' ); 
				$bgs = ot_get_option( 'hs_background' ); 
				$slider = ot_get_option( 'hs_backgroundslider' ); 
				$banner = ot_get_option( 'hs_bannerbg' ); 
				$homepage = ot_get_option( 'hs_homepagebg' ); 
				$footbg = ot_get_option( 'hs_footerbg' ); 
			?>
			body {
				
				font-family: <?php if(isset($fonts['font-family'])) { echo $fonts['font-family']; } ?>;
				font-size: <?php if(isset($fonts['font-size'])) { echo $fonts['font-size']; } ?>;
				color: <?php if(isset($fonts['font-color'])) { echo $fonts['font-color']; } ?>;
				font-variant: <?php if(isset($fonts['font-variant'])) { echo $fonts['font-variant']; } ?>;
				font-weight: <?php if(isset($fonts['font-weight'])) { echo $fonts['font-weight']; } ?>;
				letter-spacing: <?php if(isset($fonts['letter-spacing'])) { echo $fonts['letter-spacing']; } ?>;
				line-height: <?php if(isset($fonts['line-height'])) { echo $fonts['line-height']; } ?>;
				text-decoration: <?php if(isset($fonts['text-decoration'])) { echo $fonts['text-decoration']; } ?>;
				text-transform: <?php if(isset($fonts['text-transform'])) { echo $fonts['text-transform']; } ?>;

				background-color: <?php if(isset($bgs['background-color'])) { echo $bgs['background-color']; } ?>;
				background-repeat: <?php if(isset($bgs['background-repeat'])) { echo $bgs['background-repeat']; } ?>;
				background-attachment: <?php if(isset($bgs['background-attachment'])) { echo $bgs['background-attachment']; } ?>;
				background-position: <?php if(isset($bgs['background-position'])) { echo $bgs['background-position']; } ?>;
				<?php if(isset($bgs['background-image'])) { ?> background-image: url(<?php echo $bgs['background-image']; ?>); <?php } elseif(isset($bgs['background-color'])) { ?>background-image: none <?php }?>
			}
			.home-span12{
				background-color: <?php if(isset($slider['background-color'])) { echo $slider['background-color']; } ?>;
				background-repeat: <?php if(isset($slider['background-repeat'])) { echo $slider['background-repeat']; } ?>;
				background-attachment: <?php if(isset($slider['background-attachment'])) { echo $slider['background-attachment']; } ?>;
				background-position: <?php if(isset($slider['background-position'])) { echo $slider['background-position']; } ?>;
				<?php if(isset($slider['background-image'])) { ?> background-image: url(<?php echo $slider['background-image']; ?>); <?php } elseif(isset($slider['background-color'])) { ?>background-image: none <?php }?>
			}
			.home-panel{
				background-color: <?php if(isset($banner['background-color'])) { echo $banner['background-color']; } ?>;
				background-repeat: <?php if(isset($banner['background-repeat'])) { echo $banner['background-repeat']; } ?>;
				background-attachment: <?php if(isset($banner['background-attachment'])) { echo $banner['background-attachment']; } ?>;
				background-position: <?php if(isset($banner['background-position'])) { echo $banner['background-position']; } ?>;
				<?php if(isset($banner['background-image'])) { ?> background-image: url(<?php echo $banner['background-image']; ?>); <?php } elseif(isset($banner['background-color'])) { ?>background-image: none <?php }?>
			}
			.homepagecontainer {
				background-color: <?php if(isset($homepage['background-color'])) { echo $homepage['background-color']; } ?>;
				background-repeat: <?php if(isset($homepage['background-repeat'])) { echo $homepage['background-repeat']; } ?>;
				background-attachment: <?php if(isset($homepage['background-attachment'])) { echo $homepage['background-attachment']; } ?>;
				background-position: <?php if(isset($homepage['background-position'])) { echo $homepage['background-position']; } ?>;
				<?php if(isset($homepage['background-image'])) { ?> background-image: url(<?php echo $homepage['background-image']; ?>); <?php } elseif(isset($homepage['background-color'])) { ?>background-image: none <?php }?>
			}
			
			.container-menu, .horizontal-nav ul {background: <?php echo ot_get_option( 'hs_menubg' ); ?>}
			.horizontal-nav li:hover,.horizontal-nav li a:hover{background: <?php echo ot_get_option( 'hs_menubghover' ); !important?>}
			.container-menu { 
				border-top:1px solid <?php echo ot_get_option( 'hs_menuborder' ); ?>; 
				border-bottom: 1px solid <?php echo ot_get_option( 'hs_menuborder' ); ?>; 
			}
			
			.horizontal-nav ul ul li a:last-child {
				border-left: <?php echo ot_get_option( 'hs_menuborder' ); ?>;
				border-right: <?php echo ot_get_option( 'hs_menuborder' ); ?>;
				border-bottom: <?php echo ot_get_option( 'hs_menuborder' ); ?>;
			}
            .horizontal-nav ul li a {color: <?php echo ot_get_option( 'hs_menulinkcolor' ); ?>}
            .top .searchcart form button {color: <?php echo ot_get_option( 'hs_searchiconcolor' ); ?>}
            .top .searchcart input{ border: 1px solid <?php echo ot_get_option( 'hs_searchborder' ); ?>}
			
			.top-header , .welcome.container, .welcome a, .counter span, .welcome .cartbubble a, .counter{color: <?php echo ot_get_option( 'hs_topheadercolor' ); ?>}
			.top-header {background: <?php echo ot_get_option( 'hs_topheaderbg' ); ?>}
			a, .product_list_widget li a {color: <?php if(isset($fonts['font-color'])) { echo $fonts['font-color']; } ?>}

            .feat article p, .single article p, .product .tab-content.sideline article p, section.single .products .product p, section.product article p { background: <?php echo ot_get_option( 'hs_productboxpbg' ); ?> }
            .feat article p, .single article p, .product .tab-content.sideline article p, section.single .products .product p, section.product article p { color: <?php echo ot_get_option( 'hs_productboxpcolor' ); ?> }
            .feat article .product-title, .single article .product-title, .product .tab-content.sideline article .product-title, section.single .products .product .product-title, section.product article .product-title { background: <?php echo ot_get_option( 'hs_productboxbg' ); ?> }           
		    .feat article p a, .single article p a, .product .tab-content.sideline article p a, section.product article p a, section.single .products. product p a{ color: <?php echo ot_get_option( 'hs_productboxname' ); ?> }
		    section.product article h5, section.single  .products .product h5, .feat article h5, .product .tab-content.sideline article h5, .single article h5{ background: <?php echo ot_get_option( 'hs_productboxpricebg' ); ?> }
		    section.product article h5, section.single  .products .product h5, .feat article h5, .product .tab-content.sideline article h5, .single article h5{ color: <?php echo ot_get_option( 'hs_productboxpricecolor' ); ?> }
		   .view a.info, .view button.info{ background: <?php echo ot_get_option( 'hs_productboxbuttonbg' ); ?> }
		   .view a.info, .view button.info{ color: <?php echo ot_get_option( 'hs_productboxbuttoncolor' ); ?> }

			.counter { background: <?php echo ot_get_option( 'hs_counter' ); ?> }
			 button.theme, .share a, .share a:hover, .btn-theme, .product_list_widget .amount, section.single .onsale, .view-thumb .onsale, section.single .single_variation span.amount  { color: <?php echo ot_get_option( 'hs_panel' ); ?> }
			header.prime { background: <?php echo ot_get_option( 'hs_headpanel' ); ?> }
			 a:hover, footer a:hover, footer a.active, aside a, em.on, .theme, .page h5, a.theme , .product .sidebar h5, #comments strong, .product_list_widget .amount {color: <?php echo ot_get_option( 'hs_link' ); ?>}
			.feat .nav-pills > .active > a, .feat .nav-pills > .active > a:hover, .product .nav-pills > .active > a, .product .nav-pills > .active > a:hover, button.theme, .share a, .flex-control-paging li a.flex-active, .btn.theme, .btn-theme, section.single .onsale, .view-thumb .onsale, section.single .single_variation span.amount { background: <?php echo ot_get_option( 'hs_link' ); ?> }

			.promo img {border: 1px solid <?php echo ot_get_option( 'hs_line' ); ?>}
		    .blog article, .archive article, .search article, .line, hr, .product .sidebar li {border-top: 1px solid <?php echo ot_get_option( 'hs_line' ); ?>;}
			.product .tab-content.sideline { border-left: 1px solid <?php echo ot_get_option( 'hs_line' ); ?> }
			 .header.prime, .horizontal-nav ul li, .gmap  { border-bottom: 1px solid <?php echo ot_get_option( 'hs_line' ); ?> }

			footer, footer .container {
				background-color: <?php if(isset($footbg['background-color'])) { echo $footbg['background-color']; } ?>;
				background-repeat: <?php if(isset($footbg['background-repeat'])) { echo $footbg['background-repeat']; } ?>;
				background-attachment: <?php if(isset($footbg['background-attachment'])) { echo $footbg['background-attachment']; } ?>;
				background-position: <?php if(isset($footbg['background-position'])) { echo $footbg['background-position']; } ?>;
				background-image: url(<?php if(isset($footbg['background-image'])) { echo $footbg['background-image']; } ?>);
				color: <?php echo ot_get_option( 'hs_footerfont' ); ?>
			}
			footer a , .foot .product_list_widget .amount{color: <?php echo ot_get_option( 'hs_footerlink' ); ?>}
			footer .doubleline { 
				border-top:1px solid <?php echo ot_get_option( 'hs_footerline' ); ?>; 
				border-bottom: 1px solid <?php echo ot_get_option( 'hs_footerline' ); ?>; 
			}
			footer { 
				border-top:3px solid <?php echo ot_get_option( 'hs_footerline' ); ?>; 
			}
			footer .doubleline p{color: <?php echo ot_get_option( 'hs_textdoubletextcolor' ); ?>}	

		
	</style>
<?php }
add_action('wp_head','humbleshop_custom_styling');

// Catch first image ****************************************************

function catch_that_image() {
  global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	if(preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches)){
		$first_img = $matches [1] [0];
		return $first_img;
	}
	else {
		$first_img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
		return $first_img;
	}
}

// Shortcodes ****************************************************

add_shortcode('button',  'bs_button' );    
add_shortcode('alert',  'bs_alert' );
add_shortcode('code',  'bs_code' );
add_shortcode('span',  'bs_span' );
add_shortcode('row',  'bs_row' );
add_shortcode('label',  'bs_label' );
add_shortcode('badge',  'bs_badge' );
add_shortcode('icon',  'bs_icon' );
add_shortcode('icon_white',  'bs_icon_white' );
add_shortcode('table',  'bs_table' );
add_shortcode('collapsibles',  'bs_collapsibles' );
add_shortcode('collapse',  'bs_collapse' );
add_shortcode('well',  'bs_well' );
add_shortcode('tabs',  'bs_tabs' );
add_shortcode('tab',  'bs_tab' );

  function bs_button($atts, $content = null) {
     extract(shortcode_atts(array(
        "type" => '',
        "size" => '',
        "link" => ''
     ), $atts));
     return '<a href="' . $link . '" class="btn btn-' . $type . ' btn-' . $size . '">' . do_shortcode( $content ) . '</a>';
  }

  function bs_alert($atts, $content = null) {
     extract(shortcode_atts(array(
        "type" => '',
        "close" => true
     ), $atts));
     return '<div class="alert alert-' . $type . '">' . do_shortcode( $content ) . '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
  }

  function bs_code($atts, $content = null) {
     extract(shortcode_atts(array(
        "type" => '',
        "size" => '',
        "link" => ''
     ), $atts));
     return '<pre><code>' . do_shortcode( $content ) . '</code></pre>';
  }

  function bs_span( $atts, $content = null ) {
    extract(shortcode_atts(array(
      "size" => 'size'
    ), $atts));

    return '<div class="span' . $size . '">' . do_shortcode( $content ) . '</div>';

  }

  function bs_row( $atts, $content = null ) {
    
    return '<div class="row-fluid">' . do_shortcode( $content ) . '</div>';

  }

  function bs_label( $atts, $content = null ) {
    extract(shortcode_atts(array(
      "type" => 'type'
    ), $atts));

    return '<span class="label label-' . $type . '">' . do_shortcode( $content ) . '</span>';

  }

  function bs_badge( $atts, $content = null ) {
    extract(shortcode_atts(array(
      "type" => 'type'
    ), $atts));

    return '<span class="badge badge-' . $type . '">' . do_shortcode( $content ) . '</span>';

  }

  function bs_icon( $atts, $content = null ) {
    extract(shortcode_atts(array(
      "type" => 'type'
    ), $atts));

    return '<i class="icon icon-' . $type . '"></i>';

  }

  function bs_icon_white( $atts, $content = null ) {
    extract(shortcode_atts(array(
      "type" => 'type'
    ), $atts));

    return '<i class="icon icon-' . $type . ' icon-white"></i>';

  }

  function bs_table( $atts ) {
      extract( shortcode_atts( array(
          'cols' => 'none',
          'data' => 'none',
          'type' => 'type'
      ), $atts ) );
      $cols = explode(',',$cols);
      $data = explode(',',$data);
      $total = count($cols);
      $output = '';
      $output .= '<table class="table table-'. $type .' table-bordered"><tr>';
      foreach($cols as $col):
          $output .= '<th>'.$col.'</th>';
      endforeach;
      $output .= '</tr><tr>';
      $counter = 1;
      foreach($data as $datum):
          $output .= '<td>'.$datum.'</td>';
          if($counter%$total==0):
              $output .= '</tr>';
          endif;
          $counter++;
      endforeach;
          $output .= '</table>';
      return $output;
  }

  function bs_well( $atts, $content = null ) {
      extract(shortcode_atts(array(
        "size" => 'size'
      ), $atts));

      return '<div class="well well-' . $size . '">' . do_shortcode( $content ) . '</div>';
    }

    function bs_tabs( $atts, $content = null ) {
    
    if( isset($GLOBALS['tabs_count']) )
      $GLOBALS['tabs_count']++;
    else
      $GLOBALS['tabs_count'] = 0;

    $defaults = array();
    extract( shortcode_atts( $defaults, $atts ) );
    
    // Extract the tab titles for use in the tab widget.
    preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
    
    $tab_titles = array();
    if( isset($matches[1]) ){ $tab_titles = $matches[1]; }
    
    $output = '';
    
    if( count($tab_titles) ){
      $output .= '<ul class="nav nav-tabs" id="custom-tabs-'. rand(1, 100) .'">';
      
      $i = 0;
      foreach( $tab_titles as $tab ){
        if($i == 0)
          $output .= '<li class="active">';
        else
          $output .= '<li>';

        $output .= '<a href="#custom-tab-' . $GLOBALS['tabs_count'] . '-' . sanitize_title( $tab[0] ) . '"  data-toggle="tab">' . $tab[0] . '</a></li>';
        $i++;
      }
        
        $output .= '</ul>';
        $output .= '<div class="tab-content">';
        $output .= do_shortcode( $content );
        $output .= '</div>';
    } else {
      $output .= do_shortcode( $content );
    }
    
    return $output;
  }

  function bs_tab( $atts, $content = null ) {

    if( !isset($GLOBALS['current_tabs']) ) {
      $GLOBALS['current_tabs'] = $GLOBALS['tabs_count'];
      $state = 'active';
    } else {

      if( $GLOBALS['current_tabs'] == $GLOBALS['tabs_count'] ) {
        $state = ''; 
      } else {
        $GLOBALS['current_tabs'] = $GLOBALS['tabs_count'];
        $state = 'active';
      }
    }

    $defaults = array( 'title' => 'Tab');
    extract( shortcode_atts( $defaults, $atts ) );
    
    return '<div id="custom-tab-' . $GLOBALS['tabs_count'] . '-'. sanitize_title( $title ) .'" class="tab-pane ' . $state . '">'. do_shortcode( $content ) .'</div>';
  }

  function bs_collapsibles( $atts, $content = null ) {
    
    if( isset($GLOBALS['collapsibles_count']) )
      $GLOBALS['collapsibles_count']++;
    else
      $GLOBALS['collapsibles_count'] = 0;

    $defaults = array();
    extract( shortcode_atts( $defaults, $atts ) );
    
    // Extract the tab titles for use in the tab widget.
    preg_match_all( '/collapse title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
    
    $tab_titles = array();
    if( isset($matches[1]) ){ $tab_titles = $matches[1]; }
    
    $output = '';
    
    if( count($tab_titles) ){
      $output .= '<div class="accordion" id="accordion-' . $GLOBALS['collapsibles_count'] . '">';
      $output .= do_shortcode( $content ) ;
      $output .= '</div>';
    } else {
      $output .= do_shortcode( $content );
    }
    
    return $output;
  }

  function bs_collapse( $atts, $content = null ) {

    if( !isset($GLOBALS['current_collapse']) )
      $GLOBALS['current_collapse'] = 0;
    else 
      $GLOBALS['current_collapse']++;


    $defaults = array( 'title' => 'Tab', 'state' => '');
    extract( shortcode_atts( $defaults, $atts ) );
    
    if (!empty($state)) 
      $state = 'in';

    return '
    <div class="accordion-group">
      <div class="accordion-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-' . $GLOBALS['collapsibles_count'] . '" href="#collapse_' . $GLOBALS['current_collapse'] . '_'. sanitize_title( $title ) .'">
          ' . $title . ' 
        </a>
      </div>
      <div id="collapse_' . $GLOBALS['current_collapse'] . '_'. sanitize_title( $title ) .'" class="accordion-body collapse ' . $state . '">
        <div class="accordion-inner">
          ' . $content . ' 
        </div>
      </div>
    </div>
    ';
  }
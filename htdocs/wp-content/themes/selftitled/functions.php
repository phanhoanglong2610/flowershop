<?php

		
//update notifier

require_once ('lib/update-notifier.php');

/* ===== TRANSLATIONS ===== */	
	
   // Translations can be filed in the /languages/ directory
 
   load_theme_textdomain( 'selftitled', get_template_directory() . '/languages' );

   $locale = get_locale();
   $locale_file = get_template_directory() . "/languages/$locale.php";
   if ( is_readable($locale_file) )
       require_once($locale_file);




/* ===== INCLUDES ===== */
		
	// Pagination functions 
		
	require_once('lib/pagination.php');	
	
	
	// Widgets
	
	require_once('lib/widgets/widgets.php');
	
	
	// Prev / Next extended links
	
	require_once('lib/ambrosite-post-link-plus.php');
			
	// Theme Options 
		
	require_once ('lib/options/index.php');		
	
	
	// Reorder posts functions
	
	 include('lib/reorder/reorder.php');
	

		
		
	/* ===== INCLUDING AND CREATING METABOXES ===== */		

	// Main file
	require_once 'lib/WPAlchemy/MetaBox.php';
	
	// Media uploading support
	require_once 'lib/WPAlchemy/MediaAccess.php';
		
		$wpalchemy_media_access = NEW WPAlchemy_MediaAccess();

		 $portfolio_metabox = new WPAlchemy_MetaBox(array
		 (
		 	'id' => '_portfolio_meta',
		 	'title' => __( 'Portfolio type / settings', 'selftitled'),
		 	'template' => get_stylesheet_directory() . '/lib/WPAlchemy/metaboxes/portfolio-meta.php',
		 	'types' => array('portfolio')
		 ));
		 
		 $taxonomy_metabox = new WPAlchemy_MetaBox(array
		 (
		 	'id' => '_taxonomy_meta',
		 	'title' =>  __('Portfolio Categories', 'selftitled'),
		 	'template' => get_template_directory() . '/lib/WPAlchemy/metaboxes/taxonomy-meta.php',
		 	'include_template' => array('portfolio.php') 
		 	
		 ));
		 
		 
		 $list_metabox = new WPAlchemy_MetaBox(array
		 (
		 	'id' => '_list_meta',
		 	'title' =>  __('Portfolio custom type list',
		 	 'selftitled'),	 	'template' => get_template_directory() . '/lib/WPAlchemy/metaboxes/portfolio-list-meta.php',
		 	'types' => array('portfolio')
		 ));
		 
		$background_metabox = new WPAlchemy_MetaBox(array
		(
			'id' => '_background_meta',
			'title' =>  __('Background', 'selftitled'), 
			'template' => get_template_directory() . '/lib/WPAlchemy/metaboxes/background-meta.php',
			'types' => array('post', 'page', 'portfolio'),
			'exclude_template' => array('portfolio.php', 'gallery.php')
		));	
		
		$sidebar_metabox = new WPAlchemy_MetaBox(array
		(
			'id' => '_sidebar_meta',
			'title' =>  __('Sidebar', 'selftitled'), 
			'template' => get_template_directory() . '/lib/WPAlchemy/metaboxes/sidebar-meta.php',
			'context' => 'side',
			'priority' => 'low'
		));	


	
	// Add RSS links to <head> section
	add_theme_support( 'automatic-feed-links');
	if ( ! isset( $content_width ) ) $content_width = 600;
	function is_custom_page_template( $template = '' ) {
	global $wp_query;
	$page_id = $wp_query->get_queried_object_id();
	if ( $template == get_post_meta( $page_id, '_wp_page_template', true ) )
	return true;
	else
	return false;
	}
	
	
	// load scripts
	function my_init_method() {
	    if (!is_admin()) {   
	    
	       wp_enqueue_script('jquery');
	    
	       wp_register_script('slider',  get_template_directory_uri()  . "/js/jquery.ketslider.js");
	       wp_enqueue_script('slider');
	       
	       wp_register_script('address',  get_template_directory_uri()  . "/js/jquery.address-1.4.min.js");
	       wp_enqueue_script('address');
	       
	       
	       wp_register_script('modernizr',  get_template_directory_uri()  . "/js/modernizr-1.7.min.js");
	       wp_enqueue_script('modernizr');
	         
	      wp_register_script('custom',  get_template_directory_uri()  . "/js/custom.js");
	      wp_enqueue_script('custom');
	    }
	    
	    
	  
	  // admin css & js  
	    
	  if (is_admin()) { wp_enqueue_style('custom_meta_css', get_stylesheet_directory_uri() . '/lib/admin/css/admin_css.css');
	    wp_enqueue_script('admin_js', get_stylesheet_directory_uri() . '/lib/admin/admin_js.js');
	     }
	 
	 	// setting contact variables
		 $scriptData = array(
	     'nameError' =>  __( 'Please enter your name','selftitled'),
	     'emailError' => __( 'Please enter your e-mail','selftitled'),	    
	     'emailWrong' => __( 'Please provide a valid e-mail','selftitled'),	    	
	     'messageError' => __( 'Please enter your message' , 'selftitled')   	
	 );
	 
	 wp_localize_script('custom','custom_var',$scriptData);
    
	}    
	 
	add_action('init', 'my_init_method');


	// thumbnails
	
	add_theme_support('post-thumbnails');
	
	
	// blog thumbnails
	
	if ( function_exists( 'add_image_size' ) ) { 
		add_image_size( 'blog-thumb', 700, 350, true); //(cropped)
		add_image_size( 'widget-thumb', 60, 60, true); //(cropped)
		add_image_size( 'reorder-thumb', 25, 25, true); //(cropped)
	}
	
	
	
	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
    
        
  // register sidebars
  
  register_sidebar(array(
    'name' => __( 'Main Sidebar','selftitled'),
    'id' => 'main-sidebar',
    'description' => __( 'Widgets in this area will be shown on the right-hand side.', 'selftitled'),
    'before_title' => '<h2>',
    'after_title' => '</h2>',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',  
  ));
  
  register_sidebar(array(
    'name' => __( 'Contact Sidebar','selftitled'),
    'id' => 'contact-sidebar',
    'description' => __( 'Contact page sidebar', 'selftitled'),
    'before_title' => '<h2>',
    'after_title' => '</h2>',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',  
  ));
  
  register_sidebar(array(
    'name' => __( 'Additional Sidebar #1','selftitled'),
    'id' => 'add-sidebar-1',
    'description' => __( 'Additional Sidebar 1', 'selftitled'),
    'before_title' => '<h2>',
    'after_title' => '</h2>',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',  
  ));
  
  register_sidebar(array(
    'name' => __( 'Additional Sidebar #2','selftitled'),
    'id' => 'add-sidebar-2',
    'description' => __( 'Additional Sidebar 2', 'selftitled'),
    'before_title' => '<h2>',
    'after_title' => '</h2>',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',  
  ));
  
  register_sidebar(array(
    'name' => __( 'Additional Sidebar #3','selftitled'),
    'id' => 'add-sidebar-3',
    'description' => __( 'Additional Sidebar 3', 'selftitled'),
    'before_title' => '<h2>',
    'after_title' => '</h2>',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',  
  ));
  
  register_sidebar(array(
    'name' => __( 'Additional Sidebar #4','selftitled'),
    'id' => 'add-sidebar-4',
    'description' => __( 'Additional Sidebar 4', 'selftitled'),
    'before_title' => '<h2>',
    'after_title' => '</h2>',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',  
  ));
        
        
        
        
    // Post Types
    	
	add_action( 'init', 'register_cpt_portfolio' );
	
	function register_cpt_portfolio() {
	
	    $labels = array( 
	        'name' => __( 'Portfolios',  'selftitled'),
	        'singular_name' => __( 'Single Portfolio',  'selftitled' ),
	        'add_new' => __( 'Add New', 'selftitled' ),
	        'add_new_item' => __( 'Add New Portfolio', 'selftitled' ),
	        'edit_item' => __( 'Edit Portfolio',  'selftitled' ),
	        'new_item' => __( 'New Portfolio', 'selftitled' ),
	        'view_item' => __( 'View Portfolio',  'selftitled' ),
	        'search_items' => __( 'Search Portfolios',  'selftitled' ),
	        'not_found' => __( 'No portfolios found',  'selftitled' ),
	        'not_found_in_trash' => __( 'No portfolios found in Trash',  'selftitled' ),
	        'parent_item_colon' => __( 'Parent Portfolio:', 'selftitled' ),
	        'menu_name' => __( 'Portfolio',  'selftitled' ),
	    );
	
	    $args = array( 
	        'labels' => $labels,
	        'hierarchical' => false,
	        'supports' => array( 'title', 'editor', 'thumbnail' ),
	        'taxonomies' => array( 'portfolio_taxonomy' ),
	        'public' => true,
	        'show_ui' => true,
	        'show_in_menu' => true,
	        'show_in_nav_menus' => true,
	        'publicly_queryable' => true,
	        'exclude_from_search' => false,
	        'has_archive' => true,
	        'query_var' => true,
	        'can_export' => true,
	        'rewrite' => array (
	                   'slug' => __( 'portfolio', 'selftitled' )
	               ),
	        
	        'capability_type' => 'post'
	    );
	
	    register_post_type( 'portfolio', $args );
	}    

    
	add_action( 'init', 'register_taxonomy_portfolio_taxonomy' );
	
	function register_taxonomy_portfolio_taxonomy() {
	
	    $labels = array( 
	        'name' => __( 'Portfolio Categories',  'selftitled' ),
	        'singular_name' => __( 'Portfolio Category', 'selftitled' ),
	        'search_items' => __('Search Portfolio Categories',  'selftitled'),
	        'popular_items' => __( 'Popular Portfolio Categories',  'selftitled' ),
	        'all_items' => __('All Portfolio Categories', 'selftitled' ),
	        'parent_item' => __('Parent Portfolio Category',  'selftitled' ),
	        'parent_item_colon' => __( 'Parent Portfolio Category:',  'selftitled' ),
	        'edit_item' => __( 'Edit Portfolio Category', 'selftitled' ),
	        'update_item' => __( 'Update Portfolio Category', 'selftitled' ),
	        'add_new_item' => __( 'Add New Portfolio Category', 'selftitled'),
	        'new_item_name' => __( 'New Portfolio Category',  'selftitled' ),
	        'separate_items_with_commas' => __( 'Separate portfolio categories with commas', 'selftitled'),
	        'add_or_remove_items' => __( 'Add or remove portfolio categories',  'selftitled' ),
	        'choose_from_most_used' => __( 'Choose from the most used portfolio categories', 'selftitled' ),
	        'menu_name' => __( 'Portfolio Categories','selftitled'),
	    );
	
	    $args = array( 
	        'labels' => $labels,
	        'public' => true,
	        'show_in_nav_menus' => true,
	        'show_ui' => true,
	        'show_tagcloud' => true,
	        'hierarchical' => true,
	        'rewrite' => array (
	                   'slug' => __( 'portfolio_taxonomy', 'selftitled' )
	               ),
	        
	        'query_var' => true
	    );
	
	    register_taxonomy( 'portfolio_taxonomy', array('portfolio'), $args );
	}
    


	
	/* ===== MENU ===== */
	
	// register menu 
	add_action( 'init', 'register_my_menus' );
	     
	function register_my_menus() {
	    register_nav_menus(
	    array(
	    'header menu' => __( 'Header menu', 'selftitled')
	 ));
	 }
	
	
	/* ===== MISC ===== */
	
	// password form layout
	add_filter('the_password_form','my_password_form');
	function my_password_form($text){
	$text='<div class="password_protect">'.$text.'</div>';
	return $text;
	}
	
	// Aqua resizer (resize images on fly)
	
	/**
	* Title		: Aqua Resizer
	* Description	: Resizes WordPress images on the fly
	* Version	: 1.1.4
	* Author	: Syamil MJ
	* Author URI	: http://aquagraphite.com
	* License	: WTFPL - http://sam.zoy.org/wtfpl/
	* Documentation	: https://github.com/sy4mil/Aqua-Resizer/
	*
	* @param string $url - (required) must be uploaded using wp media uploader
	* @param int $width - (required)
	* @param int $height - (optional)
	* @param bool $crop - (optional) default to soft crop
	* @param bool $single - (optional) returns an array if false
	* @uses wp_upload_dir()
	* @uses image_resize_dimensions()
	* @uses image_resize()
	*
	* @return str|array
	*/
	
	function aq_resize( $url, $width, $height = null, $crop = null, $single = true ) {
	
		//validate inputs
		if(!$url OR !$width ) return false;
	
		//define upload path & dir
		$upload_info = wp_upload_dir();
		$upload_dir = $upload_info['basedir'];
		$upload_url = $upload_info['baseurl'];
	
		//check if $img_url is local
		if(strpos( $url, $upload_url ) === false) return false;
	
		//define path of image
		$rel_path = str_replace( $upload_url, '', $url);
		$img_path = $upload_dir . $rel_path;
	
		//check if img path exists, and is an image indeed
		if( !file_exists($img_path) OR !getimagesize($img_path) ) return false;
	
		//get image info
		$info = pathinfo($img_path);
		$ext = $info['extension'];
		list($orig_w,$orig_h) = getimagesize($img_path);
	
		//get image size after cropping
		$dims = image_resize_dimensions($orig_w, $orig_h, $width, $height, $crop);
		$dst_w = $dims[4];
		$dst_h = $dims[5];
	
		//use this to check if cropped image already exists, so we can return that instead
		$suffix = "{$dst_w}x{$dst_h}";
		$dst_rel_path = str_replace( '.'.$ext, '', $rel_path);
		$destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}.{$ext}";
	
		//if orig size is smaller
		if($width >= $orig_w) {
	
			if(!$dst_h) :
				//can't resize, so return original url
				$img_url = $url;
				$dst_w = $orig_w;
				$dst_h = $orig_h;
	
			else :
				//else check if cache exists
				if(file_exists($destfilename) && getimagesize($destfilename)) {
					$img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
				} 
				//else resize and return the new resized image url
				else {
					$resized_img_path = image_resize( $img_path, $width, $height, $crop );
					$resized_rel_path = str_replace( $upload_dir, '', $resized_img_path);
					$img_url = $upload_url . $resized_rel_path;
				}
	
			endif;
	
		}
		//else check if cache exists
		elseif(file_exists($destfilename) && getimagesize($destfilename)) {
			$img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
		} 
		//else, we resize the image and return the new resized image url
		else {
			$resized_img_path = image_resize( $img_path, $width, $height, $crop );
			$resized_rel_path = str_replace( $upload_dir, '', $resized_img_path);
			$img_url = $upload_url . $resized_rel_path;
		}
	
		//return the output
		if($single) {
			//str return
			$image = $img_url;
		} else {
			//array return
			$image = array (
				0 => $img_url,
				1 => $dst_w,
				2 => $dst_h
			);
		}
	
		return $image;
	}


add_shortcode( 'gallery', 'modified_gallery_shortcode' );

function modified_gallery_shortcode($attr) {



	if(is_page_template('gallery.php')){ // EDIT this slug

		$attr['size']="full";

		$attr['link']="file";

		$attr['itemtag']="li";

		$attr['icontag']="span";

		$attr['captiontag']="p";



		$output = gallery_shortcode($attr);

		

		$output =strip_tags($output,'<style><img><ul><li>');

		$output =str_replace(array(" class='gallery-item'"),array(""),$output);

		

		$output='<ul class="slides">'.$output.'</ul>';


	}else{

		$output = gallery_shortcode($attr);

	}

	return $output;	

}
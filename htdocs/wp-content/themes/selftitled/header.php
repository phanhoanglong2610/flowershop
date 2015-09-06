<!DOCTYPE html>

<!--[if lt IE 7 ]> <html class="ie ie6 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" <?php language_attributes(); ?>> <![endif]-->


<?php
// get options data
 global $data; ?>
 

<head>

	<meta charset="<?php bloginfo('charset'); ?>">
	
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<?php if (is_search()) { ?>
	<meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>

	<title><?php
		/*
		 * Print the <title> tag based on what is being viewed.
		 */
		global $page, $paged;
	
		wp_title( '|', true, 'right' );
	
		// Add the blog name.
		bloginfo( 'name' );
	
		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";
	
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'selftitled' ), max( $paged, $page ) );
	
		?></title>	
				   
	<meta name="description" content="<?php bloginfo('description'); ?>">
		
	<!--  Mobile Viewport meta tag -->

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	
	<!-- Custom favicon if uploaded -->	
	<?php if($data['custom_favicon']) { ?>
	<link rel="shortcut icon" href="<?php echo stripslashes($data['custom_favicon']); ?>">
	<?php } ?> 
	
	<!-- CSS: screen, mobile are all in the same file -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

	

	<?php 
	
	// load lightbox scripts
	
	if($data['lightbox_type'] == 'PrettyPhoto')
	{  
	
	// Load PrettyPhoto
	   wp_register_script('prettyPhoto',  get_template_directory_uri()  . "/js/jquery.prettyPhoto.js");
	   wp_enqueue_script('prettyPhoto');
	   
	   wp_register_style('prettyPhoto_css',  get_template_directory_uri()  . "/css/prettyPhoto.css");
	   wp_enqueue_style('prettyPhoto_css');
	}
	
	elseif ($data['lightbox_type'] == 'Fancyapps') {	

		// Load FancyApps
		wp_register_style('fancyapps_css',  get_template_directory_uri()  . "/lib/lightbox/fancyapps/jquery.fancybox.css");
		wp_enqueue_style('fancyapps_css');
		
		wp_register_script('fancyapps_js',  get_template_directory_uri()  . "/lib/lightbox/fancyapps/jquery.fancybox.pack.js");
		wp_enqueue_script('fancyapps_js');
		
		wp_register_script('fancyapps_media',  get_template_directory_uri()  . "/lib/lightbox/fancyapps/helpers/jquery.fancybox-media.js?v=1.0.0");
		wp_enqueue_script('fancyapps_media');
	}
	else {
		
		//Load nothing
		
	}
	
	
	// load portfolio script 
	
	if(is_page_template('portfolio.php') || is_home())
	{
		wp_register_script('portfolio',  get_template_directory_uri()  . "/js/portfolio.js");
		wp_enqueue_script('portfolio');
	
	}
	
	// load maps for conact page
	
	if(is_page_template('contact-template.php')) { 
		      wp_register_script('maps_google', 'http://maps.google.com/maps/api/js?sensor=false');
		      wp_enqueue_script('maps_google');
		      
		      wp_register_script('maps',  get_template_directory_uri()  . "/js/jquery.gomap-1.3.2.min.js");
		      wp_enqueue_script('maps');
	 }
	
	
	
	
	?>	
	
	<script>
	var theme_path = '<?php echo get_template_directory_uri(); ?>';
	</script>

	<style> 
	
	/* --- get the font --- */
	
	<?php if($data['font'] !== TRUE) { ?>
	
	/* get the main font */
	@font-face {
	    font-family: 'GnuolaneFreeRegular';
	    src: url('<?php echo get_template_directory_uri(); ?>/fonts/gnuolane_free-webfont.eot');
	    src: url('<?php echo get_template_directory_uri(); ?>/fonts/gnuolane_free-webfont.eot?#iefix') format('embedded-opentype'),
	         url('<?php echo get_template_directory_uri(); ?>/fonts/gnuolane_free-webfont.woff') format('woff'),
	         url('<?php echo get_template_directory_uri(); ?>/fonts/gnuolane_free-webfont.ttf') format('truetype'),
	         url('<?php echo get_template_directory_uri(); ?>/fonts/gnuolane_free-webfont.svg#GnuolaneFreeRegular') format('svg');
	    font-weight: normal;
	    font-style: normal;
	
	}	
	
	<?php } ?>
	
	/* --- Highlight menu on single blog posts / portfolio posts --- */
		
	<?php if($data['blog_id']) {
	?>
	.page-template-blog-template-php #navigation #menu-item-<?php echo stripslashes($data['blog_id']); ?> a, .single.single-post #navigation #menu-item-<?php echo stripslashes($data['blog_id']); ?> a
	{
		opacity: 1;
	}
	<?php }

	 if($data['portfolio_id']) {
	?>
	
	.single-portfolio #navigation #menu-item-<?php echo stripslashes($data['portfolio_id']); ?> a	{
		opacity: 1;
	}
	
	<?php }
	?>
	
	
	/* === Colors === */
	
	
	<?php if(isset($data['color_scheme'])) {
	?>
	
	.meta, #logo h1 a, a:link, a:visited, body .shortcode-tabs ul.tab_titles li.nav-tab.ui-tabs-selected a, .tabs_type_1 dt.current, .tabs_type_2 dt.current	{
		 
		 color: <?php echo stripslashes($data['color_scheme']); ?>;	 
	}
	
	
	#logo h2, span.separator, span.color, .blog_list img.attachment-blog-thumb:hover, .ketslider .ketslider-number, a img:hover, .recent_posts_widget ul.with_thumbs li:hover img, input:focus, textarea:focus
	{
		border-color: <?php echo stripslashes($data['color_scheme']); ?>;
	}
	
	<?php } 
	
	if ($data['manually_color'] == TRUE) { 
	
	// set colors manually
	
	?>
	html, body
	{
		background: <?php echo stripslashes($data['body_background']);?>;
		color: <?php echo stripslashes($data['body_color']);?>;
	}
	
	h1, h2, h3, h4, h5, h6
	{
		color: <?php echo stripslashes($data['head_color']);?>;
	}
	
	
	 h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, .post .blog_title a
	 {
	 	color: <?php echo stripslashes($data['head_link_color']);?>;
	 }
	
	#sidebar h1, #sidebar h2, #sidebar h3, #sidebar h4, #sidebar h5
	{
		color: <?php echo stripslashes($data['sidebar_head_color']); ?>;
	}
	
	#sidebar, #sidebar p
	{
		color: <?php echo stripslashes($data['sidebar_text_color']); ?>;
	}
	
	#sidebar a:link, #sidebar ul li a {
		color: <?php echo stripslashes($data['sidebar_link_color']); ?>;
		
	}
	
	a:link, a:visited, .tabs_type_1 dt.current, .tabs_type_2 dt.current
	{
		color: <?php echo stripslashes($data['link_color']); ?>;
	}
	
	a:hover, a:hover
	{
		color: <?php echo stripslashes($data['link_hover_color']); ?>;
	}
	
	#navigation .menu a, #navigation .menu li ul a
	{
		color: <?php echo stripslashes($data['menu_color']); ?>;
	}
	
	#logo h2, span.separator, span.color, .blog_list img.attachment-blog-thumb:hover,
	.ketslider .ketslider-number, .a img:hover, .recent_posts_widget ul.with_thumbs li:hover img, input:focus, textarea:focus
	{
		border-color: <?php echo stripslashes($data['border_color']); ?>;
	}
	
	 #logo h1 a, .meta	 {
	 	color: <?php echo stripslashes($data['border_color']); ?>;
	 }

	<?php } 
	// set color manually ends

	// Custom CSS insert from options
	if ($data['custom_css']) {
		echo stripslashes($data['custom_css']);
	} ?>
	
	<?php if ($data['gallery_slide'] == FALSE) {
		echo '.touch_title {visibility:hidden;}';
	} ?>
	
	/* Contact */
	.success{
		color: <?php echo stripslashes($data['ty_message_color']); ?>
	}
	</style>	




	<?php
	
	// set fullscreen background scripts
	
	
	$global_background = $data['bg_upload'];

	$id = get_the_ID(); 
	global $background_metabox;
	$background_meta = $background_metabox->the_meta($id);

	if(!is_home()){
		
		if((isset($background_meta['background_source']) || $global_background !== "") && !is_page_template('portfolio.php') && !is_page_template('gallery.php'))
		{
		wp_register_style('supersized_css',  get_template_directory_uri()  . "/css/supersized.core.css");
		wp_enqueue_style('supersized_css'); 
			
		wp_register_script('supersized_js',  get_template_directory_uri()  . "/js/supersized.core.3.2.1.min.js");
		wp_enqueue_script('supersized_js'); 
		}
	
	 }	
	
	// JW player setup
	
	if (is_page_template('portfolio.php') || is_home() || is_singular( 'portfolio' )) {
	
		wp_register_script('swfobject',  get_template_directory_uri()  . "/js/jwplayer/swfobject.js");
		wp_enqueue_script('swfobject');
		
		wp_register_script('jwplayer',  get_template_directory_uri()  . "/js/jwplayer/jwplayer.js");
		wp_enqueue_script('jwplayer');
	}	
	
	?>
	
	<?php wp_head(); ?>
	
	<script type="text/javascript">	
		jQuery(function($){
			$(".single.single-post #menu-item-<?php echo stripslashes($data['blog_id']); ?>, .single-portfolio #menu-item-<?php echo stripslashes($data['portfolio_id']); ?>").addClass('current-page-item');
			
			$(".single-portfolio #menu-item-<?php echo stripslashes($data['portfolio_id']); ?>").parents('li').addClass('current-page-item');
			
		});  
	</script>
	
	
	<?php 
	
	// set fullscreen background
	
	if(isset($background_meta['background_source']) && !is_archive() && !is_page_template('gallery.php') && !is_page_template('portfolio.php') && !is_home())
	{	?>
		<script type="text/javascript">	
			jQuery(function($){
				$.supersized({	
					fit_portrait: 0,
					slides  :  	[ {image : '<?php echo $background_meta['background_source']; ?>'}]
				});
			});  
		</script>
	<?php } 
	elseif($global_background !=="" && !is_page_template('portfolio.php') && !is_page_template('gallery.php') && !is_home())	 { ?>
		<script type="text/javascript">	
			jQuery(function($){
				$.supersized({
					fit_portrait: 0,
					slides  :  	[ {image : '<?php echo $global_background; ?>'}]
				});
			});  
		</script>
	<?php	
	}
	else {	
	}
	?>	
	
	
	<?php 
	
	// disable right click
	
	if($data['protect_images'] == TRUE)
	{	?>
		<script type="text/javascript">	
			jQuery(function($){
				$('img').bind("contextmenu",function(e){
			            return false;
			     });
			     
			    $('a').has('img').bind("contextmenu",function(e){
			             return false;
			      });
			     
			    $(document).bind("dragstart", function() {
			         return false;
			    });    
			
			});  
		</script>
	<?php } ?>
	
	</head>

<!-- head ends --> 


<body <?php body_class(); ?>>

<?php if (is_page_template('portfolio.php') || is_home()) {
?>
<div id='mediaspace'></div>
<script type='text/javascript'>

// call JW Player

  jwplayer('mediaspace').setup({
    'flashplayer': '<?php echo get_template_directory_uri() ;?>/js/jwplayer/player.swf',
	'stretching': 'fill',
	'controlbar':'bottom',
    'autostart': 'true',
    'icons':'true',
    'width': '100%',
    'height': '100%',
     'wmode': 'transparent',
 	'plugins': 'hd',
     'skin': '<?php echo get_template_directory_uri() ;?>/js/jwplayer/skins/st.zip'
  });
</script>
<?php } ?>


<!-- Navigation -->
<div id="navigation" class="vertical_nav">

	<div id="logo">
		<?php if($data['logo_type'] == TRUE && $data['logo_upload']) {?>
			<a class="img_logo" href="<?php echo home_url(); ?>"><img src="<?php echo stripslashes($data['logo_upload']); ?>"></a> 
		<?php }
		
		else { ?>
			<h1><a href="<?php echo home_url(); ?>" title="<?php echo esc_attr(get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2><a href="<?php echo home_url(); ?>"><?php bloginfo( 'description' ); ?></a></h2>
		<?php } ?>
	</div>
	
	<?php wp_nav_menu(array('theme_location' => 'header menu')); ?>

</div>
<!-- Navigation ends -->	
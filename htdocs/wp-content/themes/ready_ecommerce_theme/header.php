<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package ready_ecommerce
 * @since ready_ecommerce 0.1
 */
?><!DOCTYPE html>

<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8A)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;
	$options = get_option( 'ready_live_options' );
	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'ready_ecommerce' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>

    <?php if(toe_tpl_enable_live_settings()): ?>
       <script type="text/javascript" src="<?php echo bloginfo('template_directory').'/functions/livesettings/js/colorpicker.js'; ?>"></script>
       <script type="text/javascript" src="<?php echo bloginfo('template_directory').'/functions/livesettings/js/eye.js'; ?>"></script>
       <script type="text/javascript" src="<?php echo bloginfo('template_directory').'/functions/livesettings/js/utils.js'; ?>"></script>
    <?php endif; ?>   
    
        <?php if (get_option('ready_google_font_name') != '' && get_option('ready_google_font_name') != 'Select') { ?>
                <link id="gFontName-css" rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=<?php echo str_replace(" ", "+", get_option('ready_google_font_name')); ?>&subset=latin,cyrillic-ext" />
        <?php } else { ?>
                <link id="gFontName" href='' rel='stylesheet' type='text/css'>
        <?php } ?>
        <style type="text/css">
        <?php if (get_option('ready_google_font_name') != '' && get_option('ready_google_font_name') != 'Select') { ?>
                h1, h2, h3<?php if(get_option('ready_google_font_tags') != '') echo ', '.get_option('ready_google_font_tags'); ?> { font-family: <?php echo get_option('ready_google_font_name'); ?>;}
        <?php } ?>
            
        <?php if (get_option('ready_content_font_name') != '' && get_option('ready_content_font_name') != 'Select') { ?>
                body {font-family:<?php echo get_option('ready_content_font_name'); ?>;}
        <?php } ?>
            
        <?php if (get_option('ready_userbgimg') != '') { ?>
                body {background:url(<?php echo get_option('ready_userbgimg'); ?>);}
        <?php } elseif (get_option('ready_bgimg') != '') { ?>
                body {<?php echo get_option('ready_bgimg'); ?>}
        <?php } ?>
            
        <?php if (get_option('ready_bgcol') != '') { ?>
               body {background-color:<?php echo get_option('ready_bgcol'); ?> !important;}
        <?php } ?>
        </style>
    <?php echo esc_attr(get_option('ready_gcode')); ?>
    <link rel="icon" href="<?php echo bloginfo('template_directory').'/favicon.ico'; ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo bloginfo('template_directory').'/favicon.ico'; ?>" type="image/x-icon">
</head>
<body <?php body_class(); ?>>
<div class="top-border">
	<?php 
        if (toe_tpl_enable_live_settings()) {
            if(get_option('ready_live_settings') == 'on') require_once (TEMPLATEPATH . '/functions/livesettings/live-block.php');
        }
    ?>
    <?php wp_nav_menu( array('theme_location' => 'top', 'container_class' => 'top_menu' ,'menu_class' => 'menu', 'depth' => 1 ) ); ?>
    <div id="info"></div>
</div>

<div id="page" class="hfeed">
<?php do_action( 'before' ); ?>
	<header id="branding" role="banner">
		<hgroup id="header_wrap">
            <div id="header_left">  
                <?php if (get_option('ready_only_text') != 'on'): ?>
                    <a href="<?php bloginfo('url'); ?>">
                        <?php 
                            $src = get_option('ready_site_logo');
                            
                            if (get_option('ready_only_image') == 'on') {
                                $alt = 'alt="'.get_bloginfo('name').' - '.get_bloginfo('description').'"';
                            } else {
                                $alt = '';
                            }                            
                        ?>
                        <img id="logo-img" src="<?php echo $src; ?>" <?php echo $alt; ?> />
                    </a>
                <?php endif; ?>
                
                <?php if (get_option('ready_only_image') != 'on'): ?>
                    <h1 id="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                    <h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
                <?php endif; ?>	 
            </div>
            <?php if ( is_active_sidebar( 'header' ) ) : ?>
                <div id="shop-card"><?php dynamic_sidebar( 'header' ); ?></div>
            <?php endif; ?>
            <div id="header_right">
    
                <?php global $current_user;
                      get_currentuserinfo(); 
                      if ( is_user_logged_in() ) :
                ?>
                <p><?php lang::_e( 'Chào'); ?> <span class="dotted"><a href="<?php echo frame::_()->getModule('pages')->getLink(array('mod' => 'user', 'action' => 'getProfileHtml'))?>"><?php echo $current_user->user_login; ?></a></span>! <span class="dotted"><a href="<?php echo wp_logout_url( home_url() ); ?>" class="signout"><?php echo lang::_e('Đăng xuất'); ?></a></span></p>
                <?php else : ?>
                <p><span class="dotted"><a href="<?php echo frame::_()->getModule('pages')->getLink(array('mod' => 'user', 'action' => 'getLoginForm'))?>"><?php echo lang::_e('Đăng nhập'); ?></a></span> / <span class="dotted"><a href="<?php echo frame::_()->getModule('pages')->getLink(array('mod' => 'user', 'action' => 'getRegisterForm'))?>" class="signout"><?php echo lang::_e('Đăng ký'); ?></a></span></p>
                <?php endif; ?>
    
                <?php get_search_form(); ?>
            </div>
            <div class="clr"></div>
		</hgroup>

		<nav id="access" role="navigation">
			<h1 class="assistive-text section-heading"><?php lang::_e( 'Main menu' ); ?></h1>
			<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content'); ?>"><?php lang::_e( 'Skip to content' ); ?></a></div>
            <div class="menu_bg" id="menu_left"></div>
            <div class="menu_bg" id="menu_right"></div>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_id' => 'main_menu', 'items_wrap'=>'<ul id="%1$s" class="%2$s">%3$s<div class="clr"></div></ul>' ) ); ?>
		</nav><!-- #access -->
	</header><!-- #branding -->
<div class="clr"></div>
	<div id="main">
		<?php if (is_home() and get_option('ready_hide_slider') != 'on'):
			ready_slider(); 
			endif; ?>
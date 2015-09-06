<?php
/**
 * Initialize the options before anything else.
 */
add_action( 'admin_init', 'custom_theme_options', 1 );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'sidebar'       => ''
    ),
    'sections'        => array( 
      array(
        'id'          => 'general',
        'title'       => 'Theme shared on WPLOCKER.COM - General Configuration'
      ),
      array(
        'id'          => 'custom',
        'title'       => 'General Theme Customizer'
      ),
	  array(
        'id'          => 'homepage',
        'title'       => 'Homepage  Customizer'
      ), 
	  array(
        'id'          => 'productbox',
        'title'       => 'Product Box Customizer'
      ),
      array(
        'id'          => 'shopdetails',
        'title'       => 'Shop Details'
      ),
      array(
        'id'          => 'slider',
        'title'       => 'Slider, Banner, Brands'
      ),
      array(
        'id'          => 'social',
        'title'       => 'Social Networks'
      ),
	   array(
        'id'          => 'language',
        'title'       => 'Language'
      ),
      array(
        'id'          => 'shortcodes',
        'title'       => 'Shortcodes'
      )
    ),
    'settings'        => array( 
	array(
        'id'          => 'hs_Lng_share',
        'label'       => 'Product page share text',
        'desc'        => 'Product page share text',
        'std'         => 'Hard to decide? Ask your friends :)',
        'type'        => 'text',
        'section'     => 'language',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ), 
	  array(
        'id'          => 'hs_Lng_ForgotLink',
        'label'       => 'Login page forgotten link text',
        'desc'        => 'Login page forgotten link text',
        'std'         => 'Click here to retrieve your password',
        'type'        => 'text',
        'section'     => 'language',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'hs_Lng_ProductView',
        'label'       => 'Product box view text',
        'desc'        => 'Product box view text',
        'std'         => 'View',
        'type'        => 'text',
        'section'     => 'language',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  
	  array(
        'id'          => 'hs_Lng_Comment_alert',
        'label'       => 'Post comment alert text',
        'desc'        => 'Post comment alert text',
        'std'         => 'You must be logged in to post a comment.',
        'type'        => 'text',
        'section'     => 'language',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	
	  array(
        'id'          => 'hs_Lng_Comment_Name',
        'label'       => 'Post comment textbox = name',
        'desc'        => 'Post comment textbox = name',
        'std'         => 'Name',
        'type'        => 'text',
        'section'     => 'language',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'hs_Lng_Comment_Mail',
        'label'       => 'Post comment textbox = mail',
        'desc'        => 'Post comment textbox = mail',
        'std'         => 'Mail',
        'type'        => 'text',
        'section'     => 'language',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ), 
	  array(
        'id'          => 'hs_Lng_Comment_Website',
        'label'       => 'Post comment textbox = website',
        'desc'        => 'Post comment textbox = website',
        'std'         => 'Website',
        'type'        => 'text',
        'section'     => 'language',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ), 
	  array(
        'id'          => 'hs_Lng_Comment_Message',
        'label'       => 'Post comment textbox = message',
        'desc'        => 'Post comment textbox = message',
        'std'         => 'Message',
        'type'        => 'text',
        'section'     => 'language',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ), 
	  array(
        'id'          => 'hs_Lng_Header_Welcome',
        'label'       => 'Header my account "welcome" text',
        'desc'        => 'Header my account "welcome" text',
        'std'         => 'Welcome',
        'type'        => 'text',
        'section'     => 'language',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ), 
	  array(
        'id'          => 'hs_Lng_Header_Shopper',
        'label'       => 'Header my account "shopper" text',
        'desc'        => 'Header my account "shopper" text',
        'std'         => 'Shopper',
        'type'        => 'text',
        'section'     => 'language',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'hs_Lng_Header_Login',
        'label'       => 'Header my account "login / register" text',
        'desc'        => 'Header my account "login / register" text',
        'std'         => 'Login / Register',
        'type'        => 'text',
        'section'     => 'language',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ), 
	  array(
        'id'          => 'hs_Lng_Header_Close',
        'label'       => 'Header mini cart "close" text',
        'desc'        => 'Header mini cart "close" text',
        'std'         => 'Close',
        'type'        => 'text',
        'section'     => 'language',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ), 
	  array(
        'id'          => 'hs_Lng_Header_Checkout',
        'label'       => 'Header mini cart "checkout" text',
        'desc'        => 'Header mini cart "checkout" text',
        'std'         => 'Checkout',
        'type'        => 'text',
        'section'     => 'language',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_logo',
        'label'       => 'Logo Image',
        'desc'        => 'Upload your own logo. Leave it blank if you decided to use text instead',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_logofont',
        'label'       => 'Logo Font',
        'desc'        => 'Insert Google Font name you want to use for your logo',
        'std'         => 'Bangers',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_logofontsize',
        'label'       => 'Logo Font Size',
        'desc'        => 'Size for logo text',
        'std'         => '',
        'type'        => 'measurement',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_fav',
        'label'       => 'Favicon',
        'desc'        => 'Upload your favicon',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_font',
        'label'       => 'Body Font',
        'desc'        => 'Default font setting. If you want to use this font-family, clear form for Body Google Font below.',
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_fontgoogle',
        'label'       => 'Body Google Font',
        'desc'        => 'If you decided to use Google Font, just insert the font name here. Leave form blank if you want to use default fonts selected above.',
        'std'         => 'Lato',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_sidebarpage',
        'label'       => 'Page sidebar',
        'desc'        => 'Select sidebar position for pages',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Left SideBar',
            'src'         => ''
          ),
          array(
            'value'       => '2',
            'label'       => 'Right Sidebar',
            'src'         => ''
          ),
          array(
            'value'       => 'no_sidebar',
            'label'       => 'No Sidebar',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'hs_sidebarblog',
        'label'       => 'Blog Sidebar',
        'desc'        => 'Select sidebar position for blog list and blog post',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Left Sidebar',
            'src'         => ''
          ),
          array(
            'value'       => '2',
            'label'       => 'Right Sidebar',
            'src'         => ''
          ),
          array(
            'value'       => 'no_sidebar',
            'label'       => 'No Sidebar',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'hs_sidebarshop',
        'label'       => 'Shop Sidebar',
        'desc'        => 'Select sidebar position for product listing',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Left Sidebar',
            'src'         => ''
          ),
          array(
            'value'       => '2',
            'label'       => 'Right Sidebar',
            'src'         => ''
          ),
          array(
            'value'       => 'no_sidebar',
            'label'       => 'No Sidebar',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'hs_account',
        'label'       => 'My Account page',
        'desc'        => 'Redirect user to login page for non-register members and my account for registered members',
        'std'         => '',
        'type'        => 'page-select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_homefeat',
        'label'       => 'Homepage Featured Products',
        'desc'        => 'Featured products title',
        'std'         => 'FEATURED PRODUCTS',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_homefeatno',
        'label'       => 'Number of Featured Products',
        'desc'        => 'Number of featured products you want to display on homepage',
        'std'         => '9',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_announcement',
        'label'       => 'Announcement',
        'desc'        => 'This section sit at footer area, beside payment method icons. You can insert greeting, promotion, announcement, testimoni or anything here. HTML is allowed.',
        'std'         => 'Welcome to HumbleShop.',
        'type'        => 'textarea',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_background',
        'label'       => 'Body Background',
        'desc'        => 'Custom your background look',
        'std'         => '',
        'type'        => 'background',
        'section'     => 'custom',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),   
	  array(
        'id'          => 'hs_backgroundslider',
        'label'       => 'Slider Background',
        'desc'        => 'Custom your background look',
        'std'         => '',
        'type'        => 'background',
        'section'     => 'homepage',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),  
	  array(
        'id'          => 'hs_bannerbg',
        'label'       => 'Banner background color',
        'desc'        => 'Custom your banner background look',
        'std'         => '',
        'type'        => 'background',
        'section'     => 'homepage',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ), 
	  array(
        'id'          => 'hs_homepagebg',
        'label'       => 'Homepage Background',
        'desc'        => 'Custom your Homepage background look',
        'std'         => '',
        'type'        => 'background',
        'section'     => 'homepage',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'hs_productboxbg',
        'label'       => 'Product box name background color',
        'desc'        => 'Select Product box name background color',
        'std'         => '#000',
        'type'        => 'colorpicker',
        'section'     => 'productbox',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ), 
	   array(
        'id'          => 'hs_productboxname',
        'label'       => 'Product box name text color',
        'desc'        => 'Select Product box name text color',
        'std'         => '#fff',
        'type'        => 'colorpicker',
        'section'     => 'productbox',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'hs_productboxpbg',
        'label'       => 'Product description  background color',
        'desc'        => 'Select Product box description background color',
        'std'         => '#000',
        'type'        => 'colorpicker',
        'section'     => 'productbox',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ), 
	  array(
        'id'          => 'hs_productboxpcolor',
        'label'       => 'Product description text color',
        'desc'        => 'Select Product box description text color',
        'std'         => '#fff',
        'type'        => 'colorpicker',
        'section'     => 'productbox',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'hs_productboxpricebg',
        'label'       => 'Product price background color',
        'desc'        => 'Select Product box price background color',
        'std'         => '#D56452',
        'type'        => 'colorpicker',
        'section'     => 'productbox',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ), 
	  
	  array(
        'id'          => 'hs_productboxpricecolor',
        'label'       => 'Product price text color',
        'desc'        => 'Select Product box price text color',
        'std'         => '#fff',
        'type'        => 'colorpicker',
        'section'     => 'productbox',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'hs_productboxbuttonbg',
        'label'       => 'Product button background color',
        'desc'        => 'Select Product box button text color',
        'std'         => '#000',
        'type'        => 'colorpicker',
        'section'     => 'productbox',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ), 
	  array(
        'id'          => 'hs_productboxbuttoncolor',
        'label'       => 'Product button text color',
        'desc'        => 'Select Product box button text color',
        'std'         => '#fff',
        'type'        => 'colorpicker',
        'section'     => 'productbox',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ), 
	 
      array(
        'id'          => 'hs_link',
        'label'       => 'Body link color',
        'desc'        => 'Choose default link color for body',
        'std'         => '#E55137',
        'type'        => 'colorpicker',
        'section'     => 'custom',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_panel',
        'label'       => 'Main panel color',
        'desc'        => 'Select color for main panel',
        'std'         => '#FFFFFF',
        'type'        => 'colorpicker',
        'section'     => 'custom',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_headpanel',
        'label'       => 'Page title background color',
        'desc'        => 'Select Page title background color',
        'std'         => '#fff',
        'type'        => 'colorpicker',
        'section'     => 'custom',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_line',
        'label'       => 'Border color',
        'desc'        => 'Select default border line color',
        'std'         => '#DDDDDD',
        'type'        => 'colorpicker',
        'section'     => 'custom',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_footerbg',
        'label'       => 'Footer background color',
        'desc'        => 'Select you footer background color',
        'std'         => '',
        'type'        => 'background',
        'section'     => 'custom',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_footerfont',
        'label'       => 'Footer font color',
        'desc'        => 'Choose default color for texts in footer.',
        'std'         => '#777777',
        'type'        => 'colorpicker',
        'section'     => 'custom',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_footerlink',
        'label'       => 'Footer link color',
        'desc'        => 'Choose font color for link in footer.',
        'std'         => '#bbbbbb',
        'type'        => 'colorpicker',
        'section'     => 'custom',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ), 
	  array(
        'id'          => 'hs_textdoubletextcolor',
        'label'       => 'Footer payment area text color',
        'desc'        => 'Select Footer payment area text color.',
        'std'         => '#bbbbbb',
        'type'        => 'colorpicker',
        'section'     => 'custom',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_footerline',
        'label'       => 'Footer border line color',
        'desc'        => 'Select footer border line color',
        'std'         => '#ddd',
        'type'        => 'colorpicker',
        'section'     => 'custom',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'hs_menubg',
        'label'       => 'Top menu background color',
        'desc'        => 'Select Top menu background color',
        'std'         => '#f5f5f5',
        'type'        => 'colorpicker',
        'section'     => 'homepage',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ), 
	  array(
        'id'          => 'hs_menubghover',
        'label'       => 'Top menu background hover color',
        'desc'        => 'Select Top menu background hover color',
        'std'         => '#E55137',
        'type'        => 'colorpicker',
        'section'     => 'homepage',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'hs_menulinkcolor',
        'label'       => 'Top menu link color',
        'desc'        => 'Select Top menu link color',
        'std'         => '#E55137',
        'type'        => 'colorpicker',
        'section'     => 'homepage',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'hs_menuborder',
        'label'       => 'Top menu border color',
        'desc'        => 'Select Top menu border color',
        'std'         => '#DBDBDB',
        'type'        => 'colorpicker',
        'section'     => 'homepage',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ), 
	  array(
        'id'          => 'hs_topheadercolor',
        'label'       => 'Header top link/text color',
        'desc'        => 'Select header top link/text color',
        'std'         => '#fff',
        'type'        => 'colorpicker',
        'section'     => 'homepage',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ), 
	  array(
        'id'          => 'hs_topheaderbg',
        'label'       => 'Header top background color',
        'desc'        => 'Select header top background color',
        'std'         => '#333',
        'type'        => 'colorpicker',
        'section'     => 'homepage',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'hs_searchborder',
        'label'       => 'Search border color',
        'desc'        => 'Select search border color',
        'std'         => '#CCC',
        'type'        => 'colorpicker',
        'section'     => 'homepage',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),  	 
	  array(
        'id'          => 'hs_searchiconcolor',
        'label'       => 'Search icon color',
        'desc'        => 'Select search icon color',
        'std'         => '#333',
        'type'        => 'colorpicker',
        'section'     => 'homepage',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	   array(
        'id'          => 'hs_counter',
        'label'       => 'Top cart background color',
        'desc'        => 'Select Top cart background color',
        'std'         => '#CF4A19',
        'type'        => 'colorpicker',
        'section'     => 'homepage',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ), 
      array(
        'id'          => 'hs_css',
        'label'       => 'Additional CSS',
        'desc'        => 'Enter your additional css here (optional)',
        'std'         => '',
        'type'        => 'css',
        'section'     => 'custom',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_add1',
        'label'       => 'Address 1',
        'desc'        => 'First row address',
        'std'         => 'First row address',
        'type'        => 'text',
        'section'     => 'shopdetails',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_add2',
        'label'       => 'Address 2',
        'desc'        => 'Second row address',
        'std'         => 'Second row address',
        'type'        => 'text',
        'section'     => 'shopdetails',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_town',
        'label'       => 'Town/City',
        'desc'        => 'Town/City',
        'std'         => 'Town',
        'type'        => 'text',
        'section'     => 'shopdetails',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_zip',
        'label'       => 'Postcode/ZIP',
        'desc'        => 'Postcode/ZIP',
        'std'         => 'Postcode',
        'type'        => 'text',
        'section'     => 'shopdetails',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_country',
        'label'       => 'Country',
        'desc'        => 'Country',
        'std'         => 'Country',
        'type'        => 'text',
        'section'     => 'shopdetails',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_phone',
        'label'       => 'Phone No',
        'desc'        => 'Phone number',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'shopdetails',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_fax',
        'label'       => 'Fax No',
        'desc'        => 'Fax number',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'shopdetails',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_email',
        'label'       => 'Email',
        'desc'        => 'Email address',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'shopdetails',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_bank',
        'label'       => 'Payment Option',
        'desc'        => 'Select payment method logos you want to display at the footer.',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'shopdetails',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'amex',
            'label'       => 'American Express',
            'src'         => ''
          ),
          array(
            'value'       => 'mastercard',
            'label'       => 'MasterCard',
            'src'         => ''
          ),
          array(
            'value'       => 'visa',
            'label'       => 'Visa',
            'src'         => ''
          ),
          array(
            'value'       => 'paypal',
            'label'       => 'Paypal',
            'src'         => ''
          ),
          array(
            'value'       => 'cirrus',
            'label'       => 'Cirrus',
            'src'         => ''
          ),
          array(
            'value'       => 'delta',
            'label'       => 'Deltad',
            'src'         => ''
          ),
          array(
            'value'       => 'direct-debit',
            'label'       => 'Direct Debit',
            'src'         => ''
          ),
          array(
            'value'       => 'discover',
            'label'       => 'Discoverd',
            'src'         => ''
          ),
          array(
            'value'       => 'ebay',
            'label'       => 'Ebay',
            'src'         => ''
          ),
          array(
            'value'       => 'google',
            'label'       => 'Google Checkout',
            'src'         => ''
          ),
          array(
            'value'       => 'maestro',
            'label'       => 'Maestro',
            'src'         => ''
          ),
          array(
            'value'       => 'moneybookers',
            'label'       => 'Moneybookers',
            'src'         => ''
          ),
          array(
            'value'       => 'sagepay',
            'label'       => 'Sagepay',
            'src'         => ''
          ),
          array(
            'value'       => 'solo',
            'label'       => 'Solo',
            'src'         => ''
          ),
          array(
            'value'       => 'switch',
            'label'       => 'Switch',
            'src'         => ''
          ),
          array(
            'value'       => 'visaelectron',
            'label'       => 'Visa Electron',
            'src'         => ''
          ),
          array(
            'value'       => 'twocheckout',
            'label'       => '2checkout',
            'src'         => ''
          ),
          array(
            'value'       => 'westernunion',
            'label'       => 'Western Union',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'hs_slider',
        'label'       => 'Slider',
        'desc'        => 'Add slider for front page',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'settings'    => array( 
          array(
            'id'          => 'hs_slideimage',
            'label'       => 'Image',
            'desc'        => 'Upload your banner image <em>(recommended size 940x400)</em>',
            'std'         => '',
            'type'        => 'upload',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
          array(
            'id'          => 'hs_slidelink',
            'label'       => 'Link',
            'desc'        => 'Insert link for the banner',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
          array(
            'id'          => 'hs_slidetext',
            'label'       => 'Additional Text',
            'desc'        => 'Insert short text for the banner. HTML is allowed',
            'std'         => '',
            'type'        => 'textarea',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          )
        )
      ),
      array(
        'id'          => 'hs_slidercarousel',
        'label'       => 'Slider carousel',
        'desc'        => 'Carousel option for slider in front page. Only nicely fit window if you have more than 5 sliders',
        'std'         => '0',
        'type'        => 'checkbox',
        'section'     => 'slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'true',
            'label'       => 'Enable',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'hs_banner',
        'label'       => 'Promo Banner',
        'desc'        => 'Check if you want to enable promo banner',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'true',
            'label'       => 'Enable',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'hs_promos',
        'label'       => 'Promo Banners',
        'desc'        => 'Upload promo banners, recommended is <strong>3 banners</strong>',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'settings'    => array( 
          array(
            'id'          => 'hs_bannerimg',
            'label'       => 'Banner image',
            'desc'        => 'Upload your promo banner. Recommended size is 260x140',
            'std'         => '',
            'type'        => 'upload',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
          array(
            'id'          => 'hs_bannerlink',
            'label'       => 'Banner Link',
            'desc'        => 'Insert URL for promo link',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          )
        )
      ),
      array(
        'id'          => 'hs_brand',
        'label'       => 'Brands carousel',
        'desc'        => 'Add Brands carousel title. Leave this field blank if you don\'t want to use this feature.',
        'std'         => 'Brands',
        'type'        => 'text',
        'section'     => 'slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_brandlist',
        'label'       => 'Brands Logo',
        'desc'        => 'Add Brand your logos',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'settings'    => array( 
          array(
            'id'          => 'hs_brandimage',
            'label'       => 'Image',
            'desc'        => 'Add Brand logo',
            'std'         => '',
            'type'        => 'upload',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          )
        )
      ),
      array(
        'id'          => 'facebook',
        'label'       => 'Facebook',
        'desc'        => 'Facebook user/page name',
        'std'         => 'envato',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'twitter',
        'label'       => 'Twitter',
        'desc'        => 'Your twitter username',
        'std'         => 'envato',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'gplus',
        'label'       => 'Google Plus',
        'desc'        => 'Your Google+ ID',
        'std'         => '107285294994146126204',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'pinterest',
        'label'       => 'Pinterest',
        'desc'        => 'Your pinterest username',
        'std'         => 'humblespace',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'tumblr',
        'label'       => 'Tumblr',
        'desc'        => 'Your tumblr page url',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'instagrem',
        'label'       => 'Instagram',
        'desc'        => 'Your instagram username',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'code',
        'label'       => 'Codes',
        'desc'        => '<p>Here is list of shortcodes for you to copy paste to your pages/posts.</p>

<p><strong>BUTTONS</strong><br>
Please refer to <a href="http://twitter.github.com/bootstrap/base-css.html#buttons" target="_blank">Bootstrap Buttons</a> for list of button types and sizes</p>
<blockquote>[button type="success" size="large" link="#"]...[/button]</blockquote>
<hr>
<p><strong>ALERTS</strong><br>
Please refer to <a href="http://twitter.github.com/bootstrap/components.html#alerts" target="_blank">Bootstrap Alerts</a> for lists of alert types</p>
<blockquote>[alert type="success"]...[/alert]</blockquote>
<hr>
<p><strong>CODE</strong><br>
To wrap your text with code tag, just use this shortcode below</p> 
<blockquote>[code]...[/code]</blockquote>
<hr>
<p><strong>LABELS &amp; BADGES</strong><br>Please refer to <a href="http://twitter.github.com/bootstrap/components.html#labels-badges" target="_blank">Bootstrap Labels and Badges</a> for lists of types</p> 
<blockquote>[label type="success"]...[/label]</blockquote>
<blockquote>[badge type="success"]...[/badge]</blockquote>
<hr>
<p><strong>WELLS</strong><br>Use the well as a simple effect on an element to give it an inset effect.</p>
<blockquote>[well]...[/well]</blockquote>
<hr>
<p><strong>TABLES</strong><br>For basic styling-light padding and only horizontal dividers-add the base class .table to any table. Refer to <a href="http://twitter.github.com/bootstrap/base-css.html#tables" target="_blank">Bootstrap Tables</a> for lists of table types.</p>
<blockquote>[table type="striped" cols="#,First Name, Last Name, Username" data="1, Filip, Stefansson, filipstefansson, 2, Victor, Meyer, Pudge, 3, Mans, Ketola-Backe, mossboll"]</blockquote>
<hr>
<p><strong>GRID</strong><br>The default Bootstrap grid system utilizes <strong>12 columns</strong>, making for a 940px wide container without responsive features enabled. With the responsive CSS file added, the grid adapts to be 724px and 1170px wide depending on your viewport. Below 767px viewports, the columns become fluid and stack vertically. For more details about Grid system, refer to <a href="http://twitter.github.com/bootstrap/scaffolding.html#gridSystem" target="_blank">Bootstrap Grid System</a></p> 
<blockquote>[row][span size="6"]...[/span][span size="6"]...[/span][/row]</blockquote>
<hr>
<p><strong>Accordion</strong><br>Accordian is a collapsable panel for those who wants to minimize space of the pages/posts.</p>
<blockquote>
  [collapsibles]
  [collapse title="Collapse 1" state="active"]
    ...
  [/collapse]
  [collapse title="Copllapse 2"]
    ...
  [/collapse]
  [collapse title="Copllapse 3"]
    ...
  [/collapse]
[/collapsibles]
</blockquote>
<hr>
<p><strong>Tabs</strong><br>Add quick, dynamic tab functionality to transition through panes of local content, even via dropdown menus.</p> 
<blockquote>
  [tabs]
  [tab title="Home"]
    ...
  [/tab]
  [tab title="Profile"]
    ...
  [/tab]
  [tab title="Messages"]
    ...
  [/tab]
[/tabs]
</blockquote>
<hr>
<p><strong>Icons</strong><br>There\'s 200 plus icons to use. Just grab icon name and replace it in the shortcode below. Refer to humbleshop demo for <a href="http://humbleshop.pagodabox.com/features.html" target="_blank">icon visual</a></p>
<blockquote>[icon type="arrow"]</blockquote>',
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'shortcodes',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      )
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( 'option_tree_settings_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
  
}
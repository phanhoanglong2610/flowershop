<?php
    if($_GET['page'] == 'theme-documentation') add_action('admin_footer', 'theme_docs_init');
    function theme_docs_init() {
        // js
        wp_register_script( 'theme-doc-selectnav', get_template_directory_uri() . '/functions/documentations/js/selectnav.js');
        wp_enqueue_script(  'theme-doc-selectnav' );
        
        wp_register_script( 'theme-doc-ddsmoothmenu', get_template_directory_uri() . '/functions/documentations/js/ddsmoothmenu.js');
        wp_enqueue_script(  'theme-doc-ddsmoothmenu' );
        
        wp_register_script( 'theme-doc-fitvids', get_template_directory_uri() . '/functions/documentations/js/jquery.fitvids.js');
        wp_enqueue_script(  'theme-doc-fitvids' );
        
        wp_register_script( 'theme-doc-scripts', get_template_directory_uri() . '/functions/documentations/js/scripts.js');
        wp_enqueue_script(  'theme-doc-scripts' );
        
        // css
        wp_enqueue_style( 'st-admin-style', get_template_directory_uri() . '/functions/documentations/css/style.css' );
    }   

    // creatimg sub-menu page
    function theme_docs_admin_menu(){
        add_submenu_page('theme_settings', 'Theme Documentation', 'Theme Documentation', 'edit_theme_options', 'theme-documentation', 'theme_docs_options');
    }
    add_action('admin_menu', 'theme_docs_admin_menu');
    
    // documentation page html code
    function theme_docs_options() {
?>
    <div class="scanlines"></div>
    
    <!-- Begin Header -->
    <div class="header-wrapper opacity">
        <div class="header">
            <!-- Begin Logo -->
            <div class="logo">
                <h1>Ready! to Be theme documentation</h1>
            </div>
            <!-- End Logo -->
            <!-- Begin Menu -->
            <div id="menu-wrapper">
                <div id="menu" class="menu">
                    <ul id="tiny">
                        <li><a href="#theme-features">Theme features</a>
                            <ul>
                                <li><a href="#theme-settings">Ready! To Be settings</a></li>
                                <li><a href="#other">Other theme option</a></li>
                            </ul>
                        </li>
                        <li><a href="#menu-widgets">Menu &amp; widgets</a></li>
                        <li><a href="#files">Files descriptions</a>
                            <ul>
                                <li><a href="#root">Root files and folders</a></li>
                                <li><a href="#func">"functions" folder files and folders</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="clear"></div>
            <!-- End Menu -->
        </div>
    </div>
    <!-- End Header -->
    
    <!-- Begin Wrapper -->
    <div class="wrapper"><!-- Begin Intro -->
        
        <div class="intro">A semantic, HTML5, canvas for CSS artists and an ultra-minimal set of super-clean templates for your own WordPress theme development.</div>
        <ul class="social">
            <li><a class="facebook" href="http://www.facebook.com/ReadyECommerce"></a></li>
            <li><a class="twitter" href="https://twitter.com/ReadyEcommerceW"></a></li>
        </ul><!-- End Intro --> 
        
        <h2 class="big-title" id="theme-features">Theme features</h2>
        <div class="clear"></div>
        
        <h3 class="sub-title" id="theme-settings">Ready! To Be settings</h3>
        
        <!-- Begin Blog Grid -->
        <div class="blog-wrap">
            <!-- Begin Blog -->
            <div class="blog-grid">
                <!-- Begin Image Format -->
                <div class="post format-image box"> 
                    <div class="frame">
                        <a href="#">
                            <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/doc/google-analitics.jpg'; ?>" alt="" />
                        </a>
                    </div>
                    <h2 class="title"><a href="#">Google Analitics</a></h2>
                    <div class="post-content">
                        <p>This theme, have easy way to adding a google analytics code for improving your business!</p>
                    </div>
                </div>
                <!-- End Image Format -->
                        
                <!-- Begin Image Format -->
                <div class="post format-image box"> 
                    <div class="frame">
                        <a href="#">
                            <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/doc/footer.jpg'; ?>" alt="" />
                        </a>
                    </div>
                    <h2 class="title"><a href="#">Footer options</a></h2>
                    <div class="post-content">
                        <p>You can adding your copyright text and show or hide footer widgets.</p>
                    </div>
                </div>
                <!-- End Image Format --> 
                
                <!-- Begin Video Format -->
                <div class="post format-video box"> 
                    <div class="video frame">
                        <object class="embeddedObject" width="1082" height="518" type="application/x-shockwave-flash" data="http://content.screencast.com/users/AndreyGrin/folders/Jing/media/986bf3da-80f6-4fee-b4ed-e56634c88193/jingswfplayer.swf">
                            <param name="movie" value="http://content.screencast.com/users/AndreyGrin/folders/Jing/media/986bf3da-80f6-4fee-b4ed-e56634c88193/jingswfplayer.swf">
                            <param name="quality" value="high">
                            <param name="bgcolor" value="#FFFFFF">
                            <param name="flashVars" value="containerwidth=1082&amp;containerheight=518&amp;thumb=http://content.screencast.com/users/AndreyGrin/folders/Jing/media/986bf3da-80f6-4fee-b4ed-e56634c88193/FirstFrame.jpg&amp;content=http://content.screencast.com/users/AndreyGrin/folders/Jing/media/986bf3da-80f6-4fee-b4ed-e56634c88193/design-option.swf&amp;blurover=false">
                            <param name="allowFullScreen" value="true">
                            <param name="scale" value="showall">
                            <param name="allowScriptAccess" value="always">
                            <param name="base" value="http://content.screencast.com/users/AndreyGrin/folders/Jing/media/986bf3da-80f6-4fee-b4ed-e56634c88193/">
                        </object>
                    </div>
                    <h2 class="title"><a href="#">Design options</a></h2>
                    <div class="post-content">
                        <p>Customize your theme with our design options panel.</p>
                        <a href="#" class="readmore">Read more</a>
                        <div class="hidden-text">
                            <p>What you can do:</p>
                            <ul>
                                <li>Setting your own background or choose it from our presets</li>
                                <li>Choose custom fonts for headings and other text in your shop</li>
                                <li>Hide slider on your Home page</li>
                                <li>Restore all design setting to default</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Image Format --> 
                
                <!-- Begin Image Format -->
                <div class="post format-image box"> 
                    <div class="frame">
                        <a href="#">
                            <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/doc/logo.jpg'; ?>" alt="" />
                        </a>
                    </div>
                    <h2 class="title"><a href="#">Logo options</a></h2>
                    <div class="post-content">
                        <p>You can uploading your logo image and choosing a few variants to display this.</p>
                    </div>
                </div>
                <!-- End Image Format -->
                                
                <div class="clear"></div>
                
                <h3 class="sub-title" id="other">Other theme option</h3>
                
                <!-- Begin Image Format -->
                <div class="post format-image box"> 
                    <div class="frame">
                        <a href="#">
                            <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/doc/contact.jpg'; ?>" alt="" />
                        </a>
                    </div>
                    <h2 class="title"><a href="#">Contact form</a></h2>
                    <div class="post-content">
                        <p>Contact form for all your needs.</p>
                    </div>
                </div>
                <!-- End Image Format -->
                
                <!-- Begin Video Format -->
                <div class="post format-video box"> 
                    <div class="video frame">
                        <object class="embeddedObject" width="1028" height="552" type="application/x-shockwave-flash" data="http://content.screencast.com/users/AndreyGrin/folders/Jing/media/5ebb51ed-8403-4419-ab9f-3c5a9eea7273/jingswfplayer.swf">
                            <param name="movie" value="http://content.screencast.com/users/AndreyGrin/folders/Jing/media/5ebb51ed-8403-4419-ab9f-3c5a9eea7273/jingswfplayer.swf">
                            <param name="quality" value="high">
                            <param name="bgcolor" value="#FFFFFF">
                            <param name="flashVars" value="containerwidth=1028&amp;containerheight=552&amp;thumb=http://content.screencast.com/users/AndreyGrin/folders/Jing/media/5ebb51ed-8403-4419-ab9f-3c5a9eea7273/FirstFrame.jpg&amp;content=http://content.screencast.com/users/AndreyGrin/folders/Jing/media/5ebb51ed-8403-4419-ab9f-3c5a9eea7273/slider.swf&amp;blurover=false">
                            <param name="allowFullScreen" value="true">
                            <param name="scale" value="showall">
                            <param name="allowScriptAccess" value="always">
                            <param name="base" value="http://content.screencast.com/users/AndreyGrin/folders/Jing/media/5ebb51ed-8403-4419-ab9f-3c5a9eea7273/">
                        </object>
                    </div>
                    <h2 class="title"><a href="#">Home slider</a></h2>
                    <div class="post-content">
                        <p>Awesome slider with different effects and powerful functions.</p>
                    </div>
                </div>
                <!-- End Video Format -->
                
                <!-- Begin Video Format -->
                <div class="post format-video box"> 
                    <div class="video frame">
                        <object class="embeddedObject" width="1028" height="552" type="application/x-shockwave-flash" data="http://content.screencast.com/users/AndreyGrin/folders/Jing/media/2edf7a05-98b4-46bb-8bfd-8fd300b7412b/jingswfplayer.swf">
                            <param name="movie" value="http://content.screencast.com/users/AndreyGrin/folders/Jing/media/2edf7a05-98b4-46bb-8bfd-8fd300b7412b/jingswfplayer.swf">
                            <param name="quality" value="high">
                            <param name="bgcolor" value="#FFFFFF">
                            <param name="flashVars" value="containerwidth=1028&amp;containerheight=552&amp;thumb=http://content.screencast.com/users/AndreyGrin/folders/Jing/media/2edf7a05-98b4-46bb-8bfd-8fd300b7412b/FirstFrame.jpg&amp;content=http://content.screencast.com/users/AndreyGrin/folders/Jing/media/2edf7a05-98b4-46bb-8bfd-8fd300b7412b/social.swf&amp;blurover=false">
                            <param name="allowFullScreen" value="true">
                            <param name="scale" value="showall">
                            <param name="allowScriptAccess" value="always">
                            <param name="base" value="http://content.screencast.com/users/AndreyGrin/folders/Jing/media/2edf7a05-98b4-46bb-8bfd-8fd300b7412b/">
                        </object>
                    </div>
                    <h2 class="title"><a href="#">Social icons</a></h2>
                    <div class="post-content">
                        <p>Simple adding social networks to the footer widget.</p>
                    </div>
                </div>
                <!-- End Video Format -->
                
                <div class="clear"></div>
                
                <h2 class="big-title" id="menu-widgets">Menu &amp; widgets</h2>
                
                <div class="clear"></div>
                
                <!-- Begin Video Format -->
                <div class="post format-video box"> 
                    <div class="video frame">
                        <object id="scPlayer" class="embeddedObject" width="1028" height="552" type="application/x-shockwave-flash" data="http://content.screencast.com/users/AndreyGrin/folders/Jing/media/6c665178-302e-4b71-83b5-b94d25d589fe/jingswfplayer.swf">
                            <param name="movie" value="http://content.screencast.com/users/AndreyGrin/folders/Jing/media/6c665178-302e-4b71-83b5-b94d25d589fe/jingswfplayer.swf">
                            <param name="quality" value="high">
                            <param name="bgcolor" value="#FFFFFF">
                            <param name="flashVars" value="containerwidth=1028&amp;containerheight=552&amp;thumb=http://content.screencast.com/users/AndreyGrin/folders/Jing/media/6c665178-302e-4b71-83b5-b94d25d589fe/FirstFrame.jpg&amp;content=http://content.screencast.com/users/AndreyGrin/folders/Jing/media/6c665178-302e-4b71-83b5-b94d25d589fe/menu.swf&amp;blurover=false">
                            <param name="allowFullScreen" value="true">
                            <param name="scale" value="showall">
                            <param name="allowScriptAccess" value="always">
                            <param name="base" value="http://content.screencast.com/users/AndreyGrin/folders/Jing/media/6c665178-302e-4b71-83b5-b94d25d589fe/">
                        </object>
                    </div>
                    <h2 class="title"><a href="#">Creating menu</a></h2>
                    <div class="post-content">
                        <p>How to create and place menu.</p>
                    </div>
                </div>
                <!-- End Video Format -->
                
                <!-- Begin Video Format -->
                <div class="post format-video box"> 
                    <div class="video frame">
                        <object id="scPlayer" class="embeddedObject" width="1028" height="552" type="application/x-shockwave-flash" data="http://content.screencast.com/users/AndreyGrin/folders/Jing/media/6c665178-302e-4b71-83b5-b94d25d589fe/jingswfplayer.swf">
                            <param name="movie" value="http://content.screencast.com/users/AndreyGrin/folders/Jing/media/6c665178-302e-4b71-83b5-b94d25d589fe/jingswfplayer.swf">
                            <param name="quality" value="high">
                            <param name="bgcolor" value="#FFFFFF">
                            <param name="flashVars" value="containerwidth=1028&amp;containerheight=552&amp;thumb=http://content.screencast.com/users/AndreyGrin/folders/Jing/media/6c665178-302e-4b71-83b5-b94d25d589fe/FirstFrame.jpg&amp;content=http://content.screencast.com/users/AndreyGrin/folders/Jing/media/6c665178-302e-4b71-83b5-b94d25d589fe/menu.swf&amp;blurover=false">
                            <param name="allowFullScreen" value="true">
                            <param name="scale" value="showall">
                            <param name="allowScriptAccess" value="always">
                            <param name="base" value="http://content.screencast.com/users/AndreyGrin/folders/Jing/media/6c665178-302e-4b71-83b5-b94d25d589fe/">
                        </object>
                    </div>
                    <h2 class="title"><a href="#">Theme widgets</a></h2>
                    <div class="post-content">
                        <p>How to create, setup and place widgets to the right positions.</p>
                        <a href="#" class="readmore">Read more</a>
                        <div class="hidden-text">
                            <p>Theme has built-in footer widgets, but you can add custom widgets to this positions. <br />
                            If you want hide built-in footer widgets, you can do this from Ready! To Be setting panel.</p>
                        </div>
                    </div>
                </div>
                <!-- End Video Format -->
                
                <div class="clear"></div>
                
                <h2 class="big-title" id="files">Files descriptions</h2>
                                
                <div class="clear"></div>
                
                <h3 class="sub-title" id="root">Root files and folders</h3>
                
                <div class="clear"></div>
                
                <div class="file">
                    <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/php.png'; ?>" alt="" />
                    <h2>full-width-page.php</h2>
                    <p>Template page for displaying content without sidebars.</p>
                </div>
                
                <div class="file">
                    <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/php.png'; ?>" alt="" />
                    <h2>ie.php</h2>
                    <p>Internet explorer css3 fix.</p>
                </div>
                
                <div class="file">
                    <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/php.png'; ?>" alt="" />
                    <h2>plugin-activation.php</h2>
                    <p>Activate Ready! Ecommerce plugin if not yet.</p>
                </div>
                
                <div class="file">
                    <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/css.png'; ?>" alt="" />
                    <h2>rtl.css</h2>
                    <p>Right to left  style.</p>
                </div>
                
                <div class="file">
                    <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/php.png'; ?>" alt="" />
                    <h2>update.php</h2>
                    <p>Allow to receive new updates for this theme.</p>
                </div>
                
                <div class="file">
                    <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/css.png'; ?>" alt="" />
                    <h2>sociallinks.css</h2>
                    <p>Style for social buttons in the footer.</p>
                </div>
                
                <div class="file">
                    <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/folder.png'; ?>" alt="" />
                    <h2>js</h2>
                    <p>Contains all frontend theme scripts.</p>
                </div>
                
                <div class="file">
                    <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/js.png'; ?>" alt="" />
                    <h2>add.js</h2>
                    <p>Internet Explorer fix.</p>
                </div>
                
                <div class="file">
                    <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/js.png'; ?>" alt="" />
                    <h2>custom_radio_checkbox.js</h2>
                    <p>Custom checkboxes style.</p>
                </div>
                
                <div class="file">
                    <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/js.png'; ?>" alt="" />
                    <h2>html5.js</h2>
                    <p>Internet Explorer fix to support html5.</p>
                </div>
                
                <div class="file">
                    <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/js.png'; ?>" alt="" />
                    <h2>jquery.easing.1.3.js</h2>
                    <p>jQuery easing animations.</p>
                </div>
                
                <div class="file">
                    <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/js.png'; ?>" alt="" />
                    <h2>jquery.prettyPhoto.js</h2>
                    <p>jQuery image gallery for product page.</p>
                </div>
                
                <div class="file">
                    <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/js.png'; ?>" alt="" />
                    <h2>jquery.selectbox-0.6.1.js</h2>
                    <p>Custom selectbox style.</p>
                </div>
                
                <div class="file">
                    <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/js.png'; ?>" alt="" />
                    <h2>jquery.slider.js</h2>
                    <p>Custom slider.</p>
                </div>
                
                <div class="file">
                    <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/js.png'; ?>" alt="" />
                    <h2>pie.js</h2>
                    <p>Internet Explorer css3 fix.</p>
                </div>
                
                <div class="file">
                    <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/js.png'; ?>" alt="" />
                    <h2>sociallinks.js</h2>
                    <p>Social links scripts.</p>
                </div>
                
                <div class="file">
                    <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/js.png'; ?>" alt="" />
                    <h2>tabs.js</h2>
                    <p>jQuery tabs plugin.</p>
                </div>
                
                <div class="file">
                    <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/js.png'; ?>" alt="" />
                    <h2>theme-scripts.js</h2>
                    <p>Theme scripts initializations and other functions.</p>
                </div>
                
                <div class="file">
                    <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/folder.png'; ?>" alt="" />
                    <h2>functions</h2>
                    <p>Contains additional functional modules.</p>
                </div>
                
                <div class="file">
                    <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/folder.png'; ?>" alt="" />
                    <h2>locale</h2>
                    <p>Contact form translations.</p>
                </div>
                
                <div class="file">
                    <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/folder.png'; ?>" alt="" />
                    <h2>toe</h2>
                    <p>Ready! Shopping cart modules customizations for theme.</p>
                </div>
                
                <div class="clear"></div>
                
                <h3 class="sub-title" id="func">"functions" folder files and folders</h3>
                
                <div class="clear"></div>
                                
                <div class="file">
                    <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/folder.png'; ?>" alt="" />
                    <h2>admin_slider</h2>
                    <p>Slider module. Admin part.</p>
                </div>
                
                <div class="file">
                    <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/folder.png'; ?>" alt="" />
                    <h2>functions/css</h2>
                    <p>Admin styles for theme option panel.</p>
                </div>
                
                <div class="file">
                    <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/folder.png'; ?>" alt="" />
                    <h2>functions/js</h2>
                    <p>Admin scripts for theme option panel.</p>
                </div>
                
                <div class="file">
                    <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/folder.png'; ?>" alt="" />
                    <h2>documentations</h2>
                    <p>Theme Documentation module.</p>
                </div>
                
                <div class="file">
                    <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/folder.png'; ?>" alt="" />
                    <h2>livesettings</h2>
                    <p>Live settings frontend panel and Design option for admin theme option panel.</p>
                </div>
                
                <div class="file">
                    <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/php.png'; ?>" alt="" />
                    <h2>admin-menu.php</h2>
                    <p>Theme option panel.</p>
                </div>
                
                <div class="file">
                    <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/php.png'; ?>" alt="" />
                    <h2>bread.php</h2>
                    <p>Breadcrumbs navigation.</p>
                </div> 

                <div class="file">
                    <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/php.png'; ?>" alt="" />
                    <h2>sociallinks.php</h2>
                    <p>Social links module.</p>
                </div>    

                <div class="file">
                    <img src="<?php echo get_template_directory_uri().'/functions/documentations/images/php.png'; ?>" alt="" />
                    <h2>tiny-contact-form.php</h2>
                    <p>Powerful contact form.</p>
                </div>                
                
                <div class="clear"></div>
                
            </div>
        </div>
    </div>
    <div class="site-generator-wrapper">
        <div class="site-generator">Copyright <a href="http://readyshoppingcart.com/">ReadyShoppingcart</a> 2012-2013. All rights reserved. <a href="#" class="movetop">Go to top &uarr;</a></div>
    </div>
    
    <div class="doc-popup-shadow"></div>
    <div class="doc-popup">
        <div class="doc-title"></div>
        <div class="doc-close">X</div>
        <div class="doc-popup-wrapper">
            <div class="doc-head"></div>
            <div class="doc-content"></div>
        </div>
    </div>
    
<?php } ?>
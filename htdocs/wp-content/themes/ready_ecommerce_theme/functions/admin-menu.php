<?php
if(class_exists('frame')) {
	add_filter( 'wp_redirect', 'themeSaveOptionsRedirect', 99, 2 );	// Dissallow redirect after options saving via ajax request
	function themeSaveOptionsRedirect($location, $status) {
		$urlData = parse_url($location);
		$reqType = req::getVar('reqType');
		if($status == 302 
			&& $reqType == 'ajax'
			&& isset($urlData['path'])
			&& isset($urlData['query'])
			&& (strpos($urlData['path'], 'wp-admin') !== false)
			&& ($urlData['query'] == 'page=theme_settings&settings-updated=true')
		) {
			return false;
		}
		return $location;
	}
}
function AdminLiveInit() {
// Live Settings Script for admin

wp_register_script( 'admin-live-script', get_template_directory_uri() . '/functions/js/admin-js.js');
wp_enqueue_script(  'admin-live-script' );

wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_enqueue_script('site-logo', get_template_directory_uri().'/functions/js/siteLogo.js');

wp_enqueue_style( 'st-admin-style', get_template_directory_uri() . '/functions/css/style.css' );
}
if ($_REQUEST['page'] == 'theme_settings'){
    add_action('admin_footer', 'AdminLiveInit');
}

add_action('admin_menu', 'ready_create_menu');

function ready_create_menu() {
    $path = get_bloginfo('template_directory').'/';
    add_menu_page('Ready! To Be Theme Settings', 'Ready! To Be Settings', 'administrator', 'theme_settings', 'scom_settings_page', $path.'images/favicon.png');

    add_action( 'admin_init', 'register_mysettings' );
}

function register_mysettings() {
    // Page options
    register_setting( 'ready-settings-group', 'ready_gmap_html' );
    register_setting( 'ready-settings-group', 'ready_gcode' );
    
    // Footer options
    register_setting( 'ready-settings-group', 'ready_copyright' );
	register_setting( 'ready-settings-group', 'ready_recent_hide' );
	register_setting( 'ready-settings-group', 'ready_contact_hide' );
	register_setting( 'ready-settings-group', 'ready_newsletter_hide' );
	register_setting( 'ready-settings-group', 'ready_findus_hide' );
    register_setting( 'ready-settings-group', 'ready_terms_link' );
    register_setting( 'ready-settings-group', 'ready_terms_link_show' );
        
    // Logo options
    register_setting( 'ready-settings-group', 'ready_site_logo' );
    register_setting( 'ready-settings-group', 'ready_only_image' );
    register_setting( 'ready-settings-group', 'ready_only_text' );
    
    // Design options
    register_setting( 'ready-settings-group', 'ready_userbgimg' );
    register_setting( 'ready-settings-group', 'ready_bgimg' );
    register_setting( 'ready-settings-group', 'ready_bgcol' );
    register_setting( 'ready-settings-group', 'ready_google_font_name' );
    register_setting( 'ready-settings-group', 'ready_google_font_tags' );
    register_setting( 'ready-settings-group', 'ready_content_font_name' );	
    register_setting( 'ready-settings-group', 'ready_live_settings' );	
    register_setting( 'ready-settings-group', 'ready_hide_slider' );	
}

function scom_settings_page() {
	$bgcolor = '#ffffff';
?>
<script type="text/javascript">
// <!--
jQuery(document).ready(function(){
	jQuery('#toeThemeEditOptionForm').submit(function(){
		toeSaveThemeOptionsAjax(jQuery(this).serialize());
		return false;
	});
	jQuery('#toeResetSidebarToDefaultSubmit').click(function(){
		toeSaveThemeOptionsAjax(jQuery('#toeThemeEditOptionForm').serialize()+ '&resetSidebarToDefault='+ jQuery(this).val());
		return false;
	});
	jQuery('#toeTemplateResetDesignSettings').click(function(){
		var form = jQuery('#toeThemeEditOptionForm');
		jQuery(form).find('#ready_bgimg').val('');
		jQuery(form).find('#live-colorpicker').css('background-color', '<?php echo $bgcolor;?>');
		jQuery(form).find('#live-colorpicker').val('<?php echo $bgcolor;?>');
		
		jQuery(form).find('#ready_google_font_name').get(0).selectedIndex = 0;
		jQuery(form).find('#ready_google_font_name').trigger('change');
		
		jQuery(form).find('#ready_content_font_name').get(0).selectedIndex = 0;
		jQuery(form).find('#ready_content_font_name').trigger('change');
		
		toeSaveThemeOptionsAjax(jQuery('#toeThemeEditOptionForm').serialize());
		return false;
	});
});
function toeSaveThemeOptionsAjax(data) {
	jQuery.sendForm({
		msgElID: 'toeThemeEditFormMsg',
		url: '<?php echo get_admin_url(0, 'options.php')?>',
		data: data,
		dataType: 'text',
		onSuccess: function(res) {
			jQuery('#toeThemeEditFormMsg').html(toeLang('Done'));
		}
	});
}
// -->
</script>
<div class="rt_wrap">
    <h2 id="rt_title"><?php lang::_e('Ready! To Be Theme Settings'); ?></h2>

    <form method="post" action="options.php" class="rt_opts" id="toeThemeEditOptionForm">

    <?php settings_fields('ready-settings-group'); ?>
    <div id="rt_tabs">
        <ul>
            <li class="rt_pages"><a href="#rt_pages"><?php lang::_e('General Options'); ?></a></li>
            <li class="rt_footer"><a href="#rt_footer"><?php lang::_e('Footer Options'); ?></a></li>
            <li class="rt_design"><a href="#rt_design"><?php lang::_e('Design Options'); ?></a></li>
            <li class="rt_logo"><a href="#rt_logo"><?php lang::_e('Logo Options'); ?></a></li>
        </ul>
        
        <div id="rt_pages">
            <h3><?php lang::_e('Google Analitics'); ?></h3>
            <div class="rt_input rt_text">
                <div class="rt_description">
                    <label for="ready_gcode"><?php lang::_e('Google Analitics Code'); ?></label>
                    <small><?php lang::_e('Would be placed in header.'); ?></small>
                    <div class="rt_clearfix"></div>
                </div>
                <textarea name="ready_gcode" id="ready_gcode" style="height:120px;"><?php echo esc_attr(get_option('ready_gcode')); ?></textarea>
                <div class="rt_clearfix"></div>
            </div>
        </div>
        <div id="rt_footer">
            <div class="rt_input rt_text">
                <div class="rt_description">
                    <label for="ready_copyright"><?php lang::_e('Footer Copyright Text'); ?></label>
                    <small><?php lang::_e('Copyright text in the site footer.'); ?></small>
                    <div class="rt_clearfix"></div>
                </div>
                <input name="ready_copyright" id="ready_copyright" type="text" value="<?php echo esc_attr(get_option('ready_copyright')); ?>" />
                <div class="rt_clearfix"></div>
            </div>
                        
            <div class="rt_input rt_checkbox">
                <div class="rt_description">
                    <label for="ready_recent_hide"><?php lang::_e('Hide Recent Posts Block'); ?></label>
                    <div class="rt_clearfix"></div>
                </div>
                <input name="ready_recent_hide" id="ready_recent_hide" type="checkbox" <?php if(get_option('ready_recent_hide') == 'on') echo "checked='checked'"; ?> />
                <div class="rt_clearfix"></div>
            </div>             
                        
            <div class="rt_input rt_checkbox">
                <div class="rt_description">
                    <label for="ready_contact_hide"><?php lang::_e('Hide Contact Us Block'); ?></label>
                    <div class="rt_clearfix"></div>
                </div>
                <input name="ready_contact_hide" id="ready_contact_hide" value="on" type="checkbox" <?php if(get_option('ready_contact_hide') == 'on') echo "checked='checked'"; ?> />
                <div class="rt_clearfix"></div>
            </div>       

            <div class="rt_input rt_checkbox">
                <div class="rt_description">
                    <label for="ready_newsletter_hide"><?php lang::_e('Hide Newsletter Block'); ?></label>
                    <div class="rt_clearfix"></div>
                </div>
                <input name="ready_newsletter_hide" id="ready_newsletter_hide" type="checkbox" <?php if(get_option('ready_newsletter_hide') == 'on') echo "checked='checked'"; ?> />
                <div class="rt_clearfix"></div>
            </div>    
            
            <div class="rt_input rt_checkbox">
                <div class="rt_description">
                    <label for="ready_findus_hide"><?php lang::_e('Hide Find Us Block'); ?></label>
                    <div class="rt_clearfix"></div>
                </div>
                <input name="ready_findus_hide" id="ready_findus_hide" type="checkbox" <?php if(get_option('ready_findus_hide') == 'on') echo "checked='checked'"; ?> />
                <div class="rt_clearfix"></div>
            </div>    
        </div>
        <div id="rt_design">
            <div class="rt_input rt_text">
                <div class="rt_description">
                    <label for="ready_userbgimg"><?php lang::_e('Your own background image'); ?></label>
                    <small><?php lang::_e('You can choose our image below or write a link for your own.'); ?></small>
                    <div class="rt_clearfix"></div>
                </div>
                <input type="text" name="ready_userbgimg" id="ready_userbgimg" value="<?php echo esc_attr(get_option('ready_userbgimg')); ?>" />
                <div class="rt_clearfix"></div>
            </div>
            
            <div class="rt_input rt_text">
                <div class="rt_description">
                    <label for="ready_bgimg"><?php lang::_e('Background image'); ?></label>
                    <div class="rt_clearfix"></div>
                </div>
                <textarea name="ready_bgimg" id="ready_bgimg"><?php echo esc_attr(get_option('ready_bgimg')); ?></textarea>
                <div class="rt_clearfix"></div>
            </div>
            <div class="left-bar">
                <h4><?php lang::_e('Images'); ?></h4>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/1.jpg'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/thumbs/1.png'; ?>" />
                </a>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/2.jpg'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/thumbs/2.png'; ?>" />
                </a>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/3.jpg'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/thumbs/3.png'; ?>" />
                </a>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/4.jpg'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/thumbs/4.png'; ?>" />
                </a>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/5.jpg'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/thumbs/5.png'; ?>" />
                </a>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/6.jpg'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/thumbs/6.png'; ?>" />
                </a>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/7.jpg'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/thumbs/7.png'; ?>" />
                </a>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/8.jpg'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/thumbs/8.png'; ?>" />
                </a>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/9.jpg'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/thumbs/9.png'; ?>" />
                </a>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/10.jpg'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/thumbs/10.png'; ?>" />
                </a>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/11.jpg'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/thumbs/11.png'; ?>" />
                </a>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/12.jpg'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/thumbs/12.png'; ?>" />
                </a>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/13.jpg'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/thumbs/13.png'; ?>" />
                </a>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/14.jpg'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/thumbs/14.png'; ?>" />
                </a>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/15.jpg'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/thumbs/15.png'; ?>" />
                </a>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/16.jpg'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/thumbs/16.png'; ?>" />
                </a>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/17.jpg'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/thumbs/17.png'; ?>" />
                </a>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/18.jpg'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/thumbs/18.png'; ?>" />
                </a>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/19.jpg'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/thumbs/19.png'; ?>" />
                </a>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/20.jpg'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/thumbs/20.png'; ?>" />
                </a>
                <div class="clear"></div>
                
                <h4><?php lang::_e('Patterns'); ?></h4>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/patterns/1.png'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/patterns/thumbs/1.png'; ?>" />
                </a>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/patterns/2.png'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/patterns/thumbs/2.png'; ?>" />
                </a>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/patterns/3.png'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/patterns/thumbs/3.png'; ?>" />
                </a>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/patterns/4.png'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/patterns/thumbs/4.png'; ?>" />
                </a>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/patterns/5.png'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/patterns/thumbs/5.png'; ?>" />
                </a>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/patterns/6.png'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/patterns/thumbs/6.png'; ?>" />
                </a>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/patterns/7.png'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/patterns/thumbs/7.png'; ?>" />
                </a>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/patterns/8.png'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/patterns/thumbs/8.png'; ?>" />
                </a>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/patterns/9.png'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/patterns/thumbs/9.png'; ?>" />
                </a>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/patterns/10.png'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/patterns/thumbs/10.png'; ?>" />
                </a>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/patterns/11.png'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/patterns/thumbs/11.png'; ?>" />
                </a>
                <a class="body-change" title="Click to preview" href="<?php echo bloginfo('template_directory').'/functions/livesettings/img/patterns/12.png'; ?>">
                    <img src="<?php echo bloginfo('template_directory').'/functions/livesettings/img/patterns/thumbs/12.png'; ?>" />
                </a>
                <div class="clear"></div>
                <h4 style="margin-top:28px;"><?php lang::_e('Custom Background Color'); ?></h4>
                <input type="text" name="ready_bgcol" id="live-colorpicker" class="colorpicker" value="<?php if(get_option('ready_bgcol') != '') {echo esc_attr(get_option('ready_bgcol'));} else {echo $bgcolor;} ?>" />
            </div>
            <div class="right-bar">
                <h4><?php lang::_e('Preview'); ?></h4>
                <div id="live-prev">
                    <div id="site-place"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
            <hr style="margin-top:25px;" />
            
            <div class="left-bar">
                <h4><?php lang::_e('Headings - Google Font'); ?></h4>
                <select name="ready_google_font_name" id="ready_google_font_name">
                    <?php $GoogleFontsArray = Array ("Select", "Abel", "Abril Fatface", "Aclonica", "Acme", "Actor", "Adamina", "Advent Pro",
                        "Aguafina Script", "Aladin", "Aldrich", "Alegreya", "Alegreya SC", "Alex Brush", "Alfa Slab One", "Alice",
                        "Alike", "Alike Angular", "Allan", "Allerta", "Allerta Stencil", "Allura", "Almendra", "Almendra SC", "Amaranth",
                        "Amatic SC", "Amethysta", "Andada", "Andika", "Angkor", "Annie Use Your Telescope", "Anonymous Pro", "Antic",
                        "Antic Didone", "Antic Slab", "Anton", "Arapey", "Arbutus", "Architects Daughter", "Arimo", "Arizonia", "Armata",
                        "Artifika", "Arvo", "Asap", "Asset", "Astloch", "Asul", "Atomic Age", "Aubrey", "Audiowide", "Average",
                        "Averia Gruesa Libre", "Averia Libre", "Averia Sans Libre", "Averia Serif Libre", "Bad Script", "Balthazar",
                        "Bangers", "Basic", "Battambang", "Baumans", "Bayon", "Belgrano", "Belleza", "Bentham", "Berkshire Swash",
                        "Bevan", "Bigshot One", "Bilbo", "Bilbo Swash Caps", "Bitter", "Black Ops One", "Bokor", "Bonbon", "Boogaloo",
                        "Bowlby One", "Bowlby One SC", "Brawler", "Bree Serif", "Bubblegum Sans", "Buda", "Buenard", "Butcherman",
                        "Butterfly Kids", "Cabin", "Cabin Condensed", "Cabin Sketch", "Caesar Dressing", "Cagliostro", "Calligraffitti",
                        "Cambo", "Candal", "Cantarell", "Cantata One", "Cardo", "Carme", "Carter One", "Caudex", "Cedarville Cursive",
                        "Ceviche One", "Changa One", "Chango", "Chau Philomene One", "Chelsea Market", "Chenla", "Cherry Cream Soda",
                        "Chewy", "Chicle", "Chivo", "Coda", "Coda Caption", "Codystar", "Comfortaa", "Coming Soon", "Concert One",
                        "Condiment", "Content", "Contrail One", "Convergence", "Cookie", "Copse", "Corben", "Cousine", "Coustard",
                        "Covered By Your Grace", "Crafty Girls", "Creepster", "Crete Round", "Crimson Text", "Crushed", "Cuprum", "Cutive",
                        "Damion", "Dancing Script", "Dangrek", "Dawning of a New Day", "Days One", "Delius", "Delius Swash Caps", 
                        "Delius Unicase", "Della Respira", "Devonshire", "Didact Gothic", "Diplomata", "Diplomata SC", "Doppio One", 
                        "Dorsa", "Dosis", "Dr Sugiyama", "Droid Sans", "Droid Sans Mono", "Droid Serif", "Duru Sans", "Dynalight",
                        "EB Garamond", "Eater", "Economica", "Electrolize", "Emblema One", "Emilys Candy", "Engagement", "Enriqueta",
                        "Erica One", "Esteban", "Euphoria Script", "Ewert", "Exo", "Expletus Sans", "Fanwood Text", "Fascinate", "Fascinate Inline",
                        "Federant", "Federo", "Felipa", "Fjord One", "Flamenco", "Flavors", "Fondamento", "Fontdiner Swanky", "Forum",
                        "Francois One", "Fredericka the Great", "Fredoka One", "Freehand", "Fresca", "Frijole", "Fugaz One", "GFS Didot",
                        "GFS Neohellenic", "Galdeano", "Gentium Basic", "Gentium Book Basic", "Geo", "Geostar", "Geostar Fill", "Germania One",
                        "Give You Glory", "Glass Antiqua", "Glegoo", "Gloria Hallelujah", "Goblin One", "Gochi Hand", "Gorditas",
                        "Goudy Bookletter 1911", "Graduate", "Gravitas One", "Great Vibes", "Gruppo", "Gudea", "Habibi", "Hammersmith One",
                        "Handlee", "Hanuman", "Happy Monkey", "Henny Penny", "Herr Von Muellerhoff", "Holtwood One SC", "Homemade Apple",
                        "Homenaje", "IM Fell DW Pica", "IM Fell DW Pica SC", "IM Fell Double Pica", "IM Fell Double Pica SC",
                        "IM Fell English", "IM Fell English SC", "IM Fell French Canon", "IM Fell French Canon SC", "IM Fell Great Primer",
                        "IM Fell Great Primer SC", "Iceberg", "Iceland", "Imprima", "Inconsolata", "Inder", "Indie Flower", "Inika",
                        "Irish Grover", "Istok Web", "Italiana", "Italianno", "Jim Nightshade", "Jockey One", "Jolly Lodger", "Josefin Sans",
                        "Josefin Slab", "Judson", "Julee", "Junge", "Jura", "Just Another Hand", "Just Me Again Down Here", "Kameron",
                        "Karla", "Kaushan Script", "Kelly Slab", "Kenia", "Khmer", "Knewave", "Kotta One", "Koulen", "Kranky", "Kreon",
                        "Kristi", "Krona One", "La Belle Aurore", "Lancelot", "Lato", "League Script", "Leckerli One", "Ledger", "Lekton",
                        "Lemon", "Lilita One", "Limelight", "Linden Hill", "Lobster", "Lobster Two", "Londrina Outline", "Londrina Shadow",
                        "Londrina Sketch", "Londrina Solid", "Lora", "Love Ya Like A Sister", "Loved by the King", "Lovers Quarrel",
                        "Luckiest Guy", "Lusitana", "Lustria", "Macondo", "Macondo Swash Caps", "Magra", "Maiden Orange", "Mako", "Marck Script",
                        "Marko One", "Marmelad", "Marvel", "Mate", "Mate SC", "Maven Pro", "Meddon", "MedievalSharp", "Medula One", "Merriweather",
                        "Metal", "Metamorphous", "Michroma", "Miltonian", "Miltonian Tattoo", "Miniver", "Miss Fajardose", "Modern Antiqua",
                        "Molengo", "Monofett", "Monoton", "Monsieur La Doulaise", "Montaga", "Montez", "Montserrat", "Moul", "Moulpali",
                        "Mountains of Christmas", "Mr Bedfort", "Mr Dafoe", "Mr De Haviland", "Mrs Saint Delafield", "Mrs Sheppards",
                        "Muli", "Mystery Quest", "Neucha", "Neuton", "News Cycle", "Niconne", "Nixie One", "Nobile", "Nokora", "Norican",
                        "Nosifer", "Nothing You Could Do", "Noticia Text", "Nova Cut", "Nova Flat", "Nova Mono", "Nova Oval", "Nova Round",
                        "Nova Script", "Nova Slim", "Nova Square", "Numans", "Nunito", "Odor Mean Chey", "Old Standard TT", "Oldenburg",
                        "Oleo Script", "Open Sans", "Open Sans Condensed", "Orbitron", "Original Surfer", "Oswald", "Over the Rainbow",
                        "Overlock", "Overlock SC", "Ovo", "Oxygen", "PT Mono", "PT Sans", "PT Sans Caption", "PT Sans Narrow", "PT Serif",
                        "PT Serif Caption", "Pacifico", "Parisienne", "Passero One", "Passion One", "Patrick Hand", "Patua One", "Paytone One",
                        "Permanent Marker", "Petrona", "Philosopher", "Piedra", "Pinyon Script", "Plaster", "Play", "Playball", "Playfair Display",
                        "Podkova", "Poiret One", "Poller One", "Poly", "Pompiere", "Pontano Sans", "Port Lligat Sans", "Port Lligat Slab",
                        "Prata", "Preahvihear", "Press Start 2P", "Princess Sofia", "Prociono", "Prosto One", "Puritan", "Quantico",
                        "Quattrocento", "Quattrocento Sans", "Questrial", "Quicksand", "Qwigley", "Radley", "Raleway", "Rammetto One",
                        "Rancho", "Rationale", "Redressed", "Reenie Beanie", "Revalia", "Ribeye", "Ribeye Marrow", "Righteous", "Rochester",
                        "Rock Salt", "Rokkitt", "Ropa Sans", "Rosario", "Rosarivo", "Rouge Script", "Ruda", "Ruge Boogie", "Ruluko",
                        "Ruslan Display", "Russo One", "Ruthie", "Sail", "Salsa", "Sancreek", "Sansita One", "Sarina", "Satisfy", "Schoolbell",
                        "Seaweed Script", "Sevillana", "Shadows Into Light", "Shadows Into Light Two", "Shanti", "Share", "Shojumaru",
                        "Short Stack", "Siemreap", "Sigmar One", "Signika", "Signika Negative", "Simonetta", "Sirin Stencil", "Six Caps",
                        "Slackey", "Smokum", "Smythe", "Sniglet", "Snippet", "Sofia", "Sonsie One", "Sorts Mill Goudy", "Special Elite",
                        "Spicy Rice", "Spinnaker", "Spirax", "Squada One", "Stardos Stencil", "Stint Ultra Condensed", "Stint Ultra Expanded",
                        "Stoke", "Sue Ellen Francisco", "Sunshiney", "Supermercado One", "Suwannaphum", "Swanky and Moo Moo", "Syncopate",
                        "Tangerine", "Taprom", "Telex", "Tenor Sans", "The Girl Next Door", "Tienne", "Tinos", "Titan One", "Trade Winds",
                        "Trocchi", "Trochut", "Trykker", "Tulpen One", "Ubuntu", "Ubuntu Condensed", "Ubuntu Mono", "Ultra", "Uncial Antiqua",
                        "UnifrakturCook", "UnifrakturMaguntia", "Unkempt", "Unlock", "Unna", "VT323", "Varela", "Varela Round", "Vast Shadow",
                        "Vibur", "Vidaloka", "Viga", "Voces", "Volkhov", "Vollkorn", "Voltaire", "Waiting for the Sunrise", "Wallpoet",
                        "Walter Turncoat", "Wellfleet", "Wire One", "Yanone Kaffeesatz", "Yellowtail", "Yeseva One", "Yesteryear", "Zeyada"
                    ); 
                    
                    foreach ($GoogleFontsArray as $font) {
                        if ($font == get_option('ready_google_font_name')) {$selected = ' selected="selected"';} else {$selected = '';}
                        echo '<option value="'.$font.'" '.$selected.'>'.$font.'</option>';
                    }
                    ?>
                </select>
                <br />
                
                <h4><?php lang::_e('Content font'); ?></h4>
                <select name="ready_content_font_name" id="ready_content_font_name">
                    <?php $ContentFontsArray = Array ("Select", "Arial, Helvetica, sans-serif", "'Arial Black', Gadget, sans-serif", "'Bookman Old Style', serif",
                        "'Calibri', sans-serif", "'Cambria', 'Times New Roman', serif", "'Century Gothic',verdana,arial,helvetica,sans-serif",
                        "'Comic Sans MS', cursive", "Courier, monospace", "Garamond, serif", "Georgia, serif", "Impact, Charcoal, sans-serif",
                        "'Lucida Console', Monaco, monospace", "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
                        "'MS Sans Serif', Geneva, sans-serif", "'MS Serif', 'New York', sans-serif", "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
                        "Symbol, sans-serif", "Tahoma, Geneva, sans-serif", "'Times New Roman', Times, serif", "'Trebuchet MS', Helvetica, sans-serif",
                        "Verdana, Geneva, sans-serif"
                        );
                        foreach ($ContentFontsArray as $font) {
                            if ($font == get_option('ready_content_font_name')) {$selected = ' selected="selected"';} else {$selected = '';}
                            echo '<option value="'.$font.'" '.$selected.'>'.$font.'</option>';
                        }
                    ?>
                </select>
                <br />
                <div class="clear"></div>
            </div>
            <div class="right-bar" style="height:auto;">
                <h4><?php lang::_e('Preview'); ?></h4>
                <div id="prev-head"><p>Sample Heading Text</p></div>
                <div id="prev-content"><p>Sample content text</p></div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
            
            <div class="rt_input rt_text">
                <div class="rt_description">
                    <label for="ready_google_font_tags"><?php lang::_e('Google font tags'); ?></label>
                    <small><?php lang::_e('Font will be used for these tags. Separate with commas. Default it can be using for h1, h2, h3'); ?></small>
                    <div class="rt_clearfix"></div>
                </div>
                <input type="text" name="ready_google_font_tags" id="ready_google_font_tags" value="<?php echo esc_attr(get_option('ready_google_font_tags')); ?>" />
                <div class="rt_clearfix"></div>
            </div>
            
            <div class="rt_input rt_checkbox">
                <div class="rt_description">
                    <label for="ready_live_settings"><?php lang::_e('Show Live settings on frontend'); ?></label>
                    <small><?php lang::_e('Show Live settings block like on demo sites. Really, this option need only for demo sites.'); ?></small>
                    <div class="rt_clearfix"></div>
                </div>
                <input name="ready_live_settings" id="ready_live_settings" type="checkbox" <?php if(get_option('ready_live_settings') == 'on') echo "checked='checked'"; ?> />
                <div class="rt_clearfix"></div>
            </div>
            
            <div class="rt_input rt_checkbox">
                <div class="rt_description">
                    <label for="ready_hide_slider"><?php lang::_e('Hide slider on home page'); ?></label>
                    <div class="rt_clearfix"></div>
                </div>
                <input name="ready_hide_slider" id="ready_hide_slider" type="checkbox" <?php if(get_option('ready_hide_slider') == 'on') echo "checked='checked'"; ?> />
                <div class="rt_clearfix"></div>
            </div>
            
            <input type="submit" class="button-secondary" value="<?php lang::_e('Reset design to default settings'); ?>" id="toeTemplateResetDesignSettings" />
        </div>
        <div id="rt_logo">
            <h3><?php lang::_e('Site logo'); ?></h3>
            <table class="form-table">
                <tr>
					<td>
                        <input id="site-logo" class="regular-text" type="hidden" name="ready_site_logo" value="<?php echo esc_attr(get_option('ready_site_logo')); ?>" />
                        <img id="image-logo" src="<?php echo esc_attr(get_option('ready_site_logo')); ?>" alt="<?php lang::_e('Site Logo')?>" /><br />
                        <input class="button" id="btn-upload-logo" type="button" value="<?php lang::_e('Select an image');?>" />
                        <input class="button" id="btn-delete-logo" type="button" value="<?php lang::_e('Delete image');?>" />
                        <p class="description"><?php lang::_e('You can upload PNG, JPG or GIF image');?></p>
                    </td> 
				</tr>
            </table>
            <div class="rt_input rt_checkbox">
                <div class="rt_description">
                    <label for="ready_only_image"><?php lang::_e('Show only logo image'); ?></label>
                    <small><?php lang::_e('Show only image logo, without site name and description (hiding is SEO friendly).'); ?></small>
                    <div class="rt_clearfix"></div>
                </div>
                <input name="ready_only_image" id="ready_only_image" type="checkbox" <?php if(get_option('ready_only_image') == 'on') echo "checked='checked'"; ?> />
                <div class="rt_clearfix"></div>
            </div>
            
            <div class="rt_input rt_checkbox">
                <div class="rt_description">
                    <label for="ready_only_text"><?php lang::_e('Show only text logo'); ?></label>
                    <small><?php lang::_e('Show only text logo, without image logo.'); ?></small>
                    <div class="rt_clearfix"></div>
                </div>
                <input name="ready_only_text" id="ready_only_text" type="checkbox" <?php if(get_option('ready_only_text') == 'on') echo "checked='checked'"; ?> />
                <div class="rt_clearfix"></div>
            </div>
        </div>
        <div class="clear"></div>
		<div id="toeThemeEditFormMsg"></div>
        <p class="submit">
			<input type="hidden" name="reqType" value="ajax" />
            <input type="submit" style="margin-left:17px;" class="button-primary" value="<?php lang::_e('Save settings') ?>"/>
            <input type="submit" style="margin-left:17px;" class="button-secondary" name="resetSidebarToDefault" id="toeResetSidebarToDefaultSubmit" value="<?php lang::_e('Reset theme sidebars options to default') ?>"/>
        </p>
    </div>

    </form>
</div>

<?php 
} 

if(isset($_POST) && !empty($_POST['resetSidebarToDefault'])) {
    update_option('re_theme_widgets', 'default');
}
?>

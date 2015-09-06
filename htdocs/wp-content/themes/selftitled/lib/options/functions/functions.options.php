<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Background Images Reader
		$bg_images_path = get_template_directory() . '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory() .'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr = wp_upload_dir();
		$all_uploads_path = $uploads_arr['path'];
		$all_uploads = get_option('of_uploads');
		$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();


// Set the Options Array
global $of_options;

$of_options = array();

$of_options[] = array( "name" => __("W P LO CK E R. CO M  - General Settings", "selftitled"),
					"type" => "heading");
					
$of_options[] = array( "name" => __("Hello and welcome", "selftitled"),
					"desc" => "",
					"id" => "introduction",
					"std" => __("<h3>Welcome to the Self Titled theme options</h3> 					
					<p style='font-size:11px'>Some scripts of the theme are released under Creative Commons NC license. Be sure to check <strong>License section</strong> of Documentation file </p>", "selftitled"),
					"icon" => true,
					"type" => "info");
		
$of_options[] = array( "name" =>  __("Image logo?", "selftitled"),
					"desc" =>  __("Check if you would like to use an image logo",
					"selftitled"),					
					"id" => "logo_type",
					"std" => 0,
          			"folds" => 2,
					"type" => "checkbox");    


$of_options[] = array( "name" => __("Upload image logo", "selftitled"),
					"desc" => __("Please upload your logo", "selftitled"),
					"id" => "logo_upload",
					"std" => "",
					"fold" => "logo_type",
					"type" => "media");	
														   
		
//$of_options[] = array( "name" => __("Upload alternative logo", "selftitled"),
//					"desc" => __("Upload if you want another logo to be shown on gallery pages", "selftitled"),
//					"id" => "alt_logo_upload",
//					"std" => "",
//					"fold" => "logo_type",
//					"type" => "media");		

$favicon =  get_template_directory_uri() . '/images/favicon.png';		
$of_options[] = array( "name" => __("Custom Favicon", "selftitled"),
					"desc" => __("Upload a 16px x 16px Png/Gif image that will represent your website's favicon", "selftitled"),
					"id" => "custom_favicon",
					"std" => $favicon,
					"type" => "upload"); 			


$of_options[] = array( "name" => __("Global fullscreen background", "selftitled"),
					"desc" => __("This will add fullscreen to all pages/posts except slider ones", "selftitled"),
					"id" => "bg_upload",
					"std" => "",
					"type" => "media");	


$of_options[] = array( "name" => __("Protect images", "selftitled"),
					"desc" => __("Check to disable right click and images drag & drop", "selftitled"),
					"id" => "protect_images",
					"std" => false,
					"type" => "checkbox"); 			 

$of_options[] = array( "name" => __("Lightbox type", "selftitled"),
					"desc" => __("Select lightbox script (if you plan to use a plugin or custom lightbox select 'I will not use any of these')", "selftitled"),
					"id" => "lightbox_type",
					"std" => "",
					"type" => "select",
					"options" => array(
						"Fancyapps" => __("Fancyapps", "selftitled"),
						"PrettyPhoto" => __("PrettyPhoto", "selftitled"),
						"No Lightbox" => __("I will not use any of these", "selftitled"),
						)
					);

$of_options[] = array( "name" =>  __("Disable custom font", "selftitled"),
					"desc" =>  __("Check if you would like to disable custom font (e.g. it doesn't support some characters in your language)",
					"selftitled"),					
					"id" => "font",
					"std" => 0,
					"type" => "checkbox");

$of_options[] = array( "name" => __("Tracking Code", "selftitled"),
					"desc" => __("Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.", "selftitled"),	
					 "id" => "analytics",
					 "std" => "",
					 "type" => "textarea");   				

$of_options[] = array( "name" => __("Footer Text", "selftitled"),
                    "desc" => __("This text will appear in your footer.", "selftitled"),    
                    "id" => "footer_text",
                    "std" => " © SelfTitled Theme, 2012.",
                    "type" => "textarea");  


$of_options[] = array( "name" => __("Slider Settings", "selftitled"),								"type" => "heading");
					

$of_options[] = array( "name" => __("Enable slideshow?", "selftitled"),
					"desc" => __("Do you want to enable slideshow?", "selftitled"),			
					"id" => "slideshow",
					"std" => true,
					"folds" => 1,
					"type" => "checkbox"); 		


$of_options[] = array( "name" => __("Slideshow interval", "selftitled"),					
					"desc" => __("Slideshow interval in seconds - 0.3, 0.5, etc. also works", "selftitled"),
					"id" => "slideshowInterval",
					"std" => 4,
					"fold" => "slideshow",
					"type" => "text"); 
					

$of_options[] = array( "name" => __("Animation duration", "selftitled"),					
					"desc" => __("Animation duration in seconds - 0.3, 0.5, etc. also works", "selftitled"),
					"id" => "slider_time",
					"std" => 1,
					"type" => "text"); 


$of_options[] = array( "name" => __("Enable arrows?", "selftitled"),
					"desc" => __("Do you want to show navigation arrows?", "selftitled"),			
					"id" => "gallery_arrows",
					"std" => true,
					"type" => "checkbox"); 		
					
$of_options[] = array( "name" => __("Enable keyboard navigation?", "selftitled"),
					"desc" => __("Do you want to enable navigating with &larr; and &rarr; buttons on keyboard?", "selftitled"),
					"id" => "gallery_keyboard",
					"std" => true,
					"type" => "checkbox"); 	
					
$of_options[] = array( "name" => __("Enable slide title?", "selftitled"),
					"desc" => __("Do you want to show current slide title?", "selftitled"),	
					"id" => "gallery_slide",
					"std" => true,
					"type" => "checkbox"); 		
					
$of_options[] = array( "name" => __("Enable slide number?", "selftitled"),
					"desc" => __("Do you want to show current slide number?", "selftitled"),	
					"id" => "gallery_number",
					"std" => true,
					"type" => "checkbox"); 												
					
$of_options[] = array( "name" => __("Enable mousewheel", "selftitled"),
					"desc" => __("Do you want to enable mousewheel navigation?", "selftitled"),
					"id" => "gallery_mousewheel",
					"std" => true,
					"type" => "checkbox"); 					
																
$of_options[] = array( "name" => __("Continious gallery", "selftitled"),
					"desc" => __("After last slide gallery will jump to the first one and vice versa", "selftitled"),
					"id" => "loop_gallery",
					"std" => true,
					"type" => "checkbox"); 			
				


$of_options[] = array( "name" => __("Portfolio single settings", "selftitled"),					"type" => "heading");
 
                                                      
$of_options[] = array( "name" => __("Enable previous/next post navigation? ", "selftitled"), 
					"desc" => __("This will enable previous/next project navigation", "selftitled"), 					
					"id" => "next_prev",
					"std" => true,
					"folds" => 2,
					"type" => "checkbox");
	
$of_options[] = array( "name" => __("Previous project link text", "selftitled"), 					
					"desc" => __("Enter text for previous project link (if you want it to be project title use '%link')", "selftitled"), 
					"id" => "prev_proj_text",
					"std" => " &larr; Previous project",
					"fold" => "next_prev",
					"type" => "text"); 					
				
$of_options[] = array( "name" => __("Next project link text", "selftitled"), 					
					"desc" => __("Enter text for next project link (if you want it to be project title use '%link')", "selftitled"), 	 
					"id" => "next_proj_text",
					"std" => "Next project &rarr;",
					"fold" => "next_prev",
					"type" => "text"); 

$of_options[] = array( "name" => __("Show sidebar?", "selftitled"), 
					"desc" => "This will show sidebar on single portfolio pages",
					"id" => "portfolio_single_sidebar",
					"std" => true,
					"type" => "checkbox");
					
$of_options[] = array( "name" => __("Portfolio menu id", "selftitled"), 					
"desc" => __("If you want to highlight portfolio page in navigation on single portfolio posts, enter portfolio menu id here", "selftitled"), 
					"id" => "portfolio_id",
					"std" => "",
					"type" => "text"); 
					 
 
    
$of_options[] = array( "name" => "Styling Options",
					"type" => "heading");


//$of_options[] = array( "name" => __("Skin color", "selftitled"),
//					"desc" => __("Skin color", "selftitled"),"Select theme skin color",
//					"id" => "skin_color",
//					"std" => "black",
//					"type" => "radio",
//					"options" => $of_options_skin);	


$url =  ADMIN_DIR . 'assets/images/color_schemes/';
$of_options[] = array( "name" => __("Color Scheme", "selftitled"),
					"desc" => __("Select the color scheme", "selftitled"),
					"id" => "color_scheme",
					"std" => "#ff6c00",
					"type" => "images",
					"options" => array(
						'#ff6c00' => $url . 'orange.png',
						'#ffe400' => $url . 'yellow.png',
						'#1ab700' => $url . 'green.png',
						'#00e2fd' => $url . 'light_blue.png',
						'#8fb7ff' => $url . 'dark_blue.png',
						'#ab68ff' => $url . 'purple.png',
						'#ff68ef' => $url . 'pink.png',
						'#ff6868' => $url . 'red.png' )
					);

	
$of_options[] = array( "name" => __("Set colors manually", "selftitled"),
					"desc" => __("This will ignore selected color scheme allow you to set the colors manually for all elements",
					 "selftitled"),					
					 "id" => "manually_color",
					"std" => true,
					"folds" => 10,
					"type" => "checkbox");

													
$of_options[] = array( "name" =>  __("Body Background Color", "selftitled"),
					"desc" => __("Pick a background color for the theme",
					 "selftitled"),					
					 "id" => "body_background",
					"std" => "#000000",
					"fold" => "manually_color",
					"type" => "color");

$of_options[] = array( "name" =>  __("Content colors", "selftitled"),		
 			"desc" => __("Color for text", "selftitled"),
					"id" => "body_color",
					"std" => "#e3e3e3",
					"fold" => "manually_color",
					"type" => "color");
		
						
$of_options[] = array( "name" =>  "",
					"desc" => __("Color for headings", "selftitled"),
					"id" => "head_color",
					"std" => "#ffffff",
					"fold" => "manually_color",
					"type" => "color");   
					
$of_options[] = array( "name" =>  "",
					"desc" => __("Color for link headings (for example, blog titles)", "selftitled"),
					"id" => "head_link_color",
					"std" => "#ffffff",
					"fold" => "manually_color",
					"type" => "color");   					


$of_options[] = array( "name" =>  "",
					"desc" => __("Color for content links", "selftitled"),
					"id" => "link_color",
					"std" => "#ff6c00",
					"fold" => "manually_color",
					"type" => "color");  
					
  
$of_options[] = array( "name" =>  "",
					"desc" => __("Color for content links (on mouseover)", "selftitled"),
					"id" => "link_hover_color",
					"std" => "#ff994e",
					"fold" => "manually_color",
					"type" => "color");  

						
$of_options[] = array( "name" =>  __("Sidebar Colors", "selftitled"),
					"desc" => __("Sidebar headings color","selftitled"),				
					 "id" => "sidebar_head_color",
					"std" => "#ffffff",
					"fold" => "manually_color",
					"type" => "color");
					
$of_options[] = array( "name" =>  "",
					"desc" => __("Sidebar text color", "selftitled"),
					"id" => "sidebar_text_color",
					"std" => "#e3e3e3",
					"fold" => "manually_color",
					"type" => "color");	
					
$of_options[] = array( "name" =>  "",
					"desc" => __("Sidebar links color", "selftitled"),
					"id" => "sidebar_link_color",
					"std" => "#a4a4a4",
					"fold" => "manually_color",
					"type" => "color");										
					 
  
$of_options[] = array( "name" =>  __("Menu Color", "selftitled"),
					"desc" => __("Pick a color for the menu items", "selftitled"),
					"id" => "menu_color",
					"std" => "#ffffff",
					"fold" => "manually_color",
					"type" => "color"); 
					
$of_options[] = array( "name" =>  __("Elements color", "selftitled"),
					"desc" => __("Borders, bullets, separators and other elements color", "selftitled"),
					"id" => "border_color",
					"std" => "#ff6c00",
					"fold" => "manually_color",
					"type" => "color"); 					
					
						
$of_options[] = array( "name" => __("Custom CSS", "selftitled"),
                    "desc" => __("Quickly add some CSS to your theme by adding it to this block.", "selftitled"),
                    "id" => "custom_css",
                    "std" => "",
                    "type" => "textarea");
                    
                    

$of_options[] = array( "name" => __("Page settings", "selftitled"), 					
 						"type" => "heading");
					
					
$of_options[] = array( "name" => __("Show metadata on the pages?", "selftitled"), 								 "desc" => __("Show metadata on the pages: author, date, comments amount on blog/archive page?", "selftitled"), 
					"id" => "metadata_page",
					"std" => false,
					"type" => "checkbox");					
					
$of_options[] = array( "name" => __("Show comments on the pages?", "selftitled"), 								"desc" => __("This enables comments on the pages", "selftitled"), 							"id" => "comments_page",
					"std" => false,
					"type" => "checkbox");						

$of_options[] = array( "name" => __("Show sidebar?", "selftitled"), 
					"desc" => "This will show sidebar on pages",
					"id" => "show_sidebar_page",
					"std" => false,
					"type" => "checkbox");					                    

$of_options[] = array( "name" => __("Blog and posts options", "selftitled"), 
					"type" => "heading");   
	

$of_options[] = array( "name" => __("Show page title", "selftitled"), 
					"desc" => __("Show page title like blog or just begin with the first post?", "selftitled"), 
					"id" => "show_title_blog",
					"std" => true,
					"type" => "checkbox"); 
					

$of_options[] = array( "name" => __("Blog menu ID", "selftitled"), 
                    "desc" => __("If you want to highlight blog page in navigation on single posts, enter menu blog id here ", "selftitled"),  
                    "id" => "blog_id",
                    "std" => "",
                    "type" => "text");					
					
	
$of_options[] = array( "name" => __("Enable excerpts?", "selftitled"),
					"desc" => __("Do you want to enable excerpts?", "selftitled"),					
					 "id" => "enable_excerpts",
					"std" => true,
					"type" => "checkbox"); 					

$of_options[] = array( "name" => __("Show sidebar", "selftitled"),
					"desc" => __("Show sidebar on blog page?", "selftitled"),
					"id" => "show_sidebar_blog",
					"std" => true,
					"type" => "checkbox"); 

$of_options[] = array( "name" => "",
					"desc" => __("Show sidebar on single posts?", "selftitled"),			
					"id" => "show_sidebar_single",
					"std" => true,
					"type" => "checkbox");

					

$of_options[] = array( "name" => __("Posts per page", "selftitled"),      
               "desc" => __("How many posts should be shown on the page (use -1 to show all posts)", "selftitled"),       
                    "id" => "posts_per_page",
                    "std" => "5",
                    "type" => "text");


$of_options[] = array( "name" => __("Pagination type", "selftitled"),
					"desc" => __("Select blog pagination type", "selftitled"),
					"id" => "pagination",
					"std" => "Page numbers like 1, 2, 3, 4, 5...",
					"type" => "select",
					"options" => array(
						"words" => __("Older / Newer posts", "selftitled"), 
						"numbers" => __("Page numbers like 1, 2, 3, 4, 5...", "selftitled"), 				
					)
					);


$of_options[] = array( "name" => __("Show metadata on blog page?", "selftitled"), 
					"desc" => __("Show each posts metadata: author, date, category, comments amount on blog/archive page?", "selftitled"), 
					"id" => "metadata",
					"std" => true,
					"type" => "checkbox"); 
					
$of_options[] = array( "name" => __("Show metadata on the single post?", "selftitled"), 
					"desc" => __("Show each posts metadata: author, date, category, comments amount on single post page?", "selftitled"), 
					"id" => "metadata_post",
					"std" => true,
					"type" => "checkbox"); 

$of_options[] = array( "name" => __("Allow comments on the single post?", "selftitled"), 
					"desc" => __("This enables comments on the posts", "selftitled"), 
					"id" => "comment_post",
					"std" => true,
					"type" => "checkbox");	


$of_options[] = array( "name" => __("Thumbnails link to", "selftitled"),
 					"desc" => __("Thumbnails should link to", "selftitled"), 
					"id" => "thumb_link",
					"std" => "post",
					"type" => "radio",
					"options" => array(
						"post" => __("Post", "selftitled"),
						"lightbox" => __("Larger version of image (opened in pop-up)", "selftitled"), 
						)
					);	

$of_options[] = array( "name" => __("Read more text", "selftitled"), 
                    "desc" => __("Text for 'Read More' link", "selftitled"), 
                    "id" => "read_more",
                    "std" => "Read more &rarr;",
                    "type" => "text");



$of_options[] = array( "name" => __("Contact page options", "selftitled"), 
					"type" => "heading");
					

$of_options[] = array( "name" => __("Please Notice!", "selftitled"), 
					"desc" => "",
					"id" => "introduction",
					"std" => __("<h3>Please notice!</h3><p>You need to have PHP5 enabled on your server in order to use default contact form.</p>", "selftitled"), 
					"icon" => true,
					"type" => "info");
					
$of_options[] = array( "name" => __("Show big map on the contact page?", "selftitled"), 
					"desc" => __("Check if you want to show google map before the contact form", "selftitled"), 
					"id" => "map_contact_page",
					"std" => false,
					"folds" => 1,
					"type" => "checkbox");

$of_options[] = array( "name" => __("Address for the map", "selftitled"), 
                    "desc" => __("Enter the address for the map", "selftitled"), 
                    "id" => "map_address",
                    "std" => "",
                    "fold" => "map_contact_page",
                    "type" => "textarea");
					
$of_options[] = array( "name" => __("Show sidebar on the contact page?", "selftitled"), 
					"desc" => __("Check if you want to show sidebar on the contact page", "selftitled"),
					"id" => "sidebar_contact_page",
					"std" => false,
					"type" => "checkbox");			
					
					
$of_options[] = array( "name" => __("Show default contact form", "selftitled"), 
					"desc" => __("Uncheck if you want to use a separate plugin for contacting purposes (e.g. Contact Form 7)", "selftitled"), 
					"id" => "form_contact_page",
					"std" => true,
					"type" => "checkbox", 
					"folds" => 4
					);									

$of_options[] = array( "name" => __("E-mail", "selftitled"), 
                    "desc" => __("E-mail address that will receive messages sent via the form", "selftitled"), 
                    "id" => "e_mail_contact",
                    "std" => "",
                    "fold" => "form_contact_page",
                    "type" => "text");


$of_options[] = array( "name" => __("Thank you message", "selftitled"), 
                    "desc" => __("This message will appear after processing the form", "selftitled"),                    
                     "id" => "thank_message",
                    "std" => "Thanks! We'll contact shortly.",
                    "fold" => "form_contact_page",
                    "type" => "textarea");

$of_options[] = array( "name" =>  __("Thank you message color", "selftitled"), 
					"desc" => __("Pick a color for the thank you message text", "selftitled"), 
					"id" => "ty_message_color",
					"std" => "#63de00",
					"type" => "color"); 


$of_options[] = array( "name" => __("Social icons", "selftitled"), 
					"type" => "heading");     
   
$url =  ADMIN_DIR . 'assets/images/social/color/';

$of_options[] = array( "name" => "Twitter",
                    "desc" => "<img class='social_options' src='" . $url  . "twitter-2.png'> " . __("Twitter Link", "selftitled"),
                    "id" => "twitter",
                    "std" => "",
                    "type" => "text"); 


$of_options[] = array( "name" => "Facebook",
                    "desc" => "<img class='social_options' src='" . $url  . "facebook.png'> " . __("Facebook Link", "selftitled"),
                    "id" => "facebook",
                    "std" => "",
                    "type" => "text");
   

$of_options[] = array( "name" => "Google Plus",
                    "desc" => "<img class='social_options' src='" . $url  . "google-plus.png'> " . __("Google Plus Link", "selftitled"),
                    "id" => "google-plus",
                    "std" => "",
                    "type" => "text");    
                    

$of_options[] = array( "name" => "Dribbble",
                    "desc" => "<img class='social_options' src='" . $url  . "dribbble.png'> " . __("Dribbble Link", "selftitled"),
                    "id" => "dribbble",
                    "std" => "",
                    "type" => "text");                    


$of_options[] = array( "name" => "Forrst",
                    "desc" => "<img class='social_options' src='" . $url  . "forrst.png'> " . __("Forrst Link", "selftitled"),
                    "id" => "forrst",
                    "std" => "",
                    "type" => "text");   



$of_options[] = array( "name" => "Tumblr",
                    "desc" => "<img class='social_options' src='" . $url  . "tumblr.png'> " . __("Tumblr Link", "selftitled"),
                    "id" => "tumblr",
                    "std" => "",
                    "type" => "text");   
                    
                    
$of_options[] = array( "name" => "Flickr",
                    "desc" => "<img class='social_options' src='" . $url  . "flickr.png'> " . __("Flickr Link", "selftitled"),
                    "id" => "flickr",
                    "std" => "",
                    "type" => "text"); 
                    
                    
$of_options[] = array( "name" => "Myspace",
                    "desc" => "<img class='social_options' src='" . $url  . "myspace.png'> " . __("Myspace Link", "selftitled"),
                    "id" => "myspace",
                    "std" => "",
                    "type" => "text"); 


$of_options[] = array( "name" => "Skype",
                    "desc" => "<img class='social_options' src='" . $url  . "skype.png'> " . __("Skype Link", "selftitled"),                   
                     "id" => "skype",
                    "std" => "",
                    "type" => "text");


$of_options[] = array( "name" => "Vimeo",
                    "desc" => "<img class='social_options' src='" . $url  . "vimeo.png'> " . __("Vimeo Link", "selftitled"),
                    "id" => "vimeo",
                    "std" => "",
                    "type" => "text");


$of_options[] = array( "name" => "Youtube",
                    "desc" => "<img class='social_options' src='" . $url  . "youtube.png'> " . __("Youtube Link", "selftitled"),
                    "id" => "youtube",
                    "std" => "",
                    "type" => "text");


$of_options[] = array( "name" => "Instagram",
                    "desc" => "<img class='social_options' src='" . $url  . "instagram.png'> " . __("Instagram Link", "selftitled"),
                    "id" => "instagram",
                    "std" => "",
                    "type" => "text");
                    
$of_options[] = array( "name" => "Pinterest",
                    "desc" => "<img class='social_options' src='" . $url  . "pinterest.png'> " . __("Pinterest Link", "selftitled"),
                    "id" => "pinterest",
                    "std" => "",
                    "type" => "text");                    


// Backup Options
$of_options[] = array( "name" => __("Not found Page Options", "selftitled"), 
					  "type" => "heading");

$of_options[] = array( "name" => __("Show custom 404 page?", "selftitled"),
					"desc" => __("Check if you want to show custom 404 page", "selftitled"),
					"id" => "custom_404",
					"std" => true,
					"type" => "checkbox"); 											
//
//$of_options[] = array( "name" => __("Show search form?", "selftitled"),
//					"desc" => __("Check if you want to show search form 404 page", "selftitled"),
//					"id" => "search_404",
//					"std" => true,
//					"type" => "checkbox");


// Backup Options
$of_options[] = array( "name" => __("Backup Options", "selftitled"), 

					"type" => "heading");
					
$of_options[] = array( "name" => __("Backup and Restore Options", "selftitled"), 

                    "id" => "of_backup",
                    "std" => "",
                    "type" => "backup",
					"desc" => __('You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.', "selftitled"), 
					);
					
$of_options[] = array( "name" => __("Transfer Theme Options Data", "selftitled"), 
                    "id" => "of_transfer",
                    "std" => "",
                    "type" => "transfer",
					"desc" => __('You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".', "selftitled"), 
					
					);
					
	}
}
?>

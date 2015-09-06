<?php 

function optionsframework_admin_init() 
{
	// Rev up the Options Machine
	global $of_options, $options_machine;
	$options_machine = new Options_Machine($of_options);
}

/**
 * Create Options page
 */
function optionsframework_add_admin() {
	
    $of_page = add_submenu_page('theme_settings', 'Ready! Slider', 'Ready! Slider', 'edit_theme_options', 'ready_slider', 'optionsframework_options_page');
	// Add framework functionaily to the head individually
	add_action("admin_print_scripts-$of_page", 'of_load_only');
	add_action("admin_print_styles-$of_page",'of_style_only');
	add_action( "admin_print_styles-$of_page", 'optionsframework_mlu_css', 0 );
	add_action( "admin_print_scripts-$of_page", 'optionsframework_mlu_js', 0 );	
	
}

/**
 * Build Options page
 */
function optionsframework_options_page(){
	global $options_machine;	
	include_once( ADMIN_PATH . 'front-end/options.php' );
}

/**
 * Create Options page
 */
function of_style_only(){
	wp_enqueue_style('admin-style', ADMIN_DIR . 'assets/css/admin-style.css');
}	

/**
 * Create Options page
 */
function of_load_only() 
{	
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('ajaxupload', ADMIN_DIR .'assets/js/ajaxupload.js', array('jquery'));
	wp_enqueue_script('cookie', ADMIN_DIR . 'assets/js/cookie.js', 'jquery');
	wp_enqueue_script('smof', ADMIN_DIR .'assets/js/smof.js', array( 'jquery' ));
}

/**
 * Ajax Save Options
 */
function of_ajax_callback() 
{
	global $options_machine, $of_options;

	$nonce=$_POST['security'];
	
	if (! wp_verify_nonce($nonce, 'of_ajax_nonce') ) die('-1'); 
			
	//get options array from db
	$all = get_option(OPTIONS);
	
	$save_type = $_POST['type'];
	
	//Uploads
	if($save_type == 'upload')
	{
		
		$clickedID = $_POST['data']; // Acts as the name
		$filename = $_FILES[$clickedID];
       	$filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']); 
		
		$override['test_form'] = false;
		$override['action'] = 'wp_handle_upload';    
		$uploaded_file = wp_handle_upload($filename,$override);
		 
			$upload_tracking[] = $clickedID;
				
			//update $options array w/ image URL			  
			$upload_image = $all; //preserve current data
			
			$upload_image[$clickedID] = $uploaded_file['url'];
			
			update_option(OPTIONS, $upload_image ) ;
		
				
		 if(!empty($uploaded_file['error'])) {echo 'Upload Error: ' . $uploaded_file['error']; }	
		 else { echo $uploaded_file['url']; } // Is the Response
		 
	}
	elseif($save_type == 'image_reset')
	{
			
			$id = $_POST['data']; // Acts as the name
			
			$delete_image = $all; //preserve rest of data
			$delete_image[$id] = ''; //update array key with empty value	 
			update_option(OPTIONS, $delete_image ) ;
	
	}
	elseif ($save_type == 'save')
	{
		wp_parse_str(stripslashes($_POST['data']), $data);
		unset($data['security']);
		unset($data['of_save']);
		update_option(OPTIONS, $data);
		
		die('1');
	}
	elseif ($save_type == 'reset')
	{
		update_option(OPTIONS,$options_machine->Defaults);
		
        die('1'); //options reset
	}

  	die();
}
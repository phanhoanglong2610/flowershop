<?php 
include_once('fwgm-widget.php');

// Code to show Map Image
function fwbgm_front_show($option='gfullmap_options'){
	global $wpdb;	
	
	$table_name = $wpdb->prefix . "fullwidthgooglemap"; 
    $fwgm_db_data = $wpdb->get_results("SELECT * FROM $table_name WHERE option_name = '".$option."'",ARRAY_A);    
	
	if($fwgm_db_data[0]['active']) {

		$options = get_option($option);	
          
		if($options['g_thumb_width'] == null){ 		
			$options['g_thumb_width'] = '250';		
		}	
		if($options['g_thumb_height'] == null){ 		
			$options['g_thumb_height'] = '250';		
		}
		if($options['g_map_type'] == null){ 		
			$options['g_map_type'] = 'roadmap';		
		}		   
		if($options['g_zoom_val'] == null){ 		
			$options['g_zoom_val'] = 'roadmap';		
		}
		
		$from_this = "http://www.wpfruits.com/?fwgm_refs=".$_SERVER['SERVER_NAME']; 
		
		if(array_key_exists("g_image_chkbox" ,$options)) { 
			$tmp  = "";
			$tmp .= '<div style="position:relative;"><a class="wpf_ref" href="'.$from_this.'" target="_blank">WPF</a><a class="gfullmap-thumbnail-map" href="javascript:void(0);" data-href="#dialog-lightgmap-'.$option.'" title="Click to open larger map">';
			$tmp .= '<img class="click_it" class-value="createPopup-'.$option.'" style="background: none repeat scroll 0 0 #F3F3F3;border: 1px solid #CCCCCC; padding: 5px;" title="Click to open larger map" alt="Click to open larger map" src="'.$options['g_image_path'].'" width ='. $options['g_thumb_width']. 'x height = '. $options['g_thumb_height'].'></a>';
			$tmp .= '</div>';
			$out  = $tmp ;	
		} 
		else{
			$tmp  = "";
			$tmp .= '<div id="cf_custom_content"  style="position:relative;"><a class="wpf_ref" href="'.$from_this.'" target="_blank">WPF</a> <a  class="gfullmap-thumbnail-map"  href="javascript:void(0);" data-href="#?custom=true&width=500&height=500" title="Click to open larger map">';
			$tmp .= '<img class="click_it" class-value="createPopup-'.$option.'" style="background: none repeat scroll 0 0 #F3F3F3;border: 1px solid #CCCCCC; padding: 5px;" title="Click to open larger map" alt="Click to open larger map" src="https://maps.googleapis.com/maps/api/staticmap?center='.urlencode($options['g_thumb_address']) . '&amp;zoom=' . $options['g_zoom_val'] . '&amp;size=' . $options['g_thumb_width'] . 'x' . $options['g_thumb_height'] . '&amp;maptype=' . $options['g_map_type'] .'&amp;language=' . $options['gmap_language'] .'&amp;sensor=false&amp;scale=1&amp;markers=size:red%7Ccolor:small%7Clabel:A%7C' .urlencode($options['g_thumb_address']) . '"></a>';
			$tmp .= '</div>';	
			$out  = $tmp ;					
	   }
	   echo $out;
   }	
}

// Code to show Map in light-box
function show_lightbox($option='gfullmap_options') 
{ 
	$fgm_glightbox_height   = null;
	$fgm_glightbox_width    = null;
	$fgm_glightbox_map_type = null;
	$fgm_glightbox_add      = null;
	$fgm_glightbox_zoom     = null; 

	$options = get_option($option);
	$lout = '';	   
	
	if(!isset($options['glightbox_bubble'])) 
	$options['glightbox_bubble'] = 0;

	if ($options['glightbox_bubble']) {
		$iwloc = 'addr';
	} 
	else {
		$iwloc = 'near';
	}	

	if(array_key_exists("glightbox_height" ,$options)) {
		$fgm_glightbox_height =$options['glightbox_height'];
	}

	if(array_key_exists("glightbox_map_type" ,$options)) {
		$fgm_glightbox_map_type =$options['glightbox_map_type'];	
	}

	if(array_key_exists("glightbox_width" ,$options)) {
		$fgm_glightbox_width =$options['glightbox_width'];	
	}

	if(array_key_exists("g_thumb_address" ,$options)) {
		$fgm_glightbox_add =$options['g_thumb_address'];
	}

	if(array_key_exists("glightbox_zoom_val" ,$options)) {
		$fgm_glightbox_zoom =$options['glightbox_zoom_val'];	
	}

	if((array_key_exists("g_thumb_address" ,$options))&&($options['g_thumb_address'] == null)){	     	     			
		$options['g_thumb_address']='New York, USA';
		$fgm_glightbox_add = $options['g_thumb_address'];
	} 		
	
	if($fgm_glightbox_height == null){	     	     			
		$fgm_glightbox_height = '500';
	} 
	
	if($fgm_glightbox_width == null){ 		
		$fgm_glightbox_width = '500';		
	}

	$from_this = "http://www.wpfruits.com/?fwgm_refs=".$_SERVER['SERVER_NAME']; 
	$map_url   = 'http://maps.google.com/maps?hl=en&amp;ie=utf8&amp;output=embed&amp;iwloc=' . $iwloc . '&amp;iwd=1&amp;mrt=loc&amp;t='. $fgm_glightbox_map_type . '&amp;q=' . urlencode(remove_accents($fgm_glightbox_add)) . '&amp;z=' . urlencode($fgm_glightbox_zoom) . '';

	$lout .= '<div class="gmbdm-dialog"  data-map-height="' . $fgm_glightbox_height . '" gmaptype="'.$fgm_glightbox_map_type.'" data-map-width="' . $fgm_glightbox_width . '" data-map-skin="black-square" data-map-iframe-url="'.$map_url.'" id="dialog-lightgmap-'.$option.'" title="Google Map">';
	$lout .= '<div class="createPopup gmbdm-map createPopup-'.$option.'" style="overflow: auto;"><div class="innerdiv" style="border:10px solid #000000; z-index:999999999;position:relative; margin:auto; display:block; height:'.($fgm_glightbox_height+20).'px; width:'.$fgm_glightbox_width.'px;"><div class="cf-close"></div><iframe  height='.$fgm_glightbox_height.'px width='.$fgm_glightbox_width.'px src="'.$map_url.'"></iframe></div></div>';
	$lout .= '</div>'; 		 

	echo $lout;
}    

function fwgm_short_code($atts){
	ob_start();
    extract(shortcode_atts(array(
		"name" => ''
	), $atts));
	fwbgm_front_show($name);
	show_lightbox($name);
	$output = ob_get_clean();
	return $output;
}
add_shortcode('showmap', 'fwgm_short_code');
?>
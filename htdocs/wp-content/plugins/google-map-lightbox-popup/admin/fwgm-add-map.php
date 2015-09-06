<?php 
function add_map_details(){
	global $wpdb,$fwbm;
	$table_name = $wpdb->prefix . "fullwidthgooglemap"; 
	if(isset($_GET['add']) && $_GET['add']==1) {
		$option=$_POST['fullmap_option_name'];	
		if(!get_option($_POST['fullmap_option_name'])){
			if($option){		
				$option = preg_replace('/[^a-z0-9\s]/i', '', $option);  
				$option = str_replace(" ", "_", $option);				
				$options = get_option($option);				
				if($options){
					$fwbm = "Please Choose Different Name";				
				}
				else{					
					$sql = "INSERT INTO " . $table_name . " values ('','".$option."','1');";						
					if ($wpdb->query( $sql )){
						add_option($option, gfullmap_defaults());
						$fwbm = 'Google Map Successfully Added';
					}				
				}
			}else{$fwbm =  "Please Choose Different Name";}
		}else{$fwbm =  "Please Choose Different Name";}
	}else{$fwbm =  "Please Choose Different Name";} ?>
	<div class="show-message updated"> <?php echo $fwbm; ?> </div>	
<?php 
}

function fwgm_get_map_details(){		

	global $wpdb;
	$disabled=null;
	$table_name = $wpdb->prefix . "fullwidthgooglemap"; 		
	$my_rows_cont = $wpdb->get_results("SELECT * FROM $table_name");	
	foreach( $my_rows_cont as $row){	
	
		echo '<div class="show_con">
		<div class="fwgm_id">'.$fgm_map_name = $row->id.'</div> 		 
		<div class="fwgm_map_name">'.$fgm_map_name = $row->option_name.'</div>
		<div class="fwgm_shortcode_name"> '.$fgm_option_name ='[showmap name=\''. $row->option_name .'\']'.' </div>';
		
		$map_status = $row->active ;
		
		if( $map_status == 1){
			$disabled='disabled';	
			echo '<div class="fwgm_edit_link"> ' .$fgm_edit_link ='<a class="button-primary"  href="?page=edit-map&edit='. $row->option_name . '">Edit</a></div>
				  <div class="fwgm_edit_link"> ' .$fgm_edit_link ='<a class="button-primary" href="?page=gfullmap&deactivate='. $row->option_name . '">Deactivate</a></div>'; 
		}
		else{ 	   
			echo '<div class="fwgm_edit_link"> ' .$fgm_edit_link ='<a class="button-primary" '.$disabled.' href="?page=gfullmap">Edit</a></div>
				 <div class="fwgm_activate"> ' .$fgm_edit_link ='<a class="button-primary" href="?page=gfullmap&activate='. $row->option_name . '">Activate</a></div>';
		}   
		echo'<div class="fwgm_delete_link"> '.$fgm_edit_link ='<a class="g_map_delete_btn" href="?page=gfullmap&delete='. $row->option_name . '" onclick="return fwgm_delconfirm(\''.$row->option_name.'\');""> Delete </a></div></div>';
   } 			
}
		
function display_map_info(){

	global $wpdb;
	$disabled=null;
	$table_name = $wpdb->prefix . "fullwidthgooglemap"; 
	$my_rows = $wpdb->get_results("SELECT * FROM $table_name");
	foreach( $my_rows as $row){
	
	   echo '<div class="show_con"> 
	   <div class="fwgm_id">'.$fgm_map_name = $row->id.'</div>
	   <div class="fwgm_map_name">'.$fgm_map_name = $row->option_name.'</div>
	   <div class="fwgm_shortcode_name"> '.$fgm_option_name ='[showmap name=\''. $row->option_name .'\']'.' </div>';
	   
	   $map_status = $row->active ;
	   
		if( $map_status == 1){	
			$disabled='disabled';				
			echo '<div class="fwgm_edit_link"> ' .$fgm_edit_link ='<a class="button-primary"  href="?page=edit-map&edit='. $row->option_name . '">Edit</a></div>
				  <div class="fwgm_edit_link"> ' .$fgm_edit_link ='<a class="button-primary" href="?page=gfullmap&deactivate='. $row->option_name . '">Deactivate</a></div>'; 
		}
		else{ 	   
			echo '<div class="fwgm_edit_link"> ' .$fgm_edit_link ='<a class="button-primary" '.$disabled.' href="?page=gfullmap">Edit</a></div>
				  <div class="fwgm_activate"> ' .$fgm_edit_link ='<a class="button-primary" href="?page=gfullmap&activate='. $row->option_name . '">Activate</a></div>'; 
		}   	   
		echo '<div class="fwgm_delete_link"> '.$fgm_edit_link ='<a class="g_map_delete_btn" href="?page=gfullmap&delete='. $row->option_name . '"onclick="return fwgm_delconfirm(\''.$row->option_name.'\');""> Delete </a></div></div>';
	}  
}

if(isset($_GET['deactivate'])){
    $id=$_GET['deactivate'];
	global $wpdb;
	$table_name = $wpdb->prefix . "fullwidthgooglemap"; 
	$sql = "UPDATE " . $table_name . " SET active='0' WHERE option_name='".$id."';";
	$wpdb->query( $sql );
}
if(isset($_GET['activate'])){
   	$id=$_GET['activate'];
	global $wpdb;
	$table_name = $wpdb->prefix . "fullwidthgooglemap"; 
	$sql = "UPDATE " . $table_name . " SET active='1' WHERE option_name='".$id."';";
	$wpdb->query( $sql );	
}
if(isset($_GET['delete'])){
   	$id=$_GET['delete'];	 
	global $wpdb;
	$table_name = $wpdb->prefix . "fullwidthgooglemap"; 			
	$sql = "DELETE FROM " . $table_name . " WHERE option_name='".$id."';";
	$wpdb->query( $sql );	
}
?>
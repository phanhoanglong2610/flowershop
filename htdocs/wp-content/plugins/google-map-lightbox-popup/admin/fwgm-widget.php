<?php
class FullWidthGoogleMapWidget extends WP_Widget {

	function FullWidthGoogleMapWidget() {
		$widget_ops = array('classname' => 'FullWidthGoogleMapWidget', 'description' => 'Displays selected GoogleMap' );
		$this->WP_Widget('FullWidthGoogleMapWidget', 'Full GoogleMap LightBox Widget', $widget_ops);
	}

	function form($instance){
		$instance = wp_parse_args( (array) $instance, array( 'title' => '','select_fwgm' =>'' ) );
		$title = $instance['title'];
		$select_fwgm = esc_attr($instance['select_fwgm']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','gfullmap'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<p>
			<label for="<?php echo $this->get_field_id('select_fwgm'); ?>"><?php _e('Select GoogleMap:','gfullmap'); ?> 
			<?php
				global $wpdb;	
				$table_name = $wpdb->prefix . "fullwidthgooglemap"; 
				$fwgm_data = $wpdb->get_results("SELECT * FROM $table_name WHERE active=1  ORDER BY id");
			?>
			<select id="<?php echo $this->get_field_id('select_fwgm'); ?>" name="<?php echo $this->get_field_name('select_fwgm'); ?>">
				<?php foreach($fwgm_data as $fwgm_data_item){ ?>		
					<option <?php selected($fwgm_data_item->option_name,$select_fwgm); ?> value="<?php echo $fwgm_data_item->option_name; ?>"><?php echo $fwgm_data_item->option_name; ?></option>
				<?php } ?>
			</select>
			</label>
		</p>	
		<?php
	} 
	
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['select_fwgm'] = strip_tags($new_instance['select_fwgm']);
		return $instance;
	}
 
	function widget($args, $instance){
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$select_fwgm = esc_attr($instance['select_fwgm']);
		if (!empty($title))
		echo $before_title . $title . $after_title;
		echo fwbgm_front_show($select_fwgm);
		echo show_lightbox($select_fwgm);	
		echo $after_widget;
	} 
}
add_action( 'widgets_init', create_function('', 'return register_widget("FullWidthGoogleMapWidget");') );
?>
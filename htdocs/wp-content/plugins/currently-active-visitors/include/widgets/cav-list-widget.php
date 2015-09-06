<?php

add_action('widgets_init', 'cav_register_list_widget');

function cav_register_list_widget(){
  register_widget('rav_cav_list_widget'); 
}

class rav_cav_list_widget extends WP_Widget{
    
    function rav_cav_list_widget(){
        $widget_options=array(
        'classname' => 'rav_cav_list_widget_class',
        'description' => 'Displays a list of active website visitors.'
        );
        $this->WP_Widget('rav_cav_list_widget', 'Currently Active Visitors List Widget', $widget_options);
         wp_enqueue_script('jquery');
         //$cav_screen = get_current_screen();         
    }
    
    function form($instance){ 
        $cav_list_defaults = array(
        'title' => '',
        'width' => '',
        'refresh' => '5',
        'max' => 5,
        'fontface' => '',
        'fontsize' => '',
        'fontcolor' => '',
        'background' => '',
        'headingfontsize' => '',
        'headingfontcolor' => '',
        'headingbackground' => '',
        'bordercolor' => '#cccccc',
        'borderwidth' => '1',
        'padding' => '5',
        'flag' => 1,
        'city' => 1,
        'state' => 1,
        'country' => 1
        );
        $instance=wp_parse_args((array)$instance,$cav_list_defaults);
                
?>
<p>Title: <input class="widefat" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" /></p>
<p>List Width: <input size=3 name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo esc_attr($instance['width']); ?>" /> px</p>
<p>Refresh Interval: <input size=3 name="<?php echo $this->get_field_name('refresh'); ?>" type="text" value="<?php echo esc_attr($instance['refresh']); ?>" /> seconds</p>
<p>How may visitors would you like to display? <input size=3 name="<?php echo $this->get_field_name('max'); ?>" type="text" value="<?php echo esc_attr($instance['max']); ?>" /></p>
<p>Heading Font size: <input size=3 name="<?php echo $this->get_field_name('headingfontsize'); ?>" type="text" value="<?php echo esc_attr($instance['headingfontsize']); ?>" /> px</p>
<p>Heading Font color:<br /><input size=7 class='cavcolorpicker'  id='cav_headingfontcolor' name="<?php echo $this->get_field_name('headingfontcolor'); ?>" type="text" value="<?php echo esc_attr($instance['headingfontcolor']); ?>" /></p>
<p>Heading Background color:<br /><input class='cavcolorpicker'  id='cav_headingbackground'  size=7 name="<?php echo $this->get_field_name('headingbackground'); ?>" type="text" value="<?php echo esc_attr($instance['headingbackground']); ?>" /></p>
<p>List Font size: <input size=3 name="<?php echo $this->get_field_name('fontsize'); ?>" type="text" value="<?php echo esc_attr($instance['fontsize']); ?>" /> px</p>
<p>List Font color:<br /><input size=7 class='cavcolorpicker' name="<?php echo $this->get_field_name('fontcolor'); ?>" type="text" value="<?php echo esc_attr($instance['fontcolor']); ?>" /></p>
<p>List Background color:<br /><input class='cavcolorpicker' size=7 name="<?php echo $this->get_field_name('background'); ?>" type="text" value="<?php echo esc_attr($instance['background']); ?>" /></p>
<p>List Border color:<br /><input size=7 class='cavcolorpicker' name="<?php echo $this->get_field_name('bordercolor'); ?>" type="text" value="<?php echo esc_attr($instance['bordercolor']); ?>" /></p>
<p>List Border width: <input size=3 name="<?php echo $this->get_field_name('borderwidth'); ?>" type="text" value="<?php echo esc_attr($instance['borderwidth']); ?>" /> px</p>
<p>Padding: <input size=3 name="<?php echo $this->get_field_name('padding'); ?>" type="text" value="<?php echo esc_attr($instance['padding']); ?>" /> px</p>

<p>Show city:
<select name="<?php echo $this->get_field_name('city'); ?>">
<option value="1" <?php selected($instance['city'], "1"); ?> >Yes</option>
<option value="0" <?php selected($instance['city'], "0"); ?> >No</option>
</select>    
</p>

<p>Show state:
<select name="<?php echo $this->get_field_name('state'); ?>">
<option value="1" <?php selected($instance['state'], "1"); ?> >Yes</option>
<option value="0" <?php selected($instance['state'], "0"); ?> >No</option>
</select>    
</p>

<p>Show country:
<select name="<?php echo $this->get_field_name('country'); ?>">
<option value="1" <?php selected($instance['country'], "1"); ?> >Yes</option>
<option value="0" <?php selected($instance['country'], "0"); ?> >No</option>
</select>    
</p>

<p>Show visitor's country flag:
<select name="<?php echo $this->get_field_name('flag'); ?>">
<option value="1" <?php selected($instance['flag'], "1"); ?> >Yes</option>
<option value="0" <?php selected($instance['flag'], "0"); ?> >No</option>
</select>    
</p>

<?php
    }
    
    function update($new_instance,$old_instance){
     $instance = $old_instance;
     $instance['title'] = strip_tags($new_instance['title']); 
     $instance['width'] = strip_tags($new_instance['width']); 
     if(trim($new_instance['refresh'])=="") $new_instance['refresh']=5;
     $instance['refresh'] = strip_tags($new_instance['refresh']); 
     $instance['max'] = strip_tags($new_instance['max']);
     $instance['fontface'] = strip_tags($new_instance['fontface']);
     $instance['fontsize'] = strip_tags($new_instance['fontsize']);
     $instance['fontcolor'] = strip_tags($new_instance['fontcolor']);
     $instance['background'] = strip_tags($new_instance['background']);
     $instance['headingfontsize'] = strip_tags($new_instance['headingfontsize']);
     $instance['headingfontcolor'] = strip_tags($new_instance['headingfontcolor']);
     $instance['headingbackground'] = strip_tags($new_instance['headingbackground']);
     $instance['bordercolor'] = strip_tags($new_instance['bordercolor']);
     $instance['borderwidth'] = strip_tags($new_instance['borderwidth']);
     $instance['padding'] = strip_tags($new_instance['padding']);
     $instance['flag'] = strip_tags($new_instance['flag']);
     $instance['city'] = strip_tags($new_instance['city']);
     $instance['state'] = strip_tags($new_instance['state']);
     $instance['country'] = strip_tags($new_instance['country']);  
     return $instance; 
    }
    
    function widget($args, $instance){ 
        $cav_list_id=rand(100,1000);
        $titleStyle=empty($instance['headingfontsize']) ? '' : " font-size: ".$instance['headingfontsize']."px; ";
        $titleStyle .=empty($instance['headingfontcolor']) ? '' : " color: ".$instance['headingfontcolor']."; ";
        $titleStyle .=empty($instance['headingbackground']) ? '' : " background-color: ".$instance['headingbackground']."; ";
        $titleStyle .=empty($instance['padding']) ? '' : " padding: 0 ".$instance['padding']."px; ";
        $titleStyle =empty($titleStyle) ? '' : ' style="'.$titleStyle.'" ';
                
        $listStyle=empty($instance['fontface']) ? '' : " font-family: '".$instance['fontface']."'; ";
        $listStyle .=empty($instance['fontsize']) ? '' : " font-size: ".$instance['fontsize']."px; ";
        $listStyle .=empty($instance['fontcolor']) ? '' : " color: ".$instance['fontcolor']."; ";
        $listStyle .=empty($instance['background']) ? '' : " background-color: ".$instance['background']."; ";
        $listStyle .=empty($instance['width']) ? '' : " width: ".$instance['width']."px; ";
        $listStyle .=empty($instance['padding']) ? '' : " padding: ".$instance['padding']."px 0; ";
        $listStyle .=empty($instance['bordercolor']) ? '' : " border-color: ".$instance['bordercolor']."; ";
        $listStyle .=empty($instance['borderwidth']) ? '' : "border-style: solid; border-width: ".$instance['borderwidth']."px; ";
        
        print $args['before_widget'];
        $title=apply_filters('widget_title',$instance['title']);
        if(!empty($title)) { $title=$args['before_title'].$title.$args['after_title']; };
        $cav_return=$title.'<div style="width:'.$instance['width'].'px;" class="cav_list_styles" id="cav_list_'.$cav_list_id.'"></div>';
        
        $cav_return='<div style="'.$listStyle.' " class="cav_list_styles"><div '.$titleStyle.' class="cav_list_heading">'.$title.'</div><div class="cav_list_content" id="cav_list_'.$cav_list_id.'"></div></div>';
        
        print cavshowlist($instance,$cav_return,$cav_list_id);
        print $args['after_widget'];
    }
}

?>
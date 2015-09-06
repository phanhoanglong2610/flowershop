<?php 

// Twitter widget
 add_action( 'widgets_init', 'load_widgets' );
 
 /**
  * Register our widget.
  * 'Example_Widget' is the widget class used below.
  *
  * @since 0.1
  */
 function load_widgets() {
 	register_widget( 'Twitter_Widget' );
 }
 
 /**
  * Example Widget class.
  * This class handles everything that needs to be handled with the widget:
  * the settings, form, display, and update.  Nice!
  *
  * @since 0.1
  */
 class Twitter_Widget extends WP_Widget {
 
 	/**
 	 * Widget setup.
 	 */
 	function Twitter_Widget() {
 		/* Widget settings. */
 		$widget_ops = array( 'classname' => 'twitter', 'description' => __('Twitter widget', 'selftitled') );
 
 		/* Widget control settings. */
 		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'twitter-widget' );
 
 		/* Create the widget. */
 		$this->WP_Widget( 'twitter-widget', __('Twitter widget', 'selftitled'), $widget_ops, $control_ops );
 		
 	}
 	

 	
 	 
 	/**
 	 * How to display the widget on the screen.
 	 */
 	function widget( $args, $instance ) {
 		extract( $args );
 
 		/* Our variables from the widget settings. */
 		$title = apply_filters('widget_title', $instance['title'] );
 		$twitter_name = $instance['twitter_name'];
 		$limit = $instance['limit'];
 		$show_time = isset( $instance['show_time'] ) ? $instance['show_time'] : false;
 		$show_replies = isset( $instance['show_replies'] ) ? $instance['show_replies'] : false;
 
 		/* Before widget (defined by themes). */
 		echo $before_widget . '<div class="twitter_widget">';
 		
 		if ( $title )
 					echo $before_title . $title . $after_title;
 		
 		/* Display the widget title if one was input (before and after defined by themes). */
 		echo '<div id="tweets"></div>';
 
 		/* After widget (defined by themes). */
 	
 		echo '</div>' . $after_widget;
 		
?> 		

<script src="<?php echo get_template_directory_uri() . "/lib/widgets/twitter/js/jquery.tweet.js"; ?>"></script>
<script>
jQuery(function($){

$("#tweets").tweet({
  username: "<?php if ( $twitter_name) echo $twitter_name; ?>",
  count: <?php if ($limit) {echo $limit;} else {echo '5';} ?>,
  <?php
  	if ($show_replies !== TRUE) {echo 'fetch: 30,
  filter: function(t){ return ! /^@\w+/.test(t.tweet_raw_text); },';} ?>    
  loading_text: "loading tweets...",
  template: "{text} <?php if ( $show_time) echo '{time}'; ;?>"
});

});
</script>
<?php 
 	
 	}
 	

 
 
 	/**
 	 * Update the widget settings.
 	 */
 	function update( $new_instance, $old_instance ) {
 		$instance = $old_instance;
 
 		/* Strip tags for title and name to remove HTML (important for text inputs). */
 		$instance['title'] = strip_tags( $new_instance['title'] );
 		$instance['twitter_name'] = strip_tags( $new_instance['twitter_name'] );
 		$instance['limit'] = strip_tags( $new_instance['limit'] );
 		$instance['show_time'] = isset($new_instance['show_time']);
 		$instance['show_replies'] = isset($new_instance['show_replies']);

 		return $instance;
 	}
 
 	/**
 	 * Displays the widget settings controls on the widget panel.
 	 * Make use of the get_field_id() and get_field_name() function
 	 * when creating your form elements. This handles the confusing stuff.
 	 */
 	function form( $instance ) {
 
 		/* Set up some default widget settings. */
 		$defaults = array( 'title' => __('title', 'home'));
 		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
 
 		<!-- Widget Title: Text Input -->
 		<p>
 					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'selftitled'); ?>:</label>
 					<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
 		</p>
 		
 		 		
 		<p>
 					<label for="<?php echo $this->get_field_id( 'twitter_name' ); ?>"><?php _e('Your Twitter name', 'selftitled'); ?>:</label>
 					<input id="<?php echo $this->get_field_id( 'twitter_name' ); ?>" name="<?php echo $this->get_field_name( 'twitter_name' ); ?>" value="<?php echo $instance['twitter_name']; ?>" style="width:90%;" />
 		</p> 
 		
 		<p>
 					<label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e('Number of tweets will be shown', 'selftitled'); ?></label>
 					<input id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" value="<?php echo $instance['limit']; ?>" style="width:90%;" />
 		</p> 
 				
 		
 		<p>
 					<input class="checkbox" type="checkbox" <?php checked(isset( $instance['show_time']) ? $instance['show_time'] : 0  ); ?> id="<?php echo $this->get_field_id( 'show_time' ); ?>" name="<?php echo $this->get_field_name( 'show_time' ); ?>" />
 					<label for="<?php echo $this->get_field_id( 'show_time' ); ?>"><?php _e('Show time?', 'selftitled'); ?></label>
 		</p> 
 		
 		<p>
 					<input class="checkbox" type="checkbox" <?php checked(isset( $instance['show_replies']) ? $instance['show_replies'] : 0  ); ?> id="<?php echo $this->get_field_id( 'show_replies' ); ?>" name="<?php echo $this->get_field_name( 'show_replies' ); ?>" />
 					<label for="<?php echo $this->get_field_id( 'show_replies' ); ?>"><?php _e('Show replies?', 'selftitled'); ?></label>
 		</p> 	
 				
 	<?php
 	}
 }
  
    
  // recent posts widget
  
  
   add_action( 'widgets_init', 'load_widgets_1' );
   
   /**
    * Register our widget.
    * 'Example_Widget' is the widget class used below.
    *
    * @since 0.1
    */
   function load_widgets_1() {
   	register_widget( 'Recent_Posts_Widget' );
   }
   
   /**
    * Example Widget class.
    * This class handles everything that needs to be handled with the widget:
    * the settings, form, display, and update.  Nice!
    *
    * @since 0.1
    */
   class Recent_Posts_Widget extends WP_Widget {
   
   	/**
   	 * Widget setup.
   	 */
   	function Recent_Posts_Widget() {
   		/* Widget settings. */
   		$widget_ops = array( 'classname' => 'recent_posts', 'description' => __('Recent posts widget', 'selftitled') );
   
   		/* Widget control settings. */
   		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'recent-posts-widget' );
   
   		/* Create the widget. */
   		$this->WP_Widget( 'recent-posts-widget', __('Recent posts widget', 'selftitled'), $widget_ops, $control_ops );
   		
   	}
   	
  
   	
   	 
   	/**
   	 * How to display the widget on the screen.
   	 */
   	function widget( $args, $instance ) {
   		extract( $args );
   
   		/* Our variables from the widget settings. */
   		$title = apply_filters('widget_title', $instance['title'] );
   
   		$show_thumb = isset( $instance['show_thumb'] ) ? $instance['show_thumb'] : false;
   		$posts_amount = $instance['posts_amount'];
   		$show_cat = $instance['show_cat'];
   
   		/* Before widget (defined by themes). */
   		echo $before_widget . '<div class="recent_posts_widget">';
   		
   		if ( $title )
   					echo $before_title . $title . $after_title;
   					
				
				
   		/* Display the widget title if one was input (before and after defined by themes). */
   		?>
   		
   		    <ul <?php   
   		    if($show_thumb == true)
   		    {echo 'class="with_thumbs"';} ?>>

   		   <?php 
   		    if ( $show_cat ) 
   		    	{   		    	
   		    	query_posts( array ( 'category_name' => $show_cat, 'posts_per_page' => 5 ) ); }
   		    else {
   		    	   query_posts('showposts=5'); 
   		    	}	 
   		    ?>
   		
   		    <?php while (have_posts()) : the_post(); ?>
   		    <li><a href="<?php the_permalink(); ?>">
   		    
   		    <?php 
   		    if($show_thumb == true){ ?>
   		    
   		    	<?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'widget-thumb' ); }
   		    } ?>  		  
   		   	<span class="rp_title" href="<?php the_permalink() ?>"><?php the_title(); ?></span>
   		   	
   		   	<span class="widget_date"><?php the_time('F jS, Y'); ?></span>
   		   	
   		    	  		</a>    	
   		    	</li>
 
   		    <?php endwhile;?>
   		    </ul>
  		 <?php
   		/* After widget (defined by themes). */
   	
   		echo '</div>' . $after_widget;

   	}
   	
  
   
   
   	/**
   	 * Update the widget settings.
   	 */
   	function update( $new_instance, $old_instance ) {
   		$instance = $old_instance;
   
   		/* Strip tags for title and name to remove HTML (important for text inputs). */
   		$instance['title'] = strip_tags( $new_instance['title'] );
   		$instance['posts_amount'] = strip_tags( $new_instance['posts_amount'] );
   		$instance['show_thumb'] = isset($new_instance['show_thumb']);
   		$instance['show_cat'] = $new_instance['show_cat'];

  
   		return $instance;
   	}
   
   	/**
   	 * Displays the widget settings controls on the widget panel.
   	 * Make use of the get_field_id() and get_field_name() function
   	 * when creating your form elements. This handles the confusing stuff.
   	 */
   	function form( $instance ) {
   
   		/* Set up some default widget settings. */
   		$defaults = array( 'title' => __('title', 'home'));
   		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
   
   		<!-- Widget Title: Text Input -->
   		<p>
   					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'selftitled'); ?>:</label>
   					<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
   		</p>
   		
   		<p>
   					<label for="<?php echo $this->get_field_id( 'posts_amount' ); ?>"><?php _e('Amount of posts', 'selftitled'); ?>:</label>
   					<input id="<?php echo $this->get_field_id( 'posts_amount' ); ?>" name="<?php echo $this->get_field_name( 'posts_amount' ); ?>" value="<?php echo $instance['posts_amount']; ?>" style="width:90%;" />
   		</p>

   		<p>
   					<input class="checkbox" type="checkbox" <?php checked(isset( $instance['show_thumb']) ? $instance['show_thumb'] : 0  ); ?> id="<?php echo $this->get_field_id( 'show_thumb' ); ?>" name="<?php echo $this->get_field_name( 'show_thumb' ); ?>" />
   					<label for="<?php echo $this->get_field_id( 'show_thumb' ); ?>"><?php _e('Show thumbnails?', 'selftitled'); ?></label>
   		</p> 
   		<p>
   		
 		<label for="<?php echo $this->get_field_id( 'show_cat' ); ?>"><?php _e('Show posts only from category', 'selftitled'); ?>:</label>
   		<select name="<?php echo $this->get_field_name( 'show_cat' ); ?>" id="<?php echo $this->get_field_id( 'show_cat' ); ?>"> 
   		 <option value=""><?php echo esc_attr(__('Select Category', 'selftitled')); ?></option> 
   		 <?php 
   		  $categories= get_categories(); 
   		  foreach ($categories as $category) {
   		  	echo '<option value="'.  $category->cat_name .'"'; 
   		  	if ($category->cat_name == $instance['show_cat']) echo 'selected="selected"'; 
   		  	echo '>' . $category->cat_name . '</option>';
   		  }
   		 ?>
   		</select>
   		   			   		
   		
   		
   		</p>
			
   	<?php
   	}
   }
  
  
  
  
    
function trim_title() {
$title = get_the_title();
$limit = "20";
$pad="...";

if(strlen($title) <= $limit) {
echo $title;
} else {
$title = substr($title, 0, $limit) . $pad;
echo $title;
}
}
    




  
// Twitter widget
 add_action( 'widgets_init', 'load_widgets_2' );
 
 /**
  * Register our widget.
  * 'Example_Widget' is the widget class used below.
  *
  * @since 0.1
  */
 function load_widgets_2() {
 	register_widget( 'Contact_details_widget' );
 }
 
 /**
  * Example Widget class.
  * This class handles everything that needs to be handled with the widget:
  * the settings, form, display, and update.  Nice!
  *
  * @since 0.1
  */
 class Contact_Details_Widget extends WP_Widget {
 
 	/**
 	 * Widget setup.
 	 */
 	function Contact_Details_Widget() {
 		/* Widget settings. */
 		$widget_ops = array( 'classname' => 'contact_det', 'description' => __('Contact details widget', 'selftitled') );
 
 		/* Widget control settings. */
 		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'contact-det-widget' );
 
 		/* Create the widget. */
 		$this->WP_Widget( 'contact-det-widget', __('Contact details widget', 'selftitled'), $widget_ops, $control_ops );
 		
 		
 	}
 	
 	 	
 	

 	
 	 
 	/**
 	 * How to display the widget on the screen.
 	 */
 	function widget( $args, $instance ) {
 		extract( $args );
 
 	wp_register_script('maps_google', 'http://maps.google.com/maps/api/js?sensor=false');
 	wp_enqueue_script('maps_google');
 	
 	wp_register_script('maps',  get_template_directory_uri()  . "/js/jquery.gomap-1.3.2.min.js");
 	wp_enqueue_script('maps');
 
 
 		/* Our variables from the widget settings. */
 		$title = apply_filters('widget_title', $instance['title'] );
 		$phone = $instance['phone'];
 		$e_mail = $instance['e_mail'];
 		$address = $instance['address'];
 		$show_map = isset( $instance['show_map'] ) ? $instance['show_map'] : false;

 
 		/* Before widget (defined by themes). */
 		echo $before_widget . '<div class="contact_details_widget">';
 		
 		if ( $title )
 					echo $before_title . $title . $after_title;
 		
 		
 	
 ?>		
 
 		
 		<ul>
 		<li class="phone"><img src="<?php echo get_template_directory_uri() ; ?>/images/icons/phone.png"><?php echo $phone; ?></li>
 		<li class="e_mail"><img src="<?php echo get_template_directory_uri() ; ?>/images/icons/mail.png"><?php echo $e_mail; ?></li>
 		<li class="address"><img src="<?php echo get_template_directory_uri() ; ?>/images/icons/home_2.png"><?php echo $address; ?></li>
 		
 		<?php if($show_map) {
 		 ?>		
 		<li class="map"><div id="map"></div>
 		
 			<a rel="prettyPhoto" class="fancybox fancybox.iframe" href="http://maps.google.com/?q=<?php echo $address; ?>&output=embed&iframe=true&f=q&source=s_q&hl=en&geocode=&z=16">
 			
 		
 			
 			<?php _e('View larger map &rarr;', 'selftitled'); ?></a>
 		</li>
 		
 		<?php } ?>
 		
 		
 		</ul>
 		 	
 		 	
 		 <?php if($show_map) { ?>
 		 
 		 
 		 <script type="text/javascript">
 		jQuery(function($) { 
 		    $("#map").goMap({ 
 		        address: "<?php echo $address; ?>", 
 		        zoom: 15,
 		        maptype: 'ROADMAP' 
 		    }); 
 		    
 		    
 		    $.goMap.createMarker({  
 		                address:"<?php echo $address; ?>" 
 		        }); 
 		    
 		}); 
 		 </script>
 		 
 		 	<?php } ?>
 		 
 		 
 		 
 	<?php 	echo '</div>' . $after_widget; ?> 		

	

<?php 
 	
 	}
 	

 
 
 	/**
 	 * Update the widget settings.
 	 */
 	function update( $new_instance, $old_instance ) {
 		$instance = $old_instance;
 
 		/* Strip tags for title and name to remove HTML (important for text inputs). */
 		$instance['title'] = strip_tags( $new_instance['title'] );
 		$instance['phone'] = strip_tags( $new_instance['phone'] );
 		$instance['e_mail'] = strip_tags( $new_instance['e_mail'] );
 		$instance['address'] = strip_tags( $new_instance['address'] );
 		$instance['show_map'] = isset($new_instance['show_map']);


 		return $instance;
 	}
 
 	/**
 	 * Displays the widget settings controls on the widget panel.
 	 * Make use of the get_field_id() and get_field_name() function
 	 * when creating your form elements. This handles the confusing stuff.
 	 */
 	function form( $instance ) {
 
 		/* Set up some default widget settings. */
 		$defaults = array( 'title' => __('title', 'home'));
 		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
 
 		<!-- Widget Title: Text Input -->
 		<p>
 					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'selftitled'); ?>:</label>
 					<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
 		</p>
 		
 		 		
 		<p>
 					<label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e('Phone', 'selftitled'); ?>:</label>
 					<input id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" value="<?php echo $instance['phone']; ?>" style="width:90%;" />
 		</p> 
 			
 		<p>
 					<label for="<?php echo $this->get_field_id( 'e_mail' ); ?>"><?php _e('E-mail', 'selftitled'); ?>:</label>
 					<input id="<?php echo $this->get_field_id( 'e_mail' ); ?>" name="<?php echo $this->get_field_name( 'e_mail' ); ?>" value="<?php echo $instance['e_mail']; ?>" style="width:90%;" />
 		</p> 
 				
 		<p>
 					<label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php _e('Address', 'selftitled'); ?>:</label>
 					<input id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" value="<?php echo $instance['address']; ?>" style="width:90%;" />
 		</p> 
 						
 				
 		
 		<p>
 					<input class="checkbox" type="checkbox" <?php checked(isset( $instance['show_map']) ? $instance['show_map'] : 0  ); ?> id="<?php echo $this->get_field_id( 'show_map' ); ?>" name="<?php echo $this->get_field_name( 'show_map' ); ?>" />
 					<label for="<?php echo $this->get_field_id( 'show_map' ); ?>"><?php _e('Show map?', 'selftitled'); ?></label>
 		</p> 
 		
 	<?php
 	}
 }

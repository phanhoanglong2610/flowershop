<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
        global $of_options;
        $of_options = array();
////////////////////////////////////////////////////////////////////////////             
        $of_options[] = array( "name" => "Slider", "type" => "heading");
        
        $of_options[] = array( "name" => "Slider",
					"desc" => __("Unlimited slider with drag and drop sortings."),
					"id" => "ready_slider",
					"std" => "",
					"type" => "slider");
                    
////////////////////////////////////////////////////////////////////////////
        $of_options[] = array( "name" => "Slider Options", "type" => "heading");
     
        $slider_mode = array("slider", "scroller", "accordeon");
        $of_options[] = array( "name" => "Basic Slider Options",
					"desc" => "Slider Mode",
					"id" => "mode",
					"std" => "slider",
					"type" => "select",
					"options" => $slider_mode);
        
        $of_options[] = array( "name" => "",
					"desc" => "Slider Speed",
					"id" => "speed",
					"std" => "500",
					"type" => "text"); 
                    
        $of_options[] = array( "name" => "",
					"desc" => "Slider Interval",
					"id" => "interval",
					"std" => "3000",
					"type" => "text"); 
                    
        $of_options[] = array( "name" => "",
					"desc" => "Width",
					"id" => "width",
					"std" => "835",
					"type" => "text"); 
                    
        $of_options[] = array( "name" => "",
					"desc" => "Height",
					"id" => "height",
					"std" => "400",
					"type" => "text");
                    
        $of_options[] = array( "name" => "",
					"desc" => "Pause On Hover",
					"id" => "pauseOnHover",
					"std" => "",
					"type" => "checkbox");
                    
        $of_options[] = array( "name" => "",
					"desc" => "Show Play Button",
					"id" => "showPlayButton",
					"std" => "",
					"type" => "checkbox"); 
                               
        $of_options[] = array( "name" => "",
					"desc" => "Direction Nav",
					"id" => "directionNav",
					"std" => "",
					"type" => "checkbox"); 
                    
        $of_options[] = array( "name" => "",
					"desc" => "Direction Nav Auto Hide",
					"id" => "directionNavAutoHide",
					"std" => "",
					"type" => "checkbox"); 
                    
/////////////////////////////////////////////////////////////////////////////////                                
        $of_options[] = array( "name" => "Slider Advanced Options", "type" => "heading");
        
        $of_options[] = array( "name" => "Slider Advanced Options",
					"desc" => "The space between slides",
					"id" => "slideSpace",
					"std" => "",
					"type" => "text"); 
        
        $of_options[] = array( "name" => "",
					"desc" => "Padding right of the container/frame",
					"id" => "paddingRight",
					"std" => "",
					"type" => "text"); 
                    
        $of_options[] = array( "name" => "",
					"desc" => "Hides active title bar",
					"id" => "hideCurrentTitle",
					"std" => "",
					"type" => "checkbox");
                    
        $of_options[] = array( "name" => "",
					"desc" => "Start index when initialized",
					"id" => "startIndex",
					"std" => "",
					"type" => "text"); 
                    
        $of_options[] = array( "name" => "",
					"desc" => "Enables lazy load feature",
					"id" => "lazyLoad",
					"std" => "",
					"type" => "checkbox"); 
                    
        $of_options[] = array( "name" => "",
					"desc" => "Shows play/pause button on hover and hide it when mouseout",
					"id" => "playButtonAutoHide",
					"std" => "",
					"type" => "checkbox"); 
                    
        $of_options[] = array( "name" => "",
					"desc" => "Shows text on direction navigation",
					"id" => "showDirectionText",
					"std" => "",
					"type" => "checkbox");

        $of_options[] = array( "name" => "",
					"desc" => "Next button text",
					"id" => "nextText",
					"std" => "",
					"type" => "text");

        $of_options[] = array( "name" => "",
					"desc" => "Prev button text",
					"id" => "prevText",
					"std" => "",
					"type" => "text");
                    
        $tf = array("true", "false");
        $of_options[] = array( "name" => "",
					"desc" => "Sets control navigation mode",
					"id" => "controlNav",
					"std" => "",
					"type" => "select",
					"options" => $tf);
                    
        $nav_mode = array("bullets", "thumbnails", "rotator");
        $of_options[] = array( "name" => "",
					"desc" => "Sets control navigation mode",
					"id" => "controlNavMode",
					"std" => "",
					"type" => "select",
					"options" => $nav_mode);
                    
        $of_options[] = array( "name" => "",
					"desc" => "Defines control navigation to display vertically",
					"id" => "controlNavVertical",
					"std" => "",
					"type" => "checkbox");
                    
        $nav_pos = array("inside", "outside");
        $of_options[] = array( "name" => "",
					"desc" => "Sets control navigation position",
					"id" => "controlNavPosition",
					"std" => "",
					"type" => "select",
					"options" => $nav_pos);  
                    
        $nav_vertical = array("left", "right");
        $of_options[] = array( "name" => "",
					"desc" => "Sets position of the vertical control navigation",
					"id" => "controlNavVerticalAlign",
					"std" => "",
					"type" => "select",
					"options" => $nav_vertical);
                    
        $of_options[] = array( "name" => "",
					"desc" => "The space between outside control navigation with slides",
					"id" => "controlSpace",
					"std" => "",
					"type" => "text");   

        $of_options[] = array( "name" => "",
					"desc" => "Shows control navigation on mouseover and hide it when mouseout",
					"id" => "controlNavAutoHide",
					"std" => "",
					"type" => "checkbox");

        $of_options[] = array( "name" => "",
					"desc" => "Thumbnails float position",
					"id" => "rotatorThumbsAlign",
					"std" => "",
					"type" => "text");

        $of_options[] = array( "name" => "",
					"desc" => "The CSS class used for the next button",
					"id" => "classBtnNext",
					"std" => "",
					"type" => "text");

        $of_options[] = array( "name" => "",
					"desc" => "The CSS class used for the previous button",
					"id" => "classBtnPrev",
					"std" => "",
					"type" => "text");

        $of_options[] = array( "name" => "",
					"desc" => "The CSS class used for the external links",
					"id" => "classExtLink",
					"std" => "",
					"type" => "text");   

        $of_options[] = array( "name" => "",
					"desc" => "Enable or disable linking to slides via the url",
					"id" => "permalink",
					"std" => "",
					"type" => "checkbox");

        $of_options[] = array( "name" => "",
					"desc" => "Shows overlay text on mouseover and hide it on mouseout",
					"id" => "autoHideText",
					"std" => "",
					"type" => "checkbox");
                    
        $of_options[] = array( "name" => "",
					"desc" => "Enables outer text",
					"id" => "outerText",
					"std" => "",
					"type" => "checkbox");   

        $outer_text_align = array("right", "left");
        $of_options[] = array( "name" => "",
					"desc" => "Outer text align",
					"id" => "outerTextPosition",
					"std" => "",
					"type" => "select",
					"options" => $outer_text_align);
                    
        $of_options[] = array( "name" => "",
					"desc" => "Space between text and slide",
					"id" => "outerTextSpace",
					"std" => "",
					"type" => "text");
                    
        $image_link_attr = array("_blank", "_parent", "_self", "_top");
        $of_options[] = array( "name" => "",
					"desc" => "The target attribute of the image link",
					"id" => "linkTarget",
					"std" => "",
					"type" => "select",
					"options" => $image_link_attr);  

        $of_options[] = array( "name" => "",
					"desc" => "Enables responsive layout",
					"id" => "responsive",
					"std" => "",
					"type" => "checkbox");   

        $target_attr_image_link = array("fullSize", "fitImage", "fitWidth", "fitHeight", "none");
        $of_options[] = array( "name" => "",
					"desc" => "The target attribute of the image link",
					"id" => "imageScale",
					"std" => "",
					"type" => "select",
					"options" => $target_attr_image_link);            
	}
}
?>

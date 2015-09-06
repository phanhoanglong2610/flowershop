<?php
add_shortcode('cavlist','cavlistcode');
add_filter('widget_text', 'do_shortcode');

function cavlistcode($attr, $content){
$cav_list_defaults = array(
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
'bordercolor' => '#ccc',
'borderwidth' => '1px',
'padding' => '5px',
'flag' => 1,
'city' => 1,
'state' => 1,
'country' => 1
);
$cav_list_options = shortcode_atts( $cav_list_defaults, $attr );
if(trim($cav_list_options['fontface']!="")) $fontClause="font-family: '".$cav_list_options['fontface']."'; "; else $fontClause="";
if(trim($cav_list_options['fontsize']!="")) $fontsizeClause="font-size: ".$cav_list_options['fontsize']."; "; else $fontsizeClause="";
if(trim($cav_list_options['fontcolor']!="")) $fontcolorClause="color: ".$cav_list_options['fontcolor']."; "; else $fontcolorClause="";
if(trim($cav_list_options['background']!="")) $bgClause="background: ".$cav_list_options['background']."; "; else $bgClause="";
if(trim($cav_list_options['bordercolor']!="")) $bordercolorClause="border-color: ".$cav_list_options['bordercolor']."; "; else $bordercolorClause="";
if(trim($cav_list_options['borderwidth']!="")) $borderClause="border-width: ".$cav_list_options['borderwidth']."; "; else $borderClause="";
if(trim($cav_list_options['padding']!="")){
     $hpaddingClause="padding: 0 ".$cav_list_options['padding']."; "; 
     $paddingClause="padding: ".$cav_list_options['padding']."; "; 
}else{ $paddingClause=""; $hpaddingClause=""; }

if(trim($cav_list_options['headingfontsize']!="")) $hfontsizeClause="font-size: ".$cav_list_options['headingfontsize']."; "; else $hfontsizeClause="";
if(trim($cav_list_options['headingfontcolor']!="")) $hfontcolorClause="color: ".$cav_list_options['headingfontcolor']."; "; else $hfontcolorClause="";
if(trim($cav_list_options['headingbackground']!="")) $hbgClause="background: ".$cav_list_options['headingbackground']."; "; else $hbgClause="";

$styleClause=$fontClause." ".$fontsizeClause." ".$fontcolorClause." ".$bgClause." ".$bordercolorClause.$borderClause;
$hstyleClause=$hpaddingClause." ".$hfontsizeClause." ".$hfontcolorClause." ".$hbgClause;

$cav_list_id=rand(100,1000);
$cav_visit_nonce=wp_create_nonce( 'cav_visit_nonce' );

$cav_return='<div style="border-style: solid; width:'.$cav_list_options['width'].'; '.$styleClause.' " class="cav_list_styles"><div style="'.$hstyleClause.'" class="cav_list_heading">'.$content.'</div><div style="'.$paddingClause.'" class="cav_list_content" id="cav_list_'.$cav_list_id.'" ></div></div>';

return cavshowlist($cav_list_options,$cav_return,$cav_list_id,$cav_visit_nonce);

}

?>
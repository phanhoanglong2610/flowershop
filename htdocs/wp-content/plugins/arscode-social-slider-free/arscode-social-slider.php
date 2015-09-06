<?php
/*
Plugin Name: Free Social Slider by ARScode
Plugin URI: http://arscode.pro/
Description: Social Slider plugin for WordPress.
Author: ARScode
Author URI: http://arscode.pro/
Version: 1.8
*/
/*  Copyright 2014 ARScode (email: support at arscode.pro)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/
function fblb_get_options()
{
	$options = get_option('FBLB_Options');
	return $options;
}

function fblb_options_page()
{
	include 'fblb_options_page.php';
}

function fblb_admin()
{
	add_options_page('Facebook Likebox Slider by ARScode', 'Facebook Likebox Slider by ARScode', 'manage_options', 'fblb', 'fblb_options_page');
	wp_enqueue_style(
			'fblb-css', plugins_url('/fblb.css', __FILE__)
	);
	wp_enqueue_script(
			'fblb-js', plugins_url('/js/userscripts.js', __FILE__), array('jquery')
	);
	wp_enqueue_style(
			'fblb-css-ie7', plugins_url('/ie7.css', __FILE__)
	);
	global $wp_styles;
	$wp_styles->add_data('fblb-css-ie7', 'conditional', 'lte IE 7');
}

add_action('admin_menu', 'fblb_admin');

function fblb_slider()
{
	if ($_POST['preview'] && is_admin())
	{
		global $fblb_preview_options;
		$options = $fblb_preview_options;
	}
	else
	{
		$options = fblb_get_options();
	}
	if ($options['Enable'] == 1 && $options['FacebookPageURL'])
	{
		include 'fblb_slider.php';
	}
}

// Admin
if (!is_admin())
{
	wp_enqueue_style(
			'fblb-css', plugins_url('/fblb.css', __FILE__)
	);
	wp_enqueue_script(
			'fblb-js', plugins_url('/js/userscripts.js', __FILE__), array('jquery')
	);
	add_action('wp_footer', 'fblb_slider');
}
// END Admin
?>
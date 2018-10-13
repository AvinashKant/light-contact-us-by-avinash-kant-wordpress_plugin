<?php

/*
Plugin Name:  Light Contact Us by Avinash Kant 
Plugin URI:   aviinashkant.000webhostapp.com
Description:  It have few predefined shortcut and when you use it, it will create forms in your pages or post and in plugin you have a section to see your all entry which is submitted by user.
Version:      1.0
Author:       Avinash
Author URI:   aviinashkant.000webhostapp.com
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  wporg
Domain Path:  /languages
License:     GPL2
 
Avinash Kant First Plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Avinash Kant First Plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Avinash Kant First Plugin. If not, see {License URI}.
*/


require(plugin_dir_path( __FILE__ ).'handle_form_data.php');


/**
*action and hooks code
*/
register_activation_hook( __FILE__, 'avi_perform_basic_operation' );
add_action( 'plugins_loaded', 'avi_light_contactus_scripts_and_style');
add_action('admin_menu', 'avi_menu_pages');
add_shortcode('avi_three_fields', 'avi_three_fields_shortcode_function');
add_action( 'wp_ajax_submit_ligth_avi_three_form', 'submit_ligth_avi_three_form');
add_action( 'wp_ajax_nopriv_submit_ligth_avi_three_form', '_submit_ligth_avi_three_form' );

/*add_action( 'admin_enqueue_scripts', 'load_admin_style' );
function load_admin_style() {
	wp_register_style( 'admin_css', plugins_url('css/a.css'), false, '1.0.0' );
	wp_enqueue_style( 'admin_css', plugins_url('css/a.css'), false, '1.0.0' );
}
*/


function avi_perform_basic_operation(){
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	//$table_name = $wpdb->prefix . 'avi_light_post_data';
	$table_name = 'avi_light_post_data';

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
	`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`user_name` varchar(255) DEFAULT NULL,
	`user_email` varchar(80) DEFAULT NULL,
	`user_message` text,
	`create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)$charset_collate;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );
}


/**
* this function ragister all scripts.
*/
function avi_light_contactus_scripts_and_style(){
	wp_register_script('avi_ajax_script',plugins_url( '/js/avi_light_three_fields_shortcode_function.js', __FILE__ ),array('jquery'),'1.0',true);
	$translation_array = array( 'ajax_url' => admin_url('admin-ajax.php'),
		'check_nonce' => wp_create_nonce('light-avi-nonce') 
	); 
	wp_localize_script('avi_ajax_script', 'avi_ajax_script_obj', $translation_array );

	wp_register_style('avi-style', plugins_url('css/avi_light_style.css'),false,'1.0');

	wp_enqueue_style('avi-style');
	
}



/**
this function ragister all menu in admin section
**/
function avi_menu_pages(){
	add_menu_page('My Page Title', 'Avi Light Info & Short cut', 'manage_options', 'avi-light-info-and-short-cut', 'avi_admin_page','dashicons-universal-access-alt' ,59);
	// add_submenu_page('avi-menu', 'Short Cuts', 'Your All Short Cuts', 'manage_options', 'avi-all-short-cuts','avi_all_short_cuts');
	add_submenu_page('avi-light-info-and-short-cut', 'New Request', 'Contact us Data', 'manage_options', 'avi-light-contact-us-data','avi_all_contact_us_data');
}



/**
This view on plugin view and contain all plugin description. 
**/
function avi_admin_page(){
	require(plugin_dir_path( __FILE__ ).'avi_first_page.php');
}

/**
*This view on 'Your All Short Cuts' click and contain all short cut which is used by user.
**/
function avi_all_short_cuts(){
	require(plugin_dir_path( __FILE__ ).'sub-menu-page/avi_all_short_cut.php');
}
/*
This view on 'Contact us Data' click and contain all entry which is filled by user.
**/
function avi_all_contact_us_data(){
	require(plugin_dir_path( __FILE__ ).'sub-menu-page/avi_all_contact_us_data.php');
}

/**
*this page contain short cut code.
**/
function avi_three_fields_shortcode_function() { 
	

	wp_enqueue_script('avi_ajax_script');
	require(plugin_dir_path( __FILE__ ).'forms/avi_three_fields_shortcode_function.php');

}


?>
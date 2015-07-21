<?php
/*
Plugin Name: Adsense Box
Description: Adsense Box is an plugin show adsense widget.
Plugin URI: https://wordpress.org/plugins/adsense-box
Author: De Mos
Author URI: http://photoboxone.com/
Version: 1.0
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
define('WP_AB_URL_HOME', home_url() ); 

defined('ABSPATH') or die('<meta http-equiv="refresh" content="0;url='.WP_AB_URL_HOME.'">');

define('WP_AB_PATH', dirname(__FILE__) ); 
define('WP_AB_URL', plugins_url('', __FILE__).'/' ); 
define('WP_AB_URL_MEDIA', WP_AB_URL.'media/' );

if( is_admin() ){
	
	if( preg_match('/plugins.php/i',$_SERVER['REQUEST_URI']) ){
		function adsense_box_plugin_actions( $actions, $plugin_file, $plugin_data, $context ) {
			$url = home_url('/wp-admin/widgets.php');
			
			array_unshift($actions, "<a href=\"$url\">".__("Widgets")."</a>");
			return $actions;
		}
		add_filter("plugin_action_links_".plugin_basename(__FILE__), "adsense_box_plugin_actions", 10, 4);
	}
	
} else {
	
}

include_once( WP_AB_PATH .'/widget.php' );
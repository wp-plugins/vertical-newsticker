<?php
/**
* Plugin Name: Vertical Newsticker
* Plugin URI: http://clearcrest.net/wp/
* Description: Vertical ticker for any list elements within the containing element.
 
Need more than one ticker per site? 

Contact us.

* Author: clearcrest
* Version: 0.1
* Author URI: http://clearcrest.net
*/

defined('ABSPATH') or die("No script kiddies please!");

/**
* Activate
*/

function verticalNewsTickerActivate() {
	update_option('vertical-newsticker-source', 'http://clearcrest.net/wp/vt-news-en');
	update_option('vertical-newsticker-scrollspeed', '40');
}
register_activation_hook( __FILE__, 'verticalNewsTickerActivate' );

/**
* Deactivate
*/

function verticalNewsTickerDeactivate() {
	delete_option('vertical-newsticker-source');
	update_option('vertical-newsticker-scrollspeed');
}
register_deactivation_hook( __FILE__, 'verticalNewsTickerDeactivate' );

/**
* Initialize
*/

function setVerticalNewstickerStyle() {
    wp_register_style($handle = 'vertical-newsticker-style', $src=plugins_url('/css/style.css', __FILE__));
    wp_enqueue_style('vertical-newsticker-style');
}
add_action('wp_enqueue_scripts', 'setVerticalNewstickerStyle');

function setVerticalNewstickerScript() {
    wp_register_script($handle = 'vertical-newsticker-script', $src = plugins_url('/js/vertical-newsticker.js', __FILE__));
    wp_enqueue_script('vertical-newsticker-script');
}
add_action('wp_enqueue_scripts', 'setVerticalNewstickerScript');

/** 
* Generate ticker (shortcode)
*/

function verticalNewsticker() {
	return '<div id="clearcrest-vertical-newsticker-wrapper" onmouseover="copySpeed=pauseSpeed" onmouseout="copySpeed=marqueeSpeed" v="' . getVerticalNewstickerScrollSpeed() . '"><div id="clearcrest-vertical-newsticker">' . getVerticalNewstickerSource() . '</div></div>';
}
add_shortcode('vertical_newsticker', 'verticalNewsticker'); 

/**
*	support functions
*/

function getVerticalNewstickerSource() {
	return wp_remote_retrieve_body(wp_remote_get(get_option('vertical-newsticker-source')));
}

function getVerticalNewstickerScrollSpeed() {
	return get_option('vertical-newsticker-scrollspeed');
}

/**
* Admin
*/

add_action('admin_menu', 'verticalNewstickerAdmin');

function verticalNewstickerAdmin() {
  add_options_page('Vertical Newsticker Options', 'Vertical Newsticker', 'manage_options', 'vertical-newsticker-options', 'verticalNewstickerOptions');
}

function verticalNewstickerOptions() {
  if (!current_user_can('manage_options'))  {
    wp_die( __('You do not have sufficient permissions to access this page.') );
  }
  $html = '';
  
  if (isset($_POST["vertical-newsticker-source"])){
	update_option('vertical-newsticker-source', $_POST["vertical-newsticker-source"]);
  }
  if (isset($_POST["vertical-newsticker-scrollspeed"])){
	update_option('vertical-newsticker-scrollspeed', $_POST["vertical-newsticker-scrollspeed"]);
  }
  
  $html .= '<div id="vertical-newsticker-admin">
				<h2>Vertical Newsticker</h3>
				<p>Vertical ticker for any list elements within the containing element.</p>
				<h3>Usage</h3>
					<ul style="list-style:none; padding-left:12px;"><li>
						<p>To embed the vertical newsticker, place <b style="color:#3D59AB">[vertical_newsticker]</b> where you want the vertical newsticker to be displayed. 
                        <p>Change the news source and other options below.
					</li></ul>	
				<h3>Settings</h3>
					<form name="vertical-newsticker-admin-options-form" action="" method="POST">                
					<p>News source: <input type="text" name="vertical-newsticker-source" size="100" value="' . get_option('vertical-newsticker-source') . '" /></p>
					<p>Scrollspeed (the higher, the slower): <input type="text" name="vertical-newsticker-scrollspeed" value="' . get_option('vertical-newsticker-scrollspeed') . '" /></p>
                    <input type="submit" value="save" />
					</div></form>';	
  echo $html;
}
 
?>
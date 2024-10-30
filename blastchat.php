<?php
/*
Plugin Name: BlastChat
Plugin URI: http://www.blastchat.com
Description: Chat service for your website or blog.
Version: 4.0
Author: BlastChat
Author URI: http://www.blastchat.com
License: GNU/GPL2

/*  Copyright © 2004-2013 BlastChat - chat for your website or blog. All Rights Reserved.

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

define ('BLASTCHAT_PLUGIN_URL', WP_PLUGIN_URL . str_replace('\\', '/', strrchr(dirname(__FILE__), DIRECTORY_SEPARATOR)));

$lang_arr = parse_ini_file (dirname(__FILE__). DIRECTORY_SEPARATOR .'lang.ini');
foreach ($lang_arr as $key => $value) {
	if (!defined($key)) DEFINE($key, $value);
}

require_once (dirname(__FILE__). DIRECTORY_SEPARATOR .'bar.php');
require_once (dirname(__FILE__). DIRECTORY_SEPARATOR .'shout.php');

add_action ('init', 'blastchat_init');
add_action ('widgets_init', 'blastchat_widgets_init');
add_action('wp_enqueue_scripts', 'blastchat_scripts'); // For use on the Front end (ie. Theme)
add_action('wp_head', 'blastchat_head_script'); // For use on the Front end (ie. Theme)

function blastchat_init() {
	
	add_action ('admin_menu', 'blastchat_admin_menu');
	add_action ('admin_init', 'blastchat_admin_register_settings');
	//register_activation_hook( __FILE__, 'blastchat_activate' );
	register_deactivation_hook( __FILE__, 'blastchat_deactivate' );
	register_uninstall_hook( __FILE__, 'blastchat_uninstall' );
	
	add_shortcode('blastchat','blastchat_shortcode');
}

function blastchat_head_script() {
	$par = blastchat_getconfig();

	include(dirname(__FILE__). DIRECTORY_SEPARATOR .'loader.php');
}

function blastchat_scripts() {
	$par = blastchat_getconfig();
	wp_register_script( 'blastchat-loader-script', plugins_url('/js/loader.js?'.$par->configver, __FILE__) );
	if (file_exists(dirname(__FILE__). DIRECTORY_SEPARATOR .'config/js/parseuri.js')) {
		wp_register_script( 'blastchat-parseuri-script', plugins_url('/config/js/parseuri.js?'.$par->configver, __FILE__) );
	} else {
		wp_register_script( 'blastchat-parseuri-script', plugins_url('/config_default/js/parseuri.js?'.$par->configver, __FILE__) );
	}
	if (file_exists(dirname(__FILE__). DIRECTORY_SEPARATOR .'config/languages/en.js')) {
		wp_register_script( 'blastchat-languages-script', plugins_url('/config/languages/en.js?'.$par->configver, __FILE__) );
	} else {
		wp_register_script( 'blastchat-languages-script', plugins_url('/config_default/languages/en.js?'.$par->configver, __FILE__) );
	}
	if (file_exists(dirname(__FILE__). DIRECTORY_SEPARATOR .'config/js/system.js')) {
		wp_register_script( 'blastchat-system-script', plugins_url('/config/system.js?'.$par->configver, __FILE__) );
	} else {
		wp_register_script( 'blastchat-system-script', plugins_url('/config_default/system.js?'.$par->configver, __FILE__) );
	}
	if (file_exists(dirname(__FILE__). DIRECTORY_SEPARATOR .'config/js/rooms.js')) {
		wp_register_script( 'blastchat-rooms-script', plugins_url('/config/rooms.js?'.$par->configver, __FILE__) );
	} else {
		wp_register_script( 'blastchat-rooms-script', plugins_url('/config_default/rooms.js?'.$par->configver, __FILE__) );
	}
	if (file_exists(dirname(__FILE__). DIRECTORY_SEPARATOR .'config/js/groups.js')) {
		wp_register_script( 'blastchat-groups-script', plugins_url('/config/groups.js?'.$par->configver, __FILE__) );
	} else {
		wp_register_script( 'blastchat-groups-script', plugins_url('/config_default/groups.js?'.$par->configver, __FILE__) );
	}
	if (file_exists(dirname(__FILE__). DIRECTORY_SEPARATOR .'config/js/roomsgroups.js')) {
		wp_register_script( 'blastchat-roomsgroups-script', plugins_url('/config/roomsgroups.js?'.$par->configver, __FILE__) );
	} else {
		wp_register_script( 'blastchat-roomsgroups-script', plugins_url('/config_default/roomsgroups.js?'.$par->configver, __FILE__) );
	}
	if (file_exists(dirname(__FILE__). DIRECTORY_SEPARATOR .'config/js/emoticons.js')) {
		wp_register_script( 'blastchat-emoticons-script', plugins_url('/config/emoticons.js?'.$par->configver, __FILE__) );
	} else {
		wp_register_script( 'blastchat-emoticons-script', plugins_url('/config_default/emoticons.js?'.$par->configver, __FILE__) );
	}
	if (file_exists(dirname(__FILE__). DIRECTORY_SEPARATOR .'config/js/sounds.js')) {
		wp_register_script( 'blastchat-sounds-script', plugins_url('/config/sounds.js?'.$par->configver, __FILE__) );
	} else {
		wp_register_script( 'blastchat-sounds-script', plugins_url('/config_default/sounds.js?'.$par->configver, __FILE__) );
	}
	
	wp_enqueue_script( 'blastchat-loader-script' );
	wp_enqueue_script( 'blastchat-parseuri-script' );
	wp_enqueue_script( 'blastchat-languages-script' );
	wp_enqueue_script( 'blastchat-system-script' );
	wp_enqueue_script( 'blastchat-rooms-script' );
	wp_enqueue_script( 'blastchat-groups-script' );
	wp_enqueue_script( 'blastchat-roomsgroups-script' );
	wp_enqueue_script( 'blastchat-emoticons-script' );
	wp_enqueue_script( 'blastchat-sounds-script' );
	
	if (file_exists(dirname(__FILE__). DIRECTORY_SEPARATOR .'config/css/main.css')) {
		wp_register_style( 'blastchat-main-style', plugins_url('/config/css/main.css', __FILE__) );
	} else {
		wp_register_style( 'blastchat-main-style', plugins_url('/config_default/css/main.css', __FILE__) );
	}
	if (file_exists(dirname(__FILE__). DIRECTORY_SEPARATOR .'config/css/icons.css')) {
		wp_register_style( 'blastchat-icons-style', plugins_url('/config/css/icons.css', __FILE__) );
	} else {
		wp_register_style( 'blastchat-icons-style', plugins_url('/config_default/css/icons.css', __FILE__) );
	}
	if (file_exists(dirname(__FILE__). DIRECTORY_SEPARATOR .'config/css/emoticons.css')) {
		wp_register_style( 'blastchat-emoticons-style', plugins_url('/config/css/emoticons.css', __FILE__) );
	} else {
		wp_register_style( 'blastchat-emoticons-style', plugins_url('/config_default/css/emoticons.css', __FILE__) );
	}
	if (file_exists(dirname(__FILE__). DIRECTORY_SEPARATOR .'config/css/sounds.css')) {
		wp_register_style( 'blastchat-sounds-style', plugins_url('/config/css/sounds.css', __FILE__) );
	} else {
		wp_register_style( 'blastchat-sounds-style', plugins_url('/config_default/css/sounds.css', __FILE__) );
	}
	
	wp_enqueue_style( 'blastchat-main-style' );
	wp_enqueue_style( 'blastchat-icons-style' );
	wp_enqueue_style( 'blastchat-emoticons-style' );
	wp_enqueue_style( 'blastchat-sounds-style' );
}

function blastchat_shortcode( $atts, $content = null ) {
	$website = shortcode_atts( array(
		'id' => '1',
		'interface' => 'chat',
		'width' => '100%',
		'height' => '480',
		'rids' => '1'
    ), $atts );
	$par = blastchat_getconfig();

	if (isset($_GET['bc_task'])) {
		$bc_task = htmlspecialchars($_GET['bc_task'], ENT_QUOTES, "UTF-8");
		if ($bc_task == 'keepsession') {
			echo "ok";
			return;
		}
	}

	$bcData = new stdClass();
	$bcData->detached = 0;
	$bcData->client = 'chat';
	
	if (isset($_GET['i']) && $_GET['i'] == 'mob') {
		$bcData->detached = 0;
		$bcData->client = 'mob';
		$bcData->interface = 'mob';
		$bcData->version = "4.0";

		$bcData->roomids = $website["rids"] ? $website["rids"] : ''; //comma separated list of room ids to open
		$bcData->id = "blastchatmob";
		
		include(dirname(__FILE__). DIRECTORY_SEPARATOR .'loader.php');
		echo '<div class="bcMain bcMainLoading" id="'.$bcData->id.'" style="width: 100%; height: 100%"></div>';
		return;
	} else if ((isset($_GET['d']) ? htmlspecialchars($_GET['d'], ENT_QUOTES, "UTF-8") : 0) == 1) {
		$bcData->detached = 1;
		$bcData->client = 'conf';
		if (isset($_GET['r'])) {
			$website["rids"] = htmlspecialchars($_GET['r'], ENT_QUOTES, "UTF-8");
		}
		if (isset($_GET['i'])) {
			$website["interface"] = htmlspecialchars($_GET['i'], ENT_QUOTES, "UTF-8");
		}
	}
	$bcData->interface = $website["interface"] ? $website["interface"] : "chat";
	$bcData->version = "4.0";

	$bcData->roomids = $website["rids"] ? $website["rids"] : ''; //comma separated list of room ids to open
	$bcData->id = "blastchatchat".$website['id'];
	if ($bcData->detached) {
		$bcData->id = "blastchatchat";
	}

	$bcwidth = $website["width"];
	if (strpos($bcwidth, "%") === false) {
		$bcwidth .= "px";
	}

	$bcheight = $website["height"];
	if (strpos($bcheight, "%") === false) {
		$bcheight .= "px";
	}

	include(dirname(__FILE__). DIRECTORY_SEPARATOR .'loader.php');
	if ($bcData->detached) {
		echo '<div class="bcMainDetached bcMainLoading" id="'.$bcData->id.'"></div>';
	} else {
		echo '<div class="bcMainChat bcMainLoading" id="'.$bcData->id.'" style="width: '.$bcwidth.'; height: '.$bcheight.'"></div>';
	}
}

function blastchat_widgets_init() {
	register_widget("BlastChatBar_Widget");
	register_widget("BlastChatShout_Widget");
}
	
function blastchat_activate()
{
	blastchat_admin_register_settings();
}

function blastchat_deactivate()
{
	unregister_setting ('blastchat', 'blastchat_sid', blastchat_sanitize);
	unregister_setting ('blastchat', 'blastchat_pk', blastchat_sanitize);
	unregister_setting ('blastchat', 'blastchat_configver', blastchat_sanitize);
	unregister_setting ('blastchat', 'blastchat_theme', blastchat_sanitize);
	unregister_setting ('blastchat', 'blastchat_themecname', blastchat_sanitize);
	unregister_setting ('blastchat', 'blastchat_themecloc', blastchat_sanitize);
	unregister_setting ('blastchat', 'blastchat_themeover', blastchat_sanitize);
	unregister_setting ('blastchat', 'blastchat_guestprefix', blastchat_sanitize);
	unregister_setting ('blastchat', 'blastchat_avtint', blastchat_sanitize);
	unregister_setting ('blastchat', 'blastchat_lang', blastchat_sanitize);
}

function blastchat_getconfig() {
	$return = new stdClass();
	$return->sid = get_option('blastchat_sid');
	$return->pk = get_option('blastchat_pk');
	$return->configver = get_option('blastchat_configver');
	$return->theme = get_option('blastchat_theme');
	$return->themecname = get_option('blastchat_themecname');
	$return->themecloc = get_option('blastchat_themecloc');
	$return->themeover = get_option('blastchat_themeover');
	$return->guestprefix = get_option('blastchat_guestprefix');
	$return->avtint = get_option('blastchat_avtint');
	$return->lang = get_option('blastchat_lang');
	return $return;
}

function blastchat_uninstall()
{
	delete_option ('blastchat_sid');
	delete_option ('blastchat_pk');
	delete_option ('blastchat_configver');
	delete_option ('blastchat_theme');
	delete_option ('blastchat_themecname');
	delete_option ('blastchat_themecloc');
	delete_option ('blastchat_themeover');
	delete_option ('blastchat_guestprefix');
	delete_option ('blastchat_avtint');
	delete_option ('blastchat_lang');
}

function blastchat_admin_register_settings()
{
	register_setting ('blastchat', 'blastchat_sid', blastchat_sanitize);
	register_setting ('blastchat', 'blastchat_pk', blastchat_sanitize);
	register_setting ('blastchat', 'blastchat_configver', blastchat_sanitize);
	register_setting ('blastchat', 'blastchat_theme', blastchat_sanitize);
	register_setting ('blastchat', 'blastchat_themecname', blastchat_sanitize);
	register_setting ('blastchat', 'blastchat_themecloc', blastchat_sanitize);
	register_setting ('blastchat', 'blastchat_themeover', blastchat_sanitize);
	register_setting ('blastchat', 'blastchat_guestprefix', blastchat_sanitize);
	register_setting ('blastchat', 'blastchat_avtint', blastchat_sanitize);
	register_setting ('blastchat', 'blastchat_lang', blastchat_sanitize);
	
	if (! get_option('blastchat_sid')) {
		update_option('blastchat_sid', "");
	}
	if (! get_option('blastchat_pk')) {
		update_option('blastchat_pk', "");
	}
	if (! get_option('blastchat_configver')) {
		update_option('blastchat_configver', "0");
	}
	if (! get_option('blastchat_theme')) {
		update_option('blastchat_theme', "tundra");
	}
	if (! get_option('blastchat_themecname')) {
		update_option('blastchat_themecname', "");
	}
	if (! get_option('blastchat_themecloc')) {
		update_option('blastchat_themecloc', "");
	}
	if (! get_option('blastchat_themeover')) {
		update_option('blastchat_themeover', "");
	}
	if (! get_option('blastchat_guestprefix')) {
		update_option('blastchat_guestprefix', "Guest_");
	}
	if (! get_option('blastchat_avtint')) {
		update_option('blastchat_avtint', "1");
	}
	if (! get_option('blastchat_lang')) {
		update_option('blastchat_lang', "en");
	}
}

function blastchat_sanitize($value) {
	if (! $value) {
		$value = "";
	} else {
		$value = htmlspecialchars($value, ENT_QUOTES, "UTF-8");
	}
	return $value;
}

//
// Add BlastChat Client menus
//
function blastchat_admin_menu()
{
	$website = blastchat_getconfig();
	// Get the languages file if it exists
	if (file_exists(dirname(__FILE__). DIRECTORY_SEPARATOR .'languages'. DIRECTORY_SEPARATOR .$website->lang.'.php')) {
		include_once(dirname(__FILE__). DIRECTORY_SEPARATOR .'languages'. DIRECTORY_SEPARATOR .$website->lang.'.php');
	}
	add_menu_page ('BlastChat Settings', BLASTCHAT_MANAGER_BLASTCHAT, 'administrator', 'blastchat', 'blastchat', BLASTCHAT_PLUGIN_URL. DIRECTORY_SEPARATOR .'images/blastchat.ico');
	add_submenu_page ('blastchat', 'BlastChat Configuration', 'Configuration', 'administrator', 'blastchat', 'blastchat');
	//add_submenu_page ('blastchat', 'BlastChat Administration', 'Administration', 'administrator', 'blastchat_administration', 'blastchat_administration');
	//add_submenu_page ('blastchat', 'BlastChat Registration', 'Registration', 'administrator', 'blastchat_register', 'blastchat_register');
}

//
// Configuration page
//
function blastchat()
{
	require_once (dirname(__FILE__). DIRECTORY_SEPARATOR .'config.php');
	_blastchat();
}

function blastchat_showBottomLicense() {
?><div class="footer" align="center">
	<table border="0" width="99%">
	<tbody>
	<tr>
	<td align="center">
	<div align="center"><a href="http://www.blastchat.com" target="_blank"><?php echo BLASTCHAT_MANAGER_BLASTCHAT;?> 4.0</a>, GNU/GPL License</div>
	<div class="smallgrey" align="center">Copyright (C) 2004-2012 <a href="http://www.blastchat.com" target="_blank">BlastChat</a>. All rights reserved.</div>
	</td>
	</tr>
	</tbody>
	</table>
</div>
<?php } ?>
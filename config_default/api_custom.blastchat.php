<?php
/**
 * @version	$Id: api_custom.blastchat.php 2013-01-30 15:24:18Z $
 * @package	BlastChat Config
 * @author 	BlastChat
 * @copyright	Copyright (C) 2004-2013 BlastChat. All rights reserved.
 * @license	GNU/GPL, see LICENSE.php
 * @HomePage 	<http://www.blastchat.com>

 * This file is part of BlastChat Config.

 * BlastChat Config is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.

 * BlastChat Config is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with BlastChat Config.  If not, see <http://www.gnu.org/licenses/>.
 */

class BlastChatApiCustom extends BlastChatApi
{
	/*
	public function bc_createBlastChatData($bcData, $par) {
		static $called;
		static $bcDataJavascript;

		$bcData->request = "http://bcs.blastchat.com/bc/dist/bcif/bc.js";
	
		if ($par) {
			$cver = $par->configver;
			if (empty($cver) && $cver!=0) {
				echo "Missing BlastChat Config - Config version.";
				return;
			}
			$sid = $par->sid;
			if (!$sid || empty($sid)) {
				echo "Missing BlastChat Config - Website ID.";
				return;
			}
			$sid = intval($sid);
			$pk = $par->pk;
			if (empty($pk)) {
				echo "Missing BlastChat Config - Private key.";
				return;
			}
			$guestprefix = $par->guestprefix;
			if (empty($guestprefix)) {
				echo "Missing BlastChat Config - Guest prefix.";
				return;
			}
		} else {
			echo "Missing BlastChat Config extension.";
			return;
		}
		
		$bcData->configver = trim($cver);
		$bcData->sid = $sid;
		$bcData->pk = trim($pk);
		$bcData->guestprefix = trim($guestprefix);
	
		if (!$called) {
			$user = self::bc_getUser();
	
			$bcData->theme = self::bc_getTheme($par);
			
			$bcData->userid = $user->id ? $user->id : 0;
			$bcData->name = $bcData->userid != 0 ? $user->username : uniqid($bcData->guestprefix, false);
			
			$guestnames = self::bc_getGuestNames();
			if (count($guestnames) > 0) {
				$bcData->fullname = $bcData->userid != 0 ? $user->name : $bcData->guestprefix.$guestnames[rand(0, count($guestnames)-1)];
			} else {
				$bcData->fullname = $bcData->userid != 0 ? $user->name : $bcData->name;
			}
			
			$bcData->gids = self::bc_getUserGroups($user);
			$bcData->gender = self::bc_getUserGender($user);
			$bcData->friends = self::bc_getUserFriends($user);
			$bcData->lang = self::bc_getLanguageFile($user, $par);
			
			$bcData->avtPath = "";
			$bcData->avt = "";
			$bcData->avtShow = false;
			if ($par->avtint != "0") {
				$avatar = self::bc_getUserAvatar($user, $par->avtint);
				$bcData->avtPath = $avatar->commonpath;
				$bcData->avt = $avatar->file;
				$bcData->avtShow = true;
			}
	
			$jversion = self::bc_getVersion();
			$bcData->prod = "'".$jversion->PRODUCT."','".$jversion->RELEASE."','".$jversion->DEV_LEVEL."'";
			
			$bcData->protocol = 0; //0 http, 1 - https (not used)
			$bcData->time = time();
			$bcData->code = hash('sha256', $bcData->time.$bcData->pk.$bcData->userid.$bcData->name.$bcData->gids );
			
			$bcDataJavascript = ""
				."<script type=\"text/javascript\">"
				."if (typeof bcData === 'undefined') {"
					."var bcData = {"
						."'sid':".$bcData->sid.","
						."'auth':['".$bcData->time."','".$bcData->code."'],"
						."'user': ".json_encode(array(
							'sid' => $bcData->sid,
							'id' => $bcData->userid,
							'name' => $bcData->name,
							'fullname' => $bcData->fullname,
							'gids' => $bcData->gids,
							'gender' => $bcData->gender,
							'avt' => $bcData->avt
							)).","
						."'avtPath':'".$bcData->avtPath."',"
						."'avtShow':".($bcData->avtShow ? 'true' : 'false').","
						."'friends':[".$bcData->friends."],"
						."'bw':".(isset($bcData->barWidth) && $bcData->barWidth > 0 ? $bcData->barWidth : '0').","
						."'bh':".(isset($bcData->barHeight) && $bcData->barHeight > 0 ? $bcData->barHeight : '0').","
						."'detached':".(isset($bcData->detached) ? $bcData->detached : '0').","
						."'protocol':".$bcData->protocol.","
						."'product':[".$bcData->prod."],"
						."'theme':{'name':'".$bcData->theme->name."','cloc':'".$bcData->theme->cloc."','over':'".$bcData->theme->over."'},"
						."'bcc':[]"
					."};"
				."}"
				."</script>\n"
				;
			echo $bcDataJavascript;
		}
		
		if (!$called) {
			echo "<script type=\"text/javascript\">if (typeof bcData.loaded === 'undefined') {bcLoader('bcJSmain', 'script', '".$bcData->request."', null, null);bcData.loaded = [];}</script>\n";

		}
		if (isset($bcData->id)) {
			echo "<script type=\"text/javascript\">var bcDataObj = ['".$bcData->id."','".$bcData->client."','".$bcData->interface."',[".$bcData->roomids."], '".$bcData->version."'];if (bcData.loaded.indexOf('".$bcData->id."') == -1) {bcData.bcc.push(bcDataObj);bcData.loaded.push('".$bcData->id."');}</script>\n";
		}
			
		$called = true;
	}
	*/
	
	/*
	protected function bc_getTheme($par) {
		$theme->name = $par->theme;
		$theme->cloc = "";
		$theme->over = "";
		if ($par->themecname != "" && $par->themecloc != "") {
			$theme->name = $par->themecname;
			$theme->cloc = $par->themecloc;
		}
		$theme->over = $par->themeover;
		return $theme;
	}
	*/
	
	/*
	return language file name in the "languages" subdirectory, we will prepend .js extension to it
	*/
	/*
	protected function bc_getLanguageFile($user, $par) {
		$lang = "en";
		if ($par["bclang"]) {
			$lang = $par["bclang"];
		}
		return $lang;
	}
	*/
	
	/*
	return predefined guest names, if empty generated guest name will be used
	*/
	/*
	protected function bc_getGuestNames() {
		//return array("John", "Peter", "Mark", "Jim", "Bill");
		return array();
	}
	*/
	
	/*
	return user object (containing at least id, username, name)
	$user->id
	$user->username
	$user->name
	*/
	/*
	protected function bc_getUser() {
		global $current_user;
		get_currentuserinfo();
		
		$user->id = $current_user->ID;
		$user->username = $current_user->user_login;
		$user->name = $current_user->display_name;
		return $user;
	}
	*/
	
	/*
	return comma separated string of user group ids
	*/
	/*
	protected function bc_getUserGroups($user) {
		//find gids
		$gids = "0"; //Guest
	
		global $current_user;
		get_currentuserinfo();
			
		$capabilities = $current_user->wp_capabilities;
		if ( !isset( $wp_roles ) )
			$wp_roles = new WP_Roles();
		if ($capabilities) {
			foreach ( $wp_roles->role_names as $role => $name ) {
				if ( array_key_exists( $role, $capabilities ) ) {
					switch($role) {
						case 'administrator':
							$gids = "1";
							break; //SuperAdmin
						case 'editor':
						case 'author':
						case 'contributor':
						case 'subscriber':
							$gids = "2";
							break; //Member
					}
				}
			}
		}
		return $gids;
	}
	*/
	
	/*
	returns int
	0 - unknown, 1 - male, 2 - female
	*/
	/*
	protected function bc_getUserGender($user) {
		//$user->gender
		$gender = 0;
		return $gender;
	}
	*/
	
	/*
	return comma separated string of user friends IDs
	*/
	/*
	protected function bc_getUserFriends($user) {
		//$friends = implode(',', array('1','2','3'));
		$friends = "";
		return $friends;
	}
	*/
	
	/*
	protected function bc_getUserAvatar($user, $type) {
		$avt_file = "";
		$avt_commonpath = "";
		$avt_path = "";
		$row = null;

		$avatar = "";
		
		if (type == 1) {
			if ($user->id) {
				$avt_file = get_avatar($user->id);
			} else {
				//need guest avatar
			}
		}
		if (type == 2) {
			//custom
		}
		$avatar->commonpath = $avt_commonpath;
		$avatar->file = $avt_file;
		return $avatar;
	}
	*/
	
	/*
	protected function bc_getVersion() {
		//prepare variables dependent on system used
		// $_VERSION - variable holding CMS information
		// $_VERSION->PRODUCT - product used
		// $_VERSION->RELEASE - release number of product used
		// $_VERSION->DEV_LEVEL  - development number of product used
		global $wp_version;
		$bc_version->PRODUCT = "WP";
		$bc_version->RELEASE = $wp_version;
		$bc_version->DEV_LEVEL = "";
	}
	*/
}
?>
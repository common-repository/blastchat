<?php
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

function _blastchat() {
	if (isset($_GET['updated']))
	{
		echo '<div class="updated"><p><strong>Configuration saved.</strong></p></div>';
	}

	$src = dirname(__FILE__) . DIRECTORY_SEPARATOR . "config_default";
	$dest = dirname(__FILE__) . DIRECTORY_SEPARATOR . "config";

	if ( !is_dir( $dest ) ) {
		if (@mkdir( $dest )) {
			if (!is_file($dest. DIRECTORY_SEPARATOR ."system.js")) {
				copy( $src. DIRECTORY_SEPARATOR ."system.js", $dest. DIRECTORY_SEPARATOR ."system.js");
			}
			if (!is_file($dest. DIRECTORY_SEPARATOR ."rooms.js")) {
				copy( $src. DIRECTORY_SEPARATOR ."rooms.js", $dest. DIRECTORY_SEPARATOR ."rooms.js");
			}
			if (!is_file($dest. DIRECTORY_SEPARATOR ."groups.js")) {
				copy( $src. DIRECTORY_SEPARATOR ."groups.js", $dest. DIRECTORY_SEPARATOR ."groups.js");
			}
			if (!is_file($dest. DIRECTORY_SEPARATOR ."roomsgroups.js")) {
				copy( $src. DIRECTORY_SEPARATOR ."roomsgroups.js", $dest. DIRECTORY_SEPARATOR ."roomsgroups.js");
			}
			if (!is_file($dest. DIRECTORY_SEPARATOR ."emoticons.js")) {
				copy( $src. DIRECTORY_SEPARATOR ."emoticons.js", $dest. DIRECTORY_SEPARATOR ."emoticons.js");
			}
			if (!is_file($dest. DIRECTORY_SEPARATOR ."sounds.js")) {
				copy( $src. DIRECTORY_SEPARATOR ."sounds.js", $dest. DIRECTORY_SEPARATOR ."sounds.js");
			}
			if (!is_file($dest. DIRECTORY_SEPARATOR ."api.blastchat.php.js")) {
				copy( $src. DIRECTORY_SEPARATOR ."api_custom.blastchat.php", $dest. DIRECTORY_SEPARATOR ."api.blastchat.php");
			}
			if (!is_file($dest. DIRECTORY_SEPARATOR ."index.html")) {
				copy( $src. DIRECTORY_SEPARATOR ."index.html", $dest. DIRECTORY_SEPARATOR ."index.html");
			}
			
			@mkdir( $dest . DIRECTORY_SEPARATOR . "css");
			copy( $src. DIRECTORY_SEPARATOR ."css" . DIRECTORY_SEPARATOR . "index.html", $dest. DIRECTORY_SEPARATOR ."css" . DIRECTORY_SEPARATOR . "index.html");
			@mkdir( $dest . DIRECTORY_SEPARATOR . "images");
			copy( $src. DIRECTORY_SEPARATOR ."images" . DIRECTORY_SEPARATOR . "index.html", $dest. DIRECTORY_SEPARATOR ."images" . DIRECTORY_SEPARATOR . "index.html");
			@mkdir( $dest . DIRECTORY_SEPARATOR . "js");
			copy( $src. DIRECTORY_SEPARATOR ."js" . DIRECTORY_SEPARATOR . "index.html", $dest. DIRECTORY_SEPARATOR ."js" . DIRECTORY_SEPARATOR . "index.html");
			@mkdir( $dest . DIRECTORY_SEPARATOR . "languages");
			copy( $src. DIRECTORY_SEPARATOR ."languages" . DIRECTORY_SEPARATOR . "index.html", $dest. DIRECTORY_SEPARATOR ."languages" . DIRECTORY_SEPARATOR . "index.html");
			@mkdir( $dest . DIRECTORY_SEPARATOR . "sounds");
			copy( $src. DIRECTORY_SEPARATOR ."sounds" . DIRECTORY_SEPARATOR . "index.html", $dest. DIRECTORY_SEPARATOR ."sounds" . DIRECTORY_SEPARATOR . "index.html");
		}
	}
?>
<div class="wrap">
<div id="icon-options-general" class="icon32"><br /></div> 
<h2><?php echo BLASTCHAT_MANAGER_BLASTCHAT;?> 4.0</h2>

<table class="widefat comments fixed" cellspacing="0">
<thead>
	<tr>
	<th scope="col" colspan="2" class="manage-column column-title" style="" width="90%"><?php echo BLASTCHAT_INSTRUCTIONS;?></th>
	</tr>
</thead>

<tfoot>
</tfoot>

<tbody id="the-comment-list" class="list:comment">
<tr id="comment-1" class="approved">
	<td class="author column-author" colspan="2">
			<div>
				<p>1. Create blastchat.com account, register your website and manage your registration using our <a href="http://www.blastchat.com/manager" target="_blank" title="BlastChat Manager">BlastChat Manager</a>.</p>
				<p>2. Copy Authentication data from step 1.</p>
				<p>3. User interface configuration is located in wp_content/plugins/wp_blastchat/config directory files. You can read more about it at our <a href="http://www.blastchat.com/configuration" target="_blank" title="BlastChat Configuration">Configuration</a> page.</p>
				<p>4. Install BlastChat Chat, BlastChat Shout and/or BlastChat Bar plugins.</p>
			<div>
	</td>
</tr>
</tbody>
</table>
<br>
<form method="post" action="options.php">
<?php settings_fields('blastchat'); ?>
<table class="widefat comments fixed" cellspacing="0">
<thead>
	<tr>
	<th scope="col" colspan="2" class="manage-column column-title" style="" width="90%"><?php echo BLASTCHAT_CONFIGURATION;?></th>
	</tr>
</thead>

<tfoot>
	<tr>
	<th scope="col" class="manage-column column-title" style="" colspan="2">
		<div align="center" style="width:100%; font-size: 10px; text-align:center; margin: 0px 0px 0px 0px; padding: 0px 0px 0px 0px;">Powered by <a href="http://www.blastchat.com" target="_blank" title="BlastChat - free chat for your website">BlastChat</a></div>
		<?php blastchat_showBottomLicense();?>
	</th>
	</tr>
</tfoot>

<tbody id="the-comment-list" class="list:comment">
<tr id="comment-1" class="approved">
	<td class="author column-author" colspan="2">
		<table class="form-table">
		<tr>
		<th scope="row"><label for="blastchat_sid"><?php echo BLASTCHAT_FIELD_SID_LABEL; ?>:</label></th>
		<td><input type="text" name="blastchat_sid" id="blastchat_sid" value="<?php echo get_option('blastchat_sid'); ?>" class="regular-text" />
			<div class="description"><?php echo BLASTCHAT_FIELD_SID_DESC; ?></div></td>
		</tr>
		<tr>
		<th scope="row"><label for="blastchat_pk"><?php echo BLASTCHAT_FIELD_PK_LABEL; ?>:</label></th>
		<td><input type="text" name="blastchat_pk" id="blastchat_pk" value="<?php echo get_option('blastchat_pk'); ?>" class="regular-text" />
			<div class="description"><?php echo BLASTCHAT_FIELD_PK_DESC; ?></div></td>
		</tr>
		<tr>
		<th scope="row"><label for="blastchat_configver"><?php echo BLASTCHAT_FIELD_CONFIGVER_LABEL; ?>:</label></th>
		<td><input type="text" name="blastchat_configver" id="blastchat_configver" value="<?php echo get_option('blastchat_configver'); ?>" class="regular-text" />
			<div class="description"><?php echo BLASTCHAT_FIELD_CONFIGVER_DESC; ?></div></td>
		</tr>
		<tr>
		<th scope="row"><label for="blastchat_theme"><?php echo BLASTCHAT_FIELD_THEME_LABEL; ?>:</label></th>
		<td><select name="blastchat_theme" id="blastchat_theme" class="regular-text">
				<option value="claro" <?php echo get_option('blastchat_theme') == "claro" ? "selected" : "";?>>claro</option>
				<option value="nihilo" <?php echo get_option('blastchat_theme') == "nihilo" ? "selected" : "";?>>nihilo</option>
				<option value="soria" <?php echo get_option('blastchat_theme') == "soria" ? "selected" : "";?>>soria</option>
				<option value="tundra" <?php echo get_option('blastchat_theme') == "tundra" ? "selected" : "";?>>tundra</option>
			</select>
			<div class="description"><?php echo BLASTCHAT_FIELD_THEME_DESC; ?></div></td>
		</tr>
		<tr>
		<th scope="row"><label for="blastchat_themecname"><?php echo BLASTCHAT_FIELD_THEMECNAME_LABEL; ?>:</label></th>
		<td><input type="text" name="blastchat_themecname" id="blastchat_themecname" value="<?php echo get_option('blastchat_themecname'); ?>" class="regular-text" />
			<div class="description"><?php echo BLASTCHAT_FIELD_THEMECNAME_DESC; ?></div></td>
		</tr>
		<tr>
		<th scope="row"><label for="blastchat_themecloc"><?php echo BLASTCHAT_FIELD_THEMECLOC_LABEL; ?>:</label></th>
		<td><input type="text" name="blastchat_themecloc" id="blastchat_themecloc" value="<?php echo get_option('blastchat_themecloc'); ?>" class="regular-text" />
			<div class="description"><?php echo BLASTCHAT_FIELD_THEMECLOC_DESC; ?></div></td>
		</tr>
		<tr>
		<th scope="row"><label for="blastchat_themeover"><?php echo BLASTCHAT_FIELD_THEMEOVER_LABEL; ?>:</label></th>
		<td><input type="text" name="blastchat_themeover" id="blastchat_themeover" value="<?php echo get_option('blastchat_themeover'); ?>" class="regular-text" />
			<div class="description"><?php echo BLASTCHAT_FIELD_THEMEOVER_DESC; ?></div></td>
		</tr>
		<tr>
		<th scope="row"><label for="blastchat_guestprefix"><?php echo BLASTCHAT_FIELD_GUESTPREFIX_LABEL; ?>:</label></th>
		<td><input type="text" name="blastchat_guestprefix" id="blastchat_guestprefix" value="<?php echo get_option('blastchat_guestprefix'); ?>" class="regular-text" />
			<div class="description"><?php echo BLASTCHAT_FIELD_GUESTPREFIX_DESC; ?></div></td>
		</tr>
		<tr>
		<th scope="row"><label for="blastchat_avtint"><?php echo BLASTCHAT_FIELD_AVTINT_LABEL; ?>:</label></th>
		<td><select name="blastchat_avtint" id="blastchat_avtint" value="<?php echo get_option('blastchat_avtint'); ?>" class="regular-text">
				<option value="0" <?php echo get_option('blastchat_avtint') == 0 ? "selected" : "";?>>None</option>
				<option value="1" <?php echo get_option('blastchat_avtint') == 1 ? "selected" : "";?>>Default</option>
				<option value="2" <?php echo get_option('blastchat_avtint') == 2 ? "selected" : "";?>>Other</option>
			</select>
			<div class="description"><?php echo BLASTCHAT_FIELD_AVTINT_DESC; ?></div></td>
		</tr>
		<tr>
		<th scope="row"><label for="blastchat_lang"><?php echo BLASTCHAT_FIELD_LANG_LABEL; ?>:</label></th>
		<td><input type="text" name="blastchat_lang" id="blastchat_lang" value="<?php echo get_option('blastchat_lang'); ?>" class="regular-text" />
			<div class="description"><?php echo BLASTCHAT_FIELD_LANG_DESC; ?></div></td>
		</tr>
		</table>

		<p class="submit">
		<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		</p>
</td></tr>
</tbody>
<tbody id="the-extra-comment-list" class="list:comment" style="display: none;">
</tbody>
</table>
	</form>
<?php } ?>
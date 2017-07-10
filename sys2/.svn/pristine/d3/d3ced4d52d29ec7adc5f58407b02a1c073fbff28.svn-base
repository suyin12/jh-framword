<?php
/*
Plugin Name: Sticky Manager
Description: Allows simple management of sticky posts from a centralized admin panel.
Author: Adam Pieroni
Version: 0.9.1
*/

/*  Copyright (c) 2010 Adam Pieroni

    Except for portions marked otherwise, this program is free software; 
    you can redistribute it and/or modify it under the terms of the GNU 
    General Public License as published by the Free Software Foundation; 
    either version 2 of the License, or (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

add_action('admin_init', 'apsm_admin_init');
add_action('admin_menu', 'apsm_admin_menu');


function apsm_admin_init() {
	wp_register_script('sticky-manager', WP_PLUGIN_URL . '/sticky-manager/sticky-manager.js');
	wp_register_style('sticky-manager', WP_PLUGIN_URL . '/sticky-manager/sticky-manager.css');
}
function apsm_admin_scripts() {
	wp_enqueue_script('sticky-manager');
}
function apsm_admin_styles() {
	wp_enqueue_style('sticky-manager');
}
function apsm_admin_menu() {
	$apsm_role = get_option("apsm_role", FALSE);
	if ($apsm_role=='admin') {
		// Administrator Role
		$apsm_capability = "manage_options";
	} else {
		// Editor Role
		$apsm_capability = "edit_others_posts";
	}

	$page = add_submenu_page("edit.php", "Sticky Manager", "Manage Stickies", $apsm_capability, __FILE__, "apsm_echo_admin_menu");
	add_action('admin_print_scripts-' . $page, 'apsm_admin_scripts');
	add_action('admin_print_styles-' . $page, 'apsm_admin_styles');	
	add_options_page('Sticky Manager Options', 'Sticky Manager', 'manage_options', 'apsm_options_page', 'apsm_options');
}

function apsm_options() {

  if (!current_user_can('manage_options'))  {
    wp_die( __('You do not have sufficient permissions to access this page.') );
  }

	?>
	
		<div class="wrap">
			<h2>Sticky Manager Options</h2>
			
			<form method="post" action="options.php">
			<?php wp_nonce_field('update-options'); ?>
			<?php if (!$apsm_role = get_option('apsm_role')) { $apsm_role="editor"; } ; ?>
			
				<table class="form-table">
					
					<tr valign="top">
						<th scope="row">Minimum Role</th>
						<td>
							<select name="apsm_role">
								<option value="editor" <? if ($apsm_role=="editor") echo "selected=\"selected\"" ?>>Editor</option>
								<option value="admin" <? if ($apsm_role=="admin") echo "selected=\"selected\"" ?>>Administrator</option>
							</select>
						</td>
					</tr>				
				</table>
				
				<input type="hidden" name="action" value="update" />
				<input type="hidden" name="page_options" value="apsm_role" />
				
				<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
				</p>
			
			</form>
		</div>
	
	<?

}


function apsm_add_stickies() {
	$to_be_sticky = $_POST['apsm-sticky-posts'];
	foreach ($to_be_sticky as $k => $post_id) {
		if ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}	else {
			settype($to_be_sticky[$k], "integer");
		}
	}
	if ($already_sticky = get_option("sticky_posts", FALSE)) {
		$already_sticky;
		$to_be_sticky = array_unique(array_merge($to_be_sticky, $already_sticky));
	}
	sort($to_be_sticky, SORT_NUMERIC);
	$to_be_sticky;
	update_option("sticky_posts", $to_be_sticky);
	
}
function apsm_remove_stickies() {
	$remove_stickies = $_POST['apsm-remove-sticky-posts'];
	foreach ($remove_stickies as $k => $post_id) {
		if ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		} else {
			settype($remove_stickies[$k], "integer");
		}
	}
	if ($already_sticky = get_option("sticky_posts", FALSE)) {
		$to_be_sticky = array_diff($already_sticky, $remove_stickies);
		sort($to_be_sticky, SORT_NUMERIC);	
		update_option("sticky_posts", $to_be_sticky);
	}
}


// A utility function to truncate text, avoiding word boundaries.
function apsm_truncate_text_nicely($string, $max, $moretext="...") {
	// Only begin to manipulate if the string is longer than max
	if (strlen($string) > $max) {
		// Modify $max by removing the length of moretext to allow room
		$max -= strlen(strip_tags($moretext));
		
		// Snag only the appropriate part of the string.
		$string = strrev(strstr(strrev(substr($string, 0, $max)), ' '));
		
		// Add the moretext onto it:
		$string .= $moretext;
	}
	
	// Return the string, whether it was modified or not.
	return $string;
}


function apsm_echo_admin_menu() { ?>
		
	<?php if ($_POST['apsm-remove-sticky-posts']) { apsm_remove_stickies(); } ?>
	<?php if ($_POST['apsm-sticky-posts']) { apsm_add_stickies(); } ?>
	 
	<div id="apsm" class="wrap">
	
		<h2>Sticky Manager</h2>
		<hr />
		
		<form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
		
			<?php if ( 0 !== count($stickies = get_option("sticky_posts", FALSE)) ) { ?>
				<div id="already-sticky">
					<h3>Current Sticky Posts</h3>
					<table class="widefat post fixed" cellspacing="0">
						<thead><tr>						
							<th scope="col" id="cb" class="manage-column column-cb check-column"><input type="checkbox" /></th>
							<th scope="col" class="manage-column column-unstick">Unstick</th>
							<!-- <th scope="col" id="id" class="manage-column column-id">Id</th> -->
							<th scope="col" id="title" class="manage-column column-title">Post</th>
							<th scope="col" id="tags" class="manage-column column-excerpt">Excerpt</th>
						</tr></thead>
						
						<tfoot><tr>
							<th scope="col"  class="manage-column column-cb check-column"><input type="checkbox" /></th>
							<th scope="col"  class="manage-column">Unstick</th>
							<!-- <th scope="col"  class="manage-column column-id">Id</th> -->
							<th scope="col"  class="manage-column column-title">Post</th>
							<th scope="col"  class="manage-column column-excerpt">Excerpt</th>
						</tr></tfoot>

						
						<tbody>
							<?php foreach ($stickies as $k=>$post_id) { ?>
								<?php $sticky = get_post($post_id, "ARRAY_A") ?>
								<tr <?php echo ($k % 2) ? "" : "class=\"alternate\""; ?>>
									<th scope="row" class="check-column"><input type="checkbox" name="apsm-remove-sticky-posts[]" id="apsm-remove-sticky-posts[<?php echo $post_id ?>]" value="<?php echo $post_id ?>"></th>
									<td>Unstick</td>
									<!-- <td class="id column-id"><?php echo $post_id ?></td> -->
									<td class="post-title column-title"><strong><?php echo $sticky['post_title']?></strong></td>
									<td><?php echo apsm_truncate_text_nicely(strip_tags($sticky['post_content']), 200)?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			<?php } ?>
		
			<h3>Stick Posts</h3>
		
			<div id="apsm-add-sticky-posts">
				<div id="apsm-search-posts">
					<div id="apsm-search-wrap">
						<input type="text" id="apsm-search" name="apsm-search" value="" size="16" />
					</div>
					<div id="apsm-results" class="ui-tabs-panel"></div>
				</div>
				
				<div id="apsm-sticky-posts">
					<div id="apsm-sticky-posts-list-label">Marked for stickification:</div>
					<div id="apsm-sticky-posts-list-wrap">
						<ul id="apsm-sticky-posts-list">
							<li id="apsm-sticky-posts-replacement"><em>Use the search box to the left to find posts and mark for stickification.</em></li>
						</ul>
					</div>
				</div>
			</div>
			
			<input type="submit" value="Save Changes" name="apsm-submit" id="apsm-submit" class="button-primary" />
			
		</form>

	</div>

	
<?php } ?>

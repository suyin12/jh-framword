<?php
/*
With slight modification (scope functionality has been removed), 
the content of this file is originally from the program "Microkid's
Related Posts" (version 2.5) 
<http://www.microkid.net/wordpress/related-posts/>, and is reprduced 
by permission. This code is controlled by the licensing of that
program. At the time of reproduction, Related Posts included the 
following licensing information:

This software is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

	// This file is called using AJAX
	// when searching for related posts
	
if( isset( $_GET['apsm_s'] ) ) {
	
	require('../../../wp-config.php');
	
		// Let's keep this a tool for logged in users
	if( ! current_user_can("edit_posts") ) {
		die('Please log in');
	}

	global $wpdb;
	
	$s = $wpdb->escape( $_GET['apsm_s'] );
	
	
//	$regexp = "[[:<:]]" . $s;
	
//	$where = "( post_title REGEXP '$regexp' OR post_content REGEXP '$regexp' )";
	$where = "( post_title like '%$s%' OR post_content like '%$s%' )";
	echo $query = "SELECT ID, post_title, post_type, post_status FROM $wpdb->posts WHERE $where AND `post_type` in ('post','page','wiki') ";
	if( $_GET['apsm_id'] ) {
		$this_id = (int) $_GET['apsm_id'];
		$query .= " AND ID != $this_id ";
	}
	$query .= "ORDER BY post_date DESC LIMIT 50";
	$results = $wpdb->get_results( $query );
	
	if( $results ) {
	
		echo "<ul>";
		$n = 1;
		foreach( $results as $result ) {
			
			echo '<li';
			echo ( $n % 2 ) ? ' class="alt"' : '';
			echo '> <a href="javascript:void(0)" id="result-'.$result->ID.'" class="apsm-result">';
			if( $result->post_type == 'page') {
				echo "<strong>[Page]</strong> - ";
			}
			echo $result->post_title;
			if( $result->post_status != 'publish') {
				echo ' ('.$result->post_status.')';
			}
			echo '</a></li>';
			$n++;
		}
		echo "</ul>";

	}
}

?>

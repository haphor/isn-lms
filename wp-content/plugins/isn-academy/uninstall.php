<?php

/**
 * Trigger this file on Plugin uninstall
 *
 * @package  ISN Learning
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

// Clear Database stored data
$courses = get_posts( array( 'post_type' => 'course', 'numberposts' => -1 ) );

foreach( $courses as $course ) {
	wp_delete_post( $course->ID, true );
}

// Access the database via SQL
global $wpdb;
$wpdb->query( "DELETE FROM wp_posts WHERE post_type = 'course'" );
$wpdb->query( "DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)" );
$wpdb->query( "DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)" );
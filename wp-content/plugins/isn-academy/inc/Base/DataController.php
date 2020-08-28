<?php
/**
 * @package  ISN Learning
 */
namespace Inc\Base;


use \Inc\Base\BaseController;


/**
 *
 */

class DataController extends BaseController
{


    public function register() {
        add_action( 'init', [ $this, 'isnPluginCourseTable' ] );
        add_action( 'init', [ $this, 'isnPluginUserTable' ] );
    }

    public function isnPluginUserTable() : void
    {

        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $user_table_name = $wpdb->prefix.'isn_academy_user';

        $sql = 'CREATE TABLE '.$user_table_name." (
			id mediumint NOT NULL AUTO_INCREMENT,
			user_id mediumint(9),
			parent_id mediumint(9),
			course_id mediumint(9),
			PRIMARY KEY id (id)
		) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }

    public function isnPluginCourseTable() : void
    {

        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $course_table_name = $wpdb->prefix.'isn_academy_course';

        $query = 'CREATE TABLE '.$course_table_name." (
			id mediumint NOT NULL AUTO_INCREMENT,
			post_id mediumint(9),
			title longtext,
			parent_id mediumint(9),
			user_id JSON,
			UNIQUE KEY id (id)			
		) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $query );
    }
}

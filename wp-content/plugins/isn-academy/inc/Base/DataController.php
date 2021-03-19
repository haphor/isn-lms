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
			completed tinyint(2) NOT NULL default '0',
			updated_ts timestamp NOT NULL default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
			PRIMARY KEY id (id)
		) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }

}

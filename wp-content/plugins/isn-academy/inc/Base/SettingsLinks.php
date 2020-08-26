<?php
/**
 * @package  ISN Learning
 */
namespace Inc\Base;

use \Inc\Base\BaseController;

class SettingsLinks extends BaseController
{ 

	public function register() 
	{
		add_filter( "plugin_action_links_$this->plugin", array( $this, 'settings_link' ) );
        add_action('after_setup_theme', [ $this, 'removeAdminBar' ] );
	}


	public function removeAdminBar() : void
    {
        if ( !current_user_can( 'administrator' ) && !is_admin() ) {
            show_admin_bar( false );
        }
    }

	public function settings_link( $links ) 
	{
		$settings_link = '<a href="admin.php?page=isn_learning">Settings</a>';
		array_push( $links, $settings_link );
		return $links;
	}
}
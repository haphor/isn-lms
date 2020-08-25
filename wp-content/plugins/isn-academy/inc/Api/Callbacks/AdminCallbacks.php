<?php 
/**
 * @package  ISN Learning
 */
namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
	public function adminDashboard()
	{
		return require_once( "$this->plugin_path/templates/admin.php" );
	}

	// public function adminCpt()
	// {
	// 	return require_once( "$this->website_url/edit.php?post_type=course" );
	// }

	public function adminWidgets()
	{
		return require_once( "$this->plugin_path/templates/widget.php" );
	}

	public function adminOptions()
	{
		return require_once( "$this->plugin_path/templates/option.php" );
	}
}
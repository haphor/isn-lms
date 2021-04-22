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
		return require( "$this->plugin_path/templates/admin.php" );
	}

	public function adminWidgets()
	{
		return require( "$this->plugin_path/templates/widget.php" );
	}

	public function adminOptions()
	{
		return require( "$this->plugin_path/templates/option.php" );
	}
}
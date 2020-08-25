<?php 
/**
 * @package  ISN Learning
 */
namespace Inc\Pages;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

/**
* 
*/
class Admin extends BaseController
{
	public $settings;

	public $callbacks;	

	public $pages = array();

	public $subpages = array();	

	public function register() 
	{
		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->setPages();

		$this->setSubpages();

		$this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();
	}

	public function setPages()
	{
		$this->settings = new SettingsApi();

		$this->pages = array(
			array(
				'page_title' => 'ISN Learning Plugin', 
				'menu_title' => 'ISN Learning', 
				'capability' => 'manage_options', 
				'menu_slug' => 'isn_learning', 
				'callback' =>  array( $this->callbacks, 'adminDashboard' ), 
				'icon_url' => 'dashicons-welcome-learn-more', 
				'position' => 10
			)
		);
	}

	public function setSubpages()
	{
		$this->subpages = array(
			array(
				'parent_slug' => 'isn_learning', 
				'page_title' => 'All Courses', 
				'menu_title' => 'Courses', 
				'capability' => 'manage_options', 
				'menu_slug' => 'edit.php?post_type=course', 
				'callback' => null
			)
		);
	}

}


<?php 
/**
 * @package  ISN Learning
 */
namespace Inc\Base;

class BaseController
{
	public $plugin_path;

	public $plugin_url;

	public $website_url;

	public $plugin;

	public function __construct() {
		$this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) );
		$this->plugin_url = plugin_dir_url( dirname( __FILE__, 2 ) );
		$this->website_url = home_url( );
		$this->website_path = plugin_basename( dirname( __FILE__, 6 ) );
		$this->plugin = plugin_basename( dirname( __FILE__, 3 ) ) . '/isn-learning.php';
	}
}
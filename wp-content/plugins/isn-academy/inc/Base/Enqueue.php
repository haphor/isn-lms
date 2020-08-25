<?php 
/**
 * @package  ISN Learning
 */
namespace Inc\Base;

use \Inc\Base\BaseController;

/**
* 
*/
class Enqueue extends BaseController
{
	public function register() {

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );

		add_action('wp_enqueue_scripts', array( $this, 'frontendEnqueue') );
	}
	
	function enqueue() {
		// enqueue all our scripts
		wp_enqueue_style( 'isnstyle', $this->plugin_url . 'assets/isnstyle.css' );
		wp_enqueue_script( 'isnscript', $this->plugin_url . 'assets/isnscript.js' );
	}

	function frontendEnqueue() {
		if ( is_singular( 'course' ) ){
			wp_enqueue_style( 'isnstyle', $this->plugin_url . 'assets/isnfrontendstyle.css' );
			wp_enqueue_script( 'isnscript', $this->plugin_url . 'assets/isnfrontendscript.js', '', false, TRUE);

		}elseif( is_post_type_archive('course')) {
			wp_enqueue_style( 'isnstyle', $this->plugin_url . 'assets/isnfrontendstyle.css' );
		}

		if ( is_page( 'Login') ) {

			
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'jquery-ui' );
			wp_register_script('ajax-login-script', $this->plugin_url.'/assets/ajax-login-script.js', array('jquery') ); 
			wp_enqueue_script('ajax-login-script');
			wp_localize_script( 'ajax-login-script', 'ajax_login_object', array( 
				'ajaxurl' => home_url().('wp-admin/admin-ajax.php'),
				'redirecturl' => home_url().'/course',
				'loadingmessage' => __('Sending user info, please wait...')
			));			
			wp_enqueue_style( 'isnstyle', $this->plugin_url . 'assets/isnfrontendstyle.css' );

		}elseif( is_page( 'Register') ) {

				// Scripts
				wp_enqueue_script( 'jquery' );
				wp_enqueue_script( 'jquery-ui' );
				// wp_enqueue_script( 'password-strength-meter' );
				wp_enqueue_script( 'login-register', $this->plugin_url.'/assets/isn-ajax-register.js', array( 'jquery' ), false, TRUE );

				// Styles
				// wp_enqueue_style( 'dashicons' );
		}

	}
		

}
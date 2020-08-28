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

		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue' ] );

		add_action('wp_enqueue_scripts', [ $this, 'frontEndEnqueue' ] );
	}
	
	public function enqueue() {
		// enqueue all our scripts
		wp_enqueue_style( 'isnstyle', $this->plugin_url . 'assets/isnstyle.css' );
		wp_enqueue_script( 'isnscript', $this->plugin_url . 'assets/isnscript.js' );
	}

	public function frontEndEnqueue() {
		if ( is_singular( 'course' ) && is_user_logged_in() ) {
			$this->courseScripts();
		}
		if( is_post_type_archive('course')) {
			$this->singleCourseStyle();
		}
		if ( is_page( 'Login') ) {
			$this->loginStyleAndScripts();
		}
		if( is_page( 'Register') ) {
		    $this->registerStyleAndScripts();
		}

	}

	private function courseScripts() : void
    {
        wp_enqueue_style( 'isnstyle', $this->plugin_url . 'assets/isnfrontendstyle.css' );
        wp_enqueue_script( 'isnscript', $this->plugin_url . 'assets/isnfrontendscript.js', '', false, true );

        wp_enqueue_style( 'isnstyle', $this->plugin_url . 'assets/isnfrontendstyle.css' );
        wp_enqueue_script( 'isnscript', $this->plugin_url . 'assets/isnfrontendscript.js', '', false, true );
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'jquery-ui' );
        wp_register_script('isn-ajax-count', $this->plugin_url.'/assets/isn-ajax-count.js', array(), '1.0.0', true );

        wp_enqueue_script('isn-ajax-count');
        $post_id = get_the_ID();
        $post = get_post($post_id);
        if ($post->post_parent !== 0)	{
            $ancestors=get_post_ancestors($post->ID);
            $root=count($ancestors)-1;
            $parent_id = $ancestors[$root];
        } else {
            $parent_id = $post->ID;
        }

        $sibling_list = get_children(
            array(
                'order' =>'asc',
                'post_parent' =>$parent_id,
                'post_type'=> 'course'
            ));

        if (!empty($sibling_list) && $parent_id !== 0){
            $postschild = array();

            foreach ($sibling_list as $sibling ) {
                $postschild[] = $sibling->ID;

            }
            $current = array_search($post_id, $postschild);
            $prevID = isset($postschild[$current-1]) ? $postschild[$current-1] : false;
            $nextID = isset($postschild[$current+1]) ? $postschild[$current+1] : false;
            $prev_link = get_permalink($prevID);
            $next_link = get_permalink($nextID);

        }

        $countData = array(
            'ajaxurl' => get_option('siteurl').('/wp-admin/admin-ajax.php'),
            'action' => 'custom_update_post',
            'nonce'   => wp_create_nonce( 'ajax_post_validation' ),
            'redirecturl' => get_permalink($nextID)
        );
        wp_localize_script( 'isn-ajax-count', 'isn_ajax_count_object', $countData);

    }

    private function singleCourseStyle() : void
    {
        wp_enqueue_style( 'isnstyle', $this->plugin_url . 'assets/isnfrontendstyle.css' );
    }
		
    public function loginStyleAndScripts() : void
    {
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
    }

    public function registerStyleAndScripts() : void
    {
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'jquery-ui' );
        wp_enqueue_script( 'login-register', $this->plugin_url.'/assets/isn-ajax-register.js', array( 'jquery' ), false, true );
    }
}
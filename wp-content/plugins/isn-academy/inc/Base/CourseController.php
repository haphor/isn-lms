<?php 
/**
 * @package  ISN Learning
 */
namespace Inc\Base;


use \Inc\Base\BaseController;


/**
* 
*/

class CourseController extends BaseController
{
    
    public function register()
    {
        $this->registerCallbacks();
    }

    private function registerCallbacks() : void
    {
        add_filter( 'wp', [ $this, 'guest_redirect' ], 0 );
        add_action( 'init', [ $this, 'activate_post_type' ] );
        add_action( 'login_init', [ $this, 'actionLoginInit' ], -2 );
        add_action( 'login_form_login', [ $this, 'actionBeforeLoginPage' ] );
        add_action( 'before_login_page', [ $this, 'actionBeforeLoginPage' ] );
        add_filter( 'login_url', [ $this, 'filterLoginUrl' ], 10, 3 );
        add_filter( 'login_redirect', [ $this, 'filterLoginRedirect' ], 10, 3 );
        add_action( 'authenticate', [ $this, 'loginFormProcessing' ], 101, 3 );
        add_shortcode( 'isn-custom-login-form', [ $this, 'renderLoginForm' ] );
        add_action( 'wp_logout', [ $this, 'redirectAfterLogin' ] );
    }

    public function redirectAfterLogin () : void
    {
        $redirect_url = home_url( 'login?logged_out=true' );
        wp_safe_redirect( $redirect_url );
        exit;
    }
    /**
     * Make sure login page info is loaded on wp-login endpoint as well.
     */
    public function actionLoginInit() : void
    {
        global $post;

        if( strpos( $_SERVER['REQUEST_URI'] ?? '', '/wp-login.php' ) !== false
            && $post = get_page_by_path( 'login' )
        ) {
            setup_postdata( $post );
            query_posts( [ 'p' => $post->ID, 'post_type' => 'any' ] );
            the_post();
        }
    }

    public function loginFormProcessing( $user, $username, $password )
    {
        if ( ( $_SERVER['REQUEST_METHOD'] === 'POST' ) && is_wp_error( $user ) ) {
            $error_codes = implode( ',', $user->get_error_codes() );

            $login_url = home_url( 'login' );
            $login_url = add_query_arg( 'login', $error_codes, $login_url );

            wp_redirect( $login_url );
            exit;
        }

        return $user;
    }

    public function renderLoginForm( $attributes, $content = null ) {
        $default_attributes = [ 'show_title' => false ];
        $attributes = shortcode_atts( $default_attributes, $attributes );
        $show_title = $attributes['show_title'];

        if ( is_user_logged_in() ) {
            return __( 'You are already signed in.', 'ISN' );
        }

        $attributes['redirect'] = '';
        if ( isset( $_REQUEST['redirect_to'] ) ) {
            $attributes['redirect'] = wp_validate_redirect( $_REQUEST['redirect_to'], $attributes['redirect'] );
        }

        $errors = array();
        if ( isset( $_REQUEST['login'] ) ) {
            $error_codes = explode( ',', $_REQUEST['login'] );

            foreach ( $error_codes as $code ) {
                $errors []= $this->get_error_message( $code );
            }
        }
        $attributes['errors'] = $errors;
        $attributes['logged_out'] = isset( $_REQUEST['logged_out'] ) && $_REQUEST['logged_out'] === true;

        // Render the login form using an external template
        return $this->get_template_html( 'login_form', $attributes );
    }

    /** Renders the contents of the given template to a string and returns it.
    *
    * @param string $templateName The name of the template to render (without .php)
    * @param array  $attributes    The PHP variables for the template
    *
    * @return string               The contents of the template.
    */
    private function get_template_html( $templateName, $attributes = null ) : string
    {
        if ( ! $attributes ) {
            $attributes = array();
        }
        ob_start();

        require( $this->plugin_path. '/templates/' . $templateName . '.php');

        $html = ob_get_clean();

        return $html;
    }

    private function get_error_message( $error_code ) {
        switch ( $error_code ) {
            case 'empty_username':
                return __( 'You do have an email address, right?', 'personalize-login' );

            case 'empty_password':
                return __( 'You need to enter a password to login.', 'personalize-login' );

            case 'invalid_username':
                return __(
                    "We don't have any users with that email address. Maybe you used a different one when signing up?",
                    'personalize-login'
                );

            case 'incorrect_password':
                $err = __(
                    "The password you entered wasn't quite right. <a href='%s'>Did you forget your password</a>?",
                    'personalize-login'
                );
                return sprintf( $err, wp_lostpassword_url() );

            default:
                break;
        }

        return __( 'An unknown error occurred. Please try again later.', 'personalize-login' );
    }

	public function guest_redirect( $content )
    {
		if( !is_user_logged_in() &&
            ( is_post_type_archive( 'course' ) || is_singular( 'course' ) )
        ) {
		    $redirectTo = get_permalink();

            $signInUrl = wp_login_url( $redirectTo );

		    wp_redirect( $signInUrl );
			exit;
		}

		return $content;
	}

    public function filterLoginRedirect( string $redirectTo, $requestedRedirectTo, $user ) : string
    {
        if( is_wp_error( $user ) ) {
            return $redirectTo;
        }

        if( $redirectTo === get_site_url() ) {
            $isnRedirect = $this->getRedirectUrl();
            $redirectTo = ! empty( $isnRedirect )
                ? $isnRedirect
                : $redirectTo;
        }
        if( empty( $redirectTo ) ) {
            wp_redirect( home_url( 'dashboard' ) );
            exit;
        }
        return $redirectTo;
    }


    /**
     * Get redirect URL (if set)
     *
     * @param null $redirectTo
     *
     * @return void
     */
	private function getRedirectUrl( $redirectTo = null ) : void
    {
        $user = wp_get_current_user();

        if ( user_can( $user, 'manage_options' ) ) {
            if ( $redirectTo ) {
                wp_safe_redirect( $redirectTo );
            } else {
                wp_redirect( admin_url() );
            }
        } else {
            wp_redirect( home_url( 'dashboard' ) );
        }
        exit;
    }

	public function actionBeforeLoginPage() : void
    {
        $redirect_to = $_REQUEST['redirect_to'] ?? null;

        // if request is for login page but already logged in & redirect has been set => redirect
        if ( ( $_SERVER['REQUEST_METHOD'] === 'GET' ) && is_user_logged_in() ) {
            $this->getRedirectUrl( $redirect_to );
            exit;
        }

        // force redirect to custom login page (when it exists)
        if( ! isset( $_REQUEST['action'] )
            && $_SERVER['REQUEST_METHOD'] !== 'POST'
            && ! isset( $_REQUEST['key'] )
            && ! isset( $_REQUEST['checkemail'] )
            && isset( $_SERVER['SCRIPT_URL'] ) && $_SERVER['SCRIPT_URL'] === '/wp-login.php'
            && get_page_by_path( 'login' )
        ) {
            wp_redirect( site_url( 'login', 'login' ) . '?' );
        }
    }

	public function filterLoginUrl( string $loginUrl, $redirect, $forceReauth ) : string
    {
        if( get_page_by_path( 'login' ) ) {
            $loginUrl = site_url( 'login', 'login' );
            if( ! empty( $redirect ) ) {
                $loginUrl = add_query_arg( 'redirect_to', urlencode( $redirect ), $loginUrl );
            }

            if( $forceReauth ) {
                $loginUrl = add_query_arg( 'reauth', '1', $loginUrl );
            }
        }

        return $loginUrl;
    }

    public function activate_post_type() {

            $labels = array(
            'name'                  => _x( 'Courses', 'Post Type General Name', 'isn_academy' ),
            'singular_name'         => _x( 'Course', 'Post Type Singular Name', 'isn_academy' ),
            'menu_name'             => __( 'Courses', 'isn_academy' ),
            'name_admin_bar'        => __( 'Courses', 'isn_academy' ),
            'archives'              => __( 'Course Archives', 'isn_academy' ),
            'attributes'            => __( 'Course Attributes', 'isn_academy' ),
            'parent_item_colon'     => __( 'Parent Course:', 'isn_academy' ),
            'all_items'             => __( 'All Courses', 'isn_academy' ),
            'add_new_item'          => __( 'Add New Course', 'isn_academy' ),
            'add_new'               => __( 'Add New', 'isn_academy' ),
            'new_item'              => __( 'New Course', 'isn_academy' ),
            'edit_item'             => __( 'Edit Course', 'isn_academy' ),
            'update_item'           => __( 'Update Course', 'isn_academy' ),
            'view_item'             => __( 'View Course', 'isn_academy' ),
            'view_items'            => __( 'View Courses', 'isn_academy' ),
            'search_items'          => __( 'Search Course', 'isn_academy' ),
            'not_found'             => __( 'Not found', 'isn_academy' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'isn_academy' ),
            'featured_image'        => __( 'Featured Image', 'isn_academy' ),
            'set_featured_image'    => __( 'Set featured image', 'isn_academy' ),
            'remove_featured_image' => __( 'Remove featured image', 'isn_academy' ),
            'use_featured_image'    => __( 'Use as featured image', 'isn_academy' ),
            'insert_into_item'      => __( 'Insert into Course', 'isn_academy' ),
            'uploaded_to_this_item' => __( 'Uploaded to this Course', 'isn_academy' ),
            'items_list'            => __( 'Courses list', 'isn_academy' ),
            'items_list_navigation' => __( 'Courses list navigation', 'isn_academy' ),
            'filter_items_list'     => __( 'Filter Courses list', 'isn_academy' ),
        );

        $capabilities = array(
            'edit_post'             => 'edit_post',
            'read_post'             => 'read_post',
            'delete_post'           => 'delete_post',
            'edit_posts'            => 'edit_posts',
            'edit_others_posts'     => 'edit_others_posts',
            'publish_posts'         => 'publish_posts',
            'read_private_posts'    => 'read_private_posts',
        );
        $args = array(
            'label'                 => __( 'Course', 'isn_academy' ),
            'description'           => __( 'ISN Learning Courses', 'isn_academy' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail', 'post-formats', 'page-attributes', 'excerpt' ),
            'taxonomies'            => array( 'category', 'tags' ),
            'hierarchical'          => true,
            'public'                => true,			
            'show_in_rest'          => true,
            'show_ui'               => true,
            'show_in_menu'          => false,            
		    'rewrite'               => array( 'slug' => 'course' ),
            'menu_position'         => null,
            'menu_icon'             => 'dashicons-video-alt3',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => 'course',
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page'
            // 'capabilities'          => $capabilities,
        );        
        
        register_post_type( 'course', $args );
    }
    

}


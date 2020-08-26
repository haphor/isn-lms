<?php 
/**
 * @package  ISN Learning
 */
namespace Inc\Base;


use Inc\Base\BaseController;


/**
* 
*/
class LoginController extends BaseController
{

	public function register()	{
		// Actions
		add_action( 'after_theme_setup', array( $this, 'login_user' ) );
              
        add_shortcode( 'isn-form-login', array( $this, 'isn_shortcode_login' ) );
		// Filters
		add_filter( 'login_errors', array( $this, 'login_errors' ), 10, 3 );



	}

    
	public function isn_shortcode_login() {
        ob_start();
        
        $this->isn_login_form_function();
        
		return ob_get_clean();
	}
	
	public function isn_login_form( $loginemail, $loginpassword) {
			global $loginemail, $loginpassword; ?>
            <div class="um">
                <div class="um-form">
                    <form action="<?=  $_SERVER['REQUEST_URI']  ?>" method="post">
                        <div class="um-col-1">
                            <div class="um-field um-field-area">
                                <div class="um-field-icon"><i class="fa fa-user" aria-hidden="true"></i></div>
                                <input class="um-form-field valid um-iconed" placeholder="E-mail Address" type="email" name="loginemail" value="<?= ( isset( $_POST['loginemail'] ) ? $loginemail : null ) ?>">
                            </div>
                            <div class="um-field um-field-area">
                                <div class="um-field-icon"><i class="fa fa-lock" aria-hidden="true"></i></div>
                                <input class="um-form-field valid um-iconed" placeholder="Password" type="password" name="loginpassword" value="<?=  ( isset( $_POST['loginpassword'] ) ? $loginpassword : null ) ?>">
                            </div>
                        </div>
                        <div class="um-col-alt">
                            <div class="um-left um-half">
                                <input class="um-button" type="submit" name="submit" value="Login"/>
                            </div>
                            <div class="um-right um-half">
                                <a class="um-button um-alt">Create Account</a>
                            </div>
                        </div>
                    </form>
                </div>
			</div>
	<?php }

	// logs a member in after submitting a form
    public function isn_login_form_valid( $loginemail, $loginpassword) {
	
		global $isn_error_validation;

		$isn_error_validation = new \WP_Error;

		if ( empty( $loginemail ) || empty( $loginpassword ) ) {
			$isn_error_validation->add('field', ' Please Fill the filed of ISN Login form');
		}
        if( !empty( $loginemail) ) {
    
            // this returns the user ID and other info from the user name
            $user = get_user_by('email', $_POST['loginemail']);    

    
            if(!email_exists( $loginemail ) || !isset($_POST['loginemail'])) {
                // if the user name doesn't exist
                $isn_error_validation->add('empty_email', __('Invalid email'));
            }
    
            if(!isset($_POST['loginpassword']) || $_POST['loginpassword'] == '') {
                // if no password was entered
               $isn_error_validation->add('empty_password', __('Please enter a password'));
            }
    
            // check the user's login with their password
            if(!wp_check_password($_POST['loginpassword'], $user->user_pass, $user->ID)) {
                // if the password is incorrect for the specified user
                $isn_error_validation->add('empty_password', __('Incorrect password'));
            }
            // retrieve all error messages
            $errors = $isn_error_validation->get_error_messages();
    
            return $errors;
        }
	}

	public function isn_user_login_form_completion() {

        global $errors, $loginemail, $loginpassword;

        $user = get_user_by('email', $_POST['loginemail']);  
        
		if( empty($errors) ) {
		    
            wp_set_current_user($user->ID, $_POST['loginemail']);
            wp_signon( [ $_POST['loginemail'], $_POST['loginpassword'] ] , false );
            
			do_action('wp_login', $_POST['loginemail']);

			wp_redirect($this->website_url.'/course'); exit;
        }
       
	}

	
	public function isn_login_form_function() {

		global $loginemail, $loginpassword;
		if ( isset($_POST['submit'] ) ) {

			$this->isn_login_form_valid(
			    $_POST['loginemail'],
			    $_POST['loginpassword']
			);

			$loginemail   =   sanitize_user( $_POST['loginemail'] );
			$loginpassword   =   esc_attr( $_POST['loginpassword'] );

			$this->isn_user_login_form_completion();
		}
			$this->isn_login_form(
			$loginemail,
			$loginpassword
		);
	}
    	
	// Isn Validation Field Method
	public function isn_login_validation_error_method( $errors,  $loginemail, $loginpassword ) {
	
		if ( empty( $_POST['loginemail'] ) || ( ! empty( $_POST['loginemail'] ) && trim( $_POST['loginemail'] ) == '' ) ) {
			$errors->add( 'loginemail_error', __( '<strong>Error</strong>: Enter Your Email.' ) );
		}
	
		if ( empty( $_POST['loginpassword'] ) || ( ! empty( $_POST['loginpassword'] ) && trim( $_POST['loginpassword'] ) == '' ) ) {
			$errors->add( 'loginpassword_error', __( '<strong>Error</strong>: Enter Your Password.' ) );
		}
		return $errors;
	}

	    	
	public static function isn_plugin_activation() {

		if ( ! current_user_can( 'activate_plugins' ) ) return;			

		global $wpdb;			

		if ( null === $wpdb->get_row( "SELECT post_name FROM {$wpdb->prefix}posts WHERE post_name = 'login'", 'ARRAY_A' ) ) {

			$current_user = wp_get_current_user();

			// create page object

			$page1 = array(

                'post_title'  => __( 'Login' ),

                'post_status' => 'publish',

                'post_content' => '[isn-form-login]',

                'post_author' => $current_user->ID,

                'post_type'   => 'page',

                );
			// insert the page into the database
			wp_insert_post( $page1 );		 
				
			$page2 = array(

                'post_title'  => __( 'Register' ),

                'post_status' => 'publish',

                'post_content' => '[isn-form-register]',

                'post_author' => $current_user->ID,

                'post_type'   => 'page',

                );
			// insert the page into the database
			wp_insert_post( $page2 );	

		}

	}


	public static function isn_delete_all_pages() {
		$isnpages = get_pages( array( 'post_type' => 'page', 'post_title'  => __( 'Login' ), 'post_content' => '[isn-login-form]'), array( 'post_type' => 'page', 'post_title'  => __( 'Register' ), 'post_content' => '[isn-registration-form]') );
	
		foreach ( $isnpages as $isnpage ) {
			// Delete all products.
			wp_delete_post( $isnpage->ID, true); // Set to False if you want to send them to Trash.
		} 
	}
	
}
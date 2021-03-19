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
    private $errorMessage = '';

	public function register()	{
		add_action( 'after_theme_setup', array( $this, 'login_user' ) );
        add_shortcode( 'isn-form-login',[ $this, 'isn_shortcode_login' ] );
		add_filter( 'login_errors', array( $this, 'login_errors' ), 10, 3 );
	}

    
	public function isn_shortcode_login()
    {
        ob_start();
        $this->isn_login_form_function();
		return ob_get_clean();
	}
	
	public function isn_login_form( $loginemail, $loginpassword)
    {
	    global $loginemail, $loginpassword;  ?>

            <div class="um">
                <div class="um-form">
                    <?php if( $this->errorMessage &&  count( $this->errorMessage ) > 0 ) : ?>
                        <?php foreach ( $this->errorMessage as $error ) : ?>
                            <p class="login-error">
                                <?php echo $error; ?>
                            </p>
                        <?php endforeach; ?>
                    <?php endif; ?>

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

		$isn_error_validation = new \WP_Error;

		if ( empty( $loginemail ) || empty( $loginpassword ) ) {
			$isn_error_validation->add('field', ' Please Fill the filed of ISN Login form');
		}

        if( !isset( $_POST['loginemail'] ) || !email_exists( $loginemail ) ) {
            $isn_error_validation->add('empty_email', __('Invalid email'));
            $this->errorMessage =  $isn_error_validation->get_error_messages();
            return $this->errorMessage;
        }

        if( !empty( $loginemail) ) {
            $user = get_user_by('email', $_POST['loginemail']);

            if( $user ) {
                if(!isset($_POST['loginpassword']) || $_POST['loginpassword'] === '') {
                    $isn_error_validation->add('empty_password', __('Please enter a password'));
                    $this->errorMessage =  $isn_error_validation->get_error_messages();
                    return $this->errorMessage;
                }

                if( !wp_check_password( $_POST['loginpassword'], $user->user_pass, $user->ID ) ) {
                    $isn_error_validation->add('empty_password', __('Incorrect password'));
                }
            }

            $this->errorMessage =  $isn_error_validation->get_error_messages();

            return $this->errorMessage;
        }

	}

	public function isn_user_login_form_completion()
    {
        $user = get_user_by('email', $_POST['loginemail']);

		if( empty($this->errorMessage) ) {
            wp_set_current_user( $user->ID, $_POST['loginemail'] );

            if ( isset( $_REQUEST['redirect_to'] ) ) {
                wp_safe_redirect( $_REQUEST['redirect_to'] ); exit;
            }

            wp_safe_redirect($this->website_url.'/course');
            exit;
        }
	}

	
	public function isn_login_form_function()
    {
		global $loginemail, $loginpassword;
		if ( isset($_POST['submit'] ) ) {

			$this->isn_login_form_valid(
			    $_POST['loginemail'],
			    $_POST['loginpassword']
			);

			$loginemail   =   sanitize_user( $_POST['loginemail'] );
			$loginpassword   =   esc_attr( $_POST['loginpassword'] );

			$this->isn_user_login_form_completion();
			exit;
		}

		$this->isn_login_form(
			$loginemail,
			$loginpassword
		);
	}
    	
	// Isn Validation Field Method
	public function isn_login_validation_error_method( $errors,  $loginemail, $loginpassword ) {
	
		if ( empty( $_POST['loginemail'] ) || ( ! empty( $_POST['loginemail'] ) && trim( $_POST['loginemail'] ) === '' ) ) {
			$errors->add( 'loginemail_error', __( '<strong>Error</strong>: Enter Your Email.' ) );
		}
	
		if ( empty( $_POST['loginpassword'] ) || ( ! empty( $_POST['loginpassword'] ) && trim( $_POST['loginpassword'] ) === '' ) ) {
			$errors->add( 'loginpassword_error', __( '<strong>Error</strong>: Enter Your Password.' ) );
		}
		return $errors;
	}

	    	
	public static function isn_plugin_activation()
    {
        global $wpdb;
		if ( ! current_user_can( 'activate_plugins' ) ){
            return;
        }

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
		$isnpages = get_pages(
		        array( 'post_type' => 'page', 'post_title'  => __( 'Login' ), 'post_content' => '[isn-login-form]' ),
                array( 'post_type' => 'page', 'post_title'  => __( 'Register' ), 'post_content' => '[isn-registration-form]')
        );
	
		foreach ( $isnpages as $isnpage ) {
			//wp_delete_post( $isnpage->ID, true); // Set to False if you want to send them to Trash.
		}
        flush_rewrite_rules();
	}
	
}
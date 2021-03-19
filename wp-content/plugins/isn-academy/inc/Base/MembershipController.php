<?php 
/**
 * @package  ISN Learning
 */
namespace Inc\Base;

use Inc\Base\BaseController;

/**
* 
*/
class MembershipController extends BaseController
{

	// Page slugs
	private $login_slug 			= '/login';
	private $register_slug 			= '/register';
	private $profile_slug 			= '/course';
	private $terms_slug				= '/terms';
	private $privacy_slug			= '/privacy';


	function register() {
		// Actions
        // add_action('init',  array( $this, 'isn_add_new_member' ) );

		// Shortcode

        add_shortcode( 'isn-form-register', array( $this, 'register_url' ) );
	}


	/**
	 * Take over native WordPress registration action and forward it off to our custom page template
	 */
	function register_url() {
				
		ob_start();
		 $this->registration_form();
		return ob_get_clean();

	}

	/**
	 * Render registration form
	 *
	 */
	function registration_form() {

		// Initialize variables
		$first_name = isset( $_POST['first_name'] ) ? $_POST['first_name'] : '';
		$last_name = isset( $_POST['last_name'] ) ? $_POST['last_name'] : '';
		$email = isset( $_POST['email'] ) ? $_POST['email'] : '';
		$confirm_email = isset( $_POST['confirm_email'] ) ? $_POST['confirm_email'] : '';


		// Process POST
		$registration = $this->register_user();
		if ( ! empty( $registration->errors ) ) {
			echo '<table><tbody>';
			foreach ( $registration->errors as $field => $error ) {
				echo '<div class="form-error">' . $error[0] . '</div>';
			}
			echo '</tbody></table>';
		}else{
			echo '';
		} ?>
        <div class="um">
            <div class="um-form">
                <form name="registerform" id="registerform" method="post" autocomplete="off">
                    <div class="um-col-1">
                        <div class="um-field um-field-area">
                            <div class="um-field-icon"><i class="fa fa-user" aria-hidden="true"></i></div>
                            <input type="text" placeholder="First Name" name="first_name" id="first_name" class="um-form-field valid um-iconed" value="<?= $first_name ?>" size="25">
                        </div>

                        <div class="um-field um-field-area">
                            <div class="um-field-icon"><i class="fa fa-user" aria-hidden="true"></i></div>
                            <input type="text" placeholder="Last Name" name="last_name" id="last_name" class="um-form-field valid um-iconed" value="<?= $last_name ?>" size="25">
                        </div>

                        <div class="um-field um-field-area">
                            <div class="um-field-icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                            <input class="um-form-field valid um-iconed" placeholder="E-mail Address" type="email" name="email" id="email" value="<?= $email ?>">
                        </div>

                        <div class="um-field um-field-area">
                            <div class="um-field-icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                            <input class="um-form-field valid um-iconed" placeholder="Confirm E-mail Address" type="email" name="confirm_email" id="confirm_email" value="<?= $confirm_email ?>">
                        </div>

                        <div class="um-field um-field-area">
                            <div class="um-field-icon"><i class="fa fa-lock" aria-hidden="true"></i></div>
                            <input class="um-form-field valid um-iconed" placeholder="Password" type="password" name="password" id="password" value="">
                        </div>

                        <div class="um-field um-field-area">
                            <div class="um-field-icon"><i class="fa fa-lock" aria-hidden="true"></i></div>
                            <input class="um-form-field valid um-iconed" placeholder="Confirm Password" type="password" name="confirm-password" id="confirm-password" value="">
                        </div>
                        <p>
                            <label for="terms_of_service" style="font-size: 10px;">
                                <input type="checkbox" name="terms_of_service" id="terms_of_service">
                                I agree to <?= bloginfo('name') ?> <a href="<?= $this->website_url . $this->terms_slug ?>" target="_blank">Terms of Service</a> and <a href="'.$this->website_url.$this->privacy_slug.'" target="_blank">Privacy Policy</a>
                            </label>
                        </p>
                    </div>
                    <div class="um-col-alt">
                        <div class="um-left um-half">
                            <input class="um-button" type="submit" name="submit" value="Register"/>
                        </div>
                        <div class="um-right um-half">
                            <a class="um-button um-alt">Login</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
	<?php }


	/**
	 * Validate POST on registration form
	 *
	 * @return mixed	False or WP_Error if POST is invalid, HTTP_REFERER string if valid
	 */
	function valid_registration() {

		if ( ! empty( $_POST ) ) {

			// Initalize WP_Error object
			$registration = new \WP_Error;

			// First name errors
			if ( empty( $_POST['first_name'] ) ) {
				$registration->add( 'first_name', '<tr><td>ERROR:</td><td>Please tell us your first name.</td></tr>' );
			}

			// Last name errors
			if ( empty( $_POST['last_name'] ) ) {
				$registration->add( 'last_name', '<tr><td>ERROR:</td><td>Please tell us your last name.</td></tr>' );
			}

			// Email errors
			if ( ! empty( $_POST['email'] ) ) {
				if ( ! is_email( sanitize_email( $_POST['email'] ) ) ) {
					// Check if email is valid
					$registration->add( 'email', '<tr><td>ERROR:</td><td>Your E-mail address is invalid.</td></tr>' );
				} else {
					// Check if user exists with this email
					$user = get_user_by( 'email', sanitize_email( $_POST['email'] ) );
					if ( is_a( $user, 'WP_User' ) ) {
						$registration->add( 'email', '<tr><td>ERROR:</td><td>E-mail address already exists.</td></tr>' );
					}
				}
			}

			// Confirm e-mail errors
			if ( ! empty( $_POST['email'] ) && ! empty( $_POST['confirm_email'] ) && ( sanitize_email( $_POST['email'] ) != sanitize_email( $_POST['confirm_email'] ) ) ) {
				$registration->add( 'confirm_email', '<tr><td>ERROR:</td><td>E-mail addresses didn\'t match.</td></tr>' );
			}

			// Password errors
			if ( empty( $_POST['password'] ) ) {
				$registration->add( 'password', '<tr><td>ERROR:</td><td>Please choose a password.</td></tr>' );
			}
			
			if( ! empty( $_POST['password'] ) && ! empty( $_POST['confirm_password'] ) && ( sanitize_text_field( $_POST['password'] ) != sanitize_text_field( $_POST['confirm_password'] ) ) ) {
				// passwords do not match
				$registration->add('password_mismatch', '<tr><td>ERROR:</td><td>Please Does not match.</td></tr>');
			}


			// TOS and Privacy errors
			if ( ! isset( $_POST['terms_of_service'] ) || $_POST['terms_of_service'] != 'on' ) {
				$registration->add( 'terms_of_service', '<tr><td>ERROR:/td><td>You must agree to our <a href="' . $this->terms_slug . '" target="_blank">Terms of Service</a> and <a href="' . $this->privacy_slug . '" target="_blank">Privacy Policy</a> to register.</td></tr>' );
			}

			// Return true if no errors found
			if ( empty( $registration->errors ) ) {

				return true;

			} else {

				return $registration;

			}

		}

		return false;

	}
	


	/**
	 * Function to process $_POST on custom register form
	 */
	function register_user() {
		if ( $_POST ) {
			
		// Sanitize our inputs	
			$user_email		= sanitize_text_field( $_POST["email"] );
			$user_first		= sanitize_text_field( $_POST["first_name"] );
			$user_last	 	= sanitize_text_field( $_POST["last_name"] );
			$user_pass		= sanitize_text_field( $_POST["password"] );

			$get_username = explode( '@', $user_email );
			$user_name = sanitize_text_field( $get_username[0]);
			
			if ( username_exists( $user_name )){

				$split_name = explode( '_', $user_name );
				$serialized_user = $user_name.'_'.end($split_name)+01;
				$user_name = $serialized_user;
				return $user_name;

			}
	
			$registration = $this->valid_registration();

			if ( is_wp_error( $registration ) || ! $registration ) {
				// Return validation errors
				return $registration;
				
			} else {

				$userdata = array(
						'user_login'        => $user_name,
						'user_email'		=> $user_email,
						'first_name'		=> $user_first,
						'last_name'			=> $user_last,
						'user_pass'	 		=> $user_pass,
						'user_registered'	=> date('Y-m-d H:i:s'),
						'role'				=> 'subscriber'
			
					);
				$new_user = wp_insert_user( $userdata );
				if(  is_wp_error( $new_user ) ) {
					// Return errors produced during new user creation
					return $new_user;

				} else {
					// send an email to the admin alerting them of the registration
					wp_new_user_notification($new_user);
	
					// log the new user in
					wp_set_current_user($new_user);	
           			wp_signon( array( $user_email , $user_pass ), false );	
					do_action('wp_login', $user_email);
	
					// send the newly created user to the home page after logging them in

					wp_redirect($this->website_url.$this->login_slug); 
					
					exit;
				
				}
			}
		}
		return false;		
	}




}

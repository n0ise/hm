<?php
/**
 * Plugin Name:       Hellomed Custom Login
 * Description:       A plugin to create custom login / register / forget password / set new password.
 * Version:           1.0.0
 * Author:            Klodian Pepkolaj
 * Text Domain:       hellomed-custom-login
 */

class Hellomed_Custom_Login_Plugin {

	/**
	 * Initializes the plugin.
	 *
	 * To keep the initialization fast, only add filter and action
	 * hooks in the constructor.
	 */
	public function __construct() {

		// Redirects
		add_action( 'login_form_login', array( $this, 'redirect_to_custom_login' ) );
		add_filter( 'authenticate', array( $this, 'maybe_redirect_at_authenticate' ), 101, 3 );
		add_filter( 'login_redirect', array( $this, 'redirect_after_login' ), 10, 3 );
		add_action( 'wp_logout', array( $this, 'redirect_after_logout' ) );

		add_action( 'login_form_register', array( $this, 'redirect_to_custom_register' ) );
		add_action( 'login_form_lostpassword', array( $this, 'redirect_to_custom_lostpassword' ) );
		add_action( 'login_form_rp', array( $this, 'redirect_to_custom_password_reset' ) );
		add_action( 'login_form_resetpass', array( $this, 'redirect_to_custom_password_reset' ) );

		//add_action( 'login_form_onboarding', array( $this, 'redirect_to_custom_onboarding' ) );

		// Handlers for form posting actions
		add_action( 'login_form_register', array( $this, 'do_register_user' ) );
		add_action( 'login_form_lostpassword', array( $this, 'do_password_lost' ) );
		add_action( 'login_form_rp', array( $this, 'do_password_reset' ) );
		add_action( 'login_form_resetpass', array( $this, 'do_password_reset' ) );

		add_action( 'admin_post', array( $this, 'do_onboarding' ) );
		add_action( 'admin_post', array( $this, 'do_funnel' ) );

		// Other customizations
		add_filter( 'retrieve_password_message', array( $this, 'replace_retrieve_password_message' ), 10, 4 );
		add_filter( 'retrieve_password_title', array ( $this, 'replace_retrieve_password_title' ), 10, 4 );

		add_filter( 'wp_new_user_notification_email', array ( $this,  'custom_wp_new_user_notification_email'), 10, 4 );


		// Setup
		add_action( 'wp_print_footer_scripts', array( $this, 'add_captcha_js_to_footer' ) );
		add_filter( 'admin_init' , array( $this, 'register_settings_fields' ) );

		// Shortcodes
		add_shortcode( 'custom-login-form', array( $this, 'render_login_form' ) );
		add_shortcode( 'custom-register-form', array( $this, 'render_register_form' ) );
		add_shortcode( 'custom-password-lost-form', array( $this, 'render_password_lost_form' ) );
		add_shortcode( 'custom-password-reset-form', array( $this, 'render_password_reset_form' ) );
		add_shortcode( 'custom-onboarding-form', array( $this, 'render_onboarding_form' ) );
		// add_shortcode( 'custom-funnel-form', array( $this, 'render_funnel_form' ) );
	}

	/**
	 * Plugin activation hook.
	 *
	 * Creates all WordPress pages needed by the plugin.
	 */
	public static function plugin_activated() {
		// Information needed for creating the plugin's pages
		$page_definitions = array(
			'login' => array(
				'title' => __( 'Anmelden', 'hellomed-custom-login' ),
				'content' => '[custom-login-form]'
			),
			'registrieren' => array(
				'title' => __( 'Registrieren', 'hellomed-custom-login' ),
				'content' => '[custom-register-form]'
			),
			'onboarding' => array(
				'title' => __( 'Onboarding', 'hellomed-custom-login' ),
				'content' => '[custom-onboarding-form]'
			),
			'passwort-vergessen' => array(
				'title' => __( 'Passwort vergessen?', 'hellomed-custom-login' ),
				'content' => '[custom-password-lost-form]'
			),
			'neues-passwort-eingabe' => array(
				'title' => __( 'Wählen Sie ein neues Passwort', 'hellomed-custom-login' ),
				'content' => '[custom-password-reset-form]'
			)
		);

		foreach ( $page_definitions as $slug => $page ) {
			// Check that the page doesn't exist already
			$query = new WP_Query( 'pagename=' . $slug );
			if ( ! $query->have_posts() ) {
				// Add the page using the data from the array above
				wp_insert_post(
					array(
						'post_content'   => $page['content'],
						'post_name'      => $slug,
						'post_title'     => $page['title'],
						'post_status'    => 'publish',
						'post_type'      => 'page',
						'ping_status'    => 'closed',
						'comment_status' => 'closed',
					)
				);
			}
		}
	}

	//
	// REDIRECT FUNCTIONS
	//

	/**
	 * Redirect the user to the custom login page instead of wp-login.php.
	 */
	public function redirect_to_custom_login() {
		if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {


			if ( is_user_logged_in() ) {
				$this->redirect_logged_in_user();
				exit;
			}
			// The rest are redirected to the login page
			$login_url = home_url( 'login' );
			if ( ! empty( $_REQUEST['redirect_to'] ) ) {
				$login_url = add_query_arg( 'redirect_to', $_REQUEST['redirect_to'], $login_url );
			}

			if ( ! empty( $_REQUEST['checkemail'] ) ) {
				$login_url = add_query_arg( 'checkemail', $_REQUEST['checkemail'], $login_url );
			}

			wp_redirect( $login_url );
			exit;
		}
	}

	/**
	 * Redirect the user after authentication if there were any errors.
	 *
	 * @param Wp_User|Wp_Error  $user       The signed in user, or the errors that have occurred during login.
	 * @param string            $username   The user name used to log in.
	 * @param string            $password   The password used to log in.
	 *
	 * @return Wp_User|Wp_Error The logged in user, or error information if there were errors.
	 */
	public function maybe_redirect_at_authenticate( $user, $username, $password ) {
		// Check if the earlier authenticate filter (most likely,
		// the default WordPress authentication) functions have found errors


		if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
			if ( is_wp_error( $user ) ) {
				$error_codes = join( ',', $user->get_error_codes() );

				$login_url = home_url( 'login' );
				$login_url = add_query_arg( 'login', $error_codes, $login_url );
				wp_redirect( $login_url );
				exit;
			}
		}

		return $user;
	}

	/**
	 * Returns the URL to which the user should be redirected after the (successful) login.
	 *
	 * @param string           $redirect_to           The redirect destination URL.
	 * @param string           $requested_redirect_to The requested redirect destination URL passed as a parameter.
	 * @param WP_User|WP_Error $user                  WP_User object if login was successful, WP_Error object otherwise.
	 *
	 * @return string Redirect URL
	 */
	public function redirect_after_login( $redirect_to, $requested_redirect_to, $user ) {
		$redirect_url = home_url();

		$user_id = $user->ID;
	
		if ( ! isset( $user->ID ) ) {
			return $redirect_url;
		}

		if ( user_can( $user, 'manage_options' ) ) {
			// Use the redirect_to parameter if one is set, otherwise redirect to admin dashboard.
			if ( $requested_redirect_to == '' ) {
				$redirect_url = admin_url();
			} else {
				$redirect_url = $redirect_to;
			}
		} 

			elseif(in_array( 'admin_panel', (array) $user->roles )){
				$redirect_url = home_url( '/admin-dashboard' );
				wp_redirect( $redirect_url );
				exit;
			}

		else {
			
			if ( get_field('has_completed_onboarding', 'user_' .$user_id) == 0){
				$redirect_url = home_url( '/onboarding' );
				
			 }
			else{
				
				if ( get_field('status', 'user_' .$user_id) == 'Aktiv'){
					$redirect_url = home_url( '/medikationsplan' ) ;
					
				 }
				 else{
					$redirect_url = home_url( '/willkommen' ) ;
				 }
			}
		
		}
	
		return wp_validate_redirect( $redirect_url, home_url() );
	}

	/**
	 * Redirect to custom login page after the user has been logged out.
	 */
	public function redirect_after_logout() {
		$redirect_url = home_url( 'login?logged_out=true' );
		wp_redirect( $redirect_url );
		exit;
	}

	/**
	 * Redirects the user to the custom registration page instead
	 * of wp-login.php?action=register.
	 */
	public function redirect_to_custom_register() {
		if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
			if ( is_user_logged_in() ) {
				$this->redirect_logged_in_user();
			} else {
				wp_redirect( home_url( 'registrieren' ) );
			}
			exit;
		}
	}


	public function redirect_to_onboarding() {
		// if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
		// 	if ( is_user_logged_in() ) {
		// 		$this->redirect_logged_in_user();
		// 	} else {
		// 		wp_redirect( home_url( 'onboarding' ) );
		// 	}
		// 	exit;
		// }
	}

	/**
	 * Redirects the user to the custom "Forgot your password?" page instead of
	 * wp-login.php?action=lostpassword.
	 */
	public function redirect_to_custom_lostpassword() {
		if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
			if ( is_user_logged_in() ) {
				$this->redirect_logged_in_user();
				exit;
			}

			wp_redirect( home_url( 'passwort-vergessen' ) );
			exit;
		}
	}

	/**
	 * Redirects to the custom password reset page, or the login page
	 * if there are errors.
	 */
	public function redirect_to_custom_password_reset() {
		if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
			// Verify key / login combo
			$user = check_password_reset_key( $_REQUEST['key'], $_REQUEST['login'] );
			if ( ! $user || is_wp_error( $user ) ) {
				if ( $user && $user->get_error_code() === 'expired_key' ) {
					wp_redirect( home_url( 'login?login=expiredkey' ) );
				} else {
					wp_redirect( home_url( 'login?login=invalidkey' ) );
				}
				exit;
			}

			$redirect_url = home_url( 'neues-passwort-eingabe' );
			$redirect_url = add_query_arg( 'login', esc_attr( $_REQUEST['login'] ), $redirect_url );
			$redirect_url = add_query_arg( 'key', esc_attr( $_REQUEST['key'] ), $redirect_url );

			wp_redirect( $redirect_url );
			exit;
		}
	}


	//
	// FORM RENDERING SHORTCODES
	//

	/**
	 * A shortcode for rendering the login form.
	 *
	 * @param  array   $attributes  Shortcode attributes.
     * @param  string  $content     The text content for shortcode. Not used.
	 *
	 * @return string  The shortcode output
	 */
	public function render_login_form( $attributes, $content = null ) {
		// Parse shortcode attributes
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );
	
		if ( is_user_logged_in() ) {
			$this->redirect_logged_in_user();
			exit;
			//return __( 'Sie sind bereits angemeldet.', 'hellomed-custom-login' );
		}

		// Pass the redirect parameter to the WordPress login functionality: by default,
		// don't specify a redirect, but if a valid redirect URL has been passed as
		// request parameter, use it.
		$attributes['redirect'] = '';
		if ( isset( $_REQUEST['redirect_to'] ) ) {
			$attributes['redirect'] = wp_validate_redirect( $_REQUEST['redirect_to'], $attributes['redirect'] );
		}

		// Error messages
		$errors = array();
		if ( isset( $_REQUEST['login'] ) ) {
			$error_codes = explode( ',', $_REQUEST['login'] );

			foreach ( $error_codes as $code ) {
				$errors []= $this->get_error_message( $code );
			}
		}
		$attributes['errors'] = $errors;

		// Check if user just logged out
		$attributes['logged_out'] = isset( $_REQUEST['logged_out'] ) && $_REQUEST['logged_out'] == true;

		// Check if the user just registered
		$attributes['registered'] = isset( $_REQUEST['registered'] );

		// Check if the user just requested a new password
		$attributes['lost_password_sent'] = isset( $_REQUEST['checkemail'] ) && $_REQUEST['checkemail'] == 'confirm';

		// Check if user just updated password
		$attributes['password_updated'] = isset( $_REQUEST['password'] ) && $_REQUEST['password'] == 'changed';
		
		// Render the login form using an external template
		return $this->get_template_html( 'login_form', $attributes );
		
	}

	/**
	 * A shortcode for rendering the new user registration form.
	 *
	 * @param  array   $attributes  Shortcode attributes.
	 * @param  string  $content     The text content for shortcode. Not used.
	 *
	 * @return string  The shortcode output
	 */
	public function render_register_form( $attributes, $content = null ) {
		// Parse shortcode attributes
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );

		if ( is_user_logged_in() ) {
			$this->redirect_logged_in_user();
			exit;

			//return __( 'Sie sind bereits angemeldet.', 'hellomed-custom-login' );
		} elseif ( ! get_option( 'users_can_register' ) ) {
			return __( 'Die Registrierung neuer Nutzer ist derzeit nicht erlaubt.', 'hellomed-custom-login' );
		} else {
			// Retrieve possible errors from request parameters
			$attributes['errors'] = array();
			if ( isset( $_REQUEST['register-errors'] ) ) {
				$error_codes = explode( ',', $_REQUEST['register-errors'] );

				foreach ( $error_codes as $error_code ) {
					$attributes['errors'] []= $this->get_error_message( $error_code );
				}
			}

			// Retrieve recaptcha key
			$attributes['recaptcha_site_key'] = get_option( 'hellomed-custom-login-recaptcha-site-key', null );

			return $this->get_template_html( 'register_form', $attributes );
		}
	}



	/**
	 * A shortcode for rendering the onboarding form.
	 *
	 * @param  array   $attributes  Shortcode attributes.
	 * @param  string  $content     The text content for shortcode. Not used.
	 *
	 * @return string  The shortcode output
	 */
	public function render_onboarding_form( $attributes, $content = null ) {
		// Parse shortcode attributes
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );

		$user = wp_get_current_user();
		$user_id = $user->ID;

		if ( !is_user_logged_in() ) {
			$this->redirect_to_custom_login();
			exit;
			//return __( 'Please log in', 'hellomed-custom-login' );
		} else {

			if ( get_field('has_completed_onboarding', 'user_' .$user_id) == 1){
				$this->redirect_logged_in_user();
				exit;
			 }

			// Retrieve possible errors from request parameters
			else{
			$attributes['errors'] = array();
			if ( isset( $_REQUEST['register-errors'] ) ) {
				$error_codes = explode( ',', $_REQUEST['register-errors'] );

				foreach ( $error_codes as $error_code ) {
					$attributes['errors'] []= $this->get_error_message( $error_code );
				}
			}

			return $this->get_template_html( 'onboarding_form', $attributes );
			}


		}
	}


		/**
	 * A shortcode for rendering the funnel form.
	 *
	 * @param  array   $attributes  Shortcode attributes.
	 * @param  string  $content     The text content for shortcode. Not used.
	 *
	 * @return string  The shortcode output
	 */
	public function render_funnel_form( $attributes, $content = null ) {
		// Parse shortcode attributes
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );

		$user = wp_get_current_user();
		$user_id = $user->ID;

		if ( !is_user_logged_in() ) {
			$this->redirect_to_custom_login();
			exit;
			//return __( 'Please log in', 'hellomed-custom-login' );
		} else {

			// if ( get_field('has_completed_onboarding', 'user_' .$user_id) == 1){
			// 	$this->redirect_logged_in_user();
			// 	exit;
			//  }

			// Retrieve possible errors from request parameters
			
			$attributes['errors'] = array();
			if ( isset( $_REQUEST['register-errors'] ) ) {
				$error_codes = explode( ',', $_REQUEST['register-errors'] );

				foreach ( $error_codes as $error_code ) {
					$attributes['errors'] []= $this->get_error_message( $error_code );
				}
			}

			return $this->get_template_html( 'funnel_form', $attributes );
			


		}
	}



	/**
	 * A shortcode for rendering the form used to initiate the password reset.
	 *
	 * @param  array   $attributes  Shortcode attributes.
	 * @param  string  $content     The text content for shortcode. Not used.
	 *
	 * @return string  The shortcode output
	 */
	public function render_password_lost_form( $attributes, $content = null ) {
		// Parse shortcode attributes
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );

		if ( is_user_logged_in() ) {

			$this->redirect_logged_in_user();
			exit;
			//return __( 'Sie sind bereits angemeldet.', 'hellomed-custom-login' );
		} else {
			// Retrieve possible errors from request parameters
			$attributes['errors'] = array();
			if ( isset( $_REQUEST['errors'] ) ) {
				$error_codes = explode( ',', $_REQUEST['errors'] );

				foreach ( $error_codes as $error_code ) {
					$attributes['errors'] []= $this->get_error_message( $error_code );
				}
			}

			return $this->get_template_html( 'password_lost_form', $attributes );
		}
	}

	/**
	 * A shortcode for rendering the form used to reset a user's password.
	 *
	 * @param  array   $attributes  Shortcode attributes.
	 * @param  string  $content     The text content for shortcode. Not used.
	 *
	 * @return string  The shortcode output
	 */
	public function render_password_reset_form( $attributes, $content = null ) {
		// Parse shortcode attributes
		$default_attributes = array( 'show_title' => false );
		$attributes = shortcode_atts( $default_attributes, $attributes );

		if ( is_user_logged_in() ) {

			$this->redirect_logged_in_user();
			exit;
			//return __( 'Sie sind bereits angemeldet.', 'hellomed-custom-login' );
		} else {
			if ( isset( $_REQUEST['login'] ) && isset( $_REQUEST['key'] ) ) {
				$attributes['login'] = $_REQUEST['login'];
				$attributes['key'] = $_REQUEST['key'];

				// Error messages
				$errors = array();
				if ( isset( $_REQUEST['error'] ) ) {
					$error_codes = explode( ',', $_REQUEST['error'] );

					foreach ( $error_codes as $code ) {
						$errors []= $this->get_error_message( $code );
					}
				}
				$attributes['errors'] = $errors;

				return $this->get_template_html( 'password_reset_form', $attributes );
			} else {
				return __( 'Falscher Passwort-Vergessen Link.', 'hellomed-custom-login' );
			}
		}
	}

	/**
	 * An action function used to include the reCAPTCHA JavaScript file
	 * at the end of the page.
	 */
	public function add_captcha_js_to_footer() {
		echo "<script src='https://www.google.com/recaptcha/api.js?hl=en'></script>";
	}

	/**
	 * Renders the contents of the given template to a string and returns it.
	 *
	 * @param string $template_name The name of the template to render (without .php)
	 * @param array  $attributes    The PHP variables for the template
	 *
	 * @return string               The contents of the template.
	 */
	private function get_template_html( $template_name, $attributes = null ) {
		if ( ! $attributes ) {
			$attributes = array();
		}

		ob_start();

		do_action( 'hellomed_custom_login_before_' . $template_name );

		require( 'templates/' . $template_name . '.php');

		do_action( 'hellomed_custom_login_after_' . $template_name );

		$html = ob_get_contents();
		ob_end_clean();

		return $html;
	}


	//
	// ACTION HANDLERS FOR FORMS IN FLOW
	//

	/**
	 * Handles the registration of a new user.
	 *
	 * Used through the action hook "login_form_register" activated on wp-login.php
	 * when accessed through the registration action.
	 */
	public function do_register_user() {
		if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
			$redirect_url = home_url( 'registrieren' );

			if ( ! get_option( 'users_can_register' ) ) {
				// Registration closed, display error
				$redirect_url = add_query_arg( 'register-errors', 'closed', $redirect_url );
			} 
			// elseif ( ! $this->verify_recaptcha() ) {
			// 	// Recaptcha check failed, display error
			// 	$redirect_url = add_query_arg( 'register-errors', 'captcha', $redirect_url );
			// } 
			else {
				$email = $_POST['email'];
				$first_name = sanitize_text_field( $_POST['first_name'] );
				$last_name = sanitize_text_field( $_POST['last_name'] );
				$patient_caregiver = $_POST['patientcaregiverid'] ;
				if (isset($_POST['personal_data_checkbox'])) {
					$personal_data_checkbox = true;
				}
				if (isset($_POST['newsletter_checkbox'])) {
					$newsletter_checkbox = true;
				}
				if (isset($_POST['reminder_checkbox'])) {
					$reminder_checkbox = true;
				}
				if (isset($_POST['agb_checkbox'])) {
					$agb_checkbox = true;
				}

				// echo "<script type='text/javascript'>alert('$patient_caregiver');</script>";

				$result = $this->register_user( $email, $first_name, $last_name, $patient_caregiver, $personal_data_checkbox, $reminder_checkbox, $newsletter_checkbox, $agb_checkbox);

				if ( is_wp_error( $result ) ) {
					// Parse errors into a string and append as parameter to redirect
					$errors = join( ',', $result->get_error_codes() );
					$redirect_url = add_query_arg( 'register-errors', $errors, $redirect_url );
				} else {
					// Success, redirect to login page.
					$redirect_url = home_url( 'erfolgreiche-registrierung' );
					//$redirect_url = add_query_arg( 'registered', $email, $redirect_url );

					include 'assets/api/api_requests.php';
					include 'assets/api/refresh_token.php';

					$formDataa = array(
						"data" => array(
							array(
								"First_Name" => $first_name,
								"Last_Name" => $last_name,
								"Email" => $email,
								"patient_or_caregiver" => $patient_caregiver,
								"agb" => $agb_checkbox,
								"gdpr" => $personal_data_checkbox,
								"reminder_opt_in" => $reminder_checkbox,
								"newsletter_opt_in" => $newsletter_checkbox,
								"Lead_Source" => "hellomedOS_registrierung",
								"Lead_Status" => "Interessiert"
							)
						)
					);

					$accessToken = refreshAccessToken();
					sendDataToZoho($formDataa, $accessToken);

				}
			}



			wp_redirect( $redirect_url );
			exit;
		}
	}


		/**
	 * Initiates password reset.
	 */
	public function do_password_lost() {
		if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
			$errors = retrieve_password();
			if ( is_wp_error( $errors ) ) {
				// Errors found
				$redirect_url = home_url( 'passwort-vergessen' );
				$redirect_url = add_query_arg( 'errors', join( ',', $errors->get_error_codes() ), $redirect_url );
			} else {
				// Email sent
				$redirect_url = home_url( 'login' );
				$redirect_url = add_query_arg( 'checkemail', 'confirm', $redirect_url );
				if ( ! empty( $_REQUEST['redirect_to'] ) ) {
					$redirect_url = $_REQUEST['redirect_to'];
				}
			}

			wp_safe_redirect( $redirect_url );
			exit;
		}
	}

	/**
	 * Resets the user's password if the password reset form was submitted.
	 */
	public function do_password_reset() {
		if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
			$rp_key = $_REQUEST['rp_key'];
			$rp_login = $_REQUEST['rp_login'];

			$user = check_password_reset_key( $rp_key, $rp_login );

			if ( ! $user || is_wp_error( $user ) ) {
				if ( $user && $user->get_error_code() === 'expired_key' ) {
					wp_redirect( home_url( 'login?login=expiredkey' ) );
				} else {
					wp_redirect( home_url( 'login?login=invalidkey' ) );
				}
				exit;
			}

			if ( isset( $_POST['pass1'] ) ) {
				if ( $_POST['pass1'] != $_POST['pass2'] ) {
					// Passwords don't match
					$redirect_url = home_url( 'neues-passwort-eingabe' );

					$redirect_url = add_query_arg( 'key', $rp_key, $redirect_url );
					$redirect_url = add_query_arg( 'login', $rp_login, $redirect_url );
					$redirect_url = add_query_arg( 'error', 'password_reset_mismatch', $redirect_url );

					wp_redirect( $redirect_url );
					exit;
				}

				if ( empty( $_POST['pass1'] ) ) {
					// Password is empty
					$redirect_url = home_url( 'neues-passwort-eingabe' );

					$redirect_url = add_query_arg( 'key', $rp_key, $redirect_url );
					$redirect_url = add_query_arg( 'login', $rp_login, $redirect_url );
					$redirect_url = add_query_arg( 'error', 'password_reset_empty', $redirect_url );

					wp_redirect( $redirect_url );
					exit;

				}

				if (  strlen($_POST['pass1']) < 8 ) {
					// Password is empty
					$redirect_url = home_url( 'neues-passwort-eingabe' );

					$redirect_url = add_query_arg( 'key', $rp_key, $redirect_url );
					$redirect_url = add_query_arg( 'login', $rp_login, $redirect_url );
					$redirect_url = add_query_arg( 'error', 'password_weak', $redirect_url );

					wp_redirect( $redirect_url );
					exit;

				}


				// Parameter checks OK, reset password
				reset_password( $user, $_POST['pass1'] );

				$user_id = $user->ID;

				update_field('confirmed_or_not', 1, 'user_' . $user_id);

				if( $user ) {
					wp_set_current_user( $user_id, $user->user_login );
					wp_set_auth_cookie( $user_id );
					do_action( 'wp_login', $user->user_login );
				}
				
				// wp_redirect( home_url( 'login?password=changed' ) );
				wp_redirect( home_url('onboarding'));

			} else {
				echo "Invalid request.";
			}

			exit;
		}
	}





	public function do_onboarding() {

		if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
			$user = wp_get_current_user();
			$user_id = $user->ID;


			$redirect_url = home_url( 'onboarding' );
			// user_id
		//	$user_id = $_POST['user_id'];
			$formDataUpdate['data'][0]['Lead_Source'] = "hellomedOS_empty";
			$formDataUpdate['data'][0]['Lead_Status'] = "Interessiert";

			// save field to user profile 
			if ( !empty( $_POST['patient_first_name'] ) ) {
				$patient_first_name = $_POST['patient_first_name'];
				update_user_meta( $user_id, 'patient_first_name', $patient_first_name );
				$formDataUpdate['data'][0]['patient_name'] = $patient_first_name;
			}
			if ( !empty( $_POST['patient_last_name'] ) ) {
				$patient_last_name = $_POST['patient_last_name'];
				update_user_meta( $user_id, 'patient_last_name', $patient_last_name );
				$formDataUpdate['data'][0]['patient_lastname'] = $patient_last_name;
			}

			if ( !empty( $_POST['geschlecht'] ) ) {
				$gender = $_POST['geschlecht'];
				update_user_meta( $user_id, 'geschlecht', $gender );
			}
			if ( !empty( $_POST['geburt'] ) ) {
				$birthday = $_POST['geburt'];
				update_user_meta( $user_id, 'geburt', $birthday );
			}
			if ( !empty( $_POST['krankheiten'] ) ) {
				$krankheiten = $_POST['krankheiten'];
				update_user_meta( $user_id, 'krankheiten', $krankheiten );
			}
			if ( !empty( $_POST['allergien'] ) ) {
				$allergies = $_POST['allergien'];
				update_user_meta( $user_id, 'allergies', $allergies );
			}

			if ( !empty( $_POST['strasse'] ) ) {
				$address = $_POST['strasse'];
				update_user_meta( $user_id, 'strasse', $address );
			}

			if ( !empty( $_POST['nrno'] ) ) {
				$nrno = $_POST['nrno'];
				update_user_meta( $user_id, 'nrno', $nrno );
			}

			if ( !empty( $_POST['postcode'] ) ) {
				$zip = $_POST['postcode'];
				update_user_meta( $user_id, 'postcode', $zip );
			}
			if ( !empty( $_POST['stadt'] ) ) {
				$city = $_POST['stadt'];
				update_user_meta( $user_id, 'stadt', $city );
			}
			if ( !empty( $_POST['zusatzinformationen'] ) ) {
				$zusatzinformationen = $_POST['zusatzinformationen'];
				update_user_meta( $user_id, 'zusatzinformationen', $zusatzinformationen );
			}
			if ( !empty( $_POST['telephone'] ) ) {
				$phone = $_POST['telephone'];
				update_user_meta( $user_id, 'telephone', $phone );
			}
		
			if ( !empty( $_POST['startdatumpick'] ) ) {
				$start_date = $_POST['startdatumpick'];
				update_user_meta( $user_id, 'start_date', $start_date );
			}

			if ( !empty( $_POST['first_rezept_uploaded'] ) ) {
				$first_rezept_uploaded = $_POST['first_rezept_uploaded'];
				update_user_meta( $user_id, 'first_rezept_uploaded', $first_rezept_uploaded );
			}

	//TODO file upload
	
				$rezept_type = $_POST['rezept_type'];

					if ( !empty( $_POST['listfilenames'] ) ) {

						  function generate_unique_id() {
							$counter = get_option('prescription_counter');
							if (!$counter) {
							  $counter = 1000;
							  add_option('prescription_counter', $counter);
							}
							$counter++;
							update_option('prescription_counter', $counter);
						  
							$user_ids = get_users(array(
							  'fields' => 'ID',
							));
						  
							foreach ($user_ids as $user_id) {
							  $value = get_field('prescription_id', 'user_' . $user_id);
							  if ($value === false) {
								continue;
							  }
							  if ($value == $counter) {
								return generate_unique_id();
							  }
							}
							return $counter;
						  }

						$unique_id = generate_unique_id();

						$listfilenames = $_POST['listfilenames'];

						$formDataUpdate['data'][0]['Prescription_available'] = "Yes";
						$formDataUpdate['data'][0]['Prescriptions_links'] = "Please check hellomedOS for the files (work on progress)";
						$formDataUpdate['data'][0]['Lead_Source'] = "hellomedOS_full";
						$formDataUpdate['data'][0]['Lead_Status'] = "Qualified";
						
						$listfilenamesarray = array();
						foreach($listfilenames as $key => $value) {
								$listfilenamesarray['rezept_file'][$key]['rezept_filename'] = $value;
								$listfilenamesarray['rezept_file'][$key]['file_url'] = "https://".$_SERVER['SERVER_NAME']."/wp-content/themes/hellomed/uploads/".$user_id."/". $value;
								$listfilenamesarray['rezept_file'][$key]['rezept_uploaded_date'] = date('d.m.Y H:i:s');
								$listfilenamesarray['rezept_file'][$key]['rezept_directory'] = $user_id;
								$listfilenamesarray['rezept_file'][$key]['rezept_type'] = $rezept_type;
						}

						// print("<pre>".print_r($listfilenamesarray,true)."</pre>");
						// print("<pre>".print_r($listfilenamesarray2,true)."</pre>");
						// print("<pre>".print_r($arr3,true)."</pre>");
						// die;

						$listfilenamesarray2 = array();
						$arr3 = array();

						if ( !empty( $_POST['listfilenames2'] ) ) {


							$listfilenames2 = $_POST['listfilenames2'];

							$formDataUpdate['data'][0]['Medplan_available'] = "Yes";
							$formDataUpdate['data'][0]['Medplan_links'] = "Please check hellomedOS for the files (work on progress)";

							foreach($listfilenames2 as $key => $value) {
									$listfilenamesarray2['rezept_file'][$key]['rezept_filename'] = $value;
									$listfilenamesarray2['rezept_file'][$key]['file_url'] = "https://".$_SERVER['SERVER_NAME']."/wp-content/themes/hellomed/uploads/".$user_id."/". $value;
									$listfilenamesarray2['rezept_file'][$key]['rezept_uploaded_date'] = date('d.m.Y H:i:s');
									$listfilenamesarray2['rezept_file'][$key]['rezept_directory'] = $user_id;
									$listfilenamesarray2['rezept_file'][$key]['rezept_type'] = "medplan";
							}

							foreach($listfilenamesarray as $key=>$val)
								{
									$arr3['rezept_file'] = array_merge($val, $listfilenamesarray2[$key]);
									$arr3['new_user_id']= $user_id;
									$arr3['prescription_id']= $unique_id;
									$arr3['status_prescription']= "Wartend";
									$arr3['prescription_created_time']= date('d.m.Y H:i:s');
								}
						}
							else{
								$arr3 = $listfilenamesarray;
								$arr3['new_user_id']= $user_id;
								$arr3['prescription_id']= $unique_id;
								$arr3['status_prescription']= "Wartend";
								$arr3['prescription_created_time']= date('d.m.Y H:i:s');
							
							}

							
					

						add_row('rezept_input', $arr3, 'user_'.$user_id);
						// print("<pre>".print_r($listfilenamesarray,true)."</pre>");
						// print("<pre>".print_r($listfilenamesarray2,true)."</pre>");
						// print("<pre>".print_r($arr3,true)."</pre>");
						// die;
					}
					

				if ( !empty( $_POST['privat_or_gesetzlich'] ) ) {
					$privat_or_gesetzlich = $_POST['privat_or_gesetzlich'];
					update_user_meta( $user_id, 'privat_or_gesetzlich', $privat_or_gesetzlich );
				}

			if ( !empty( $_POST['insurance_company'] ) ) {
				$insurance_company = $_POST['insurance_company'];
				update_user_meta( $user_id, 'insurance_company', $insurance_company );
			}
			if ( !empty( $_POST['insurance_number'] ) ) {
				$insurance_number = $_POST['insurance_number'];
				update_user_meta( $user_id, 'insurance_number', $insurance_number );
			}
		
			// TODO completed onboarding
			// if ( !empty( $_POST['status'] ) ) {
			// 	$status = $_POST['status'];
			// 	update_user_meta( $user_id, 'has_completed_onboarding', $status );
			// }

			update_user_meta( $user_id, 'status', 'Wartend' );

			// TODO // TODO // TODO // TODO // TODO 
			//remmber to revert
			update_user_meta( $user_id, 'has_completed_onboarding', 1);

			$startchangeformat = str_replace('.', '-', $start_date);
			$startdayiso = date('Y-m-d', strtotime($startchangeformat));

			$birthdaychangeformat = str_replace('.', '-', $birthday);
			$birthdayiso = date('Y-m-d', strtotime($birthdaychangeformat));

					// var_dump($data);

					include 'assets/api/api_requests.php';
					include 'assets/api/refresh_token.php';

						$newvaluesUpdate = array(
							"Email" => $user->user_email,
							"gender" => $gender,
							"birthday" => $birthdayiso,
							"sickness" => $krankheiten,
							"allergies" => $allergies,
							"Street" => $address,
							"house_number" => $nrno,
							"Zip_Code" => $zip,
							"City" => $city,
							"delivery_notes" => $zusatzinformationen,
							"Phone" => $phone,
							"starting_date" => $startdayiso,
							"insurance_status" => $privat_or_gesetzlich,
							"insurance_name" => $insurance_company,
							"duplicate_check_fields" => array(
								"Email"
							)
						);
			
					 $formDataUpdate['data'][0] = array_merge($formDataUpdate['data'][0], $newvaluesUpdate);

					var_dump($formDataUpdate);

					$accessToken = refreshAccessToken();
					updateDataToZoho($formDataUpdate, $accessToken);

			wp_redirect( $redirect_url );
			exit;
		}
	}



	// public function do_funnel() {

	// 	if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
	// 		$user = wp_get_current_user();
	// 		$user_id = $user->ID;


	// 		$redirect_url = home_url( 'onboarding' );
	// 		// user_id
	// 	//	$user_id = $_POST['user_id'];

	// 		// save field to user profile 
	// 		if ( !empty( $patient_first_name ) ) {
	// 			$patient_first_name = $_POST['patient_first_name'];
	// 			update_user_meta( $user_id, 'patient_first_name', $patient_first_name );
	// 		}
	// 		if ( !empty( $_POST['patient_last_name'] ) ) {
	// 			$patient_last_name = $_POST['patient_last_name'];
	// 			update_user_meta( $user_id, 'patient_last_name', $patient_last_name );
	// 		}

	// 		if ( !empty( $_POST['geschlecht'] ) ) {
	// 			$gender = $_POST['geschlecht'];
	// 			update_user_meta( $user_id, 'geschlecht', $gender );
	// 		}
	// 		if ( !empty( $_POST['geburt'] ) ) {
	// 			$birthday = $_POST['geburt'];
	// 			update_user_meta( $user_id, 'geburt', $birthday );
	// 		}
	// 		if ( !empty( $_POST['krankheiten'] ) ) {
	// 			$krankheiten = $_POST['krankheiten'];
	// 			update_user_meta( $user_id, 'krankheiten', $krankheiten );
	// 		}
	// 		if ( !empty( $_POST['allergien'] ) ) {
	// 			$allergies = $_POST['allergien'];
	// 			update_user_meta( $user_id, 'allergies', $allergies );
	// 		}

	// 		if ( !empty( $_POST['strasse'] ) ) {
	// 			$address = $_POST['strasse'];
	// 			update_user_meta( $user_id, 'strasse', $address );
	// 		}

	// 		if ( !empty( $_POST['nrno'] ) ) {
	// 			$nrno = $_POST['nrno'];
	// 			update_user_meta( $user_id, 'nrno', $nrno );
	// 		}

	// 		if ( !empty( $_POST['postcode'] ) ) {
	// 			$zip = $_POST['postcode'];
	// 			update_user_meta( $user_id, 'postcode', $zip );
	// 		}
	// 		if ( !empty( $_POST['stadt'] ) ) {
	// 			$city = $_POST['stadt'];
	// 			update_user_meta( $user_id, 'stadt', $city );
	// 		}
	// 		if ( !empty( $_POST['zusatzinformationen'] ) ) {
	// 			$zusatzinformationen = $_POST['zusatzinformationen'];
	// 			update_user_meta( $user_id, 'zusatzinformationen', $zusatzinformationen );
	// 		}
	// 		if ( !empty( $_POST['telephone'] ) ) {
	// 			$phone = $_POST['telephone'];
	// 			update_user_meta( $user_id, 'telephone', $phone );
	// 		}
		
	// 		if ( !empty( $_POST['startdatumpick'] ) ) {
	// 			$start_date = $_POST['startdatumpick'];
	// 			update_user_meta( $user_id, 'start_date', $start_date );
	// 		}

	// 		if ( !empty( $_POST['first_rezept_uploaded'] ) ) {
	// 			$first_rezept_uploaded = $_POST['first_rezept_uploaded'];
	// 			update_user_meta( $user_id, 'first_rezept_uploaded', $first_rezept_uploaded );
	// 		}

	// //TODO file upload
	
	// 			$rezept_type = $_POST['rezept_type'];

	// 				if ( !empty( $_POST['listfilenames'] ) ) {

	// 					function generate_unique_id() {
	// 						$id = rand(1, 10);
	// 						$user_ids = get_users(array(
	// 							'fields' => 'ID',
	// 						));
	// 						$unique = true;
	// 						foreach ($user_ids as $user_id) {
	// 							$value = get_field('prescription_id', 'user_' . $user_id);
	// 							if ($value == $id) {
	// 								$unique = false;
	// 								break;
	// 							}
	// 						}
	// 						if (!$unique) {
	// 							// ID already exists for some user, generate a new one
	// 							generate_unique_id();
	// 						} else {
	// 							return $id;
	// 						}
	// 					}
						
	// 					$unique_prescription_id = generate_unique_id();
						
	// 					// $unique_id = generate_unique_id();

	// 					$listfilenames = $_POST['listfilenames'];

	// 					$listfilenamesarray = array();
	// 					foreach($listfilenames as $key => $value) {
	// 							$listfilenamesarray['rezept_file'][$key]['rezept_filename'] = $value;
	// 							$listfilenamesarray['rezept_file'][$key]['file_url'] = "https://".$_SERVER['SERVER_NAME']."/wp-content/themes/hellomed/uploads/".$user_id."/". $value;
	// 							$listfilenamesarray['rezept_file'][$key]['rezept_uploaded_date'] = date('d.m.Y H:i:s');
	// 							$listfilenamesarray['rezept_file'][$key]['rezept_directory'] = $user_id;
	// 							$listfilenamesarray['rezept_file'][$key]['rezept_type'] = $rezept_type;
	// 					}


				

	// 					// print("<pre>".print_r($listfilenamesarray,true)."</pre>");
	// 					// print("<pre>".print_r($listfilenamesarray2,true)."</pre>");
	// 					// print("<pre>".print_r($arr3,true)."</pre>");
	// 					// die;

	// 					$listfilenamesarray2 = array();
	// 					$arr3 = array();

	// 					if ( !empty( $_POST['listfilenames2'] ) ) {

	// 						$listfilenames2 = $_POST['listfilenames2'];

					
	// 						foreach($listfilenames2 as $key => $value) {
	// 								$listfilenamesarray2['rezept_file'][$key]['rezept_filename'] = $value;
	// 								$listfilenamesarray2['rezept_file'][$key]['file_url'] = "https://".$_SERVER['SERVER_NAME']."/wp-content/themes/hellomed/uploads/".$user_id."/". $value;
	// 								$listfilenamesarray2['rezept_file'][$key]['rezept_uploaded_date'] = date('d.m.Y H:i:s');
	// 								$listfilenamesarray2['rezept_file'][$key]['rezept_directory'] = $user_id;
	// 								$listfilenamesarray2['rezept_file'][$key]['rezept_type'] = "medplan";
	// 						}

	// 						foreach($listfilenamesarray as $key=>$val)
	// 							{
	// 								$arr3['rezept_file'] = array_merge($val, $listfilenamesarray2[$key]);
	// 								$arr3['new_user_id']= $user_id;
	// 								$arr3['prescription_id']= $unique_prescription_id;
	// 							}
	// 					}

	// 						else{
	// 							$arr3 = $listfilenamesarray;
	// 							$arr3['new_user_id']= $user_id;
	// 							$arr3['prescription_id']= $unique_prescription_id;
	// 						}

						



				

	// 					add_row('rezept_input', $arr3, 'user_'.$user_id);
	// 					print("<pre>".print_r($listfilenamesarray,true)."</pre>");
	// 					print("<pre>".print_r($listfilenamesarray2,true)."</pre>");
	// 					print("<pre>".print_r($arr3,true)."</pre>");
	// 					die;
	// 				}
					

	// 			if ( !empty( $_POST['privat_or_gesetzlich'] ) ) {
	// 				$privat_or_gesetzlich = $_POST['privat_or_gesetzlich'];
	// 				update_user_meta( $user_id, 'privat_or_gesetzlich', $privat_or_gesetzlich );
	// 			}

	// 		if ( !empty( $_POST['insurance_company'] ) ) {
	// 			$insurance_company = $_POST['insurance_company'];
	// 			update_user_meta( $user_id, 'insurance_company', $insurance_company );
	// 		}
	// 		if ( !empty( $_POST['insurance_number'] ) ) {
	// 			$insurance_number = $_POST['insurance_number'];
	// 			update_user_meta( $user_id, 'insurance_number', $insurance_number );
	// 		}
		

	// 		wp_redirect( $redirect_url );
	// 		exit;
	// 	}
	// }







	//
	// OTHER CUSTOMIZATIONS
	//

	/**
	 * Returns the message body for the password reset mail.
	 * Called through the retrieve_password_message filter.
	 *
	 * @param string  $message    Default mail message.
	 * @param string  $key        The activation key.
	 * @param string  $user_login The username for the user.
	 * @param WP_User $user_data  WP_User object.
	 *
	 * @return string   The mail message to send.
	 */
	public function replace_retrieve_password_message( $message, $key, $user_login, $user_data ) {

		$user_firstname = $user_data->user_firstname;
		$user_lastname = $user_data->user_lastname;
		$user_email = $user_data->user_email;

		// Create new message
		$msg  = __( 'Hallo, ', 'hellomed-custom-login' ) ;
		$msg .= sprintf( __( '%s ', 'hellomed-custom-login' ), $user_firstname ) ;
		$msg .= sprintf( __( '%s,', 'hellomed-custom-login' ), $user_lastname ) . "\r\n\r\n";
		$msg .= sprintf( __( 'Sie haben mit der E-Mail Adresse %s ', 'hellomed-custom-login' ), $user_email ) ;
		$msg .= __( 'angefordert Ihr Passwort zurückzusetzen. Sollten Sie dies nicht getan haben, ignorieren Sie diese E-Mail.', 'hellomed-custom-login' ) . "\r\n\r\n";
		$msg .= __( 'Um Ihr Passwort zurück zu setzen, besuchen Sie diesen Link:', 'hellomed-custom-login' ) . "\r\n";
		$msg .= site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ), 'login' ) . "\r\n\r\n";
		$msg .= __( 'Vielen Dank!', 'hellomed-custom-login' ) . "\r\n";

			// Revise the message content to make it HTML email compatible
			$msg = str_replace('<','',$msg);
			$msg = str_replace('>','',$msg);
			$msg = str_replace("\r\n",'<br>',$msg);
			// $msg = str_replace("\n",'<br>',$msg);
			// make any additional modifications to the message here...

		return $msg;
	}

	// change email title
	public function replace_retrieve_password_title ( $title ) {

	  $title = __( 'Passwort zurücksetzen für hellomed' );
	  return $title;

	}


	public function custom_wp_new_user_notification_email( $wp_new_user_notification_email, $user, $blogname ) {

		// $user_login = stripslashes( $user->user_login );
		// $user_email = stripslashes( $user->user_email );
		// $login_url	= wp_login_url();

		// $message  = __( 'Hi there,' ) . "/r/n/r/n";
		// $message .= sprintf( __( "Welcome to %s! Here's how to log in:" ), get_option('blogname') ) . "/r/n/r/n";
		// $message .= wp_login_url() . "/r/n";
		// $message .= sprintf( __('Username: %s'), $user_login ) . "/r/n";
		// $message .= sprintf( __('Email: %s'), $user_email ) . "/r/n";
		// $message .= __( 'Password: The one you entered in the registration form. (For security reason, we save encripted password)' ) . "/r/n/r/n";
		// $message .= sprintf( __('If you have any problems, please contact me at %s.'), get_option('admin_email') ) . "/r/n/r/n";
		// $message .= __( 'bye!' );

					$user_firstname = $user->user_firstname;
					$user_lastname = $user->user_lastname;


					$key = get_password_reset_key( $user );
					if ( is_wp_error( $key ) ) {
						return;
					}

				/* translators: %s: User login. */
				$message  = __( 'Hallo, ', 'hellomed-custom-login' ) ;
				$message .= sprintf( __( '%s ', 'hellomed-custom-login' ), $user_firstname ) ;
				$message .= sprintf( __( '%s,', 'hellomed-custom-login' ), $user_lastname ) . "\r\n\r\n";

				$message .= __( 'vielen Dank für Ihre Anmeldung und willkommen bei hellomed.' ) . "\r\n\r\n";
				// $message .= sprintf( __( 'Username: %s' ), $user->user_login ) . "\r\n\r\n";
				$message .= __( 'Um Ihre Anmeldung fortzuführen und Identität zu bestätigen, klicken Sie auf diesen Link und legen Sie Ihr eigenes Passwort fest:' ) . "\r\n\r\n";
				$message .= network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user->user_login ), 'login' ) . "\r\n\r\n";
				$message .= __( 'Wenn Sie Probleme beim Einloggen in Ihr Konto haben, kontaktieren Sie uns unter patient@hellomed.com oder telefonisch unter 030 233 295 030.' ) . "\r\n\r\n";
				$message .= __( 'Schön das Sie bei uns sind.' ) . "\r\n\r\n";
				$message .= __( 'Ihr hellomed Team' ) . "\r\n\r\n";
				

				// $message .= wp_login_url() . "\r\n";

				$message = str_replace('<','',$message);
				$message = str_replace('>','',$message);
				$message = str_replace("\r\n",'<br>',$message);

			// $wp_new_user_notification_email = array(
			// 	'to'      => $user->user_email,
			// 	/* translators: Login details notification email subject. %s: Site title. */
			// 	'subject' => __( '[%s] Login Detailss' ),
			// 	'message' => $message,
			// 	'headers' => '',
			// );

			// $wp_new_user_notification_email = apply_filters( 'wp_new_user_notification_email', $wp_new_user_notification_email, $user, $blogname );

			// wp_mail(
			// 	$wp_new_user_notification_email['to'],
			// 	wp_specialchars_decode( sprintf( $wp_new_user_notification_email['subject'], $blogname ) ),
			// 	$wp_new_user_notification_email['message'],
			// 	$wp_new_user_notification_email['headers']
			// );



		$wp_new_user_notification_email['subject'] = sprintf( '%s Account Bestätigung - Bitte bestätigen Sie Ihre E-Mail Adresse', $blogname );
		$wp_new_user_notification_email['headers'] = array('Content-Type: text/html; charset=UTF-8');
		$wp_new_user_notification_email['message'] = $message;
	
		return $wp_new_user_notification_email;

	}



	// function  custom_wp_new_user_notification_email(  $wp_new_user_notification_email, $user,  $blogname ) {
 
	// 	$user_login =  stripslashes( $user->user_login );
	// 	 $user_email = stripslashes(  $user->user_email );
	// 	$login_url   = wp_login_url();
	// 	$message  = __(  'Hi there,' ) . "/r/n/r/n";
	// 	$message  .= sprintf( __( "Welcome to %s! Here's  how to log in:" ),  get_option('blogname') ) . "/r/n/r/n";
	// 	 $message .= wp_login_url() . "/r/n";
	// 	 $message .= sprintf( __('Username:  %s'), $user_login ) . "/r/n";
	// 	 $message .= sprintf( __('Email: %s'),  $user_email ) . "/r/n";
	// 	$message .=  __( 'Password: The one you entered in  the registration form. (For security  reason, we save encripted password)' ) .  "/r/n/r/n";
	// 	$message .= sprintf(  __('If you have any problems, please  contact me at %s.'),  get_option('admin_email') ) .  "/r/n/r/n";
	// 	$message .= __( 'bye!'  );
	 
	// 	 $wp_new_user_notification_email['subject']  = sprintf( '[%s] Your credentials.',  $blogname );
	// 	 $wp_new_user_notification_email['headers']  = array('Content-Type: text/html;  charset=UTF-8');
	// 	 $wp_new_user_notification_email['message']  = $message;
	 
	// 	return  $wp_new_user_notification_email;
	// }


	//
	// HELPER FUNCTIONS
	//

	/**
	 * Validates and then completes the new user signup process if all went well.
	 *
	 * @param string $email         The new user's email address
	 * @param string $first_name    The new user's first name
	 * @param string $last_name     The new user's last name
	 *
	 * @return int|WP_Error         The id of the user that was created, or error if failed.
	 */
	private function register_user( $email, $first_name, $last_name, $patient_caregiver, $personal_data_checkbox, $reminder_checkbox, $newsletter_checkbox, $agb_checkbox) {
		$errors = new WP_Error();

		// Email address is used as both username and email. It is also the only
		// parameter we need to validate
		if ( ! is_email( $email ) ) {
			$errors->add( 'email', $this->get_error_message( 'email' ) );
			return $errors;
		}

		if ( username_exists( $email ) || email_exists( $email ) ) {
			$errors->add( 'email_exists', $this->get_error_message( 'email_exists') );
			return $errors;
		}

		// Generate the password so that the subscriber will have to check email...
		$password = wp_generate_password( 12, false );

		$user_data = array(
			'user_login'    => $email,
			'user_email'    => $email,
			'user_pass'     => $password,
			'first_name'    => $first_name,
			'last_name'     => $last_name,
			'nickname'      => $first_name,
		);

		$user_id = wp_insert_user( $user_data , );

		update_field('patient_caregiver', $patient_caregiver, 'user_' . $user_id);
		update_field('confirmed_or_not', 0, 'user_' . $user_id);

		update_field('agb_checkbox', $agb_checkbox, 'user_' . $user_id);
		update_field('personal_data_checkbox', $personal_data_checkbox, 'user_' . $user_id);
		update_field('reminder_checkbox', $reminder_checkbox, 'user_' . $user_id);
		update_field('newsletter_checkbox', $newsletter_checkbox, 'user_' . $user_id);


		wp_new_user_notification( $user_id, $password );

		return $user_id;
	}

	/**
	 * Checks that the reCAPTCHA parameter sent with the registration
	 * request is valid.
	 *
	 * @return bool True if the CAPTCHA is OK, otherwise false.
	 */
	private function verify_recaptcha() {
		// This field is set by the recaptcha widget if check is successful
		if ( isset ( $_POST['g-recaptcha-response'] ) ) {
			$captcha_response = $_POST['g-recaptcha-response'];
		} else {
			return false;
		}

		// Verify the captcha response from Google
		$response = wp_remote_post(
			'https://www.google.com/recaptcha/api/siteverify',
			array(
				'body' => array(
					'secret' => get_option( 'hellomed-custom-login-recaptcha-secret-key' ),
					'response' => $captcha_response
				)
			)
		);

		$success = false;
		if ( $response && is_array( $response ) ) {
			$decoded_response = json_decode( $response['body'] );
			$success = $decoded_response->success;
		}

		return $success;
	}

	/**
	 * Redirects the user to the correct page depending on whether he / she
	 * is an admin or not.
	 *
	 * @param string $redirect_to   An optional redirect_to URL for admin users
	 */
	private function redirect_logged_in_user( $redirect_to = null ) {


	

		$user = wp_get_current_user();
		$user_id = $user->ID;
		if ( user_can( $user, 'manage_options' ) ) {
			if ( $redirect_to ) {
				wp_safe_redirect( $redirect_to );
			} else {
				wp_redirect( admin_url() );
			}

		} 

		elseif(in_array( 'admin_panel', (array) $user->roles )){
			$redirect_url = home_url( '/admin-dashboard' );
			wp_redirect( $redirect_url );
			exit;
		}
		
		else {

			if ( get_field('has_completed_onboarding', 'user_' .$user_id) == 0){
				$redirect_url = home_url( '/onboarding' );
				
			 }
			else{
				
				if ( get_field('status', 'user_' .$user_id) == 'Aktiv'){
					$redirect_url = home_url( '/medikationsplan' ) ;
				 }
				 else{
					$redirect_url = home_url( '/willkommen' ) ;
				 }
			}
			wp_redirect( $redirect_url );
			exit;
		}
	}

	/**
	 * Finds and returns a matching error message for the given error code.
	 *
	 * @param string $error_code    The error code to look up.
	 *
	 * @return string               An error message.
	 */
	private function get_error_message( $error_code ) {
		switch ( $error_code ) {
			// Login errors

			case 'empty_username':
				return __( 'Bitte geben Sie eine E-Mail-Adresse ein.', 'hellomed-custom-login' );

			case 'empty_password':
				return __( 'Bitte geben Sie ein Passwort ein.', 'hellomed-custom-login' );

			case 'invalid_username':
				return __(
					"Es gibt keinen Account mit dieser E-Mail-Adresse. Vielleicht haben Sie einen anderen Account bei der Anmeldung genutzt?",
					'hellomed-custom-login'
				);

			case 'incorrect_password':
				$err = __(
					"<a href='%s'>Passwort vergessen?</a> Das eingegebene Passwort war falsch.",
					'hellomed-custom-login'
				);
				return sprintf( $err, wp_lostpassword_url() );

			// Registration errors

			case 'email':
				return __( 'Die eingegebene E-Mail-Adresse ist nicht korrekt', 'hellomed-custom-login' );

			case 'email_exists':
				return __( 'Es existiert bereits ein Account mit dieser E-Mail Adresse.', 'hellomed-custom-login' );

			case 'closed':
				return __( 'Die Registrierung neuer Nutzer ist derzeit nicht erlaubt.', 'hellomed-custom-login' );

			case 'captcha':
				return __( 'Bist du ein Roboter? Der Google reCAPTCHA war falsch.', 'hellomed-custom-login' );

			// Lost password

			case 'empty_username':
				return __( 'Sie müssen eine E-Mail Adresse eingeben um fortzufahren.', 'hellomed-custom-login' );

			case 'invalid_email':
			case 'invalidcombo':
				return __( 'Es gibt keinen Account mit dieser E-Mail Adresse.', 'hellomed-custom-login' );

			// Reset password

			case 'expiredkey':
			case 'invalidkey':
				return __( 'Der Link ist bereits abgelaufen', 'hellomed-custom-login' );

			case 'password_reset_mismatch':
				return __( "Die eingegebenen Passwörter stimmen nicht überein.", 'hellomed-custom-login' );

			case 'password_reset_empty':
				return __( "Entschuldigung, das Passwort muss ausgefüllt werden.", 'hellomed-custom-login' );

				case 'password_weak':
					return __( "Bitte legen Sie ein starkes Passwort für Ihr Konto fest. Für das Passwort sind mindestens 8 Zeichen zulässig.", 'hellomed-custom-login' );

			default:
				break;
		}

		return __( 'Unbekannter Fehler. Bitte versuchen Sie es es später noch einmal.', 'hellomed-custom-login' );
	}


	//
	// PLUGIN SETUP
	//

	/**
	 * Registers the settings fields needed by the plugin.
	 */
	public function register_settings_fields() {
		// Create settings fields for the two keys used by reCAPTCHA
		register_setting( 'general', 'hellomed-custom-login-recaptcha-site-key' );
		register_setting( 'general', 'hellomed-custom-login-recaptcha-secret-key' );

		add_settings_field(
			'hellomed-custom-login-recaptcha-site-key',
			'<label for="hellomed-custom-login-recaptcha-site-key">' . __( ' Sign up reCAPTCHA site key' , 'hellomed-custom-login' ) . '</label>',
			array( $this, 'render_recaptcha_site_key_field' ),
			'general'
		);

		add_settings_field(
			'hellomed-custom-login-recaptcha-secret-key',
			'<label for="hellomed-custom-login-recaptcha-secret-key">' . __( 'Sign up reCAPTCHA secret key' , 'hellomed-custom-login' ) . '</label>',
			array( $this, 'render_recaptcha_secret_key_field' ),
			'general'
		);
	}

	public function render_recaptcha_site_key_field() {
		$value = get_option( 'hellomed-custom-login-recaptcha-site-key', '' );
		echo '<input type="text" id="hellomed-custom-login-recaptcha-site-key" name="hellomed-custom-login-recaptcha-site-key" value="' . esc_attr( $value ) . '" />';
	}

	public function render_recaptcha_secret_key_field() {
		$value = get_option( 'hellomed-custom-login-recaptcha-secret-key', '' );
		echo '<input type="text" id="hellomed-custom-login-recaptcha-secret-key" name="hellomed-custom-login-recaptcha-secret-key" value="' . esc_attr( $value ) . '" />';
	}

}

// Initialize the plugin
$hellomed_custom_login_pages_plugin = new Hellomed_Custom_Login_Plugin();

// Create the custom pages at plugin activation
register_activation_hook( __FILE__, array( 'Hellomed_Custom_Login_Plugin', 'plugin_activated' ) );
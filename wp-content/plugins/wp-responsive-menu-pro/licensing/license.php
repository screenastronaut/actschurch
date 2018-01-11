<?php
if( !class_exists( 'MG_Plugin_Updater' ) ) {
	// load our custom updater
	require_once( MG_WPRMP_PATH . '/licensing/MG_Plugin_Updater.php' );
}

class MG_WPR_Updater {

	private $name 		= 'WP Responsive Menu Pro';
	private $author		= 'MagniGenie';
	private $version	= '3.0.3';
	private $license 	= 'wpr_license';
	private $api_url  = 'http://magnigenie.com';
	private $icon		  =  '';

	public function __construct() {

		add_action( 'admin_init', array( $this, 'mg_plugin_updater' ), 0 );
		add_action( 'wp_ajax_activate_' . $this->license, array( $this, 'mg_activate_license' ), 0 );
		add_action( 'wp_ajax_deactivate_' . $this->license, array( $this, 'mg_deactivate_license' ), 0 );
		add_action( 'admin_enqueue_scripts', array( $this, 'mg_add_scripts' ) );
		add_action( 'admin_menu', array( $this, 'mg_license_page' ), 100 );
		
		$license_key = trim( get_option( $this->license ) );
		if( empty( $license_key ) )
			add_action( 'admin_notices', array( $this, 'admin_notices' ) );
	}

	public function mg_license_page() {
		add_submenu_page(
	        'wp-responsive-menu-pro',
	        'License',
	        'License',
	        'manage_options',
	        'wpr-license',
	        array( $this, 'mg_licensing_page' )
        );
	}

	public function admin_notices() {
		$class = 'notice notice-error';		
		$message = __( '<a href="' . admin_url( 'admin.php?page=wpr-license' )  .'">Update</a> your license key for ' . $this->name . ' to receive regular updates and support.', 'wprmenu' );

		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message ); 
	}

	public function mg_plugin_updater() {
		// retrieve our license key from the DB
		$license_key = trim( get_option( $this->license ) );

		// setup the updater
		$mg_updater = new MG_Plugin_Updater( MG_WPRMP_FILE, array(
				'version'   => $this->version,  // current version number
				'license'   => $license_key, 	// license key 
				'item_name' => $this->name, 	// name of this plugin
				'author'    => $this->author 	// author of this plugin
			)
		);
	}

	public function mg_licensing_page(){
		$this->icon 	= plugins_url( 'assets/icons.svg', __FILE__ );
		$license_status = get_option( $this->license . '_status');
        require_once('license-settings.php' );
	}

	public function mg_add_scripts( $hook ){
		wp_enqueue_style( 'mg_license_css', plugins_url( 'assets/style.css', __FILE__ ) );
		wp_enqueue_script( 'mg_license_js', plugins_url( 'assets/scripts.js', __FILE__ ) );
	}

	public function mg_activate_license(){
		// listen for our activate button to be clicked
		if( isset( $_POST[$this->license] ) ) {

			// run a quick security check
		 	if( ! check_admin_referer( $this->license.'_nonce', $this->license.'_nonce' ) )
				return; // get out if we didn't Activate
			
			// Get the license from the user
			$license = trim( $_POST[$this->license] );

			// data to send in our API request
			$api_params = array(
				'edd_action' => 'activate_license',
				'license'    => $license,
				'item_name'  => urlencode( $this->name ), // the name of our product
				'url'        => home_url()
			);

			// Call the custom API.
			$response = wp_remote_post( $this->api_url, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

			// make sure the response came back okay
			if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

				if ( is_wp_error( $response ) ) {
					$message = $response->get_error_message();
				} else {
					$message = __( 'An error occurred, please try again.' );
				}

			} else {

				$license_data = json_decode( wp_remote_retrieve_body( $response ) );

				if ( false === $license_data->success ) {

					switch( $license_data->error ) {

						case 'expired' :

							$message = sprintf(
								__( 'Your license key expired on %s.' ),
								date_i18n( get_option( 'date_format' ), strtotime( $license_data->expires, current_time( 'timestamp' ) ) )
							);
							break;

						case 'revoked' :

							$message = __( 'Your license key has been disabled.' );
							break;

						case 'missing' :

							$message = __( 'Invalid license.' );
							break;

						case 'invalid' :
						case 'site_inactive' :

							$message = __( 'Your license is not active for this URL.' );
							break;

						case 'item_name_mismatch' :

							$message = sprintf( __( 'This appears to be an invalid license key for %s.' ), $this->name );
							break;

						case 'no_activations_left':

							$message = __( 'Your license key has reached its activation limit.' );
							break;

						default :

							$message = __( 'An error occurred, please try again.' );
							break;
					}

				}
			}

			// Check if anything passed on a message constituting a failure
			if ( ! empty( $message ) )
				$return = array( 'status' => 'error', 'message' => $message );
			else{
				//Save the license key in database
				update_option( $this->license, $license );

				// $license_data->license will be either "valid" or "invalid"
				update_option( $this->license . '_status', $license_data->license );
				$return = array( 'status' => 'updated', 'message' => 'Your license is successfully activated.' );
			}
			echo json_encode( $return );
			exit();
		}
	}

	/***********************************************
	* Deactivate a license key.
	* This will decrease the site count
	***********************************************/

	function mg_deactivate_license() {

		// run a quick security check
	 	if( ! check_admin_referer( $this->license.'_nonce', $this->license.'_nonce' ) )
			return; // get out if we didn't click the Activate button

		// retrieve the license from the database
		$license = trim( get_option( $this->license ) );


		// data to send in our API request
		$api_params = array(
			'edd_action' => 'deactivate_license',
			'license'    => $license,
			'item_name'  => urlencode( $this->name ), // the name of our product in EDD
			'url'        => home_url()
		);

		// Call the custom API.
		$response = wp_remote_post( $this->api_url, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

			if ( is_wp_error( $response ) ) {
				$message = $response->get_error_message();
			} else {
				$message = __( 'An error occurred, please try again.' );
			}
			$return = array( 'status' => 'error', 'message' => $message );
		}
		else{
			// decode the license data
			$license_data = json_decode( wp_remote_retrieve_body( $response ) );

			// $license_data->license will be either "deactivated" or "failed"
			if( $license_data->license == 'deactivated' ) {
				delete_option( $this->license . '_status' );
				delete_option( $this->license );
			}
			$return = array( 'status' => 'updated', 'message' => 'License successfully deactivated.' );
		}
		echo json_encode( $return );
		exit();
	}
}
new MG_WPR_Updater();
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Application_Hooks {

	/*
	| This function check if the admin is already setup or not.
	| 
	| If admin setup return true otherwise redirect to setup page.
	*/
	function is_admin_setup() {
		
	}



	/*
	| This function hook check if any user is logged in 
	| to the system or not.

	| If no one already logged in to the system redirect
	| them to the login page.
	*/
	function is_logged_in() {
		$this->CI =& get_instance();	// application instance
		
		/*
		| Redirect user to login page he tries to open another page
		| ----------------------------------------------------------------
		| Reference: LOGINPAGE is defined @Auth_Controller/login_view
		*/
		if ( !defined( "LOGINPAGE" ) ) {
			if ( !empty( $this->CI->session->userdata( "login_details" ) ) && $this->CI->session->userdata( "login_details" ) == null ) {

			}else {
				redirect( 'login' );
			}
		}else {
			$this->is_admin_setup();
		}
	}

}
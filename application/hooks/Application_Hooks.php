<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Application_Hooks {

	function __construct() {
		$this->CI =& get_instance();	// application instance
	}

	/*
	| This function check if the admin is already setup or not.
	| 
	| If admin setup return true otherwise redirect to setup page.
	*/
	function is_admin_setup() {		
		if ( $this->CI->db->table_exists( "users" ) ) {
			$query = $this->CI->db->get( "users" );

			if ( $query->num_rows() == 0 ) {
				redirect( 'admin-setup' );
			}else {
				if ( defined( "ADMINSETUPPAGE" ) ) {
					redirect( 'login' );
				}
			}
		}else {
			if ( !defined( "ADMINSETUPPAGE" ) ) {
				redirect( 'admin-setup' );
			}
		}
	}



	/*
	| This function hook check if any user is logged in 
	| to the system or not.
	|
	| If no one already logged in to the system redirect
	| them to the login page.
	|
	| Redirect user to login page if he tries to open another page
	| ----------------------------------------------------------------
	|
	| Reference: LOGINPAGE is defined @Auth_Controller/login_view
	| Reference: ADMINSETUPPAGE is defined @Auth_Controller/admin_setup_view
	*/
	function is_logged_in() {
		if ( defined( "LOGINPAGE" ) ) {
			$this->is_admin_setup();
			return FALSE;
		}

		if ( defined( "ADMINSETUPPAGE" ) ) {
			$this->is_admin_setup();
			return FALSE;
		}

		if ( !empty( $this->CI->session->userdata( "login_details" ) ) && $this->CI->session->userdata( "login_details" ) == null ) {

		}else {
			redirect( 'login' );
		}
	}

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
	Auth Controller File
	------------------------------------------------
	Contains function related to user authentication
	like, login, signup, setup, forgot password etc.
*/

class Auth_Controller extends CI_Controller {

	/*
	| Function to return the login page 
	| Additionally with defining a constant LOGINPAGE
	*/
	function login_view() {
		define ( "LOGINPAGE", TRUE );	// to differentiate in hooks
		
		$this->load->view("auth/login");
	}

}
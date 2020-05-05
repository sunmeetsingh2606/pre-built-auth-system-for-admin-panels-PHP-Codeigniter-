<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
	Auth Controller File
	------------------------------------------------
	Contains function related to user authentication
	like, login, signup, setup, forgot password etc.
*/

class Auth_Controller extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model( "Site_Model" );
	}



	/*
	| Function to return the login page 
	| Additionally with defining a constant LOGINPAGE
	*/
	function login_view() {
		define ( "LOGINPAGE", TRUE );	// to differentiate in hooks
		
		$this->load->view( "auth/templates/header" );
		$this->load->view( "auth/login" );
		$this->load->view( "auth/templates/footer" );
	}



	/*
	| Function to return the admin setup page 
	| Additionally with defining a constant ADMINSETUPPAGE
	*/
	function admin_setup_view() {
		define ( "ADMINSETUPPAGE", TRUE );	// to differentiate in hooks
		$this->load->helper( "form" );
		$this->load->library( "form_validation" );		

		$this->load->view( "auth/templates/header" );
		$this->load->view( "auth/admin_setup" );
		$this->load->view( "auth/templates/footer" );
	}



	/*
	| Function triggered with admin setup form submit
	*/
	function do_admin_setup() {
		define ( "ADMINSETUPPAGE", TRUE );	// to differentiate in hooks
		$this->load->helper( "form" );
		$this->load->library( "form_validation" );
		$this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');

		$this->Site_Model->create_necessary_tables();	// set up table structure for application

		// form validation rules
		$validation_rules = array(
			array(
				"field" => "name",
				"label" => "Name",
				"rules" => "required|min_length[5]|max_length[50]"
			),
			array(
				"field" => "email",
				"label" => "Email",
				"rules" => "required|min_length[5]|max_length[50]|is_unique[users.email]"
			),
			array(
				"field" => "password",
				"label" => "Password",
				"rules" => "required"
			),
			array(
				"field" => "cpassword",
				"label" => "Confirm Password",
				"rules" => "required|matches[password]"
			)
		);
		$this->form_validation->set_rules( $validation_rules );

		// check for form validations
		if ( $this->form_validation->run() == FALSE ) {
			$this->load->view( "auth/templates/header" );
			$this->load->view( "auth/admin_setup" );
			$this->load->view( "auth/templates/footer" );
		}else {
			// create a new admin role
			$role_data = array(
				"name" => "admin",
				"priviledges" => json_encode( array( "0" => "*" ) )
			);
			$role_query = $this->db->insert( "roles", $role_data );

			if ( !$role_query ) {
				$message = "Something went wrong while adding the user. Please try again by:<br><br>
					1) Reloading the page, or<br>
					2) Filling up the setup form once again";
				show_error( $message, "500", $heading = "OOPS! Sorry..." );
			}

			// insert data in users table 
			$user_data = array(
				"name" => $this->input->post( "name" ),
				"email" => $this->input->post( "email" ),
				"password" => $this->input->post( "password" ),
				"role_id" => $this->db->insert_id(),
				"date_created" => date( "d/m/Y h:i:s A" ),
				"date_updated" => date( "d/m/Y h:i:s A" )
			);
			$user_query = $this->db->insert( "users", $user_data );

			if ( !$user_query ) {
				$message = "Something went wrong while adding the user. Please try again by:<br><br>
					1) Reloading the page, or<br>
					2) Filling up the setup form once again";
				show_error( $message, "500", $heading = "OOPS! Sorry..." );
			}				

			redirect( "login" );
		}
	}

}
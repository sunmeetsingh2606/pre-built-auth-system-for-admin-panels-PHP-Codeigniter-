<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
	Dashboard Controller File
	------------------------------------------------
	Contains all the function for dashboard page or
	related to dashboard thing.
*/

class Dashboard_Controller extends CI_Controller {

	function index() {
		$this->load->view("dashboard");
	}

}
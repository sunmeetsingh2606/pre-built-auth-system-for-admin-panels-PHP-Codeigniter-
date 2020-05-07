<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
	Site Model File
	------------------------------------------------
	Contains function to modify database
	Global file for model
*/

class Site_Model extends CI_Model {

	/*
	| Function to create necessary tables in the database
	*/
	function create_necessary_tables() {
		$this->create_roles_table();
		$this->create_users_table();
	}



	/*
	| Function to create users table in database
	*/
	function create_users_table() {
		$query = $this->db->query( "CREATE TABLE IF NOT EXISTS users(
			id INT(11) AUTO_INCREMENT PRIMARY KEY,
			name varchar(50) NOT NULL,
			email varchar(100) NOT NULL,
			password text NOT NULL,
			role_id INT(11) NOT NULL,
			date_created text NOT NULL,
			date_updated text NOT NULL,
			FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE)" );
	}



	/*
	| Function to create user roles table in database
	*/
	function create_roles_table() {
		$query = $this->db->query( "CREATE TABLE IF NOT EXISTS roles(
			id INT(11) AUTO_INCREMENT PRIMARY KEY,
			name varchar(50) NOT NULL,
			priviledges text NOT NULL)" );
	}



	/*
	| Function to insert new row in the table
	*/
	function insert_row( $table_name, $data ) {
		$query = $this->db->insert( $table_name, $data );

		if ( $query ) {
			return TRUE;
		}else {
			return FALSE;
		}
	}



	/*
	| Function to get data from the table
	*/
	function get_data( $table_name, $where = NULL ) {

		// add where clause to the query
		if ( $where != NULL ) {
			$this->db->where( $where );
		}

		$query = $this->db->get( $table_name );

		if ( $query ) {
			return $query->result_array();
		}else {
			return FALSE;
		}

	}

}
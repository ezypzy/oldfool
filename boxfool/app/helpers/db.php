<?php
/**
 * Database connection helper
 **/

class Database {

	var $db_host = "";
	var $db_name = "";
	var $db_user = "";
	var $db_pass = "";

	function __construct() {
		$this->db_host = c::get("db.host");
		$this->db_name = c::get("db.name");
		$this->db_user = c::get("db.user");
		$this->db_pass = c::get("db.pass");
	}

	public function connect() {
		ORM::configure('mysql:host='. $this->db_host .';dbname='. $this->db_name);
		ORM::configure('username', $this->db_user);
		ORM::configure('password', $this->db_pass);
		ORM::configure('id_column', 'id');
	}

}

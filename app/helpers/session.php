<?php
/**
 * session.php
 **/

require_once 'app/helpers/db.php';

class Session extends Database {

	var $_id = '';
	var $user_id = '';
	var $expired = '';
	var $user_agent = '';
	var $ip_addr = '';
	var $logged_in = false;

	function __construct() {
		$this->start();
	}


	// -- start session tracking
	public function start() {
		session_start();
		$this->_id = session_id();

		// -- get rid of expired session first
		$this->clean();

		$sess = $this->get();
		if($sess != false) {
			$this->logged_in = true;
			$this->user_id = $sess->user_id;
			$this->expired = $sess->expired;
			$this->user_agent = $sess->user_agent;
			$this->ip_addr = $sess->ip_addr;
			$this->update();
		}
	}


	// -- get rid of expired session
	public function clean() {
		$sess = ORM::for_table('sessions')
			->where_lt('expired', date('Y-m-d H:i:s'))
			->find_many();
		if($sess != false) {
			foreach($sess as $s) {
				$s->delete();
			}
		}
	}


	// -- create new session
	public function create($user_id) {
		$sess = ORM::for_table('sessions')->create();
		$sess->_id = $this->_id;
		$sess->user_id = $user_id;
		$sess->expired = date('Y-m-d H:i:s', time() + (3 * 60 * 60));
		$sess->user_agent = $_SERVER['HTTP_USER_AGENT'];
		$sess->ip_addr = $_SERVER['REMOTE_ADDR'];
		$sess->created_at = date('Y-m-d H:i:s');
		if($sess->save()) {
			$this->logged_in = true;
			return true;
		} else {
			return false;
		}
	}


	// -- update session expired time
	public function update($_id = '') {
		if($_id == '') {
			$_id = $this->_id;
		}
		$sess = ORM::for_table('sessions')->find_one($_id);
		$sess->set('expired', date('Y-m-d H:i:s', time() + (3 * 60 * 60)));
		$sess->save();
	}


	// -- get session information (also use for verify)
	public function get($_id = '') {
		if($_id == '') {
			$_id = $this->_id;
		}
		$sess = ORM::for_table('sessions')
			->where('_id', $_id)
			->find_one();
		return $sess;
	}


	// -- delete session (user logout)
	public function destroy($_id = '') {
		if($_id == '') {
			$_id = $this->_id;
		}
		$sess = ORM::for_table('sessions')->find_one($_id);
		if($sess != false) {
			$sess->delete();
		}
	}

}

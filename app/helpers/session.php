<?php
/**
 * session.php
 **/

require_once 'app/helpers/db.php';

class Session extends Database {

	var $id = '';
	var $user_id = '';
	var $user_type = '';
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
		$this->id = session_id();

		// -- get rid of expired session first
		$this->clean();

		$sess = $this->get();
		if($sess != false) {
			$this->logged_in = true;
			$this->user_id = $sess->user_id;
			$this->user_type = $sess->user_type;
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
		//check if session has already been created
		$ses = ORM::for_table('sessions')->find_one($this->id);

		if(!$ses) {
			$user = ORM::for_table('subscribers')->find_one($user_id);
		
			if($user != false) {
				$sess = ORM::for_table('sessions')->create();
				$sess->id = $this->id;
				$sess->user_id = $user_id;
				$sess->user_type = 'subscriber';
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
			} else {
				return false;
			}
		}
		else {
			$ses->user_id = $user_id;
			$ses->save();
		}	
	}


	// -- update session expired time
	public function update($id = '') {
		if($id == '') {
			$id = $this->id;
		}
		$sess = ORM::for_table('sessions')->find_one($id);
		$sess->set('expired', date('Y-m-d H:i:s', time() + (3 * 60 * 60)));
		$sess->save();
	}


	// -- get session information (also use for verify)
	public function get($id = '') {
		if($id == '') {
			$id = $this->id;
		}
		$sess = ORM::for_table('sessions')->find_one($id);
		return $sess;
	}


	// -- delete session (user logout)
	public function destroy($id = '') {
		if($id == '') {
			$id = $this->id;
		}
		$sess = ORM::for_table('sessions')->find_one($id);
		if($sess != false) {
			$sess->delete();
		}
	}
}

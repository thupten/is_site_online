<?php
class User_model extends CI_Model {
	var $username;
	var $email;
	var $last_checked_date;
	var $last_status;

	function insert($data) {
		$this->db->insert('users', $data);
		if ($this->db->affected_rows() > 0) {
			return $this->db->insert_id();
		} else {
			return 0;
		}
	}

	function update() {
	}

	function get_user($username, $password) {
		$query = $this->db->get_where('users',array (
				'username' => $username,
				'password' => $password 
		));
		if($query->num_rows() == 1){
			return $username;
		}else{
			return false;
		}
		
		
	}
}

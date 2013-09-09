<?php
class Project_model extends CI_Model {
	var $table = 'projects';

	function __construct() {
		parent::__construct();
	}

	function get_projects_by_specific_user($username, $limit, $offset) {
		$this->curl();
		$query = $this->db->get_where('projects', array (
				"username" => $username 
		), $limit, $offset);
		return $query->result();
	}

	function get_projects_for_current_user($limit, $offset) {
		$session_username = $this->_get_session_username();
		$result = $this->get_projects_by_specific_user($session_username, $limit, $offset);
		return $result;
	}

	function insert_project_for_current_user($data) {
		$session_username = $this->_get_session_username();
		$data['username'] = $session_username;
		$this->db->insert('projects', $data);
		if ($this->db->affected_rows() > 0) {
			return $this->db->insert_id();
		} else {
			return 0;
		}
	}

	function update_project_for_current_user($data, $where) {
		$where['username'] = $this->_get_session_username();
		$this->db->where($where);
		$this->db->update('projects', $data);
		return $this->db->affected_rows();
	}

	function delete_project_for_current_user($where) {
		$where['username'] = $this->_get_session_username();
		$this->db->delete('projects', $where);
		return $this->db->affected_rows();
	}

	function _get_session_username() {
		$username = $this->session->userdata('username');
		if ($username == false) {
			$username = "";
		}
		return $username;
	}
}

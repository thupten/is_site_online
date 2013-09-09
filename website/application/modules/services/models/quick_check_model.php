<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');
class Quick_check_model extends CI_Model {

	function __construct() {
		parent::__construct();
		// add more here
	}
	
	// crud
	// business logic goes in model. here
	function create($url) {
		$this->input->get_post('url', true);
	}

	function get() {
	}

	function update() {
	}

	function delete() {
	}

	function check_this_url($url) {
		$table = 'public_searches';
		$status = $this->_get_status_code_after_curl_check($url);
		$this->db->insert($table, array (
				'url' => $url,
				'status' => $status 
		));
		$count = $this->db->affected_rows();
		if ($count == 0) {
			return false;
		}
		$this->db->order_by('id', 'desc');
		$query = $this->db->get($table, 1, 0);
		return $query->result();
	}

	function get_publicly_checked_project($limit) {
		$table = 'public_searches';
		$this->db->order_by('id', 'desc');
		$query = $this->db->get($table, $limit, 0);
		return $query->result();
	}

	function _get_status_code_after_curl_check($url) {
		$status_code = - 1;
		$ch = curl_init($url);
		$options = array (
				CURLOPT_RETURNTRANSFER => TRUE,
				CURLOPT_NOBODY => TRUE,
				CURLOPT_FOLLOWLOCATION => TRUE 
		);
		curl_setopt_array($ch, $options);
		curl_exec($ch);
		if (! curl_errno($ch)) {
			$infos = curl_getinfo($ch);
			$status_code = $infos ['http_code'];
		} else {
			$status_code = 444;
		}
		curl_close($ch);
		return $status_code;
	}
}
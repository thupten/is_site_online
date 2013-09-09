<?php

/**
 * 
 * @author thupten choephel */
class Project_model extends CI_Model {

	/** gets projects for the username
	 *
	 * @param string $username
	 * @param number $limit default 99999999
	 * @param number $offset default 0 */
	function get_projects($username, $limit = 99999999, $offset = 0){
		$query = $this->db->get_where('projects', array (
				"username" => $username ), $limit, $offset);
		return $query->result_array();
	}

	/** inserts a new project to db
	 *
	 * @param array $data array of project row
	 * @return int bool id or false */
	function insert_project($data){
		$query = $this->db->insert('projects', $data);
		if ($this->db->affected_rows() > 0){
			return $this->db->insert_id();
		}
		return false;
	}

	function update_project($data, $where){
		$this->db->where($where);
		$this->db->update('projects', $data);
		if ($this->db->affected_rows() > 0){
			return true;
		} else{
			return false;
		}
	}

	function delete_project($where){
		$this->db->delete('projects', $where);
		$query = $this->db->get_where('projects', $where);
		if ($query->num_rows() > 0){
			return true;
		} else{
			return false;
		}
	}
}

<?php

/**
 *
 * @author thupten choephel
 */
class Project_model extends CI_Model {

	/**
	 * gets projects with condition.
	 *
	 * @param string $where
	 * @param number $limit
	 *        	default 99999999
	 * @param number $offset
	 *        	default 0
	 */
	function get_projects($where="", $limit = 99999999, $offset = 0){
		if ($where === ""){
			$query = $this->db->get('projects');
		} else{
			$query = $this->db->get_where('projects', $where, $limit, $offset);
		}
		return $query->result_array();
	}

	/**
	 * inserts a new project to db
	 *
	 * @param array $data
	 *        	array of project row
	 * @return array of row inserted or false
	 */
	function insert_project($data){
		$query = $this->db->insert('projects', $data);
		if ($this->db->affected_rows() > 0){
			$id = $this->db->insert_id();
			$query = $this->db->get_where('projects', array (
					'id' => $id ));
			return $query->result_array();
		}
		return false;
	}

	function update_project($data, $where){
		$this->db->update('projects', $data, $where);
		if ($this->db->affected_rows() > 0){
			$query = $this->db->get_where('projects', $where);
			return $query->result_array();
		} else{
			return false;
		}
	}

	function delete_project($where){
		$this->db->delete('projects', $where);
		$query = $this->db->get_where('projects', $where);
		if ($query->num_rows() == 0){
			return true;
		} else{
			return false;
		}
	}
}

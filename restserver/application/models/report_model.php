<?php

/**
 *
 * @author thupten choephel
 */
class Report_model extends CI_Model {

	/**
	 * gets reports in descending order by id
	 * @param string $where
	 * @param string $order_by
	 *        	default 'desc'
	 * @param number $limit
	 *        	default 7
	 * @param number $offset
	 *        	default 0
	 */
	function get_reports($where, $order_by = "DESC", $limit = 7, $offset = 0){
		$this->db->order_by('id', $order_by);
		$query = $this->db->get_where('reports', $where, $limit, $offset);
		return $query->result_array();
	}

	/**
	 * inserts a new report.
	 * @param array $data
	 *        	array of report row values
	 * @return array of the row inserted or false
	 *
	 */
	function insert_report($data){
		$query = $this->db->insert('reports', $data);
		if ($this->db->affected_rows() > 0){
			$id = $this->db->insert_id();
			$query = $this->db->get_where(array (
					'id' => $id ));
			return $query->result_array();
		}
		return false;
	}

	/**
	 * updates a report
	 * @param array $data
	 * @param array $where
	 * @return an array of the row updated or false if failed
	 */
	function update_report($data, $where){
		$this->db->where($where);
		$this->db->update('reports', $data);
		if ($this->db->affected_rows() > 0){
			$query = $this->db->get_where('reports', $where);
			return $query->result_array();
		} else{
			return false;
		}
	}

	/**
	 * delete a report
	 * @param array $where
	 * @return boolean true or false
	 */
	function delete_report($where){
		$this->db->delete('reports', $where);
		$query = $this->db->get_where('reports', $where);
		if ($query->num_rows() > 0){
			return true;
		} else{
			return false;
		}
	}
}

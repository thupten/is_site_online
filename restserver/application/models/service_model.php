<?php

/**
 *
 * @author thupten
 *
 */
class Service_model extends CI_Model {

	function get_status_code_after_curl_check($url){
		$status_code = - 1;
		$ch = curl_init($url);
		$options = array (
				CURLOPT_RETURNTRANSFER => TRUE,
				CURLOPT_NOBODY => TRUE,
				CURLOPT_FOLLOWLOCATION => 1,
				CURLOPT_SSL_VERIFYPEER => FALSE,
				CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13' );
		curl_setopt_array($ch, $options);
		$result = curl_exec($ch);
		if (! curl_errno($ch)){
			$infos = curl_getinfo($ch);
			$status_code = $infos ['http_code'];
		} else{
			$status_code = 444;
		}
		curl_close($ch);
		$this->db->insert('public_searches', array (
				'url' => $url,
				'status' => $status_code ));
		$id = $this->db->insert_id();
		$query = $this->db->get_where('public_searches', array (
				'id' => $id ));
		return $query->result_array();
	}

	function get_public_searches($limit){
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('public_searches', $limit, 0);
		return $query->result_array();
	}

	/**
	 */
	function cron_check_result($url){
		$status_code = - 1;
		$ch = curl_init($url);
		$options = array (
				CURLOPT_RETURNTRANSFER => TRUE,
				CURLOPT_NOBODY => TRUE,
				CURLOPT_FOLLOWLOCATION => 1,
				CURLOPT_SSL_VERIFYPEER => FALSE,
				CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13' );
		curl_setopt_array($ch, $options);
		curl_exec($ch);
		$info = curl_getinfo($ch);
		$status_code = $info ['http_code'];
		curl_close($ch);
		return $status_code;
	}
}
<?php

/**
 *
 * @author thupten choephel
 *         Project method calls to the api must send token for every request
 */
class Project_model extends CI_Model {
	var $resource_uri;
	var $token;

	function __construct(){
		parent::__construct();
		$this->resource_uri = 'http://localhost/restserver/api/projects';
		$this->token = $this->session->userdata('token');
	}

	function get_projects($limit, $offset, $id = ""){
		$query_string_array = array (
				'token' => $this->token,
				'limit' => $limit,
				'offset' => $offset );
		$url_append = (empty($id)) ? "" : "/" . $id;
		$new_resource_url = $this->resource_uri . $url_append;
		$this->session->set_userdata('token', $this->token);
		$response = $this->curl->simple_get($new_resource_url, $query_string_array);
		return json_decode($response);
	}

	function insert_project($data){
		$data ['token'] = $this->token;
		$response = $this->curl->simple_post($this->resource_uri, $data, array (
				CURLOPT_BUFFERSIZE => 10 ));
		$this->session->set_userdata('token', $this->token);

		return json_decode($response);
	}

	function update_project($data){
		// $data already contains id,name,description..now add token and put method
		$data ['token'] = $this->token;
		$data ['_method'] = 'put';
		$this->session->set_userdata('token', $this->token);
		$response = $this->curl->simple_post($this->resource_uri, $data);
		return json_decode($response);
	}

	function delete_project($where){
		$where ['token'] = $this->token;
		$where ['_method'] = 'delete';
		$this->session->set_userdata('token', $this->token);
		$response = $this->curl->simple_post($this->resource_uri, $where);
		return json_decode($response);
	}
}

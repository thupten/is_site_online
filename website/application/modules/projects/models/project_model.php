<?php

/** @author thupten choephel
 * Project method calls to the api must send token for every request */
class Project_model extends CI_Model {
	var $resource_uri;
	var $token;

	function __construct(){
		parent::__construct();
		$this->resource_uri = 'http://localhost/restserver/api/projects';
		$this->token = $this->session->userdata('token');
	}

	function get_projects($limit, $offset){
		$response = $this->curl->simple_get($this->resource_uri, array (
				'token' => $this->token,
				'limit' => $limit,
				'offset' => $offset ));
		return json_decode($response);
	}

	function insert_project($data){
		$data ['token'] = $this->token;
		$response = $this->curl->simple_post($this->resource_uri, $data, array (
				CURLOPT_BUFFERSIZE => 10 ));
		return json_decode($response);
	}

	function update_project($data){
		// $data already contains id,name,description..now add token and put method
		$data ['token'] = $this->token;
		$data ['_method'] = 'put';
		$response = $this->curl->simple_post($this->resource_uri, $data);
		return json_decode($response);
	}

	function delete_project($where){
		$data ['token'] = $this->token;
		$data ['_method'] = 'delete';
		$response = $this->curl->simple_post($this->resource_uri, $data);
		return json_decode($response);
	}
}

<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

class Quick_check_model extends CI_Model {
	var $resource_url;

	function __construct(){
		parent::__construct();
		$this->resource_url = "http://localhost/restserver/api";
	}
	// crud
	// business logic goes in model. here
	function create($url){
		$this->input->get_post('url', true);
	}

	function check_this_url($url){
		$quick_check_url = $this->resource_url . '/quick_check_get';
		$data ['url'] = $url;
		$this->curl->simple_post($public_checked_projects_url, $data);
		$response = $this->curl->execute();
		return json_decode($response);
	}

	function get_publicly_checked_project($limit = ""){
		$public_checked_projects_url = $this->resource_url . '/public_searches';
		$public_checked_projects_url .= ($limit == "") ? "" : '/' . $limit;
		$this->curl->create($public_checked_projects_url);
		$response = $this->curl->execute();
		return json_decode($response);
	}
}
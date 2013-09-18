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
		$quick_check_url = $this->resource_url . '/quick_check';
		$querystring = "?url=" . $url;
		$quick_check_url .= $querystring;
		$response = $this->curl->simple_get($quick_check_url);
		return json_decode($response);
	}

	function get_publicly_checked_project($limit = ""){
		$public_checked_projects_url = $this->resource_url . '/public_searches';
		$public_checked_projects_url .= ($limit == "") ? "" : '/' . $limit;
		$response = $this->curl->simple_get($public_checked_projects_url);
		return json_decode($response);
	}
}
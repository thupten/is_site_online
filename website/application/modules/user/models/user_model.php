<?php

class User_model extends CI_Model {
	var $username;
	var $email;
	var $last_checked_date;
	var $last_status;
	var $resource_url;

	function __construct(){
		parent::__construct();
		$this->resource_url = "http://localhost/restserver/api/user";
	}

	function insert($data){
		$this->curl->create($this->resource_url);
		$this->curl->post(array (
				'username' => $data ['username'],
				'password' => $data ['password'],
				'email' => $data ['email'] ));
		$response = $this->curl->execute();
		return json_decode($response);
	}

	function update(){
	}

	function get_user($username, $password){
		$response = $this->curl->simple_get($this->resource_url, array (
				'username' => $username,
				'password' => $password ));
		return json_decode($response);
	}

	function get_user_by_token($token){
		$response = $this->curl->simple_get($this->resource_url, array (
				'token' => $token ));
		return json_decode($response);
	}
}

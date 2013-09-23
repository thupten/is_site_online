<?php

class User_model extends CI_Model {
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

	function update($data){
		$this->curl->create($this->resource_url);
		$data ['_method'] = 'put';
		$this->curl->post($data);
		$response = $this->curl->execute();
		return json_decode($response);
	}

	function delete($where){
		$this->curl->create($this->resource_url);
		$where ['_method'] = 'delete';
		$this->curl->post($where);
		$response = $this->curl->execute();
		return json_decode($response);
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

	function logout($token){
		$response = $this->curl->simple_get($this->resource_url . "/logout", array (
				'token' => $token ));
		return json_decode($response);
	}
}

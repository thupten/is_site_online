<?php

class User_model extends CI_Model {
	var $resource_url;

	function __construct(){
		parent::__construct();
		$restserver_base_url = $this->config->item('restserver_base_url');
		$this->resource_url = $restserver_base_url . "/api/user";
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
		$response = $this->curl->simple_get($this->resource_url, array (
				'token' => $token,
				'task' => 'logout' ));
		return json_decode($response);
	}

	function change_password($username, $old_password, $new_password){
		$data ['username'] = $username;
		$data ['old_password'] = $old_password;
		$data ['new_password'] = $new_password;
		$data ['_method'] = 'put';
		$data ['task'] = "change_password";
		$this->curl->create($this->resource_url);
		$this->curl->post($data);
		$response = $this->curl->execute();
		return json_decode($response);
	}
}

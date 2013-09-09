<?php
require APPPATH . '/libraries/REST_Controller.php';

class Api extends REST_Controller {

	function __construct(){
		parent::__construct();
		
		$this->load->helper('string');
		$this->load->helper('date');
		
		$this->load->model('User_model');
		$this->load->model('Project_model');
	}
	
	// users, projects, services
	function user_get(){
		$username = $this->get('username');
		$token = $this->get('token');
		$password = $this->get('password');
		
		$status = false;
		
		if ($token != false){
			// check token for authentication
			$verify_result = $this->User_model->verify_token($token);
			if ($verify_result == false){
				$this->response(array (
						'status' => 'fail' ));
			} else{
				$this->response($verify_result);

			}
		} else{
			// check username and password
			$result = $this->User_model->verify_username_password($username, $password);
			if ($result == false){
				$this->response(array (
						'error' => 'invalid username or password' ), 401);
			} elseif ($result == null){
				$this->response(array (
						'error' => 'could not generate a token..please login again.' ), 401);
			} else{
				$this->response($result, 200);

			}
		}
	}

	function user_post(){
		$data ['username'] = $this->post('username');
		$data ['password'] = $this->post('password');
		$data ['email'] = $this->post('email');
		$id = $this->User_model->insert_user($data);
		if ($id == false){
			$this->response(array (
					'error' => 'could not create user',
					'status' => 'fail' ), 409);
		} else{
			$this->response(array (
					'id' => $id ), 200);

		}
	}

	function user_put(){
		$where ['username'] = $this->put('username');
		$where ['password'] = $this->put('password');
		$data ['password'] = $this->put('new_password');
		$data ['email'] = $this->put('email');
		
		$success = $this->User_model->update_user($data, $where);
		if ($success == false){
			$this->response(array (
					'error' => 'could not update user',
					'status' => 'fail' ), 409);
		} else{
			$this->response(array (
					'status' => 'ok' ), 200);

		}
	}

	function user_delete(){
		$where ['username'] = $this->delete('username');
		$where ['password'] = $this->delete('password');
		$success = $this->User_model->delete_user($where);
		if ($success == false){
			$this->response(array (
					'error' => 'could not delete user',
					'status' => 'fail' ), 409);
		} else{
			
			$this->response(array (
					'status' => 'ok',
					200 ));
		}
	}
	
	// projects
	function projects_get(){
		$limit = $this->get('limit');
		$offset = $this->get('offset');
		$token = $this->get('token');
		
		$user = $this->User_model->verify_token($token);
		
		if ($user === false){
			$this->response(array (
					'error' => 'invalid token',
					'status' => 'fail' ), 403);
		} else{
			
			$username = $user ['username'];
			if ($limit === false || $offset === false){
				$result_array = $this->Project_model->get_projects($username);
			} else{
				$result_array = $this->Project_model->get_projects($username, $limit, $offset);
			}
			$this->response($result_array, 200);

		}
	}

	function projects_post(){
		$token = $this->post('token');
		$user = $this->User_model->verify_token($token);
		if ($user === false){
			$this->response(array (
					'error' => 'invalid token',
					'status' => 'fail' ), 403);
		} else{
			$data ['name'] = $this->post('name');
			$data ['url'] = $this->post('url');
			$data ['description'] = $this->post('description');
			$data ['username'] = $user ['username'];
			$id = $this->Project_model->insert_project($data);
			if ($id == false){
				$this->response(array (
						'status' => 'fail',
						'error' => 'insert failed' ));
			} else{
				$this->response(array (
						'id' => $id,
						'status' => 'ok' ));
			}

		}
	}

	function projects_put(){
		$token = $this->put('token');
		$user = $this->User_model->verify_token($token);
		if ($user === false){
			$this->response(array (
					'error' => 'invalid token',
					'status' => 'fail' ), 403);
		} else{
			$data ['name'] = $this->put('name');
			$data ['url'] = $this->put('url');
			$data ['description'] = $this->put('description');
			$where ['username'] = $user ['username'];
			$success = $this->Project_model->update_project($data, $where);
			if ($success === true){
				return array (
						'status' => 'ok' );
			} else{
				return array (
						'status' => 'update failed' );
			}

		}
	}

	function projects_delete(){
		$token = $this->delete('token');
		$user = $this->User_model->verify_token($token);
		if ($user === false){
			$this->response(array (
					'error' => 'invalid token',
					'status' => 'fail' ), 403);
		} else{
			$where ['id'] = $this->delete('id');
			$where ['username'] = $user ['username'];
			$success = $this->Project_model->delete_project($where);
			if ($success === true){
				return array (
						'status' => 'ok' );
			} else{
				return array (
						'status' => 'delete failed' );
			}

		}
	}
}
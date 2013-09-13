<?php
require APPPATH . '/libraries/REST_Controller.php';

/**
 *
 * @author thupten choephel
 */
class Api extends REST_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('string');
		$this->load->helper('date');
		$this->load->model('User_model');
		$this->load->model('Project_model');
	}

	/**
	 * returns the user.
	 * user querystring can be 'username' and 'password' or just the 'token'.
	 * if error. returned response's http status is 400's and contains error key.
	 * if success. returned response's http status is 200 and contains the data.
	 * request action verb must be get.
	 */
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
						'error_message' => 'invalid token',
						'status_code' => 401 ));
			} else{
				$this->response($verify_result);
			}
		} else{
			// check username and password
			$result = $this->User_model->verify_username_password($username, $password);
			if ($result == false){
				$this->response(array (
						'error_message' => 'invalid username or password',
						'status_code' => 401 ));
			} elseif ($result == null){
				$this->response(array (
						'error_message' => 'could not generate a token..please login again.',
						'status_code' => 500 ));
			} else{
				$this->response($result);
			}
		}
	}

	/**
	 * returns the user successfully created with status 200.
	 * querystring includes 'username', 'password', 'email'. if error returns with error key.
	 * request action verb must be post.
	 */
	function user_post(){
		$data ['username'] = $this->post('username');
		$data ['password'] = $this->post('password');
		$data ['email'] = $this->post('email');
		$posted_user = $this->User_model->insert_user($data);
		if ($posted_user == false){
			$this->response(array (
					'error_message' => 'could not create user',
					'status_code' => 409 ));
		} else{
			$this->response($posted_user);
		}
	}

	/**
	 * updates the user and returns the updated user with status 200.
	 * querystring must have 'username' and one of followings 'password'& 'new_password' or 'email'
	 * request action verb must be post and query must also have _method='put'
	 */
	function user_put(){
		$where ['username'] = $this->put('username');
		$where ['password'] = $this->put('password');
		$data ['password'] = $this->put('new_password');
		$data ['email'] = $this->put('email');
		$updated_user = $this->User_model->update_user($data, $where);
		if ($updated_user == false){
			$this->response(array (
					'error_message' => 'could not update user',
					'status_code' => 409 ));
		} else{
			$this->response($updated_user);
		}
	}

	/**
	 * deletes the user and returns empty with status 200 which means deleted.
	 * if error occured, returns an array with 'error_message' key and status 409.
	 * querystrings must have 'username' and 'password'
	 */
	function user_delete(){
		$where ['username'] = $this->delete('username');
		$where ['password'] = $this->delete('password');
		$success = $this->User_model->delete_user($where);
		if ($success == false){
			$this->response(array (
					'error_message' => 'could not delete user',
					'status_code' => 409 ));
		} else{
			// user is deleted..returning empty data
			$this->response(array (
					'status_code' => 200 ));
		}
	}

	/**
	 * returns an array of projects.
	 * must include 'token' querystring. optional querystring include 'limit' and 'offset'. either don't send limit and
	 * offset or just send both. http status returned is 200 or 403.
	 */
	function projects_get($id = ""){
		$limit = $this->get('limit');
		$offset = $this->get('offset');
		$token = $this->get('token');
		$user = $this->User_model->verify_token($token);
		if ($user === false){
			$this->response(array (
					'error_message' => 'invalid token',
					'status_code' => 403 ));
		} else{
			$where = array ();
			if (! empty($id)){
				$where ['id'] = $id;
			}
			$where ['username'] = $user ['username'];
			if ($limit === false || $offset === false){
				$result_array = $this->Project_model->get_projects($where);
			} else{
				$result_array = $this->Project_model->get_projects($where, $limit, $offset);
			}
			foreach($result_array as &$project_row){
				$pid = $project_row ['id'];
				$project_row ['reports'] = $this->get_reports($token, $pid);
			}
			$this->response($result_array);
		}
	}

	/**
	 * creates a project.
	 * query string : required 'token', optional 'name','url','description'
	 * returns status 403: error key, 404: error key or 200: data
	 */
	function projects_post(){
		$token = $this->post('token');
		$user = $this->User_model->verify_token($token);
		if ($user === false){
			$this->response(array (
					'error_message' => 'invalid token',
					'status_code' => 403 ));
		} else{
			$data ['name'] = $this->post('name');
			$data ['url'] = $this->post('url');
			$data ['description'] = $this->post('description');
			$data ['username'] = $user ['username'];
			$inserted_project = $this->Project_model->insert_project($data);
			if ($inserted_project == false){
				$this->response(array (
						'error_message' => 'insert failed',
						'status_code' => 404 ));
			} else{
				$this->response($inserted_project);
			}
		}
	}

	/**
	 * updates a project.
	 * query strings: required 'token', '_method' as put, action as 'post', optional 'name','url', 'description'
	 * returns 403 error, 404 error, 200 data
	 */
	function projects_put(){
		$token = $this->put('token');
		$user = $this->User_model->verify_token($token);
		if ($user === false){
			$this->response(array (
					'error_message' => 'invalid token',
					'status_code' => 403 ));
		} else{
			$data ['name'] = $this->put('name');
			$data ['url'] = $this->put('url');
			$data ['description'] = $this->put('description');
			$where ['id'] = $this->put('id');
			$where ['username'] = $user ['username'];
			$updated_project = $this->Project_model->update_project($data, $where);
			if ($updated_project === false){
				$this->response(array (
						'error_message' => 'update failed',
						'status_code' => 404 ));
			} else{
				$this->response($updated_project);
			}
		}
	}

	/**
	 * deletes a project
	 * query string 'token' and 'id' of the project.
	 * returns 403 error ,404 error or 200 empty data
	 */
	function projects_delete(){
		$token = $this->delete('token');
		$user = $this->User_model->verify_token($token);
		if ($user === false){
			$this->response(array (
					'error_message' => 'invalid token',
					'status_code' => 403 ));
		} else{
			$where ['id'] = $this->delete('id');
			$where ['username'] = $user ['username'];
			$success = $this->Project_model->delete_project($where);
			if ($success === true){
				$this->response(array (
						'status_code' => 200 ));
			} else{
				$this->response(array (
						'error_message' => 'delete failed',
						'status_code' => 404 ));
			}
		}
	}

	function get_reports($token, $project_id){
		// sql below is working but i rather try the active record first.
		// $sql = "SELECT * FROM reports JOIN projects ON reports.project_id=projects.id JOIN users ON projects.username
		// = users.username WHERE users.token = $token";
		$this->db->select('reports.id, reports.date,reports.status, reports.project_id');
		$this->db->from('reports');
		$this->db->join('projects', 'reports.project_id=projects.id');
		$this->db->join('users', 'users.username=projects.username');
		$this->db->where(array (
				'users.token' => $token,
				'projects.id' => $project_id ));
		$query = $this->db->get();
		return $query->result_array();
	}
}
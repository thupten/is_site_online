<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

class Projects extends MX_Controller {
	// business logic goes to model. don't put business logic in controller
	function __construct(){
		parent::__construct();
		$this->load->model('Project_model');
	}

	function index(){
		echo ":)";
	}

	function get_projects($limit = 999999999, $offset = 0){
		$projects = $this->Project_model->get_projects($limit, $offset);
		if (array_key_exists('error_message', $projects)){
			$data ['error'] = $projects;
			$this->load->view('error_view', $data);
			return;
		}
		$data ['rows'] = $projects;
		$this->load->view('projects_list', $data);
	}

	function edit($id, $redirect_uri){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Project name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('url', 'Website url', 'trim|required|xss_clean|prep_url');
		$projects = $this->Project_model->get_projects(1, 0, $id);
		if (array_key_exists('error_message', $projects)){
			$this->load->view('error_view', array (
					'error' => $projects ));
			return;
		}
		if ($this->form_validation->run() == false){
			// validation failed
			$project = $projects [0];
			$this->load->view('edit_project_form', array (
					'project' => $project,
					'redirect_uri' => $redirect_uri ));
			return;
		} else{
			// validation passed..go on..submit and return status
			$data ['id'] = $this->input->get_post('id', true);
			$data ['name'] = $this->input->get_post('name', true);
			$data ['url'] = $this->input->get_post('url', true);
			$data ['description'] = $this->input->get_post('description', true);
			$updated_projects = $this->Project_model->update_project($data);
			if (array_key_exists('error_message', $updated_projects)){
				$this->load->view('error_view', array (
						'error' => $updated_projects ));
				return;
			}
			$updated_project = $updated_projects [0];
			$this->session->set_flashdata('message', 'Update project successful');
			if ($this->input->post('redirect_uri') != false){
				redirect($this->input->post('redirect_uri', true), 'refresh');
			}
		}
	}

	/**
	 * if query string includes 'redirect_uri' then the method will direct to that uri after successfully creating new
	 * project.
	 */
	function new_project($redirect_uri=""){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Project name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('url', 'Website url', 'trim|required|xss_clean|prep_url');
		if ($this->form_validation->run() == false){
			// validation failed
			$this->load->view('add_project_view', array (
					'redirect_uri' => $redirect_uri ));
		} else{
			// validation passed..go on..submit and return status
			$data ['name'] = $this->input->get_post('name', true);
			$data ['url'] = $this->input->get_post('url', true);
			$data ['description'] = $this->input->get_post('description', true);
			$project = $this->Project_model->insert_project($data);
			if (array_key_exists('error_message', $project)){
				$this->load->view('error_view', array (
						'error',
						$project ));
				return;
			}
			$this->session->set_flashdata('message', 'Create project successful');
			if ($this->input->post('redirect_uri') != false){
				redirect($input->input->post('redirect_uri', true), 'refresh');
			}
		}
	}

	/**
	 * shows confirmation and deletes after confirmation.
	 * redirects to 'redirect_uri' submitted with querystring. _method must be 'delete' in the form. method as post.
	 * @return boolean true or false.
	 */
	function delete($id, $redirect_uri){
		$method = $this->input->post('_method');
		if ($method === false){
			// not submitted
			$projects = $this->Project_model->get_projects(1, 0, $id);
			if (array_key_exists('error_message', $projects)){
				$this->load->view('error_view', array (
						'error' => $projects ));
				return false;
			}
			$data ['project'] = $projects [0];
			$data ['redirect_uri'] = $this->input->post('redirect_uri');
			$this->load->view('delete_project_form', $data);
		} else{
			// submitted
			$where ['id'] = $id;
			$deletedResult = $this->Project_model->delete_project($where);
			if (array_key_exists('error_message', $deletedResult)){
				$this->load->view('error_view', array (
						'error' => $deletedResult ));
				return false;
			}
			// success delete
			$this->session->set_flashdata('message', 'Delete project successful');
			if ($this->input->post('redirect_uri') != false){
				redirect($this->input->post('redirect_uri', true), 'refresh');
			}
			return true;
		}
	}
}
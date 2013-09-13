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

	function edit($id){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Project name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('url', 'Website url', 'trim|required|xss_clean|prep_url');
		$projects = $this->Project_model->get_projects(1, 0, $id);
		if (array_key_exists('error_message', $projects)){
			$this->load->view('error_view', array (
					'error' => $projects ));
			return;
		}
		$project = $projects [0];
		if ($this->form_validation->run() == false){
			// validation failed
			$this->load->view('edit_project_form', array (
					'project' => $project ));
			return;
		} else{
			// validation passed..go on..submit and return status
			$data ['id'] = $id;
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
	function new_project(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Project name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('url', 'Website url', 'trim|required|xss_clean|prep_url');
		if ($this->form_validation->run() == false){
			// validation failed
			$this->load->view('new_project_form');
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
	 * there is no confirmation for delete.
	 * you are expected to use the delete confirmation on the client side. javascript or something else.
	 * @return boolean
	 */
	function delete_project_submit(){
		$where ['id'] = $this->input->get_post('id', true);
		$deletedResult = $this->Project_model->delete_project($where);
		if (array_key_exists('error_message', $deletedResult)){
			$this->load->view('error_view', array (
					'error' => $deletedResulte ));
			return;
		}
		// success delete
		$this->session->set_flashdata('message', 'Delete project successful');
		if ($this->input->post('redirect_uri') != false){
			redirect($this->input->post('redirect_uri', true), 'refresh');
		}
		return;
	}
}
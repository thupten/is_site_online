<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

class Projects extends MX_Controller {
	// business logic goes to model. don't put business logic in controller
	function __construct(){
		parent::__construct();
		$this->load->model('Project_model');
		$this->template->set_layout('one_col');
		$this->template->set_partial('header', 'site/blocks/header');
		$this->template->set_partial('footer', 'site/blocks/footer');
	}

	function index(){
		$this->get_projects();
		$token = $this->session->userdata('token');
		if ($token == false){
			redirect('site/login');
		}
	}

	function get_projects($limit = 999999999, $offset = 0){
		$projects = $this->Project_model->get_projects($limit, $offset);
		if (array_key_exists('error_message', $projects)){
			$data ['error'] = $projects;
			$this->template->build('error_view', $data);
			return;
		}
		$data ['rows'] = $projects;
		$this->template->build('projects_list', $data);
	}

	function edit($id){
		$this->load->library('form_validation');
		$this->form_validation->CI = & $this;
		$this->form_validation->set_rules('name', 'Project name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('url', 'Website url', 'trim|required|xss_clean|prep_url');
		$this->form_validation->set_rules('description', 'Description', 'trim');
		$projects = $this->Project_model->get_projects(1, 0, $id);
		if (array_key_exists('error_message', $projects)){
			$this->template->build('error_view', array (
					'error' => $projects ));
			return;
		}
		if ($this->form_validation->run() == false){
			// validation failed
			$project = $projects [0];
			$this->template->build('edit_project_form', array (
					'project' => $project ));
			return;
		} else{
			// validation passed..go on..submit and return status
			$data ['id'] = $this->input->get_post('id', true);
			$data ['name'] = $this->input->get_post('name', true);
			$data ['url'] = $this->input->get_post('url', true);
			$data ['description'] = $this->input->get_post('description', true);
			$updated_projects = $this->Project_model->update_project($data);
			if (array_key_exists('error_message', $updated_projects)){
				$this->template->build('error_view', array (
						'error' => $updated_projects ));
				return;
			}
			$updated_project = $updated_projects [0];
			$this->session->set_flashdata('message', 'Update project successful');
			redirect(site_url('projects/index'), 'refresh');
		}
	}

	/**
	 * direct to that uri after successfully creating new
	 * project.
	 */
	function new_project(){
		$this->load->library('form_validation');
		$this->form_validation->CI = & $this;
		$this->form_validation->set_rules('name', 'Project name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('url', 'Website url', 'trim|required|xss_clean|prep_url');
		$this->form_validation->set_rules('description', 'Description', 'trim');
		if ($this->form_validation->run() == false){
			// validation failed
			$this->template->build('add_project_view');
		} else{
			// validation passed..go on..submit and return status
			$data ['name'] = $this->input->get_post('name', true);
			$data ['url'] = $this->input->get_post('url', true);
			$data ['description'] = $this->input->get_post('description', true);
			$project = $this->Project_model->insert_project($data);
			if (array_key_exists('error_message', $project)){
				$this->template->build('error_view', array (
						'error',
						$project ));
				return;
			}
			$this->session->set_flashdata('message', 'Create project successful');
			redirect(site_url('projects/index'), 'refresh');
		}
	}

	/**
	 * shows confirmation and deletes after confirmation.
	 * @return boolean true or false.
	 */
	function delete($id){
		$method = $this->input->post('_method');
		if ($method === false){
			// not submitted
			$projects = $this->Project_model->get_projects(1, 0, $id);
			if (array_key_exists('error_message', $projects)){
				$this->template->build('error_view', array (
						'error' => $projects ));
				return false;
			}
			$data ['project'] = $projects [0];
			$this->template->build('delete_project_form', $data);
		} else{
			// submitted
			$where ['id'] = $id;
			$deletedResult = $this->Project_model->delete_project($where);
			if (array_key_exists('error_message', $deletedResult)){
				$this->template->build('error_view', array (
						'error' => $deletedResult ));
				return false;
			}
			// success delete
			$this->session->set_flashdata('message', 'Delete project successful');
			redirect(site_url('projects/index'), 'refresh');
			return true;
		}
	}
}
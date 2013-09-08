<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');
class Projects extends MX_Controller {
	// business logic goes to model. don't put business logic in controller
	function __construct() {
		parent::__construct();
		$this->load->model('Project_model');
	}

	function index() {
		echo ":)";
	}

	function get_projects($limit = 999999999999999, $offset = 0) {
		$data['rows'] = $this->Project_model->get_projects_for_current_user($limit, $offset);
		$this->load->view('projects_list', $data);
	}

	function edit_project($id) {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Project name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('url', 'Website url', 'trim|required|xss_clean|prep_url');
		if ($this->form_validation->run() == false) {
			// validation failed
			$this->load->view('edit_project_form', array (
					'id' => $id 
			));
		} else {
			// validation passed..go on..submit and return status
			if ($this->_edit_project_submit() == true) {
				return true;
			} else {
				return false;
			}
		}
	}

	function _edit_project_submit() {
		$where['id'] = $this->input->get_post('id', true);
		$data['name'] = $this->input->get_post('name', true);
		$data['url'] = $this->input->get_post('url', true);
		$data['description'] = $this->input->get_post('description', true);
		$count = $this->Project_model->update_project_for_current_user($data, $where);
		if ($count > 0) {
			$this->session->set_flashdata('message', 'Update project successful');
			return true;
		} else {
			$this->session->set_flashdata('message', 'Error, Update project failed');
			return false;
		}
	}

	function new_project() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Project name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('url', 'Website url', 'trim|required|xss_clean|prep_url');
		if ($this->form_validation->run() == false) {
			// validation failed
			$this->load->view('new_project_form');
		} else {
			// validation passed..go on..submit and return status
			if ($this->_new_project_submit() == true) {
				return true;
			} else {
				return false;
			}
		}
	}

	function _new_project_submit() {
		$data['name'] = $this->input->get_post('name', true);
		$data['url'] = $this->input->get_post('url', true);
		$id = $this->Project_model->insert_project_for_current_user($data);
		if ($id > 0) {
			$this->session->set_flashdata('message', 'Create project successful');
			return true;
		} else {
			$this->session->set_flashdata('message', 'Error, Create project failed');
			return false;
		}
	}

	function delete_project_submit() {
		$where['id'] = $this->input->get_post('id', true);
		$affected_rows = $this->Project_model->delete_project_for_current_user($where);
		if ($affected_rows == 0) {
			// failed delete
			$this->session->set_flashdata('message', 'Delete project failed');
			return false;
		} else {
			// success delete
			$this->session->set_flashdata('message', 'Delete project successful');
			return true;
		}
	}
}
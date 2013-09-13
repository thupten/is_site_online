<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

class Member extends MX_Controller {

	function __construct(){
		parent::__construct();
		// $this->output->enable_profiler(TRUE);
	}

	function _is_edit_submitted(){
		// if edit is submitted then the name,url,description should be there
		$name = $this->input->get_post('name');
		$url = $this->input->get_post('url');
		$description = $this->input->get_post('description');
		if ($name != false && $url != false && $description != false){
			return true;
		}
		return false;
	}

	function _is_edit_option_selected($edit_project_id, $delete_project_id){
		if (($edit_project_id != false && $delete_project_id == false)){
			return true;
		} else{
			return false;
		}
	}

	function index(){
		$token = Modules::run('user/_get_session_token');
		if ($token == false){
			redirect('site/start/index');
			return;
		}
		$edit_project_id = $this->input->get_post('edit_project_id');
		$delete_project_id = $this->input->get_post('delete_project_id');
		// edit
		if ($this->_is_edit_option_selected($edit_project_id, $delete_project_id) || $this->_is_edit_submitted()){
			// edit submitted or edit form load
			$data = array (
					'project_id' => $edit_project_id,
					'redirect_uri' => site_url('site/member/index') );
			$data ['data_header'] = array (
					'title' => 'edit project' );
			$this->load->view('member_edit_project_view', $data);
			return;
		}
		// delete
		if ($edit_project_id == false && $delete_project_id != false){
			return;
		}
		// list of projects
		$data ['data_header'] = array (
				'title' => 'member' );
		$this->load->view('member_view', $data);
	}
}

<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

class Member extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->template->set_layout('one_col');
		$this->template->set_partial('header', 'site/blocks/header');
		$this->template->set_partial('footer', 'site/blocks/footer');
	}

	function index(){
		$token = Modules::run('user/_get_session_token');
		if ($token == false){
			redirect('site/index');
			return;
		}
		$project_id = $this->input->get_post('project_id');
		$task = $this->input->get_post('task');
		$_method = $this->input->post('_method');
		// target is set to $task or _method because..if the form is shown first time $task has value and if its
		// submitted $_method has value. for both of these cases (submitted or firsttime) we forward this to same edit
		// method of the project module. project module will take care of whether its first request or submitted request
		// using form_validation.
		$target = ($task === false) ? $_method : $task;
		if ($target !== false){
			switch($target) {
				case "edit":
				case "put":
					// edit
					$data = array (
							'project_id' => $project_id,
							'redirect_uri' => site_url('member/index') );
					$this->template->title('edit project');
					$this->template->build('member_edit_project_view', $data);
					break;
				case "delete":
					// delete
					$this->template->title('delete project');
					$data = array (
							'project_id' => $project_id,
							'redirect_uri' => site_url('member/index') );
					$this->template->build('member_delete_project_view', $data);
					break;
				case "add":
				case "post":
					// add
					$this->template->title('add project');
					$data ['redirect_uri'] = site_url('member/index');
					$this->template->build('member_add_project_view', $data);
					break;
				default:
				// list of projects
				// do nothing
			}
		} else{
			// list of projects
			$this->template->title('my projects');
			$this->template->build('member_homepage');
		}
	}
}

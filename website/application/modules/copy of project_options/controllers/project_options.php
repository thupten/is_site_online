<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

class Project_options extends MX_Controller {
	// business logic goes to model. don't put business logic in controller
	function __construct(){
		parent::__construct();
		// add more here
	}

	function index($id){
		$this->load->view('option_view', array (
				'project_id' => $id ));
	}
}
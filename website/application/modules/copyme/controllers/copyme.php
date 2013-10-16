<?php

if (! defined('BASEPATH'))
	exit('No direct script access allowed');
class Copyme extends MX_Controller {
	// business logic goes to model. don't put business logic in controller
	function __construct() {
		parent::__construct();
		// add more here
	}

	function do_something($viewfile = "default") {
		$data = array();
		$this->load->view($viewfile, $data);
	}
}
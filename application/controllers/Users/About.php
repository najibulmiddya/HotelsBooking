<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

	// Constructor method
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users/About_model');
	}

	public function index()
	{
		try {
			if ($team_members = $this->About_model->get_contacts()) {
			}
			view('users/about',compact('team_members'),'ABOUT');
		} catch (\Throwable $th) {
			alert("danger", "Server Internal error");
		}

		
	}
}

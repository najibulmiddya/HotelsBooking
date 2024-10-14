<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends CI_Controller
{

	// Constructor method
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users/Contact_model');
	}

	public function index()
	{
		try {
			if ($contact_details = $this->Contact_model->get_contacts()) {
			}
			view('users/contact', compact('contact_details'), 'CONTACT US');
		} catch (\Throwable $th) {
			alert("danger", "Server Internal error");
		}
	}
}

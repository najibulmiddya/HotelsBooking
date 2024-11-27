<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facilities extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin/Facilities_model');
    }

	public function index()
	{
		$data = $this->Facilities_model->get_all_facilitys();
		// pp($data);
		// view('users/facilities',compact('data'),'FACILITIES');
		// view('users/about',[''],'HOTELS ABOUT');
		// view('users/contact',[''],'CONTACT US');
		view('users/rooms',[''],'ROOMS');
	}
}

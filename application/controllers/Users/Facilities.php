<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facilities extends CI_Controller {

	public function index()
	{
		view('users/facilities',[''],'FACILITIES');
	}
}

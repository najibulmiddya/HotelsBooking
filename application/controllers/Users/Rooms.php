<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rooms extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		view('users/rooms', [''], 'ROOMS');
	}
}

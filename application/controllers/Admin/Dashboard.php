<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load the model from the 'Admin' folder
        $this->load->model('Admin/admin_model');
        admin_loggedIn();
        
    }

    public function index()
    {
        adminView('admin/dashboard',[],'ADMIN PANEL - DASHBOARD');
    }

   
}

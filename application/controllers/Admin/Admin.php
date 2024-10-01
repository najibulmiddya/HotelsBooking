<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load the model from the 'Admin' folder
        $this->load->model('Admin/admin_model');
    }

    public function index()
    {
        adminView('admin/index', 'ADMN LOGIN');
    }

    public function login()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $this->form_validation->set_rules('username', 'Admin Name', 'required|trim|htmlspecialchars|min_length[4]|max_length[10]');
                $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[4]|max_length[10]');

                if ($this->form_validation->run() == FALSE) {
                    adminView('admin/index', 'ADMN LOGIN');
                } else {
                    $username = $this->security->xss_clean($this->input->post('username'));
                    $password = $this->security->xss_clean($this->input->post('password'));

                    if ($bd_data = $this->admin_model->get($username)) {
                       
                        if ($bd_data->password === $password) {
                            $adminData = [
                                'adminId' => $bd_data->id,
                                'userName' => $bd_data->username,
                                'ADMIN_LOGIN' => TRUE
                            ];
                            $this->session->set_userdata("loggedInAdmin", $adminData);
                            alert("success", "Logged In Successfully");
                            redirect('dashboard');
                        } else {
                            alert("danger", "Please Enter Valid Password");
                            adminView('admin/index', 'ADMN LOGIN');
                        }
                    } else {
                        alert("danger", "Please Enter Valid Username");
                        adminView('admin/index', 'ADMN LOGIN');
                    }
                }
            } else {
                adminView('admin/index', 'ADMN LOGIN');
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function logout(){
        if($_SESSION['loggedInAdmin']==true){
            unset($_SESSION['loggedInAdmin']);
            redirect('admin');
        }
    }
}

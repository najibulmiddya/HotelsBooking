<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load the model from the 'Admin' folder
        $this->load->model('Admin/settings_model');
        admin_loggedIn();
    }

    public function index()
    {
        adminView('admin/settings', [], 'ADMIN PANEL - SETTINGS');
    }

    public function get()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {

                if ($data = $this->settings_model->get()) {
                    echo jresp(true, "data get Successfully", $data);
                    exit;
                } else {
                    echo jresp(false, "Data get Failed");
                    exit;
                }
            }
        } catch (\Throwable $th) {
            echo jresp(false, "Server Internal error");
            exit;
        }
    }
    public function update()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $data = [
                    'site_title' => $this->security->xss_clean($this->input->post('site_title')),
                    'site_about' => $this->security->xss_clean($this->input->post('site_about')),
                ];

                if ($data = $this->settings_model->update($data)) {
                    echo jresp(true, "Data Updated Successfully", $data);
                    exit;
                } else {
                    echo jresp(false, "Data No Changes were made");
                    exit;
                }
            }
        } catch (\Throwable $th) {
            echo jresp(false, "Server Internal error");
            exit;
        }
    }

    public function update_shutdown()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $shutdown_val = $this->security->xss_clean($this->input->post('shutdown'));
                if ($shutdown_val == 0) {
                    $shutdown = 1;
                } else {
                    $shutdown = 0;
                }

                $data = [
                    'shutdown' => $shutdown,
                ];
                if ($data = $this->settings_model->update($data)) {
                    if ($shutdown) {
                        echo jresp(true, "Site has been Shutdown", $data);
                        exit;
                    } else {
                        echo jresp(true, "Shutdown mode off", $data);
                        exit;
                    }
                } else {
                    echo jresp(false, "Server Internal error");
                    exit;
                }
            }
        } catch (\Throwable $th) {
            echo jresp(false, "Server Internal error");
            exit;
        }
    }

    public function get_contacts()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {

                if ($data = $this->settings_model->get_contacts()) {
                    echo jresp(true, "data get Successfully", $data);
                    exit;
                } else {
                    echo jresp(false, "Data get Failed");
                    exit;
                }
            }
        } catch (\Throwable $th) {
            echo jresp(false, "Server Internal error");
            exit;
        }
    }

    public function contacts_details_update()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $data = [
                    'address' => $this->security->xss_clean($this->input->post('address')),
                    'gmap' => $this->security->xss_clean($this->input->post('gmap')),
                    'ph1' => $this->input->post('pn1'),
                    'ph2' => $this->input->post('pn2'),
                    'email' => $this->input->post('email'),
                    'tw' => $this->input->post('tw'),
                    'fb' => $this->input->post('fb'),
                    'insta' => $this->input->post('insta'),
                    'iframe' => $this->input->post('iframe')
                ];
                if ($data = $this->settings_model->contacts_details_update($data)) {
                    echo jresp(true, "Data Updated Successfully", $data);
                    exit;
                } else {
                    echo jresp(false, "Data No Changes were made");
                    exit;
                }
            }
        } catch (\Throwable $th) {
            echo jresp(false, "Server Internal error");
            exit;
        }
    }

    public function add_member()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $config['upload_path']   = TEAM_IMAGE_SERVER_PATH;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = 1024;
                // $config['max_width']     = 1024;
                // $config['max_height']    = 768;
                $this->load->library('upload', $config);
                $image = rand(111111111, 999999999) . '_' . $_FILES['member_picture_inp']['name'];
                if (! move_uploaded_file($_FILES['member_picture_inp']['tmp_name'], TEAM_IMAGE_SERVER_PATH . $image)) {

                    $error = $this->upload->display_errors();
                    echo jresp(2, "File upload failed: onlay allowed_types ( GIF | JPG | PNG |JPEG )" . $error);
                    exit;
                } else {
                    $data = array(
                        'name' => $this->input->post('member_name_inp'),
                        'picture' => $image
                    );

                    if ($resp = $this->settings_model->add_member($data)) {
                        echo jresp(true, "Member add Successfully", $resp);
                        exit;
                    } else {
                        echo jresp(false, "Member add Failed");
                        exit;
                    }
                }
            }
        } catch (\Throwable $th) {
            echo jresp(false, "Server Internal error");
            exit;
        }
    }

    public function get_member()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                if ($data = $this->settings_model->getall_member()) {
                    echo jresp(true, "data get Successfully", $data);
                    exit;
                } else {
                    echo jresp(false, "Data get Failed");
                    exit;
                }
            }
        } catch (\Throwable $th) {
            echo jresp(false, "Server Internal error");
            exit;
        }
    }

    public function delete_member()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                if ($memberId = $this->input->post('id')) {
                    $member = $this->settings_model->get_member($memberId);
                    $img_path = $member->picture;
                    if (file_exists(TEAM_IMAGE_SERVER_PATH . $img_path)) {
                        unlink(TEAM_IMAGE_SERVER_PATH . $img_path);
                    }

                    if ($data = $this->settings_model->delete_member($memberId)) {

                        echo jresp(true, "Member deleted successfully.", $data);
                        exit;
                    } else {
                        echo jresp(false, "Failed to delete member");
                        exit;
                    }
                } else {
                    echo jresp(false, "Server Internal error");
                    exit;
                }
            }
        } catch (\Throwable $th) {
            echo jresp(false, "Server Internal error");
            exit;
        }
    }
}

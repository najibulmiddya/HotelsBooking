<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Common_model');
        admin_loggedIn();
    }

    public function index()
    {
        adminView('admin/users', [], 'ADMIN PANEL - USERS');
    }

    public function fetch_users()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $users = $this->Common_model->get_multi('users');
            if (!empty($users)) {
                echo json_encode([
                    'status'  => true,
                    'message' => 'Users fetched successfully.',
                    'error'   => '',
                    'data'    => $users
                ]);
            } else {
                echo json_encode([
                    'status'  => false,
                    'message' => 'No users found.',
                    'error'   => '',
                    'data'    => []
                ]);
            }
        } else {
            echo json_encode([
                'status'  => false,
                'message' => 'Invalid request method. Only GET is allowed.',
                'error'   => 'Method Not Allowed',
                'data'    => []
            ]);
        }
    }


    public function toggle_user_status()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');

        if (!$id || $status === null) {
            echo json_encode([
                'status' => false,
                'message' => 'Invalid data provided.'
            ]);
            return;
        }

        $updated = $this->db->update('users', ['status' => $status], ['id' => $id]);

        if ($updated) {
            $msg = $status == 1 ? 'User activated successfully.' : 'User deactivated successfully.';
            echo json_encode(['status' => true, 'message' => $msg]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to update user status.']);
        }
    }



    public function delete_user()
    {
        $id = $this->input->post('id');
        $this->db->delete('users', ['id' => $id]);
        echo json_encode(['success' => true]);
    }
}

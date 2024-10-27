<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_queries extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load the model from the 'Admin' folder
        $this->load->model('Admin/UsersQueries_model');
        admin_loggedIn();
    }

    public function index()
    {
        $queries = $this->UsersQueries_model->get_all();
        if ($queries) {
            adminView('admin/users_queries', compact('queries'), 'ADMIN PANEL - USERS QUERIES');
        } else {
            $queries = '';
            adminView('admin/users_queries', compact('queries'), 'ADMIN PANEL - USERS QUERIES');
        }
    }


    public function user_querie_seen()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                if ($id = $this->input->post('id')) {
                    if ($data = $this->UsersQueries_model->get_user_query($id)) {
                        if ($id == $data->id) {
                            $data = array(
                                'seen' => 1
                            );
                            if ($resp = $this->UsersQueries_model->seen_user_query($id, $data)) {
                                echo jresp(true, "Seen Successfully", $resp);
                                exit;
                            } else {
                                echo jresp(false, "Seen Failed");
                                exit;
                            }
                        }
                    } else {
                        echo jresp(false, "Record not found");
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

    public function delete_user_querie()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                if ($id = $this->input->post('id')) {

                    if ($data = $this->UsersQueries_model->delete_user_querie($id)) {
                        echo jresp(true, "Record deleted successfully!", $data);
                        exit;
                    } else {
                        echo jresp(false, "Failed to delete the record. Please try again.");
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

    // All Record Delete
    public function delete_user_querie_all()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                if ($this->UsersQueries_model->delete_user_querie_all()) {
                    echo jresp(true, "All Records deleted successfully!");
                    exit;
                } else {
                    echo jresp(false, "Failed to delete records.");
                    exit;
                }
            }
        } catch (\Throwable $th) {
            echo jresp(false, "Server Internal error");
            exit;
        }
    }


    public function user_querie_seen_all()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $data = array(
                    'seen' => 1
                );
                
                if ($resp = $this->UsersQueries_model->seen_user_query_all($data)) {
                    echo jresp(true, "Seen Successfully", $resp);
                    exit;
                } else {
                    echo jresp(false, "Seen Failed");
                    exit;
                }
            }
        } catch (\Throwable $th) {
            echo jresp(false, "Server Internal error");
            exit;
        }
    }
}

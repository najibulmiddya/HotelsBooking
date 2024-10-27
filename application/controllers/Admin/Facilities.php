<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Facilities extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load the model from the 'Admin' folder
        $this->load->model('Admin/Facilities_model');
        admin_loggedIn();
    }

    public function index()
    {
        adminView('admin/facilities', [], 'ADMIN PANEL - FACILITIES');
    }

    public function getFeature()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {

                if ($resp = $this->Facilities_model->get_all_feature()) {
                    echo jresp(true, "data get Successfully", $resp);
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

    public function add_feature()
    {
        $feature_name = $this->input->post('feature_name_inp', TRUE);

        $response = ['status' => 'error', 'errors' => []];

        if (empty($feature_name)) {
            $response['errors']['feature_name'] = 'Please provide a feature name.';
            echo json_encode($response);
            return;
        }

        // Check if the feature name already exists in the database
        if ($this->Facilities_model->get_feature_name($feature_name)) {
            $response['errors']['feature_name'] = 'This feature name is already in use. Please choose a different name.';
            echo json_encode($response);
            return;
        }

        $data = [
            'feature_name' => $feature_name
        ];

        if ($resp = $this->Facilities_model->insert_feature($data)) {
            $response['status'] = $resp;
            $response['message'] = 'Feature added successfully';
        } else {
            $response['status'] = false;
            $response['message'] = 'Failed to add feature';
        }

        echo json_encode($response);
    }

    public function get_feature($id = null)
    {
        if ($feature = $this->Facilities_model->get_feature_by_id($id)) {
            pp($feature);
            echo jresp(true, "data get Successfully", $feature);
        } else {
            echo jresp(false, "Feature not found");
            exit;
        }
    }
}

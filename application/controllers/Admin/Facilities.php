<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Facilities extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load the model from the 'Admin' folder
        $this->load->model(['Admin/Facilities_model', 'Admin/Rooms_model']);
        admin_loggedIn();
    }

    public function index()
    {
        adminView('admin/facilities', [], 'ADMIN PANEL - FACILITIES');
    }

    // All Feature Get
    public function getFeature()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {

                if ($resp = $this->Facilities_model->get_all_feature()) {
                    echo jresp(true, "data get Successfully", $resp);
                    exit;
                } else {
                    echo jresp(false, "Date not found!");
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

    // get singel Feature by id
    public function get_feature($id)
    {
        if ($feature = $this->Facilities_model->get_feature_by_id($id)) {
            echo json_encode(['status' => true, 'data' => $feature]);
            exit;
        } else {
            echo json_encode(['status' => false, 'message' => 'Feature not found.']);
            exit;
        }
    }


    // update Feature
    public function update_feature()
    {
        try {
            if ($id = $this->input->post('feature_id')) {
                $feature_name = $this->input->post('feature_name', TRUE);
                // Set validation rules
                $this->form_validation->set_error_delimiters('', '');
                $this->form_validation->set_rules('feature_name', 'Feature Name', 'required|trim');
                if ($this->form_validation->run() === FALSE) {
                    echo json_encode([
                        'status' => false,
                        'errors' => [
                            'feature_name' => form_error('feature_name'),
                        ]
                    ]);
                    return;
                }

                // Check if the feature name already exists in the database
                if ($this->Facilities_model->get_feature_name($feature_name)) {
                    $response['errors']['feature_name'] = 'This feature name is already in use. Please choose a different name.';
                    echo json_encode($response);
                    return;
                }

                $data = [
                    'feature_name' => $this->input->post('feature_name'),
                ];

                if ($resp = $this->Facilities_model->update_feature($id, $data)) {
                    echo jresp(true, "Feature updated successfully.", $resp);
                    exit;
                } else {
                    echo jresp(false, "Failed to update feature..");
                    exit;
                }
            }
        } catch (\Throwable $th) {
            echo jresp(false, "Server Internal error");
            exit;
        }
    }


    // Delete feature with ID from URL
    public function delete_feature($id)
    {
        if ($resp = $this->Rooms_model->get_feature($id)) {
            echo jresp(false, "Feature is Linked to a Room. Deletion not Allowed.");
            exit;
        } else {
            if ($resp = $this->Facilities_model->delete_feature($id)) {
                echo jresp(true, "Feature deleted successfully.", $resp);
                exit;
            } else {
                echo jresp(false, "Failed to delete item.");
                exit;
            }
        }
    }

    // add facilitie
    public function add_facility()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $response = ['success' => false, 'errors' => []];

                $facility_name_inp = $this->input->post('facility_name_inp', TRUE);
                $facility_desc = $this->input->post('facility_desc', TRUE);

                if (empty($facility_name_inp)) {
                    $response['errors']['facility_name_inp'] = 'Please provide a Facility name.';
                    echo json_encode($response);
                    return;
                }

                if (empty($_FILES['facility_icon']['name'])) {
                    $response['errors']['facility_icon'] = 'Please select a facility icon to upload.';
                    echo json_encode($response);
                    return;
                }

                if (empty($facility_desc)) {
                    $response['errors']['facility_desc'] = 'Please provide a Description .';
                    echo json_encode($response);
                    return;
                }

                $icon_path = null;
                if (!empty($_FILES['facility_icon']['name'])) {
                    $config['upload_path']   = FACILIITIES_IMAGE_SERVER_PATH;
                    $config['allowed_types'] = 'svg';
                    $config['max_size'] = 2048; // 2MB
                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('facility_icon')) {
                        $fileData = $this->upload->data();
                        $icon_path = rand(1111, 9999) . '_' . $fileData['file_name'];
                        if (!rename($fileData['full_path'], FACILIITIES_IMAGE_SERVER_PATH . $icon_path)) {
                            $response['errors']['facility_icon'] = "Failed to move the uploaded file.";
                            echo json_encode($response);
                            return;
                        }
                    } else {
                        $upload_error = $this->upload->display_errors('', '');

                        // $response['errors']['facility_icon'] = "File upload failed: " . $upload_error;
                        // echo json_encode($response);
                        // return;

                        if (strpos($upload_error, 'filetype you are attempting to upload is not allowed') !== false) {
                            $response['errors']['facility_icon'] = "Only SVG files are allowed.";
                        } elseif (strpos($upload_error, 'The file you are attempting to upload is larger than the permitted size') !== false) {
                            $response['errors']['facility_icon'] = "The file size exceeds the 2MB limit.";
                        } else {
                            $response['errors']['facility_icon'] = "File upload failed: " . $upload_error;
                        }
                    }
                }
                $data = [
                    'facility_name' => $facility_name_inp,
                    'description' => $facility_desc,
                    'icon' => $icon_path,
                ];
                // Check if the feature name already exists in the database
                if ($this->Facilities_model->get_facility_name($facility_name_inp)) {
                    $response['errors']['facility_name_inp'] = 'This Facility name is already in use. Please choose a different name.';
                    echo json_encode($response);
                    return;
                }

                if ($resp = $this->Facilities_model->insert_facility($data)) {
                    echo jresp(true, "Facility added successfully!'", $resp);
                    exit;
                } else {
                    echo jresp(false, "Facility added successfully!");
                    exit;
                }
                echo json_encode($response);
            }
        } catch (\Throwable $th) {
            echo jresp(false, "Server Internal error");
            exit;
        }
    }

    // All FACILITIES Get
    public function get_all_facilitys()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {

                if ($resp = $this->Facilities_model->get_all_facilitys()) {
                    echo jresp(true, "Facilitys get Successfully", $resp);
                    exit;
                } else {
                    echo jresp(false, "Date not found!");
                    exit;
                }
            }
        } catch (\Throwable $th) {
            echo jresp(false, "Server Internal error");
            exit;
        }
    }

    // get singel facility by id
    public function get_facility($id)
    {
        if ($facility = $this->Facilities_model->get_facility_by_id($id)) {
            echo json_encode(['status' => true, 'data' => $facility]);
            exit;
        } else {
            echo json_encode(['status' => false, 'message' => 'Feature not found.']);
            exit;
        }
    }

    // Delete facility with ID from URL
    public function delete_facility($id)
    {
        if ($id) {
            if ($resp = $this->Rooms_model->get_facility($id)) {
                echo jresp(false, "Facility is Linked to a Room. Deletion not Allowed.");
                exit;
            } else {
                $resp = $this->Facilities_model->get_facility($id);
                $img_path = $resp->icon;
                if (file_exists(FACILIITIES_IMAGE_SERVER_PATH . $img_path)) {
                    unlink(FACILIITIES_IMAGE_SERVER_PATH . $img_path);
                }
                if ($data = $this->Facilities_model->delete_facility($id)) {
                    echo jresp(true, "Facility deleted successfully.", $data);
                    exit;
                } else {
                    echo jresp(false, "Failed to delete Facility");
                    exit;
                }
            }
        } else {
            echo jresp(false, "Server Internal error");
            exit;
        }
    }
}

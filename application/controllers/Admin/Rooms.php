<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rooms extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Admin/Facilities_model','Admin/Rooms_model']);
        admin_loggedIn();
    }

    public function index()
    {
        $features = $this->Facilities_model->get_all_feature();
        $facilities = $this->Facilities_model->get_all_facilitys();
        adminView('admin/rooms', compact('features', 'facilities'), 'ADMIN PANEL - ROOM');
    }

    // add room
    public function add()
    {
        try {
            $response = ['success' => false, 'errors' => []];
            // Validate inputs
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('name', 'Room Name', 'required');
            $this->form_validation->set_rules('area', 'Area', 'required|numeric');
            $this->form_validation->set_rules('price', 'Price', 'required|numeric');
            $this->form_validation->set_rules('quantity', 'Quantity', 'required|numeric');
            $this->form_validation->set_rules('adult', 'Adult (Max)', 'required|numeric');
            $this->form_validation->set_rules('children', 'Children (Max)', 'required|numeric');
            $this->form_validation->set_rules('desc', 'Description', 'required');

            if ($this->form_validation->run() == FALSE) {
                // Validation errors
                $response['errors'] = [
                    'room' => form_error('name'),
                    'area' => form_error('area'),
                    'price' => form_error('price'),
                    'quantity' => form_error('quantity'),
                    'adult' => form_error('adult'),
                    'children' => form_error('children'),
                    'desc' => form_error('desc')
                ];
            } else {
                $features = $this->input->post('features', true);
                $facilities = $this->input->post('facilities', true);
                $data = [
                    'room_name' => $this->input->post('name', true),
                    'area' => $this->input->post('area', true),
                    'price' => $this->input->post('price', true),
                    'quantity' => $this->input->post('quantity', true),
                    'adult' => $this->input->post('adult', true),
                    'children' => $this->input->post('children', true),
                    'description' => $this->input->post('desc', true),
                ];

                if ($resp = $this->Rooms_model->insert_room($data)) {
                    foreach ($features as $key => $val) {
                        $data1 = [
                            'room_id' => $resp,
                            'features_id' => $val,
                        ];
                        $resp2 = $this->Rooms_model->insert_rooms_features($data1);
                    }

                    foreach ($facilities as $key => $val) {
                        $data2 = [
                            'room_id' => $resp,
                            'facilities_id' => $val,
                        ];
                        $resp3 = $this->Rooms_model->insert_rooms_facilities($data2);
                    }
                    if ($resp2) {
                        echo jresp(true, "Room added successfully!", $resp2);
                        exit;
                    }
                } else {
                    echo jresp(false, "Failed to insert room into the database.!");
                    exit;
                }
            }

            echo json_encode($response);
        } catch (\Throwable $th) {
            //throw $th;
            // echo error_resp($th->getMessage());
            // exit;
            echo jresp(false, "Server Internal error");
            exit;
        }
    }

    // all Rooms Get
    public function get_all_rooms()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {

                if ($resp = $this->Rooms_model->get_all_rooms()) {
                    echo jresp(true, "Rooms get Successfully", $resp);
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

    public function toggle_room_status()
    {
        try {
            if ($room_id = $this->input->post('room_id')) {
                $new_status = $this->input->post('status');
                if ($new_status) {
                    $status = "Activate";
                } else {
                    $status = "Deactivate";
                }

                if ($resp2 = $this->Rooms_model->update_room_status($room_id, $new_status)) {
                    echo jresp(true, "Room $status successfully!", $resp2);
                    exit;
                } else {
                    echo jresp(false, "Failed to update room status");
                    exit;
                }
            }
        } catch (\Throwable $th) {
            echo jresp(false, "Server Internal error");
            exit;
        }
    }

    // Delete room
    public function delete_room($room_id)
    {
        try {


            // if ($facilities = $this->Rooms_model->get_room_facilities($room_id)) {
            //     echo jresp(false, "Facilitie is Added in Room");
            //     exit;
            // } elseif ($features = $this->Rooms_model->get_room_features($room_id)) {
            //     echo jresp(false, "feature is Added in Room");
            //     exit;
            // } else {

            // }

            if ($room_id) {
                if ($resp = $this->Rooms_model->delete_room($room_id)) {
                    echo jresp(true, "Room deleted successfully !");
                    exit;
                } else {
                    echo jresp(false, "Failed to delete room");
                    exit;
                }
            }
        } catch (\Throwable $th) {
            echo jresp(false, "Server Internal error");
            exit;
        }
    }

    // room get by room id
    public function get_room_details($room_id)
    {
        try {
            if ($room = $this->Rooms_model->get_room_by_id($room_id)) {
                // Fetch features and facilities for this room
                $features = $this->Rooms_model->get_room_features($room_id);
                $facilities = $this->Rooms_model->get_room_facilities($room_id);

                // Prepare response
                $response = [
                    'status' => true,
                    'data' => [
                        'id' => $room->id,
                        'room_name' => $room->room_name,
                        'area' => $room->area,
                        'price' => $room->price,
                        'quantity' => $room->quantity,
                        'adult' => $room->adult,
                        'children' => $room->children,
                        'desc' => $room->description,
                        'features' => array_column($features, 'features_id'),
                        'feature_name' => array_column($features, 'feature_name'),
                        'facilities' => array_column($facilities, 'facilities_id'),
                        'facility_name' => array_column($facilities, 'facility_name'),

                    ]
                ];
            } else {
                $response = ['status' => false, 'message' => 'Room not found'];
            }
            echo json_encode($response);
        } catch (\Throwable $th) {
            echo jresp(false, "Server Internal error");
            exit;
        }
    }

    public function update_room()
    {
        try {
            if ($roomId = $this->input->post('roomId', true)) {
                // Set validation rules
                $this->form_validation->set_error_delimiters('', '');
                $this->form_validation->set_rules('name', 'Room Name', 'required');
                $this->form_validation->set_rules('area', 'Area', 'required|numeric|greater_than[0]');
                $this->form_validation->set_rules('price', 'Price', 'required|numeric|greater_than[0]');
                $this->form_validation->set_rules('quantity', 'Quantity', 'required|numeric|greater_than[0]');
                $this->form_validation->set_rules('adult', 'Adult', 'required|numeric');
                $this->form_validation->set_rules('children', 'Children', 'required|numeric');
                $this->form_validation->set_rules('desc', 'Description', 'required');

                $this->form_validation->set_rules('features[]', 'Features', 'required', [
                    'required' => 'Please select at least one Feature.'
                ]);
                $this->form_validation->set_rules('facilities[]', 'Facilities', 'required', [
                    'required' => 'Please select at least one Facility.'
                ]);

                if ($this->form_validation->run() == FALSE) {

                    $response['errors'] = [
                        'room_name' => form_error('name'),
                        'e_area' => form_error('area'),
                        'e_price' => form_error('price'),
                        'e_quantity' => form_error('quantity'),
                        'e_adult' => form_error('adult'),
                        'e_children' => form_error('children'),
                        'e_desc' => form_error('desc'),
                        'e_features' => form_error('features'),
                        'e_facilities' => form_error('facilities'),
                    ];
                    echo json_encode($response);
                    exit;
                } else {
                    $roomData = [
                        'room_name' => $this->input->post('name', true),
                        'area' => $this->input->post('area', true),
                        'price' => $this->input->post('price', true),
                        'quantity' => $this->input->post('quantity', true),
                        'adult' => $this->input->post('adult', true),
                        'children' => $this->input->post('children', true),
                        'description' => $this->input->post('desc', true),
                    ];

                    if ($features = $this->input->post('features', true)) {
                        if ($qq = $this->Rooms_model->get_room_features($roomId)) {
                            if ($this->Rooms_model->delete_room_features($roomId)) {
                                foreach ($features as $key => $val) {
                                    $d1 = [
                                        'room_id' => $roomId,
                                        'features_id' => $val,
                                    ];
                                    $resp1 = $this->Rooms_model->insert_rooms_features($d1);
                                }
                            }
                        }
                    }

                    if ($facilities = $this->input->post('facilities', true)) {
                        if ($this->Rooms_model->get_room_facilities($roomId)) {
                            if ($this->Rooms_model->delete_room_facilities($roomId)) {
                                foreach ($facilities as $key => $val) {
                                    $d2 = [
                                        'room_id' => $roomId,
                                        'facilities_id' => $val,
                                    ];
                                    $resp2 = $this->Rooms_model->insert_rooms_facilities($d2);
                                }
                            }
                        }
                    }
                    $room_resp = $this->Rooms_model->room_details_update($roomId, $roomData);

                    if ($room_resp || $resp1 || $resp2) {
                        echo jresp(true, "Room updated successfully!");
                        exit;
                    } else {
                        echo jresp(false, 'Data No Changes were made..');
                        exit;
                    }
                }
            }
        } catch (\Throwable $th) {
            log_message('error', $th->getMessage());
            $this->output
                ->set_content_type('application/json')
                ->set_output(jresp(false, 'Server internal error'));
            exit;
        }
    }

    // add room image
    public function room_image_add()
    {
        header('Content-Type: application/json');

        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $room_id = $this->input->post('room_id', TRUE);

                if (!$room_id) {
                    echo json_encode(['success' => false, 'message' => 'Room ID is missing.']);
                    return;
                }

                if (empty($_FILES['room_image']['name'])) {
                    echo json_encode(['success' => false, 'errors' => ['room_image' => 'Please select a Room Image to upload.']]);
                    return;
                }

                $config['upload_path'] = ROOMS_IMAGE_SERVER_PATH;
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = 2048; // 2MB
                $config['file_name'] = rand(1111, 9999) . '_' . $_FILES['room_image']['name'];

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('room_image')) {
                    $upload_error = $this->upload->display_errors('', '');
                    $error_message = strpos($upload_error, 'filetype you are attempting to upload is not allowed') !== false
                        ? "Only allowed file types are: gif, jpg, jpeg, png."
                        : "File upload failed: " . $upload_error;

                    echo json_encode(['success' => false, 'errors' => ['room_image' => $error_message]]);
                    return;
                }

                $fileData = $this->upload->data();
                $data = [
                    'room_id' => $room_id,
                    'image' => $fileData['file_name'],
                ];

                if ($resp = $this->Rooms_model->image_add($data)) {
                    echo jresp(true, "Room Image added successfully! ", $resp);
                    exit;
                } else {
                    echo jresp(false, "Failed to add Room Image.!");
                    exit;
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'An unexpected error occurred: ' . $e->getMessage()]);
        }
    }

    // get Room image by room_Id
    public function get_room_image($room_id)
    {
        if ($data = $this->Rooms_model->get_room_image($room_id)) {
            echo json_encode(['status' => true, 'data' => $data]);
            exit;
        } else {
            echo json_encode(['status' => false, 'message' => 'Room Image not available.']);
            exit;
        }
    }

    // room image delete
    public function delete_room_image($imageId)
    {
        try {
            if ($imageId) {
                $resp = $this->Rooms_model->get_image($imageId);
                $img_path = $resp->image;
                if (file_exists(ROOMS_IMAGE_SERVER_PATH . $img_path)) {
                    unlink(ROOMS_IMAGE_SERVER_PATH . $img_path);
                }
                if ($data = $this->Rooms_model->deleteImageById($imageId)) {
                    echo jresp(true, "Room Image deleted successfully.", $data);
                    exit;
                } else {
                    echo jresp(false, "Failed to delete Room Image");
                    exit;
                }
            } else {
                echo jresp(false, "Server Internal error");
                exit;
            }
        } catch (\Throwable $th) {
            echo jresp(false, "Server Internal error");
            exit;
        }
    }

    // room thumb set 
    public function room_thumb_set()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $roomId = $this->input->post('room_id');
                $id = $this->input->post('id');
                $thumb = $this->input->post('thumb');

                if (!$roomId || !$id || !isset($thumb)) {
                    echo jresp(false, "Missing required data.");
                    exit;
                }

                if ($unset = $this->Rooms_model->unset_thumb($roomId)) {
                    if ($isUpdated = $this->Rooms_model->set_thumb($roomId, $id, $thumb)) {
                        echo jresp(true, "Thumb Set successfully");
                        exit;
                    } else {
                        echo jresp(false, "Thumb Set Failed");
                        exit;
                    }
                }
            }
        } catch (\Throwable $th) {
            echo jresp(false, "Server Internal error");
            exit;
        }
    }
}

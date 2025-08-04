<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Carousel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load the model from the 'Admin' folder
        $this->load->model('Admin/carousel_model');
        admin_loggedIn();
    }

    public function index()
    {
        adminView('admin/carousel', [], 'ADMIN PANEL - CAROUSEL');
    }



    public function add_image()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // echo"yes";exit;
                $config['upload_path']   = CAROUSEL_IMAGE_SERVER_PATH;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = 1024;
                // $config['max_width']     = 1024;
                // $config['max_height']    = 768;
                $this->load->library('upload', $config);
                $image = rand(1111, 9999) . '_' . $_FILES['carousel_image_inp']['name'];
                if (! move_uploaded_file($_FILES['carousel_image_inp']['tmp_name'], CAROUSEL_IMAGE_SERVER_PATH . $image)) {
                    $error = $this->upload->display_errors();
                    echo jresp('upload failed', "File upload failed: onlay allowed_types ( GIF | JPG | PNG |JPEG )" . $error);
                    exit;
                } else {
                    $data = array(
                        'image' => $image,
                        'status' =>1
                    );

                    if ($resp = $this->carousel_model->add_image($data)) {
                        echo jresp(true, "Image Uploaded Successfully", $resp);
                        exit;
                    } else {
                        echo jresp(false, "Image Uploaded Failed");
                        exit;
                    }
                }
            }
        } catch (\Throwable $th) {
            echo jresp(false, "Server Internal error");
            exit;
        }
    }

    public function get_image()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                if ($data = $this->carousel_model->getall_image(null)) {
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

    public function delete_image()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                if ($memberId = $this->input->post('id')) {
                    $member = $this->carousel_model->get_image($memberId);
                    $img_path = $member->image;
                    if (file_exists(CAROUSEL_IMAGE_SERVER_PATH . $img_path)) {
                        unlink(CAROUSEL_IMAGE_SERVER_PATH . $img_path);
                    }

                    if ($data = $this->carousel_model->delete_image($memberId)) {

                        echo jresp(true, "Image deleted successfully.", $data);
                        exit;
                    } else {
                        echo jresp(false, "Failed to delete Image");
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

    public function carousel_toggle_status()
    {
        $id = $this->input->post('id');
        $image = $this->db->get_where('carousel_image', ['id' => $id])->row();
        if ($image) {
            $new_status = ($image->status == 1) ? 0 : 1;
            $this->db->where('id', $id)->update('carousel_image', ['status' => $new_status]);
            echo json_encode(['status' => true, 'message' => 'Image status updated successfully.']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Image not found.']);
        }
    }
}

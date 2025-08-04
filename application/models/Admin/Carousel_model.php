<?php
defined('BASEPATH') or exit('No direct script access allowed');

// application/models/Admin/Carousel_model.php

class Carousel_model extends CI_Model
{
    private $carousel_image = 'carousel_image';


    //  *************  Carousel   ********************
    public function add_image($data)
    {
        $this->db->insert($this->carousel_image, $data);
        return $this->db->insert_id();
    }

    public function getall_image()
    {
        $this->db->select("*");
        $this->db->from($this->carousel_image);
        return $this->db->get()->result_array();
    }

    public function get_image($id)
    {
        $this->db->select("*");
        $this->db->from($this->carousel_image);
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    public function delete_image($id)
    {
        return $this->db->delete($this->carousel_image, ['id' => $id]);
    }
}

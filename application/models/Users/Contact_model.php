<?php
defined('BASEPATH') or exit('No direct script access allowed');
// application/models/Users/Admin_model.php
class Contact_model extends CI_Model
{
    private $contact_details = 'contact_details';
    private $settings = 'settings';
    private $carousel_image = 'carousel_image';

    public function get_contacts()
    {
        $this->db->select("*");
        $this->db->from($this->contact_details);
        $this->db->where('id', 1);
        return $this->db->get()->row();
    }

    public function get_settings()
    {
        $this->db->select("site_title,site_about");
        $this->db->from($this->settings);
        $this->db->where('id', 1);
        return $this->db->get()->row();
    }

    public function getall_image()
    {
        $this->db->select("*");
        $this->db->from($this->carousel_image);
        return $this->db->get()->result_array();
    }

   
}

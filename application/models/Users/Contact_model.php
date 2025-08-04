<?php
defined('BASEPATH') or exit('No direct script access allowed');
// application/models/Users/Admin_model.php
class Contact_model extends CI_Model
{
    private $contact_details = 'contact_details';
    private $settings = 'settings';
    private $carousel_image = 'carousel_image';
    private $users_query = 'users_query';

    public function get_contacts()
    {
        $this->db->select("*");
        $this->db->from($this->contact_details);
        $this->db->where('id', 1);
        return $this->db->get()->row();
    }

    public function get_settings()
    {
        $this->db->select("site_title,site_about,shutdown");
        $this->db->from($this->settings);
        $this->db->where('id', 1);
        return $this->db->get()->row();
    }

    public function getall_image($status = null)
    {
        $this->db->select("*");
        $this->db->from($this->carousel_image);
        if (($status)) {
            $this->db->where('status', $status);  // cast to string to match ENUM
        }
        return $this->db->get()->result_array();
    }

    public function submit_user_query($data)
    {
        $this->db->insert($this->users_query, $data);
        return $this->db->insert_id();
    }
}

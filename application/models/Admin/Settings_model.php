<?php
defined('BASEPATH') or exit('No direct script access allowed');

// application/models/Admin/Admin_model.php

class Settings_model extends CI_Model
{
    private $settings = 'settings';
    private $contact_details = 'contact_details';
    private $teams_details = 'teams_details';

    // ************* General Settings *************

    public function get()
    {
        $this->db->select("site_title,site_about,shutdown");
        $this->db->from($this->settings);
        return $this->db->get()->row();
    }

    public function update($data)
    {
        $this->db->update($this->settings, $data);
        return $this->db->affected_rows();
    }
    

    // *********************  Contacts details  *******************

    public function get_contacts()
    {
        $this->db->select("*");
        $this->db->from($this->contact_details);
        return $this->db->get()->row();
    }

    public function contacts_details_update($data)
    {
        $this->db->update($this->contact_details, $data);
        return $this->db->affected_rows();
    }


    //  *************  Teams Member  ********************
    public function add_member($data)
    {
        $this->db->insert($this->teams_details, $data);
        return $this->db->insert_id();
    }

    public function getall_member()
    {
        $this->db->select("*");
        $this->db->from($this->teams_details);
        return $this->db->get()->result_array();
    }


    public function get_member($id)
    {
        $this->db->select("*");
        $this->db->from($this->teams_details);
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    public function delete_member($id)
    {
        return $this->db->delete($this->teams_details, ['id' => $id]);
    }


}

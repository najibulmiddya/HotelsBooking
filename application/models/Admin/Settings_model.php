<?php
defined('BASEPATH') or exit('No direct script access allowed');
// application/models/Admin/Admin_model.php
class Settings_model extends CI_Model
{
    private $settings = 'settings';
    private $contact_details = 'contact_details';
    private $teams_details = 'teams_details';


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


    



    // Insert new admin
    public function add_member($data)
    {
        $this->db->insert($this->teams_details, $data);
        return $this->db->insert_id();
    }

    // Update admin details
   

    // Delete an admin by ID
    public function delete($id)
    {
        return $this->db->delete($this->table, ['id' => $id]); // Delete an admin record
    }
}



<?php
defined('BASEPATH') or exit('No direct script access allowed');
// application/models/Admin/Admin_model.php
class Admin_model extends CI_Model
{
    private $table = 'admin';


    // Get all admin users
    public function get_all()
    {
        $this->db->select("id,username");
        $this->db->from($this->table);
        return $this->db->get()->result();
    }

    // Get a single admin by userName
    public function get($username)
    {
        $this->db->where('username', $username);
        $this->db->from($this->table);
        return $this->db->get()->row();
    }

    // Insert new admin
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    // Update admin details
    public function update($id, $data)
    {
        $this->db->where("id", $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    // Delete an admin by ID
    public function delete($id)
    {
        return $this->db->delete($this->table, ['id' => $id]); // Delete an admin record
    }
}

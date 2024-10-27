<?php
defined('BASEPATH') or exit('No direct script access allowed');
// application/models/Admin/Feature_model.php
class Facilities_model extends CI_Model
{

    // Define the table name
    private $table = 'features';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_feature()
    {
        $this->db->select("id,feature_name"); // Select all columns
        $this->db->from($this->table); // From the teams table
        return $this->db->get()->result_array(); // Return the result as an array
    }

    public function get_feature_name($feature_name)
    {
        $this->db->where('feature_name', $feature_name);
        $query = $this->db->get($this->table);
        return $query->num_rows() > 0;
    }

    public function insert_feature($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function get_feature_by_id($id)
    {
        $this->db->select("id");
        $this->db->from($this->table);
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    public function feature_exists($feature_name, $feature_id) {
        $this->db->where('feature_name', $feature_name);
        $this->db->where('id !=', $feature_id); // Ignore current record
        return $this->db->get($this->table)->num_rows() > 0;
    }

    public function update_feature($id, $data) {
        return $this->db->where('id', $id)->update($this->table, $data);
    }
}
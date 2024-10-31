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

    // Function to delete a feature by ID
    public function delete_feature($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
}

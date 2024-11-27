<?php
defined('BASEPATH') or exit('No direct script access allowed');
// application/models/Admin/Feature_model.php
class Facilities_model extends CI_Model
{
    // Define the table name
    private $features = 'features';
    private $facilities = 'facilities';
    private $rooms_facilities = 'rooms_facilities';
    private $rooms_features = 'rooms_features';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_feature()
    {
        $this->db->select("id,feature_name"); // Select all columns
        $this->db->from($this->features); // From the teams table
        return $this->db->get()->result_array(); // Return the result as an array
    }

    public function get_feature_name($feature_name)
    {
        $this->db->where('feature_name', $feature_name);
        $query = $this->db->get($this->features);
        return $query->num_rows() > 0;
    }

    public function insert_feature($data)
    {
        return $this->db->insert($this->features, $data);
    }

    // Function to delete a feature by ID
    public function delete_feature($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->features);
    }

    public function insert_facility($data)
    {
        return $this->db->insert($this->facilities, $data);
    }

    public function get_facility_name($facility_name)
    {
        $this->db->where('facility_name', $facility_name);
        $query = $this->db->get($this->facilities);
        return $query->num_rows() > 0;
    }

    public function get_all_facilitys()
    {
        $this->db->select("id,facility_name,,description,icon");
        $this->db->from($this->facilities);
        return $this->db->get()->result_array();
    }

    // get all facility
    public function get_facility($id)
    {
        $this->db->select("*");
        $this->db->from($this->facilities);
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    // get singal facility by id
    public function get_facility_by_id($id)
    {
        return $this->db
        ->get_where($this->facilities, ['id' => $id])
        ->row_array();
    }

    // Function to delete a feature by ID
    public function delete_facility($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->facilities);
    }

    // get singal feature by id
    public function get_feature_by_id($id)
    {
        return $this->db
        ->get_where($this->features, ['id' => $id])
        ->row_array();
    }

    public function update_feature($id, $data)
    {
        return $this->db
        ->where('id', $id)->update($this->features, $data);
    }
}

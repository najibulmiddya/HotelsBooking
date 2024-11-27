<?php
defined('BASEPATH') or exit('No direct script access allowed');
// application/models/Admin/Rooms_model.php
class Rooms_model extends CI_Model
{

    // Define the table name
    private $table = 'rooms';
    private $rooms_facilities = 'rooms_facilities';
    private $rooms_features = 'rooms_features';
    private $features = "features";
    private $facilities = "facilities";
    private $rooms_images= "rooms_images";

    public function __construct()
    {
        parent::__construct();
    }

    public function insert_room($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function insert_rooms_facilities($data)
    {
        return $this->db->insert($this->rooms_facilities, $data);
    }


    public function insert_rooms_features($data)
    {
        return $this->db->insert($this->rooms_features, $data);
    }

    public function get_all_rooms()
    {
        $this->db->select("*");
        $this->db->from($this->table);
        return $this->db->get()->result_array();
    }

    public function update_room_status($room_id, $status)
    {
        $this->db->where('id', $room_id);
        return $this->db->update($this->table, ['status' => $status]);
    }

    public function delete_room($room_id)
    {
        $this->db->where('id', $room_id);
        return $this->db->delete($this->table);
    }

    public function get_room_by_id($room_id)
    {
        return $this->db->where('id', $room_id)->get($this->table)->row();
    }

    // get singal Feature by roomId
    public function get_room_features($room_id)
    {
        $this->db->select('*');
        $this->db->from("{$this->rooms_features} rf");
        $this->db->join("{$this->features} f", 'rf.features_id = f.id');
        $this->db->where('rf.room_id', $room_id);
        $query = $this->db->get();
        return $query->result_array(); // Returns an array of feature names
    }

    // get singal facilities by roomId
    public function get_room_facilities($room_id)
    {
        $this->db->select('*');
        $this->db->from("{$this->rooms_facilities} rf");
        $this->db->join("{$this->facilities} f", 'rf.facilities_id = f.id');
        $this->db->where('rf.room_id', $room_id);
        $query = $this->db->get();
        return $query->result_array(); // Returns an array of features names
    }

    public function delete_room_features($room_id)
    {
        $this->db->where('room_id', $room_id);
        return $this->db->delete($this->rooms_features);
    }

    public function delete_room_facilities($room_id)
    {
        $this->db->where('room_id', $room_id);
        return $this->db->delete($this->rooms_facilities);
    }
    public function room_details_update($id, $data)
    {
        $this->db->where("id", $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }


    public function get_feature($features_id)
    {
        return $this->db->where('features_id', $features_id)
            ->get($this->rooms_features)->row();
    }

    public function get_facility($facility_id)
    {
        return $this->db->where('facilities_id', $facility_id)
            ->get($this->rooms_facilities)->row();
    }

    // add room image
    public function image_add($data)
    {
        return $this->db->insert($this->rooms_images, $data);
    }
}

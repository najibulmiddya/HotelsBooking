<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Common_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function insertData($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function get($table, $columns, $valu)
    {
        $this->db->select("*");
        $this->db->from($table);
        $this->db->where($columns, $valu);
        return $this->db->get()->row();
    }

    public function getRow($table, $where = [])
    {
        $query = $this->db->get_where($table, $where);
        return $query->row();
    }

    public function updateData($table, $where, $data)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
        return $this->db->affected_rows(); // returns number of updated rows
    }

    public function get_multi($table, $where = [])
    {
        $this->db->select("*");
        $this->db->from($table);

        if (!empty($where)) {
            $this->db->where($where);
            return $this->db->get()->row();
        }

        return $this->db->get()->result_array();
    }


    public function get_latest_room_reviews($limit = 10)
    {
        $this->db->select('users.name, users.profile, room_reviews.id, room_reviews.rating, room_reviews.review, room_reviews.created_at, rooms.room_name, room_reviews.room_id');
        $this->db->from('room_reviews');
        $this->db->join('users', 'users.id = room_reviews.user_id', 'left');
        $this->db->join('rooms', 'rooms.id = room_reviews.room_id', 'left');
        $this->db->order_by('room_reviews.created_at', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result_array();
    }
}

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

    public function updateData($table, $where, $data)
    {
        return $this->db->update($table, $data, $where);
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
}

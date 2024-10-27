<?php
defined('BASEPATH') or exit('No direct script access allowed');

// application/models/Admin/UsersQueries_model.php

class UsersQueries_model extends CI_Model
{
    private $users_query = 'users_query';


    public function get_all()
    {
        $this->db->select("*");
        $this->db->from($this->users_query);
        $this->db->order_by('id', 'DESC'); // Add ORDER BY clause, 'ASC' for ascending or 'DESC' 
        return $this->db->get()->result_array();
    }

    public function get_user_query($id)
    {
        $this->db->select("id");
        $this->db->from($this->users_query);
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    public function seen_user_query($id,$data)
    {
        // $this->db->update($this->users_query, $data);
        // return $this->db->affected_rows();

        $this->db->where('id', $id);
        $this->db->update($this->users_query, $data);
        
        return $this->db->affected_rows();
    }

    public function delete_user_querie($id)
    {
        return $this->db->delete($this->users_query, ['id' => $id]);
    }

    public function delete_user_querie_all()
    {
        return $this->db->empty_table($this->users_query);
    }

    public function seen_user_query_all($data)
    {
        $this->db->update($this->users_query, $data);
        return $this->db->affected_rows();
    }


}

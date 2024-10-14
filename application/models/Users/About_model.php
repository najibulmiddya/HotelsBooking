<?php
defined('BASEPATH') or exit('No direct script access allowed');
// application/models/Users/Admin_model.php
class About_model extends CI_Model
{
    private $teams_details = 'teams_details';

    public function get_contacts()
    {
        $this->db->select("*");
        $this->db->from($this->teams_details);
        return $this->db->get()->result();
    }


}

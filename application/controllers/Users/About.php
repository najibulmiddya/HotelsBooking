<?php
defined('BASEPATH') or exit('No direct script access allowed');

class About extends CI_Controller
{

	// Constructor method
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users/About_model');
	}

	public function index()
	{
		try {
			$team_members = $this->About_model->get_contacts();

			$total_users = $this->db->query("
				SELECT COUNT(id) AS total_users FROM users
			")->row_array();

			$total_rooms = $this->db->select('COUNT(id) as total_rooms')
				->where('status', 1)
				->get('rooms')
				->row_array();

			$total_review = $this->db->query("
				SELECT COUNT(id) AS total_reviews FROM room_reviews
			")->row_array();

			$total_staffs = $this->db->query("
				SELECT COUNT(id) AS total_staffs FROM teams_details
			")->row_array();

			$data['total_users'] = $total_users['total_users'];
			$data['total_rooms'] = $total_rooms['total_rooms'];
			$data['total_review'] = $total_review['total_reviews'];
			$data['total_staffs'] = $total_staffs['total_staffs'];

			view('users/about', compact('team_members', 'data'), 'ABOUT');
		} catch (\Throwable $th) {
			alert("danger", "Server Internal error");
		}
	}
}

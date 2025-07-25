<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Common_model');
        admin_loggedIn();
    }

    public function index()
    {
        adminView('admin/users', [], 'ADMIN PANEL - USERS');
    }

    public function fetch_users()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $users = $this->Common_model->get_multi('users');
            if (!empty($users)) {
                echo json_encode([
                    'status'  => true,
                    'message' => 'Users fetched successfully.',
                    'error'   => '',
                    'data'    => $users
                ]);
            } else {
                echo json_encode([
                    'status'  => false,
                    'message' => 'No users found.',
                    'error'   => '',
                    'data'    => []
                ]);
            }
        } else {
            echo json_encode([
                'status'  => false,
                'message' => 'Invalid request method. Only GET is allowed.',
                'error'   => 'Method Not Allowed',
                'data'    => []
            ]);
        }
    }


    // Uesr activated and deactivated  
    public function toggle_user_status()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');

        if (!$id || $status === null) {
            echo json_encode([
                'status' => false,
                'message' => 'Invalid data provided.'
            ]);
            return;
        }

        $updated = $this->db->update('users', ['status' => $status], ['id' => $id]);

        if ($updated) {
            $msg = $status == 1 ? 'User activated successfully.' : 'User deactivated successfully.';
            echo json_encode(['status' => true, 'message' => $msg]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to update user status.']);
        }
    }

    // user delete 
    public function delete_user()
    {
        $id = $this->input->post('id');
        $this->db->delete('users', ['id' => $id]);
        echo json_encode(['success' => true]);
    }

    // Room review page
    public function room_review()
    {
        adminView('admin/room_review', [], 'ADMIN PANEL - RATE & REVIEW');
    }

    // Fetch all room reviews
    public function fetch_room_reviews()
    {
        $room_id = trim($this->input->get('room_id'));
        $rating = $this->input->get('rating');

        if (!empty($room_id)) {
            $this->db->where('room_reviews.room_id', $room_id);
        }

        if ($rating !== null && $rating !== '') { // to allow rating 0
            $this->db->where('room_reviews.rating', $rating);
        }

        $this->db->select('users.name, room_reviews.id, room_reviews.rating, room_reviews.review, room_reviews.created_at, rooms.room_name,room_reviews.room_id');
        $this->db->from('room_reviews');
        $this->db->join('users', 'users.id = room_reviews.user_id', 'left');
        $this->db->join('rooms', 'rooms.id = room_reviews.room_id', 'left');
        $this->db->order_by('room_reviews.created_at', 'DESC');

        $query = $this->db->get();
        $reviews = $query->result_array();

        if (!empty($reviews)) {
            echo json_encode([
                'status' => true,
                'message' => 'Reviews fetched successfully.',
                'data' => $reviews
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => 'No reviews found.',
                'data' => []
            ]);
        }
    }

    public function fetch_rooms_review_list()
    {
        $this->db->select('rooms.id as room_id, rooms.room_name');
        $this->db->from('room_reviews');
        $this->db->join('rooms', 'rooms.id = room_reviews.room_id', 'left');
        $this->db->group_by('rooms.id'); // To get only unique rooms
        $this->db->order_by('rooms.room_name', 'ASC');

        $query = $this->db->get();
        $rooms = $query->result_array();
        // pp($rooms);
        if (!empty($rooms)) {
            echo json_encode([
                'status' => true,
                'message' => 'Room list fetched successfully.',
                'data' => $rooms
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => 'No rooms found.',
                'data' => []
            ]);
        }
    }

    // Delete room review
    public function delete_room_review()
    {
        $id = $this->input->post('id');
        if (!$id) {
            echo json_encode(['status' => false, 'message' => 'Invalid review ID.']);
            return;
        }

        $this->db->delete('room_reviews', ['id' => $id]);
        if ($this->db->affected_rows() > 0) {
            echo json_encode(['status' => true, 'message' => 'Review deleted successfully.']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to delete review or review not found.']);
        }
    }
}

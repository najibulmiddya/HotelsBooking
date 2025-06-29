<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rooms extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin/Rooms_model');
		$this->load->model('Common_model');
	}

	public function index()
	{
		$allRooms = $this->Rooms_model->get_all_rooms($limit = null, 0, 1);
		$allRoomsData = [];
		// pp($allRooms);
		foreach ($allRooms as $room) {
			$room_status = $room['status'];
			if ($room_status == 1) {
				$room_id = $room['id'];
				$images = $this->Rooms_model->getAllRoomsImages($room_id);
				$room['image'] = !empty($images) ? $images[0]['image'] : '7686_thumbnail.jpg';
				$room['features'] = $this->Rooms_model->get_room_features($room_id);
				$room['facilities'] = $this->Rooms_model->get_room_facilities($room_id);
				$allRoomsData[] = $room;
			}
		}
		// pp($allRooms);
		view('users/rooms', compact('allRoomsData'), 'ROOMS');
	}

	public function room_details($room_id)
	{
		try {
			if (!empty($room_id)) {
				$roomsData['room']       = $this->Rooms_model->get_room_by_id($room_id);
				$roomsData['images']      = $this->Rooms_model->get_room_image($room_id);
				$roomsData['features']   = $this->Rooms_model->get_room_features($room_id);
				$roomsData['facilities'] = $this->Rooms_model->get_room_facilities($room_id);
				view('users/rooms_details', compact('roomsData'), 'ROOMS DETAILS');
			} else {
				redirect('hotels-rooms');
			}
		} catch (\Throwable $th) {
		}
	}

	// User Bookings Rooms
	public function roomBooking($roomId)
	{
		$data = $this->session->userdata('data');
		$user = $this->session->userdata('loggedInuser');

		if (empty($roomId) || (isset($data['shutdown']) && $data['shutdown'] == 1)) {
			redirect(base_url('hotels-rooms'));
		}

		if (!$user || $user['USER_LOGGEDIN'] !== true) {
			redirect(base_url('hotels-rooms'));
		}

		$room = $this->Rooms_model->get_room_by_id($roomId);

		if ($room) {
			$featurse = $this->Rooms_model->get_room_features($roomId);
			$facilities = $this->Rooms_model->get_room_facilities($roomId);
			$images = $this->Rooms_model->getAllRoomsImages($roomId);
			$thumbnail = !empty($images) ? $images[0]['image'] : '7686_thumbnail.jpg';
			$userId = $_SESSION['loggedInuser']['USER_ID'];
			$user = $this->Common_model->get('users', 'id', $userId);
			$_SESSION['room'] = [
				'id' => $room->id,
				'name' => $room->room_name,
				'price' => $room->price,
				'room_thumbnail' => $thumbnail,
				'user_address' => $user->address,
				'payment' => null,
				'available' => false
			];
		} else {
			redirect(base_url('hotels-rooms'));
		}
		view('users/confirm_booking', '', 'CONFIRM BOOKING');
	}
	// check room availability
	public function check_room_availability()
	{
		$checkin  = $this->input->post('checkin');
		$checkout = $this->input->post('checkout');
		$room_id = $_SESSION['room']['id'];

		if (!$checkin || !$checkout || !$room_id) {
			echo json_encode([
				'status' => false,
				'message' => 'Missing required data.'
			]);
			return;
		}

		

		if ($checkin) {
			echo json_encode([
				'status' => true,
				'message' => 'Room is available.'
			]);
		} else {
			echo json_encode([
				'status' => false,
				'message' => 'Room is not available for selected dates.'
			]);
		}
	}
}

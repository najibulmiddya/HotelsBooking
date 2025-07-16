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
		// pp($_SESSION);
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
		$room_id = $_SESSION['room']['id'] ?? null;

		if (!$checkin || !$checkout || !$room_id) {
			echo json_encode([
				'status' => false,
				'message' => 'Missing required data.'
			]);
			return;
		}

		$checkin_ts = strtotime($checkin);
		$checkout_ts = strtotime($checkout);

		if ($checkout_ts <= $checkin_ts) {
			echo json_encode([
				'status' => false,
				'message' => 'Check-out date must be after check-in date.'
			]);
			return;
		}

		// Calculate number of days
		$count_days = ($checkout_ts - $checkin_ts) / (60 * 60 * 24);
		$price_per_night = $_SESSION['room']['price'];

		// Calculate base payment
		$base_payment = $price_per_night * $count_days;

		// Initialize discount logic
		$discount_percent = 0;
		if ($count_days > 10) {
			$discount_percent = 20;
		} elseif ($count_days > 5) {
			$discount_percent = 15;
		} elseif ($count_days >= 3) {
			$discount_percent = 10;
		}

		$discount_amount = ($discount_percent / 100) * $base_payment;
		$final_payment = $base_payment - $discount_amount;

		// Store in session
		$_SESSION['room']['payment'] = $final_payment;
		$_SESSION['room']['available'] = true;
		$_SESSION['room']['discount'] = $discount_amount;

		echo json_encode([
			'status' => true,
			'message' => 'Room is available.',
			'data' => [
				'days' => $count_days,
				'base_price' => $base_payment,
				'discount_percent' => $discount_percent,
				'discount_amount' => $discount_amount,
				'payment' => $final_payment
			]
		]);
	}

}

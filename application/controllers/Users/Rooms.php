<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rooms extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin/Rooms_model');
		$this->load->model('Common_model');
		$this->load->model('Admin/Facilities_model');
	}

	public function index()
	{
		// $allRooms = $this->Rooms_model->get_all_rooms($limit = null, 0, 1);
		// $allRoomsData = [];
		// foreach ($allRooms as $room) {
		// 	$room_status = $room['status'];
		// 	if ($room_status == 1) {
		// 		$room_id = $room['id'];
		// 		$images = $this->Rooms_model->getAllRoomsImages($room_id);
		// 		$room['image'] = !empty($images) ? $images[0]['image'] : '7686_thumbnail.jpg';
		// 		$room['features'] = $this->Rooms_model->get_room_features($room_id);
		// 		$room['facilities'] = $this->Rooms_model->get_room_facilities($room_id);
		// 		$allRoomsData[] = $room;
		// 	}
		// }
		// pp($allRoomsData);
		$facilities = $this->Facilities_model->get_all_facilitys();
		// pp($facilities);
		view('users/rooms', compact('facilities'), 'ROOMS');
	}

	public function get_filtered_rooms()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}

		$checkin    = $this->input->post('checkin');
		$checkout   = $this->input->post('checkout');
		$adults     = (int) $this->input->post('adults');
		$children   = (int) $this->input->post('children');
		$facilities = $this->input->post('facilities'); // array

		$this->db->select('r.*, GROUP_CONCAT(rf.facilities_id) as facility_ids');
		$this->db->from('rooms r');
		$this->db->join('rooms_facilities rf', 'rf.room_id = r.id', 'left');
		$this->db->where('r.status', 1);

		if ($adults > 0) {
			$this->db->where('r.adult', $adults);
		}
		if ($children > 0) {
			$this->db->where('r.children', $children);
		}

		$this->db->group_by('r.id');
		$this->db->order_by('r.id', 'ASC');

		$allRooms = $this->db->get()->result_array();

		// pp($allRooms);
		$filteredRooms = [];

		foreach ($allRooms as $room) {
			$room_id = $room['id'];
			$facility_ids = explode(',', $room['facility_ids'] ?? '');

			// Filter by selected facilities (must match all)
			if (!empty($facilities) && is_array($facilities)) {
				if (!empty(array_diff($facilities, $facility_ids))) {
					continue;
				}
			}

			// Check availability (booking overlap)
			if (!empty($checkin) && !empty($checkout)) {
				$this->db->select('COUNT(*) as total_bookings');
				$this->db->from('booking_order');
				$this->db->where('room_id', $room_id);
				$this->db->where('booking_status', 'confirmed');
				$this->db->where('check_out >', $checkin);
				$this->db->where('check_in <', $checkout);
				$booked = $this->db->get()->row_array();
				$booked_count = (int) $booked['total_bookings'];


				if ($booked_count >= $room['quantity']) {
					continue;
				}
			}

			// Append image/features/facilities
			$images = $this->Rooms_model->getAllRoomsImages($room_id);
			$room['image'] = !empty($images) ? $images[0]['image'] : '7686_thumbnail.jpg';
			$room['features'] = $this->Rooms_model->get_room_features($room_id);
			$room['facilities'] = $this->Rooms_model->get_room_facilities($room_id);

			$filteredRooms[] = $room;
		}

		echo json_encode([
			'status' => true,
			'message' => 'Data fetched successfully',
			'data' => $filteredRooms
		]);
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

		// Step 1: Get total quantity from rooms table
		$this->db->select('quantity, price');
		$this->db->where('id', $room_id);
		$room_data = $this->db->get('rooms')->row_array();

		// pp($room_data);

		if (!$room_data) {
			echo json_encode([
				'status' => false,
				'message' => 'Room not found.'
			]);
			return;
		}

		$total_quantity = (int) $room_data['quantity'];
		$price_per_night = (float) $room_data['price'];
		// Step 2: Count overlapping bookings
		$this->db->select('COUNT(*) as total_bookings');
		$this->db->from('booking_order');
		$this->db->where('booking_status', 'confirmed');
		$this->db->where('room_id', $room_id);
		$this->db->where('check_out >', $checkin);
		$this->db->where('check_in <', $checkout);
		$booked = $this->db->get()->row_array();
		$booked_count = (int) $booked['total_bookings'];

		if ($booked_count >= $total_quantity) {
			echo json_encode([
				'status' => false,
				'message' => "{$_SESSION["room"]["name"]} not available for selected dates."
			]);
			return;
		}

		// Step 3: Calculate payment
		$count_days = ($checkout_ts - $checkin_ts) / (60 * 60 * 24);
		$final_payment = $price_per_night * $count_days;

		// Save to session
		$_SESSION['room']['payment'] = $final_payment;
		$_SESSION['room']['available'] = true;

		echo json_encode([
			'status' => true,
			'message' => 'Room is available.',
			'data' => [
				'days' => $count_days,
				'payment' => $final_payment
			]
		]);
	}
}

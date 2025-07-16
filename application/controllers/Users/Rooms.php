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

	public function pay_new()
	{
		header("Pragma: no-cache");
		header("Cache-Control: no-cache");
		header("Expires: 0");
		// following files need to be included
		require(APPPATH . 'third_party/PaytmKit/lib/config_paytm.php');
		require(APPPATH . 'third_party/PaytmKit/lib/encdec_paytm.php');

		$checkSum = "";
		$paramList = array();

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$user = $this->session->userdata('loggedInuser');

			if (!$user || $user['USER_LOGGEDIN'] !== true) {
				redirect(base_url('home'));
				return;
			}

			// Payment details
			$ORDER_ID = "ORD_" . $user['USER_ID'] . rand(10000, 99999999);
			$CUST_ID = $user['USER_ID'];
			$INDUSTRY_TYPE_ID = INDUSTRY_TYPE_ID;
			$CHANNEL_ID = CHANNEL_ID;
			$TXN_AMOUNT = $_SESSION['room']['payment'];


			$paramList = array(
				"MID" => PAYTM_MERCHANT_MID,
				"ORDER_ID" => $ORDER_ID,
				"CUST_ID" => $CUST_ID,
				"INDUSTRY_TYPE_ID" => $INDUSTRY_TYPE_ID,
				"CHANNEL_ID" => $CHANNEL_ID,
				"TXN_AMOUNT" => $TXN_AMOUNT,
				"WEBSITE" => PAYTM_MERCHANT_WEBSITE,
				"CALLBACK_URL" => base_url(CALLBACK_URL) // Your callback URL
			);

			// Generate checksum
			$checkSum = getChecksumFromArray($paramList, PAYTM_MERCHANT_KEY);

			$orderData = [
				'user_id' => $CUST_ID,
				'room_id' => $_SESSION['room']['id'],
				'check_in' => $this->input->post('checkin'),
				'check_out' => $this->input->post('checkout'),
				'order_id' => $ORDER_ID
			];
			$booking_id = $this->Common_model->insertData('booking_order', $orderData);

			if ($booking_id) {
				$detailsData = [
					'booking_id' => $booking_id,
					'room_name'  => $_SESSION['room']['name'],
					'room_id'    => $_SESSION['room']['id'],
					'room_no'    => $_SESSION['room']['number'] ?? null,
					'price'      => $_SESSION['room']['price'],
					'total_pay'  => $_SESSION['room']['payment'], // or calculate if multiple days
					'user_name'  => $this->input->post('name'),
					'phonenum'   => $this->input->post('number'),
					'adderss'    => $this->input->post('address'),
				];

				$this->Common_model->insertData('booking_details', $detailsData);
			}

			// Load payment view and send data to Paytm
			$data['paramList'] = $paramList;
			$data['checkSum'] = $checkSum;
			$this->load->view('users/payment_redirect', $data); // You must create this view
		} else {
			redirect(base_url('hotels-rooms'));
		}
	}



	public function pay_response()
	{
		unset($_SESSION['room']);
		
		header("Pragma: no-cache");
		header("Cache-Control: no-cache");
		header("Expires: 0");

		require_once(APPPATH . 'third_party/PaytmKit/lib/config_paytm.php');
		require_once(APPPATH . 'third_party/PaytmKit/lib/encdec_paytm.php');

		$paramList = $_POST;
		$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : "";

		$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum);

		if ($isValidChecksum === "TRUE") {
			$order_id = $_POST['ORDERID'];
			$txn_id = $_POST['TXNID'];
			$txn_amount = $_POST['TXNAMOUNT'];
			$status = $_POST['STATUS'];
			$resp_msg = $_POST['RESPMSG'];

			// Validate booking
			$booking = $this->Common_model->getRow('booking_order', ['order_id' => $order_id]);
			if (!$booking) {
				$data['message'] = 'Invalid Booking';
				$data['success'] = false;
				$data['transaction'] = $_POST;
				$this->load->view('users/payment_response', $data);
				return;
			}

			// Regenerate session if not logged in
			$user = $this->session->userdata('loggedInuser');
			if (!$user || $user['USER_LOGGEDIN'] !== true) {
				$user_data = $this->Common_model->getRow('users', ['id' => $booking->user_id]);
				if ($user_data) {
					$userData = [
						'USER_ID'        => $user_data->id,
						'NAME'           => $user_data->name,
						'NUMBER'         => $user_data->number,
						'PROFILE'        => $user_data->profile,
						'USER_LOGGEDIN'  => true
					];
					$this->session->set_userdata("loggedInuser", $userData);
				}
			}

			// Update booking based on status
			$updateData = [
				'trans_id'       => $txn_id,
				'trans_amt'      => $txn_amount,
				'trans_status'   => $status,
				'trans_respmgs'  => $resp_msg,
				'booking_status' => ($status === 'TXN_SUCCESS') ? 'confirmed' : 'failed'
			];

			$this->Common_model->updateData('booking_order', $updateData, ['order_id' => $order_id]);

			$data['transaction'] = $_POST;
			$data['message'] = ($status === 'TXN_SUCCESS') ? 'Transaction Successful' : 'Transaction Failed';
			$data['success'] = ($status === 'TXN_SUCCESS');
		} else {
			$data['message'] = 'Checksum mismatch';
			$data['success'] = false;
			$data['transaction'] = $_POST;
		}

		// Load result view
		$this->load->view('users/payment_response', $data);
	}
}

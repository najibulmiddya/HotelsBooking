<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	// Constructor method
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users/Contact_model');
		$this->load->model('Admin/Rooms_model');
		$this->load->model('Admin/Facilities_model');
		$this->load->model('Common_model');
	}

	public function index()
	{
		try {
			// OUR ROOMS DATA STRAT
			$allRooms = $this->Rooms_model->get_all_rooms(3, 0, 1);
			$roomsData = [];
			// pp($allRooms);
			foreach ($allRooms as $room) {
				$room_status = $room['status'];
				if ($room_status == 1) {
					$room_id = $room['id'];
					$images = $this->Rooms_model->getAllRoomsImages($room_id);
					$room['image'] = !empty($images) ? $images[0]['image'] : '7686_thumbnail.jpg';
					$room['features'] = $this->Rooms_model->get_room_features($room_id);
					$room['facilities'] = $this->Rooms_model->get_room_facilities($room_id);
					$roomsData[] = $room;
				}
			}
			// pp($images);
			$this->session->set_userdata('roomsData', $roomsData);
			// Our Facilities
			$allFacilities = $this->Facilities_model->get_all_facilitys();
			// pp($allFacilities);
			$this->session->set_userdata('facilities', $allFacilities);

			if ($carousel_image = $this->Contact_model->getall_image()) {
			}
			if ($contact_details = $this->Contact_model->get_contacts()) {

				$tw = $contact_details->tw;
				$fb = $contact_details->fb;
				$insta = $contact_details->insta;

				if ($settings_data = $this->Contact_model->get_settings()) {
					// pp($settings_data);
					$site_title = $settings_data->site_title;
					$site_about = $settings_data->site_about;
					$shutdown = $settings_data->shutdown;
				}

				$data = [
					'twitter' => $tw,
					'facebook' => $fb,
					'instagram' => $insta,
					'site_title' => $site_title,
					'site_about' => $site_about,
					'shutdown' => $shutdown
				];
				$this->session->set_userdata('data', $data);
			}

			view('users/index', compact('contact_details', 'carousel_image'), 'HOME');
		} catch (\Throwable $th) {
			alert("danger", "Server Internal error");
		}
	}

	public function user_profile()
	{
		// Check if user is logged in
		if (!$this->session->userdata('loggedInuser')) {
			redirect('home');
		}

		if ($user_id = $_SESSION['loggedInuser']['USER_ID']) {
			// Fetch user data from the database
			$user_data = $this->Common_model->getRow('users', ['id' => $user_id, 'status' => 1, 'is_verified' => 1]);
			// pp($user_data);
		} else {
			redirect('home');
		}
		view('users/user_profile', compact('user_data'), 'PROFILE');
	}

	public function update_profile_Information()
	{
		$post = $this->input->post();

		$user_id = trim($post['user_id']);
		$name = trim($post['name']);
		$number = trim($post['number']);
		$dob = trim($post['dob']);
		$pincode = trim($post['pincode']);
		$address = trim($post['address']);

		// Validate required fields
		if (empty($user_id) || empty($name) || $number === '') {
			echo json_encode(['status' => false, 'message' => 'Missing required fields.']);
			return;
		}

		$new_data = [
			'name'    => $name,
			'number'  => (int)$number,
			'dob'     => $dob,
			'pincode' => $pincode,
			'address' => $address
		];

		$updated = $this->Common_model->updateData('users', ['id' => $user_id], $new_data);

		if ($updated) {
			// Refresh session data if logged in
			$user = $this->session->userdata('loggedInuser');
			if ($user && $user['USER_LOGGEDIN'] === true) {
				$user_data = $this->Common_model->getRow('users', ['id' => $user_id]);
				if ($user_data) {
					$this->session->set_userdata("loggedInuser", [
						'USER_ID'        => $user_data->id,
						'NAME'           => $user_data->name,
						'NUMBER'         => $user_data->number,
						'PROFILE'        => $user_data->profile,
						'USER_LOGGEDIN'  => true
					]);
				}
			}

			echo json_encode(['status' => true, 'message' => 'Profile updated successfully.']);
		} else {
			echo json_encode(['status' => false, 'message' => 'No changes were made.']);
		}
	}


	public function upload_profile_photo()
	{
		$user_id = $this->input->post('user_id');

		// Check if file uploaded
		if (!isset($_FILES['user_profilePhoto']) || $_FILES['user_profilePhoto']['error'] !== 0) {
			echo json_encode(['status' => false, 'message' => 'No file uploaded or file error.']);
			return;
		}

		// Get old user data
		$user = $this->Common_model->getRow('users', ['id' => $user_id]);

		if (!$user) {
			echo json_encode(['status' => false, 'message' => 'Invalid user.']);
			return;
		}

		$old_profile = $user->profile;
		$user_name = preg_replace('/[^a-zA-Z0-9]/', '', $user->name);

		// Upload config
		$config['upload_path']   = USER_PROFILE_SERVER_PATH;
		$config['allowed_types'] = 'jpg|jpeg|png|webp';
		$config['max_size']      = 2048; // 2MB
		$config['file_name']     = rand(1111, 9999) . '_' . preg_replace('/[^a-zA-Z0-9]/', '', $user_name);

		// Load library
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('user_profilePhoto')) {
			echo json_encode([
				'status'  => false,
				'message' => strip_tags($this->upload->display_errors())
			]);
			return;
		}

		$uploadData = $this->upload->data();
		$new_profile = $uploadData['file_name'];

		// Update user record
		$update = $this->Common_model->updateData('users', ['id' => $user_id], ['profile' => $new_profile]);

		if ($update) {
			// Delete old photo if exists and not default
			if (!empty($old_profile) && file_exists(USER_PROFILE_SERVER_PATH . $old_profile)) {
				unlink(USER_PROFILE_SERVER_PATH . $old_profile);
			}
			// Refresh session data if logged in
			$user = $this->session->userdata('loggedInuser');
			if ($user && $user['USER_LOGGEDIN'] === true) {
				$user_data = $this->Common_model->getRow('users', ['id' => $user_id]);
				if ($user_data) {
					$this->session->set_userdata("loggedInuser", [
						'USER_ID'        => $user_data->id,
						'NAME'           => $user_data->name,
						'NUMBER'         => $user_data->number,
						'PROFILE'        => $user_data->profile,
						'USER_LOGGEDIN'  => true
					]);
				}
			}

			echo json_encode([
				'status'  => true,
				'message' => 'Profile photo updated successfully.',
				'file'    => $new_profile
			]);
		} else {
			echo json_encode([
				'status'  => false,
				'message' => 'Failed to update database.'
			]);
		}
	}
}

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

			$reviews = $this->Common_model->get_latest_room_reviews($limit = 10);

			// pp($reviews);
			view('users/index', compact('contact_details', 'carousel_image', 'reviews'), 'HOME');
		} catch (\Throwable $th) {
			alert("danger", "Server Internal error");
		}
	}

	// User Profile Page
	public function user_profile()
	{
		if (!$this->session->userdata('loggedInuser')) {
			redirect('home');
		}

		if ($user_id = $_SESSION['loggedInuser']['USER_ID']) {
			$user_data = $this->Common_model->getRow('users', ['id' => $user_id, 'status' => 1, 'is_verified' => 1]);
		} else {
			redirect('home');
		}
		view('users/user_profile', compact('user_data'), 'PROFILE');
	}

	// Update user profile information
	public function update_profile_Information()
	{
		$post = $this->input->post();

		$user_id = trim($post['user_id']);
		$name = trim($post['name']);
		$number = trim($post['number']);
		$pincode = trim($post['pincode']);
		$address = trim($post['address']);
		$day   = $this->input->post('dob_day');
		$month = $this->input->post('dob_month');
		$year  = $this->input->post('dob_year');

		if ($day && $month && $year && checkdate($month, $day, $year)) {
			$dob = sprintf('%04d-%02d-%02d', $year, $month, $day); // Format: YYYY-MM-DD
		} else {
			$response['errors']['dob'] = 'Please select a valid date.';
		}

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

	// Upload user profile photo
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

	// Send email OTP for profile update
	public function send_email_otp()
	{
		$current_email = $this->input->post('current_email');
		$otp = rand(100000, 999999);
		// Store OTP and timestamp in session
		$this->session->set_userdata('email_otp', $otp);
		$this->session->set_userdata('email_otp_time', time());
		$subject = "Your OTP for Email Change";
		$message = "Hi, your OTP for email update is: <strong>$otp</strong>. Please use this to verify your email change request.";

		if (send_custom_email($current_email, $subject, $message)) {
			echo json_encode(['status' => true, 'message' => 'OTP sent to your current email.']);
		} else {
			echo json_encode(['status' => false, 'message' => 'Failed to send OTP. Please try again.']);
		}
	}

	// Verify email OTP
	public function verify_email_otp()
	{
		$otp_input = $this->input->post('otp');
		$stored_otp = $this->session->userdata('email_otp');
		$stored_time = $this->session->userdata('email_otp_time');
		$current_time = time();

		// Validate OTP existence and expiry
		if (!$stored_otp || !$stored_time || ($current_time - $stored_time) > 600) {
			echo json_encode([
				'status' => false,
				'message' => 'OTP expired. Please request again.'
			]);
			return;
		}

		// Check OTP match
		if ($otp_input != $stored_otp) {
			echo json_encode([
				'status' => false,
				'message' => 'Invalid OTP.'
			]);
			return;
		}

		// Optionally: Mark OTP as verified (can use session flag)
		$this->session->set_userdata('email_otp_verified', true);

		echo json_encode([
			'status' => true,
			'message' => 'OTP verified successfully.'
		]);
	}

	// Update Email
	public function update_email()
	{
		// 1. OTP Verification
		if (!$this->session->userdata('email_otp_verified')) {
			echo json_encode(['status' => false, 'message' => 'OTP verification failed or expired.']);
			return;
		}

		// 2. Input Retrieval
		$new_email     = trim($this->input->post('new_email'));
		$confirm_email = trim($this->input->post('confirm_email'));

		// 4. User Session Validation
		$user = $this->session->userdata('loggedInuser');
		if (!$user || !isset($user['USER_ID'])) {
			echo json_encode(['status' => false, 'message' => 'User not logged in.']);
			return;
		}

		// 5. Check if email already exists
		$exists = $this->db->get_where('users', ['email' => $new_email])->row();
		if ($exists) {
			echo json_encode(['status' => false, 'message' => 'Email is already in use.']);
			return;
		}

		// 6. Update Email + Verification Token
		$otp = rand(100000, 999999);
		$this->session->set_userdata('new_email_verify_otp', $otp);
		$this->session->set_userdata('new_email_verify_otp_time', time());
		$data = [
			'email' => $new_email,
			'is_verified' => 0,
		];

		$updated = $this->db->where('id', $user['USER_ID'])->update('users', $data);

		// 7. If Updated, Send Email
		if ($updated) {
			$name = htmlspecialchars($user['NAME']);
			$subject = "Verify Your New Email";
			$message = "<p>Hello <strong>{$name}</strong>,</p>";
			$message .= "<p>Please use the following OTP to verify your new email address:</p>";
			$message .= "<p><strong>{$otp}</strong></p>";

			$email_sent = send_custom_email($new_email, $subject, $message);

			// Update session email
			$user['email'] = $new_email;
			$this->session->set_userdata('loggedInuser', $user);

			// Optional: Clear OTP
			$this->session->unset_userdata('email_otp');
			$this->session->unset_userdata('email_otp_verified');
			$this->session->unset_userdata('email_otp_time');

			echo json_encode([
				'status'  => true,
				'message' => $email_sent
					? 'Email updated. A verification link has been sent to your new email.'
					: 'Email updated, but failed to send verification email.'
			]);
		} else {
			echo json_encode(['status' => false, 'message' => 'Failed to update email. Try again later.']);
		}
	}

	// Verify New Email OTP
	public function verify_new_email_otp()
	{
		$input_otp = trim($this->input->post('otp'));
		$stored_otp = $this->session->userdata('new_email_verify_otp');
		$stored_time = $this->session->userdata('new_email_verify_otp_time');
		$current_time = time();

		// Validate OTP presence
		if (!$stored_otp || !$stored_time) {
			echo json_encode(['status' => false, 'message' => 'OTP session expired or missing.']);
			return;
		}

		// Expiry: 10 minutes (600 seconds)
		if (($current_time - $stored_time) > 600) {
			$this->session->unset_userdata('new_email_verify_otp');
			$this->session->unset_userdata('new_email_verify_otp_time');
			echo json_encode(['status' => false, 'message' => 'OTP expired. Please update your email again.']);
			return;
		}

		// Compare OTP
		if ($input_otp != $stored_otp) {
			echo json_encode(['status' => false, 'message' => 'Invalid OTP.']);
			return;
		}

		// Mark as verified
		$user = $this->session->userdata('loggedInuser');
		if (!$user || !isset($user['USER_ID'])) {
			echo json_encode(['status' => false, 'message' => 'User session expired.']);
			return;
		}

		// Update verification status in DB
		$this->db->where('id', $user['USER_ID'])->update('users', ['is_verified' => 1]);

		// Cleanup session OTP
		$this->session->unset_userdata('new_email_verify_otp');
		$this->session->unset_userdata('new_email_verify_otp_time');

		echo json_encode(['status' => true, 'message' => 'Your new email has been successfully verified.']);
	}

	// user password change function 
	public function user_change_password()
	{
		$this->load->library('form_validation');
		$user = $this->session->userdata('loggedInuser');

		if (!$user || empty($user['USER_ID'])) {
			echo json_encode(['status' => false, 'message' => 'User not logged in.']);
			return;
		}

		$this->form_validation->set_rules('user_current_password', 'Current Password', 'required');
		$this->form_validation->set_rules('user_new_password', 'New Password', 'required|min_length[8]');
		$this->form_validation->set_rules('user_confirm_password', 'Confirm Password', 'required|matches[user_new_password]');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => false,
				'errors' => [
					'user_current_password'   => form_error('user_current_password'),
					'user_new_password'      => form_error('user_new_password'),
					'user_confirm_password'  => form_error('user_confirm_password')
				]
			]);
			return;
		}

		$user_id = $user['USER_ID'];
		$current_password = $this->input->post('user_current_password', TRUE);
		$new_password = $this->input->post('user_new_password', TRUE);

		// Fetch user from DB
		$db_user = $this->db->get_where('users', ['id' => $user_id])->row();

		if (!$db_user) {
			echo json_encode(['status' => false, 'message' => 'User not found.']);
			return;
		}

		// Verify current password
		if (!password_verify($current_password, $db_user->password)) {
			echo json_encode(['status' => false, 'errors' => [
				'user_current_password' => 'Current password is incorrect.'
			]]);
			return;
		}

		// Prevent using the same password
		if (password_verify($new_password, $db_user->password)) {
			echo json_encode(['status' => false, 'errors' => [
				'user_new_password' => 'New password cannot be the same as the current password.'
			]]);
			return;
		}

		$hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
		$resp = $this->db->where('id', $user_id)->update('users', ['password' => $hashed_password]);
		if ($resp) {
			// Send email notification to user
			$user_email = $db_user->email;
			$user_name = htmlspecialchars($db_user->name);
			$subject = "Your Password Has Been Changed";
			$message = "<p>Hello <strong>{$user_name}</strong>,</p>";
			$message .= "<p>Your password has been changed successfully. If you did not perform this action, please contact support immediately.</p>";

			send_custom_email($user_email, $subject, $message);
			echo json_encode(['status' => true, 'message' => 'Password changed successfully.']);
		} else {
			echo json_encode(['status' => false, 'message' => 'Failed to update password. Please try again.']);
		}
	}
}

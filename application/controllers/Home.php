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
	}

	public function index()
	{
		try {
			// OUR ROOMS DATA STRAT
			$allRooms = $this->Rooms_model->get_all_rooms(3,0,1);
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
					$site_title = $settings_data->site_title;
					$site_about = $settings_data->site_about;
				}

				$data = [
					'twitter' => $tw,
					'facebook' => $fb,
					'instagram' => $insta,
					'site_title' => $site_title,
					'site_about' => $site_about
				];
				$this->session->set_userdata('data', $data);
			}

			view('users/index', compact('contact_details', 'carousel_image'), 'HOME');
		} catch (\Throwable $th) {
			alert("danger", "Server Internal error");
		}
	}
}

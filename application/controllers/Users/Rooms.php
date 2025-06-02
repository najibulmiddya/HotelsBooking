<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rooms extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin/Rooms_model');
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
}

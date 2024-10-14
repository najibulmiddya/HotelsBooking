<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	// Constructor method
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users/Contact_model');
	}

	public function index()
	{
		try {
			if( $carousel_image = $this->Contact_model->getall_image()) {

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
			
			view('users/index', compact('contact_details','carousel_image'), 'HOME');
		} catch (\Throwable $th) {
			alert("danger", "Server Internal error");
		}
	}
}

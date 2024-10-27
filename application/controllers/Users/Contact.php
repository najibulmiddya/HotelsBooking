<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends CI_Controller
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
			if ($contact_details = $this->Contact_model->get_contacts()) {
			}
			view('users/contact', compact('contact_details'), 'CONTACT US');
		} catch (\Throwable $th) {
			alert("danger", "Server Internal error");
		}
	}

	public function contact_from_submit()
	{
		try {
			$this->form_validation->set_rules('name', 'Name', 'required|trim');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
			$this->form_validation->set_rules('subject', 'Subject', 'required|trim');
			$this->form_validation->set_rules('message', 'Message', 'required|trim');

			if ($this->form_validation->run() === FALSE) {
				$response = array(
					'status' => 'validation errors',
					'errors' => array(
						'name' => form_error('name'),
						'email' => form_error('email'),
						'subject' => form_error('subject'),
						'message' => form_error('message')
					)
				);
				echo json_encode($response);
			} else {
				$name = $this->input->post('name');
				$email = $this->input->post('email');
				$subject = $this->input->post('subject');
				$message = $this->input->post('message');

				$data = array(
					'user_name' => $name,
					'user_email' => $email,
					'subjact' => $subject,
					'message' => $message,
					'seen' => 0,
				);

				if ($resp = $this->Contact_model->submit_user_query($data)) {
					echo jresp(true, "Your message has been sent successfully.", $resp);
					exit;
				} else {
					echo jresp(false, "Your message send Failed");
					exit;
				}
			}

			// echo json_encode($response);
		} catch (\Throwable $th) {
			alert("danger", "Server Internal error");
		}
	}
}

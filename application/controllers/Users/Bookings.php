<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bookings extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin/Rooms_model');
        $this->load->model('Common_model');
        check_logged_in_user(); // Validate session
    }

    public function index()
    {
        $bookings = $this->Rooms_model->new_bookings([
            'custom' => [
                'bo.user_id' => $_SESSION['loggedInuser']['USER_ID'],
                'bo.booking_status !=' => 'pending',
            ]
        ], 'DESC');

        // pp($bookings);
        view('users/bookings', ['bookings' => $bookings], 'BOOKINGS');
    }

    public function cancel_booking()
    {
        if ($this->input->method() !== 'post') {
            show_error('Method Not Allowed', 405);
            return;
        }

        $booking_id = $this->input->post('booking_id');

        if (empty($booking_id)) {
            echo json_encode(['status' => false, 'message' => 'Booking ID is required.']);
            return;
        }

        $data = ['booking_status' => 'cancelled', 'refund' => 0];
        $update = $this->Common_model->updateData('booking_order', ['booking_id' => $booking_id], $data);

        if ($update) {
            echo json_encode(['status' => true, 'message' => 'Booking cancelled successfully.']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to cancel booking.']);
        }
    }



    public function request_cancel_booking()
    {
        $booking_id = $this->input->post('booking_id');
        $reason = $this->input->post('cancel_reason');

        if (!$booking_id || !$reason) {
            echo json_encode(['status' => false, 'message' => 'Booking ID and reason are required.']);
            return;
        }

        $booking = $this->Common_model->get('booking_order', 'booking_id', $booking_id);

        // pp($booking);

        if (!$booking) {
            echo json_encode(['status' => false, 'message' => 'Booking not found.']);
            return;
        }

        if($booking->cancel_status == 'requested' || $booking->cancel_status == 'approved' || $booking->cancel_status == 'cancelled') {
            echo json_encode(['status' => false, 'message' => 'Already requested or cancelled.']);
            return;
        }

        $data = [
            'cancel_status' => 'requested',
            'cancel_reason' => $reason,
        ];

        $updated = $this->Common_model->updateData('booking_order', ['booking_id' => $booking_id, 'user_id' => $_SESSION['loggedInuser']['USER_ID']], $data);

        echo json_encode([
            'status' => $updated ? true : false,
            'message' => $updated ? 'Cancellation request sent.' : 'Request failed.'
        ]);
    }
}

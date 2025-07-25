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
        view('users/bookings', ['bookings' => $bookings], 'BOOKINGS');
    }

    // User Booking Cancel Request
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

        if ($booking->cancel_status == 'requested' || $booking->cancel_status == 'approved' || $booking->cancel_status == 'cancelled') {
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

    // Download Booking Invoice
    public function invoice_download($booking_id)
    {
        $booking = $this->Rooms_model->new_bookings(['custom' => [
            'bo.user_id' => $_SESSION['loggedInuser']['USER_ID'],
            ' bo.booking_id' => $booking_id
        ]]);

        // pp($booking);   

        if (!$booking) {
            redirect('user/bookings');
        }

        // Load PDF library and generate invoice
        $this->load->library('pdf');
        $data['bookings'] = $booking[0];
        $html = $this->load->view('users/invoice_template', $data, true);

        // Generate PDF
        $this->pdf->loadHtml($html);
        $this->pdf->render();
        $this->pdf->stream("invoice_{$booking_id}.pdf", ['Attachment' => 0]);
    }

    // Submit Room Review
    public function submit_room_review()
    {
        $booking_id = $this->input->post('booking_id');
        $room_id = $this->input->post('room_id');
        $rating = $this->input->post('rating');
        $review = $this->input->post('review');

        if (!$booking_id || !$room_id || !$rating || !$review) {
            echo json_encode(['status' => false, 'message' => 'All fields are required.']);
            return;
        }
        // Check if booking exists and belongs to user
        $booking = $this->Common_model->get('booking_order', 'booking_id', $booking_id);

        if (!$booking || $booking->user_id != $_SESSION['loggedInuser']['USER_ID']) {
            echo json_encode(['status' => false, 'message' => 'Invalid booking.']);
            return;
        }

        // Check if review already exists for this booking
        $existing = $this->Common_model->getRow('room_reviews', ['booking_id' => $booking_id, 'user_id' => $_SESSION['loggedInuser']['USER_ID']]);
        if ($existing) {
            echo json_encode(['status' => false, 'message' => 'You have already submitted a review for this booking.']);
            return;
        }

        $data = [
            'booking_id' => $booking_id,
            'room_id' => $room_id,
            'user_id' => $_SESSION['loggedInuser']['USER_ID'],
            'rating' => $rating,
            'review' => $review,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $inserted = $this->Common_model->insertData('room_reviews', $data);
        if ($inserted) {
            $data = [
                'rate_review' => 1,
            ];
            $this->Common_model->updateData('booking_order', ['booking_id' => $booking_id, 'user_id' => $_SESSION['loggedInuser']['USER_ID']], $data);
        }

        echo json_encode([
            'status' => $inserted ? true : false,
            'message' => $inserted ? 'Thank you for your review! We appreciate your feedback.' : 'Failed to submit review.',
        ]);
    }
}

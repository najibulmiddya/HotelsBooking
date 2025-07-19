<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bookings extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin/Rooms_model');
        $this->load->model('Common_model');
        admin_loggedIn();
    }

    public function index()
    {
        adminView('admin/booking/new_bookings', [], 'ADMIN PANEL - NEW BOOKINGS');
    }

    // new bookings data fatch
    public function fetch_newBookings()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $newBookings = $this->Rooms_model->new_bookings([
                'booking_status' => 'confirmed',
                'arraval' => 0,

            ]);

            //  pp($newBookings);
            if (!empty($newBookings)) {
                echo json_encode([
                    'status'  => true,
                    'message' => 'New bookings fetched successfully.',
                    'error'   => '',
                    'data'    => $newBookings
                ]);
            } else {
                echo json_encode([
                    'status'  => false,
                    'message' => 'No New bookings found.',
                    'error'   => '',
                    'data'    => []
                ]);
            }
        } else {
            echo json_encode([
                'status'  => false,
                'message' => 'Invalid request method. Only GET is allowed.',
                'error'   => 'Method Not Allowed',
                'data'    => []
            ]);
        }
    }

    // Room Number Assings
    public function assign_room()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $room_number = $this->input->post('room_number');
            $booking_id = $this->input->post('booking_id');

            if (empty($room_number) || empty($booking_id)) {
                echo json_encode([
                    'status' => false,
                    'message' => 'Room number and booking ID are required.'
                ]);
                return;
            }

            // Update both tables
            $data1 = ['room_no' => $room_number];
            $data2 = ['arraval' => 1];
            $update1 = $this->Common_model->updateData('booking_details', ['booking_id' => $booking_id], $data1);
            $update2 = $this->Common_model->updateData('booking_order', ['booking_id' => $booking_id], $data2);

            // Check if both were successful
            if ($update1 && $update2) {
                echo json_encode([
                    'status' => true,
                    'message' => 'Room assigned successfully.'
                ]);
            } else {
                echo json_encode([
                    'status' => false,
                    'message' => 'Failed to assign room. Try again.'
                ]);
            }
        } else {
            show_error('Method Not Allowed', 405);
            return;
        }
    }

    // Booking Cancel (admin)
    public function cancel_booking()
    {
        if ($this->input->method() !== 'post') {
            show_error('Method Not Allowed', 405);
            return;
        }

        $booking_id = $this->input->post('booking_id');
        $action = $this->input->post('action');

        if (empty($booking_id)) {
            echo json_encode(['status' => false, 'message' => 'Booking ID is required.']);
            return;
        }

        // Initialize data based on action
        if ($action === "approved") {
            $data = [
            'booking_status' => 'cancelled',
            'cancel_status' => 'approved',
            'refund' => 0
            ];
            $message = 'Booking cancellation approved successfully.';
        } elseif ($action === "rejected") {
            $data = [
                'cancel_status' => 'rejected',
                'refund' => null,
            ];
            $message = 'Cancellation request rejected successfully.';
        } elseif (empty($action)) {
            // Default to approved if no action provided (fallback)
            $data = [
            'booking_status' => 'cancelled',
            'refund' => 0
            ];
            $message = 'Booking cancelled successfully.';
        } else {
            echo json_encode(['status' => false, 'message' => 'Invalid action.']);
            return;
        }

        // Update booking_order table
        $update = $this->Common_model->updateData('booking_order', ['booking_id' => $booking_id], $data);

        if ($update) {
            echo json_encode(['status' => true, 'message' => $message]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to cancel booking.']);
        }
    }


    public function refund_booking()
    {
        adminView('admin/booking/refund_booking', [], 'ADMIN PANEL - REFUND BOOKINGS');
    }

    // Cancel Bookings Data fetch 
    public function fetch_CancelBookings()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $cancelBookings = $this->Rooms_model->new_bookings([
                'booking_status' => 'cancelled',
                'custom' => [
                    'bo.refund' => 0,
                ]
            ]);

            if (!empty($cancelBookings)) {
                echo json_encode([
                    'status'  => true,
                    'message' => 'Refundable cancelled bookings loaded successfully.',
                    'error'   => '',
                    'data'    => $cancelBookings
                ]);
            } else {
                echo json_encode([
                    'status'  => false,
                    'message' => '🚫 There are no cancelled bookings awaiting refund.',
                    'error'   => '',
                    'data'    => []
                ]);
            }
        } else {
            echo json_encode([
                'status'  => false,
                'message' => 'Invalid request method. Only GET is allowed.',
                'error'   => 'Method Not Allowed',
                'data'    => []
            ]);
        }
    }

    // Cancel Booking refund 
    public function refund_amount()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $booking_id = $this->input->post('booking_id');
            $refund_amount = $this->input->post('refund_amount');

            if (empty($booking_id) || empty($refund_amount)) {
                echo json_encode(['status' => false, 'message' => 'Missing booking ID or refund amount.']);
                return;
            }

            // Update booking status and store refund info
            $data = [
                'refund' => 1
            ];

            $update = $this->Common_model->updateData('booking_order', ['booking_id' => $booking_id], $data);

            if ($update) {
                echo json_encode(['status' => true, 'message' => 'Refund processed successfully.']);
            } else {
                echo json_encode(['status' => false, 'message' => 'Failed to refund booking.']);
            }
        } else {
            show_error('Method Not Allowed', 405);
        }
    }

    public function all_bookings()
    {
        adminView('admin/booking/all_bookings', [], 'ADMIN PANEL - REFUND BOOKINGS');
    }

    // All Bookings Records Fetch
    public function fetch_AllBookings()
    {
        $status     = $this->input->get('status');
        $start_date = $this->input->get('start_date');
        $end_date   = $this->input->get('end_date');

        $filters = [];

        if ($status) {
            $filters['booking_status'] = $status;
        }

        if ($start_date && $end_date) {
            $filters['custom']['DATE(datetime) >='] = $start_date;
            $filters['custom']['DATE(datetime) <='] = $end_date;
        }

        $allBookings = $this->Rooms_model->new_bookings($filters);

        if (!empty($allBookings)) {
            echo json_encode([
                'status' => true,
                'message' => 'Bookings loaded successfully.',
                'data' => $allBookings
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => 'No bookings found.',
                'data' => []
            ]);
        }
    }

    // download Invoice (PDF)
    public function download_pdf($booking_id)
    {
        $this->load->library('pdf');
        $booking = $this->Rooms_model->new_bookings(['custom' => [
            ' bo.booking_id' => $booking_id
        ]]);

        // pp($booking);

        if (!$booking || empty($booking[0])) {
            show_error("Booking not found", 404);
        }

        $data['booking'] = $booking[0];

        $html = $this->load->view('admin/booking/pdf_booking_template', $data, true);


        $this->pdf->loadHtml($html);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->render();
        $this->pdf->stream("Booking_" . date('d.m.Y') . ".pdf", ['Attachment' => 0]);
    }
}

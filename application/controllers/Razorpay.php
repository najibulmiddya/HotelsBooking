<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Razorpay extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Common_model');
    }


    public function pay_new()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->session->userdata('loggedInuser');

            if (!$user || $user['USER_LOGGEDIN'] !== true) {
                redirect(base_url('home'));
                return;
            }

            $order_id = "ORDID" . $user['USER_ID'] . rand(10000, 99999999);
            $amount = $_SESSION['room']['payment'];
            $amount_paise = $amount * 100;

            // Save booking (pending)
            $booking_data = [
                'user_id' => $user['USER_ID'],
                'room_id' => $_SESSION['room']['id'],
                'check_in' => $this->input->post('checkin'),
                'check_out' => $this->input->post('checkout'),
                'order_id' => $order_id,
                'booking_status' => 'pending'
            ];
            $booking_id = $this->Common_model->insertData('booking_order', $booking_data);

            if ($booking_id) {
                $details_data = [
                    'booking_id' => $booking_id,
                    'room_name' => $_SESSION['room']['name'],
                    'room_id' => $_SESSION['room']['id'],
                    'room_no' => $_SESSION['room']['number'] ?? null,
                    'price' => $_SESSION['room']['price'],
                    'total_pay' => $_SESSION['room']['payment'],
                    'user_name' => $this->input->post('name'),
                    'phonenum' => $this->input->post('number'),
                    'adderss' => $this->input->post('address'),
                ];
                $this->Common_model->insertData('booking_details', $details_data);
            }

            // Create Razorpay Order   
            $key_id = 'rzp_test_NIF4Ktol63k9ar';
            $key_secret = 'e6C17e9eTLIpdvHIW0Ns31ZY';
            $orderData = [
                'receipt' => $order_id,
                'amount' => $amount_paise,
                'currency' => 'INR',
                'payment_capture' => 1
            ];

            $ch = curl_init('https://api.razorpay.com/v1/orders');
            curl_setopt($ch, CURLOPT_USERPWD, "$key_id:$key_secret");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($orderData));
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            $response = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($response, true);
            if (!isset($response['id'])) {
                show_error("Razorpay order creation failed.");
                return;
            }

            // Load Razorpay view
            $data = [
                'key_id' => $key_id,
                'razorpay_order_id' => $response['id'],
                'order_id' => $order_id,
                'amount' => $amount,
                'user' => $user
            ];
            $this->load->view('razorpay/razorpay_redirect', $data);
        } else {
            redirect(base_url('hotels-rooms'));
        }
    }

    public function verify()
    {
        unset($_SESSION['room']);
        $input = $this->input->post();
        $key_secret = 'e6C17e9eTLIpdvHIW0Ns31ZY';

        if (!isset($input['razorpay_signature']) || !isset($input['razorpay_order_id']) || !isset($input['razorpay_payment_id'])) {
            echo json_encode(['status' => false, 'message' => 'Missing payment data']);
            return;
        }

        $generated_signature = hash_hmac('sha256', $input['razorpay_order_id'] . "|" . $input['razorpay_payment_id'], $key_secret);

        if (hash_equals($generated_signature, $input['razorpay_signature'])) {
            $order_id = $input['order_id'];

            // Fetch booking
            $booking = $this->Common_model->getRow('booking_order', ['order_id' => $order_id]);
            if (!$booking) {
                echo json_encode(['status' => false, 'message' => 'Invalid booking']);
                return;
            }

            // Restore session if needed
            $user = $this->session->userdata('loggedInuser');
            if (!$user || $user['USER_LOGGEDIN'] !== true) {
                $user_data = $this->Common_model->getRow('users', ['id' => $booking->user_id]);
                if ($user_data) {
                    $this->session->set_userdata("loggedInuser", [
                        'USER_ID' => $user_data->id,
                        'NAME' => $user_data->name,
                        'NUMBER' => $user_data->number,
                        'PROFILE' => $user_data->profile,
                        'USER_LOGGEDIN' => true
                    ]);
                }
            }

            $data = [
                'trans_id' => $input['razorpay_payment_id'],
                'trans_amt' => $input['amount'],
                'trans_status' => 'TXN_SUCCESS',
                'trans_respmgs' => 'Payment captured',
                'booking_status' => 'confirmed'
            ];

            $resp = $this->Common_model->updateData('booking_order', ['order_id' => $order_id], $data);

            echo json_encode(['status' => true, 'message' => 'Payment successful']);
        } else {
            // ❌ Signature mismatch
            $this->Common_model->updateData('booking_order', [
                'trans_status' => 'TXN_FAILED',
                'trans_respmgs' => 'Signature mismatch',
                'booking_status' => 'failed'
            ], ['order_id' => $input['order_id']]);

            echo json_encode(['status' => false, 'message' => 'Signature mismatch']);
        }
    }
}

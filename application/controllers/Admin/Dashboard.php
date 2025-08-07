<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load the model from the 'Admin' folder
        $this->load->model('Admin/admin_model');
        admin_loggedIn();
    }

    public function index()
    {
        // 1. Get shutdown status
        $is_shutdown = $this->db->select('shutdown')->get('settings')->row_array();

        // 2. Get current bookings stats
        $current_bookings = $this->db->query("
            SELECT 
                COUNT(CASE WHEN booking_status = 'confirmed' AND arraval = 1 THEN booking_id END) AS total_booking,

                COUNT(CASE WHEN booking_status='confirmed' AND arraval=0 THEN 1 END) AS new_bookings,
                COUNT(CASE WHEN booking_status='cancelled' AND refund=0 THEN 1 END) AS refund_bookings,

                SUM(CASE WHEN booking_status = 'confirmed' AND arraval = 1 THEN trans_amt ELSE 0 END) AS total_revenue,
                SUM(CASE WHEN booking_status = 'cancelled' AND refund = 0 THEN trans_amt ELSE 0 END) AS  refund_revenue,
                SUM(CASE WHEN booking_status = 'cancelled' AND refund = 1 THEN trans_amt ELSE 0 END) AS  refunded_revenue

            FROM booking_order
        ")->row_array();

        // 3. Get unread user queries
        $unread_queries = $this->db->select('COUNT(id) as count')
            ->where('seen', 0)
            ->get('users_query')
            ->row_array();

        // 4. Get unread reviews
        $unread_reviews = $this->db->select('COUNT(id) as count')
            ->where('seen', 0)
            ->get('room_reviews')
            ->row_array();

        // 5. Get current bookings stats
        $users = $this->db->query("
            SELECT 
                COUNT(id) AS 'total',
                COUNT(CASE WHEN status=1 THEN 1 END) AS active,
                COUNT(CASE WHEN status=0 THEN 1 END) AS inactive,
                COUNT(CASE WHEN is_verified=0 THEN 1 END) AS unverified
            FROM users
        ")->row_array();


        // 4. Get unread reviews
        $total_rooms = $this->db->select('COUNT(id) as count')
            ->where('status', 1)
            ->get('rooms')
            ->row_array();

        $data['is_shutdown'] = $is_shutdown;
        $data['current_bookings'] = $current_bookings;
        $data['unread_queries'] = $unread_queries;
        $data['unread_reviews'] = $unread_reviews;
        $data['users'] = $users;
        $data['total_rooms'] = $total_rooms;

        // pp($total_rooms);

        // pp($data);

        adminView('admin/dashboard', compact('data'), 'ADMIN PANEL - DASHBOARD');
    }


    // public function bookings_chart_data()
    // {
    //     $query = $this->db->query("
    //     SELECT 
    //         DATE_FORMAT(datetime, '%Y') AS year,
    //         DATE_FORMAT(datetime, '%m-%Y') AS month,
    //         DATE_FORMAT(datetime, '%d-%m-%Y') AS day,
    //         YEARWEEK(datetime, 1) AS week,

    //         -- Revenue
    //         SUM(CASE WHEN booking_status = 'confirmed' AND arraval = 1 THEN trans_amt ELSE 0 END) AS total_revenue,
    //         SUM(CASE WHEN booking_status = 'cancelled' AND refund = 0 THEN trans_amt ELSE 0 END) AS processed_refunds,
    //         SUM(CASE WHEN booking_status = 'cancelled' AND refund = 1 THEN trans_amt ELSE 0 END) AS refunded_revenue,

    //         -- Booking Stats
    //         COUNT(CASE WHEN booking_status = 'confirmed' AND arraval = 1 THEN 1 END) AS confirmed_bookings,
    //         COUNT(CASE WHEN booking_status = 'confirmed' AND arraval = 0 THEN 1 END) AS new_bookings,
    //         COUNT(CASE WHEN booking_status = 'cancelled' THEN 1 END) AS cancelled_bookings

    //     FROM booking_order
    //     GROUP BY year, month, day, week
    //     ORDER BY STR_TO_DATE(day, '%d-%m-%Y') ASC
    // ")->result_array();

    //     echo json_encode($query);
    // }


    public function bookings_chart_data()
    {
        $start_date = $this->input->get('start_date'); // Expected in d-m-Y
        $end_date = $this->input->get('end_date');     // Expected in d-m-Y

        $where_clause = "";

        if (!empty($start_date) && !empty($end_date)) {
            $start = DateTime::createFromFormat('d-m-Y', $start_date)->format('Y-m-d') . ' 00:00:00';
            $end   = DateTime::createFromFormat('d-m-Y', $end_date)->format('Y-m-d') . ' 23:59:59';
            $where_clause = "WHERE datetime BETWEEN '$start' AND '$end'";
        }

        $query = $this->db->query("
        SELECT 
            DATE_FORMAT(datetime, '%Y') AS year,
            DATE_FORMAT(datetime, '%m-%Y') AS month,
            DATE_FORMAT(datetime, '%d-%m-%Y') AS day,
            YEARWEEK(datetime, 1) AS week,

            -- Revenue
            SUM(CASE WHEN booking_status = 'confirmed' AND arraval = 1 THEN trans_amt ELSE 0 END) AS total_revenue,
            SUM(CASE WHEN booking_status = 'cancelled' AND refund = 0 THEN trans_amt ELSE 0 END) AS processed_refunds,
            SUM(CASE WHEN booking_status = 'cancelled' AND refund = 1 THEN trans_amt ELSE 0 END) AS refunded_revenue,

            -- Booking Stats
            COUNT(CASE WHEN booking_status = 'confirmed' AND arraval = 1 THEN 1 END) AS confirmed_bookings,
            COUNT(CASE WHEN booking_status = 'confirmed' AND arraval = 0 THEN 1 END) AS new_bookings,
            COUNT(CASE WHEN booking_status = 'cancelled' THEN 1 END) AS cancelled_bookings

        FROM booking_order
        $where_clause
        GROUP BY year, month, day, week
        ORDER BY STR_TO_DATE(day, '%d-%m-%Y') ASC
    ")->result_array();

        echo json_encode($query);
    }
}

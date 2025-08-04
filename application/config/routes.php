<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
| https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//url/FolderName/ControllerName/FunctionName
// Front-End
$route['facilities'] = 'Users/facilities/index';
$route['hotels-rooms'] = 'Users/rooms/index';
$route['rooms/get_filtered_rooms'] = 'Users/rooms/get_filtered_rooms';
$route['hotels/about'] = 'Users/about/index';
$route['contact'] = 'Users/contact/index';
$route['contact-from-submit'] = 'Users/contact/contact_from_submit';
$route['test'] = 'Users/rooms/test';
$route['room-details/(:num)'] = 'Users/rooms/room_details/$1';

// Users Registration Management Routes
$route['user-registration'] = 'Admin/admin/user_Registration';
$route['check-email-exists'] = 'Admin/admin/check_email_exists';
$route['user-login'] = 'Admin/admin/userLogin';
$route['user-logout'] = 'Admin/admin/user_logout';
$route['verify-email/(:any)'] = 'Admin/admin/verify_email/$1';
$route['forgot-password'] = 'Admin/admin/forgot_password';
$route['check-reset-token'] = 'Admin/admin/check_reset_token';
$route['update-password'] = 'Admin/admin/update_password';

// Room Booking Management Routes
$route['booking/room/(:num)'] = 'Users/Rooms/roomBooking/$1';
$route['check-room-availability'] = 'Users/Rooms/check_room_availability';
$route['razorpay/pay'] = 'razorpay/pay_new';
$route['razorpay/verify'] = 'razorpay/verify';

// Booking Management Routes
$route['user/bookings'] = 'Users/Bookings/index';
$route['user/request-cancel-booking'] = 'Users/Bookings/request_cancel_booking';
$route['user/download-booking-invoice/(:num)'] = 'Users/Bookings/invoice_download/$1';
$route['user/submit-room-review'] = 'Users/Bookings/submit_room_review';

// User Profile Management Routes
$route['user/profile'] = 'Home/user_profile';
$route['user/update-profile'] = 'Home/update_profile_Information';
$route['user/upload-profile-photo'] = 'Home/upload_profile_photo';
$route['user/send-email-otp'] = 'Home/send_email_otp';
$route['user/verify-email-otp'] = 'Home/verify_email_otp';
$route['user/update-email'] = 'Home/update_email';
$route['user/verify-new-email-otp'] = 'Home/verify_new_email_otp';
$route['user/change-password'] = 'Home/user_change_password';



// Admin Panel Routes
$route['admin'] = 'Admin/admin/index';
$route['admin/login'] = 'Admin/admin/login';
$route['logout'] = 'Admin/admin/logout';
$route['dashboard'] = 'Admin/dashboard/index';
$route['settings'] = 'Admin/settings/index';
$route['settings-get'] = 'Admin/settings/get';
$route['settings-update'] = 'Admin/settings/update';
$route['settings-update-shutdown'] = 'Admin/settings/update_shutdown';
$route['settings-get_contacts'] = 'Admin/settings/get_contacts';
$route['settings-contacts-details-update'] = 'Admin/settings/contacts_details_update';
$route['settings-add-member'] = 'Admin/settings/add_member';
$route['settings-get-member'] = 'Admin/settings/get_member';
$route['settings-delete-member'] = 'Admin/settings/delete_member';
$route['carousel'] = 'Admin/carousel/index';
$route['carousel-add-image'] = 'Admin/carousel/add_image';
$route['carousel-get-image'] = 'Admin/carousel/get_image';
$route['carousel-delete-image'] = 'Admin/carousel/delete_image';
$route['carousel-toggle-status'] = 'Admin/carousel/carousel_toggle_status';



$route['users-queries'] = 'Admin/users_queries/index';
$route['users-querie-delete'] = 'Admin/users_queries/delete_user_querie';
$route['users-querie-seen'] = 'Admin/users_queries/user_querie_seen';
$route['users-querie-delete-all'] = 'Admin/users_queries/delete_user_querie_all';
$route['users-querie-seen-all'] = 'Admin/users_queries/user_querie_seen_all';
$route['admin-facilities'] = 'Admin/facilities/index';
$route['add-feature'] = 'Admin/facilities/add_feature';
$route['get-all-feature'] = 'Admin/facilities/getFeature';
$route['delete-feature/(:num)'] = 'Admin/facilities/delete_feature/$1';
$route['add-facility'] = 'Admin/facilities/add_facility';
$route['get-all-facilitys'] = 'Admin/facilities/get_all_facilitys';
$route['delete-facility/(:num)'] = 'Admin/facilities/delete_facility/$1';
$route['get-feature/(:num)'] = 'Admin/facilities/get_feature/$1';
$route['update-feature'] = 'Admin/facilities/update_feature';
$route['get-facility/(:num)'] = 'Admin/facilities/get_facility/$1';
$route['update-facility'] = 'Admin/facilities/update_facility';
$route['rooms'] = 'Admin/Rooms/index';
$route['room-add'] = 'Admin/Rooms/add';
$route['get-all-rooms'] = 'Admin/Rooms/get_all_rooms';
$route['update-room-status'] = 'Admin/Rooms/toggle_room_status';
$route['delete-room/(:num)'] = 'Admin/Rooms/delete_room/$1';
$route['get-room-details/(:num)'] = 'Admin/Rooms/get_room_details/$1';
$route['room-data-update'] = 'Admin/Rooms/update_room';
$route['room-image-add'] = 'Admin/Rooms/room_image_add';
$route['get-room-images/(:num)'] = 'Admin/Rooms/get_room_image/$1';
$route['room-image-delete/(:num)'] = 'Admin/Rooms/delete_room_image/$1';
$route['set-room-thumb'] = 'Admin/Rooms/room_thumb_set';

// User Management Routes
$route['users'] = 'Admin/Users/index';
$route['admin/fetch-users']         = 'Admin/Users/fetch_users';
$route['admin/toggle-user-status']  = 'Admin/Users/toggle_user_status';
$route['admin/delete-user']         = 'Admin/Users/delete_user';

// Bookings Management Routes
$route['admin/new-bookings'] = 'Admin/Bookings/index';
$route['admin/fetch-new-booking'] = 'Admin/Bookings/fetch_newBookings';
$route['admin/assign-room'] = 'Admin/Bookings/assign_room';
$route['admin/cancel-booking'] = 'Admin/Bookings/cancel_booking';
$route['admin/refund-bookings'] = 'Admin/Bookings/refund_booking';
$route['admin/fetch-cancel-bookings'] = 'Admin/Bookings/fetch_CancelBookings';
$route['admin/refund-amount'] = 'Admin/Bookings/refund_amount';
$route['admin/all-bookings'] = 'Admin/Bookings/all_bookings';
$route['admin/fetch-all-booking'] = 'Admin/Bookings/fetch_AllBookings';
$route['admin/download-pdf/(:num)'] = 'admin/bookings/download_pdf/$1';

//  Room Rate & Review Management Routes
$route['admin/room-rate-review'] = 'Admin/Users/room_review';
$route['admin/fetch-room-reviews'] = 'Admin/Users/fetch_room_reviews';
$route['admin/delete-room-review'] = 'Admin/Users/delete_room_review';
$route['admin/fetch-room-review-list'] = 'Admin/Users/fetch_rooms_review_list';


$route['admin/bookings-chart-data'] = 'Admin/dashboard/bookings_chart_data';


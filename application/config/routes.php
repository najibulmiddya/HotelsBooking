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
$route['hotels-about'] = 'Users/about/index';
$route['contact'] = 'Users/contact/index';
$route['contact-from-submit'] = 'Users/contact/contact_from_submit';
$route['test'] = 'Users/rooms/test';

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


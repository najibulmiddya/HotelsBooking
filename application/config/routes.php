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
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
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

//  url/FolderName/ControllerName/FunctionName
$route['facilities'] = 'Users/facilities';
$route['contact'] = 'Users/contact/index';
$route['about'] = 'Users/about/index';


// Admin Panel
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


<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Helpers General_helper
 *
 * This Helpers for ...
 * 
 * @package   CodeIgniter
 * @category  Helpers
 * @author    
 *
 */

// ------------------------------------------------------------------------
//  Image Path Set
define('SERVER_PATH', $_SERVER['DOCUMENT_ROOT'] . '/HotelsBooking/');
define('SITE_PATH', 'http://localhost/HotelsBooking/');

// Team image path
define('TEAM_IMAGE_SERVER_PATH', SERVER_PATH . 'assets/images/teams/');
define('TEAM_IMAGE_SITE_PATH', SITE_PATH . '/assets/images/teams/');

// Carousel image path
// Server path
define('CAROUSEL_IMAGE_SERVER_PATH', SERVER_PATH . 'assets/images/carousel/');
// Site path
define('CAROUSE_IMAGE_SITE_PATH', SITE_PATH . '/assets/images/carousel/');


if (!function_exists('pp')) {
  /**
   * pp - data show for development purposesss
   *  @param any $data -- required
   *  @return mixed
   */
  function pp($data = null)
  {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    exit;
  }
}

if (!function_exists('view')) {
  /**
   * view
   *
   * This view helpers for auto add heder and footer
   *
   * @param   string $body_path
   * @param   array $body_data
   * @param   string $title
   * @return  ...
   */
  function view($body_path, $body_data = [], $title = "Portal")
  {
    $ci = get_instance();
    $ci->load->view("users/include/header", ["title" => $title]);
    $ci->load->view($body_path, $body_data);
    $ci->load->view("users/include/footer");
  }
}

if (!function_exists('adminView')) {
  /**
   * view
   *
   * This view helpers for auto add heder and footer
   *
   * @param   string $body_path
   * @param   array $body_data
   * @param   string $title
   * @return  ...
   */
  function adminView($body_path, $body_data = [], $title = "Admin Pnael")
  {
    $ci = get_instance();
    $ci->load->view("admin/include/header", ["title" => $title]);
    $ci->load->view($body_path, $body_data);
    $ci->load->view("admin/include/footer");
  }
}

if (!function_exists('admin_loggedIn')) {
  /**
   * has_loggedIn
   *
   * This has_loggedIn for Has logged id or not
   *
   * @return  array
   */
  function admin_loggedIn()
  {
    $ci = get_instance();
    $type = $ci->session->flashdata('type');
    $message = $ci->session->flashdata('message');
    if ($ci->session->has_userdata('loggedInAdmin')) {
      if ($data = $ci->session->userdata('loggedInAdmin')) {
        return $data;
        redirect(base_url('dashboard'));
      } else {
        redirect(base_url('admin/login'));
      }
    } else {
      redirect(base_url('admin/login'));
    }
    session_regenerate_id(true);
  }
}

if (!function_exists('dataFilter')) {
  /**
   * dataFilter
   *
   * This dataFilter 
   *
   * @return  array
   */
  function dataFilter($data)
  {
    foreach ($data as $key => $val) {
      $data[$key]=trim($val);
      $data[$key]=stripcslashes($val);
      $data[$key]=htmlspecialchars($val);
      $data[$key]=strip_tags($val);
    }
    return $data;
  }
}


if (!function_exists('alert')) {
  /**
   * alert
   *
   * This alert for flash message
   *
   * @param   string $type - success/danger/warning/info
   * @param   array $message
   * @return  ...
   */
  function alert($type, $message)
  {
    $ci = get_instance();
    $ci->session->set_flashdata('type', $type);
    $ci->session->set_flashdata('message', $message);
  }
}

if (!function_exists('bs_alert')) {
  /**
   * bs_alert
   *
   * This bs_alert for bootstrap alert message show
   *
   * @return  string
   */
  function bs_alert()
  {
    $ci = get_instance();
    $type = $ci->session->flashdata('type');
    $message = $ci->session->flashdata('message');
    if (!empty($type) && !empty($message)) {
      return "<div class='alert alert-{$type}' role='alert'>{$message}</div>";
    } else {
      return "";
    }
  }
}





// responce message json or array
if (!function_exists('jresp')) {
  /**
   * jresp - covert array to json object
   * @param bool $status true/false
   * @param string $message 
   * @param string|array|object $resp 
   * 
   */
  function jresp($status = false, $message = "", $resp = null)
  {
    // header('Content-Type: application/json; charset=utf-8');
    return json_encode([
      'status' => $status,
      'message' => $message,
      'response' => $resp
    ]);
  }

  if (!function_exists('is_active')) {
    function is_active($controller, $method = '')
    {
      $CI = &get_instance();
      $current_controller = $CI->router->fetch_class();
      $current_method = $CI->router->fetch_method();

      if ($controller == $current_controller && ($method == '' || $method == $current_method)) {
        return 'active';
      }
      return '';
    }
  }
}



// ------------------------------------------------------------------------

/* End of file General_helper.php */
/* Location: ./application/helpers/General_helper.php */
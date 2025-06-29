<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin/admin_model');
        $this->load->model('Common_model');
    }

    public function index()
    {
        adminView('admin/index', 'ADMN LOGIN');
    }

    //  admin login 
    public function login()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $this->form_validation->set_error_delimiters('', '');
                $this->form_validation->set_rules('username', 'Admin Name', 'required|trim|htmlspecialchars|min_length[4]|max_length[10]');
                $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[4]|max_length[10]');

                if ($this->form_validation->run() == FALSE) {
                    adminView('admin/index', 'ADMN LOGIN');
                } else {
                    $username = $this->security->xss_clean($this->input->post('username'));
                    $password = $this->security->xss_clean($this->input->post('password'));

                    if ($bd_data = $this->admin_model->get($username)) {

                        if ($bd_data->password === $password) {
                            $adminData = [
                                'adminId' => $bd_data->id,
                                'userName' => $bd_data->username,
                                'ADMIN_LOGIN' => TRUE
                            ];
                            $this->session->set_userdata("loggedInAdmin", $adminData);
                            alert("success", "Logged In Successfully");
                            redirect('dashboard');
                        } else {
                            alert("danger", "Please Enter Valid Password");
                            adminView('admin/index', 'ADMN LOGIN');
                        }
                    } else {
                        alert("danger", "Please Enter Valid Username");
                        adminView('admin/index', 'ADMN LOGIN');
                    }
                }
            } else {
                adminView('admin/index', 'ADMN LOGIN');
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    // admin logout 
    public function logout()
    {
        if ($_SESSION['loggedInAdmin'] == true) {
            unset($_SESSION['loggedInAdmin']);
            redirect('admin');
        }
    }

    // <<------- User Registration ---------->>
    public function user_Registration()
    {
        try {
            if ($this->input->server('REQUEST_METHOD') === 'POST') {
                $name  = $this->input->post('name', true);
                $email = $this->input->post('email', true);
                $profileImage = '';

                // Upload Config
                $config['upload_path']   = USER_PROFILE_SERVER_PATH;
                $config['allowed_types'] = 'webp|jpg|jpeg|png';
                $config['max_size']      = 2048;
                $config['file_name']     = rand(1111, 9999) . '_' . preg_replace('/[^a-zA-Z0-9]/', '', $name);

                $this->load->library('upload', $config);

                if (!empty($_FILES['profile']['name'])) {
                    if (!$this->upload->do_upload('profile')) {
                        echo json_encode([
                            'status' => false,
                            'message' => strip_tags($this->upload->display_errors())
                        ]);
                        return;
                    } else {
                        $uploadData = $this->upload->data();
                        $profileImage = $uploadData['file_name'];
                    }
                }
                $verify_token = md5(rand(1000, 9999) . time());
                $user_data = [
                    'name'             => $name,
                    'email'            => $email,
                    'number'           => $this->input->post('number', true),
                    'address'          => $this->input->post('address', true),
                    'pincode'          => $this->input->post('pincode', true),
                    'dob'              => $this->input->post('dob', true),
                    'password'         => password_hash($this->input->post('password', true), PASSWORD_BCRYPT),
                    'profile'          => $profileImage,
                    'status'           => 1,
                    'is_verified'      => 0,
                    'verify_token'     => $verify_token,
                    'email_token_created_at' => date('Y-m-d H:i:s'),
                    'create_at'        => date('Y-m-d H:i:s')
                ];

                $insert_id = $this->Common_model->insertData('users', $user_data);
                if ($insert_id) {
                    $verify_link = base_url('verify-email/' . $verify_token);
                    $message = "<p>Hello <strong>{$name}</strong>,</p>";
                    $message .= "<p>Please click the link below to verify your email address (valid for 10 minutes):</p> </br>";
                    $message .= "<p><a href='{$verify_link}'>{$verify_link}</a></p>";
                    $sent = $this->_send_email($email, 'Email Verification', $message);
                    echo json_encode([
                        'status'  => true,
                        'message' => $sent ? 'Registered. Please check your email to verify.' : 'Registered, but email not sent.'
                    ]);
                } else {
                    echo json_encode(['status' => false, 'message' => 'Database insert failed.']);
                }
            } else {
                echo json_encode(['status' => false, 'message' => 'Invalid request method.']);
            }
        } catch (\Throwable $th) {
            echo json_encode(['status' => false, 'message' => $th->getMessage()]);
        }
    }

    // <------- verify email --------->
    public function verify_email($token)
    {
        $user = $this->Common_model->get('users', 'verify_token', $token);
        if ($user) {
            $createdAt = strtotime($user->email_token_created_at);
            $now       = time();
            $minutes   = ($now - $createdAt) / 60;
            if ($minutes > 10) {
                $this->load->view('users/include/email_verification_result', [
                    'status'  => 'error',
                    'message' => 'Token expired. Please request a new verification email.'
                ]);
                return;
            }

            if ($user->is_verified == 0) {
                $this->Common_model->updateData('users', ['verify_token' => $token], [
                    'is_verified'      => 1,
                    'verify_token'     => null,
                    'email_token_created_at' => null
                ]);

                $this->load->view('users/include/email_verification_result', [
                    'status'  => 'success',
                    'message' => 'Your email has been successfully verified.',
                    'redirect_url' => base_url('home'),
                    'redirect_delay' => 10
                ]);
            } else {
                $this->load->view('email_verification_result', [
                    'status'  => 'success',
                    'message' => 'Email already verified.'
                ]);
            }
        } else {
            $this->load->view('users/include/email_verification_result', [
                'status'  => 'error',
                'message' => 'Invalid or expired token.'
            ]);
        }
    }

    // <------- email send ---------->
    private function _send_email($to, $subject, $message)
    {
        $this->load->library('email');
        $this->email->from('hospitalmh79604904@gmail.com', 'Hotels Booking');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            return true;
        } else {
            log_message('error', $this->email->print_debugger());
            return false;
        }
    }
    // check in email exists 
    public function check_email_exists()
    {
        $email = $this->input->post('email');
        $exists = $this->db->where('email', $email)->get('users')->num_rows() > 0;
        echo json_encode(['exists' => $exists]);
    }

    // <<------------- User Login ----------->>
    public function userLogin()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $email = $this->input->post('email', true);
                $password = $this->input->post('password', true);
                $bd_data = $this->Common_model->get('users', 'email', $email);
                if ($bd_data) {

                    // Check if Account Status
                    if ($bd_data->status == 0) {
                        $contact_link = base_url('contact');
                        $msg = 'Your account is blocked by admin. Please <a href="' . $contact_link . '">contact support</a>.';
                        echo json_encode([
                            'status' => false,
                            'error' => 'status',
                            'message' => $msg
                        ]);
                        return;
                    }
                    // Check if email is verified
                    if ($bd_data->is_verified == 0) {
                        echo json_encode(['status' => false, 'error' => 'is_verified', 'message' => 'Please verify your email before login.']);
                        return;
                    }

                    // Verify password
                    if (password_verify($password, $bd_data->password)) {
                        $userData = [
                            'USER_ID'        => $bd_data->id,
                            'NAME'           => $bd_data->name,
                            'NUMBER'         => $bd_data->number,
                            'PROFILE'         => $bd_data->profile,
                            'USER_LOGGEDIN'  => TRUE
                        ];
                        $this->session->set_userdata("loggedInuser", $userData);
                        echo json_encode(['status' => true, 'message' => 'Logged In Successfully.']);
                    } else {
                        echo json_encode(['status' => false, 'error' => 'password', 'message' => 'Please enter valid password.']);
                    }
                } else {
                    echo json_encode(['status' => false, 'error' => 'email', 'message' => 'Email not found.']);
                }
            }
        } catch (\Throwable $th) {
            echo json_encode(['status' => false, 'message' => $th->getMessage()]);
        }
    }

    public function user_logout()
    {
        $CI = &get_instance();
        $loggedUser = $this->session->userdata('loggedInuser');
        if ($loggedUser && isset($loggedUser['USER_LOGGEDIN']) && $loggedUser['USER_LOGGEDIN'] == true) {
            $this->session->unset_userdata('loggedInuser');
        }
    }


    public function forgot_password()
    {
        try {
            $email = $this->input->get('email', true);
            $page = $this->input->get('page', true);

            $user = $this->Common_model->get('users', 'email', $email);
            if ($user) {
                if ($user->is_verified == 0) {
                    echo json_encode([
                        'status' => false,
                        'error' => 'verify_error',
                        'message' => 'Please verify your email before using forgot password.'
                    ]);
                    return;
                }

                // Create token and update DB
                $reset_token = md5(rand(1000, 9999) . time());
                $token_data = [
                    'reset_token'      => $reset_token,
                    'reset_token_created_at' => date('Y-m-d H:i:s')
                ];
                $this->Common_model->updateData('users', ['email' => $email], $token_data);

                // Generate link and send mail
                $reset_link = $page . '?reset-token=' . $reset_token . '&email=' . urlencode($email);
                $message = "<p>Hello <strong>{$user->name}</strong>,</p>";
                $message .= "<p>Please click the link below to reset your password (valid for 10 minutes):</p>";
                $message .= "<p><a href='{$reset_link}'>{$reset_link}</a></p>";

                $sent = $this->_send_email($email, 'Reset Password', $message);

                echo json_encode([
                    'status'  => true,
                    'message' => $sent ? 'Reset link sent to your email.' : 'User found, but email failed to send.'
                ]);
            } else {
                echo json_encode([
                    'status' => false,
                    'error' => 'email',
                    'message' => 'Email not found in our records.'
                ]);
            }
        } catch (\Throwable $th) {
            echo json_encode([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    // check password reset token 
    public function check_reset_token()
    {
        $token = $this->input->get('token', true);
        $email = $this->input->get('email', true);
        if ($user = $this->Common_model->get_multi('users', ['reset_token' => $token, 'email' => $email])) {
            // pp($user);
            $createdAt = strtotime($user->reset_token_created_at);
            $now = time();
            $minutes = ($now - $createdAt) / 60;

            if ($minutes <= 10) {
                echo json_encode(['status' => true]);
            } else {
                echo json_encode(['status' => false, 'message' => 'Reset token expired.']);
            }
        } else {
            echo json_encode(['status' => false, 'message' => 'Invalid reset token.']);
        }
    }

    // Update New Password 
    public function update_password()
    {
        $email = $this->input->post('reset_email', true);
        $token = $this->input->post('reset_token', true);
        $password = $this->input->post('new_password', true);

        if (!$email || !$token || !$password) {
            echo json_encode(['status' => false, 'message' => 'Missing data.']);
            return;
        }

        $user = $this->db->get_where('users', ['email' => $email, 'reset_token' => $token])->row();
        if (!$user) {
            echo json_encode(['status' => false, 'message' => 'Invalid token or user.']);
            return;
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $this->db->where('email', $email);
        $updated = $this->db->update('users', [
            'password' => $hashedPassword,
            'reset_token' => null,
            'reset_token_created_at' => null
        ]);

        if ($updated) {
            $subject = "Your Password Has Been Successfully Updated";
            $message = "
            <p>Dear User,</p>
            <p>This is a confirmation that your password has been successfully updated.</p>
            <p>If you did not make this change, please contact our support team immediately.</p>
            <br>
            <p>Regards,<br>Hotels Booking Team</p>
            ";
            $this->email->initialize(['mailtype' => 'html']); // Enable HTML email
            $sent = $this->_send_email($email, $subject, $message);
        }

        echo json_encode(['status' => $updated ? true : false, 'message' => $updated ? 'Password updated successfully!' : 'Password Update failed']);
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
    }

    public function confirmregister()
{
    $fullName = $this->input->post('fullName');
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $is_registered = $this->UserModel->createUser($fullName, $username, $password);

    if ($is_registered) {
        echo json_encode(array('is_registered' => true, 'redirect_url' => base_url() . 'index.php/auth/signin'));
    } else {
        echo json_encode(array('is_registered' => false, 'error_msg' => 'Registration failed.'));
    }
}

    public function signin()
    {
        if (isset($this->session->login_error) && $this->session->login_error == true) {
            // $this->session->login_error = false;
            $this->session->unset_userdata('login_error');
            $this->load->view('includes/header.php');
            $this->load->view(
                'login',
                array('login_error_msg' => "Username or Password is incorrect. Please try again.")
            );
            $this->load->view('includes/footer.php');
        } elseif ($this->UserModel->is_logged_in()) {
            redirect('');
        } else {
            $this->load->view('includes/header.php');
            $this->load->view('login');
            $this->load->view('includes/footer.php');
        }
    }

    // public function authenticate()
    // {
    //     $username = $this->input->post('username');
    //     $password = $this->input->post('password');
    //     if ($this->UserModel->authenticateUser($username, $password)) {
    //         $this->session->is_logged_in = true;
    //         $this->session->username = $username;
    //         redirect('');
    //     } else {
    //         $this->session->login_error = true;
    //         redirect('/auth/signin');
    //     }
    // }
    public function authenticate()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $is_logged_in = $this->UserModel->authenticateUser($username, $password);
    
        if ($is_logged_in) {
            $this->session->is_logged_in = true;
            $this->session->username = $username;
            echo json_encode(array('is_logged_in' => true));
        } else {
            $this->session->login_error = true;
            echo json_encode(array('is_logged_in' => false, 'error_msg' => 'Invalid username or password.'));
        }
    }

    public function userAccount()
    {
        $username = $this->session->username;
        $fullName = $this->UserModel->getUserName($username);

        $this->load->view('includes/header.php', array('isSignedIn' => $this->UserModel->is_logged_in()));
        $this->load->view('account', array('fullName' => $fullName));
        $this->load->view('includes/footer.php');
    }

    public function editname()
    {
        $username = $this->session->username;
        $newFullName = $this->input->post('fullName');
        $this->UserModel->changeFulLName($username, $newFullName);

        header('Content-Type: application/json');
        echo json_encode($this->UserModel->getUserName($username));
    }

    public function editpassword()
    {
        $username = $this->session->username;
        $oldPassword = $this->input->post('oldPassword');
        $newPassword = $this->input->post('newPassword');
        $success = $this->UserModel->editPassword($username, $oldPassword, $newPassword);

        if ($success) {
            $this->session->is_logged_in = false;
            header('Content-Type: application/json');
            echo json_encode("Password Changed Successfully");
        } else {
            // Display error msg
        }
    }

    public function signout()
    {
        $this->session->is_logged_in = false;
        redirect('');
    }
}

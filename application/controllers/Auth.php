<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {


    public function __construct(){
        parent::__construct();

        if($this->session->userdata('u_id'))
            redirect('/');

        $this->load->model('auth_model');
    }

    public function index()
    {
        $this->login();
    }

    public function login(){
        $this->load->view('auth/login');
    }

    public function doLogin(){
        $username = $_POST['u_username'];
        $password = md5($_POST['u_password']);

        $login = $this->auth_model->checkUserLogin($username, $password);

        if($login){
            $userdata = (array)reset($login);

            $ses = array(
                'u_id' => $userdata['emp_id'],
                'u_position'    => $userdata['emp_position'],
                'u_username'    => $userdata['emp_username'],
                'u_firstname'    => $userdata['ui_firstname'],
                'u_middlename'    => $userdata['ui_middlename'],
                'u_lastname'    => $userdata['ui_lastname'],
                'u_extname'    => $userdata['ui_extname'],
            );
            $this->session->set_userdata($ses);

            echo true;
        }else{
            echo false;
        }

    }

    public function logout(){ echo 'lkajs'; die;
        $this->session->sess_destroy();
        redirect('Auth/login');
    }


}

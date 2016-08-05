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
            $this->session->set_userdata($userdata);

            echo true;
        }else{
            echo false;
        }

    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('Auth/login');
    }


}

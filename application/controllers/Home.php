<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {


    public function __construct(){
        parent::__construct();
        $this->load->model('procurement_plan_model','ppmp_model');
    }

    public function index()
    {
        $this->load->view('index');
    }

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bids extends MY_Controller {

    public function __construct(){

        parent::__construct();
    }

    public function content(){
        $this->load->view('biddings/default');
    }

    public function getBids(){
        $this->load->model('biddings_model');

        $bids = $this->biddings_model->getBiddings();


        $resultSet['total'] = count($bids);
        $resultSet['rows'] = $bids;

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultSet) );
    }
}

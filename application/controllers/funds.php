<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Funds extends MY_Controller {


    public function __construct(){
        parent::__construct();
        $this->load->model('source_funds_model', 'funds_model');
    }

    public function getSourceFunds($fund_id = null){

        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        $funds = $this->funds_model->getFunds($page);

        $funds_data = array();
        foreach($funds as $fund){
            $temp = array(
                'name'  => $fund->fund_id,
                'value' => $fund->fund_name
            );

            if($fund->fund_id == $fund_id){
                $temp['selected'] = true;
            }

            $funds_data[] = $temp;

        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($funds_data) );
    }

}

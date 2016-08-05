<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Offices extends MY_Controller {


    public function __construct(){
        parent::__construct();
        $this->load->model('offices_model');
    }

    public function getComboboxOffices($ofc_id = null){

        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        $offices = $this->offices_model->getLimitOffices($page);

        $office_data = array();

        foreach($offices as $office){
            $temp = array(
                'name'  => $office->ofc_id,
                'value' => $office->ofc_name
            );

            if($office->ofc_id == $ofc_id){
                $temp['selected'] = true;
            }

            $office_data[] = $temp;

        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($office_data) );
    }

}

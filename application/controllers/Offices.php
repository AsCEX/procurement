<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Offices extends MY_Controller {


    public function __construct(){
        parent::__construct();
        $this->load->model('offices_model');
    }

    public function index() {
        $this->load->view('offices/default');
    }

    public function getOffices() {
        $offices = $this->offices_model->getOffices();

        $resultSet['rows'] = $offices;
        $resultSet['total'] = count($offices);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultSet) );
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

    public function dialog($ofc_id = 0){

        $office = $this->offices_model->getOfficeById($ofc_id);

        $data['office'] = ($office) ? $office : array();
        $data['ofc_id'] = $ofc_id;

        $this->load->view('offices/dialog/add', $data);
    }

    public function saveOffice() {

        $post = $_POST;
        $office = $this->offices_model->save($post, isset($post['ofc_id']) ? $post['ofc_id'] : null);

        if($office){
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('status'=>'success', 'lastid' => $office->ofc_id )) );
        }
    }

    public function deleteOffice() {

        $post = $_POST;
        $office = $this->offices_model->delete($post);

        if ( $office ) {
            $this->output
                ->set_content_type('application/json')
                ->set_output( json_encode( array( 'status' => 'success' ) ) );
        }
    }

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Units extends MY_Controller {

    public function __construct(){

        parent::__construct();

        $this->load->model('units_model');
    }

    public function index() {
        $this->load->view('units/default');
    }


    public function getUnits($unit_id = null){

        $unit_id = ($unit_id) ? $unit_id : 1; // set default unit to unit_id 1
        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        $units = $this->units_model->getLimitUnits($page);

        $unit_data = array();


        foreach($units as $unit){
            $temp = array(
                'name'  => $unit->unit_id,
                'value' => $unit->unit_name
            );

            if($unit->unit_id == $unit_id){
                //$temp['selected'] = true;
            }

            $unit_data[] = $temp;

        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($unit_data) );

    }

    public function getUnitsGrid() {

        $units = $this->units_model->getUnits();

        $resultSet['rows'] = $units;
        $resultSet['total'] = count($units);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultSet) );
    }

    public function addUnit($id=null)
    {
        $data['units'] = $this->units_model->getUnitById($id);
        $this->load->view('units/modal/add', $data);
    }

    public function saveUnit(){

        $post = $_POST;

        $data = array(
            'unit_name' => $post['unit_name']
        );

        $rs = $this->units_model->save($data, $post['unit_id']);

        if($rs){
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('action'=>$post['action'], 'status'=>'success', 'lastid' => $rs )) );
        }
    }

    public function deleteUnit() {

        $post = $_POST;
        $unit = $this->units_model->delete($post);

        if ( $unit ) {
            $this->output
                ->set_content_type('application/json')
                ->set_output( json_encode( array( 'status' => 'success') ) );
        }
    }

    public function dialog($unit_id = 0){

        $unit = $this->units_model->getUnitById($unit_id);

        $data['unit'] = ($unit) ? $unit : array();
        $data['unit_id'] = $unit_id;

        $this->load->view('units/dialog/add', $data);
    }
}

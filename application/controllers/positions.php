<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Positions extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('positions_model');
    }

    public function index() {
        $this->load->view('positions/default');
    }

    public function getPositions(){

        $positions = $this->positions_model->getPositions();

        $resultSet['rows'] = $positions;
        $resultSet['total'] = count($positions);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultSet) );
    }

    public function getPositionsComboBox($pos_id = null) {

        $positions = $this->positions_model->getPositions();

        $pos_data = array();

        foreach ($positions as $position) {

            $temp = array(
                'name' => $position->pos_id,
                'value' => $position->pos_name
            );

            if ($position->pos_id == $pos_id) {
                $temp['selected'] = true;
            }

            $pos_data[] = $temp;
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($pos_data) );
    }

    public function savePosition() {

        $post = $_POST;
        $position = $this->positions_model->save($post, isset($post['pos_id']) ? $post['pos_id'] : null);

        if($position){
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('status'=>'success', 'lastid' => $position->pos_id )) );
        }
    }

    public function dialog($pos_id = 0){

        $positions = $this->positions_model->getPositionById($pos_id);

        $data['positions'] = ($positions) ? $positions : array();
        $data['pos_id'] = $pos_id;

        $this->load->view('positions/dialog/add', $data);
    }
}
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class employees extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('employees_model');
    }

    public function index() {
        
        $this->load->view('employees/default');
    }
    
    public function getEmployees() {

        $employees = $this->employees_model->getEmployees();

        $resultSet['rows'] = $employees;
        $resultSet['total'] = count($employees);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultSet) );
    }
    
    public function saveEmployee() {
        
        $post = $_POST;
        $emp_id = $this->employees->save($post, $post['emp_id']);

        if ( $emp_id ) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode( array( 'status' => 'success', 'last_id' => $emp_id ) ) );
        }
    }

}
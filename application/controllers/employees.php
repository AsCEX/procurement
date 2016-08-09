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
    
    public function getEmployeesGrid() {

        $employees = $this->employees_model->getEmployees();

        $resultSet['rows'] = $employees;
        $resultSet['total'] = count($employees);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultSet) );
    }
    
    public function saveEmployee() {
        
        $post = $_POST;
//        print_r($post);die;
        $emp_id = $this->employees->save($post, $post['emp_id'], $post['emp_ui_id']);

        if ( $emp_id ) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode( array( 'status' => 'success', 'last_id' => $emp_id ) ) );
        }
    }

    public function dialog($emp_id = 0){

        $employee = $this->employees_model->getEmployeeById($emp_id);

        $data['employee'] = ($employee) ? $employee : array();
        $data['emp_id'] = $employee['emp_id'];
        $data['emp_ui_id'] = $employee['emp_ui_id'];

        $this->load->view('employees/dialog/add', $data);
    }

}
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
        $emp_id = $this->employees_model->save($post, $post['emp_id'], $post['emp_ui_id']);

        if ( $emp_id ) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode( array( 'status' => 'success', 'last_id' => $emp_id ) ) );
        }
    }

    public function deleteEmployee() {

        $post = $_POST;
        $emp = $this->employees_model->delete($post);

        if ( $emp ) {
            $this->output
                ->set_content_type('application/json')
                ->set_output( json_encode( array( 'status' => 'success' ) ) );
        }
    }

    public function checkUsername() {

        $username = $this->employees_model->checkUsername( $_POST['username'] );

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode( array( 'result' => $username ) ) );
    }

    public function dialog($emp_id = 0){

        $employee = $this->employees_model->getEmployeeById($emp_id);

        $data['employee'] = ($employee) ? $employee : array();

        $this->load->view('employees/dialog/add', $data);
    }

}
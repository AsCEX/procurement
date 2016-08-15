<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suppliers extends MY_Controller {

    public function __construct(){

        parent::__construct();

        $this->load->model('suppliers_model');
    }

    public function index() {
        $this->load->view('suppliers/default');
    }

    public function getSuppliersGrid() {

        $suppliers = $this->suppliers_model->getSuppliersGrid();

        $resultSet['rows'] = $suppliers;
        $resultSet['total'] = count($suppliers);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($resultSet) );
    }

    public function saveSupplier() {

        $post = $_POST;
        $supplier = $this->suppliers_model->save($post, $post['supp_id'], $post['supp_ui_id']);

        if($supplier){
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('status'=>'success', 'lastid' => $supplier->supp_id )) );
        }
    }

    public function deleteSupplier() {

        $post = $_POST;
        $supplier = $this->suppliers_model->delete($post);

        if($supplier){
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode( array ( 'status'=>'success' ) ) );
        }
    }

    public function dialog($supp_id = 0){

        $supplier = $this->suppliers_model->getSupplierById($supp_id);

        $data['supplier'] = ($supplier) ? $supplier : array();
        $data['supp_id'] = $supplier->supp_id;
        $data['supp_ui_id'] = $supplier->supp_ui_id;

        $this->load->view('suppliers/dialog/add', $data);
    }
}
?>